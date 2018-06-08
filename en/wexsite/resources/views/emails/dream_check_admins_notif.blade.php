<div class="dream_check_lab">
	Hello,<br/>
	<br/>
	a user submitted the Dream Check Lab form and matched with a Consultant<br/>

	<br/>
	<br/>
	<b>User</b><br/>
	Name: {{ $user['client']->name }}<br/>
	Surname: {{ $user['client']->surname }}<br/>
	E-mail: {{ $user['client']->email }}<br/>
	<br/>
	<br/>
	<b>Consultant</b><br/>
	Name: {{ $user['consultant']->name }}<br/>
	Surname:{{ $user['consultant']->surname }}<br/>
	E-mail:{{ $user['consultant']->email }}<br/>
	<br/>
	<br/>
	<a href="{{ url('login') }}">Wexplore</a>
	<br/>
	-- wexplore Admin notification
</div>