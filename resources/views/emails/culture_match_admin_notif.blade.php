@extends('emails.templates.layout1')


@section('content')


	<div class="culture_match_suvey">
		[-- wexplore Admin notification --]<br/><br/>
		Hello Admins,<br/>
		<br/>
		a user has completed the Culture Match Survey phase<br/>
		<br/>
		<br/>
		<br/>
		Name: {{ $user->name }}<br/>
		Surname: {{ $user->surname }}<br/>
		E-mail: {{ $user->email }}<br/>
		<br/>
		<br/>
		<a href="{{ url('login') }}">Wexplore</a>
	</div>


@endsection