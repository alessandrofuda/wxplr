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
                        <form role="form" method="post" action="{{ url('admin/slider/'.$slider->id.'/edit') }}" enctype="multipart/form-data">
                            @else
                                <form role="form"  method="post" action="{{ url('admin/slider/add') }}" enctype="multipart/form-data">
                                    @endif
                        <!-- text input -->
                                    <input type="hidden" id="clone_id" value="0">
                                    <div class="clones">
                                    <div id="old">
                                        <?php /*
                        <div class="form-group">
                          <label>First Heading </label>
                            @if (isset($slider))
                                <input type="text" name="heading_1"  class="form-control"
                                       placeholder="Enter First Heading..." value="{{ $slider->heading_1 }}">
                            @else
                                <input type="text" name="heading_1[]"  class="form-control"
                                       placeholder="Enter First Heading..." value="{{ old('heading_1')  }}">
                            @endif

                        </div>
                        <div class="form-group">
                            <label>Second Heading</label>
                            @if (isset($slider))
                            <input type="text" name="heading_2"  class="form-control"
                                   placeholder="Enter Second Heading..."
                                   value="{{ $slider->heading_2 }}">
                                @else
                                <input type="text" name="heading_2[]"  class="form-control"
                                       placeholder="Enter Second Heading..."
                                       value="{{ old('heading_2')  }}">
                            @endif
                        </div>
                                        */?>
                        <div class="form-group">
                            <label>Upload Image </label>
                            @if (isset($slider))
                                <div class="img-edit"><img alt="Slider image" src="{{ asset($slider->image_file) }}" width="100" height = "100">
                                    </div>
                            <input type="file"  name="image_file"  >
                            @else
                                <input type="file" name="image_file[]"  required  value="{{ old('image_file') }}">
                            @endif
                        </div>
                                    </div>
                                        </div>
                        {{ csrf_field() }}
                                    @if($page_type != 'edit')
                                    <button id="clone" class="btn btn-success" >Add More</button>
                                    @endif
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/slider/settings') }}" class="btn btn-default">Cancel</a>
                     </form>

                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
    <script>
        $(document).ready(function() {
            $(document).delegate('#clone', 'click',
                    function (e) {
                        e.preventDefault();
                        var clone_id = $('#clone_id').val();
                        clone_id++;
                        $('#clone_id').val(clone_id);
                        clone = '<div id = "old_'+ clone_id+'" ><div class="form-group"><label>Upload Image </label><input type="file" name="image_file[]"></div><a class="btn btn-danger puul-right"  id="remove_' + clone_id + '">Remove</a></div>';
                        $(".clones").append(clone);
                    }
            );
            $(document).delegate("[id^=remove_]", 'click', function (e) {
                var id = $(this).attr('id').split('remove_')[1];
                $("#old_" + id).remove();
            });
        });
    </script>
@endsection