@extends('emails.templates.layout1')



@section('content')

	<div class="body">
		[-- wexplore Admin notification --]<br/><br/>
		Hello Admins,<br/>
		<br/>
		a user selected a Country for which there isn't Consultant in database.<br/>
		<br/>
		Name: {{ $info['client_name'] }}<br/>
		Surname: {{ $info['client_surname'] }}<br/>
		E-mail: {{ $info['client_email'] }}<br/>
		(User id: {{ $info['client_id'] }})
		<br/>
		<br/>
		Selected country: <b>{{ $info['selected_country'] }}</b><br/>
		<br/>
		<br/>
		<a href="{{ url('login') }}">Wexplore</a>
		<br/>
	</div>

@endsection