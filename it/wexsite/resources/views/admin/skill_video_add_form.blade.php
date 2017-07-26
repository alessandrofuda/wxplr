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
              <h3 class="box-title">{{ $page_title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body col-md-6">
					@if($page_type == 'edit')
                      <form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/skill_development/video/'.$sk_video->id.'/edit') }}">
					@else
					  <form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/skill_development/video/add') }}">
					@endif
					<!-- text input -->
					<div class="form-group">
						<label>Video Title</label>
						@if($page_type == 'edit')
							<input type="text" name="video_title" required class="form-control" placeholder="Video Title" value="{{ $sk_video->video_title }}">
						@else
							<input type="text" name="video_title" required class="form-control" placeholder="Video Title" value="{{ old('video_title') }}">
						@endif
					</div>
					<div class="form-group">
                        <label>Select Video Category</label>
						@if($page_type == 'edit')
						<select required class="form-control" name="video_category">
						<option value="">-- Select Video Category --</option>
							@if(isset($video_categories) && count($video_categories) > 0)
								@foreach($video_categories as $category)	
									<option @if($sk_video->video_category == $category->id) selected @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
								@endforeach
						   @endif
						</select>
						@else
						<select required class="form-control" name="video_category">
						<option value="">-- Select Video Category --</option>
							@if(isset($video_categories) && count($video_categories) > 0)
								@foreach($video_categories as $category)	
									<option value="{{ $category->id }}">{{ $category->category_name }}</option>
								@endforeach
						   @endif
						</select>
						@endif
					</div>						
					<div class="form-group">
						<label>Price</label>
						@if($page_type == 'edit')
							<input type="text" name="video_price" class="form-control" placeholder="Price" required value="{{ $sk_video->price }}">
						@else
							<input type="text" name="video_price" class="form-control" placeholder="Price" required value="{{ old('video_price') }}">
						@endif
					</div>
					<div class="form-group">
						<label>Video Image</label>
						@if($page_type == 'edit')
							<input type="file" name="video_image" class="form-control">
							<img alt="{{ $sk_video->video_title }}" width="100" src="{{ asset($sk_video->video_image) }}">
						@else
							<input type="file" name="video_image" required class="form-control">
						@endif
					</div>

						  <div class="form-group">
							  <label>Preview Video  Upload</label>
							  @if($page_type == 'edit')
								  <input type="file" name="preview_video" class="form-control">
								  <a target="_blank" href="{{ asset($sk_video->preview_video) }}">Uploaded Preview Video</a>
							  @else
								  <input type="file" name="preview_video" required class="form-control">
							  @endif
						  </div>
					<div class="form-group">
						<label>Video Upload</label>
						@if($page_type == 'edit')
							<input type="file" name="uploaded_video" class="form-control">
							<a target="_blank" href="{{ asset($sk_video->uploaded_video) }}">Uploaded Video</a>
						@else
							<input type="file" name="uploaded_video" required class="form-control">
						@endif
					</div>
					<div class="form-group">
						<label>Description</label>
						@if($page_type == 'edit')
							<textarea name="description" required class="form-control" placeholder="Description">{{ $sk_video->description }}</textarea>
						@else
							<textarea name="description" required class="form-control" placeholder="Description">{{ old('description') }}</textarea>
						@endif
					</div>
						  <div class="form-group">
							  <label>Add a Tag</label>
							  @if($page_type == 'edit')
							  <input type="text" name="tag" placeholder="Search Tags" class="form-control" id="tag"  value="{{ isset($sk_video->videoTag->tag->name ) ? $sk_video->videoTag->tag->name : ''}}">
							  @else
								  <input type="text" name="tag" placeholder="Search Tags" class="form-control" id="tag"  value="{{ old("tag") }}">
							  @endif
						   </div>     {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/skill_development/videos') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<script>
	$(document).ready(function() {
		src = "{{ route('searchajax') }}";
		$("#tag").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: src,
					dataType: "json",
					data: {
						term : request.term
					},
					success: function(data) {
						response(data);

					}
				});
			},
			min_length: 3,

		});
	});
</script>
@endsection
