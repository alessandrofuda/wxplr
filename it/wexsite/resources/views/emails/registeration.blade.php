<div class="registered_user">
Hello {{ $user->name }},<br/>
<br/>
Your account at Wexplore has been activated.<br/>
<br/>
You will be able to log in at <a href="{{ url('login') }}">Wexplore</a> in the future using:<br/>
<br/>
username: {{ $user->email }}<br/>
password: {{ $password }}<br/>
<br/>
--  Wexplore team<br/>
</div>