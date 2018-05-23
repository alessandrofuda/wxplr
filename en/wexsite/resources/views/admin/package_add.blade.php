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
                        <form role="form" method="post" action="{{ url('admin/package/add') }}" enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="skills" id="skills">
                        <input type="hidden" name="count" id="count">
                            <input type="hidden" name="items" id="item">
                            <div class="form-group">
                                 <label>Title</label>
                                <input type="text" required class="form-control" id="title" name="title" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label>Price (in €)</label>
                                <input type="text" required class="form-control" id="price" name="price" value="{{ old('price') }}">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea  class="form-control" id="description" name="description" >{{ old('description') }}</textarea>
                            </div>
                        @foreach($skills as $key => $skill)
                                <div class="form-group">
                                    <input type="hidden" class="skill_id" id="skill_{{ $key }}" value="{{ $key }}" name="skill_id">
                                    <div class="col-md-1">
                                    <input type="checkbox" class="skill_checked" id="skill_checked_{{ $key }}"  name="skill_checked">
                                    </div>
                                    <label class="col-md-3">{{ $skill }}</label>
                                    <div class="col-md-4">
                                    <input type="text" disabled class="form-control" id="count_{{ $key }}" name="count_id" value="{{ old('count_'.$key) }}">
                                        </div>

                                    @if($key == \App\Package::SKILL_VIDEOS)
                                    <div class="col-md-4">
                                        <input type="radio" checked id="any_{{ $key }}" name="any" value="0">Any Video
                                        <input type="radio" id="any_{{ $key }}" name="any" value="1">Select from list
                                    </div>
                                        <div class="clearfix"></div><br/>
                                        <div class="col-md-4 col-md-offset-4">
                                        <select multiple  disabled id="items_{{ $key }}" class="form-control">
                                            @foreach($videos as $video)
                                                <option  value="{{ $video->id }}">{{ $video->video_title.'(€'.$video->price.')' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @elseif($key == \App\Package::SKILL_WEBINAR)
                                        <div class="col-md-4">
                                            <input type="radio" checked id="any_{{ $key }}" name="anyevent" value="0">Any Event/Webinar
                                            <input type="radio"  id="any_{{ $key }}" name="anyevent" value="1">Select from list
                                        </div>
                                        <div class="clearfix"></div><br/>
                                        <div class="col-md-4 col-md-offset-4">
                                            <select disabled  multiple id="items_{{ $key }}" class="form-control">
                                                @foreach($events as $event)
                                                    <option  value="{{ $event->id }}">{{ $event->name.'(€'.$event->price.')' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <input type="hidden" id="items_{{ $key }}" value="0">
                                    @endif

                                    <div class="clearfix"></div>
                                </div>
                         @endforeach
                            {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/blogs') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
    <script>
        $(document).ready(function(){
            $("[id^=skill_checked_]").each(function(){
                var id = $(this).attr('id').split('skill_checked_')[1];
                if($(this).is(":checked")) {
                    $("#count_" + id).attr('disabled',false);
                }else{
                    $("#count_" + id).attr('disabled', 'disabled');
                }
            });
        });

        $("[id^=skill_checked_]").change(function () {
            var id = $(this).attr('id').split('skill_checked_')[1];
            console.log('id'+id);
            if($(this).is(":checked")) {
                $("#count_" + id).attr('disabled',false);
               // $("#items_" + id).attr('disabled',false);
            }else{
                $("#count_" + id).attr('disabled', 'disabled');
                $("#items_" + id).attr('disabled','disabled');
            }
        });

        $("[id^=items_], [id^=count_] ").on('change',function () {
            updateinput();
        });
        $("input[name=any]:radio").change(function () {
            var id = $(this).attr('id').split('any_')[1];
            var val = $(this).val();
            if(val == 1) {
                $("#items_"+id).attr('disabled', false);
            }else{
                $("#items_"+id).val(null);
                $("#items_"+id).attr('disabled', true);
                $("#count_"+id).attr('disabled',false);
                updateinput();
            }
        });

        $("input[name=anyevent]:radio").change(function () {
            var id = $(this).attr('id').split('any_')[1];
            var val = $(this).val();
            console.log('val' + val);
            console.log('id' + id);
            if(val == 1) {
                $("#items_"+id).attr('disabled', false);
            }else{
                $("#items_"+id).val(null);
                $("#items_"+id).attr('disabled', true);
                $("#count_"+id).attr('disabled',false);
                updateinput();
            }
        });
        function updateinput() {
            $("#skills").val('');
            $("#count").val('');
            $("#items").val('');
            var skills = '';
            var count = '';
            var item = '';
            $("[id^=count_]").each(function () {
                var id = $(this).attr('id').split('count_')[1];
                if(typeof id == 'undefined')
                    var id = $(this).attr('id').split('items_')[1];
                var count_id =  $("#count_"+id).val();
                parseInt(count_id);
                var skill_id = $("#skill_"+id).val();
                parseInt(skill_id);
                var item_id = $("#items_"+id).val();
                console.log('item'+item_id);
                if(item_id != 0 && item_id != null) {
                    $("#count_"+id).attr('disabled',true);
                    item_id = item_id.toString();
                    var items =  item_id.split(',');
                    count_id = items.length;
                    $(this).val(count_id);
                    console.log('count'+id+'-'+count_id);
                }else{
                    if($("#skill_checked_"+id).is(":checked")) {
                        $("#count_" + id).attr('disabled', false);
                        item_id = 0;
                    }
                }
                if(count_id > 0) {
                    skills = skills + '-' + skill_id;
                    count = count + '-' + count_id;
                    item = item + '-' + item_id;
                }

            });
            $("#skills").val(skills);
            $("#count").val(count);
            $("#item").val(item);
        }
        /*$("[id^=count_]").change(function () {
            $("#skills").val('');
            $("#count").val('');
            $("#items").val('');
            var skills = '';
            var count = '';
            $("[id^=count_]").each(function () {
                var count_id =  $(this).val();
                parseInt(count_id);
                var id = $(this).attr('id').split('count_')[1];
                var skill_id = $("#skill_"+id).val();
                parseInt(skill_id);
                if(count_id > 0) {
                    skills = skills + '-' + skill_id;
                    count = count + '-' + count_id;
                }
            });
            $("#skills").val(skills);
            $("#count").val(count);
        });*/
    </script>
@endsection