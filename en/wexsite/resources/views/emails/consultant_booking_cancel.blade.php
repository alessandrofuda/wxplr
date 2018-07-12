@extends('emails.templates.layout1')


@section('content')

	<div class="consultant_class">
		Hello {{ $user->name }},<br/>
		<br/>
		Consultant request has been cancelled. Details are : <br/>
		<br/>

		<p>
			Consultant Name: {{ $consultantbooking->availablity->consultant->name }} {{ $consultantbooking->availablity->consultant->surname }} <br>
			Booking Title: {{ $consultantbooking->availablity->title }} <br>
			Booking Date: {{ date('Y-m-d', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) }} <br>
			Booking Time: {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) }} - {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::END_TIME))) }} <br>
			Status: Cancelled
		</p>
	</div>

@endsection



@if(isset($user->id))
	@section('unsubscribe')

		<a href="{{ UrlSigner::sign(route('delete-account', ['user_id' => $user->id ]), 7) }}" target="_blank">deleting account</a>

	@endsection
@endif