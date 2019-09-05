@extends('layouts.dashboard_layout')

@section('content')
	<div id="vic" class="container-fluid">
	    <div class="row vic-container">
	    	<div class="col-md-6 sx vic-middle">
		        <div class="top-heading">VIC</div>
		        <div class="sub-heading">virtual international consultant</div>
		        <div class="intro">Click here to resume your journey with VIC</div>
		        <div id="chat-wrapper" class="body"></div>
		        <div class="buttons-section">
		        	<a class="btn cta light" href="#">Preparation Report</a>
		        	<a class="btn cta light" href="#">Job Hunt Report</a>
		        	<br><br>
		        	<a class="btn cta" href="#">Resume Your Journey</a>
		        </div>

	        </div>
	        <div class="col-md-6 dx" style="padding-right: 0;">
	        	<img class="img-got-pro-dx" src="{{asset('frontend/images/vic/img-dx.png')}}">
	        </div>
	    </div>
	</div>
@endsection