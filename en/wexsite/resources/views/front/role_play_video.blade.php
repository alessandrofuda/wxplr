@extends('front.layout')
@section('content')
<div class="container">
	<div class="row">
		<h3>{{ $page_title }}</h3>
		<div class="page-wrapper">
		<script src="{{ asset('frontend/jwplayer/jwplayer.js') }}"></script>
		<script>jwplayer.key="g4fPsuTO2p03J7jp0MB28FBaHRlIYi4L56gXKg";</script>

		<div id="mainVideo"></div>

		<script type="text/JavaScript">
		var playerInstance = jwplayer("mainVideo");
		playerInstance.setup({
			file: "rtmp:http://192.168.1.58/videochat/testing",
			height: 360,
			width: 640,
			image: "/assets/myLivestream.jpg",
			rtmp: {
				subscribe: true
			}
		});
		</script>
		</div>		
	</div>
</div>
@endsection

