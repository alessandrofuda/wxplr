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
	    <link rel='stylesheet' id='Roboto-css' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700'>
	    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	    <link rel='stylesheet' id='Patua+One-css' href='https://fonts.googleapis.com/css?family=Patua+One:100,300,400,400italic,700'>

	    <!-- CSS -->
	    <link rel='stylesheet' id='global-css'  href="{{ asset('frontend/css/global.css') }}">
	    <link rel='stylesheet' id='structure-css' href='{{ asset('frontend/css/structure.css') }}'>
	    <link rel='stylesheet' id='style-static' href='{{ asset('frontend/css/be_style.css') }}'>
	    <link rel='stylesheet' id='style-static' href='{{ asset('frontend/css/style.css') }}'>
	    <link rel='stylesheet' id='custom-css' href='{{ asset('frontend/css/custom.css') }}'>

	    <link rel="stylesheet" href="{{  \Route::getCurrentRoute()->uri() != "/" ? asset('frontend/css/bootstrap.min.css') : ""}}" type="text/css">
	    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}" type="text/css">
	    <link rel="stylesheet" href="{{ asset('frontend/css/custom_old.css') }}" type="text/css">
	    <link rel="stylesheet" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
	    <script src="{{ asset('frontend/js/jquery-1.11.3.js') }}"></script>
	</head>

	<body class="home page template-slider menu-line-below layout-full-width header-classic sticky-header sticky-white subheader-title-left no-content-padding">
		<div id="Wrapper">
		    <div id="Header_wrapper">
			    <header id="Header">
			        <div id="Action_bar">
			            <div class="container">
			                <div class="column one">
			                </div>
			            </div>
			        </div>
			        <div id="Top_bar">
			            <div class="container">
			                <div class="column one">
			                    <div class="top_bar_left clearfix">
			                        <!-- Logo-->
			                        <div class="logo">
			                            <a id="logo" href="https://www.wexplore.eu" title="Wexplore">
			                                <img class="scale-with-grid" src="{{ asset('frontend/images/wexplore-logo.svg') }}" alt="Wexplore" />
			                            </a>
			                        </div>
			                        <div class="banner_wrapper">
			                            <a href="#" target="_blank"></a>
			                        </div>
			                        <!-- Header Searchform area-->
			                        <div class="search_wrapper">
			                            <form method="get" action="#">
			                                <i class="icon_search icon-search"></i><a href="#" class="icon_close"><i class="icon-cancel"></i></a>
			                                <input type="text" class="field" name="s" placeholder="Enter your search" />
			                                <input type="submit flv_disp_none" class="submit" value="" />
			                            </form>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			        <!-- Revolution slider area-->
			    </header>
			</div>
			@yield('content')

			<!-- Footer-->
			{{-- @ include ('front.footer') --}}

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