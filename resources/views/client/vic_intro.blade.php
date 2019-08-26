@extends('layouts.dashboard_layout')

@section('content')
	<div id="vic" class="container-fluid">
	    <div class="row vic-container">
	    	<div class="col-md-6">
		        <div class="top-heading">Vic</div>
		        <div class="sub-heading">virtual international consultant</div>
		        <div class="intro">your best ally to walk you through an international job search journey</div>
		        <div class="body">
		        	You will find market information, tips on how to adjust your CV and cover letter, plenty of insights on application and interview techniques, compensation and contract benchmark.
		        </div>
		        <div class="buttons-section">
		        	@if ($payed === true)
		        		<a class="btn cta" href="{{route('vic_start')}}">Start</a>
		        	@else
		        		<a class="btn cta" href="{{route('service_payment_direct', [ 'service_id' => $service_id ])}}">Buy for {{$price}}€</a>

		        		@include('partials.vic.how_it_works_modal')

		        	@endif
		        </div>

	        </div>
	        <div class="col-md-6" style="padding-right: 0;">
	        	<img class="img-vic-dx" src="{{asset('frontend/images/vic/img-dx.png')}}">
	        </div>
	    </div>
	</div>
@endsection