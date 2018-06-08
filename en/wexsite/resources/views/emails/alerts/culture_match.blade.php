<div class="alerts">
	Hello,<br/>
	<br/>
	after {{ $data['daysago'] }} days from registration, one or more users have NOT completed yet "{{ $data['phase'] }}" step.<br/>

	<br/>
	<br/>
	Here User list:<br/>

	@foreach ($data['users'] as $user)

		Name: {{ $user['name']}}<br/>
		Surname: {{ $user['surname']}}<br/>
		E-mail: {{ $user['email']}}<br/>
		<br/>
		<br/>

	@endforeach
	
	
	<br/>
	<a href="{{ url('login') }}">Wexplore</a>
	<br/>
	-- wexplore Admin notification
</div>