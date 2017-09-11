@extends('consultant.consultant_dashboard_layout')
@section('top_section')
<h1>Dashboard<small>Appointment Listing</small></h1>
@endsection
@section('content')
	<div class="row">
		<!--<div class="col-md-12">
			<a class="btn btn-primary pull-right" href="{{ url('user/role_play_interview') }}"> << Back to Role Play Interview</a>
		</div>-->
	</div>
	<div class="col-md-12">
	<h2 class="box-title">{{ $page_title }}</h2>
	<table id="global_test" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
		<thead>
			<tr role="row">
				<th>User Name</th>
				<th>Session Type</th>
				<th>Booking Date/Time</th>
				<th>Status</th>
				<?php /*<th>Feedback</th>*/?>
				<th>Operation</th>
			</tr>
		</thead>
		<tbody>
			@if (count($appointments) > 0)

				@foreach ($appointments as $appointment)

					<tr role="row" class="odd">
						<td class="sorting_1"><a href="{{ url('booking/profile/'.$appointment->query_id.'/'.$appointment->type_id.'/detail') }}">{{ $appointment->user->name }} {{ $appointment->user->surname }}</a></td>
						<td class="sorting_1">{{ $appointment->getBookingType() }}</td>
						<td class="sorting_1">{{ $appointment->availablity->getDate() }} -
							{{ $appointment->availablity->getDate(\App\ConsultantAvailablity::START_TIME)  }} to {{ $appointment->availablity->getDate(\App\ConsultantAvailablity::END_TIME)  }}
						</td>
					  	<td>
						  {!! $appointment->getMeetingStatus() !!}
						  <!--a id="restart" class="btn btn-warning" href="https://www.gotomeeting.com/join/XXXXXX">Re-connect to Meeting (beta)</a-->
					  	</td>
						<?php /*	<td>
					@if($appointment->status == 2)
						@if($appointment->feedback_comments != '')
							{{ $appointment->feedback_comments }}
						@else
							<a href="#">Add Feedback</a>
						@endif
					@else
						<p>No feedback!</p>
					@endif
					</td>*/?>
						<td>
							@if($appointment->status == \App\ConsultantBooking::STATE_PENDING && $appointment->checkDate())
								<a href='{{ url("consultant/booking/".$appointment->id."/cancel") }}' class="btn btn-warning">Cancel Appointment </a>
							@else
								{!! $appointment->getUploadForm() !!}
							@endif
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


    @if (count($appointments) > 0)
        @foreach ($appointments as $appointment)
			<script>
				jQuery(document).ready(function($){
					//$('#restart').hide();
	  
	  				$('#start_{{ $appointment->id }}').click(function() {
	  					// $('#start_{{-- $appointment->id --}}').hide();
	    				// $('#restart').show();
	    				$(this).removeClass('btn-success').addClass('btn-warning');
	    				$(this).text('Reconnect to Meeting');
	  				});
	  			});
			</script>
	    @endforeach
    @endif



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
					fd.append("_token", "{{ csrf_token() }}");
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
								$("#form_"+id).hide();
								$("#upload_file"+id).hide();

								$("#message_"+id).html('<i class="fa fa-check">Recording Uploaded</i>');
								$("#file_"+id).val('');
								var email = data.email;
								alert('Recording Uploaded');
								//location.reload();
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
	</div>
@endsection
