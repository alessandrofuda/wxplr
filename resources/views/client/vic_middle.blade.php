@extends('layouts.dashboard_layout')

@section('content')
	<div id="vic" class="container-fluid">
	    <div class="row vic-container">
	    	<div class="col-md-6 sx vic-middle">
		        <div class="top-heading">VIC</div>
		        <div class="sub-heading">virtual international consultant</div>
		        <div class="intro">Here to resume your journey with VIC</div>
		        @if ($vic_interrupted)
		        	<div class="">
		        		<span style="color:#5ab282;">You have an interrupted chat session</span> <a class="btn cta" href="{{ route('vic_start') }}">click here to continue</a> <br><br>
		        		<a class="btn cta light" href="{{ route('user.dashboard') }}">Return to Dashboard</a> <br><br>
		        		or generate your partials reports:
		        	</div>
		        @endif
		        <div id="chat-wrapper" class="body"></div>
		        <div class="buttons-section">
		        	<a class="btn cta light" href="{{ route('vic_preparation_report') }}">Preparation Report</a>
		        	<a class="btn cta light" href="{{ route('vic_job_hunt_report') }}">Job Hunt Report</a>
		        	<br><br>
		        	{{-- <a class="btn cta" href="#">Resume Your Journey</a> --}}
		        </div>

	        </div>
	        <div class="col-md-6 dx" style="padding-right: 0;">
	        	<img class="img-got-pro-dx" src="{{asset('frontend/images/vic/img-dx.png')}}">
	        </div>
	    </div>
	</div>
@endsection