<div class="consultant_class">
	Hello {{ $user->name }},<br/>
	<br/>
	You have booked consultant. Details are: <br/>
	<br/>
	<p>
		Consultant Name: {{ $consultantbooking->availablity->consultant->name }} {{ $consultantbooking->availablity->consultant->surname }} <br>
		Booking Title: {{ $consultantbooking->availablity->title }} <br>
		Booking Date: {{ date('Y-m-d', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::DATE))) }} <br>
		Booking Time: {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) }} - {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::END_TIME))) }} <br>
	</p>

	<br/>
	--  Wexplore team<br/>
</div>
