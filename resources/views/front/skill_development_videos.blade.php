@extends('front.new_layout')
@section('content')
<div class="container">
	<div class="row">
		<h3>{{ $page_title }}</h3>
		<div class="page-wrapper">
		<div class="col-md-12">
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
            </div>
			<div class="search-wrapper Videos-Listing">
				<form method="post" role="form">
					{{ csrf_field() }}
					<div class="form-group col-md-5 col-sm-5 col-xs-12">
					<input placeholder="Type tags" value="{{ $tag_names }}"id="tag" type="text" name="tag" class="form-control">
					</div>
					<div class="form-group col-md-5 col-sm-5 col-xs-12">
					<select class="form-control" name="category">
						<option>---SELECT CATEGORY---</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}" @if( $category_name  == $category->category_name) selected @endif >{{ $category->category_name }}</option>
						@endforeach
					</select>
					</div>
					<div class="form-group col-md-2 col-sm-2 col-xs-12">
						<input type="submit" name="submit" value="Search">
					</div>
				</form>
			</div>

		<!-- <script src="{{ asset('frontend/jwplayer/jwplayer.js') }}"></script>
		<script>jwplayer.key="g4fPsuTO2p03J7jp0MB28FBaHRlIYi4L56gXKg";</script>
		<div id="mainVideo"></div> -->
		<div id="mainVideoThumbs">
			<!-- <ul class="thumbs_ul">
				@if(isset($videos) && count($videos) > 0)
					@foreach($videos as $video)
					​<li><a href="javascript:playTrailer('{{ asset($video->uploaded_video) }}', '{{ asset($video->video_image) }}')"><img alt="" border="0" width="150" src="{{ asset($video->video_image) }}" /></a>
					<span class="play_button"><i class="fa fa-play-circle" aria-hidden="true"></i></span>
                        <div class="overy_buttons">
                        	<a href="{{ url('video/'.$video->id.'/view') }}" id="video_buy_code_{{ $video->id }}">{{ $video->video_title }} <br/> Purchase Now <br/> €{{ $video->price }}</a>
						</div>
						</li>
						​@endforeach
				@endif
			</ul> -->
<ul class="video_listing">
	@if(isset($videos) && count($videos) > 0)
		@foreach($videos as $video)<li>
				<a href="{{ url('video/'.$video->id.'/view') }}"><img src="{{ asset($video->video_image) }}" alt="{{ $video->video_title }}"></a>
				<div class="video_details">
					<h2><a href="#">{{ $video->video_title }}</a></h2>
					<span class="posted_by">In {{ $video->videoCategory->category_name  }} </span>
					<div class="video_price">€{{ $video->price }}</div>
					<div class="unit_duration"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $video->getDuration() }} </div>
					@if(isset($video->videoTag->tag->name))
						@if($video->videoTag->tag->name != null)
							<div class="unit_topic_tag">
								<a href="#">{{ $video->videoTag->tag->name}}</a>
							</div>
						@endif
					@endif
				</div>
			</li>​@endforeach @else
		<li>
			<span> No Video Found</span>

		</li>
	@endif
</ul>
</div>




		<script type="text/JavaScript">
         	var data = "{{  json_encode($tags) }}";
			var data = JSON.parse(data.replace(/&quot;/g,'"'));

			$("#tag").mSelectDBox({
				"list":data,
				"multiple": true,
				"autoComplete": true,
				"name" : "a",
			});

		var playerInstance = jwplayer("mainVideo");
		playerInstance.setup({
			file: "http://127.0.0.1/wexplore/uploads/sdvideo/test7.mp4",
			mediaid: "MEDIAID",
		});
		function playTrailer(video, thumb) {
			playerInstance.load([{
			  file: video,
			  image: thumb
			}]);
			playerInstance.play();
		}
		</script>
		</div>		
	</div>
</div>
@endsection

