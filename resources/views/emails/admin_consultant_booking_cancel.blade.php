@extends('emails.templates.layout1')


@section('content')

	<style>
		#consultant_class th, #consultant_class td { border: 1px solid #000000; }
		#consultant_class th { background-color: #DCDCDC; }
		#consultant_class .time {min-width: 75px;}
	</style>



	<div id="consultant_class">
	Hello Admins,<br/>
	<br/>
	one consultant booking request has been cancelled. Details are: <br/>
	<br/>
	<table>
		<tr>
			<th>Consultant Name </th>
			<th>User Name </th>
			<!--th>Booking Title</th-->
			<th>Booking Date</th>
			<th>Booking Time</th>
			<th>Status</th>
		</tr>
		<tr>
			<td class="sorting_1">{{ $consultantbooking->availablity->consultant->name }} {{ $consultantbooking->availablity->consultant->surname }}</td>
			<td class="sorting_1">{{ $consultantbooking->user->name }} {{ $consultantbooking->user->surname }}</td>
			<!--td class="sorting_1">{{-- $consultantbooking->availablity->title --}}</td-->
			<td class="sorting_1">{{ date('Y-m-d', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) }}</td>
			<td class="sorting_1 time">{{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::START_TIME))) }} - {{ date('H:i:s', strtotime($consultantbooking->availablity->getDate(\App\ConsultantAvailablity::END_TIME))) }}</td>
			<td class="sorting_1">Cancelled</td>
		</tr>
	</table>
	<br/>
	<br/>
	</div>

@endsection