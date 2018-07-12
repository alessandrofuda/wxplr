@extends('emails.templates.layout1')



@section('content')

	<div class="consultant_class">
		Hello {{ $user->name }},<br/>
		<br/>
		PFA for your culture match pdf <br/>
		<br/>
	</div>

@endsection

