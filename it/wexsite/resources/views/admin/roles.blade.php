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
				  <h3 class="box-title">Roles list</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="role_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
					<!--<div class="row">
						<div class="col-sm-6">
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
						</div>
						<div class="col-sm-6">
							<div id="example1_filter" class="dataTables_filter">
								<label>
									Search:
									<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
								</label>
							</div>
						</div>
					</div>-->
					<div class="row">
						<div class="col-sm-12">
							<table id="list_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
									<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Roles</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Operations</th></tr>
								</thead>
								<tbody>
									@if (count($roles) > 0)
										@foreach ($roles as $role)
											<tr role="row" class="odd">
											  <td class="sorting_1">{{ $role->role_name }}</td>
											  <td>
												<a href="{{ url('admin/role/'.$role->id.'/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a> 
											  	<!--<button type="button" class="btn btn-info btn-lg delete_modal_btn" data-toggle="modal" data-target="#deleteModal_{{ $role->id }}"><span class="glyphicon glyphicon-trash"></span></button>-->
													<!-- Modal -->
													<div id="deleteModal_{{ $role->id }}" class="modal fade" role="dialog">
													  <div class="modal-dialog">
													
														<!-- Modal content-->
														<div class="modal-content">
														  <div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Are you sure you want to delete it?</h4>
														  </div>
														  <div class="modal-body">
															<form role="form" class="delete_form operations_form" method="post" action="{{ url('admin/role/'.$role->id.'/delete') }}">
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
										  <td colspan="2">No role created yet!</td>
										</tr>
									@endif
								</tbody>
								
							</table>
						</div>
					</div>
						<div class="row">
							<div class="col-sm-12">
								{{--<div class="dataTables_info" id="example1_info" role="status" aria-live="polite"> Showing 1 to 10 of 57 entries -- Showing {!! $roles->total()-$roles->perPage() !!} to {!! $roles->currentPage()*$roles->count() !!} of {!! $roles->total() !!} entries</div> --}}
							</div>
							<div class="col-sm-12">
								<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
									{{-- showing count: {!! $roles->count() !!} Total: {!! $roles->total() !!} perpage {!! $roles->perPage() !!}
									current_page : {!! $roles->currentPage() !!} 
									{!! $roles->render() !!} --}}
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.box-body -->
			</div>
		</div><!-- /.col -->
       {{-- <div class='col-md-6'>
        	<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add Role</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" action="{{ url('admin/create_role') }}">
                <!-- text input -->
                <div class="form-group">
                  <label>Role Name</label>
                  <input type="text" name="role_name" class="form-control" required placeholder="Enter role name...">
				  <input type="hidden" name="form_type" value="create">
                  <span class="help-block">Enter Role name here</span>
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div><!-- /.box-body -->
            <!--<div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>-->
          </div><!-- /.box-footer -->
        </div><!-- /.col -->--}}
    </div><!-- /.row -->
	<!-- Trigger the modal with a button -->
@endsection
