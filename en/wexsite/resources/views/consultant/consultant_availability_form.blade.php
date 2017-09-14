@extends('consultant.consultant_dashboard_layout')
@section('top_section')
	<h1>Dashboard<small>Consultant</small></h1>
	<!--<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>-->
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('admin/plugins/timepicker/bootstrap-timepicker.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">

<div id="discussion" class="col-md-12 profile_page">
	<h3 class="box-title">Users Availability Box</h3>













	<div id="discussion-{{$discuss_id}}" class="col-md-10 col-sm-12 discussion" style="margin: 40px auto;">
		<div class="row ass-user">Assigned user: {{ $client->name .' '. $client->surname }}</div>
		<section class="comment-list">
			@foreach( $discussions as $discussion )
			<div class="row">
				<!--div class="col-md-2 col-sm-2 hidden-xs">
					<figure class="thumbnail">
						<img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
						<figcaption class="text-center">username</figcaption>
						</figure>
				</div-->
				<div class="col-md-10 col-sm-10 {{ $discussion->user_id !== Auth::user()->id ? '' : 'col-md-offset-1 col-sm-offset-0' }}">
					<div class="panel panel-default" style="max-height: none; opacity: 1; margin: 1em auto; border-radius: 5px; {{ $discussion->user_id === Auth::user()->id ? '' : 'background-color: #BFBFBF' }}">
						<div class="panel-header">
							<i class="fa fa-user"></i> <strong>{{ $discussion->user->name }}  {{ $discussion->user->surname }}</strong>&nbsp;&nbsp;&nbsp;<span class="text-muted"><i class="fa fa-clock-o"></i> {{ App\Setting::getDateTime($discussion->created_at, false, 'd-m-Y H:i') }}</span> {{-- data/ora col giusto fuso orario/timezone --}}
						</div>
						<div class="panel-body" style="margin: 0 auto;">
							<i>{{ $discussion->message }}</i>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</section>

		<p><br></p>

		<form id="discussion-form-{{$discuss_id}}" class="discussion-form" method="post" action="{{ url('consultant/discussion') }}">
			{{ csrf_field() }}
		    <div class="row text-center"><b>Send a message to {{ $client->name .' '. $client->surname }} and confirm date and time according to your availability for video call.</b></div>
			<textarea class="form-control" rows="5" name="message"></textarea>
			<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
			<input type="hidden" name="discuss_id" value="{{ $discuss_id }}">
			<button type="submit" class="btn btn-primary" style="margin-top: 15px;">Send to Consultant</button>
		</form>
	</div>













</div>

<div class="col-md-12 profile_page">
<h3 class="box-title">{{ $page_title }}</h3>
<div class="col-lg-3 col-xs-12">
	@if($page_type == 'edit')
		<form role="form" method="post" enctype="multipart/form-data" action="{{ url('consultant/availability/'.$edit_availability->id.'/edit') }}">
	@else
		<form role="form" method="post" enctype="multipart/form-data" action="{{ url('consultant/availability/form') }}">
	@endif
	<!-- text input -->		
		<div class="form-group">
			<label>Availability Date:</label>
			<div class="input-group date">
			  <div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			  </div>
			@if($page_type == 'edit')
				<input type="text" id="datepicker" name="available_date" value="{{ date('m/d/Y',strtotime($edit_availability->getDate())) }}" class="form-control pull-right" id="datepicker">
			@else
				<input type="text" id="datepicker" name="available_date"  value="{{ old('available_date') }}"  class="form-control pull-right">
			@endif
			</div>
		</div>
		<div class="form-group">
			<label>Availability Type:</label>
			<div class="input-group date">
				<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</div>
				@if($page_type == 'edit')
					<select class="form-control" name="type_id">
						<option>---Select Availability Type</option>
						@foreach(\App\ConsultantAvailablity::getTypeOptions() as $key => $type)
							<option value="{{ $key }}" @if($edit_availability->type_id == $key) selected @endif > {{ $type }}  </option>
							@endforeach
						</select>
				@else
					<select class="form-control" name="type_id">
						<option>---Select Availability Type</option>
						@foreach(\App\ConsultantAvailablity::getTypeOptions() as $key => $type)
							<option value="{{ $key }}" @if(old('type_id') == $key) selected @endif > {{ $type }}  </option>
						@endforeach
					</select>
				@endif
			</div>
		</div>
		<div class="bootstrap-timepicker">
			<div class="form-group">
				<label>Start Time (24hr format):</label>
				<div class="input-group">
				@if($page_type == 'edit')
					<input type="text" name="available_start_time" value="{{ $edit_availability->getDate(\App\ConsultantAvailablity::START_TIME) }}" class="form-control timepicker">
				@else
					<input type="text" name="available_start_time" class="form-control timepicker">	
				@endif	
					<div class="input-group-addon">
					  <i class="fa fa-clock-o"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="bootstrap-timepicker">
			<div class="form-group">
				<label>End Time (24hr format):</label>
				<div class="input-group">
				@if($page_type == 'edit')
					<input type="text" name="available_end_time" value="{{ $edit_availability->getDate(\App\ConsultantAvailablity::END_TIME) }}" class="form-control timepicker">
				@else
					<input type="text" name="available_end_time" class="form-control timepicker">
				@endif
					<div class="input-group-addon">
					  <i class="fa fa-clock-o"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Status</label>
			<div class="radio">
			  <label>
			    <input type="radio" @if (isset($edit_availability) && $edit_availability->status==1) checked @endif @if (!isset($edit_availability)) checked @endif name="status" value="1">
			    Yes
			  </label>
			</div>
			<div class="radio">
			  <label>
			    <input type="radio" @if (isset($edit_availability) && $edit_availability->status==0) checked @endif name="status" value="0" >
			    No
			  </label>
			</div>
		 </div>


		{{ csrf_field() }}
		<button type="submit" class="btn btn-primary">Save</button>
		<a href="{{ url('consultant/dashboard') }}" class="btn btn-default">Cancel</a>
	</form>
</div>

@endsection
@section('js')
		<script src="{{ asset('frontend/js/jquery-2.1.4.min.js') }}"></script>
		<script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
		<script src="{{ asset('admin/plugins/timepicker/bootstrap-timepicker.js') }}"></script>
		<script>
			$(function () {
				//Timepicker

				$(".timepicker").timepicker({
					showInputs: false,
					showMeridian : false
				});
			});
		</script>
		<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
		<script>
			$(document).ready(function () {
				$('#datepicker').datepicker({
					autoclose: true,
					dateFormat: "Y-m-d",
					startDate:new Date()
				});
			});
		</script>
@endsection
