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
                        <form role="form" method="post" action="{{ url('admin/meta-tags/'.$tag->id.'/edit') }}" enctype="multipart/form-data">
                            @else
                                <form role="form" method="post" action="{{ url('admin/meta-tags/add') }}" enctype="multipart/form-data">
                                    @endif
                        <!-- text input -->
                        <div class="form-group">
                            <label>Full Url</label>
                            <input type="text" name="name" required class="form-control"
                                   placeholder="Enter Full Url..."
                                   value="@if (isset($tag)){{ $tag->name }} @else {{ old('name')  }} @endif">
                        </div>
                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" name="title" required class="form-control"
                                 placeholder="Enter Title..."
                                 value="@if (isset($tag)){{ $tag->title }} @else {{ old('title')  }} @endif">
                        </div>
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" required class="form-control"
                                   placeholder="Enter Meta Title..."
                                   value="@if (isset($tag)){{ $tag->meta_title }}
                                   @else {{ old('meta_title')  }} @endif">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <input type="text" name="meta_description" required class="form-control"
                                   placeholder="Enter Description ..."
                                   value="@if (isset($tag)){{ $tag->meta_description }}
                                   @else {{ old('meta_description')  }} @endif">
                        </div>
                        <div class="form-group">
                            <label>Page Type</label>
                            <select name="page_type" class="form-control">
                                <option>----SELECT PAGE TYPE---</option>
                                @foreach($pageTypes as $id => $pageType)
                                    <option value="{{ $id }}" @if (isset($tag)){{ $tag->page_type == $id ? "selected" : "" }} @endif>{{ $pageType }}</option>
                                    @endforeach
                            </select>
                              </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/meta-tags') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection