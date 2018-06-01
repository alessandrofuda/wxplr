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
					<h3 class="box-title">Users list</h3>
					<a class="btn btn-primary add_user" href="{{ url('admin/user/add') }}"><span class="glyphicon glyphicon-plus-sign"></span> Add User</a>
					<a class="btn btn-primary add_user" href="{{ url('admin/export') }}"><span class="fa fa-cloud-upload"></span> Export Users Data</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
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
							<div class="col-md-12">
								<form method="post" action="{{ url('admin/users') }}">
									{{ csrf_field() }}
									Search: <input type="text" value="{{ isset($start_date) ? $start_date : "" }}" placeholder="From Date" class="form-control datepicker" name="start_date" >
									<input type="text" value="{{ isset($end_date) ? $end_date : "" }}" placeholder="To Date"  class="form-control datepicker" name="end_date" >
									<input type="submit" class="btn btn-info" value="Apply" >
							</form>
							<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
										<th></th>
									<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Name</th>
										<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">E-mail</th>
										<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Roles</th>
										<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Service</th>
										<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Country Of Interest</th>
										<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Joined On</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Operations</th></tr>
								</thead>
								<tbody>
									@if (count($users) > 0)
										@foreach ($users as $user)
											<tr role="row" class="odd">
												<td rowspan="2"  class="sorting_1">{{ $user->id }}</td>
											  <td rowspan="2"  class="sorting_1">{{ $user->name }}</td>
												<td rowspan="2"  class="sorting_1">{{ $user->email }}</td>
												<td rowspan="2"  class="sorting_1">
													@if($user->is_admin == 1)
														<b>Admin</b>
													@else
														@foreach ($user->roles as $key=>$role)
															@if ($key > 0) , @endif
															{{ $role->role_name }}
														@endforeach
													@endif
												</td>
												<td>
													Professional Kit
												</td>
												<td>
													{{ $user->getInterestedCountry(\App\User::SERVICE_PROFESSIONAL_KIT) }}
												</td>
												<td rowspan="2">
												{{ \App\Setting::getDateTime($user->created_at) }}
												</td>
											  <td rowspan="2" >
											  	<a href="{{ url('admin/user/'.$user->id.'/view') }}"><span class="fa fa-eye"></span></a>
												  <a href="{{ url('admin/user/'.$user->id.'/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
												<button type="button" class="btn btn-info btn-lg delete_modal_btn" data-toggle="modal" data-target="#deleteModal_{{ $user->id }}"><span class="glyphicon glyphicon-trash"></span></button>
													<!-- Modal -->
													<div id="deleteModal_{{ $user->id }}" class="modal fade" role="dialog">
													  <div class="modal-dialog">
														<!-- Modal content-->
														<div class="modal-content">
														  <div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Are you sure you want to delete it?</h4>
														  </div>
														  <div class="modal-body">
															<form role="form" class="delete_form operations_form" method="post" action="{{ url('admin/user/'.$user->id.'/delete') }}">
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
											<tr>
												<td>
													Global Tool Box
												</td>
												<td>
													{{ $user->getInterestedCountry(\App\User::SERVICE_GLOBAL_TOOL_BOX) }}
												</td>
											</tr>
										@endforeach
									@else
										<tr role="row" class="odd">
										  <td colspan="2">No user found!</td>
										</tr>
									@endif
								</tbody>
								<tfoot>
									<tr><th>Name</th><th>E-mail</th><th>Roles</th><th>Operations</th></tr>
								</tfoot>
							</table>
							<div class="text-center">{!! $users->render() !!}</div>
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
		<script>
		$(".datepicker").datepicker({
		endDate: new Date,
		format:'yyyy-mm-dd',
		autoclose:true
		});
		</script>
@endsection
