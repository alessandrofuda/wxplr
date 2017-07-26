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
					<a class="btn btn-primary add_user" href="{{ url('admin/user/add') }}"><span class="glyphicon glyphicon-plus-sign"></span> Add Consultant</a>
					<a class="btn btn-primary add_user" href="{{ url('admin/consultant/export') }}"><span class="fa fa-cloud-upload"></span> Export Consultants Data</a>
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
							<form method="post" action="{{ url('admin/consultants') }}">
								{{ csrf_field() }}
								Search: <input type="text" value="{{ isset($start_date) ? $start_date : "" }}" placeholder="From Date" class="form-control datepicker" name="start_date" >
								<input type="text" value="{{ isset($end_date) ? $end_date : "" }}" placeholder="To Date"  class="form-control datepicker" name="end_date" >
								<input type="submit" class="btn btn-info" value="Apply" >
							</form>
							<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
									<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Company Name</th>
									<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Consultant Name</th>
									<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">E-mail</th>
										<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Service</th>
										<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Assigned Users</th>
										<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Session Completed</th>
										<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Authorize State</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Operations</th></tr>
								</thead>
								<tbody>
									@if (count($users) > 0)
										@foreach ($users as $user)
											<tr role="row" class="odd">
											  <td  rowspan="7" class="sorting_1">{{ isset($user->consultantProfile->company) ? $user->consultantProfile->company : "" }}</td>
												<td  rowspan="7" class="sorting_1">{{ $user->name }}</td>
												<td  rowspan="7" class="sorting_1">{{ $user->email }}</td>
												<td class="sorting_1">Professional Kit Career Session</td>
												<td class="sorting_1">{{ $user->getAssignedUsers(\App\User::SERVICE_PROFESSIONAL_KIT) }}</td>
												<td class="sorting_1">{{ $user->getCompletedSessions(\App\User::SERVICE_PROFESSIONAL_KIT) }}</td>
												<td class="sorting_1">
													<form method="post" action = '{{ url('admin/consultant/'.$user->id.'/activate') }}'>
														{{ csrf_field() }}
														@if($user->checkService(\App\User::SERVICE_PROFESSIONAL_KIT) == \App\ConsultantServices::STATE_ACTIVE)
															<input type="hidden" value="0" name="is_active" class="btn btn-success">
															<input type="hidden" value="0" name="service_id" value="{{ \App\User::SERVICE_PROFESSIONAL_KIT  }}" class="btn btn-success">
															<button type="submit" title="In Activate" class="btn btn-warning"><i class="fa fa-remove"></i> </button>
														@else
															<input type="hidden" value="1" name="is_active" class="btn btn-success">
															<input type="hidden" value="0" name="service_id" value="{{ \App\User::SERVICE_PROFESSIONAL_KIT  }}" class="btn btn-success">
															<button type="submit" title="Activate" class="btn btn-success"><i class="fa fa-check"></i> </button>
														@endif
													</form></td>
											  <td  rowspan="7">

											  	<a href="{{ url('admin/consultant/'.$user->id.'/profile/view') }}"><span class="glyphicon glyphicon-pencil"></span></a>
												@if ($user->id != 1)
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
												@endif
											  </td>
											</tr>
											<tr>
												<td>Skills Development Live Webinar</td>
												<td class="sorting_1">{{ $user->getAssignedUsers(\App\User::SERVICE_LIVE_WEBINAR) }}</td>
												<td class="sorting_1">{{ $user->getCompletedSessions(\App\User::SERVICE_LIVE_WEBINAR) }}</td>
												<td class="sorting_1">
													<form method="post" action = '{{ url('admin/consultant/'.$user->id.'/activate') }}'>
														{{ csrf_field() }}
														@if($user->checkService(\App\User::SERVICE_LIVE_WEBINAR) == \App\ConsultantServices::STATE_ACTIVE)
															<input type="hidden" value="0" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::SERVICE_LIVE_WEBINAR  }}" class="btn btn-success">
															<button type="submit" title="In Activate" class="btn btn-warning"><i class="fa fa-remove"></i> </button>
														@else
															<input type="hidden" value="1" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::SERVICE_LIVE_WEBINAR  }}" class="btn btn-success">
															<button type="submit" title="Activate" class="btn btn-success"><i class="fa fa-check"></i> </button>
														@endif
													</form></td>
											</tr>
											<tr>
												<td>Global Toolbox Role Play Interview</td>
												<td class="sorting_1">{{ $user->getAssignedUsers(\App\User::SERVICE_ROLE_PLAY_INTERVIEW) }}</td>
												<td class="sorting_1">{{ $user->getCompletedSessions(\App\User::SERVICE_ROLE_PLAY_INTERVIEW) }}</td>
												<td class="sorting_1">
													<form method="post" action = '{{ url('admin/consultant/'.$user->id.'/activate') }}'>
														{{ csrf_field() }}
														@if($user->checkService(\App\User::SERVICE_ROLE_PLAY_INTERVIEW) == \App\ConsultantServices::STATE_ACTIVE)
															<input type="hidden" value="0" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::SERVICE_ROLE_PLAY_INTERVIEW  }}" class="btn btn-success">
															<button type="submit" title="In Activate" class="btn btn-warning"><i class="fa fa-remove"></i> </button>
														@else
															<input type="hidden" value="1" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::SERVICE_ROLE_PLAY_INTERVIEW  }}" class="btn btn-success">
															<button type="submit" title="Activate" class="btn btn-success"><i class="fa fa-check"></i> </button>
														@endif
													</form></td>
											</tr>
											<tr>
												<td>Global Toolbox Contract Evaluation</td>
												<td class="sorting_1">{{ $user->getAssignedUsers(\App\User::SERVICE_CONTRACT_EVALUATION) }}</td>
												<td class="sorting_1">{{ $user->getCompletedSessions(\App\User::SERVICE_CONTRACT_EVALUATION) }}</td>
												<td class="sorting_1">
													<form method="post" action = '{{ url('admin/consultant/'.$user->id.'/activate') }}'>
														{{ csrf_field() }}
														@if($user->checkService(\App\User::SERVICE_CONTRACT_EVALUATION) == \App\ConsultantServices::STATE_ACTIVE)
															<input type="hidden" value="0" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::SERVICE_CONTRACT_EVALUATION  }}" class="btn btn-success">
															<button type="submit" title="In Activate" class="btn btn-warning"><i class="fa fa-remove"></i> </button>
														@else
															<input type="hidden" value="1" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::SERVICE_CONTRACT_EVALUATION  }}" class="btn btn-success">
															<button type="submit" title="Activate" class="btn btn-success"><i class="fa fa-check"></i> </button>
														@endif
													</form></td>
											</tr>
											<tr>
												<td>Global Toolbox Cultural Support</td>
												<td class="sorting_1">{{ $user->getAssignedUsers(\App\User::GT_CULTURE_SUPPORT) }}</td>
												<td class="sorting_1">{{ $user->getCompletedSessions(\App\User::GT_CULTURE_SUPPORT) }}</td>
												<td class="sorting_1">
													<form method="post" action = '{{ url('admin/consultant/'.$user->id.'/activate') }}'>
														{{ csrf_field() }}
														@if($user->checkService(\App\User::GT_CULTURE_SUPPORT) == \App\ConsultantServices::STATE_ACTIVE)
															<input type="hidden" value="0" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::GT_CULTURE_SUPPORT  }}" class="btn btn-success">
															<button type="submit" title="In Activate" class="btn btn-warning"><i class="fa fa-remove"></i> </button>
														@else
															<input type="hidden" value="1" name="is_active" class="btn btn-success">
															<input type="hidden" name="service_id" value="{{ \App\User::GT_CULTURE_SUPPORT  }}" class="btn btn-success">
															<button type="submit" title="Activate" class="btn btn-success"><i class="fa fa-check"></i> </button>
														@endif
													</form></td>
											</tr>
											<tr>
												<td>Global Toolbox Freelance Support</td>
												<td class="sorting_1">{{ $user->getAssignedUsers(\App\User::SERVICE_GT_FREELANCE_SUPPORT) }}</td>
												<td class="sorting_1">{{ $user->getCompletedSessions(\App\User::SERVICE_GT_FREELANCE_SUPPORT) }}</td>
												<td class="sorting_1">
													<form method="post" action = '{{ url('admin/consultant/'.$user->id.'/activate') }}'>
														{{ csrf_field() }}
														@if($user->checkService(\App\User::SERVICE_GT_FREELANCE_SUPPORT) == \App\ConsultantServices::STATE_ACTIVE)
															<input type="hidden" value="0" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::SERVICE_GT_FREELANCE_SUPPORT  }}" class="btn btn-success">
															<button type="submit" title="In Activate" class="btn btn-warning"><i class="fa fa-remove"></i> </button>
														@else
															<input type="hidden" value="1" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::SERVICE_GT_FREELANCE_SUPPORT  }}" class="btn btn-success">
															<button type="submit" title="Activate" class="btn btn-success"><i class="fa fa-check"></i> </button>
														@endif
													</form></td>
											</tr>
											<tr>
												<td>Global Toolbox Professional Troubleshooting</td>
												<td class="sorting_1">{{ $user->getAssignedUsers(\App\User::SERVICE_GT_PROFESSIONAL) }}</td>
												<td class="sorting_1">{{ $user->getCompletedSessions(\App\User::SERVICE_GT_PROFESSIONAL) }}</td>
												<td class="sorting_1">
													<form method="post" action = '{{ url('admin/consultant/'.$user->id.'/activate') }}'>
														{{ csrf_field() }}
														@if($user->checkService(\App\User::SERVICE_GT_PROFESSIONAL) == \App\ConsultantServices::STATE_ACTIVE)
															<input type="hidden" value="0" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::SERVICE_GT_PROFESSIONAL  }}" class="btn btn-success">
															<button type="submit" title="In Activate" class="btn btn-warning"><i class="fa fa-remove"></i> </button>
														@else
															<input type="hidden" value="1" name="is_active" class="btn btn-success">
															<input type="hidden"  name="service_id" value="{{ \App\User::SERVICE_GT_PROFESSIONAL  }}" class="btn btn-success">
															<button type="submit" title="Activate" class="btn btn-success"><i class="fa fa-check"></i> </button>
														@endif
													</form>
												</td>
											</tr>

										@endforeach
									@else
										<tr role="row" class="odd">
										  <td colspan="2">No Consultant found!</td>
										</tr>
									@endif
								</tbody>
								<tfoot>
								<tr role="row">
									<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Company Name</th>
									<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Consultant Name</th>
									<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">E-mail</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Operations</th></tr>

								</tfoot>
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
	<script>
		$(".datepicker").datepicker({
			endDate: new Date,
			format:'yyyy-mm-dd',
			autoclose:true
		});
	</script>
@endsection
