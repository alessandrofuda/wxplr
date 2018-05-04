@extends('front.new_layout')
@section('content')

</header>
</div>
<div id="Content">
	@if ($machine_name == 'chi-siamo')
		@include('front.chi-siamo')
	@endif

	@if ($machine_name == 'contatti')
		@include('front.contatti')
	@endif

	@if ($machine_name == 'condizioni-vendita')
		@include('front.condizioni-vendita')
	@endif

	@if ($machine_name == 'informativa-privacy')
		@include('front.informativa-privacy')
	@endif

	@if ($machine_name == 'cookie-policy')
		@include('front.cookie-policy')
	@endif

	@if ($machine_name == 'codice-etico')
		@include('front.codice-etico')
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
