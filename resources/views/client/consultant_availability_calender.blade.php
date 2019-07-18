@extends('layouts.dashboard_layout')
@section('content')
<div class="row">
	@if(!isset($query))
	<div class="col-md-12">
		<a class="btn btn-primary pull-right" href="{{ url('user/role_play_interview') }}"> << Back to Role Play Interview</a>
	</div>
		@endif
</div>
<div class="container user_profile_form">
	<div class="row">
		<div class="heading">
			<h3>{{ $page_title }}</h3>
		</div>
	</div>
	<div class="row">
	<div class="col-md-12">
	@if(count($consultant_avail) > 0)
		<div id="calendar"></div>
	@else
		<div style="background-color: palevioletred" class="consultant-cls"><p>Sorry for inconvinence! Consultant is not available for these days.</p></div>
	@endif
	</div>
	<!-- Modal -->
	<div id="consultantBooking" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Book consultant</h4>
		</div>
			@if(isset($query))
				<form role="form" class="book_appoinment_form" method="post" action="{{ url('user/global/'.$query->id.'/book') }}">
			@else
				<form role="form" class="book_appoinment_form" method="post" action="{{ url('user/consultant/book') }}">
			@endif

		<div class="modal-body">	
			<p>Are you sure you want to schedule your appointment for this date and time ?</p>												
			  {{ csrf_field() }}
			<input type="hidden" name="availablity_id" value="">
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Yes</button>		
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</form>
	  </div>						  
	</div>
   </div><!-- end Modal -->
</div>	
</div>
<link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar/fullcalendar.css') }}">
<script src='{{ asset("admin/plugins/daterangepicker/moment.min.js") }}'></script>
<script src='{{ asset("admin/plugins/fullcalendar/fullcalendar.js") }}'></script>
@if(count($consultant_avail) > 0)
<script type='text/javascript'>
$(document).ready(function() {
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '{{ date('Y-m-d') }}',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			eventClick: function(calEvent, jsEvent, view) {
				if (calEvent.url) {
				    window.open(calEvent.url);
				    return false;
				}else{
					myFunction(calEvent.id,calEvent.title,view.name);
				}
			},
			displayEventEnd:true,
			events: [
				@foreach($consultant_avail as $cas)
				{
				<?php $start_date = date('Y-m-d',strtotime($cas->getDate())); ?>
				<?php $start_time =  trim(date('H:i:s',strtotime($cas->getDate(\App\ConsultantAvailablity::START_TIME)))); ?>
				<?php $end_time =  trim(date('H:i:s',strtotime($cas->getDate(\App\ConsultantAvailablity::END_TIME)))); ?>
					id : '{{ $cas->id }}',
					title: '{{ $cas->title }}',
					date : '{{ $start_date }}',
					starttime : '{{ $start_time }}',
					endtime : '{{ $end_time }}',
					start: '{{ $start_date }}T{{ $start_time }}',
					end: '{{ $start_date }}T{{ $end_time }}',
				},
				@endforeach
			],
			eventRender: function (event, element) {
				var tooltip = event.title+'<br/>'+'Date : '+event.date + '<br/>' +'Time : '+event.starttime+' - '+event.endtime;
				$(element).attr("data-original-title", tooltip)
				$(element).tooltip({ html: true,container: "body"})
           }
		});
		// On mouse-over, execute myFunction
		function myFunction(eventId,eventTitle,viewName) {
		   $("#consultantBooking input[name='availablity_id']").val(eventId);
		   $("#consultantBooking").modal('show');
		}
	});


</script>
	@endif
@endsection