<div class="">

	<p>
		Hello {{ $msg['to'] }},<br/>
		<br/>
		You have new message from {{ $msg['from'] }} Consultant:<br/>
	</p>
	<br/>

	<p><blockquote><i>{{ $msg['message'] }}</i></blockquote></p>

	<br/>
	<br/>
	<p>
		Please <a href="{{ url('user/role_play_interview') }}">Click here and reply to message</a>.
	</p>
	--  Wexplore team<br/>
</div>