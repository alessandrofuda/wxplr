<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar main-side-cls">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(isset(Auth::user()->consultantProfile->profile_picture) && !empty(Auth::user()->consultantProfile->profile_picture))
          <img src="{{ asset(Auth::user()->consultantProfile->profile_picture) }}" class="img-circle" alt="User Image">
          @else
          <img src="{{ asset('/frontend/images/user_icon.png') }}" class="img-circle" alt="User Image">
          @endif
        </div>
        <div class="pull-left info" style="max-width: 75%">
          <p style="color: #b8c7ce; word-wrap: break-word;">Welcome {{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
   
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        
        <!--<li class="active treeview">-->
        <li class="">
          <a href="{{ url('consultant/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <!--<i class="fa fa-angle-left pull-right"></i>-->
          </a>
        </li>
         <li class="">
            <a href="{{ url('consultant/profile') }}">
              <i class="glyphicon glyphicon-cloud"></i>
              <span>My Profile</span>
            </a>
        </li>
         <li class="">
            <a href="{{ url('consultant/availability/form') }}">
              <i class="glyphicon glyphicon-cloud"></i>
              <span>Availablity Form</span>
            </a>
        </li>
        <li class="">
            <a href="{{ url('consultant/availability/list') }}">
              <i class="glyphicon glyphicon-cloud"></i>
              <span>Availablity listing</span>
            </a>
        </li>
          <li class="">
              <a href="{{ url('consultant/forms/list') }}">
                  <i class="glyphicon glyphicon-cloud"></i>
                  <span>Assigned User Listing</span>
              </a>
          </li>
        <li class="">
            <a href="{{ url('consultant/appoinment/list') }}">
              <i class="glyphicon glyphicon-cloud"></i>
              <span>Appoinment listing</span>
            </a>
        </li>
          <li class="">
              <a href="{{ url('consultant/event/list') }}">
                  <i class="glyphicon glyphicon-cloud"></i>
                  <span>Live Events</span>
              </a>
          </li>
        <!--<li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-user"></i>
              <span>Users</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('admin/users') }}"><i class="fa fa-circle-o"></i>List Users</a></li>
              <li><a href="{{ url('admin/roles') }}"><i class="fa fa-circle-o"></i> Roles</a></li>
            </ul>
        </li>-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
