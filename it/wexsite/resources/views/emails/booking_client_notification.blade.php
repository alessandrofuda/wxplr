<div class="consultant_class">
Hello {{ $consultantbooking->user->name }},<br/>
<br/>
	You have appointment, Please login 5 to 10 minutes before time: <br/>
<br/>
<table>
	<tr>
		<th>User Name </th>
		<th>Booking Title</th>
		<th>Booking Date</th>
		<th>Booking Time</th>
	</tr>
	<tr>
		<td class="sorting_1">{{ $consultantbooking->user->name }} {{ $consultantbooking->user->surname }}</td>
		<td class="sorting_1">{{ $consultantbooking->availablity->title }}</td>
		<td class="sorting_1">{{ date('M d, Y',$consultantbooking->availablity->available_date ) }}</td>
		<td class="sorting_1">{{ $consultantbooking->availablity->available_start_time }} - {{ $consultantbooking->availablity->available_end_time }}</td>	
	</tr>
</table>
	<br/>
--  Wexplore team<br/>
</div>