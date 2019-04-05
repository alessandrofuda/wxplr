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
					<h3 class="box-title">{{ $page_title }}</h3>
					<a href="{{ url('admin/skill_development/video/add') }}" class="btn btn-primary add_user"><span class="glyphicon glyphicon-plus-sign"></span> Add Video </a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="skill_videos_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">					
					<div class="row">
						<div class="col-sm-12">
							<table id="list_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
									<th>Title</th>
									<th>Category</th>
									<th>Tag</th>
									<th>Price</th>
									<th>Operations</th></tr>
								</thead>
								<tbody>
									@if (count($skill_videos) > 0)
										@foreach ($skill_videos as $sv)
											<tr role="row" class="odd">
											  <td class="sorting_1">{{ $sv->video_title }}</td>
												<td class="sorting_1">{{ $sv->videoCategory['category_name'] }}</td>
												<td class="sorting_1">{{ isset($sv->videoTag->tag->name) ? ucfirst($sv->videoTag->tag->name) : '' }}</td>
												<td class="sorting_1">{{ $sv->price }}</td>
											  <td>
												  <a href="{{ url('admin/skill_development/video/'.$sv->id.'/view') }}"><span class="fa fa-eye"></span></a>
												<a href="{{ url('admin/skill_development/video/'.$sv->id.'/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a> 
											  	<button type="button" class="btn btn-info btn-lg delete_modal_btn" data-toggle="modal" data-target="#deleteModal_{{ $sv->id }}"><span class="glyphicon glyphicon-trash"></span></button>
													<!-- Modal -->
													<div id="deleteModal_{{ $sv->id }}" class="modal fade" role="dialog">
													  <div class="modal-dialog">
													
														<!-- Modal content-->
														<div class="modal-content">
														  <div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Are you sure you want to delete it?</h4>
														  </div>
														  <div class="modal-body">
															<form role="form" class="delete_form operations_form" method="post" action="{{ url('admin/skill_development/video/'.$sv->id.'/delete') }}">
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
										  <td colspan="2">No Video added yet!</td>
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
	<!-- Trigger the modal with a button -->
@endsection
