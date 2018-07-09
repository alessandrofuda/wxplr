
@extends('emails.templates.layout1')


@section('content')


	<div class="body">
		[-- wexplore Admin notification --]<br/><br/>
		Hello,<br/>
		<br/>
		a Consultant has validated Client's Dream Check Lab form submission and given his feedback<br/>

		<br/>
		<br/>
		<b>Client</b><br/>
		Name: {{ $user['client']->name }}<br/>
		Surname: {{ $user['client']->surname }}<br/>
		E-mail: {{ $user['client']->email }}<br/>
		<br/>
		<br/>
		<b>Consultant</b><br/>
		Name: {{ $user['consultant']->name }}<br/>
		Surname:{{ $user['consultant']->surname }}<br/>
		E-mail:{{ $user['consultant']->email }}<br/>
		<br/>
		<br/>
		<a href="{{ url('login') }}">Wexplore</a>
		<br/>
	</div>


@endsection