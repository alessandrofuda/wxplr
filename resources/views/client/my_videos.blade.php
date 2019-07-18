@extends('layouts.dashboard_layout')
@section('top_section')
	<h1>Dashboard<small>Services</small></h1>
	<!--<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>-->
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="heading">
				<h3>{{ $page_title }}</h3>
			</div>
		</div>
		<div class="page-wrapper My_Videos">
			@if(!empty($videos))
			<?php /*<script src="{{ asset('frontend/jwplayer/jwplayer.js') }}"></script>
			<script>jwplayer.key="g4fPsuTO2p03J7jp0MB28FBaHRlIYi4L56gXKg";</script>
			<div id="mainVideo"></div>*/?>
				<ul class="video_listing">
					@if(isset($videos) && count($videos) > 0)
						@foreach($videos as $video)
							<li>
								<a href="{{ url('video/'.$video->id.'/view') }}"><img src="{{ asset($video->video_image) }}" alt="{{ $video->video_title }}"></a>
								<div class="video_details">
									<h2><a href="#">{{ $video->video_title }}</a></h2>
									<span class="posted_by">In {{ $video->videoCategory->category_name  }} </span>
									<div class="video_price">Purchased</div>
									<div class="unit_duration"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $video->getDuration() }} </div>
									@if(isset($video->videoTag->tag->name))
										@if($video->videoTag->tag->name != null)
											<div class="unit_topic_tag">
												<a href="{{ url('video/'.$video->id.'/view') }}">{{ $video->videoTag->tag->name}}</a>
											</div>
										@endif
									@endif
								</div>
							</li>@endforeach @else
						<li>
							<span> No Video Found</span>

						</li>
					@endif
				</ul>
			@else
				<div class="no-booking">
					<h4>You have not purchased any video yet.
						<a href="{{ url('/skill_development/videos') }}" >Browse Videos here</a></h4>
				</div>
			@endif
		</div>
	</div>
@endsection