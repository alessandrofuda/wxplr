@extends('layouts.dashboard_layout')
@section('top_section')
	<h1>Dashboard<small>Packages</small></h1>
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
			<div class="content box">
				<div class="row">
					<div class="col-sm-12">
						<table id="list_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							<thead>
							<tr role="row">
								<th>Package Title</th>
								<th>Package Price</th>
								<th>Package Services Status<br/>(Service => Services Left  => Used By)</th>
								<th>Package Code</th>
								<th>Purchase Date</th>
							</tr>
							</thead>
							<tbody>
							@if (count($packages) > 0)
								@foreach($packages as $package)
									<tr role="row" class="odd">
										<td class="sorting_1">{{ $package->package->title }}</td>
										<td class="sorting_1">€{{ $package->transactionPrice() }}</td>
										<td class="sorting_1">{!!  $package->getServicesStatus() !!}</td>
										<td class="sorting_1">{{ isset($package->code->preferential_code) ? $package->code->preferential_code : "" }}</td>
										<td class="sorting_1">{{ $package->created_at }}</td>
									</tr>
								@endforeach
							@else
								<tr role="row" class="odd">
									<td colspan="2">No Package Purchased created yet!</td>
								</tr>
							@endif
							</tbody>

						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
@endsection