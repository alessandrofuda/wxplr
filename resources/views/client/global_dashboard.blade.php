@extends('front.dashboard_layout')
@section('top_section')
	<h1>Dashboard<small>Global Tool Box</small></h1>
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
			{{--<a class="pull-right btn btn-success" href="{{ url('global_toolbox') }}">Put Query </a>
			<br/>--}}
			<table id="global_test" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
				<thead>
				<tr role="row">
					<th>Interested Country </th>
					<th>Question</th>
					<th>Comment</th>
					<th>Attached File</th>
					<th>Status</th>
					<th>Consultant</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				@forelse($queries as $query)
					<tr>
						<td class="sorting_1">{{ $query->country }}</td>
						<td class="sorting_1">{{ $query->getQuestionTypeOptions($query->question_type_id) }}</td>
						<td class="sorting_1">{{ $query->comment }}</td>
						<td class="sorting_1">@if($query->attach_file != null) <a href="{{ url($query->attach_file) }}" ><i class="fa fa-cloud-download"></i> Download Attached File</a> @else No File Attached @endif</td>
						<td class="sorting_1">{{ $query->getStatusOptions($query->state_id) }}</td>
						<td class="sorting_1">{{ isset($query->consultant->name) ? $query->consultant->name : "" }}</td>
						<td class="sorting_1">
							@if($query->state_id == \App\GlobalToolQuery::STATE_ASSIGNED)
							<a href="{{ url('user/global/'.$query->id.'/book') }}">Book Appoinment</a>
							@elseif($query->state_id == \App\GlobalToolQuery::STATE_BOOKED)
								<a href="{{ url('user/myappointments') }}">Already Booked</a>
                            @else
								No Consultant Found
							@endif
						</td>

					</tr>
					@empty
					<tr>
						<td colspan="5" align="center">
							No Queries Submitted <a href="{{ url('/global_toolbox') }}">Find Country Expert</a>
						</td>
					</tr>
				@endforelse
				</tbody>
			</table>

		</div>
	</div>
@endsection