<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 "> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>Wexplore</title>
    <meta name="description" content="">
    <meta name="author" content="">

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
    <script src="{{ asset('frontend/js/jquery-1.12.4.js') }}"></script>

</head>

<body class="home page template-slider menu-line-below layout-full-width header-classic sticky-header sticky-white subheader-title-left no-content-padding">



<!-- Main Theme Wrapper -->
<div id="Wrapper">
    <!-- Header Wrapper -->
    <div id="Header_wrapper">
        <!-- Header -->
        @include('cookieConsent::index')
        <header id="Header">

            <!-- Header Top -  Info Area -->
            <div id="Action_bar">
                <div class="container">
                    <div class="column one">
                        <!-- Header - contact info area-->
                        <ul class="contact_details">
                            <li class="phone">
                                <i class="icon-clock"></i><a href="{{ str_replace('/en/','/it/',$_SERVER['REQUEST_URI']) }}">Italian</a>
                            </li>
                            <li class="phone">
                                <i class="icon-clock"></i>{{ isset($settings) ? $settings->timings : "MON - SAT: 9.00 - 18.00" }}
                            </li>
                            <li class="mail">
                                <i class="icon-mail-line"></i><a style="color:#ffffff;" href="mailto:{{ isset($settings) ? $settings->website_email  : 'info@wexplore.com'}}"> {{ isset($settings) ? $settings->website_email  : 'info@wexplore.com'}}</a>
                            </li>
                        </ul>
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

                <div id="Top_bar">
                    <div class="container">
                        <div class="column one">
                            <div class="top_bar_left clearfix" style="width: 1137px;">
                                <!-- Logo-->
                                <div class="logo">
                                    <a title="Wexplore" href="{{ URL::to('/') }}" id="logo">
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
                                            </li>@else<li>
                                                        <a href="{{ url('auth/logout') }}"><span>Logout</span></a></li>

                                                    @endif

                                        </ul>
                                    </nav><a href="#" class="responsive-menu-toggle "><i class="icon-menu"></i></a>
                                </div>
                                <!-- Secondary menu area - only for certain pages -->
                                <div class="secondary_menu_wrapper">
                                    <nav class="menu-secondary-menu-container" id="secondary-menu">
                                        <ul class="secondary-menu" id="menu-secondary-menu">
                                            <li class="_menu-item-1568">
                                                <a href="{{ url('/') }}">Home</a>
                                            </li>
                                            <li class=" menu-item-1573">
                                                <a href="{{ url('/contact-us') }}"> </a>
                                            </li>
                                            @if(isset($navigation))
                                                @foreach ($navigation as $nav)
                                                    <li  id="menu-item-1574 submenu"  class="{{\Route::getCurrentRoute()->getPath() == url($nav->path) ? "current_page_item" : ""}}" ><a href="{{ url($nav->path) }}"><span>{{ $nav->title }}</span></a></li>
                                                @endforeach
                                            @endif
                                            @if(!\Auth::check())
                                                <li>
                                                    <a href="{{ url('auth/login') }}"><span>Login</span></a>
                                                </li>@else<li>
                                                <a href="{{ url('auth/logout') }}"><span>Logout</span></a></li>

                                            @endif
                                           {{-- <li class="menu-item-1574 submenu">
                                                <a href="shop.html">Shop</a>
                                                <ul class="sub-menu">
                                                    <li class=" menu-item-1569">
                                                        <a href="#">Shopping Cart</a>
                                                    </li>
                                                    <li class=" menu-item-1570">
                                                        <a href="#">Checkout</a>
                                                    </li>
                                                    <li class="menu-item-1571 last-item">
                                                        <a href="#">My Account</a>
                                                    </li>
                                                </ul>
                                                <span class="menu-toggle"></span></li>
                                            <li class="menu-item-1583">
                                                <a href="http://themeforest.net/user/BeantownThemes/portfolio?ref=BeantownThemes" target="_blank">Buy it now !</a>
                                            </li>--}}
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Banner area - only for certain pages-->
                                <div class="banner_wrapper">
                                    <a target="_blank" href="#"><img alt="" src="{{ asset('frontend/images/468x60.gif') }}">
                                    </a>
                                </div>
                                <!-- Header Searchform area-->
                                <div class="search_wrapper">
                                    <form action="#" method="get">
                                        <i class="icon_search icon-search"></i><a class="icon_close" href="#"><i class="icon-cancel"></i></a>
                                        <input type="text" placeholder="Enter your search" name="s" class="field">
                                        <input type="submit flv_disp_none" value="" class="submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Revolution slider area-->
