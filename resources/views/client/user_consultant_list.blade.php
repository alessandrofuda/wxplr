@extends('layouts.dashboard_layout')
@section('top_section')
	<h1>Dashboard<small>Consultant Listing</small></h1>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-primary pull-right" href="{{ url('user/role_play_interview') }}"> << Back to Role Play Interview</a>
	</div>
</div>
<div class="col-md-12 profile_page">
<h3 class="box-title">{{ $page_title }}</h3>
	<div class="col-lg-8 col-xs-12">
		@if (count($consultant_list) > 0)
			<table id="global_test" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
				<thead>
					<tr role="row">
						<th>Consultant Name</th>
						<th>Qualification</th>
						<th>Industry Expertise</th>
						<th>Country Expertise</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($consultant_list as $cl)
					<tr>
						<td class="sorting_1">{{ $cl->user->name }}&nbsp;{{ $cl->user->surname }}</td>
						<td class="sorting_1">{{ $cl->qualification }}</td>
						<td class="sorting_1">{{ $cl->industry_expertise }}</td>
						<td class="sorting_1">{{ $cl->country_name }}</td>
						<td class="sorting_1"><a href="{{ url('user/consultant/'.$cl->user_id.'/availabilities') }}">Book Appoinment</a></td>
					</tr>
				@endforeach			
				</tbody>
			</table>
		@else
			<tr role="row" class="odd">
			  <td colspan="2">No Consultant found as per your requirement!</td>
			</tr>
		@endif
	</div>
</div>
@endsection
