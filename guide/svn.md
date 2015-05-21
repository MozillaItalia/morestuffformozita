# SVN cheatsheet

## Clonare da server remoto

	svn clone URL
	
### Aggiornare la copia locale 

	svn up
	
Per aggiornare a una specifica revisione:

	svn up -r numero_revisione
	
	
## Controllare lo stato delle modifiche

	svn status
Per controllare lo stato aggiornato della copia remota:

	svn status -u
	
Esempio di output:


## Aggiungere un file

Per aggiungere un file che non è presente sulla copia remota

	svn add nomefile
## Invio del lavoro svolto al server

	svn commit -m "Messaggio"
	
## Ottenere informazioni utili 
	svn info
	
### Diff
Mostra le differenze con una revisione precedente.  Esempi:

	svn diff file.lang # mostra le differenze tra la versione locale e quella remota di file.lang.
	svn diff file.lang -r 122864 #Mostra le differenze tra il file locale e quello - remoto - nella sua revisione 122864

### Diff e patch

Per applicare una patch a partire da un file diff, diciamo `mod1.diff`, dalla root del progetto:

	svn patch mod1.diff

*NOTA*: se si salva il file diff copiaincollando del testo ricordarsi di controllare la codifica caratteri e il fine linea del file di origine, altrimenti viene usato quello del file diff.
	
	

	
## SVN view 

giocando con i parametri GET dell'URL è possibile ottenere diverse visualizzazioni, esempio:

	http://viewvc.svn.mozilla.org/vc?view=revision&revision=122177
	
Il parametro *view* può assumere anche questi valori:

* markup - il file viene visualizzato in una pagina HTML
* co - il file viene visualizzato in forma grezza
* diff - viene fatto il diff con una versione precedente (specificare r1 e r2 come ulteriori parametri GET)

	
	http://viewvc.svn.mozilla.org/vc/projects/mozilla.com/trunk/locales/it/lightbeam/lightbeam.lang?view=diff&pathrev=122177&r1=122176&r2=122177