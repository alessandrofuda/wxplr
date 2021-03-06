@extends('reports.layout')

@section('title')
	<div class="fullname">
		{!! $full_name !!}
	</div>
	<div class="contries-wrap">
		{!! $origin_country !!} - {!! $target_country_name !!}
	</div>
	<div class="title">
		{!! $title !!}
	</div>
@endsection

@section('content')
	<div id="vic-report second-part">
		<div class="intro">
			<p>Gentile {!! $name !!},<br><br>
			grazie per l’opportunità di poter costruire insieme lo sviluppo della tua carriera. In questo report troverai il riassunto della seconda parte del tuo percorso Career Ready: i suggerimenti del nostro VIC, le tue risposte, e dei contenuti esclusivi Wexplore, per raggiungere il risultato desiderato in linea con le tue ambizioni.<br>
			In bocca al lupo per la tua ricerca!</p>
			<div class="slogan text-center">Ready for #YourNextChange?</div>
		</div>
		<div class="fifth-section">
			<div class="section-title">5) IL PROCESSO DI RICERCA: TIPS & TRICKS</div>
			<div class="section-body">
				<p>Ricapitoliamo: abbiamo reso evidente il tuo obiettivo professionale sul CV e raccontato la tua motivazione e i tuoi punti di forza o di contatto con una ricerca nella lettera di presentazione. Adesso è il momento di andare in scena e vedere se questi strumenti funzionano nel modo giusto.</p>
				<p>Dopo aver completato le fasi di preparazione, passiamo alla “caccia”. </p>
				<p>Prima di fiondarti su internet, fermati un attimo. Lo sapevi che ci sono diversi strumenti a tua disposizione per cercare opportunità in {!! $target_country_name !!}? Te li presenterò man mano così potrai sapere come meglio utilizzarli.</p>
				<p>C’è una cosa importante che devi decidere con te stesso adesso che stai iniziando a muoverti sul mercato, ed è: quanto tempo hai a disposizione?</p>
				<p>Mi spiego meglio: solitamente, da quando si inizia a “seminare” il proprio CV, ci vogliono circa 4-6 mesi per avere un’offerta di lavoro, questo perché un processo di selezione di un’azienda prevede diversi step e tra un colloquio e l’altro possono passare diversi giorni o anche settimane.</p>
				<p>In assenza di riscontri, o se una selezione si trascina, può essere molto facile scoraggiarsi, cominciare a pensare “non vado bene” e “non ce la farò mai” e pensare di accettare anche opportunità che non rispondono al nostro obiettivo.</p>
				<p>Soprattutto se pensi di trasferirti in {!! $target_country_name !!}, è importante che tu non ci vada “accontentandoti”. Definisci quindi la scadenza che più risponde alle tue esigenze: quello è un patto con te stesso e prima di questa data punterai solo a ottenere il ruolo che desideri.</p>
				<p>Ora basta parlare, passiamo all’azione: andiamo a vedere come puoi ottenere il tuo obiettivo.</p>
			</div>
		</div>
		<div class="search-channel one">
			<div class="section-title">1) CANALE DI RICERCA 1: GLI HEAD HUNTER </div>
			<div class="section-body">
				<p>Gli headhunter o società di selezione sono società esterne a cui le aziende affidano delle ricerche, solitamente per profili con competenze specifiche o quando devono assumere grandi volumi.</p>
				<p>Magari ti è già capitato di incontrarli. Capiamo insieme come lavorano e come possono esserci utili.</p>
				<p>
					<ul> 
						<li>Queste società consentono di entrare direttamente in contatto con le aziende. Una società di selezione è un alleato prezioso, perché agisce su mandato diretto di un’azienda cliente. Questo vuol dire che c’è un’esigenza specifica e reale a cui possiamo rispondere. Attenzione però: può capitare che un’azienda cambi idea, cambi esigenze o prenda una persona dall’interno e in quel caso l’opportunità sarà sfumata! Ecco perché conviene sempre seminare il più possibile.</li>
						<li>Uno dei vantaggi è poter avere informazioni sull’azienda e dei feedback sul processo di selezione. Il selezionatore agisce come tramite tra l’azienda e i candidati che presenta, conosce pregi e difetti di entrambi e coordina il processo. Questo può essere sfruttato a nostro vantaggio: possiamo chiedergli di capire meglio l’ambiente di lavoro, la cultura aziendale, le caratteristiche del team e del futuro capo per essere più preparati per il colloquio. A posteriori, possiamo anche insistere per avere un feedback sull’incontro in azienda, così da avere più visibilità sulla nostra posizione e più in generale per migliorare sempre di più la nostra performance nei colloqui. Non aver timore o imbarazzo a chiedere queste informazioni al selezionatore: in questo momento i vostri obiettivi coincidono.</li>
						<li>Il loro lavoro è trovare la persona che l’azienda loro cliente possa assumere, quindi non hanno assolutamente l’obbligo di supportarti o di segnalarti su altre posizioni. L’unico caso in cui lo faranno è per quella che viene chiamata “tentata vendita”, ossia per provare a portarsi a casa un nuovo cliente. Certo, se questo risulta in un contratto per te, ben venga, ma non aspettarti che lo facciano se non hanno la possibilità di guadagnare dal tuo profilo</li>
						<li>Risentono, in parte, della concorrenza delle job board. L’aumento di strumenti digitali ha creato molta più disintermediazione tra domanda e offerta, e per le aziende utilizzare Internet ha comunque dei costi di gran lunga inferiori. Le situazioni in cui invece per un’azienda è più conveniente e competitivo incaricare un headhunter sono per professionalità particolari o molto elevate, per location nuove o poco conosciute dall’azienda, o per situazioni di inserimento urgente.</li>
						<li><span class="italic">"Sono il primo canale a cui un’azienda si rivolge per assumere qualcuno"</span>. {!! $are_first_channel !!}</li>
						<li><span class="italic">"Ho già inviato il mio CV per un’altra offerta, ormai sono nel loro database e non è necessario che mi faccia vivo di nuovo"</span>. Perderesti un’opportunità. Non è affatto scontato che il tuo CV venga recuperato dal database o condiviso tra colleghi di diverse divisioni o uffici. Quindi invialo pure tutte le volte che sarà necessario, magari – questo sì – adattando la lettera di presentazione alla nuova job.</li>
						<li>{!! $are_specialized !!}. Quindi è importante individuare gli headhunter che seguono le selezioni e gestiscono un portafoglio clienti più in linea con il tuo profilo e con l’obiettivo. Come? Qualche suggerimento te lo darò io tra pochissimo, per avere ancora più opzioni prova con una ricerca su Google o LinkedIn inserendo le voci “headhunter” “la tua area funzionale” “la città in {!! $target_country_name !!} a cui sei interessato”.</li>
						<li>Non tutti pubblicano sempre offerte di lavoro, e soprattutto non tutti le pubblicano su LinkedIn o sulle job board. Per questo è importante tenere monitorati i loro siti, per intercettare le posizioni che interessano</li>
						<li>Posso contattarli tramite LinkedIn, ti consiglio comunque di procedere per contatti mirati, magari per rinforzare una candidatura già fatta sottolineando le tue motivazioni. Una richiesta di contatto generica del tipo “sto cercando lavoro e vorrei entrare in contatto con lei” è solitamente poco produttiva.</li>
					</ul>
				</p>
				<p>{!! $useful_sites_head_hunter !!}</p>
			</div>
		</div>
		<div class="search-channel two">
			<div class="section-title">2) CANALE DI RICERCA 2: LE JOB BOARD</div>
			<div class="section-body">
				<p>Le job board sono quei siti che vengono usati dalle aziende per pubblicare le loro ricerche e rappresentano uno dei canali più utilizzati da professionisti di tutto il mondo. Vediamo insieme se li hai usati nel modo giusto.</p>
				<p>
					<ul> 
						<li>Gli annunci mi permettono di capire quali sono le realtà che stanno davvero assumendo. Quello che voglio dire è: se vedi un’azienda che sta assumendo molto, a prescindere dalle posizioni che pubblica in quel momento, può essere una realtà interessante da contattare proponendosi spontaneamente, per anticipare future esigenze legate alla sua crescita.</li>
						<li>È importante la tempestività nel rispondere a un annuncio. Un selezionatore riceve centinaia di CV per ogni posizione, e spesso lavora su tempi molto stretti, quindi comincerà a portarsi avanti con lo screening dopo i primi 2-3 giorni. Se tra i primi CV che esamina ne trova già una ventina interessanti, comincerà a contattarli. Quindi ricordati: ritmo costante e mouse veloce!</li>
						<li><span class="italic">"Una volta risposto, posso solo aspettare che mi rispondano"?</span>  Certo, sarebbe la strada più facile e comoda... ma a volte basta un piccolo e garbato messaggio (se chi segue la ricerca è specificato in chiaro) per distinguersi dalla massa e magari sbloccare una selezione che non stava andando avanti. Alle aziende fanno piacere i candidati motivati e intraprendenti, quindi non avere paura.</li>
						<li><span class="italic">"Dedico molto tempo a cercare annunci online perché è lo strumento più efficace per raggiungere il mio obiettivo"</span>. Non è così invece, dammi retta. Gli annunci online sono lo strumento più accessibile e facile da usare, ma proprio per questo sono anche il canale più “congestionato”, dove troviamo più concorrenza. Ti sarà capitato di vedere annunci con 400 candidature già dopo 1 giorno. Per aumentare l’efficacia ti conviene lavorare di sponda con il network: dopo esserti candidato, fai follow up direttamente con l’hiring manager, o verifica se un tuo contatto ti può segnalare.</li>
						<li>È molto utile tenere traccia di tutti gli annunci a cui mi candido. Te lo consiglio assolutamente. Quando gli annunci si accumuleranno, ti servirà per fare mente locale quando ti chiamerà un’azienda (ed evitare la pessima risposta “quale offerta? Non me la ricordo…”), ma anche a migliorare man mano. Basta un file Excel con: nome posizione, nome azienda, link all’annuncio, data in cui si è risposto e feedback ricevuti. Trovi un template qui sotto. </li>
						<li>Vale la pena provare a rispondere anche se il mio profilo non è del tutto centrato o se mi mancano alcune delle competenze richieste. Fai bene a buttarti. Molto spesso le job description sono delle linee guida delle caratteristiche principali e cercare una corrispondenza perfetta sarebbe davvero limitante. Una buona linea di demarcazione è il 70% di match. Attenzione però: i requisiti indicati come “essenziali” devono esserci al 100%.</li>
					</ul>
				</p>
				<p>Siti utili da cui partire a cercare:</p>
				<p>{!! $useful_sites_job_board !!}</p>
			</div>
			<div class="templates-section">
				<div class="section-title underlined">Bonus Wexplore: template tabella per monitoraggio annunci</div>
				<div class="section-body">
					<div class="track-table">
						{{-- <div class="track-table-link">
							<a href="{{ url('user/vic/report/document-download/track-advices-table') }}" target="_blank">Scarica il template della tabella in formato .DOC</a>
						</div> --}}
						<table border="1" width="100%">
							<thead>
								<tr>
									<th>Posizione</th>
									<th>Azienda</th>
									<th>Link ad annuncio</th>
									<th>Data di Application</th>
									<th>Contatto (se presente)</th>
									<th>Feedback</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
								</tr>
								<tr>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
								</tr>
								<tr>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="search-channel three">
			<div class="section-title">3) CANALE DI RICERCA 3: IL NETWORK</div>
			<div class="section-body">
				<p>È il canale più potente ed efficace di tutti, ma quello più difficile da usare, soprattutto se non siamo fisicamente in {!! $target_country_name !!}: come facciamo a entrare “casualmente” in contatto con aziende interessanti o a scambiare biglietti da visita senza dover salire su un aereo ogni volta?</p>
				<p>Niente paura, c’è una soluzione per tutto, ma prima disambiguiamo insieme un po’ di falsi miti sul network:</p>
				<p>
					<ul> 
						<li>Posso usare LinkedIn per fare networking. È fatto apposta! Ovviamente dipende da come lo usi: la cosa fondamentale è motivare e personalizzare sempre la richiesta di contatto, magari facendo riferimento a un confronto professionale o alla expertise del contatto in un settore e non al “cerco lavoro” puro e semplice. Inoltre, anche partecipare attivamente a discussioni e gruppi o seguire alcune figure di spicco è molto utile a farsi conoscere.</li>
						<li>Lo scopo del networking non è chiedere un lavoro ai propri contatti, ma piuttosto di ottenere nuovi contatti vantaggiosi e informazioni utili su cosa avviene in determinate aziende. Questo vuol dire che è un gioco che possiamo giocare alla pari: anche noi abbiamo informazioni o spunti interessanti da condividere grazie al percorso che abbiamo fatto, quindi possiamo a nostra volta essere utili ai nostri interlocutori…ci hai mai pensato? E inoltre, tieniti forte: non stiamo elemosinando un lavoro, ma possiamo essere la soluzione ai problemi di qualcuno. In un mercato dove il 45% dei datori di lavoro fatica a trovare le competenze di cui ha bisogno, anche chi ci segnala ad un’azienda può fare bella figura grazie a noi!</li>

						<li><span class="italic">"Non conosco nessuno, soprattutto in {!! $target_country_name !!}!"</span>: Pensare ai primi nomi che ci vengono in mente può essere sicuramente sconfortante: scommetto che dopo i primi 5 o 6 ti sei arreso vero? Prova invece a metterli per iscritto con calma, e magari a raggrupparli con calma. Nel report che riceverai troverai dei suggerimenti, ma sono sicuro che resterai stupito dal risultato. E soprattutto, ricorda: non devi pensare solo a chi ti può dare un lavoro, perché stai limitando le tue possibilità. Prova invece a pensare chi ti può presentare qualcun altro in {!! $target_country_name !!}. Un ex collega? Una compagna di Erasmus? Il fratello del tuo compagno di allenamenti in palestra? Più riesci ad allargare il giro, più sarà facile muoverti.</li>
						<li>È passata una settimana e non mi hanno ancora fatto sapere niente, non insisto oltre</li>
						<li>L’obiettivo del networking non è parlare con chi sta assumendo. Nulla di più sbagliato, anzi, rischiamo di addossare all’altro una responsabilità molto scomoda. Il network serve principalmente per conoscere altre persone in maniera finalizzata o avere informazioni utili per il nostro obiettivo. Per questo è un’attività da coltivare in maniera costante nel tempo e non tartassando le persone dopo anni di silenzio solo quando ci serve. </li>
					</ul>
				</p>
				<p>{!! $useful_sites_networking !!}</p>
			</div>
			<div class="templates-section">
				<div class="section-title underlined">Bonus Wexplore: network maps</div>
				<div class="section-body">
					<div class="section-title underlined">Mappa Mentale</div>
					<div class="mental-map" style="text-align: center;">
						<img class="" src="{{ public_path('frontend/images/reports/mental-map.png') }}"> 
					</div>
					<div class="section-title underlined">Checklist</div>
					<div class="checklist">
						<table border="1" width="100%">
							<thead>
								<tr>
									<th>Personal</th>
									<th>Professional</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Friends and acquaintances</td>
									<td>Colleagues from your previous job(s)</td>
								</tr>
								<tr>
									<td>Friends of friends</td>
									<td>Retired colleagues</td>
								</tr>
								<tr>
									<td>Relatives</td>
									<td>Clients</td>
								</tr>
								<tr>
									<td>School/University</td>
									<td>Suppliers</td>
								</tr>
								<tr>
									<td>Neighbours</td>
									<td>Consultants</td>
								</tr>
								<tr>
									<td>Interests/hobbies group</td>
									<td>Members of professional associations</td>
								</tr>
								<tr>
									<td>Gym/sports clubs</td>
									<td>Outlook address book/LinkedIn contacts</td>
								</tr>
								<tr>
									<td>Doctor, dentist, bank director, tax attorney</td>
									<td>Contacts during events/forums…</td>
								</tr>
								<tr>
									<td>Contacts of contacts</td>
									<td>Contacts of contacts</td>
								</tr>
								<tr>
									<td>...</td>
									<td>...</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="section-title underlined">Profiling</div>
					<div class="profiling-table">
						<table border="1" width="100%" style="font-size: 14px;">
							<thead>
								<tr>
									<th>Name</th>
									<th>Role/Position</th>
									<th>Strength of relationship*</th>
									<th>Usefulness*</th>
									<th>Reason for contacting</th>
									<th>Kind of support</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
								</tr>
								<tr>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
								</tr>
								<tr>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
									<td>...</td>
								</tr>
							</tbody>
						</table>
						<p>* su una scala da 1 a 5, dove 1 è minimo e 5 è il massimo </p>
						<br><br>
						<p style="font-weight: bold;">Il tuo score: <span style="color: #239e9e;">{!! $score !!}</span></p>
					</div>
				</div>
			</div>
		</div>
		<div class="search-channel four">
			<div class="section-title">4) IL COLLOQUIO: DOMANDE E ASPETTATIVE</div>
			<div class="section-body">
				<p>Complimenti! Il colloquio è uno dei momenti chiave della tua ricerca… e scommettiamo che con la giusta preparazione può anche essere una chiacchierata piacevole e divertente?</p>
				<p>Ricordati sempre che dovrai “venderti” e raccontarti al meglio in una lingua che non è la tua: anche se la parli molto bene, mi è capitato di parlare con altre persone che si sono bloccate sul più bello perché non gli veniva la parola giusta o non trovavano l’esempio migliore per rispondere a una domanda.</p>
				<p>Ti svelerò un piccolo trucco per prevenire queste situazioni e stupire il selezionatore: si chiama metodo STAR e serve proprio per brillare al massimo. Fidati di me, questo è un metodo collaudatissimo per riportare alla memoria quei “casi di successo” che potrai tirare fuori a colloquio. Proviamo a farne uno insieme, ma ricordati che nel report troverai questo stesso template e potrai usarlo quante vuole vorrai.</p>

				<div class="star-method">
					<table class="star-table" width="100%" border="1" style="margin-top: 30px; margin-bottom: 40px;">
						<tr>
							<td>
								<span class="bold">S</span> (Situation – Contesto della situazione)<br><br>
								{!! $star['s'] !!}
							</td>
						</tr>
						<tr>
							<td>
								<span class="bold">T</span> (Task - Problema da risolvere - Obiettivo da raggiungere)<br><br>
								{!! $star['t'] !!}
							</td>
						</tr>
						<tr>
							<td>
								<span class="bold">A</span> (Actions - Azioni)<br><br>
								{!! $star['a'] !!}
							</td>
						</tr>
						<tr>
							<td>
								<span class="bold">R</span> (Results – Risultati ottenuti)<br><br>
								{!! $star['r'] !!}
							</td>
						</tr>
					</table>
				</div>

				<p>
					Il colloquio è uno dei momenti con la più alta variabile umana: ciascuna azienda può utilizzare strumenti diversi (come un assessment di gruppo, dei test psicoattitudinali, dei business case da risolvere e presentare) nelle varie fasi della selezione. Inoltre, ciascun selezionatore può focalizzarsi su alcuni aspetti in particolare del vostro profilo e/o del vostro carattere. Tuttavia, essere in grado di citare degli episodi specifici è qualcosa di universalmente apprezzato.
				</p>
				<p>In generale poi, posso dirti che la cultura in {!! $target_country_name !!} apprezza particolarmente alcuni tipi di comportamento, ad esempio:</p>
				<p>{!! $final_recommendations !!}</p>
				<p>{!! $goodluck !!}</p>
			</div>
		</div>
	</div>
@endsection