@extends('layouts.new_layout')
@section('content')

</header>
</div>
<div class="container">
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
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="pages_wrapper" class="dataTables_wrapper dt-bootstrap Blog-page">
					<div class="row">
						<!-- <div class="col-sm-12">
						@if (count($blogs) > 0)
										@foreach ($blogs as $blog)
						<div class="header">
							<a href="{{ url('blog/'.$blog->id.'/show') }}">	{{ $blog->title }} </a>
						</div>
						<div class="content">{{ substr($blog->description,0,50) }}</div>
						@endforeach
						@else
						<div class="no-post">
									No Blog added!
						</div>

									@endif
						</div> -->

					<div class="col-md-8 col-sm-8 col-xs-12 blog-main">
						@if (count($blogs) > 0)
							@foreach ($blogs as $blog)
						<div class="blog_list">
							<div class="blog_img"><img src="{{ asset($blog->image_file) }}" alt="{{ $blog->title }}"></div>
							<div class="blog_content">
								<h2><a href="{{ url('blog/'.$blog->id.'/show') }}">{{ $blog->title }}</a></h2>
								<p>{{ substr($blog->description,0,150) }} {{ strlen($blog->description) > 150 ? '...' : '' }}</p>
								<div class="date_and_comment">
									   <!--span class="Shares disqus-comment-count" data-disqus-identifier="{{ md5($blog->id.$blog->title) }}"
											 data-disqus-url="{{-- url('blog/'.$blog->id.'/show') --}}"
									   >  Count will be inserted here </span-->
									<span><a href="#">{{ date('M d, Y',strtotime($blog->created_at)) }}</a></span>
								</div>
							</div>
						</div>
							@endforeach
						@endif

					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="POPULAR-POSTS">
							<h3>POPULAR POSTS</h3>
							@if (count($blogs) > 0)
								<?php $i = 1 ?>
								@foreach ($blogs as $blog)
							<a href="{{ url('blog/'.$blog->id.'/show') }}">
								<div class="post_list">
									<img src="{{ asset($blog->image_file) }}">
									<div class="popular_post_content">
										<span>{{  $i }}</span>
										<h4>{{  substr($blog->title,0,20) }} {{ strlen($blog->title) > 20 ? '...' : '' }}  </h4>
										<?php $i++ ?>
									</div>
								</div>
							</a>
								@endforeach
								@endif
						</div>
					</div>
					</div>
				</div><!-- /.box-body -->
			</div>
		</div><!-- /.col -->
    </div><!-- /.row -->
    </div>
	</div>
@endsection
