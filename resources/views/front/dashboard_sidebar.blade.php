<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar main-side-cls">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(isset(Auth::user()->userProfile->profile_picture) && !empty(Auth::user()->userProfile->profile_picture))
          <img src="{{ asset(Auth::user()->userProfile->profile_picture) }}" class="img-circle" alt="User Image">
          @else
          <img src="{{ asset('/frontend/images/user_icon.png') }}" class="img-circle" alt="User Image">
          @endif
        </div>
        <div class="pull-left info" style="color:#CCCCCC;">
          <p>Welcome {{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <!--<li class="active treeview">-->
        <li class="{{\Route::getCurrentRoute()->uri() == "user/dashboard" ? "active open" : ""}}">
          <a href="{{ url('user/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <!--<i class="fa fa-angle-left pull-right"></i>-->
          </a>
          <!--ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul-->
        </li>
         <li class="{{\Route::getCurrentRoute()->uri() == "user/profile" ? "active open" : ""}}">
            <a href="{{ url('user/profile') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>My Profile</span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "global_orientation_test" ? "active open" : ""}}">
            <a href="{{ url('global_orientation_test') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>Global Orientation Test</span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "user/got-pro" ? "active open" : ""}}">
            <a href="{{ url('user/got-pro') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>Global Orientation Test Pro</span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "user/career-ready" ? "active open" : ""}}">
            <a href="http://eepurl.com/grpRwb{{-- url('user/career-ready') --}}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>Career Ready - VIC</span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "user/wow" ? "active open" : ""}}">
            <a href="http://eepurl.com/grpRwb{{-- url('user/wow') --}}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>WOW</span>
            </a>
        </li>
        <li class="{{\Route::getCurrentRoute()->uri() == "user/orders" ? "active open" : ""}}"> {{-- link_disabled --}}
            <a href="{{ url('user/orders') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>My Orders</span>
            </a>
        </li>
        <!--li class="treeview  {{-- \Route::getCurrentRoute()->uri() == "user/orders" ? "active open" : ""--}} " >
            <a href="#">
                <i class="glyphicon glyphicon-user"></i>
                <span>My Orders</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu  {{-- \Route::getCurrentRoute()->uri() == "user/orders" ? "active" : "" --}}">
                <li><a href="{{-- url('user/orders') --}}">
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <span>All Orders</span>
                    </a></li>
                <li class="">
                    <a href="{{-- url('/user/packages') --}}">
                        <i class="glyphicon glyphicon-home"></i>
                        <span>MY Packages</span>
                    </a>
                </li>
            </ul>
        </li-->

        <!--li class="{{--\Route::getCurrentRoute()->uri() == "user/mydocuments" ? "active" : ""--}} link_disabled">
            <a href="{{-- url('user/mydocuments') --}}">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                <span>My Documents </span>
            </a>
        </li-->

        <!--li class="{{--\Route::getCurrentRoute()->uri() == "user/myappointments" ? "active" : ""--}}">
            <a href="{{-- url('user/myappointments') --}}">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                <span>My Appointments </span>
            </a>
        </li-->

        <!--li class="{{-- \Route::getCurrentRoute()->uri() == "user/myvideos" ? "active" : ""--}}">
  			<a href="{{-- url('user/myvideos') --}}">
                <i class="fa fa-video-camera" aria-hidden="true"></i>
                <span>My Videos </span>
            </a>
        </li-->
        <!--li class="{{-- \Route::getCurrentRoute()->uri() == "user/events" ? "active" : ""--}}">
            <a href="{{-- url('user/events') --}}">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <span>My Events </span>
            </a>
        </li-->
        <!--li class="{{-- \Route::getCurrentRoute()->uri() == "user/global/dashboard" ? "active" : ""--}}">
            <a href="{{-- url('user/global/dashboard') --}}">
               <i class="fa fa-question" aria-hidden="true"></i>
                <span>My Global Tool Queries </span>
            </a>
        </li-->
        <!--li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-user"></i>
              <span>Users</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{-- url('admin/users') --}}"><i class="fa fa-circle-o"></i>List Users</a></li>
              <li><a href="{{-- url('admin/roles') --}}"><i class="fa fa-circle-o"></i> Roles</a></li>
            </ul>
        </li-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
