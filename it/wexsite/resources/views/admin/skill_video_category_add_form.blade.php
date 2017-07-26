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
                    <div class="box-body">
					@if($page_type == 'category_edit')
                      <form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/skill_development/category/'.$sk_video->id.'/edit') }}">
					@else
					  <form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/skill_development/category') }}">
					@endif
					<!-- text input -->
					<div class="form-group">
						<label>Video Category Name</label>
						@if($page_type == 'category_edit')
							<input type="text" name="category_name" required class="form-control" placeholder="Video Category Name" value="{{ $sk_video->category_name }}">
						@else
							<input type="text" name="category_name" required class="form-control" placeholder="Video Category Name" value="{{ old('category_name') }}">
						@endif
					</div>
					<div class="form-group">
						<label>Description</label>
						@if($page_type == 'category_edit')
							<textarea name="category_desc" required class="form-control" placeholder="Description">{{ $sk_video->category_desc }}</textarea>
						@else
							<textarea name="category_desc" required class="form-control" placeholder="Description">{{ old('category_desc') }}</textarea>
						@endif
					</div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/skill_development/categories') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection