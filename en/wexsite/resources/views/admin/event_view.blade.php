@extends('admin.layout')
@section('content')
    <div class='row'>
		<div class="col-md-12">
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
    	<div class='col-md-12'>
    		<div class="box">
				<div class="box-header">
					<h3 class="box-title">Event Details</h3>
					<a class="btn btn-primary add_user" href="{{ url('admin/event/add') }}">
						<span class="glyphicon glyphicon-plus-sign"></span> Add Event</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="pages_wrapper" class="dataTables_wrapper dt-bootstrap">
					<div class="row">
						<div class="col-md-12">
							<table id="pages_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<tr role="row">
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Name</th>
									<td class="sorting_1">{{ $event->name }}</td>
								</tr>
								<tr>
								<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Image</th>
									<td class="sorting_1">
										@if($event->image_file != null)
											<img alt="{{ $event->name }}" src="{{  asset($event->image_file) }}" height="100" width="100">
										@endif
									</td>
								</tr>
								<tr>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Price</th>
									<td class="sorting_1">{{ $event->price }}</td>
								</tr>
								<tr>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Description</th>
									<td class="sorting_1">{{ substr($event->description,0,50) }}</td>
								</tr>
								<tr>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Event Date</th>
									<td class="sorting_1">{{ $event->getDate() }}</td>
								</tr>
								<tr>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Event Start</th>
									<td class="sorting_1">{{ $event->getDate(\App\ConsultantAvailablity::START_TIME)  }}</td>
								</tr>
								<tr>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Event End</th>
									<td class="sorting_1">{{ $event->getDate(\App\ConsultantAvailablity::END_TIME)  }}</td>
								</tr>
								<tr>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Consultant</th>
									<td class="sorting_1">{{ isset($event->consultant->name ) ? $event->consultant->name : ""}}</td>
								</tr>
								<tr>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Webinar Key</th>
									<td class="sorting_1">{{ $event->webinar_key }}</td>
								</tr>
								</table>
							</div>
						<div class="col-sm-12">
							<div class="box-header">
							<h3 class="box-title">Bookings </h3></div>
							<table id="pages_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">User Name</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Registrant Key</th>
										<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
											aria-label="Browser: activate to sort column ascending" style="width: 208px;">Booked On</th>
								</thead>
								<tbody>
								@if(count($event->bookings) > 0)
										@foreach ($event->bookings as $booking)
											<tr role="row" class="odd">
												<td class="sorting_1">{{ $booking->user->name }}</td>
												<td class="sorting_1">
													{{ $booking->registrantKey }}
												</td>
												<td class="sorting_1">{{ $booking->created_at }}</td>
											</tr>
										@endforeach
									@else
										<tr role="row" class="odd">
										  <td colspan="2">No Booking created yet!</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
					</div>
				</div><!-- /.box-body -->
			</div>
		</div><!-- /.col -->
    </div><!-- /.row -->
@endsection
