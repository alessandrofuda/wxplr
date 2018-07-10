@extends('emails.templates.layout1')



@section('content')


	<div class="consultant_class">
		[-- wexplore Admin notification --]<br/><br/>
	    Hello Admins,<br/>
	    <br/>
	    {!! $query->user->name !!} has submit the Country Expert Query but no matching consultant found for selected interest country and area of expertise. Please take relevant action.
	    <br/>
	    <br/>
	</div>

@endsection