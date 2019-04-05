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
					<h3 class="box-title">Pages list</h3>
					<a class="btn btn-primary add_user" href="{{ url('admin/page/add') }}"><span class="glyphicon glyphicon-plus-sign"></span> Add Page</a>
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
									<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Title</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Machine name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Operations</th></tr>
								</thead>
								<tbody>
									@if (count($pages) > 0)
										@foreach ($pages as $page)
											<tr role="row" class="odd">
												<td class="sorting_1">{{ $page->page_title }}</td>
												<td class="sorting_1">{{ $page->machine_name }}</td>
												<td>
												  <a href="{{ url('admin/page/'.$page->id.'/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a> 
											  	<!--<form role="form" class="delete_form operations_form" method="post" action="{{ url('admin/page/'.$page->id.'/delete') }}">
													<input type="hidden" name="_method" value="DELETE">
													{{ csrf_field() }}
													<button type="submit" class=""><span class="glyphicon glyphicon-trash"></span></button>
												</form>-->
											  </td>
											</tr>
										@endforeach
									@else
										<tr role="row" class="odd">
										  <td colspan="2">No page created yet!</td>
										</tr>
									@endif
								</tbody>
								<tfoot>
									<tr><th>Title</th><th>Machine name</th><th>Operations</th></tr>
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
@endsection
