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
                      <form role="form" method="post" action="{{ url('admin/user/create') }}">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="name" required class="form-control" placeholder="Enter user name..." value="@if (isset($user)){{ $user->name }}@endif">
                        </div>
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lastname" class="form-control" placeholder="Enter last name..." value="@if (isset($user)){{ $user->surname }}@endif">
                        </div>
                        <div class="form-group">
                          <label>E-mail</label>
                          <input type="email" name="email" required class="form-control" placeholder="Enter email..." value="@if (isset($user)){{ $user->email }}@endif">
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Enter password..." value="">
                        </div>
                        <div class="form-group">
                          <label>Confirm Password</label>
                          <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label>Is Admin?</label>
                            <div class="radio">
                              <label>
                                <input type="radio" @if (isset($user) && $user->is_admin==1) checked @endif name="isadmin" value="1">
                                Yes
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" @if (isset($user) && $user->is_admin==0) checked @endif @if (!isset($user)) checked @endif name="isadmin" value="0" >
                                No
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Assign role</label>
                            <select name="user_roles[]" multiple class="form-control">
                                <option  value="_none" @if (!isset($assigned_roles) || empty($assigned_roles)) selected @endif>-- None --</option>
                                @if (count($roles) > 0)
                                    @foreach ($roles as $role) 
                                        <option @if (isset($assigned_roles) && in_array($role->id, $assigned_roles)) selected @endif value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <input type="hidden" name="user_id" value="@if (isset($user)) {{ $user->id }} @endif">
                        <input type="hidden" name="form_type" value="@if (isset($user)) edit @else create @endif">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/users') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection