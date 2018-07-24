@include('front.header')

@include('front.dashboard_header')

<div class="user-wrapper">

	<?php $roles_arr = []; ?>

  @if(isset(Auth::user()->userRoles))
	    @foreach(Auth::user()->userRoles as $roles)
	        <?php $roles_arr[] = $roles->role_id; ?>
	    @endforeach
  @endif

	@if(in_array(2,$roles_arr))
	    @include('front.consultant_dashboard_sidebar')
	@else
	    @include('front.dashboard_sidebar')
	@endif

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper user-dash-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-md-12">

              @if (session('status'))
                  <div class="alert alert-success">
                    {{ session('status') }}
                  </div>
              @endif

              @if (session('error'))
                <div class="alert alert-failure" style="background-color:#f73737;">
                    {{ session('error') }}
                </div>
              @endif
              
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              
          </div>
      </div>

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
</div>

@include('front.footer')

@yield('footer_resources')