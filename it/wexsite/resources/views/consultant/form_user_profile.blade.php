@extends('consultant.consultant_dashboard')
@section('top_section')
	<h1>Dashboard<small>Services</small></h1>
	<!--<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>-->
@endsection
@section('content')
<div class="col-md-9 profile_page columns-center">
<h3 class="box-title">{{ $page_title }}</h3>
</div>

<div class="Profile_details col-md-9 col-sm-10 col-xs-12 columns-center">
	<div class="Profile_details_main">
		<h3 class="Profile_Data_heading">Profile Data</h3>
		@if(isset($user->userProfile->profile_picture))
			<img alt="{{ $user->name }}"  src="{{ asset($user->userProfile->profile_picture) }}" width="150" height="150" style="float:left">
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
			{{--@if(isset($dream_check_lab_feedback))
				<div class="Profile-Data" id="view_personal_data">
					<ul>
						@if($dream_check_lab_feedback->cv_file != null)
							<li><span>Download CV File : </span> <span class="Fill_detais"><a href="{{ url($dream_check_lab_feedback->cv_file) }}" ><span class = "glyphicon glyphicon-download"></span> Download CV</a></span></li>
						@endif

						@if($dream_check_lab_feedback->feedback_form != null)
							<li><span>Download Feedback: </span> <span class="Fill_detais"><a href="{{ url($dream_check_lab_feedback->feedback_form) }}"><span class = "glyphicon glyphicon-download"></span>  Download Feedback</a></span></li>
						@endif
					</ul>
				</div>
			@endif

			@if(isset($query_feedback))
				<div class="Profile-Data" id="view_personal_data">
					<ul>
						@if($query_feedback->attach_file != null)
							<li><span>Download Attached File : </span> <span class="Fill_detais"><a href="{{ url($query_feedback->attach_file) }}"><span class = "glyphicon glyphicon-download"></span> Download Attached File</a></span></li>
						@endif

						@if($query_feedback->feedback_form != null)
							<li><span>Download Feedback: </span> <span class="Fill_detais"><a href="{{ url($query_feedback->feedback_form) }}"><span class = "glyphicon glyphicon-download"></span> Download Query Feedback</a></span></li>
						@endif

					</ul>
				</div>
			@endif--}}

		</div>
	</div>
</div>



</div>
@endsection
