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
              <h3 class="box-title">Outcome Choices</h3>
                <p class="help-block">Click on any choice to which you want to add outcome name and description.</p>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body">
                      @if (count($choices)>0)
                        <ul>
                        @foreach ($choices as $choice_id=>$choice) 
                            <li>
                                <h4>Ques: {{ $choice['question'] }}</h4>
                                <a href="{{ url('admin/outcome/choice/'.$choice_id.'/'.$choice['que_id'].'/create') }}">Choice: {{ $choice['choice'] }}</a>
                                <div class="help-text">Outcome Name: <strong>{!! $choice['outcome'] !!}</strong></div>
                            </li>
                        @endforeach
                        </ul>
                      @endif
                      <a href="{{ url('admin/outcomes') }}" class="btn btn-primary"><< Back</a>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection