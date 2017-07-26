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
			<th>Client Name</th>
			<th>Status</th>
			<th>Submitted On</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($forms as $form)
				<tr role="row" class="odd">
				<td class="sorting_1">{{ $form->createUser->name }}</td>
					<td>{{ $form->getConsultantStatus()  }}</td>
					<td class="sorting_1">{{ $form->created_at }}</td>
					<td> {!!  $form->getConsultantStatus(true)   !!}</td>
				</tr>
			@empty
			<tr role="row" class="odd">
			  <td colspan="2">No Forms assigned yet!</td>
			</tr>
			@endforelse
		</tbody>
	</table>
	</div>
@endsection
