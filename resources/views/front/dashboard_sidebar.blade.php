<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar main-side-cls">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="text-center image">
            <img src="{{asset('frontend/images/wexplore-logo-tondo.png')}}" class="img-circle logo-tondo" alt="User Image">
        </div>
      </div>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="{{\Route::getCurrentRoute()->uri() == "user/dashboard" ? "active open" : ""}}">
          <a href="{{ route('user.dashboard') }}">
            <span>Dashboard</span> 
          </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "global_orientation_test_intro" ? "active open" : ""}}">
            <a href="{{ route('got_intro') }}">
              <span>Got</span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "user/got-pro" ? "active open" : ""}}">
            <a href="{{ route('got_pro') }}">
              <span>GOT <span style="text-transform: none;">Pro</span></span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "user/vic" ? "active open" : ""}}">
            <a href="{{ route('vic') }}{{-- http://eepurl.com/grpRwb --}}">
              <span>VIC</span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "user/wow" ? "active open" : ""}}">
            <a href="http://eepurl.com/grpRwb{{-- route('wow') --}}">
              <span>WOW</span>
            </a>
        </li>
      </ul>
      <div class="sidebar-bottom">
        @if (!empty($got_compiled) && $got_compiled === true)
          <div class="start-square">Try Got PRO:<br/>discover the three best locations for you</div>
        @else
          <div class="start-square">Start with our free feature like GOT or see our WOW video!</div>
        @endif
      </div>
      <div class="sidebar-bottom-corner-container">
        <img class="sidebar-bottom-corner" src="{{asset('frontend/images/sidebar/sidebar_bottom.png')}}">
      </div>
    </section>
    <!-- /.sidebar -->
  </aside>
