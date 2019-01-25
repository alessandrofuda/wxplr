@extends('emails.templates.layout1')


@section('content')
	<div class="landing">
		Nuova richiesta di informazioni dalla Landing Page:
		<ul>
			<li>Nome: <b>{{ $firstname }}</b></li>
			<li>Cognome: <b>{{ $lastname }}</b></li>
			<li>Email: <b>{{ $email }}</b></li>
			<li>Messaggio: {{ $bodyMessage }}</li>
		</ul>
	</div>
	<br/><br/><br/><br/>

@endsection