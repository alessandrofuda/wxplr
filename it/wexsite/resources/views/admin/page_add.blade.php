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
                      <form role="form" method="post" action="{{ url('admin/page/add') }}">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" name="title" required class="form-control" placeholder="Enter title..." value="@if (isset($page)){{ $page->page_title }}@endif">
                        </div>
                        <div class="form-group">
                          <label>Machine name (unique page name)</label>
                          <input type="text" name="machine_name" required class="form-control" placeholder="Enter machine name..." value="@if (isset($page)){{ $page->machine_name }}@endif">
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea name="desc"  id="textarea-ckeditor" required class="form-control" placeholder="Enter description..." rows="15">@if (isset($page)){{ $page->description }}@endif</textarea>
                        </div>
                        <input type="hidden" name="page_id" value="@if (isset($page)) {{ $page->id }} @endif">
                        <input type="hidden" name="form_type" value="@if (isset($page)) edit @else create @endif">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/pages') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection