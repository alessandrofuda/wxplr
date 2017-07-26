@extends('front.dashboard_layout')
@section('content')
	@include('front.navigation')

	<!-- Modal -->
	<div id="consultantBooking" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Are you sure you want to schedule your appointment for this date and time ?</h4>
				</div>
				<form role="form" class="book_appoinment_form" method="post" action="{{ url('user/consultant/book') }}">
					<div class="modal-body">
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
	<div class="container user_profile_form">
		<div class="row">
			<div class="heading">
				<h3>{{ $page_title }}</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

				@if(!empty($consultant) && is_object($consultant))
					<a class="btn btn-primary pull-right" href="{{ url('user/myappointments') }}"> See all booking </a>
					<div class="col-md-12 profile_page">
						<h3 class="box-title">Meet your consultant!</h3>
						<div class="profile_img col-lg-3 col-xs-12">
							@if(isset($consultant->consultantProfile->profile_picture))
								<img alt="{{ $consultant->name }}" src="{{ asset($consultant->consultantProfile->profile_picture) }}">
							@endif
						</div>
						<div class="col-lg-8 col-xs-12">
							<ul class="profile_details">
								<li><b>Name:</b> {{ $consultant->name }} {{ $consultant->surname }}</li>
								@if(isset($consultant->consultantProfile))
									<li><b>Qualification:</b> {{ $consultant->consultantProfile->qualification }}</li>
									<li><b>Languages:</b> {{ $consultant->consultantProfile->languages }}</li>
									<li><b>Bio:</b> {{ $consultant->consultantProfile->bio }}</li>
								@endif
							</ul>
						</div>
					</div>
					<div class="booking-instructions">
						<p>Book your session in the calendar below for a career orientation session with your consultant. </p>
						<p>How does that work?</p>
						<ol>
							<li>You and your consultant will have a video call, hosted by Wexplore's platform.</li>
							<li>The consultant will advice you on how to best present yourself to your target market: this allows you to practice and to boost your confidence.</li>
							<li>In the same session, the consultant will then provide specific advice on which channels you can use, which companies or recruiters you can approach, to maximize your chances of success.</li>
						</ol>
						<p><strong>TIP:</strong> Try to refer as much as possible to the forms in the DreamCheckLab section and to feedback you received! They are your key tools for an effective self-marketing.</p>
					</div>
					<div class="col-md-12">
						@if(isset($already_booked))
							<div class="alert alert-success">	{!! $already_booked !!} </div>
						@else
							<div id="calendar"></div>
						@endif

					</div>

					{{--<ul>
                        <li><a href="{{ url('user/consultant/list') }}">Matching Consultant listing</a></li>
                        <li><a href="{{ url('user/consultant/booked/list') }}">Booked Consultant listing</a></li>
                    </ul>--}}
				@else
					<p>No consultant is assigned to you yet! Please follow the step one by one and then get back to this page!</p>
				@endif
			</div>
		</div>
	</div>
	<link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar/fullcalendar.css') }}" />
	<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>
	<script src='{{ asset("admin/plugins/daterangepicker/moment.min.js") }}'></script>
	<script src='{{ asset("admin/plugins/fullcalendar/fullcalendar.js") }}'></script>
	<script type='text/javascript'>
		jQuery(document).ready(function() {
			jQuery('#calendar').fullCalendar({
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
					jQuery(element).attr("data-original-title", tooltip)
					jQuery(element).tooltip({ html: true,container: "body"})
				}
			});
			// On mouse-over, execute myFunction
			function myFunction(eventId,eventTitle,viewName) {
				jQuery("#consultantBooking input[name='availablity_id']").val(eventId);
				jQuery("#consultantBooking").modal('show');
			}
		});
	</script>
@endsection
