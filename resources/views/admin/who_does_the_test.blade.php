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
					<h3 class="box-title">Who does the test</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
					<div class="row">
					</div>
					<div class="row">
						<div class="col-sm-12">
							<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
                                        <th>User</th>
                                        <th>Outcome</th>
										<th>Date</th>
                                    </tr>
								</thead>
								<tbody>
									@if (count($result) > 0)
										@foreach ($result as $res)
											<tr role="row" class="odd">
                                                <td class="sorting_1">{{ $res['user_name'] }}</td>
                                                <td class="sorting_1">{{ $res['outcome_name'] }}</td>
												<td class="sorting_1">{{ $res['outcome_created_date'] }}</td>
											</tr>
										@endforeach
									@else
										<tr role="row" class="odd">
										  <td colspan="2">No user has taken test yet!</td>
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
