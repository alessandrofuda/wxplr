@extends('front.dashboard_layout')
@section('top_section')
<h1>Dashboard<small>Consultant Availablity Listing</small></h1>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-primary pull-right" href="{{ url('user/role_play_interview') }}"> << Back to Role Play Interview</a>
		</div>
	</div>
	<div class="col-md-12">
	<table id="global_test" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
		<thead>
			<tr role="row">
			<th>Consultant Name</th>
			<th>Booking Title</th>
			<th>Booking Date</th>
			<th>Booking Time</th>
			<th>Operation</th>
			<th>Feedback</th></tr>
		</thead>
		<tbody>
			
				@forelse ($booked_consultants as $booked_consultant)
					<tr role="row" class="odd">
					<td class="sorting_1">{{ $booked_consultant->availablity->consultant->name }} {{ $booked_consultant->availablity->consultant->surname }}</td>
					<td class="sorting_1">{{ $booked_consultant->availablity->title }}</td>
					<td class="sorting_1">{{ date('M d, Y',$booked_consultant->availablity->available_date ) }}</td>
					<td class="sorting_1">{{ $booked_consultant->availablity->available_start_time }} - {{ $booked_consultant->availablity->available_end_time }}</td>
					  <td>
					  @if($booked_consultant->status == 1)
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cancelModal_{{ $booked_consultant->id }}">Cancel Booking</button>
						<!-- Modal -->
						<div id="cancelModal_{{ $booked_consultant->id }}" class="modal fade" role="dialog">
							<div class="modal-dialog">
							  <!-- Modal content-->
							  <div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Are you sure you want to cancel this meeting ?</h4>
							  </div>
							  <form role="form" class="cancel_form operations_form" method="post" action="{{ url('user/consultant/booking/cancel') }}">
							  <div class="modal-body">				
									{{ csrf_field() }}
								  <input type="hidden" name="booking_id" value="{{ $booked_consultant->id }}">
							  </div>
							  <div class="modal-footer">
								 <button type="submit" class="btn btn-primary">Yes</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
							  </div>
							  </form>
							</div>						  
						  </div>
						</div><!-- end Modal -->
						@elseif($booked_consultant->status == 0)
							<span>Meeting Canceled</span>
						@elseif($booked_consultant->status == 2)
							<span>Meeting Completed</span>
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
			@empty
				<tr role="row" class="odd">
				  <td colspan="2">No Availability found yet!</td>
				</tr>
			@endforelse
		</tbody>
	</table>
	</div>
@endsection