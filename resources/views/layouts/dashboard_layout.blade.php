<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 "> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <!--Google Analytics-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.id') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ config('services.google_analytics.id') }}');
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

    @stack('js-libraries')

</head>

<body class="home page template-slider menu-line-below layout-full-width header-classic sticky-header sticky-white subheader-title-left no-content-padding">
    <div id="Wrapper">
        <div id="Header_wrapper">
            <!-- Header -->
            @include('front.header')

            <div class="user-wrapper">

            	@php 
                    $roles_arr = [];
                @endphp

                @if(isset(Auth::user()->userRoles))
                    @foreach(Auth::user()->userRoles as $roles)
                        <?php $roles_arr[] = $roles->role_id; ?>
                    @endforeach
                @endif

            	@if(in_array(2,$roles_arr))
            	    @include('front.consultant_dashboard_sidebar')
            	@else
            	    @include('front.dashboard_sidebar')
            	@endif

                <div class="content-wrapper user-dash-wrapper">
                    <section class="content">
                        <div class="section-row">
                          <div class="notifications">

                              @if (session('status'))
                                  <div class="alert alert-success">
                                    {{ session('status') }}
                                  </div>
                              @endif
                              
                              @if (session('error'))
                                <div class="alert alert-failure" style="background-color:#f73737;">
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
                        </div>
                      @yield('content')

                    </section>
                </div>
            </div>

            @include('front.footer')

            @yield('footer_resources')
        </div>
    </div>

    <div class="report-loading-modal" style="display:none; position:absolute; top: calc(50% - 150px); left: calc(50% - 150px); width:300px; height:300px; border:1px solid black;">
        <div class="">Wait a moment please.. <br>we're going to generate your report..</div>
        <div class="img-container"><img class="img-fluid" src="http://rpg.drivethrustuff.com/shared_images/ajax-loader.gif" style="max-width: 100%;"></div>
        <a class="btn btn-cta light">Close</a>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-1.11.3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/mfn.menu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.plugins.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.jplayer.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/animations/animations.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/email.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/scripts.js') }}"></script>
    
    <input type="hidden" id="user_timezone" value="{{ session('timezone') }}">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
    <script type="text/javascript">
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        jQuery(document).ready(function(){
            var tz = jstz.determine(); // Determines the time zone of the browser client,
            var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.
            var val = jQuery("#user_timezone").val();
            var _token = "{{ csrf_token() }}";
            if(val == "") {
                jQuery.ajax({
                    url:"{{ url('user/set-timezone') }}",
                    type:"POST",

                    data:{'timezone':timezone, '_token': _token},
                    success:function() {
                        jQuery("#user_timezone").val(timezone);
                    }
                })
            }
        });
    </script>
    <script>
        jQuery(document).ready(function(){
            jQuery('button#back').click(function(e){
                e.preventDefault();
                parent.history.back();
                return false;
            });
        });
    </script>
    <script>
        // fix footer to bottom of page
        var window_h = jQuery(document).height();
        var head_h = jQuery('header').height();
        var foot_h = jQuery('footer').height();
        var h = window_h-head_h-foot_h+10;
        jQuery('.content-wrapper').css('min-height', h+'px');
    </script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom-2.js') }}"></script>

    @yield('js')
    @stack('scripts')

</body>

</html>