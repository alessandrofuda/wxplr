@extends(Auth::user() ?'front.dashboard_layout' : 'front.new_layout');
@section('content')
<div class="container">
	<div class="row">
		<h3>{{ $page_title }}</h3>
		<div class="page-wrapper">
		<div class="video_view_left">
			@if(!isset($purchased))
				@if($video->preview_vimeo_path != null)
					{!! $video->getIframe('preview_vimeo_path') !!}
				@else
					<div id="mainVideo"></div>
				@endif
			@else
				@if($video->vimeo_path != null)
					{!! $video->getIframe() !!}
				@else
					<div id="mainVideo"></div>
				@endif
			@endif
			<div class="video_other_details">
				@if(isset($video->videoTag->tag->name))
					<div class="tag">
					<span>tag</span>
						{{ $video->videoTag->tag->name}}
					</div>
				@endif
				<div class="category">
				<span>category</span>
					{{ $video->videoCategory->category_name }}
				</div>
				<div class="duration">
				<span>duration</span>
						{{ $video->getDuration() }}
					</div>
					@if(!isset($purchased))
				<div class="description">
					<p>{{ $video->description }}</p>
				</div>
						@endif
			</div>
		</div>
		<div class="video_view_right">
			<div class="Video_details">
				<div class="title">{{ $video->video_title }}</div>
				@if(!isset($purchased))
					<div class="price">€{{ $video->price}}</div>
					<div class="buy"><a href="{{ url('video/'.$video->id.'/purchase') }}">Purchase Video</a>
				@else
					<div class="descrition">
						{{ $video->description }}
					</div>
				@endif

				</div>
			</div>
		</div>
			@if(!isset($purchased))
				@if($video->preview_vimeo_path == null)
					<script src="{{ asset('frontend/jwplayer/jwplayer.js') }}">
					</script>
					<script>jwplayer.key="g4fPsuTO2p03J7jp0MB28FBaHRlIYi4L56gXKg";</script>
				<script type="text/JavaScript">
					var playerInstance = jwplayer("mainVideo");
				playerInstance.setup({
					file: "{{ asset($video->preview_video) }}",
					mediaid: "MEDIAID",
					image: "{{ asset($video->video_image) }}"
				});
				function playTrailer(video, thumb) {
					playerInstance.load([{
					  file: video,
					  image: thumb
					}]);
					playerInstance.play();
				}
				</script>
				@endif
			@else
				@if($video->vimeo_path == null)
					<script src="{{ asset('frontend/jwplayer/jwplayer.js') }}">
					</script>
					<script>jwplayer.key="g4fPsuTO2p03J7jp0MB28FBaHRlIYi4L56gXKg";</script>
					<script type="text/JavaScript">
						var playerInstance = jwplayer("mainVideo");
						playerInstance.setup({
							file: "{{ asset($video->preview_video) }}",
							mediaid: "MEDIAID",
							image: "{{ asset($video->video_image) }}"
						});
						function playTrailer(video, thumb) {
							playerInstance.load([{
								file: video,
								image: thumb
							}]);
							playerInstance.play();
						}
					</script>
				@endif
			@endif
		</div>


	</div>
</div>
@endsection

