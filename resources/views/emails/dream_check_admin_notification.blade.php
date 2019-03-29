@extends('emails.templates.layout1')


@section('content')

	<div class="body">
		[-- wexplore Admin notification --]<br/><br/>
	    Hello Admins,<br/>
	    <br/>
	    {!! $user_array['user_name'] !!} has submit the Dream Check Lab form but no matching consultant found for selected interest country. Please take relevant action {!! link_to_route('dream.check.lab.assign.consultant', 'here', $data['dream_check_lab_id'], array('class' => 'btn btn-default')) !!}.
	    <br/>
	    <br/>
	</div>

@endsection
