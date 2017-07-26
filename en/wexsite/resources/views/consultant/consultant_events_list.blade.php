@extends('consultant.consultant_dashboard_layout')
@section('top_section')
<h1>Dashboard<small>Appoinment Listing</small></h1>
@endsection
@section('content')
	<div class="row">
		<!--<div class="col-md-12">
			<a class="btn btn-primary pull-right" href="{{ url('user/role_play_interview') }}"> << Back to Role Play Interview</a>
		</div>-->
	</div>
	<div class="col-md-12">
	<h2 class="box-title">{{ $page_title }}</h2>
	<table id="global_test" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
		<thead>
			<tr role="row">
			<th>Event Name</th>
			<th>Image</th>
			<th>Event Date/Time</th>
			<th>Event Join Link</th>
			<th>Bookings</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($events as $event)
				<tr role="row" class="odd">
				<td class="sorting_1">{{ $event->name }}</td>
				<td class="sorting_1"><img alt="{{ $event->name }}" src="{{ asset($event->image_file) }}" height="100" width="100"/></td>
				<td class="sorting_1">{{ $event->getDate() }} -
						{{ $event->getDate(\App\ConsultantAvailablity::START_TIME)  }} to {{ $event->getDate(\App\ConsultantAvailablity::END_TIME)  }}</td>
				<td class="sorting_1">{!! link_to($event->joinLink, 'Join Link') !!}</td>
				<td class="sorting_1">{{ $event->getBookingCount() }}</td>
				</tr>
			@empty
			<tr role="row" class="odd">
			  <td colspan="2">No Event assigned yet!</td>
			</tr>
			@endforelse
		</tbody>
	</table>
	</div>
@endsection
