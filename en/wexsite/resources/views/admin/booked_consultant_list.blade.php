@extends('admin.layout')
@section('content')
	<div class="row">		
	<div class="col-md-12">
	<table id="global_test" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
		<thead>
			<tr role="row">
			<th>Consultant Name</th>
			<th>User Name</th>
			<th>Booking Title</th>
			<th>Booking Date</th>
			<th>Booking Time</th>
			<th>Status</th>
			<th>Feedback</th></tr>
		</thead>
		<tbody>
			@if (count($booked_consultants) > 0) 
				@foreach ($booked_consultants as $booked_consultant)
					<?php //echo '<pre>';print_r($booked_consultant->availablity);exit;?>
					<tr role="row" class="odd">
					<td class="sorting_1">{{ isset($booked_consultant->availablity->consultant->name) ? : "-" }} {{ isset($booked_consultant->availablity->consultant->surname) ? : "-" }}</td>
					<td class="sorting_1">{{ isset($booked_consultant->user->name) ? : "-" }} {{ isset($booked_consultant->user->surname) ? : "-" }}</td>
					<td class="sorting_1">{{ isset($booked_consultant->availablity->title) ? : "-" }}</td>
					<td class="sorting_1">{{ isset($booked_consultant->availablity->available_date) ? date('M d, Y',$booked_consultant->availablity->available_date ) : "-"}}</td>
					<td class="sorting_1">{{ isset($booked_consultant->availablity->available_start_time) ? : "-" }} - {{ isset($booked_consultant->availablity->available_end_time) ? : "-" }}</td>
					<td>
					@if($booked_consultant->status == 0)
						<span>Canceled</span>
					@elseif($booked_consultant->status == 1)
						<span>Pending</span>
					@elseif($booked_consultant->status == 2)
						<span>Completed</span>
					@endif
					</td>
					<td>
					@if($booked_consultant->status == 2)
						@if($booked_consultant->feedback_comments != '')
							{{ $booked_consultant->feedback_comments }}
						@else
							<p>No feedback Given Yet!</p>
						@endif
					@else
						<p>No feedback!</p>
					@endif
					</td>
					</tr>
				@endforeach
			@else
				<tr role="row" class="odd">
				  <td colspan="2">No Availability found yet!</td>
				</tr>
			@endif
		</tbody>
	</table>
	</div>
</div>
@endsection