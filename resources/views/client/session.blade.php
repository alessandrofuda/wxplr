@extends('front.dashboard_layout')
@section('content')
	@include('front.navigation')
<div class="container user_profile_form">
	<div class="row">
		<div class="heading">
			<h3>{{ $page_title }}</h3>
		</div>
	</div>
	<div class="row">
	<div class="col-md-12">
		<div class="meeting-btn">
			{!! \App\GoToMeeting::getButtonUrl($appointment->id) !!}

		</div>
		<img src="" />
	</div>
</div>	
</div>
@endsection