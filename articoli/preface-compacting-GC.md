Questa è la traduzione dell’articolo “°[Compacting Garbage Collection in SpiderMonkey][1]” di *Jon Coppeard* apparso su *hacks.mozilla.org*.
Tradotto da [\@gialloporpora][2], QA effettuato da [Sara Todaro][3] e *@miki64*.

Come tutti gli ambienti di programmazione che non richiedono una gestione esplicita della memoria da parte del programmatore, anche *SpiderMonkey* (il motore JavaScript di Firefox) ha bisogno di un **Garbage Collector**, cioè di uno strumento che si occupi di analizzare lo *heap* per liberare le risorse non più utilizzate.
Non esiste un metodo univoco o migliore degli altri per l’implementazione di un **Garbage Collector** e la scelta di quale algoritmo utilizzare dipende dagli obiettivi che ci si propone di raggiungere: implementazioni più “leggere” consentono un minor impiego di risorse macchina a scapito però di una maggiore frammentazione della memoria.
Al contrario implementazioni più complesse richiedono un maggiore tempo di esecuzione ma consentono di evitare la frammentazione dello *heap*.

Gli sviluppatori di Firefox hanno adottato nel corso degli anni diverse implementazioni del **Garbage Collector** che hanno tenuto conto della sempre maggiore incidenza del codice JavaScript nelle pagine web.
[Inizialmente][0] il **Garbage Collector** utilizzava un algoritmo di tipo *reference counting*, per poi passare a partire dal 2010 all’implementazione di un **Garbage Collector** di tipo conservativo *mark e sweep*.
Entrambi questi algoritmi richiedono pochissime risorse computazionali, ma hanno il difetto di produrre una frammentazione dello *heap*.

È così che dal 2013 si è passati , grazie all'implementazione dell'*exact stack rooting*, a un'implementazione di un **Garbage Collector** di tipo generazionale sempre basato sul *tracing*.
Grazie a questa modifica del codice è stato poi possibile implementare lo strumento di compattazione.
Nell’articolo è spiegato il funzionamento della compattazione, quando viene eseguita, si analizza il guadagno di memoria che si riesce a ottenere e vengono discusse delle idee per migliorarlo ulteriormente.

Per un approfondimento delle tecniche di **Garbage Collection** si può consultare [questo articolo][4] in italiano che tratta l’argomento in generale e approfondisce il caso del **Garbage Collector** della *Java Vitrual Machine*.




[0]: http://mondozilla.blogspot.it/2007/01/gestire-la-spazzatura.html
[1]: http://mzl.la/1CXHdXe 
[2]: https://twitter.com/gialloporpora
[3]: https://mozillians.org/it/u/sara_t
[4]: http://www.di.unisa.it/~ads/corso-security/www/CORSO-9900/java/mirror/mokabyte/garbagecollector.htm