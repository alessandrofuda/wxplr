@extends('reports.layout')

@section('title')
	<div class="fullname">
		{{ $full_name }}
	</div>
	<div class="contries-wrap">
		{{ $origin_country }} - {{ $target_country_name }}
	</div>
	<div class="title">
		{!! $title !!}
	</div>
@endsection

@section('content')

	<div id="vic-report">
		<div class="intro">
			<p>Gentile {{$name}},<br><br>
			grazie per l’opportunità di poter costruire insieme lo sviluppo della tua carriera. In questo report troverai il riassunto dei primi quattro step del tuo percorso Career Ready: i suggerimenti del nostro VIC, le tue risposte, e dei contenuti esclusivi Wexplore, per raggiungere il risultato desiderato in linea con le tue ambizioni.
			In bocca al lupo per la tua ricerca!</p>
			<div class="slogan text-center">Ready for #YourNextChange?</div>
		</div>
		<div class="first-section">
			<div class="section-title">1) OVERVIEW DEL MERCATO DEL LAVORO IN {{ $target_country_name }}</div>
			<div class="section-body">
				<p class="paragr-title">Breve panoramica del mercato del lavoro in {{ $target_country_name }}</p>
				I principali settori merceologici in {{ $target_country_name }}: 
				{!! $main_product_sectors !!}
				La tua selezione: {{ $your_selection_on_product_sectors }}
				L’area geografica in cui ti muovi: {!! $geographic_area_where_you_move !!}
				La tua conoscenza della lingua locale: {!! $local_language_knowledge !!}
				Livello: {!! $local_language_knowledge_level !!}
			</div>
		</div>
		<div class="second-section">
			<div class="section-title">2) DEFINIZIONE OBIETTIVO PROFESSIONALE</div>
			<div class="section-body">
				<p>
					Come primo passo definiremo insieme il tuo obiettivo professionale: per che ruolo ti proponi e che competenze puoi portare al tuo futuro datore di lavoro? Avere ben chiaro questo punto e presentarlo in maniera altrettanto chiara determinerà il tuo successo come candidato.<br>
					Ricordati: chi si candida a qualunque lavoro o è disposto a trasferirsi ovunque, in realtà viene dimenticato subito dopo aver letto il CV. Siamo noi che dobbiamo “risolvere” il problema del selezionatore facendogli capire come possiamo ricoprire al meglio la posizione che cerca. Non possiamo aspettarci che, tra le centinaia di CV che riceve, un selezionatore abbia voglia di capire qual è il lavoro che fa per noi…semplicemente, non è un suo problema!
				</p>
				<p>Il tuo obiettivo: {{ $your_goal }}</p>
				<p>La tua motivazione: {{ $your_motivation }}</p>
				<p>I ruoli per cui ti proponi: {!! $target_role !!}</p>
				<p>I settori a cui puoi puntare: {{ '?????' }}</p>
				<p>Nota: In {{ $target_country_name }} è più {{ $modality }} spostarsi da un settore all'altro.</p>
				<p>Il tuo fit culturale: {{ $cultural_fit }}. Sottolineare le somiglianze tra l’azienda target e l’ambiente in cui sei più abituato a lavorare o dove ti trovi più a tuo agio è un buon modo per essere apprezzati.</p>
				<p>I tuoi gap: {{ $gaps }}. <br>Attenzione, questo non vuol dire che ti devi focalizzare su questi gap, ma è importante giocare d’anticipo ed esserne consapevoli, perché possono essere delle obiezioni che ti faranno a colloquio. Sapendolo, è più facile ribattere o trovare degli aspetti positivi che possono ribaltare i punti di debolezza e farli diventare dei punti di forza.</p>
			</div>
		</div>
		<div class="third-section">
			<div class="section-title">3) CV CHECK</div>
			<div class="section-body">
				<p>
					Pensa al tuo profilo come a un prodotto da vendere sul mercato: devi convincere il tuo “compratore” che sei la scelta migliore e battere la concorrenza. Oggi molte aziende stanno sperimentando metodi di selezione alternativi, dal video-CV alla selezione di idee, ma il CV tradizionale resta ancora uno strumento potente di riconoscimento.
				</p>
				<p>Il punteggio del tuo CV:</p>
				<p>Europass: {{ '???' }}</p>
				<p>Lingua: {{ '???' }}</p>
				<p>Lunghezza: {{ '???' }}</p>
				<p>Profilo: {{ '???' }}</p>
				<p>Contatti: {{ '???' }}</p>
				<p>Informazioni rilevanti: {{ '???' }}</p>
				<p>Allineamento con Linkedin: {{ '???' }}</p>
				<p>Il tuo Score: {{ '???' }}</p>
			</div>
		</div>
		<div class="fourth-section">
			<div class="section-title underlined">Esclusiva Wexplore – Template CV Bonus</div>
			<div class="section-body">
				<div class="">CV ANTI-CRONOLOGICO</div>

				<!-- page break -->
				<div class="page-break"></div>


				<div class="curriculum">
					link a curriculum tempplate in doc da downloadare (?) -
				</div>
			</div>
		</div>
		
	</div>

@endsection