@extends('emails.templates.layout1')



@section('content')

	<div class="registered_user">
		[-- wexplore Admin notification --]<br/><br/>
		Hello Admins,<br/>
		<br/>
		a new account at Wexplore has been activated.<br/>
		<br/>
		<br/>
		<br/>
		Name: {{ $user->name }}<br/>
		Surname: {{ $user->surname }}<br/>
		E-mail: {{ $user->email }}<br/>
		<br/>
		<br/>
		<a href="{{ url('login') }}">Wexplore</a>
		<br/>
	</div>

@endsection