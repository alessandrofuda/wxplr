<div class="">
Hello {{ $client_name }},<br/>
<br/>
your Consultant has booked the agreed date for Conference Call: <br/>
<br/>
<table>
	<tr>
		<th>Consultant Name</th>
		<th>Call Type</th>
		<th>Date</th>
		<!--th>Start Time</th-->
		<!--th>End Time</th-->
	</tr>
	<tr>
		<td class="sorting_1">{{ $consultant_name }}</td>
		<td class="sorting_1">{{ $type }}</td>
		<td class="sorting_1"><em>(go to your site page)</em></td>
		<!--td class="sorting_1">{{-- date('Y-m-d', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::DATE))) --}}</td-->
		<!--td class="sorting_1">{{-- date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) --}} - {{-- date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::END_TIME))) --}}</td-->
	</tr>
</table>
<br/><br/><br/>
Please <a href="{{ url('user/role_play_interview#calendar') }}">click here to view and confirm agreed date & time</a>.
	
	<br/><br/><br/>
--  Wexplore team<br/>
</div>