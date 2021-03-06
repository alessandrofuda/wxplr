@extends('admin.layout')
@section('content')
	<div class='row'>
		<div class='col-md-12'>
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ $page_title }}</h3>
<div class="upload-form pull-right">
{!! $user->getUploadForm()  !!}</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body ">
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
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

<div class="Profile_details col-md-9 col-sm-10 col-xs-12 columns-center">
	<div class="Profile_details_main">
		<h3 class="Profile_Data_heading">Profile Data</h3>
		@if(isset($user->userProfile->profile_picture))
			<img alt="{{ $user->name }}" src="{{ asset($user->userProfile->profile_picture) }}" width="150" height="150" style="float:left">
		@else
			<img alt="{{ $user->name }}" src="https://organicthemes.com/demo/profile/files/2012/12/profile_img.png" width="150" height="150" style="float:left">
		@endif
		@if(isset($user->userProfile->id))

		   <div class="Profile-Data" id="view_profile_data">
				<ul>
					<li><span>Name : </span> <span class="Fill_detais">{{ $user->name.' '.$user->surname }}</span></li>
					<li><span>Gender: </span> <span class="Fill_detais">{{ $user->userProfile->gender }}</span></li>
					<li><span>Age: </span> <span class="Fill_detais">{{ $user->userProfile->age_range }}</span></li>
					<li><span>Country of Origin : </span> <span class="Fill_detais">{{ $user->userProfile->country_origin }}</span></li>
					<li><span>Country of interest: </span> <span class="Fill_detais">{{ $user->userProfile->country_interest }}</span></li>
					<li><span>Education: </span> <span class="Fill_detais">{{ $user->userProfile->education }}</span></li>
					<li><span>Industry: </span> <span class="Fill_detais">{{ $user->userProfile->industry }}</span></li>
					<li><span>Occupation: </span> <span class="Fill_detais">{{ $user->userProfile->occupation }}</span></li>
					<li><span>Current Occupational status: </span> <span class="Fill_detais">{{ $user->userProfile->occupational_status }}</span></li>
					<li><span>Salary Range: </span> <span class="Fill_detais">{{ $user->userProfile->salary_range }}</span></li>
					</ul>
			</div>
			@endif
	</div>
</div>


<div class="Profile_details other-details-main col-md-9 col-sm-10 col-xs-12 columns-center">
<div class="col-md-6 col-sm-6 col-xs-12 other-details one">
	<div class="Profile_details_main">
		<h3 class="Profile_Data_heading">Login Data</h3>
		   <div class="Profile-Data" id="view_login_data">
				<ul>
					<li><span>Name : </span> <span class="Fill_detais">{{ $user->name.' '.$user->surname }}</span></li>
					<li><span>Email : </span> <span class="Fill_detais">{{ $user->email }}</span></li>
				</ul>
			</div>
	</div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12 other-details two">
	<div class="Profile_details_main">
		<h3 class="Profile_Data_heading">Personal / invoice Data</h3>
		@if(isset($user->userProfile->id))
			  <div class="Profile-Data" id="view_personal_data">
				<ul>
					<li><span>Tax Code: </span> <span class="Fill_detais">{{ $user->userProfile->pan }}</span></li>
					<li><span>VAT: </span> <span class="Fill_detais">{{ $user->userProfile->vat }}</span></li>
					<li><span>Company (If Applicable): </span> <span class="Fill_detais">{{ $user->userProfile->company }}</span></li>
					<li><span>Address: </span> <span class="Fill_detais">{{ $user->userProfile->address }}</span></li>
					<li><span>Country: </span> <span class="Fill_detais">{{ $user->userProfile->country }}</span></li>
					<li><span>City: </span> <span class="Fill_detais">{{ $user->userProfile->city }}</span></li>
					<li><span>ZIP Code: </span> <span class="Fill_detais">{{ $user->userProfile->zip_code }}</span></li>
				</ul>
			</div>
			@endif
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 other-details two">
		<div class="Profile_details_main">
			<h3 class="Profile_Data_heading">Documents</h3>

			@if($user->getDocuments() != null)	 

			<div class="Profile-Data" id="view_personal_data">
					<ul>
@foreach($user->getDocuments() as $doc) 
					<li><span>{{ $doc['title'] }} : </span> <span class="Fill_detais"><a href="{{ $doc['url'] }}" ><span class = "glyphicon glyphicon-download"></span> Download</a></span></li>
						
	@endforeach
						
					</ul>
				</div>
			@endif

		</div>
	</div>
</div>
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
				fd.append("_token", "{{ csrf_token() }}");
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
							alert('Culture match report is successfully sent to user. User can find this under My Documents section.');
							location.reload();
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
