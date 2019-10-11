@extends('layouts.dashboard_layout')

@section('content')
	<div id="vic" class="container-fluid">
	    <div class="row vic-container">
	    	<div class="col-md-6 sx vic-middle">
		        <div class="top-heading">VIC</div>
		        <div class="sub-heading">virtual international consultant</div>
		        <div class="intro">you are ready to go</div>
		        <div id="chat-wrapper" class="body">
		        	<div class="citation">
		        		<span class="cit-text">Choose a job you love, and you will never have to work in your entire life</span> – Confucius
		        	</div>
		        	<div class="completed-description">
		        		You have completed your journey with VIC and are now ready to take off and start a new and exciting journey in your professional life. <br>We wish you fun, challenges, learning, and fulfillment. <br>And for any “down” moments, let us know if we can lift you up again – after all, we are the wings that make your goals fly higher!
		        	</div>
			        <div class="buttons-section">
			        	<a class="btn cta report loading-report" href="{{ route('vic_preparation_report') }}">Preparation Report</a>
			        	<a class="btn cta report loading-report" href="{{ route('vic_job_hunt_report') }}">Job Hunt Report</a>
			        	<br><br>
			        	{{-- <a class="btn cta" href="{{ route('vic_take_off_report') }}">Take Off Report</a> --}}
			        	{{-- <a class="" href="#">go to chat</a>  ?? --}}
			        </div>
	        	</div>
	        </div>
	        <div class="col-md-6 dx" style="padding-right: 0;">
	        	<img class="img-got-pro-dx completed" src="{{asset('frontend/images/vic/completed.png')}}">
	        </div>
		</div>
	</div>
@endsection