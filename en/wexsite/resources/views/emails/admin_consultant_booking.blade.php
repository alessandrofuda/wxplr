<div class="consultant_class">
Hello Admin,<br/>
<br/>
New consultant booking request has been made, Details are : <br/>
<br/>
<table>
	<tr>
		<th>Consultant Name </th>
		<th>User Name </th>
		<th>Booking Title</th>
		<th>Booking Date</th>
		<th>Booking Time</th>
	</tr>
	<tr>
		<td class="sorting_1">{{ $consultantbooking->availablity->consultant->name }} {{ $consultantbooking->availablity->consultant->surname }}</td>
		<td class="sorting_1">{{ $consultantbooking->user->name }} {{ $consultantbooking->user->surname }}</td>
		<td class="sorting_1">{{ $consultantbooking->availablity->title }}</td>
		<td class="sorting_1">{{ date('Y-m-d', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::DATE))) }}</td>
		<td class="sorting_1">{{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) }} - {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::END_TIME))) }}</td>
	</tr>
</table>
	<br/>
--  Wexplore team<br/>
</div>`
