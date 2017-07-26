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
                        <form role="form" method="post" action="{{ url('admin/code/'.$code->id.'/edit') }}">
                            @else
                                <form role="form" method="post" action="{{ url('admin/code/add') }}">
                                    @endif
                        <!-- text input -->
                        <div class="form-group">
                          <label>Code</label>
                          <input type="text" name="preferential_code" required
                                 class="form-control" placeholder="Enter code..."
                                 value="@if (isset($code)){{ $code->preferential_code }} @else {{ old('preferential_code')  }} @endif">
                        </div>
                        <div class="form-group">
                            <label>Product Type </label>
                            <select name="type_id" class="form-control" id="product_type">
                                <option>---Select Product Type---</option>
                                @foreach($product_types as $key => $product_type)
                                    <option value="{{ $key }}" @if (isset($code)){{ $code->type_id ==  $key ? 'selected' : '' }} @endif>{{ $product_type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="services" style="display: @if (isset($code)){{ $code->type_id == \App\PreferentialCodes::PRODUCT_TYPE_SERVICE ? '' : 'none;' }} @else {{  'none;'}} @endif">
                            <label>Service</label>
                            <select name="product_id" id="service_product_id" class="form-control"  @if (isset($code)){{ $code->type_id == \App\PreferentialCodes::PRODUCT_TYPE_SERVICE ? '' : 'disabled' }} @else {{ 'disabled' }} @endif>
                                <option>---Select Service---</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" @if (isset($code)){{ $code->product_id ==  $service->id ? 'selected' : '' }} @endif>{{ $service->name }}</option>
                                @endforeach
                            </select>
                         </div>
                        <div class="form-group" id="videos" style="display: @if (isset($code)){{ $code->type_id == \App\PreferentialCodes::PRODUCT_TYPE_VIDEO ? '' : 'none;' }} @else {{  'none;'}} @endif ">
                            <label>Videos</label>
                            <select name="product_id"  id="video_product_id" class="form-control"  @if (isset($code)){{ $code->type_id == \App\PreferentialCodes::PRODUCT_TYPE_VIDEO ? '' : 'disabled' }} @else {{ 'disabled' }} @endif;>
                                <option>---Select Video---</option>
                                @foreach($videos as $video)
                                    <option value="{{ $video->id }}" @if (isset($code)){{ $code->product_id ==  $video->id ? 'selected' : '' }} @endif>{{ $video->video_title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Discount Percentage</label>
                            <input type="text" name="discount" max="100" required class="form-control"
                                   placeholder="Enter code..." value="@if (isset($code)){{ $code->discount }} @else {{ old('discount')  }} @endif">
                        </div>
                        <div class="form-group">
                            <label>Usage</label>
                            <input type="radio" name="is_single" value="0" @if (isset($code)){{ $code->is_single == 0  ? 'checked' : ''}} @else {{ 'checked'  }} @endif> Single Time
                            <input type="radio" name="is_single" value = "1" @if (isset($code)){{ $code->is_single == 1 ? 'checked' : '' }} @else {{ 'checked'  }} @endif> Multiple Times
                        </div>

                        <div class="form-group">
                            <label>Used till</label>
                            <input type="text" name="end_date" placeHolder="Select End Date" id="end_date" required class="form-control" placeholder="Enter code..." value="@if (isset($code)){{ $code->end_date }} @else {{ old('end_date')  }} @endif">
                        </div>
                                    {{ csrf_field() }}

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/codes') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
    <script>

        $("#end_date").datepicker({
            startDate: new Date(),
            format:'yyyy-mm-dd',
            autoclose:true
        });

        $("#product_type").change(function(){
            var val = $(this).val();
            if(val == "{{ \App\PreferentialCodes::PRODUCT_TYPE_SERVICE }}") {
                $("#services").show();
                $("#videos").hide();
                $("#service_product_id").attr('disabled',false);
                $("#video_product_id").attr('disabled',true);
            }
            if(val == "{{ \App\PreferentialCodes::PRODUCT_TYPE_VIDEO }}") {
                $("#services").hide();
                $("#videos").show();
                $("#service_product_id").attr('disabled',true);
                $("#video_product_id").attr('disabled',false);
            }
        });

    </script>
@endsection