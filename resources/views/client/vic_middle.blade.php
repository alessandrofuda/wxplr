@extends('layouts.dashboard_layout')

@section('content')
	<div id="vic" class="container-fluid">
	    <div class="row vic-container">
	    	<div class="col-md-6 sx vic-middle">
		        <div class="top-heading">VIC</div>
		        <div class="sub-heading">virtual international consultant</div>
		        <div class="intro">Here to resume your journey with VIC</div>

		        @if ($vic_interrupted)
		        	<div class="" style="margin-bottom: 50px;">
		        		<i class="text-danger">You have an interrupted chat session</i><br/><br/>
		        		<a class="btn cta" href="{{ route('vic_start') }}">Click here to continue the chat</a> <br><br>
		        		<a class="btn cta light" href="{{ route('user.dashboard') }}">Return to Dashboard</a> <br><br>
		        	</div>
		        	<p>For the moment, you can generate your <b>partials</b> reports:</p>
		        	<a class="btn cta light loading-report" href="{{ route('vic_preparation_report') }}">Partial<br/>Preparation Report</a>
		        	<a class="btn cta light loading-report" href="{{ route('vic_job_hunt_report') }}">Partial<br/>Job Hunt Report</a>
		        	<br><br>
		        @else
		        	<script>
		        		window.location.href = "{{ route('vic_completed') }}";
		        	</script>
		        @endif
		        <!--div id="chat-wrapper" class="body"></div-->
		        <div class="buttons-section">
		        	{{-- <a class="btn cta" href="#">Resume Your Journey</a> --}}
		        </div>
	        </div>
	        <div class="col-md-6 dx" style="padding-right: 0;">
	        	<img class="img-got-pro-dx" src="{{asset('frontend/images/vic/img-dx.png')}}">
	        </div>
	    </div>
	</div>
@endsection