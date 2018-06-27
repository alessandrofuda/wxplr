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
		Please <a href="{{ url('user/role_play_interview') }}">Click here to reply to the message</a>.
	</p>
	<p style="font-size: x-small; margin-top: 30px;">(Automatic notification. Do not reply to this e-mail. Click the link above.)</p>
	--  Wexplore team<br/>
</div>