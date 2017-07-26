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
					<h3 class="box-title">Query list</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="pages_wrapper" class="dataTables_wrapper dt-bootstrap">
					<div class="row">
						<div class="col-sm-12">
							<table id="global_test" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
								<tr role="row">
									<th>Interested Country </th>
									<th>Question</th>
									<th>Comment</th>
									<th>Status</th>
									<th>User</th>
									<th>Consultant</th>
									<th></th>
								</tr>
								</thead>
								<tbody>
								{{-- dd($queries) --}}
								@forelse($queries as $query)
									<tr>
										<td class="sorting_1">{{ $query->country }}</td>
										<td class="sorting_1">{{ $query->getQuestionTypeOptions($query->question_type_id) }}</td>
										<td class="sorting_1">{{ $query->comment }}</td>
										<td class="sorting_1">{{ $query->getStatusOptions($query->state_id) }}</td>
										{{-- dd($query->user->name) --}}
										<td class="sorting_1">{{ isset($query->user->name) ? $query->user->name : "User deleted from DB" }}</td>
										{{-- dd($query->consultant()) --}}
										<td class="sorting_1">{{ isset($query->consultant->name) ? $query->consultant->name : "Consultant deleted from DB" }}</td>
										<td class="sorting_1">
											@if($query->state_id == \App\GlobalToolQuery::STATE_PENDING)
												<a href="{{ url('admin/query/'.$query->id.'/edit') }}">Assign Consultant</a>
											@endif
										</td>

									</tr>
								@empty
									<tr>
										<td colspan="5" align="center">
											No Queries Submitted <a href="{{ url('/global_toolbox') }}">Find Country Expert</a>
										</td>
									</tr>
								@endforelse
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
