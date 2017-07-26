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
                        @if(count($consultants) > 0)
                        <form role="form" method="post" action="{{ url('admin/query/'.$query->id.'/edit') }}" enctype="multipart/form-data">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Consultant</label>
                        <select class="form-control" required id="consultant_id" name="consultant_id">
                            <option>---Select Consultant---</option>
                            @foreach($consultants as $consultant)
                                <option value="{{ $consultant->user_id }}">{{ $consultant->consultant->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/blogs') }}" class="btn btn-default">Cancel</a>
                      </form>
                            @else
                            <div class="alert alert-danger">
                                No matching Consultant found.
                                </div>
                        @endif
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection