@extends('front.layout')

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
    	  <div id="pages_wrapper" class="dataTables_wrapper dt-bootstrap Blog-details">
					<!-- <div class="row">
						<div class="col-sm-12">
							<div class="header">
								{{ $blog->title }}
								</div>
							<div class="blog-image">
								<img src="{{ asset($blog->image_file) }}" width="100" height="100">
								</div>
							<div class="blog-description">
								{{ $blog->description }}
								</div>
						</div>
					</div>
					<div class="container">
						<div class="col-lg-8 col-md-10">
							@include('admin.blog_partial')
						</div>
					</div> -->

					<div class="main_div">
						<div class="col-md-8 col-sm-8 col-xs-12">
							<div class="Blog_details">
								<h2>{{ $blog->title }}</h2>
								<div class="date_and_comment">
									 <span class="Shares disqus-comment-count" data-disqus-identifier="{{ md5($blog->id.$blog->title) }}"
										   data-disqus-url="{{ url('blog/'.$blog->id.'/show') }}"> <!-- Count will be inserted here --> </span>
									<span><a href="#">{{ date('M d, Y',strtotime($blog->created_at)) }}</a></span>
								</div>
								<img src="{{ asset($blog->image_file) }}">
								<p>{{ $blog->description }}</p>
							<div class="Comments_section">
								<hr/>
								@include('admin.blog_partial')
							</div>

							</div>
						</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="POPULAR-POSTS Recent-Posts">
							<h3>Recent Posts</h3>
								@foreach ($blogs as $blog)
									<a href="{{ url('blog/'.$blog->id.'/show') }}">
										<div class="post_list">
											<img src="{{ asset($blog->image_file) }}" alt="{{ $blog->title }}">
											<div class="popular_post_content">
												<h4>{{  substr($blog->title,0,20) }} {{ strlen($blog->title) > 20 ? '...' : '' }}  </h4>
											</div>
										</div>
									</a>
								@endforeach

						</div>
					</div>
				</div>

				  </div>
    </div><!-- /.row -->
@endsection
