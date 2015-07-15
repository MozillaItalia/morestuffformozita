## Sommario

La **compattazione** è una nuova funzione del [**Garbage Collector**][0] di Firefox, disponibile a partire dalla versione 38, che consente di ridurre la frammentazione esterna nello **heap** JavaScript.
L’obiettivo di questa funzione è ottimizzare il consumo di memoria in generale oltre che gestire con maggiore efficienza i casi di memoria insufficiente.
Al momento è stata implementata unicamente la compattazione degli oggetti JavaScript, uno solo tra i vari tipi di celle dello *heap* elaborate dal *Garbage Collector*.

## Il problema

Lo *heap* JavaScript è composto da 4000 blocchi di memoria denominati **arene**, ciascuna delle quali è suddivisa in celle di dimensioni prestabilite.
*Arene* diverse sono utilizzate per memorizzare differenti tipi di celle e ciascuna *arena* contiene celle dello stesso tipo e della stessa dimensione.

Lo *heap* contiene diversi tipi di celle, incluse quelle destinate agli oggetti JavaScript, le stringhe e i simboli, ma anche celle utilizzate per dati interni come *script* (per memorizzare il codice JavaScript), *shape* (per memorizzare la rappresentazione degli oggetti grafici e delle loro proprietà) e *jitcode* (codice JIT compilato).
Di tutte queste, solitamente le celle utilizzate per gli oggetti JavaScript sono quelle che utilizzano la maggiore quantità di memoria.

Un’*arena* non può essere liberata se al suo interno c’è una cella che contiene dati in uso.
Celle allocate nello stesso periodo possono avere dei cicli di vita differenti, talvolta accade quindi che nello *heap* si trovino più *arene* ciascuna contenente solo poche celle attive.
Lo spazio libero di ciascuna arena può ancora essere impiegato per allocare nuove celle dello stesso tipo, ma sarà inutilizzabile per celle di tipo diverso o per essere reimpiegato dal sistema in caso di memoria insufficiente.

Di seguito è mostrato un diagramma semplificato dello *heap* con arene che contengono due diverse tipologie di celle.

![heap layout smallest][1]

Si noti che se fosse possibile utilizzare lo spazio libero nell’arena 3 per allocare le celle dell’arena 5, si otterrebbe un’intera arena libera.

## Misurare lo spazio inutilizzato

È possibile conoscere lo spazio utilizzato da queste celle non più attive visitando la pagina `about:memory` e premendo il tasto <button>Measure</button>.
L’ammontare complessivo di memoria per ciascun tipo di cella è visualizzato nella sezione `js-main-runtime-gc-heap-committed/unused/gc-things`. Per maggiori informazioni su come interpretare i rapporti della pagina `about:memory` consultare [questo articolo su MDN][2].

Di seguito uno screenshot dell’intera sezione `js-main-runtime-gc-heap-committed` con la compattazione del **Garbage Collector** disattivata che mostra la differenza tra spazio utilizzato e non:

![unused *heap* screenshot][3]

Ho effettuato misurazioni approssimative dell’utilizzo di memoria durante la mia normale navigazione con la compattazione sia attivata che disattivata per osservare le differenze. La procedura per ottenere questi dati è descritta nell’[ultima sezione](#come-calcolare-lo-spazio-liberato-con-la-compattazione) dell’articolo.
I dati sono stati rilevati con una cinquantina di schede aperte, tra cui Google Mail, Google Calendar, varie pagine di Bugzilla e altri siti. Questo è il risultato ottenuto:

<table>
<tr>
<td></td>
<th>Totale allocazioni esplicite</th>
<th>Celle inutilizzate</th>
</tr>
<tr>
<td>Prima della compattazione</td>
<td>1324,46 MiB</td>
<td>69,58 MiB</td>
</tr>
<tr>
<td>Dopo la compattazione<td>
<td>1296,28 MiB</td>
<td>40,18 MiB</td>
</tr>
</table>

È possibile osservare una riduzione delle allocazioni esplicite di 29,4MiB ([mebibytes][4]).
Si tratta solo del 2% rispetto al totale delle allocazioni complessive, ma considerando solo lo spazio occupato dall’allocazione di oggetti JavaScript (al momento gli unici soggetti a compattazione) sale a oltre 8%.

## Funzionamento della compattazione

Per recuperare lo spazio inutilizzato il **Garbage Collector** dovrebbe essere in grado di spostare le celle fra differenti *arene*,
in modo da concentrare le celle attive in un numero limitato di *arene* e liberare le altre.
Certo è più facile a dirsi che a farsi, perché per ogni cella spostata bisognerebbe riaggiornare anche i relativi puntatori.
Anche un solo puntatore non aggiornato potrebbe bastare a causare un *crash* di Firefox.

Questa operazione inoltre è molto dispendiosa in termini di risorse perché richiede l’analisi di un numero non irrilevante di celle alla ricerca dei puntatori da aggiornare.
Per questo motivo l’idea è quella di procedere alla compattazione dello *heap* solo nei momenti in cui si disponga di poca memoria o l’utente non stia utilizzando Firefox.

L’algoritmo di compattazione è suddiviso in tre fasi:

1.  Selezione delle celle da spostare.
2.  Spostamento delle celle.
3.  Aggiornamento di tutti i puntatori con riferimenti a queste celle.

### Selezione delle celle da spostare

Ciò che ci proponiamo di fare è spostare il minor numero di dati possibile e di farlo senza riallocare ulteriore memoria, partendo dal presupposto che la memoria a disposizione sia già in esaurimento.
Per fare questo inseriamo in una lista tutte le *arene* che contengono spazio libero, ordinandole in modo decrescente a seconda del numero di celle libere al loro interno.
Suddividiamo la lista in due parti a partire dal punto in cui le arene della prima parte contengono abbastanza celle libere per ospitare le celle attive delle arene nella seconda parte.
Sposteremo tutte le celle delle arene della seconda parte.

### Spostamento delle celle

Allochiamo dunque una nuova cella da una delle arene che non subiranno spostamenti.
Il passaggio precedente ci assicura che ci sia abbastanza spazio libero per effettuare questa operazione.
A questo punto copiamo i dati dalla posizione iniziale.

In alcuni casi troveremo una cella con puntatori che puntano alla cella medesima: essi verranno aggiornati in questa fase.
Il browser potrebbe contenere riferimenti a oggetti esterni, in questo caso utilizzeremo un **hook** per aggiornarli.

Dopo aver spostato una cella, aggiorneremo la locazione di memoria originale con un puntatore di reindirizzamento che faccia riferimento alla nuova posizione in modo da poterla facilmente ritrovare in seguito.
Questo permetterà inoltre al **Garbage Collector** di identificare le celle che sono state spostate e vedremo come ciò verrà utilizzato nel successivo passaggio.

### Aggiornamento dei puntatori alle celle spostate

Questa è la parte più dispendiosa del processo di compattazione.
Nel caso più generale, non è possibile conoscere quali celle contengano dei puntatori alle celle che abbiamo spostato, quindi sembra proprio che sia necessario effettuare una scansione di tutte le celle presenti nello *heap*.
Una tale scansione globale dello *heap* sarebbe davvero dispendiosa in termini di risorse macchina impiegate.

Abbiamo però alcuni metodi per ridurre le risorse impiegate.
Innanzitutto si noti che lo *heap* è suddiviso in più zone: una zona per ogni scheda aperta e altre zone utilizzate dal sistema.
Dato che, di norma, le celle non contengono mai puntatori con riferimenti a zone diverse da quella in cui si trovano, la compattazione potrà essere effettuata per zona e non su tutto lo *heap*.  Il caso particolare di celle con puntatori a zone diverse da quella di appartenenza verrà effettuato a parte.
La compattazione per zone ci consentirà di suddividere il processo in diverse sezioni incrementali.

In secondo luogo, per costruzione, esistono delle tipologie di celle che non possono contenere puntatori a altre tipologie di celle (a essere precisi ci sono alcune tipologie di celle che non possono proprio contenere dei puntatori), è quindi possibile escludere a priori alcune celle dalla ricerca.

Infine, possiamo parallelizzare questa operazione e sfruttare tutte le risorse della CPU disponibili.

È importante notare che ciò è stato reso possibile solo grazie al lavoro fatto a suo tempo implementando l’**exact stack rooting**, come descritto in [questo articolo del blog Mozilla][5].
Infatti è possibile spostare gli oggetti solamente conoscendo quali locazioni nello *stack* sono **root**, altrimenti si corre il rischio di sovrascrivere dei dati non correlati nello *stack* che potrebbero essere interpretati erroneamente come dei puntatori a celle.

## Programmare l’esecuzione di ogni compattazione

Come accennato in precedenza, la compattazione non viene effettuata contestualmente all’inserimento di nuovi dati nel **Garbage Collector**.
Allo stato attuale dell’implementazione essa viene effettuata nelle seguenti situazioni:

-   è stata utilizzata tutta la memoria e si cerca di fare un ultimo tentativo per liberare dello spazio utile;
-   il sistema operativo genera un messaggio riguardante la gestione della memoria non corretta da parte di Firefox;
-   l’utente non utilizza il sistema per un certo periodo di tempo (per impostazione predefinita questo periodo è attualmente di 20 secondi).

Nei primi due casi la compattazione viene avviata per scongiurare situazioni di memoria insufficiente, mentre nel terzo caso si cerca di ottimizzare la memoria a disposizione senza impattare la navigazione.

## Conclusione

Spero che questo articolo sia riuscito a spiegare il problema della compattazione del **Garbage Collector** e come stiamo cercando di affrontarlo.

Un inaspettato effetto positivo dell’implementazione della compattazione del **Garbage Collector** è che ha rivelato alcuni errori nel *tracing* dei puntatori alle celle.
E questo tipo di errori possono generare dei crash difficili da identificare e riprodurre e generare possibili falle nella sicurezza del browser, quindi possiamo considerarlo un ulteriore miglioramento anche da questo punto di vista.

Idee per il futuro

L’introduzione della compattazione è stata un’importante tassello per il miglioramento del **Garbage Collector** di Firefox, ma non è comunque finita qui.
Ci sono ancora molti altri aspetti su cui possiamo concentrarci per migliorarlo ulteriormente.

Attualmente la compattazione viene effettuata solo sugli oggetti JavaScript, ma esistono molti altri oggetti nello *heap* e estenderla anche a questi potrebbe consentirci di ottimizzare ulteriormente la memoria utilizzata.

Se trovassimo il modo per farlo, le risorse impiegate per la compattazione verrebbero ulteriormente ridotte.
Se ciò fosse possibile le risorse impiegate per la compattazione verrebbero ulteriormente ridotte.
Una possibile soluzione è scansionare lo *heap* in background, ma per farlo si renderebbe necessario individuare le modifiche effettuate alle celle dal **mutator**.

L’attuale algoritmo del  **Garbage Collector** raggruppa assieme celle allocate in diversi momenti.
Solitamente, le celle che sono allocate nello stesso momento hanno una durata simile, motivo per cui questa scelta non è il massimo.

Se riuscissimo a minimizzare i tempi di esecuzione della compattazione sarebbe possibile effettuarla ogni qualvolta il **Garbage Collector** rilevi un certo livello di frammentazione dello *heap*.

##Come calcolare lo spazio liberato con la compattazione

Per stimare a grandi linee lo spazio liberato grazie alla compattazione è possibile effettuare i seguenti passaggi:

1. Disattivare la compattazione aprendo la pagina `about:config` e impostando la preferenza `javascript.options.mem.gc_compacting` a `false`.
2.  Al momento attuale è preferibile disattivare la modalità multiprocesso di Firefox dal pannello Opzioni.
3.  Riavviare Firefox e aprire alcune schede. Per guadagnare tempo è presente un’opzione che permette di ricaricare tutte le schede della sessione precedente. Attendere che le pagine vengano caricate.
4.  Aprire la pagina `about:memory` e effettuare un’esecuzione completa del **Garbage Collector** facendo clic su <button>Minimize memory usage</button> e successivamente su <button>Measure</button>. Poiché è necessario un po’ di tempo affinché la memoria si assesti, è consigliabile effettuare l’operazione un certo numero di volte per ottenere dei valori consistenti.
5.  Annotare l’ammontare delle allocazioni esplicite (Total GC size) e quello di `js-main-runtime-gc-heap-committed/unused/gc-things`.
6.  Riattivare nuovamente la compattazione impostando `javascript.options.mem.gc_compacting` a `true`. Non è necessario riavviare Firefox.
7.  Fare nuovamente clic su <button>Minimize memory usage</button> e successivamente su <button>Measure</button>.
8.  Confrontare le letture con quelle precedenti.

Notare che i valori ottenuti non saranno precisi a causa delle varie operazioni in atto in background, ma rappresentano comunque una’buona approssimazione.



[0]: https://en.ikipedia.org/wiki/Garbage_collection_%28computer_science%29
[1]:  http://i.imgur.com/jCrRTJj.png
[2]: https://developer.mozilla.org/en-US/docs/Mozilla/Performance/about:memory
[3]: http://i.imgur.com/kOnL35d.png
[4]: https://it.wikipedia.org/wiki/Mebibyte
[5]: https://blog.mozilla.org/javascript/2013/07/18/clawing-our-way-back-to-precision/

