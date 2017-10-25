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
		@if (count($discussions) > 0)
			<style>
				.cont{ border: 1px solid #E1E1E1; border-radius: 5px; padding: 15px 0; margin-bottom: 50px; }
				.disc-tit{ display: inline-block; padding: 0px 15px; color: #FFF; background-color: #cfcfcf; margin-left: 10px; border-radius: 5px 5px 0px 0px; }
				.ass-user { padding: 10px 35px; }
			</style>
			<div class="disc-tit">{{ count($discussions) === 1 ? '1 message' : count($discussions).' messages' }}</div>
			<section class="comment-list cont">
				<div class="ass-user">
					Assigned user: <strong>{{ $client->name .' '. $client->surname }}</strong>.
				</div>
				@foreach( $discussions as $discussion )
					<?php 
						$discussion->user_id === Auth::user()->id ? $bg = 'rgba(221,221,221,0.5)' : $bg = '#BFBFBF';
					?>
					<style>	
						.msj-{{ $discussion->id }}::before {  width: 0; height: 0; content: ""; top: 0; left: -38px; position: relative; border-style: solid; border-width: 0 20px 20px 0; border-color: transparent {{ $bg }} transparent transparent; float: left; }
					</style>
					<div class="row">
						<div class="col-md-10 col-sm-10 {{ $discussion->user_id !== Auth::user()->id ? '' : 'col-md-offset-1 col-sm-offset-0' }}">
							<div class="panel panel-default msj-{{ $discussion->id }}" style="max-height: none; opacity: 1; margin: 1em auto; border-radius: 0 15px; overflow: visible; border: none; {{ $discussion->user_id === Auth::user()->id ? '' : 'background-color: #BFBFBF' }}">
								<div class="panel-header">
									<i class="fa fa-user"></i> <strong>{{ $discussion->user->name }}  {{ $discussion->user->surname }}</strong>&nbsp;&nbsp;&nbsp;<span class="text-muted"><i class="fa fa-clock-o"></i> {{ App\Setting::getDateTime($discussion->created_at, false, 'd-m-Y H:i') }}</span> {{-- data/ora col giusto fuso orario/timezone --}}
								</div>
								<div class="panel-body" style="margin: 0 auto;">
									<i>{!! nl2br($discussion->message) !!}</i>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</section>
		@endif

		<form id="discussion-form-{{$discuss_id}}" class="discussion-form" method="post" action="{{ url('consultant/discussion') }}">
			{{ csrf_field() }}
		    <div class="msg-title">
		    	<b>When can you do conference call?</b><br>Propose a date/time to <b>{{ $client->name .' '. $client->surname }}</b> before booking it,  according to your availability.
		    </div>
			<textarea class="form-control" rows="5" name="message"></textarea>
			<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
			<input type="hidden" name="discuss_id" value="{{ $discuss_id }}">
			<button type="submit" class="btn btn-primary" style="margin-top: 15px;">Send to Client</button>
		</form>
	</div>

</div>

<div id="availability-form" class="col-md-12 profile_page">
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
