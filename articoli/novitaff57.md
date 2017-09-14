# Le novità di Firefox 57

Articolo basato su https://diary.braniecki.net/2017/09/01/all-hands-on-deck-how-you-can-use-your-skills-to-contribute-to-firefox-57-success/

<img src="https://diary.braniecki.net/wp-content/uploads/2017/08/RobotPoster2.jpg" />
Quest'ultimo anno Mozilla ha cambiato e rivoluzionato molte cose in Firefox e probabilmente non te ne sei accorto ma uno dei progetto principali si chiama <a href="https://wiki.mozilla.org/Quantum">Quantum</a>.  
Questa iniziativa sta portando Firefox ad un nuovo motore già disponibile in alcune sue componenti dalla <a href="https://hacks.mozilla.org/2017/04/firefox-53-quantum-compositor-compact-themes-css-masks-and-more/">release 53</a>. Molti ingegneri in Mozilla hanno lavorato per riscrivere, ottimizzare, rendere asincrone molte parti di Firefox.   

Finalmente ora Firefox é <a href="https://wiki.mozilla.org/Electrolysis">multi processo</a> che è una delle grandi novità che ha richiesto anni nello sviluppo e testing su vari sistemi e installazioni prima di poter essere resa disponibile a tutti gli utenti. Uno dei motivi per cui le estensioni realizzate con il vecchio framework per le estensioni non saranno più disponibili con Firefox 57 è perché quella tecnologia non supporta questa funzionalità.   

Firefox dalla versione 48 include componenti realizzati con un nuovo linguaggio, <a href="https://www.rust-lang.org">Rust</a>, da <a href="https://blog.nightly.mozilla.org/2017/07/25/stylo-is-ready-for-community-testing-on-nightly/">componenti importanti</a> dedicati alla <a href="https://hacks.mozilla.org/2017/08/inside-a-super-fast-css-engine-quantum-css-aka-stylo/">grafica</a> al <a href="https://wiki.mozilla.org/Platform/GFX/Quantum_Render">rendering</a>.   

Include migliorie per la sicurezza specialmente nella <a href="https://wiki.mozilla.org/Security/Sandbox">Sandbox</a> che é una delle parti più importanti di un browser visto che permette di far girare codice all'interno del computer scaricato da internet ed isolarlo.   

Tornando all'argomento asincronico ovvero la possibilità di eseguire più cose contemporaneamente senza dover aspettare la loro conclusione presenta una nuova tecnologia per lo zoom delle pagine completamente <a href="https://wiki.mozilla.org/Platform/GFX/APZ">asincronico</a>.   

Nuove tecnologie per gli sviluppatori sono principalmente sono principalmente il nuovo set di API per la realtà virtuale, la <a href="https://developer.mozilla.org/en-US/docs/Web/API/WebVR_API">WebVR API</a> e per le estensioni, le <a href="https://wiki.mozilla.org/WebExtensions">WebExtensions</a>. Non si può non menzionare anche il supporto per un nuovo linguaggio web disponibile all'interno del browser, ovvero <a href="http://webassembly.org/">WebAssembly</a>.   

Tutti questi cambiamenti hanno portato anche ad un rilascio di <a href="https://wiki.mozilla.org/Firefox/Go_Faster">funzionalità più rapido</a>, miglioramenti nella <a href="https://wiki.mozilla.org/Telemetry">telemetria dell'uso di Firefox</a>, introduzione del supporto per nuovi tipi di campi <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=888320">input</a>, nuova interfaccia per le <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=1357306">opzioni</a> e l'abbandono della release Aurora per rimuovere un passaggio nei rilasci di Firefox e poter rilasciare e testare più velocemente le nuove funzionalità.

Parlando di velocità che é una delle caratteristiche presenti già da Firefox 55 e ancora più evidente nella 57 grazie al progetto Quantum si può notare che Firefox ha battuto Chrome nel suo stesso benchmark (Speedometer v2).  
<img src="https://diary.braniecki.net/wp-content/uploads/2017/09/Screenshot-from-2017-09-01-19-24-32-768x307.png">  
Per altre statistiche e grafici riguardo lo stato attuale, si può approfondire presso questa <a href="https://health.graphics/quantum/">pagina web</a>.  
Alcune delle migliorie presenti in questa pagina non saranno presenti nella 57 visti i tempi di sviluppo ma lo saranno nelle release successive.  

Il progetto Quantum si è occupato della riscrittura ed identificazione dei vari colli di bottiglia presenti in Firefox ed ha pubblicato una <a href="https://ehsanakhgari.org/blog/2017-09-07/quantum-flow-engineering-newsletter-23">newsletter settimanale</a> per tracciare le novità. Ad oggi ci sono ancora molti <a href="https://wiki.mozilla.org/Quantum/Flow#Query:_P1_Bugs">ticket</a> a disposizione di chi volessi contribuire

Il design in Firefox 57 è diverso dalle versioni precedenti ed è dovuto al progetto Photon che ha portato alla riscrittura di molti elementi come animazioni con tecniche più veloci, la sostituzione delle immagini scalari con immagini vettoriale e molto altro. Per provarlo in azione è disponibile una <a href="http://design.firefox.com/people/shorlander/photon/Mockups/windows-10.html">pagina</a> e il <a href="http://design.firefox.com/photon/welcome.html">manuale di design</a>. Anche Photon ha rilasciato una <a href="https://msujaws.wordpress.com/2017/08/18/photon-engineering-newsletter-13/">newsletter settimanale</a> riguardo le novità con screenshot e altro che per chi usava la Nightly poteva provare in tempo reale.

Anche gli <a href="http://firefox-dev.tools/">strumenti per gli sviluppatori</a> sono stati aggiornati e sono realizzati con tecnologie web moderne.

Prima di concludere con l'elenco di novità anche il progetto <a href="http://testpilot.firefox.com/">TestPilot</a> ha fatto la sua parte in Firefox. Il progetto permette di provare funzionalità in sviluppo tramite estensioni e di fornire dati telemetrici (anonimi naturalmente) e di partecipare a dei sondaggi. Una delle funzionalità più famose è la possibilità di fare screenshot dei siti web direttamente da Firefox e di caricarli online, nato come progetto sperimentale ora è disponibile nella versione 57. Una delle funzionalità presenti come TestPilot e che non sarà presente nella 57 ma rimarrà solo in Nightly sono i container ovvero la possibilità di condividere specifiche sessioni di navigazioni tra gruppi di schede.   

Un progetto che non è integrato in Firefox ma nato in TestPilot è <a href="https://send.firefox.com/">Send</a> che permette di condividere dei file crittandoli con una scadenza di un giorno.

Tutto questo lavoro non sarebbe stato possibile senza gli utenti e ai volontari che si occupano di traduzioni, supporto, segnalazioni bug e promozione. Se vuoi unirti a noi ci sono molti modi a seconda del tempo a disposizione ed il primo è usare Firefox Nightly che ti permette di avere aggiornamenti quotidiani e di poter testare nuove funzionalità prima che arrivino nella versione stabile e di segnalare eventuali problemi via bugzilla, telegram o IRC. 
Mozilla Italia è raggiungibile tramite il <a href="forum.mozillaitalia.org">forum</a> in lingua italiana ma anche la comunità internazionale è presente sul <a href="https://discourse.mozilla.org/">forum</a> dove ci sono varie sezioni dedicati ai vari progetti come <a href="https://voice.mozilla.org/">Voice</a> dedicato alla raccolta di dati vocali per migliorare il riconoscimento vocale o la nuova dedicata a <a href="http://developer.mozilla.org/">MDN</a>. 
Ti aspettiamo!