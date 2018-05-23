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
					<h3 class="box-title">Events list</h3>
					<a class="btn btn-primary add_user" href="{{ url('admin/event/add') }}">
						<span class="glyphicon glyphicon-plus-sign"></span> Add Event</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="pages_wrapper" class="dataTables_wrapper dt-bootstrap">
					<div class="row">
						<div class="col-sm-12">
							<table id="pages_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Name</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Image</th>
										<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
											aria-label="Browser: activate to sort column ascending" style="width: 208px;">Price</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Description</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Event Date/Time</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Consultant</th>
										<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Webinar Key</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Operations</th></tr>
								</thead>
								<tbody>
									@if (count($events) > 0)
										@foreach ($events as $event)
											<tr role="row" class="odd">
												<td class="sorting_1">{{ $event->name }}</td>
												<td class="sorting_1">
													@if($event->image_file != null)
													 <img alt="{{ $event->name }}" src="{{  asset($event->image_file) }}" height="100" width="100">
													@endif
												</td>
												<td class="sorting_1">{{ $event->price }}</td>
												<td class="sorting_1">{{ substr($event->description,0,50) }}</td>
												<td class="sorting_1">{{ $event->getDate() }} -
													{{ $event->getDate(\App\ConsultantAvailablity::START_TIME)  }} to {{ $event->getDate(\App\ConsultantAvailablity::END_TIME)  }}</td>

												<td class="sorting_1">{{ isset($event->consultant->name ) ? $event->consultant->name : ""}}</td>
												<td class="sorting_1">{{ $event->webinar_key }}</td>
												<td>
													<a href="{{ url('admin/event/'.$event->id.'/view') }}">
														<span class="fa fa-eye"></span></a>
													<a href="{{ url('admin/event/'.$event->id.'/edit') }}">
														<span class="glyphicon glyphicon-pencil"></span></a>

													<button type="button" class="btn btn-info btn-lg delete_modal_btn" data-toggle="modal" data-target="#deleteModal_{{ $event->id }}"><span class="glyphicon glyphicon-trash"></span></button>
													<!-- Modal -->
													<div id="deleteModal_{{ $event->id }}" class="modal fade" role="dialog">
														<div class="modal-dialog">
															<!-- Modal content-->
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">Are you sure you want to delete it?</h4>
																</div>
																<div class="modal-body">
																	<form role="form" class="delete_form operations_form" method="post" action="{{ url('admin/event/'.$event->id.'/delete') }}">
																		<input type="hidden" name="_method" value="DELETE">
																		{{ csrf_field() }}
																		<button type="submit" class="btn btn-primary">Delete</button>
																	</form>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																</div>
															</div>
														</div>
													</div><!-- end Modal -->
											  </td>
											</tr>
										@endforeach
									@else
										<tr role="row" class="odd">
										  <td colspan="2">No Event created yet!</td>
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
