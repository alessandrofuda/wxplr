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

	<div id="vic-report">
		<div class="intro">
			<p>Gentile {!!$name!!},<br><br>
			grazie per l’opportunità di poter costruire insieme lo sviluppo della tua carriera. In questo report troverai il riassunto dei primi quattro step del tuo percorso Career Ready: i suggerimenti del nostro VIC, le tue risposte, e dei contenuti esclusivi Wexplore, per raggiungere il risultato desiderato in linea con le tue ambizioni.
			In bocca al lupo per la tua ricerca!</p>
			<div class="slogan text-center">Ready for #YourNextChange?</div>
		</div>
		<div class="first-section">
			<div class="section-title">1) OVERVIEW DEL MERCATO DEL LAVORO IN {!! $target_country_name !!}</div>
			<div class="section-body">
				<p class="paragr-title">Breve panoramica del mercato del lavoro in {!! $target_country_name !!}</p>
				<p>I principali settori merceologici in {!! $target_country_name !!}: {!! $main_product_sectors !!}</p>
				<p>La tua selezione: {!! $your_selection_on_product_sectors !!}</p>
				<p>L’area geografica in cui ti muovi: {!! $geographic_area_where_you_move !!}</p>
				<p>La tua conoscenza della lingua locale: {!! $local_language_knowledge !!}</p>
				<p>Livello: {!! $local_language_knowledge_level !!}</p>
			</div>
		</div>
		<div class="second-section">
			<div class="section-title">2) DEFINIZIONE OBIETTIVO PROFESSIONALE</div>
			<div class="section-body">
				<p>
					Come primo passo definiremo insieme il tuo obiettivo professionale: per che ruolo ti proponi e che competenze puoi portare al tuo futuro datore di lavoro? Avere ben chiaro questo punto e presentarlo in maniera altrettanto chiara determinerà il tuo successo come candidato.<br>
					Ricordati: chi si candida a qualunque lavoro o è disposto a trasferirsi ovunque, in realtà viene dimenticato subito dopo aver letto il CV. Siamo noi che dobbiamo “risolvere” il problema del selezionatore facendogli capire come possiamo ricoprire al meglio la posizione che cerca. Non possiamo aspettarci che, tra le centinaia di CV che riceve, un selezionatore abbia voglia di capire qual è il lavoro che fa per noi…semplicemente, non è un suo problema!
				</p>
				<p>Il tuo obiettivo: {!! $your_goal !!}</p>
				<p>La tua motivazione: {!! $your_motivation !!}</p>
				<p>I ruoli per cui ti proponi: {!! $target_role !!}</p>
				<p>Il settore a cui puoi puntare: {!! $target_sector !!}</p>
				@if($modality)	
					<p>Nota: In {!! $target_country_name !!} è più {!! $modality !!} spostarsi da un settore all'altro.</p>
				@endif
				<p>Il tuo fit culturale: {!! $cultural_fit !!}. Sottolineare le somiglianze tra l’azienda target e l’ambiente in cui sei più abituato a lavorare o dove ti trovi più a tuo agio è un buon modo per essere apprezzati.</p>
				<p>I tuoi gap: {!! $gaps !!}. <br>Attenzione, questo non vuol dire che ti devi focalizzare su questi gap, ma è importante giocare d’anticipo ed esserne consapevoli, perché possono essere delle obiezioni che ti faranno a colloquio. Sapendolo, è più facile ribattere o trovare degli aspetti positivi che possono ribaltare i punti di debolezza e farli diventare dei punti di forza.</p>
			</div>
		</div>
		<div class="third-section">
			<div class="section-title">3) CV CHECK</div>
			<div class="section-body">
				<p>
					Pensa al tuo profilo come a un prodotto da vendere sul mercato: devi convincere il tuo “compratore” che sei la scelta migliore e battere la concorrenza. Oggi molte aziende stanno sperimentando metodi di selezione alternativi, dal video-CV alla selezione di idee, ma il CV tradizionale resta ancora uno strumento potente di riconoscimento.
				</p>
				<p style="font-weight: bold;">Il punteggio del tuo CV</p>
				<p>E' in formato Europass: {{ $cv_check['europass'] ? 'Si' : ($cv_check['europass'] == '0' ? 'No' : 'n.a.') }}</p>
				<p>E' scritto in lingua: {{ $cv_check['language'] ? 'Si' : ($cv_check['language'] == '0' ? 'No' : 'n.a.') }}</p>
				<p>È lungo non più di 2 pagine: {{ $cv_check['lenght'] ? 'Si' : ($cv_check['lenght'] == '0' ? 'No' : 'n.a.')  }}</p>  
				<p>Hai incluso un profilo professionale: {{ $cv_check['profile'] ? 'Si' : ($cv_check['profile'] == '0' ? 'No' : 'n.a.') }}</p> 
				<p>Hai la possibilità di inserire un indirizzo o un numero di telefono locale: {{ $cv_check['contacts'] ? 'Si' : ($cv_check['contacts'] == '0' ? 'No' : 'n.a.') }}</p> 
				<p>Il tuo ultimo job title è simile o coerente con il ruolo identificato: {{ $cv_check['informations'] ? 'Si' : ($cv_check['informations'] == '0' ? 'No' : 'n.a.') }}</p> 
				<p>È allineato con il tuo profilo LinkedIn: {{ $cv_check['linkedin'] ? 'Si' : ($cv_check['linkedin'] == '0' ? 'No' : 'n.a.') }}</p> 
				<p>Il tuo Score: {!! $cv_check_score ?? 'n.a.' !!}</p>
			</div>
		</div>
		<div class="templates-section">
			<div class="section-title underlined">Esclusiva Wexplore – Template CV Bonus</div>
			<div class="section-body">
				<div class="curriculum">
					<div class="cv-title">Scarica il template del CV in formato .DOC</div>
					<div class="cv-link"><a href="{{ url('user/vic/report/document-download/wexplore-cv-anticronologico') }}">CV ANTI-CRONOLOGICO</a></div>
					<div class="cv-link"><a href="{{ url('user/vic/report/document-download/wexplore-cv-funzionale') }}">CV FUNZIONALE</a></div>
				</div>
			</div>
		</div>
		<div class="fourth-section">
			<div class="section-title">4) Lettera di presentazione</div>
			<div class="section-body">
				<p>
					La lettera di presentazione è uno strumento di personal branding molto importante per creare un dialogo con l’azienda e valorizzare le tue motivazioni e punti di contatto con le attività previste o con il settore. Per le aziende, anche se non è un campo obbligatorio, è comunque un segnale importante e proporzionale al tuo interesse.<br>
					Per te è un modo per qualificarti e far risaltare la tua value proposition rispetto alla concorrenza: per questo è importante trovare un tuo stile personale.<br>
					Una lettera di presentazione deve necessariamente avere 2 elementi: raccontare cosa ci ha spinto a candidarci, quindi cosa ci ha colpito o affascinato dell’annuncio e raccontare le nostre qualità più rilevanti, cercando quanto più possibile dei collegamenti tra il nostro CV e l’annuncio a cui rispondiamo. 
				</p>
				<p style="font-weight: bold;">Altri elementi a cui prestare attenzione sono:</p>
				<p>- la lettera è lunga meno di una pagina: {{ $cover_letter['lenght'] ? 'Si' : ($cover_letter['lenght'] == '0' ? 'No' : 'n.a.') }}</p>
				<p>- è scritta in lingua: {{ $cover_letter['language'] ? 'Si' : ($cover_letter['language'] == '0' ? 'No' : 'n.a.') }}</p>
				<p>- hai specificato la tua intenzione di trasferirti: {{ $cover_letter['motivation'] ? 'Si' : ($cover_letter['motivation'] == '0' ? 'No' : 'n.a.') }}</p>
				<p>- hai usato aggettivi come “orientato al risultato”, “buon team player”, “flessibile” per descriverti: {{ $cover_letter['adjectives'] ? 'Si' : ($cover_letter['adjectives'] == '0' ? 'No' : 'n.a.') }}</p>
				<p>- hai evidenziato i vantaggi per l'azienda: {{ $cover_letter['advantages'] ? 'Si' : ($cover_letter['advantages'] == '0' ? 'No' : 'n.a.') }}</p>
				<p>Il tuo score: {!! $cover_letter_score ?? 'n.a.' !!}</p>
			</div>
			<div class="section-title underlined">Esclusiva Wexplore – Template Lettera Bonus</div>
			<div class="letter">
				<div class="letter-title">Scarica un modello di Lettera di Presentazione in formato .DOC</div>
				<div class="letter-link"><a href="{{ url('user/vic/report/document-download/wexplore-lettera-presentazione') }}">Scarica</a></div>
			</div>
		</div>
	</div>

@endsection