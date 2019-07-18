@extends('layouts.dashboard_layout')
@section('top_section')
	<h1>Dashboard<small>Services</small></h1>
	<!--<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>-->
@endsection
@section('content')
    <div class='row'>
		<div class="col-md-12">
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
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
    	<div class='col-md-12'>
    		<div class="box">
				<div class="box-header">
					<h3 class="box-title">Event - {{ $event->name }}</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="pages_wrapper" class="dataTables_wrapper dt-bootstrap">
					<div class="row">
						<div class="col-sm-12">
							<div class="header">
								{{ $event->name }}
							</div>
							<div class="header">
								{!! $event->getJoinUrl() !!}
							</div>
							<div class="blog-image">
								<img alt="{{ $event->name }}" src="{{ asset($event->image_file) }}" width="100" height="100">
								</div>
							<div class="blog-description">
								{{ $event->event_date }}
								</div>
							<div class="blog-description">
								{{ isset($event->consultant->name ) ? $event->consultant->name : "" }}
							</div>
						</div>
					</div>
					</div>
				</div><!-- /.box-body -->


				<hr>
			</div>
		</div><!-- /.col -->
    </div><!-- /.row -->
@endsection
