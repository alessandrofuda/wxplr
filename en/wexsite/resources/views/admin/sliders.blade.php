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
					<h3 class="box-title">Slider list</h3>
					<a class="btn btn-primary add_user" href="{{ url('admin/slider/add') }}">
						<span class="glyphicon glyphicon-plus-sign"></span> Add Slider</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="pages_wrapper" class="dataTables_wrapper dt-bootstrap">
					<div class="row">
						<div class="col-sm-12">
							<table id="pages_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
								<?php /*	<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">First Heading </th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Second Heading</th>
										*/?><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
											aria-label="Browser: activate to sort column ascending" style="width: 208px;">Slider Image</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Operations</th></tr>
								</thead>
								<tbody>
									@if (count($sliders) > 0)
										@foreach ($sliders as $slider)
											<tr role="row" class="odd">
												<?php /*<td class="sorting_1">{{ $slider->heading_1 }}</td>
												<td class="sorting_1">{{ $slider->heading_2}}</td>
												*/?><td class="sorting_1"><img alt="Slider Image" src="{{ asset($slider->image_file) }}" width="100" height="100" /></td>
												<td>
													<a href="{{ url('admin/slider/'.$slider->id.'/edit') }}">
														<span class="glyphicon glyphicon-pencil"></span></a>
													<button type="button" class="btn btn-info btn-lg delete_modal_btn" data-toggle="modal" data-target="#deleteModal_{{ $slider->id }}"><span class="glyphicon glyphicon-trash"></span></button>
													<!-- Modal -->
													<div id="deleteModal_{{ $slider->id }}" class="modal fade" role="dialog">
														<div class="modal-dialog">
															<!-- Modal content-->
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">Are you sure you want to delete it?</h4>
																</div>
																<div class="modal-body">
																	<form role="form" class="delete_form operations_form" method="post" action="{{ url('admin/slider/'.$slider->id.'/delete') }}">
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
										  <td colspan="2">No Slider Image Added yet!</td>
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
