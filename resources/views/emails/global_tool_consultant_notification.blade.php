@extends('emails.templates.layout1')



@section('content')

	<div class="consultant_class">
	    Hello,<br/>
	    <br/>
	    {!! $query->consultant->name !!} has been assigned to your query
	    <br/>
	    <br/>
	</div>

@endsection