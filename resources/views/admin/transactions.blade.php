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
					<h3 class="box-title">Transactions list</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="pages_wrapper" class="dataTables_wrapper dt-bootstrap">
					<div class="row">
						<div class="col-sm-12">
							<table id="pages_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Transaction ID</th>
										<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Amount</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Type</th>
										<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
											aria-label="Browser: activate to sort column ascending" style="width: 208px;">Item Details</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Paid By</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Created At</th>
									{{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
										aria-label="Browser: activate to sort column ascending" style="width: 208px;">Operations</th>
										<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">Invoice</th>
									 --}}
								</tr>
								</thead>
								<tbody>
									@if (count($transactions) > 0)
										@foreach ($transactions as $transaction)
											<tr role="row" class="odd">
												<td class="sorting_1">{{ $transaction->transaction_id }}</td>
												<td class="sorting_1">${{ $transaction->amount }}</td>
												<td class="sorting_1">{{ $transaction->getTypeOptions($transaction->type_id) }}</td>
												<td class="sorting_1">{{ $transaction->getName() }}</td>
												<td class="sorting_1">{{ isset($transaction->createUser->name) ? $transaction->createUser->name : "User Deleted" }}</td>
												<td class="sorting_1">{{ $transaction->created_at }}</td>
												{{-- 
													<td class="sorting_1">{!! $transaction->order_status != \App\OrderTransaction::STATE_REFUND ? link_to_route('refund_transaction','Refund',['transaction_id' => $transaction->id]) : "Refunded" !!}
													</td>
													<td class="sorting_1">
														<a href="/order/{{ $transaction->order_id }}/download/invoice"><i class="fa fa-file-pdf-o" style="font-size:25px;"></i></a>
													</td> 
												--}}
											</tr>
										@endforeach
									@else
										<tr role="row" class="odd">
										  <td colspan="2">No Transaction created yet!</td>
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
