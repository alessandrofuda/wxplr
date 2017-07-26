<div class="consultant_class">
Hello {{ $consultantbooking->availablity->consultant->name }},<br/>
<br/>
Your one of booking has been cancelled. Details are : <br/>
<br/>
<table>
	<tr>
		<th>User Name </th>
		<th>Booking Title</th>
		<th>Booking Date</th>
		<th>Booking Time</th>
		<th>Status</th>
	</tr>
	<tr>
		<td class="sorting_1">{{ $consultantbooking->user->name }} {{ $consultantbooking->user->surname }}</td>
		<td class="sorting_1">{{ $consultantbooking->availablity->title }}</td>
		<td class="sorting_1">{{ date('Y-m-d', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) }}</td>
		<td class="sorting_1">{{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) }} - {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::END_TIME))) }}</td>
		<td>Cancelled</td>
	</tr>
</table>
	<br/>
--  Wexplore team<br/>
</div>