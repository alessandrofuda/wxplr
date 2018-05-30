<div class="no_consult_found_for_matching">
	Hello,<br/>
	<br/>
	A user selected a Country for which there isn\'t Consultant in database.<br/>

	<br/>
	<br/>
	User:<br/>
	Name: {{ $info['client_name'] }}<br/>
	Surname: {{ $info['client_surname'] }}<br/>
	E-mail: {{ $info['client_email'] }}<br/>
	(id: {{ $info['client_id'] }})
	<br/>
	<br/>
	Selected country: {{ $info['selected_country'] }}<br/>
	<br/>
	<br/>
	<a href="{{ url('login') }}">Wexplore</a>
	<br/>
	-- wexplore Admin notification
</div>