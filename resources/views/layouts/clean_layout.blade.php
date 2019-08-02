{{-- no header/footer/sidebar layout --}}
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
	<!--<![endif]-->
	<head>
	    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ID') }}"></script>
	    <script>
	      window.dataLayer = window.dataLayer || [];
	      function gtag(){dataLayer.push(arguments);}
	      gtag('js', new Date());

	      gtag('config', '{{ env('GOOGLE_ANALYTICS_ID') }}');
	    </script>
	    <!-- Basic Page Needs -->
	    <meta charset="utf-8">
	    <title>{{ isset($meta_tag->title ) ? $meta_tag->title : "Wexplore" }}</title>
	    <meta name="description" content="{{ isset($meta_tag->meta_description ) ? $meta_tag->meta_description : "" }}">
	    <meta name="title" content="{{ isset($meta_tag->meta_title ) ? $meta_tag->meta_title : "" }}">
	    <meta name="author" content="">
	    <!-- Mobile Specific Metas -->
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	    <!-- Favicons -->
	    <link rel="shortcut icon" href="{{ asset('frontend/immagini/favicon.ico') }}">

	    <!-- FONTS -->
    	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
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

	    <script src="{{ asset('frontend/js/jquery-1.11.3.js') }}"></script>
	</head>

	<body class="home page template-slider menu-line-below layout-full-width header-classic sticky-header sticky-white subheader-title-left no-content-padding">
		<div id="Wrapper">
		    
			@yield('content')

		</div>
		<!-- JS -->
		<script type="text/javascript" src="{{ asset('frontend/js/mfn.menu.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/jquery.plugins.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/email.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/scripts.js') }}"></script>
		
		<!-- user timezone -->
		<input type="hidden" id="user_timezone" value="{{ session('timezone') }}">
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js">
		</script>
		<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript">
		    jQuery.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': "{{ csrf_token() }}"
		        }
		    });
		    jQuery(document).ready(function(){
		        var tz = jstz.determine(); // Determines the time zone of the browser client..
		        var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.
		        var val = jQuery("#user_timezone").val();

		        if(val == "") {
		            jQuery.ajax({
		                url:"{{ url('user/set-timezone') }}",
		                type:"POST",
		                _token:"{{ csrf_token() }}",
		                data:{'timezone':timezone},
		                success:function() {
		                    jQuery("#user_timezone").val(timezone);
		                }
		            })
		        }
		    });
		</script>
	</body>
</html>