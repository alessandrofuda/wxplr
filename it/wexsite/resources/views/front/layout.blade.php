@include('front.header')

<div class="container-fluid clear-fix">
 <div class="row">
  @yield('slider')
 </div>
</div>

<div class="container {{ \Request::route()->getName() }}">
 <div class="wrapper">
     @yield('content')
 </div>
</div>
@include('front.footer')