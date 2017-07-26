@extends('admin.layout')
@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- /.box-header -->
            <form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/dream_check_lab/assign_consultant/'.$dream_check_lab_id.'/update') }}">
                {{ csrf_field() }}
                        <!-- text input -->
                <input type="hidden" name="dream_check_lab_id" class="dream_check_lab_id" value="{{ $dream_check_lab_id }}">
                <div class="form-group">
                    <label for="category_id">Assign consultant for {{ $user_name }}</label>
                    @if (count($consultant_arr) > 0)
                        <select name="consultant" id="consultant" required class="form-control">
                            <option value="">--Select Consultant--</option>
                            @foreach ($consultant_arr as $consultant)
                                <option value="{{ $consultant['id'] }}">{{ $consultant['name'] }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Assign</button>
            </form>
        </div>
    </div>
@endsection