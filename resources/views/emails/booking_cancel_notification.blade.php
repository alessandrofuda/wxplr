@extends('emails.templates.layout1')



@section('content')

	<div class="body">
		Hello {{ $name }},<br/>
	    <br/>
	     Booking have been cancelled, Please make booking again, in order to see availabilities click on Calendar button.
	    <br/>
	    <a href="{{ url('consultant/'.$b_id.'/'.$type. '/calendar') }}" class="btn btn-success"><i class="fa fa-calendar"></i> Consultant Calendar</a>
	</div>

@endsection

