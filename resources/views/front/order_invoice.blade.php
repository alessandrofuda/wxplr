@extends('layouts.dashboard_layout')
@section('content')
<div class="upper-test-container">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<!--<h1></h1>-->
        <div class="box-header">
            <h3 class="box-title">{{ $page_title }}</h3>
          </div>
		<div class="content box">
            <div class="row">
                <div class="col-sm-12">
                    <table id="list_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th>Name</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders) > 0)
                                @foreach($orders as $order)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $order->item_name }}</td>
                                        <td class="sorting_1">€{{ $order->item_amount }}</td>
                                        <td class="sorting_1">{{ $order->created_at }}</td>
                                        <td class="sorting_1">
                                            <a href="{{ url("order/".$order->id.'/download/invoice') }}">
                                                <i class="fa fa-file-pdf-o" style="font-size:25px;"></i></a></td>
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
		</div>
</div>
@endsection