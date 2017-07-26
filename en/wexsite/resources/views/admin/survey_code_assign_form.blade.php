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
						<form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/cuture_match/survey_code/upload') }}">
							<!-- text input -->                       
							<div class="form-group">
								<label>Upload Survey Codes</label>								
								<input type="file" name="survey_codes_file" required class="form-control">
							</div>
							{{ csrf_field() }}
							<button type="submit" class="btn btn-primary">Upload</button>
							<a href="{{ url('admin/cuture_match/survey_code') }}" class="btn btn-default">Cancel</a>
						</form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection