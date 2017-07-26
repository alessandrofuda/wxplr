@extends('admin.layout')
@section('content')
<div class='row'>
    <div class='col-md-12'>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $page_title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <div class='col-md-6'>
                            <!--<div class="box-header with-border">
                              <h3 class="box-title">Edit Role</h3>
                            </div>-->
                            <!-- /.box-header -->
                            <div class="box-body">
                              <form role="form" method="post" action="{{ url('admin/create_role') }}">
                                <!-- text input -->
                                <div class="form-group">
                                  <label>Role</label>
                                  <input type="text" name="role_name" class="form-control" placeholder="Enter role name..." value="{{ $role->role_name}}">
                                  <input type="hidden" name="form_type" value="edit">
                                  <input type="hidden" name="role_id" value="{{ $role->id }}">
                                  <span class="help-block">Enter Role name here</span>
                                </div>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ url('admin/roles') }}" class="btn btn-default">Cancel</a>
                                </div>
                              </form>
                            </div><!-- /.box-body -->
                            <!--<div class="box-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>-->
                        </div><!-- /.col -->
            </div><!-- /.box-body -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection