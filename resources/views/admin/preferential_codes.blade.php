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
					<h3 class="box-title">Codes list</h3>
					<a class="btn btn-primary add_user" href="{{ url('admin/code/add') }}"><span class="glyphicon glyphicon-plus-sign"></span> Add Code</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="pages_wrapper" class="dataTables_wrapper dt-bootstrap">
					<div class="row">
						<!--<div class="col-sm-6">
							<div class="dataTables_length" id="example1_length">
								<label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm">
									<option value="10">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
									</select> 
									entries
								</label>
							</div>
						</div>-->
						<!--<div class="col-sm-6">
							<div id="example1_filter" class="dataTables_filter">
								<label>
									Search:
									<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
								</label>
							</div>
						</div>-->
					</div>
					<div class="row">
						<div class="col-sm-12">
							<table id="pages_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Codes</th>
										<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
											aria-label="Browser: activate to sort column ascending" style="width: 208px;">Discount</th>
										<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
											aria-label="Browser: activate to sort column ascending" style="width: 208px;">Product</th>
										<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
											aria-label="Browser: activate to sort column ascending" style="width: 208px;">Valid Till</th>
										<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Usage options</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Operations</th></tr>
								</thead>
								<tbody>
									@if (count($codes) > 0)
										@foreach ($codes as $code)
											<tr role="row" class="odd">
												<td class="sorting_1">{{ $code->preferential_code }}</td>
												<td class="sorting_1">{{ $code->discount }}%</td>
												<td class="sorting_1">{{ $code->productSelected() }}</td>
												<td class="sorting_1">{{ $code->end_date }}</td>
												<td class="sorting_1">{{ $code->getUsageOptions() }}</td>

												<td>
													<a href="{{ url('admin/code/'.$code->id.'/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
													<button type="button" class="btn btn-info btn-lg delete_modal_btn" data-toggle="modal" data-target="#deleteModal_{{ $code->id }}"><span class="glyphicon glyphicon-trash"></span></button>
													<!-- Modal -->
													<div id="deleteModal_{{ $code->id }}" class="modal fade" role="dialog">
														<div class="modal-dialog">
															<!-- Modal content-->
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">Are you sure you want to delete it?</h4>
																</div>
																<div class="modal-body">
																	<form role="form" class="delete_form operations_form" method="post" action="{{ url('admin/code/'.$code->id.'/delete') }}">
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
										  <td colspan="2">No Code created yet!</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
						<div class="row">
							<!--<div class="col-sm-12">
								<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
							</div>
							<div class="col-sm-12">
								<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
									<ul class="pagination">
										<li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li>
										<li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li>
										<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li>
										<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li>
										<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li
										><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li>
										<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li>
										<li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li>
									</ul>
								</div>
							</div>-->
						</div>
					</div>
				</div><!-- /.box-body -->
			</div>
		</div><!-- /.col -->
    </div><!-- /.row -->
@endsection
