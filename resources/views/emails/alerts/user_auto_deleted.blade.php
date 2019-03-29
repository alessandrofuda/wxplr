@extends('emails.templates.layout1')



@section('content')

	<div class="alerts">
		[-- wexplore Admin notification --]<br/><br/>
		<p>Hello Admins,<br/>
		A user has auto-deleted his account from Wexplore service.</p>
		<br/>
		<p>Here below user's informations:<br/>

			Id: {{ $user->id }}<br/>
			Name: {{ $user->name }}<br/>
			Surname: {{ $user->surname }}<br/>
			Email: {{ $user->email }}<br/>
			Cancellation date: {{ $user->deleted_at }}<br/>

		</p>
		<br/>
		<a href="{{ url('login') }}">Wexplore</a>
		<br/>
	</div>

@endsection