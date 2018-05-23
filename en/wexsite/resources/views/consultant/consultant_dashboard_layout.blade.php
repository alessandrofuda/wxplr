@include('front.header')
@include('front.dashboard_header')
<div class="user-wrapper">
    @include('consultant.consultant_dashboard_sidebar')

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
              <div class="alert alert-danger">
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