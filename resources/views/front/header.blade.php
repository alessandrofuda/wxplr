<header id="Header">
    <div id="Action_bar">
        <div class="container">
            <div class="column one">
            </div>
        </div>
    </div>
    <div id="Top_bar" style="z-index: 99999;">
        <div class="container">
            <div class="column one">
                <div class="top_bar_left clearfix">
                        <div class="menu_wrapper">
                            <nav id="menu">
                                <ul id="menu-main-menu" class="menu nav" style="margin-bottom:auto;">
                                    @if(!\Auth::check())
                                        <li>
                                            <a href="{{ url('auth/login') }}"><span>Login</span></a>
                                        </li>
                                    @else
                                        @if(Route::currentRouteName() != 'user.dashboard')
                                            <li>
                                                <a href="/user/dashboard" style="padding-bottom: 10px;">
                                                    <span>Dashboard</span>
                                                </a>
                                            </li>
                                        @endif
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                <span>
                                                    @if(!empty(Auth::user()->userProfile->profile_picture))
                                                        <img class="img-circle" src="{{ asset(Auth::user()->userProfile->profile_picture) }}" alt="" width="35px" height="35px" />
                                                    @else
                                                        <img class="img-circle" src="/frontend/images/wexplore-logo-tondo-plain.png" alt="" />
                                                    @endif
                                                    {{ ucfirst(Auth::user()->name) }} {{ ucfirst(Auth::user()->surname) }} <span class="caret"></span>
                                                </span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="https://www.wexplore.eu">Home</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('auth/logout') }}">Logout</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </nav><a href="#" class="responsive-menu-toggle "><i class="icon-menu"></i></a>
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
</header>
