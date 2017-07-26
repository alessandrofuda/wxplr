@extends('admin.layout')
@section('content')
<div class='row'>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class='col-md-12'>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $page_title }}</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body">
                        @if($page_type == 'edit')
                        <form role="form" method="post" action="{{ url('admin/partner/'.$partner->id.'/edit') }}" enctype="multipart/form-data">
                            @else
                                <form role="form" method="post" action="{{ url('admin/partner/add') }}" enctype="multipart/form-data">
                                    @endif
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="name" required class="form-control"
                                 placeholder="Enter Name..." value="@if (isset($partner)){{ $partner->name }} @else {{ old('name')  }} @endif">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" required class="form-control" placeholder="Enter Description...">@if (isset($partner)){{ $partner->description}} @else {{ old('description')  }} @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Logo Image </label>
                            <input type="file" name="logo_file" value="{{ old('logo_file') }}">
                        </div>
                        <div class="form-group">
                            <label>Url</label>
                            <input type="text" name="url" required class="form-control"
                                   placeholder="Enter Url..." value="@if (isset($partner)){{ $partner->url }} @else {{ old('url')  }} @endif">
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/partners') }}" class="btn btn-default">Cancel</a>
                    </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection