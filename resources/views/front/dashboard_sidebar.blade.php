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
          <a href="{{ url('user/dashboard') }}">
            <span>Dashboard</span> <!--<i class="fa fa-angle-left pull-right"></i>-->
          </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "global_orientation_test" ? "active open" : ""}}">
            <a href="{{ url('global_orientation_test') }}">
              <span>Got</span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "user/got-pro" ? "active open" : ""}}">
            <a href="{{ url('user/got-pro') }}">
              <span>GOT <span style="text-transform: none;">Pro</span></span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "user/wow" ? "active open" : ""}}">
            <a href="http://eepurl.com/grpRwb{{-- url('user/wow') --}}">
              <span>WOW</span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "user/career-ready" ? "active open" : ""}}">
            <a href="http://eepurl.com/grpRwb{{-- url('user/career-ready') --}}">
              <span>VIC</span>
            </a>
        </li>
      </ul>
      <div class="sidebar-bottom">
        <div class="start-square">Start with our free feature like GOT or see our WOW video!</div>
      </div>
      <div class="sidebar-bottom-corner-container">
        <img class="sidebar-bottom-corner" src="{{asset('frontend/images/sidebar/sidebar_bottom.png')}}">
      </div>
    </section>
    <!-- /.sidebar -->
  </aside>
