<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo e(asset('/admin/dist/img/user2-160x160.jpg')); ?>" alt="<?php echo e(Auth::user()->name); ?>"  class="img-circle" alt="User Image">
          
          <!--<img src="" alt=""  class="img-circle" alt="User Image">-->
        </div>
        <div class="pull-left info">
          <p><?php echo e(Auth::user()->name); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
   
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <!--<li class="active treeview">-->
        <li class="">
          <a href="<?php echo e(url('admin/dashboard')); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <!--<i class="fa fa-angle-left pull-right"></i>-->
          </a>
          <!--<ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>-->
        </li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-user"></i>
            <span>Users</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(url('admin/users')); ?>"><i class="fa fa-circle-o"></i>Clients</a></li>
            <li><a href="<?php echo e(url('admin/consultants')); ?>"><i class="fa fa-circle-o"></i>Consultants</a></li>
            <li><a href="<?php echo e(url('admin/roles')); ?>"><i class="fa fa-circle-o"></i> Roles</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-book"></i>
            <span>Services</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(url('admin/services')); ?>"><i class="fa fa-circle-o"></i>Services</a></li>

            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-book"></i>
                <span>Global oriented test</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo e(url('admin/questions')); ?>"><i class="fa fa-circle-o"></i>Questions list</a></li>
                <li><a href="<?php echo e(url('admin/question/create')); ?>"><i class="fa fa-circle-o"></i>Create question</a></li>
                <li><a href="<?php echo e(url('admin/outcomes')); ?>"><i class="fa fa-circle-o"></i>Outcomes</a></li>
                <li><a href="<?php echo e(url('admin/who_does_test')); ?>"><i class="fa fa-circle-o"></i>Who does the test</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-book"></i>
                <span>Professional Kit</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Market Analysis <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('admin/market_analysis')); ?>"><i class="fa fa-circle-o"></i>Market Analysis PDFs</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Culture Match <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('admin/cuture_match/survey_code/upload')); ?>"><i class="fa fa-circle-o"></i>Upload Survey Code</a></li>
                    <li><a href="<?php echo e(url('admin/cuture_match/survey_code')); ?>"><i class="fa fa-circle-o"></i>Survey Code Listing</a></li>
                  </ul>
                </li>

                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Role play interview <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('admin/booked/consultant/list')); ?>"><i class="fa fa-circle-o"></i>Consultant Bookings</a></li>
                  <!--<li><a href="<?php echo e(url('admin/cuture_match/survey_code/assign')); ?>"><i class="fa fa-circle-o"></i>Assign Survey Code</a></li>-->
                  </ul>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span>Steady Aim Shoot</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('admin/steady_aim_shoot/country_pdf/list')); ?>"><i class="fa fa-circle-o"></i>Upload country pdf</a></li>
                    <li><a href="<?php echo e(url('admin/steady_aim_shoot')); ?>"><i class="fa fa-circle-o"></i>Change Text</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-book"></i>
                <span>Skill Development</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo e(url('admin/skill_development/categories')); ?>"><i class="fa fa-circle-o"></i>Video Categories </a></li>
                <li><a href="<?php echo e(url('admin/skill_development/videos')); ?>"><i class="fa fa-circle-o"></i>Video Lisitng </a></li>
                <li><a href="<?php echo e(url('admin/skill_development/video/add')); ?>"><i class="fa fa-circle-o"></i>Add Videos</a></li>
                <li><a href="<?php echo e(url('admin/events')); ?>"><i class="fa fa-circle-o"></i>Event/ Live webinars</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-user"></i>
                <span>Global Tool Box</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo e(url('admin/queries')); ?>"><i class="fa fa-circle-o"></i>List Queries</a></li>
              </ul>
            </li>
            <li><a href="<?php echo e(url('admin/service/create')); ?>"><i class="fa fa-circle-o"></i>Create Service</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Services Management</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(url('admin/codes')); ?>"><i class="fa fa-circle-o"></i>Preferential Codes</a></li>
            <li><a href="<?php echo e(url('admin/package/list')); ?>"><i class="fa fa-circle-o"></i>Packages</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="<?php echo e(url('admin/transactions')); ?>">
            <i class="glyphicon glyphicon-book"></i>
            <span>Transactions</span>
          </a>
        </li>

        <li class="treeview">
          <a href="<?php echo e(url('admin/queries')); ?>">
            <i class="glyphicon glyphicon-book"></i>
            <span>Queries</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Pages</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(url('admin/pages')); ?>"><i class="fa fa-circle-o"></i>List pages</a></li>
            <li class="">
              <a href="<?php echo e(url('admin/navigation')); ?>">
                <i class="glyphicon glyphicon-menu-hamburger"></i>
                <span>Navigation</span>
              </a>
            </li>
            <li><a href="<?php echo e(url('admin/partners')); ?>"><i class="fa fa-circle-o"></i>List Partners</a></li>
            <li><a href="<?php echo e(url('admin/blogs')); ?>"><i class="fa fa-circle-o"></i>Blogs</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-book"></i>
            <span>Admin Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?php echo e(url('admin/meta-tags')); ?>">
            <i class="glyphicon glyphicon-book"></i>
            <span>Meta Tags</span>
          </a></li>
            <li>
              <a href="<?php echo e(url('admin/slider/settings')); ?>">
                <i class="glyphicon glyphicon-book"></i>
                <span>Slider Settings</span>
              </a>
            </li>
            <li>
              <a href="<?php echo e(url('admin/settings')); ?>">
                <i class="glyphicon glyphicon-book"></i>
                <span>Settings</span>
              </a>
            </li>
            </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>