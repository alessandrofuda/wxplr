{{-- @ex__tends( Auth::check() ? 'front.dashboard_layout' : 'front.new_layout') --}}

@extends('layouts.new_layout') 

@section('content')

	<!--/header-->
	</div>
	<div id="Content">
		@if ($machine_name == 'about-us')
		    @include('front.about-us')
		@endif

		@if ($machine_name == 'contact-us')
			@include('front.contact-us')
		@endif

		@if ($machine_name == 'terms-service')
			@include('front.terms-service')
		@endif

		@if ($machine_name == 'privacy-policy')
			@include('front.privacy-policy')
		@endif

		@if ($machine_name == 'cookies-policy')
			@include('front.cookies-policy')
		@endif

		@if ($machine_name == 'code-ethics')
			@include('front.code-ethics')
		@endif

		@if ($machine_name == 'global-orientation-test')
			@include('front.global-orientation-test')
		@endif

		@if ($machine_name == 'professional-kit')
			@include('front.professional-kit')
		@endif

		@if ($machine_name == 'global-toolbox')
			@include('front.global-toolbox')
		@endif

		@if ($machine_name == 'skills-development')
			@include('front.skills-development')
		@endif

		@if ($machine_name == 'aiesec')
			@include('front.aiesec')
		@endif

		@if ($machine_name == 'faq')
			@include('front.faq')
		@endif
	</div>

	{{--
	<div class="container">
		<div class="row">
			<h3>{{ $page_title }}</h3>
			<div class="page_desc">{{ $desc }}</div>
		</div>
	</div>--}}

@endsection
