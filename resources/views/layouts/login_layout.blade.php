<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
	<!--<![endif]-->
	<head>
	    <!--Google Analytics-->
	    <!-- Global site tag (gtag.js) - Google Analytics -->
	    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ID') }}"></script>
	    <script>
	      window.dataLayer = window.dataLayer || [];
	      function gtag(){dataLayer.push(arguments);}
	      gtag('js', new Date());
	      gtag('config', '{{ env('GOOGLE_ANALYTICS_ID') }}');
	    </script>

	    <meta charset="utf-8">
	    <meta name="author" content="">
	    <title>{{ isset($tag->id) ? $tag->title : "Wexplore" }}</title>
	    <meta name="title" content="{{ isset($tag->id) ? $tag->meta_title : "" }} ">
	    <meta name="meta_description" content="{{ isset($tag->id) ? $tag->meta_description : "" }} ">
	    <!-- Mobile Specific Metas -->
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	    <!-- Favicons -->
	    <link rel="shortcut icon" href="{{ asset('frontend/immagini/favicon.ico') }}">
	    <!-- FONTS -->
	    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	    <script src="https://kit.fontawesome.com/19c354b673.js"></script>
	    <!-- CSS -->
	    <link rel='stylesheet' id='global-css'  href="{{ asset('frontend/css/global.css') }}">
	    <link rel='stylesheet' id='structure-css' href='{{ asset('frontend/css/structure.css') }}'>
	    <link rel='stylesheet' id='style-static' href='{{ asset('frontend/css/be_style.css') }}'>
	    <link rel='stylesheet' id='style-static' href='{{ asset('frontend/css/style.css') }}'>
	    <link rel="stylesheet" href="{{  \Route::getCurrentRoute()->uri() != "/" ? asset('frontend/css/bootstrap.min.css') : ""}}" type="text/css">
	    <link rel="stylesheet" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
	    <link rel="stylesheet" href="{{ asset('/admin/dist/css/AdminLTE.min.css') }}">
	    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}" type="text/css">
	    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}" type="text/css">
	    <link rel="stylesheet" href="{{ asset('frontend/css/custom-2.css') }}" type="text/css">
	</head>

	<body class="home page menu-line-below layout-full-width header-classic sticky-header sticky-white subheader-title-left no-content-padding">
		<!-- Main Theme Wrapper -->
		<div id="Wrapper">

			@yield('content')

			<!-- Footer-->
			{{-- @ include('front.footer') --}}

		</div>
		<!-- JS -->
		<script type="text/javascript" src="{{ asset('frontend/js/mfn.menu.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/jquery.plugins.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/jquery.jplayer.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/animations/animations.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/email.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/scripts.js') }}"></script>
		
		<input type="hidden" id="user_timezone" value="{{ session('timezone') }}">
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js">
		</script>
		<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	</body>
</html>