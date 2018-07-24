@extends('emails.templates.layout1')


@section('content')

	<div class="body">
		Hello {{ $user->name }},<br/>
		<br/>
		You have booked consultant. Details are: <br/>
		<br/>
		<p>
			<b>Consultant Name</b>: {{ $consultantbooking->availablity->consultant->name }} {{ $consultantbooking->availablity->consultant->surname }} <br>
			<b>Booking Title</b>: {{ $consultantbooking->availablity->title }} <br>
			<br>
			<b>Booking Date</b>: {{ date('Y-m-d', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::DATE))) }} <br>
			<b>Booking Time</b>: {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) }} - {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::END_TIME))) }} <br>
		</p>
	</div>

@endsection


@if(isset($user->id))
	@section('unsubscribe')

		<a href="{{ UrlSigner::sign(route('delete-account', ['user_id' => $user->id ]), 7) }}" target="_blank">deleting account</a>

	@endsection
@endif