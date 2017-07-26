@extends('front.layout')
@section('content')
<div class="container">
	<div class="col-md-12">
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
		@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
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
	<div class="row">
		<div class="heading">
			<h1>{{ $page_title }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			@if (session('success'))
				Thank you for your order. You can access your features here. <a href="{{ url('user/dashboard') }}">Dashboard</a>
			@endif
		</div>
	</div><!-- .rwo -->
</div>
@endsection