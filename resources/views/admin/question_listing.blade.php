@extends('admin.layout')
@section('content')
    <div class='row'>
	<div class="col-md-12">
		@if (session('status'))
			<div class="alert alert-success">
			  {{ session('status') }}
			</div>
		@endif
		@if (session('error'))
		  <div class="alert alert-danger">
			  {{ session('error') }}
		  </div>
		@endif
	</div>
	<div class='col-md-12'>
	
		<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $page_title }}</h3>         
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
				@if(count($questions) > 0)
					<tr>
					  <th>#</th>
					  <th>Question</th>
					  <th>Correct Answer</th>
					  <th>Actions</th>
					</tr>				
					{{--*/ @$i = 1 /*--}}
					@foreach($questions as $question)
					<tr>
					  <td>{{ $i }}</td>
					  <td>{{ $question->question }}</td>
					  <td>{{ $question->correct_answer }}</td>
					  <td><a href="{{ url('admin/online_test/'.$question->id.'/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a> 
						<button type="button" class="btn btn-info btn-lg delete_modal_btn" data-toggle="modal" data-target="#deleteModal_{{ $question->id }}"><span class="glyphicon glyphicon-trash"></span></button>
						<div id="deleteModal_{{ $question->id }}" class="modal fade" role="dialog">
							<div class="modal-dialog">
							  <!-- Modal content-->
							  <div class="modal-content">
								<div class="modal-header">
								  <button type="button" class="close" data-dismiss="modal">&times;</button>
								  <h4 class="modal-title">Are you sure you want to delete it?</h4>
								</div>
								<div class="modal-body">
									<form role="form" class="delete_form operations_form" method="post" action="{{ url('admin/online_test/'.$question->id.'/delete') }}">
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
					</tr>
					{{--*/ @$i++ /*--}}
				@endforeach
				@else
				<tr><td>No Question Found! You can create question <a href="{{ url('admin/online_test/create') }}">here</a></td></tr>
				@endif
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
	</div><!-- /.col -->
    </div><!-- /.row -->
@endsection