@extends('front.dashboard_layout')
@section('top_section')
	<h1>Dashboard<small>Services</small></h1>
	<!--<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>-->
@endsection
@section('content')
	{{-- service boxes --}}
	<div class="container">
		<div class="row">
			<div class="heading">
				<h3>{{ $page_title }}</h3>
			</div>
		</div>
		<div class="row">
			@forelse($bookings as $booking)
				<div class="col-md-4">
					<div class="box-style">
						<div class="top-stripe bckg-custom-orange"></div>
							<span class="imgblock"><img alt="{{ $booking->event->name }}" src="{{ asset($booking->event->image_file) }}"></span>
							<div class="tile-title">
								<h3>{{  $booking->event->name }}</h3>
								<h5>@if ($booking->transaction->amount == 0) Free @else Price:
									<span class="service_price">&euro;{{$booking->transaction->amount }}</span>@endif</h5>
							</div>
							<div class="hover_column">
								{!! $booking->event->description !!}
							</div>
							<div class="button-block text-center">
								<div class="hr-right"></div>
								{!! $booking->event->getJoinUrl() !!}
							</div>
					</div>
				</div>
			@empty
				<div class="no-booking">
					<h4>You have not booked any event yet.
					<a href="{{ url('/events') }}" >Browse Events/Live Webinars here</a></h4>
					</div>
				@endforelse

		</div>
	</div>
@endsection