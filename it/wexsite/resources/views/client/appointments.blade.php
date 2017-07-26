@extends('front.dashboard_layout')
@section('top_section')
	<h1>Dashboard<small>Appointments</small></h1>
	<!--<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>-->
@endsection
@section('content')
	{{-- service boxes --}}
	<div class="container">
		<div class="row">
			<div class="heading">
				<h3>{{ $page_title }}</h3>
			</div>
		</div>
		<div class="row">
			<table id="global_test" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
				<thead>
				<tr role="row">
					<th>Consultant </th>
					<th>Start Date</th>
					<th>Type</th>
					<th>Status</th>
					<th>Operation</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				@forelse($appointments as $appointment)
					@if(isset($appointment->availablity->consultant->name ))
					<tr>
						<td class="sorting_1">{{ $appointment->availablity->consultant->name }}</td>
						<td class="sorting_1">{{ $appointment->availablity->getDate() }} -
							{{ $appointment->availablity->getDate(\App\ConsultantAvailablity::START_TIME)  }} to {{ $appointment->availablity->getDate(\App\ConsultantAvailablity::END_TIME)  }}</td>
						<td class="sorting_1">{{ $appointment->getTypeOptions($appointment->type_id, $appointment->query_id) }}</td>
						<td class="sorting_1">{!!  $appointment->getMeetingStatus() !!}</td>
						<td class="sorting_1">

								@if($appointment->status == \App\ConsultantBooking::STATE_PENDING && $appointment->checkDate())
									<a href='{{ url("user/booking/".$appointment->id."/cancel") }}' class="btn btn-warning">Cancel Appointment </a>
								@else
									Not Allowed
								@endif
						</td>
					</tr>
					@endif
				@empty
					<tr>
						<td colspan="5" align="center">
							No Appointment set yet!!</a>
						</td>
					</tr>
				@endforelse
				</tbody>
			</table>

		</div>
	</div>
@endsection