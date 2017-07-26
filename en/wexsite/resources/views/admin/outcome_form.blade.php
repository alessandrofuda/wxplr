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
    <div class='col-md-6'>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Question series</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body">
                        @foreach ($que_tree as $key=>$que)
                            @if ($key!=0)
                                <span class="glyphicon glyphicon-arrow-down center-block text-center question_pointer"></span>
                            @endif
                            <h4><span class="glyphicon glyphicon-play small"></span> {{ $que['question'] }}</h4>
                            <p><strong>Choice:</strong> {{ $que['choice'] }}</p>
                        @endforeach
                        @if (!empty($outcome))
                            <span class="glyphicon glyphicon-arrow-down center-block text-center  question_pointer"></span>
                            <h3 class="text-center">{{ $outcome['outcome_name'] }}</h3>
                        @endif
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class='col-md-6'>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $page_title }}</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body">
                      <form role="form" method="post" action="{{ url('admin/outcome/create') }}" enctype="multipart/form-data">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Outcome name</label>
                          <input type="text" name="outcome_name" required class="form-control" placeholder="Enter title..." value="@if (!empty($outcome)){{ $outcome['outcome_name'] }}@endif">
                        </div>
                        <div class="form-group">
                            <label>Outcome image</label>
                            @if (!empty($outcome) && (!empty($outcome['outcome_image']) || $outcome['outcome_image'] != Null ))
                                <div class="outcome_img_thumb">
                                    <img alt="{{ $outcome['outcome_name'] }}" src="{{ asset($outcome['outcome_image']) }}">
                                </div>
                            @endif
                            <input type="file" name="outcome_image" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Outcome pdf</label>
                            @if (!empty($outcome) && (!empty($outcome['outcome_file']) || $outcome['outcome_file'] != Null ))
                                <div class="outcome_file_thumb">
                                <a href="{{ asset($outcome['outcome_file']) }}" target="_blank">
                                    <img alt="{{ $outcome['outcome_name'] }}" src="{{ asset('admin/custom/images/pdf_icon.ico') }}">
                                </a>
                                </div>
                            @endif
                          <input type="file" name="outcome_file" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea id="textarea-ckeditor" name="desc" required id="desc" class="form-control" placeholder="Enter description..." rows="8">@if (!empty($outcome)){{ $outcome['description'] }}@endif</textarea>
                        </div>
                        <input type="hidden" name="choice_id" value="{{ $choice_id }}">
                        <input type="hidden" name="outcome_id" value="@if (!empty($outcome)) {{ $outcome['outcome_id'] }} @endif">
                        <input type="hidden" name="form_type" value="@if (!empty($outcome)) edit @else create @endif">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/outcome/choices') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection