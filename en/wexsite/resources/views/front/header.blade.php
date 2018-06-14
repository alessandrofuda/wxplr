<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 "> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>

<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86105348-1', 'auto');
  ga('set', 'anonymizeIp', true);
  ga('send', 'pageview');

</script>

<!-- Facebook Pixel Code -->
<!--script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '395106547540931'); // Insert your pixel ID here.
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=395106547540931&ev=PageView&noscript=1"
/></noscript-->
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

    <!-- Basic Page Needs -->
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

    <link rel="stylesheet" href="{{  \Route::getCurrentRoute()->getPath() != "/" ? asset('frontend/css/bootstrap.min.css') : ""}}" type="text/css">
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
        <header id="Header">
            <!-- Header Top -  Info Area -->
            <div id="Action_bar">
                <div class="container">
                    <div class="column one">
                        <!-- Header - contact info area
                        <ul class="contact_details">
                            <li class="phone">
                                <i class="icon-clock"></i>{{ isset($settings) ? $settings->timings : "MON - SAT: 9.00 - 18.00" }}
                            </li>
                            <li class="mail">
                                <i class="icon-mail-line"></i><a style="color:#ffffff;" href="mailto:{{ isset($settings) ? $settings->website_email  : 'info@wexplore.com'}}"> {{ isset($settings) ? $settings->website_email  : 'info@wexplore.com'}}</a>
                            </li>
                        </ul>-->
                        <!--Social info area
                        <ul class="social">
                            <li class="skype">
                                <a href="#" title="Skype"><i class="icon-skype"></i></a>
                            </li>
                            <li class="facebook">
                                <a href="http://www.facebook.com/Beantown-Themes-653197714728193" title="Facebook"><i class="icon-facebook"></i></a>
                            </li>
                            <li class="googleplus">
                                <a href="http://plus.google.com/" title="Google+"><i class="icon-gplus"></i></a>
                            </li>
                            <li class="twitter">
                                <a href="http://twitter.com/Muffin_Group" title="Twitter"><i class="icon-twitter"></i></a>
                            </li>
                            <li class="vimeo">
                                <a href="http://vimeo.com/" title="Vimeo"><i class="icon-vimeo"></i></a>
                            </li>
                            <li class="youtube">
                                <a href="#" title="Dribbble"><i class="icon-play"></i></a>
                            </li>
                            <li class="flickr">
                                <a href="http://www.flickr.com/" title="Flickr"><i class="icon-flickr"></i></a>
                            </li>
                            <li class="pinterest">
                                <a href="http://www.pinterest.com/" title="Pinterest"><i class="icon-pinterest"></i></a>
                            </li>
                            <li class="dribbble">
                                <a href="https://dribbble.com" title="Dribbble"><i class="icon-dribbble"></i></a>
                            </li>
                        </ul>-->

                    </div>
                </div>
            </div>
            <!-- Header -  Logo and Menu area -->
            <div id="Top_bar" style="z-index: 999;">
                <div class="container">
                    <div class="column one">
                        <div class="top_bar_left clearfix">
                            <!-- Logo-->
                            <div class="logo">
                                <a id="logo" href="{{ URL::to('/') }}" title="Wexplore">
                                    @if(isset($settings))
                                        <img class="scale-with-grid"  src="{{ asset($settings->logo) }}" alt="Wexplore">
                                    @else
                                        <img class="scale-with-grid" src="{{ asset('frontend/immagini/logo-wexplore.png') }}" alt="Wexplore" />
                                    @endif
                                </a>
                            </div>
                            <!-- Main menu-->
                                <div class="menu_wrapper">
                                    <nav id="menu">
                                        <ul class="menu" id="menu-main-menu">
                                            @if(isset($navigation))
                                                @foreach ($navigation as $nav)
                                                    <li  id="menu-item-1354"  class="{{\Route::getCurrentRoute()->getPath() == url($nav->path) ? "current_page_item" : ""}}" ><a href="{{ url($nav->path) }}"><span>{{ $nav->title }}</span></a></li>
                                                @endforeach
                                            @endif
                                            @if(!\Auth::check())
                                            <li>
                                                <a href="{{ url('auth/login') }}"><span>Login</span></a>
                                            </li>
                                            @else
                                            <li>
                                                <a href="{{ url('auth/logout') }}"><span>Logout</span></a>
                                            </li>
                                                @if(\Auth::user()->isConsultant())
                                                    <li>
                                                        <a href="/en/consultant/dashboard"><span><img src="/en/frontend/immagini/user.png" alt="" /></span></a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="/en/user/dashboard"><span><img src="/en/frontend/immagini/user.png" alt="" /></span></a>
                                                    </li>
                                                @endif
                                            @endif
                                            <li>
                                                <!--<a href="/it"><span><img src="/en/frontend/immagini/Flag-ita.jpg" alt="" /></span></a>-->
                                            </li>

                                        </ul>
                                    </nav><a href="#" class="responsive-menu-toggle "><i class="icon-menu"></i></a>
                                </div>
                            <!-- Secondary menu area - only for certain pages -->
                            <div class="secondary_menu_wrapper">
                                <nav id="secondary-menu" class="menu-secondary-menu-container">
                                    <ul id="menu-secondary-menu" class="secondary-menu">
                                        <li class="_menu-item-1568">
                                            <a href="index.html">Home</a>
                                        </li>
                                        <li class=" menu-item-1573">
                                            <a href="contact.html"> </a>
                                        </li>
                                        <li class="menu-item-1574">
                                            <a href="shop.html">Shop</a>
                                            <ul class="sub-menu">
                                                <li class=" menu-item-1569">
                                                    <a href="#">Shopping Cart</a>
                                                </li>
                                                <li class=" menu-item-1570">
                                                    <a href="#">Checkout</a>
                                                </li>
                                                <li class=" menu-item-1571">
                                                    <a href="#">My Account</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-1583">
                                            <a target="_blank" href="https://themeforest.net/user/BeantownThemes/portfolio?ref=BeantownThemes">Buy it now !</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- Banner area - only for certain pages-->
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
