<div class="consultant_class">
	Hello {{ $consultantbooking->availablity->consultant->name }},<br/>
	<br/>
	You have got one booking request from user. Details are : <br/>
	<br/>
	<p>
		User Name: {{ $consultantbooking->user->name }} {{ $consultantbooking->user->surname }} <br>
		Booking Title: {{ $consultantbooking->availablity->title }} <br>
		Booking Date: {{ date('Y-m-d', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::DATE))) }} <br>
		Booking Time: {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) }} - {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::END_TIME))) }} <br>
	</p>

	<br/>
	--  Wexplore team<br/>
</div>
