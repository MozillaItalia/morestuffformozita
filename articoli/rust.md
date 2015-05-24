!
[Il logo del linguaggio di programmazione Rust][0]

[Rust][1] è un nuovo linguaggio di programmazione focalizzato sulle prestazioni, la parallelizzazione dei processi e la gestione sicura della memoria.
Sviluppando un nuovo linguaggio da zero e includendo alcuni dei modelli utilizzati dai moderni linguaggi di programmazione, gli sviluppatori di Rust hanno evitato la necessità di includere un sacco di “zavorra” (codice per la retrocompatibilità) con cui i linguaggi di programmazione meno recenti devono fare i conti.
Diversamente, Rust è in grado di fondere la sintassi espressiva e la flessibilità dei linguaggi ad alto livello con il controllo senza eguali e le prestazioni di un linguaggio di basso livello.

La scelta di un linguaggio di programmazione solitamente comporta dei compromessi.
Sebbene molti dei moderni linguaggi di programmazione ad alto livello forniscano strumenti per gestire in modo sicuro la programmazione concorrente e la memoria, questo obiettivo viene raggiunto solo utilizzando risorse aggiuntive a runtime (overhead), ad esempio utilizzando un [*Garbage Collector*][2] (GC) e tendono a essere carenti dal punto di vista delle prestazioni e a non offrire il necessario controllo sul codice prodotto.

Per superare queste limitazioni è necessario utilizzare linguaggi di programmazione a basso livello.
Però, senza la rete di sicurezza propria di molti linguaggi di programmazione ad alto livello, questo può generare codice fragile e soggetto a errori.
Ci si troverà improvvisamente a dover gestire manualmente la memoria, l’allocazione delle risorse e a districarsi con i [puntatori pendenti][3], ecc.
Creare del software che sfrutti al massimo il crescente numero di *core* presenti negli attuali ddispositivi è complesso, ancor più complicato è assicurarsi *che il codice funzioni correttamente*.

Quindi, in che modo Rust riesce a mettere assieme il meglio dei due mondi in un unico linguaggio di programmazione?
In questo articolo cercheremo di dare una risposta a questa domanda.

Recentemente è stata rilasciata la [versione 1.0 stabile di Rust][4].
Il linguaggio ha già una [comunità molto attiva][5], un crescente [ecosistema di librerie][6] (chiamate *crate*) disponibili tramite `Cargo`, il *package manager*, e molti sviluppatori che stanno già sfruttando le sue capacità in svariati progetti.
Anche se non si è mai avuto a che fare con un linguaggio a basso livello, questo è il momento giusto per approfondire l’argomento.

[*La maglietta realizzata per celebrare l’uscita di Rust 1.0 in tutto il mondo*][7].

Rust: ambiti attuali di utilizzo 
--------------------------------

Rust sembra un’ottima scelta per programmatori abituati a lavorare a stretto contatto con il sistema, ma cosa dire per chi non ha familiarità con i linguaggi di programmazione a basso livello? Come tutti quei programmatori che ricordano solo vagamente le parole “C” e “allocazione dello stack/heap”, magari per averle ascoltate anni fa in un corso introduttivo sulla programmazione.
Rust fornisce prestazioni tipicamente ottenibili con un linguaggio di basso livello.
Nonostante questo, nella maggior parte delle occasioni la sensazione è quella di lavorare con un linguaggio ad alto livello.
Ecco alcuni esempi che mostrano concretamente come utilizzare Rust nello sviluppo delle proprie applicazioni.

#### Hacking e sviluppo di applicazioni per l’Internet delle cose (IOT)

L’era dell’[*Internet delle cose*][8] (IOT) e l’espansione del movimento dei cosiddetti *maker* ha portato a uno sviluppo democrativo del mondo dell’hardware.
Che si tratti del Raspberry Pi, di Arduino o di uno dei giovani colossi emergenti come BeagleBone o Tessel, è possibile scegliere tra molti linguaggi, inclusi Python e JavaScript, per lo sviluppo del proprio progetto hardware.

In alcuni casi però, le prestazioni ottenute con questi linguaggi di programmazione sono, molto semplicemente, non adeguate.
Altre volte, l’hardware scelto non è adeguato all’esecuzione di questi linguaggi di programmazione: processori lenti, con memoria e consumi di corrente ridotti al minimo, richiedono ancora l’utilizzo di linguaggi più vicini a quello macchina.
Tradizionalmente il linguaggio di riferimento è sempre stato il *C*, ma come probabilmente si sarà intuito, Rust è l’alternativa emergente in questo settore.

Rust supporta un’ampia gamma di piattaforme.
Sebbene il supporto per alcune di queste piattaforme sia ancora in fase sperimentale, tra esse si possono annoverare l’hardware [“generic ARM”][9], la [dev board TIVA][10] di Texas Instruments e anche il [Raspberry Pi][11].
Alcune delle schede elettroniche di nuova generazione realizzate per l’Internet delle cose, come la scheda [Tessel 2][12], hanno il supporto per Rust integrato e ufficiale.

#### Operare con applicazioni di calcolo a elevate prestazioni scalabili su core multipli 

[Alcuni studi][13] suggeriscono che Rust sia già un’ottima scelta per il [calcolo a elevate prestazioni][14], in inglese *High Performance Computing* (HPC).
Non è necessario riscrivere tutto il codice delle proprie applicazioni in Rust: l’interfaccia per la gestione delle funzioni esterne ([Foreign Function Interface][15] o FFI) offre un ottimo binding per il codice *C* e consente di esporre e richiamare codice in Rust senza *overhead* rilevanti.
Questo consentirà di riscrivere il codice della propria applicazione modulo per modulo, migrando lentamente verso una migliore esperienza per gli sviluppatori, che si tradurrà in prestazioni uguali se non addirittura superiori a quelle del vecchio codice.
Inoltre si otterrà una base di codice più gestibile con meno errori, in grado di scalare meglio su un elevato numero di *core*.

#### Realizzare applicazioni più veloci 

Rust è una scelta ideale per riscrivere parti sensibili delle proprie applicazioni che necessitano di avere alte prestazioni.
Grazie all’interfaccia FFI è in grado di integrarsi bene con altri linguaggi di programmazione e dispone di un leggero ambiente di runtime in grado di competere con quelli del *C* e del *C++*, anche quando le risorse a disposizione sono limitate.

Nonostante la natura del linguaggio in costante evoluzione, esistono già progetti di una certa rilevanza, applicazioni utilizzate in ambienti di produzione che hanno già fatto buon uso di Rust nel corso del tempo: la startup di Yehuda Katz, Skylight, sfrutta le elevate prestazioni del [codice Rust integrato in un pacchetto gem Ruby][16] per la manipolazione dei dati.
La versione 1.0 rappresenta un’importante pietra miliare nello sviluppo del linguaggio in quanto non sono previsti cambiamenti rilevanti da qui in avanti.
 Proprio per questo motivo è possibile consigliare l’utilizzo di Rust anche per progetti importanti.

È possibile guardare il video di Yehuda Katz e Tom Dale in cui spiegano le [basi della programmazione in Rust][17] e come loro utilizzano Rust unitamente a Ruby per le loro applicazioni.

Primi passi con Rust
--------------------

Esistono molte guide che introducono i concetti base di Rust e altre che trattano argomenti più specifici.
Ad esempio, nel blog dedicato a Rust, il [Rust blog][18], è possibile trovare molti articoli interessanti su vari aspetti del linguaggio.
Esistono anche eccellenti presentazioni introduttive come quella tenuta all’università di Stanford da Aaron Turon.
In questo *talk*, Aaron spiega in modo brillante i concetti fondamentali e i principi alla base di Rust e può rappresentare il perfetto punto di partenza per un viaggio alla scoperta del linguaggio:

<iframe width="500" height="281" src="https://www.youtube.com/embed/O5vzLKg7y-k?feature=oembed" frameborder="0" allowfullscreen></iframe>

Presentazioni e guide non possono sostituire la scrittura di codice quando si tratta di apprendere un nuovo linguaggio di programmazione.
Fortunatamente anche in questo settore esistono molte ottime risorse per imparare a utilizzare Rust.
Il libro [*Rust Book*][19] è stato appositamente concepito per aiutare i programmatori a muovere i primi passi con Rust — partendo dall’installazione dell’ambiente di lavoro e dalla creazione del primo programma, rappresenta allo stesso tempo un’approfondita guida di riferimento per tutte le caratteristiche fondamentali del linguaggio.

Un’altra risorsa degna di nota è [*Rust by Example*][20], in grado di guidare il lettore alla scoperta delle caratteristiche principali di Rust sino ai segreti poteri dei **trait**, delle **macro** e dell’interfaccia FFi. 
*Rust By Example* offre utilissimi esempi modificabili direttamente nel browser inclusi nei vari articoli.
Non è nemmeno necessario scaricare e compilare il codice Rust, poiché è possibile provare, e modificare, il codice stesso direttamente dal browser stando comodamente seduti sul proprio divano di casa.
Per lo stesso motivo esiste pure un [Playpen online][21] dedicato a Rust.

Non che scaricare e installare Rust sia molto complicato.
È sufficiente visitare la [pagina principale del sito di Rust][1] e scaricare i file di installazione per il proprio sistema operativo.
Il download comprende tutti gli strumenti base per iniziare, come `rustc`, il compilatore, o `cargo`, il *package manager*) e sono disponibili i pacchetti precompilati per tutti i sistemi operativi (Windows, Linux e OSX).

Ma allora, che cos’è che rende Rust così unico? *Così diverso*?

Lo stile Rust
-------------

Probabilmente è proprio il [modello di proprietà][23] (*ownership*) di Rust, non presente in altri linguaggi, che gli consente di essere [davvero competitivo][24], riuscendo a eliminare tutta una serie di errori relativi al *threading* e alla gestione della memoria, e nello stesso tempo a semplificare lo sviluppo e il debug del codice.

### Il modello di proprietà in Rust

Il principio base del modello di proprietà in Rust consiste essenzialmente nel fatto che ciascuna risorsa può appartenere a uno e un solo “proprietario”.
Col termine risorsa si può indicare qualunque cosa, da una porzione di memoria a un *socket* aperto, fino a qualcosa di più astratto come un [*mutex lock*][25].
Il proprietario della risorsa è il responsabile del suo utilizzo, in alcuni casi può prestarla ad altri utenti e deve, in ultima istanza, occuparsi della sua rimozione.
Tutto ciò avviene automaticamente, grazie all’uso di *scope* e *binding*: un *binding* può possedere o prendere in prestito i valori, e dura fino al termine del proprio *scope*.
Quando un *binding* esce dallo *scope*, deve restituire il valore preso in prestito oppure rimuoverlo se ne è il proprietario.

La cosa ancor più interessante è che i controlli per il corretto funzionamento del modello di proprietà sono effettuati e forzati dal compilatore Rust e dallo “*strumento di controllo dei prestiti*” in fase di compilazione e tutto questo produce una serie di vantaggi aggiuntivi.

### Nessuna astrazione

Poiché il corretto funzionamento di un programma viene valutato in fase di compilazione, è possibile considerare il risultato ottenuto dopo la compilazione privo di errori tipici della gestione della memoria e della programmazione concorrente, come ad esempio [l’utilizzo di puntatori che fanno riferimento a porzioni di memoria che sono state liberate][26] o [problemi di concorrenza (*data races*)][27].
Tutto questo è possibile perché Rust segnala in fase di compilazione eventuali violazioni dei principi sopra esposti, contribuendo in questo modo a [mantenere il *runtime* minimale][28].\
 Spostando questi controlli in fase di compilazione non è necessario effettuarli a runtime (il codice compilato è già sicuro), e si possono perciò evitare *overhead* in fase di *runtime*.
 Nel caso della gestione della memoria, questo si traduce nell’inutilità di avere un Garbage Collector a runtime.
 Tutto questo — avanzato costrutto del linguaggio con pochi o nessun overhead in fase di runtime — è alla base del concetto di “nessuna astrazione”.

Sebbene un’approfondita trattazione del modello di proprietà di Rust esuli dagli obiettivi di questo articolo introduttivo, esistono molte ottime risorse, come il [*Rust book*][19] e articoli che trattano approfonditamente questo argomento.
I principi del modello di proprietà e dello strumento di controllo dei prestiti sono due passaggi essenziali per la comprensione di Rust e sono la chiave per comprendere altri aspetti importanti del linguaggio, come la gestione della concorrenza e il parallelismo.

### Due piccioni con una fava

> La condivisione di stati modificabili è l’origine di tutti i mali. 
> La maggior parte dei linguaggi di programmazione tenta di risolvere questo problema agendo sulla *modificabilità*, Rust invece agisce sulla *condivisione*.
 — [citazione da *Rust Book*][30]

Oltre alla gestione sicura della memoria, il parallelismo e la concorrenza rappresentano il secondo paradigma della filosofia di Rust.
Può sembrare sorprendente, ma il sistema di proprietà (assieme all’utilizzo di semplici **trait**) fornisce anche strumenti potenti per il threading, la sincronizzazione e l’accesso simultaneo ai dati.

Iniziando a utilizzare alcune delle primitive integrate per la gestione della concorrenza e approfondendo la conoscenza del linguaggio, potrebbe risultare sorprendente che tali primitive siano fornite dalla libreria *standard* piuttosto che direttamente dal core del linguaggio stesso.
In definitiva, la creazione di nuove metodologie per la [programmazione concorrente][31] è lasciata nelle mani degli autori di librerie piuttosto che essere integrata nel core del linguaggio stesso e e suscettibile alle modifiche pianificate per le versioni future del linguaggio.

### Prestazioni o leggibilità del codice? Scegli entrambe

Grazie al sistema di tipizzazione statica, caratteristiche scelte con cura, e l’assenza di un Garbage Collector, i binari ottenuti utilizzando il compilatore Rust sono molto veloci e assolutamente prevedibili, al pari di quelli ottenuti utilizzando linguaggi di basso livello tradizionali come *C* e *C++*.

Spostando i vari controlli dall’ambiente di runtime ed escludendo la necessità di un Garbage Collector, il codice risultante imita le caratteristiche prestazionali di altri linguaggi di basso livello, anche se il linguaggio continua a rimanere molto più comprensibile.
Gli, apparenti, costrutti di alto livello (stringhe, collezioni, funzioni di ordine superiore, ecc.) eliminano quasi completamente i problemi a runtime che di solito si incontrano con gli stessi costrutti in altri linguaggi.
Poiché l’output di un programma Rust dopo la compilazione è in una [rappresentazione intermedia LVM][32], il codice macchina finale trarrà vantaggio di tutti i benefici offerti dal compilatore, multipiattaforma, LLVM e di tutte le ottimizzazioni, presenti e future, apportate al compilatore LLVM.

Si potrebbe continuare per ore sottolineando che con Rust [non è necessario preoccuparsi di chiudere un socket o di liberare la memoria][33], spiegando come l’utilizzo dei **trait** e delle **macro** garantiscano una grande flessibilità per l’[overload degli operatori][34], oppure descrivendo gli aspetti della programmazione funzionale in Rust (juggling iterator, closure, [funzioni di ordine superiore][35]).
Ma inutile prolungare troppo questa trattazione.
Prima o poi ci si imbatterà comunque in questi aspetti del linguaggio — e si sa che è più divertente scoprire da sé quanto profonda sia la tana del coniglio.

Piuttosto, iniziamo adesso a concentrarci su del vero codice.

### Il primo programma in Rust

Senza ulteriori divagazioni, ecco il primo frammento di codice in Rust:

```rust
fn main() {
    println!("Hello, Rust!");
}
```

[Apri questo codice Rust nel playpen online»][36]

Tutto qui?
Non è molto scenografico, ma c’è un limite al numero di modi possibili per scrivere un programma “Hello World” in Rust.
Di seguito viene mostrato un altro esempio classico spesso utilizzato nei corsi di programmazione.

### Giochiamo a Fizzbuzz con Rust

Prendiamo in esame un programma della “vecchia scuola”.
Fizzbuzz è un gioco, utilizzato nei paesi anglosassoni per insegnare ai bimbi a contare e a fare le divisioni. Lo scopo del gioco (e dell’algoritmo che andremo a implementare) è quello di contare, teoricamente all’infinito, sostituendo con *fizz* i numeri che sono divisibili per 3, con *buzz* i numeri divisibili per 5 e con *fizzbuzz* i numeri divisibili sia per 3 che per 5 (cioè quelli divisibili per 15).

Per evidenziare meglio la semantica e gli aspetti peculiari di Rust, che sono lo scopo di questo articolo, includiamo i sorgenti dell’algoritmo anche in *C* e *Python*.

**Versione in C dell’algoritmo Fizzbuzz**

```c
#include <stdio.h>

int main(void)
{
    int num;
    for(num=1; num<101; ++num)
    {
        if( num%3 == 0 && num%5 == 0 ) {
            printf("fizzbuzz\n");
        } else if( num%3 == 0) {
            printf("fizz\n");
        } else if( num%5 == 0) {
            printf("buzz\n");
        } else {
            printf("%d\n",num);
        }
    }

    return 0;
}
```

**Versione in Python di Fizzbuzz**

```python
for num in xrange(1,101):
    if num%3 == 0 and num%5 == 0:
        print "fizzbuzz"
    elif num%3 == 0:
        print "fizz"
    elif num%5 == 0:
        print "buzz"
    else:
        print num
```

**Versione in Rust di Fizzbuzz**

```rust
fn main() {
    for num in 1..101 { // Range notation!
        match (num%3, num%5) { // Pattern Matching FTW!
            (0, 0) => println!("fizzbuzz"),
            (0, _) => println!("fizz"),
            (_, 0) => println!("buzz"),
                 _ => println!("{}", num)
        }
    }
}
```

[Apri questo codice Rust nel playpen online»][37]

Anche da queste poche righe di codice si può già iniziare a intravedere i punti di forza di Rust.
La differenza più evidente è la scelta di utilizzare il [*pattern matching*][38], anziché ricorrere alla tradizionale istruzione `if`.
Avremo anche potuto farlo, ma l’utilizzo del metodo `match` è un importante strumento nel bagaglio di un esperto [*Rustacean*][39].

L’altra cosa da notare è la notazione mediante l’uso di intervalli del ciclo `for`, come avviene in Python.
Non avremmo però potuto utilizzare, in quanto non previsto dalla filosofia di Rust, un ciclo `for` classico come nel linguaggio *C*.
I tradizionali cicli `for` sono considerati fonte di errori e sono perciò stati sostituiti dal concetto più generale di [iterazione][40].

Ora analizziamo più in dettaglio cosa accade nella fase di *pattern matching* del nostro esempio:

```rust
…
// per il pattern matching creiamo una tupla che contenga
// i resti della divisione intera per 3 e 5
match (num%3, num%5) {
    // quando num è divisibile sia per 3 che 5
    // (entrambi i resti sono 0)
    // -> stampiamo  "fizzbuzz"
    (0, 0) => println!("fizzbuzz"),

    // quando num è divisibile per 3 (il resto è 0)
    // è divisibile per 5? A noi non interessa
    // -> stampiamo "fizz"
    (0, _) => println!("fizz"),

    // quando num è divisibile per 5 (il resto è 0)
    // è divisibile per 3? A noi non interessa
    // -> stampiamo "buzz"
    (_, 0) => println!("buzz"),

    // In qualsiasi altro caso stampiamo il numero
    // Nota, il matching deve essere esaustivo, vale a dire:
    // bisogna considerare tutti i possibili valori, ma questo è forzato
    // dal compiler Rust
         _ => pintln!("{}", num)
}
…
```

Questo non è il luogo per trattare approfonditamente il funzionamento del *pattern matching*, della destrutturazione e per spiegare cosa sono le tuple.
È possibile trovare ottimi articoli che trattano questi argomenti in modo approfondito nel libro [*Rust Book*][41], nel [Rust Blog][42] o su [*Rust By Example*][38], ma pensiamo che accennarli sia un modo per dimostrare le caratteristiche che rendono Rust così potente ed efficace.

### Fizzbuzz utilizzando la programmazione funzionale

Per estendere l’ultimo esempio prodotto e per dimostrare la reale versatilità di Rust, nel nostro secondo esempio faremo fare un salto di qualità al codice del nostro Fizzbuzz.
Rust definisce se stesso “pluriparadigma”.
Possiamo mettere tutto ciò alla prova riscrivendo il programma Fizzbuzz utilizzando la programmazione funzionale.
Per avere una migliore prospettiva, mostreremo anche il codice utilizzando le specifiche della versione 6 di JavaScript (EcmaScript 6).

**Fizzbuzz, versione JavaScript utilizzando le tecniche della programmazione funzionale della versione 6**

```javascript
Array.from(Array(100).keys()).slice(1)
    .map((num) => {
        if (num%3 === 0 && num%5 === 0) {
            return "fizzbuzz";
        } else if (num%3 === 0) {
            return "fizz";
        } else if (num%5 === 0) {
            return "buzz";
        } else {
            return num;
        }
    })
    .map(output => console.log(output));
```

**Fizzbuzz, versione in Rust utilizzando le tecniche della programmazione funzionale**

```rust
fn main() {
    (1..101)
        .map(|num| {
            match (num%3, num%5) { // Pattern Matching FTW!
                (0, 0) => "fizzbuzz".to_string(),
                (0, _) => "fizz".to_string(),
                (_, 0) => "buzz".to_string(),
                     _ => format!("{}", num)
            }
        })
        .map(|output| { println!("{}", output); output })
        .collect::<Vec<_>>();
}
```

[Apri questo codice Rust nel playpen online»][44]

Non solo è possibile imitare lo stile di programmazione funzionale di JavaScript mediante l’utilizzo delle [closure][45] e le chiamate funzionali ai metodi, ma grazie al potente [*pattern matching*][46] di Rust, è altresì possibile migliorare l’espressività di JavaScript.

**Nota**: gli iteratori di Rust sono *lazy* e si rende perciò necessario, per il corretto funzionamento del codice, utilizzare una chiamata al metodo `.collect()` (che viene denominato un metodo *consumer*) — dimenticando questa accortezza il codice non funzionerà.
Fare riferimento alla sezione [consumers][47] del libro *Rust Book* per ulteriori informazioni su questo argomento.

### Scegliere un progetto

A questo punto si dovrebbe essere ansiosi di immergersi in Rust e di iniziare un progetto interessante.
Ma che cosa creare?
È possibile iniziare sviluppando una piccola applicazione o una piccola libreria e caricarla su [crates.io][6].
Molti programmatori hanno già realizzato degli interessanti progetti in Rust: dai piccoli progetti kernel di tipo \*nix, a progetti basati su hardware *embedded*, dai giochi alle strutture lato server, dimostrando che l’unico limite è la propria immaginazione.

Se si vuole iniziare da qualcosa di piccolo, ma collaborando a qualcosa di utile mentre si imparano le parti più complesse della programmazione in Rust, è possibile considerare di collaborare a qualcuno dei progetti presenti su Github o al codice del compiler Rust (anch’esso scritto in Rust).\
 Oppure, è possibile riscrivere piccole parti delle proprie applicazioni utilizzate nel proprio ambiente produttivo e sperimentare con Rust analizzando i risultati ottenuti.
 L’interfaccia di Rust per le funzioni esterne, [Foreign Function Interface (FFI)][15] è stata realizzata specificatamente per rimpiazzare il codice *C*.
 Con un piccolo sforzo è possibile sostituire porzioni di codice dei propri applicativi con del codice Rust.
 Ma l’interoperabilità non si ferma qui — questi binding per il linguaggio *C* funzionano anche in modo inverso.
 Ciò significa che è possibile utilizzare librerie *C* nel proprio codice Rust — oppure (poiché molti linguaggi di programmazione prevedono un’interfaccia per le librerie standard del linguaggio *C*) utilizzare chiamate, da e verso, fra Rust e Python, Ruby, o anche [Go][50].

A questo proposito, si guardi il talk di Dan Callahan [My Python’s a little Rust-y][51] per imparare a connettere Rust con Python.

Praticamente non esistono linguaggi che non siano in grado di funzionare assieme a Rust.
Si desidera [compilare il codice Rust in un sorgente JavaScript][52] o [utilizzare codice assembly inline nel proprio codice Rust][53]? Si può fare!

**E adesso puoi smettere di leggere questo articolo e darti da fare per costruire qualcosa di importante.**

E non dimenticare — Rust non è semplicemente un linguaggio di programmazione — è anche una *comunità*. In caso di problemi è possibile chiedere aiuto nei [Forum][54] o su [IRC][55]. È anche possibile condividere le proprie impressioni e i propri progetti sul canale [Rust Reddit][56].

Rust è già straordinario — persone come **te** lo renderanno ancora più *grandioso*!


[0]: https://hacks.mozilla.org/files/2015/05/rust.jpg
[1]: http://rust-lang.org
[2]: http://it.wikipedia.org/wiki/Garbage_collection
[3]: http://it.wikipedia.org/wiki/Dangling_pointer
[4]: http://blog.rust-lang.org/2015/05/15/Rust-1.0.html
[5]: http://users.rust-lang.org/t/rust-1-0-launch-event-details-action-required-for-event-organizers/1025
[6]: http://crates.io
[7]: http://devswag.com/products/rust-t-shirt
[8]: http://it.wikipedia.org/wiki/Internet_delle_cose
[9]: https://zinc.rs/
[10]: http://antoinealb.net/programming/2015/05/01/rust-on-arm-microcontroller.html
[11]: https://github.com/Ogeon/rust-on-raspberry-pi
[12]: https://tessel.io/
[13]: http://octarineparrot.com/assets/mrfloya-thesis-ba.pdf
[14]: https://it.wikipedia.org/wiki/High_Performance_Computing
[15]: http://doc.rust-lang.org/book/ffi.html
[16]: http://blog.skylight.io/bending-the-curve-writing-safe-fast-native-gems-with-rust/
[17]: https://www.youtube.com/watch?v=LazvK39Oc4U
[18]: https://blog.rust-lang.org
[19]: http://doc.rust-lang.org/book/
[20]: http://rustbyexample.com/
[21]: http://play.rust-lang.org/
[22]: http://rust-lang.org
[23]: https://doc.rust-lang.org/book/ownership.html
[24]: http://manishearth.github.io/blog/2015/05/03/where-rust-really-shines/
[25]: http://blog.rust-lang.org/2015/04/10/Fearless-Concurrency.html
[26]: https://www.owasp.org/index.php/Using_freed_memory
[27]: http://doc.rust-lang.org/book/concurrency.html#safe-shared-mutable-state
[28]: https://news.ycombinator.com/item?id=9477513
[29]: http://doc.rust-lang.org/book/
[30]: http://doc.rust-lang.org/book/concurrency.html
[31]: https://it.wikipedia.org/wiki/Concorrenza_%28iformatica%29
[32]: http://it.wikipedia.org/wiki/LLVM
[33]: http://blog.skylight.io/rust-means-never-having-to-close-a-socket/
[34]: http://rustbyexample.com/trait/ops.html
[35]: http://rustbyexample.com/fn/hof.html
[36]: http://is.gd/9TN7rw
[37]: http://is.gd/DpJrPe
[38]: http://rustbyexample.com/flow_control/match.html
[39]: http://www.rustaceans.org/
[40]: https://doc.rust-lang.org/book/iterators.html
[41]: http://doc.rust-lang.org/book/primitive-types.html#tuples
[42]: http://blog.rust-lang.org/2015/04/17/Enums-match-mutation-and-moves.html
[43]: http://rustbyexample.com/flow_control/match.html
[44]: http://is.gd/VUsjct
[45]: http://doc.rust-lang.org/nightly/book/closures.html
[46]: http://tmpvar.com/blog.rust-lang.org/2015/04/17/Enums-match-mutation-and-moves.html
[47]: http://doc.rust-lang.org/book/iterators.html#consumers
[48]: http://crates.io
[49]: http://doc.rust-lang.org/book/ffi.html
[50]: https://github.com/medimatrix/rust-plus-golang
[51]: https://www.youtube.com/watch?v=3CwJ0MH-4MA
[52]: http://www.reddit.com/r/rust/comments/20nnkk/rust_and_emscripten_a_small_success/
[53]: https://doc.rust-lang.org/book/inline-assembly.html
[54]: https://users.rust-lang.org/
[55]: https://chat.mibbit.com/?server=irc.mozilla.org&channel=%23rust
[56]: http://www.reddit.com/r/rust/
