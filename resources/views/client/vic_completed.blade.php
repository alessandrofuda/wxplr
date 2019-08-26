@extends('layouts.dashboard_layout')

@section('content')
	<div id="vic" class="container-fluid">
	    <div class="row vic-container">
	    	<div class="col-md-6 sx vic-middle">
		        <div class="top-heading">VIC</div>
		        <div class="sub-heading">virtual international consultant</div>
		        <div class="intro">you are ready to go</div>
		        <div id="chat-wrapper" class="body">Hai completato il percorso e lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd</div>
		        <div class="buttons-section">
		        	<a class="btn cta light" href="#">CV Report</a>
		        	<a class="btn cta light" href="#">Interview Report</a>
		        	<br><br>
		        	<a class="btn cta" href="#">Transfer Report</a>   ??
		        	<a class="" href="#">go to chat</a>  ??
		        </div>

	        </div>
	        <div class="col-md-6 dx" style="padding-right: 0;">
	        	<img class="img-got-pro-dx completed" src="{{asset('frontend/images/vic/completed.png')}}">
	        </div>
	    </div>
	</div>
@endsection