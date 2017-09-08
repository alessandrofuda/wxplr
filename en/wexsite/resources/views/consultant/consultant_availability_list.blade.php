@extends('consultant.consultant_dashboard_layout')
@section('top_section')
<h1>Dashboard<small>Consultant Availablity Listing</small></h1>
@endsection
@section('content')
	<div class="col-md-12">
	<h2 class="box-title">{{ $page_title }}</h2>
	<table id="global_test" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
		<thead>
			<tr role="row">
				<th>Booking Type</th>
				<th>Available Date/Time</th>
				<th>Status</th>
				<th>Operations</th>
			</tr>
		</thead>
		<tbody>
			@if (count($consultant_avails) > 0) 
				@foreach ($consultant_avails as $consultant_avail)
					<tr role="row" class="odd">
						<td class="sorting_1">{{ $consultant_avail->getTypeOptions($consultant_avail->type_id) }}</td>
						<td class="sorting_1">{{ $consultant_avail->getDate() }} -




{{-- dd($consultant_avail->getDate(\App\ConsultantAvailablity::START_TIME)) --}}



								{{ $consultant_avail->getDate(\App\ConsultantAvailablity::START_TIME)  }} to {{ $consultant_avail->getDate(\App\ConsultantAvailablity::END_TIME)  }}
						</td>
						<td class="sorting_1">{{ ($consultant_avail->status == 1) ? 'Active' : 'Not Active' }} </td>
						<td>
							<a href="{{ url('consultant/availability/'.$consultant_avail->id.'/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
								<a type="button" style="cursor:pointer;" class="delete_modal_btn" data-toggle="modal" data-target="#deleteModal_{{ $consultant_avail->id }}"><span class="glyphicon glyphicon-trash"></span></a>
								<!-- Modal -->
								<div id="deleteModal_{{ $consultant_avail->id }}" class="modal fade" role="dialog">
								  <div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title">Are you sure you want to delete it?</h4>
									</div>
									<div class="modal-body">															
									  <form role="form" class="delete_form operations_form" method="post" action="{{ url('consultant/availability/'.$consultant_avail->id.'/delete') }}">
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
				  <td colspan="2">No Availability found yet!</td>
				</tr>
			@endif
		</tbody>
	</table>
	</div>
@endsection
