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
					<a href="{{ url('admin/cuture_match/survey_code/upload') }}" class="btn btn-primary add_user"><span class="glyphicon glyphicon-plus-sign"></span> Upload Survey Codes </a>
				</div>

				<!-- /.box-header -->
				<div class="box-body">
				  <div id="survey_code_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">					
					<div class="row">
						<div class="col-sm-12">
							<table id="list_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr role="row">
									<th>Label</th>
									<th>Survey Code</th>
									<th>Assigned</th>
									<th>Operations</th></tr>
								</thead>
								<tbody>
									@if (count($survey_code) > 0)
										@foreach ($survey_code as $sc)
											<tr role="row" class="odd">
												<td class="sorting_1">{{ $sc->label }}</td>
												<td class="sorting_1">{{ $sc->survey_code }}</td>
												<td class="sorting_1">{!! (isset($sc->is_assigned) && $sc->is_assigned == 0) ? 'No' : $sc->getUploadForm()  !!}</td>
											  <td>
												<!--<a href="{{ url('admin/cuture_match/survey_code/'.$sc->id.'/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a> 
											  	--><button type="button" class="btn btn-info btn-lg delete_modal_btn" data-toggle="modal" data-target="#deleteModal_{{ $sc->id }}"><span class="glyphicon glyphicon-trash"></span></button>
													<!-- Modal -->
													<div id="deleteModal_{{ $sc->id }}" class="modal fade" role="dialog">
													  <div class="modal-dialog">
													
														<!-- Modal content-->
														<div class="modal-content">
														  <div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Are you sure you want to delete it?</h4>
														  </div>
														  <div class="modal-body">
															<form role="form" class="delete_form operations_form" method="post" action="{{ url('admin/cuture_match/survey_code/'.$sc->id.'/delete') }}">
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
										  <td colspan="2">No Survey Code Uploaded yet!</td>
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

	<div class="loading_image" id="loading-image"></div>
	<!-- Trigger the modal with a button -->
	<script>
		$("[id^=upload_file]").click(function() {
			var id = $(this).attr('id').split('upload_file')[1];
			console.log('id'+id);
			$("#form_"+id)[0];
			if (!$("#form_"+id)[0].checkValidity()) {
				// If the form is invalid, submit it. The form won't actually submit;
				// this will just cause the browser to display the native HTML5 error messages.
				$("#file_error_"+id).html('Please Upload File');
			}else {
				var fd = new FormData();
				var file_data = $('#file_' + id)[0].files; // for multiple files
				for (var i = 0; i < file_data.length; i++) {
					fd.append("upload_file", file_data[i]);
				}
				var token = $('input[name="_token"]').attr('value');

				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
					},
					url: $("#form_"+id).attr('action'),
					type: 'POST',
					data: fd,
					async: false,
					success: function (data) {
						if (data.status == 'OK') {
						//	$("#form_"+id).hide();
						//	$("#upload_file"+id).hide();
							$("#message_"+id).html('<i class="fa fa-check">Pdf Sent</i>');
							$("#file_"+id).val('');
							var email = data.email;
							alert('successfully sent to email id: '+email);
						} else {
							alert('Something went wrong. Please try again');
						}
					},
					cache: false,
					contentType: false,
					processData: false
				});
			}
		});
	</script>

	<script>
		$('#loading-image').bind('ajaxStart', function(){
			$(this).show();
		}).bind('ajaxStop', function(){
			$(this).hide();
		});
	</script>
@endsection
