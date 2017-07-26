@extends('admin.layout')
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
					<h3 class="box-title">Query</h3>
					<a class="btn btn-primary add_user" href="{{ url('admin/blog/'.$blog->id.'/edit') }}">
						<span class="glyphicon glyphicon-plus-sign"></span> Edit Blog</a>
					<a class="btn btn-primary add_user" href="{{ url('admin/blog/add') }}">
						<span class="glyphicon glyphicon-plus-sign"></span> Add Blog</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="pages_wrapper" class="dataTables_wrapper dt-bootstrap">
					<div class="row">
						<div class="col-sm-12">
							<div class="header">
								{{ $blog->title }}
								</div>
							<div class="blog-image">
								<img alt="{{ $blog->title }}" src="{{ asset($blog->image_file) }}" width="100" height="100">
								</div>
							<div class="blog-description">
								{{ $blog->description }}
								</div>
						</div>
					</div>
					</div>
				</div><!-- /.box-body -->

				<hr>
				<div class="container">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
						@include('admin.blog_partial')
					</div>
				</div>
				<hr>
			</div>
		</div><!-- /.col -->
    </div><!-- /.row -->
@endsection
