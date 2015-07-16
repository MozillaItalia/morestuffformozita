Questa è la traduzione dell’articolo “°Compacting Garbage Collection in SpiderMonkey]§[1]” di <span>Jon Coppeard</span</span> apparso su <span>hacks.mozilla.org</span>.
Tradotto da [@gialloporpora][2], QA effettuato da [Sara Todaro][3] e *@miki64*.

Come tutti gli ambienti di programmazione che non richiedono una gestione esplicita della memoria da parte del programmatore, anche *SpiderMonkey* (il motore JavaScript di Firefox) ha bisogno di un **Garbage Collector**, cioè di uno strumento che si occupi di analizzare lo *heap* per liberare le risorse non più utilizzate.
Non esiste un metodo univoco o migliore degli altri per l’implementazione di un **Garbage Collector** e la scelta di quale algoritmo utilizzare dipende dagli obiettivi che ci si propone di raggiungere: implementazioni più “leggere” consentono un minor impiego di risorse macchina a scapito però di una maggiore frammentazione della memoria.
Al contrario implementazioni più complesse richiedono un maggiore tempo di esecuzione ma consentono di evitare la frammentazione della memoria.

Firefox ha adottato nel corso degli anni diverse implementazioni del **Garbage Collector** che hanno tenuto conto della sempre maggiore incidenza del codice JavaScript nelle pagine web.
Inizialmente il **Garbage Collector** utilizzava un algoritmo di tipo *reference counting*, per poi passare a partire dal 2010 all’implementazione di un **Garbage Collector** di tipo conservativo *mark e sweep* (marca e butta via).
Entrambi questi algoritmi richiedono pochissime risorse computazionali, ma hanno il difetto di produrre una frammentazione nello *heap* o più precisamente, nel modello di allocazione scelto da Firefox, una *frammentazione esterna dello heap*.

È così che dal 2013 si è passati , grazie all'implementazione dell'*exact stack rooting*, a un'implementazione di un **Garbage Collector** di tipo generazionale basato sul *tracing*.
Grazie a questa modifica del codice è stato poi possibile implementare lo strumento di compattazione.
Nell’articolo è spiegato il funzionamento della compattazione, quando viene eseguita e viene analizzato il guadagno in termini di memoria che si riesce a ottenere.


[0]: http://mondozilla.blogspot.it/2007/01/gestire-la-spazzatura.html
[1]: http://mzl.la/1CXHdXe 
[2]: https://twitter.com/gialloporpora
[3]: https://mozillians.org/it/u/sara_t
