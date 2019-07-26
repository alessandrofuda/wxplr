@extends('layouts.dashboard_layout')

@section('content')
	<div id="got-pro" class="container-fluid">
	    <div class="row got-pro-container">
	    	<div class="col-md-6 sx">
		        <div class="top-heading">Got Pro</div>
		        <div class="sub-heading">global orientation test PRO</div>
		        <div class="intro">Take your journey one step further with our GOT Pro</div>
		        <div class="body">
		        	Our virtual consultant will guide you through a customized profiling to find out exactly where in Europe your profile is most in demand. Find out your top 3 destinations and allow your talent to shine!
		        </div>
		        <div class="buttons-section">
		        	@if ($payed === true)
		        		<a class="btn cta" href="#">Start</a>
		        	@else
		        		<a class="btn cta" href="{{route('service_payment_direct', [ 'service_id' => $service_id ])}}">Buy for {{$price}}€</a>

		        		@include('partials.got-pro.how_it_works_modal')

		        	@endif
		        </div>

	        </div>
	        <div class="col-md-6 dx" style="padding-right: 0;">
	        	<img class="img-got-pro-dx" src="{{asset('frontend/images/got-pro/green-world.png')}}">
	        </div>
	    </div>
	</div>
@endsection