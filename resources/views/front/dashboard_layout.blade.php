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

    @if(isset($meta_tags))
        @foreach($meta_tags as $meta_tag)
            <meta name="{{ $meta_tag->name }}" content="{{ $meta_tag->content }}">
        @endforeach
    @endif

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('frontend/immagini/favicon.ico') }}">

    <!-- FONTS -->
    <link rel='stylesheet' id='Roboto-css' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700'>
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
    <!-- Revolution Slider -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/rs-plugin/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">

    <script src="{{ asset('frontend/js/jquery-1.11.3.js') }}"></script>
    <!-- owl carousel css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl-custom.css') }}" type="text/css">
    <!-- owl carousel css-->
</head>

<body class="home page template-slider menu-line-below layout-full-width header-classic sticky-header sticky-white subheader-title-left no-content-padding">
    <!-- Main Theme Wrapper -->
    <div id="Wrapper">
        <!-- Header Wrapper -->
        <div id="Header_wrapper">
            @include('cookieConsent::index')
            <!-- Header -->
            @include('front.header')

            @include('front.dashboard_header')

            <div class="user-wrapper">

            	<?php $roles_arr = []; ?>

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

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper user-dash-wrapper">
                    <!-- Content Header (Page header) -->
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                          <div class="col-md-12">

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
                    <!-- /.content -->
                </div>
            </div>

            @include('front.footer')

            @yield('footer_resources')
        </div>

        <!-- JS -->
        <script type="text/javascript" src="{{ asset('frontend/js/mfn.menu.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.jplayer.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/animations/animations.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/email.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/scripts.js') }}"></script>

        <script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.video.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.actions.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.navigation.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.migration.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.parallax.min.js') }}"></script>

        <script type="text/javascript">
            var tpj = jQuery;
            tpj.noConflict();
            var revapi34;
            tpj(document).ready(function() {
                if (tpj("#rev_slider_34_2").revolution == undefined) {
                    revslider_showDoubleJqueryError("#rev_slider_34_2");
                } else {
                    revapi34 = tpj("#rev_slider_34_2").show().revolution({
                        sliderType: "standard",

                        sliderLayout: "auto",
                        dottedOverlay: "none",
                        delay: 7000,
                        navigation: {
                            keyboardNavigation: "off",
                            keyboard_direction: "horizontal",
                            mouseScrollNavigation: "off",
                            onHoverStop: "on",
                            touch: {
                                touchenabled: "on",
                                swipe_threshold: 0.7,
                                swipe_min_touches: 1,
                                swipe_direction: "horizontal",
                                drag_block_vertical: false
                            },
                            arrows: {
                                style: "uranus",
                                enable: true,
                                hide_onmobile: false,
                                hide_onleave: false,
                                tmp: '',
                                left: {
                                    h_align: "right",
                                    v_align: "bottom",
                                    h_offset: 90,
                                    v_offset: 40
                                },
                                right: {
                                    h_align: "right",
                                    v_align: "bottom",
                                    h_offset: 40,
                                    v_offset: 40
                                }
                            },
                            thumbnails: {
                                style: "hesperiden",
                                enable: true,
                                width: 200,
                                height: 80,
                                min_width: 100,
                                wrapper_padding: 5,
                                wrapper_color: "transparent",
                                wrapper_opacity: "1",
                                tmp: '<span class="tp-thumb-image"></span><span class="tp-thumb-title">Slide</span>',
                                visibleAmount: 3,
                                hide_onmobile: true,
                                hide_under: 0,
                                hide_onleave: false,
                                direction: "horizontal",
                                span: false,
                                position: "inner",
                                space: 5,
                                h_align: "left",
                                v_align: "bottom",
                                h_offset: 40,
                                v_offset: 40
                            }
                        },
                        gridwidth: 1180,
                        gridheight: 550,
                        lazyType: "none",
                        shadow: 0,
                        spinner: "spinner3",
                        stopLoop: "off",
                        stopAfterLoops: -1,
                        stopAtSlide: -1,
                        shuffle: "off",
                        autoHeight: "off",
                        disableProgressBar: "on",
                        hideThumbsOnMobile: "on",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        startWithSlide: 0,
                        debugMode: false,
                        fallbacks: {
                            simplifyAll: "on",
                            nextSlideOnWindowFocus: "off",
                            disableFocusListener: "off",
                        }
                    });
                }
            });
        </script>

        <script>
            jQuery(window).load(function() {
                var retina = window.devicePixelRatio > 1 ? true : false;
                if (retina) {
                    var retinaEl = jQuery("#logo img");
                    var retinaLogoW = retinaEl.width();
                    var retinaLogoH = retinaEl.height();
                    retinaEl.attr("src", "{{ asset('frontend/immagini/logo-wexplore-retina.png') }}").width(retinaLogoW).height(retinaLogoH)
                }
            });
        </script>
        <input type="hidden" id="user_timezone" value="{{ session('timezone') }}">
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
        <script type="text/javascript">
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            jQuery(document).ready(function(){
                var tz = jstz.determine(); // Determines the time zone of the browser client
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


        <!--footer close-->
        <!-- owl carousel js-->

        <!-- owl carousel js-->
        <script id="dsq-count-scr" src="//wexplore-com.disqus.com/count.js" async></script>
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        @yield('js')
    </div>
</body>

</html>