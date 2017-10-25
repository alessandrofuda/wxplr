<div class="">

	<p>
		Hello {{ $msg['to'] }},<br/>
		<br/>
		You have new message from {{ $msg['from'] }}:<br/>
	</p>
	<br/>

	<p class="" style="font-style: italic;"><blockquote>{{ $msg['message'] }}</blockquote></p>

	<br/>
	<br/>
	<p>
		Please <a href="{{ url('consultant/availability/form#discussion') }}">reply to the message</a> or <a href="{{ url('consultant/availability/form#availability-form') }}">book now for the agreed date</a>.
	</p>
	--  Wexplore team<br/>
</div>