
<header id="Header">
    <!-- Header Top -  Info Area -->
    <div id="Action_bar">
        <div class="container">
            <div class="column one">
                <!-- Header - contact info area
                <ul class="contact_details">
                    <li class="phone">
                        <i class="icon-clock"></i>{{-- isset($settings) ? $settings->timings : "MON - SAT: 9.00 - 18.00" --}}
                    </li>
                    <li class="mail">
                        <i class="icon-mail-line"></i><a style="color:#ffffff;" href="mailto:{{-- isset($settings) ? $settings->website_email  : 'info@wexplore.com'}}"> {{ isset($settings) ? $settings->website_email  : 'info@wexplore.com'--}}</a>
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
    <div id="Top_bar" style="z-index: 99999;">
        <div class="container">
            <div class="column one">
                <div class="top_bar_left clearfix">
                    <!-- Logo-->
                    <div class="logo">
                        <a id="logo" href="{{ URL::to('/') }}" title="Wexplore">           
                            <img class="scale-with-grid" src="{{ asset('frontend/images/wexplore-logo.svg') }}" alt="Wexplore" /> 
                        </a>
                    </div>
                    <!-- Main menu-->
                        <div class="menu_wrapper">
                            <nav id="menu">
                                <ul class="menu" id="menu-main-menu" style="margin-bottom:auto;">
                                    <!--@if(isset($navigation))
                                        @foreach ($navigation as $nav)
                                            <li  id="menu-item-1354"  class="{{--\Route::getCurrentRoute()->uri() == url($nav->path) ? "current_page_item" : ""--}}" ><a href="{{-- url($nav->path) --}}"><span>{{-- $nav->title --}}</span></a></li>
                                        @endforeach
                                    @endif-->
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
                                                <a href="/consultant/dashboard" style="padding-bottom: 10px;">
                                                    <span>Dashboard 
                                                        @if(!empty(Auth::user()->consultantProfile->profile_picture))
                                                            <img class="img-circle" src="{{asset(Auth::user()->consultantProfile->profile_picture) }}" alt="" width="35px" height="35px"/>                                                                    
                                                        @else
                                                            <img class="img-circle" src="/frontend/immagini/user.png" alt="" />
                                                        @endif
                                                    </span>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="/user/dashboard" style="padding-bottom: 10px;">
                                                    <span>Dashboard 
                                                        @if(!empty(Auth::user()->userProfile->profile_picture))
                                                            <img class="img-circle" src="{{ asset(Auth::user()->userProfile->profile_picture) }}" alt="" width="35px" height="35px" />
                                                        @else
                                                            <img class="img-circle" src="/frontend/immagini/user.png" alt="" />
                                                        @endif
                                                    </span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    <li>
                                        <!--<a href="/it"><span><img src="/frontend/immagini/Flag-ita.jpg" alt="" /></span></a>-->
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
</header>
