<div class="">

	<p>
		Hello {{ $msg['to'] }},<br/>
		<br/>
		You have new message from {{ $msg['from'] }}:<br/>
	</p>
	<br/>

	<p><blockquote><i>{{ $msg['message'] }}</i></blockquote></p>

	<br/>
	<br/>
	<p>
		Please <a href="{{ url('consultant/availability/form#discussion') }}">reply to the message</a> or <a href="{{ url('consultant/availability/form#availability-form') }}">book now for the agreed date</a>.
	</p>
	<p style="font-size: x-small; margin-top: 30px;">(Do not reply to this e-mail)</p>
	--  Wexplore team<br/>
</div>