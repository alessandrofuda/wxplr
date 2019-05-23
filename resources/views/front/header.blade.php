
<header id="Header">
    <!-- Header Top -  Info Area -->
    <div id="Action_bar">
        <div class="container">
            <div class="column one">
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
                                            @if(Route::currentRouteName() != 'user.dashboard')
                                                <li>
                                                    <a href="/user/dashboard" style="padding-bottom: 10px;">
                                                        <span>Dashboard</span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a style="padding-bottom: 10px;">
                                                    <span>
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
                    <!--div class="secondary_menu_wrapper">
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
                    </div-->
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
