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
                <div id="navigation_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body">
                      <form role="form" method="post" action="{{ url('admin/navigation/add') }}">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="title" required class="form-control" placeholder="Enter menu name..." value="@if (!empty($navigation)){{ $navigation->title }}@endif">
                        </div>
                        <div class="form-group">
                          <label>Path</label>
                          <input type="text" name="path" required class="form-control" placeholder="Enter path..." value="@if (!empty($navigation)){{ $navigation->path }}@endif">
                        </div>
                        <input type="hidden" name="nav_id" value="@if (!empty($navigation)) {{ $navigation->id }} @endif">
                        <input type="hidden" name="form_type" value="@if (!empty($navigation)) edit @else create @endif">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ url('admin/navigation') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection