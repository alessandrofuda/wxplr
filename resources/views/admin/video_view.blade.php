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
			<script src="{{ asset('frontend/jwplayer/jwplayer.js') }}">
			</script>
			<script>jwplayer.key="g4fPsuTO2p03J7jp0MB28FBaHRlIYi4L56gXKg";</script>
    		<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ $page_title }}</h3>
					<a href="{{ url('admin/skill_development/video/add') }}" class="btn btn-primary add_user"><span class="glyphicon glyphicon-plus-sign"></span> Add Video </a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div id="skill_videos_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">					
					<div class="row">
						<div class="col-sm-12">
							<table id="list_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<tr role="row">
								<th>Title</th>
									<td class="sorting_1">{{ $video->video_title }}</td>
									</tr>
								<tr role="row">
								<th>Category</th>
									<td class="sorting_1">{{ $video->videoCategory['category_name'] }}</td></tr>
								<tr role="row">
								<th>Tag</th>
									<td class="sorting_1">{{ isset($video->videoTag->tag->name) ? ucfirst($video->videoTag->tag->name) : '' }}</td>
								</tr>
								<tr role="row">
								<th>Price</th><td class="sorting_1">{{ $video->price }}</td>
								</tr>
							</table>
						</div>
						<div class="col-md-12">
							<b>Main Video</b>
							<br/>
							@if($video->vimeo_path != null)
								{!! $video->getIframe() !!}
							@else
								<div id="mainVideo"></div>
								<script type="text/JavaScript">
									var playerInstance = jwplayer("mainVideo");
									playerInstance.setup({
										file: "{{ asset($video->upload_video) }}",
										mediaid: "MEDIAID",
										image: "{{ asset($video->video_image) }}"
									});
									function playTrailer(video, thumb) {
										playerInstance.load([{
											file: video,
											image: thumb
										}]);
										playerInstance.play();
									}
								</script>
								@endif
							</div>
						<div class="col-md-12">
							<b> Preview Video</b>
							<br/>
							@if($video->preview_vimeo_path != null)
								{!! $video->getIframe('preview_vimeo_path') !!}
							@else
							<div id="mainPreviewVideo"></div>
							<script type="text/JavaScript">
								var playerInstance = jwplayer("mainPreviewVideo");
								playerInstance.setup({
									file: "{{ asset($video->preview_video) }}",
									mediaid: "MEDIAID",
									image: "{{ asset($video->video_image) }}"
								});
								function playTrailer(video, thumb) {
									playerInstance.load([{
										file: video,
										image: thumb
									}]);
									playerInstance.play();
								}
							</script>
								@endif
						</div>
					</div>						
					</div>
				</div><!-- /.box-body -->
			</div>
		</div><!-- /.col -->       
    </div><!-- /.row -->
	<!-- Trigger the modal with a button -->
@endsection
