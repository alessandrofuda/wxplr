@extends('admin.layout')
@section('content')
<div class='row'>
    <div class='col-md-12'>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $page_title }}</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
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
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body col-md-6 col-md-offset-3">
                        @if($page_type == 'edit')
                        <form role="form" method="post" action="{{ url('admin/event/'.$event->id.'/edit') }}" enctype="multipart/form-data">
                            @else
                                <form role="form" method="post" action="{{ url('admin/event/add') }}" enctype="multipart/form-data">
                                    @endif
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="name" required class="form-control"
                                 placeholder="Enter Name..." value="@if (isset($event)){{ $event->name }} @else {{ old('name')  }} @endif">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" required class="form-control"
                                   placeholder="Enter Description..."> @if (isset($event)){{ $event->description}} @else {{ old('description')  }} @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" required class="form-control"
                                   placeholder="Enter Price..." value="@if (isset($event)){{ $event->price }} @else {{ old('price')  }} @endif">
                        </div>
                        <div class="form-group">
                            <label>Event Date</label>
                            <input type="text" name="event_date" id="event_date" required class="form-control"
                                   placeholder="Enter Date..." value="@if (isset($event)){{ $event->getDate() }} @else {{ old('event_date')  }} @endif">
                        </div>
                                        <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Event Start Time</label>
                            <input type="text" name="event_start" id="event_start" required class="form-control timepicker"
                                   placeholder="Enter Start Time..." value="@if (isset($event)){{ $event->getDate(\App\ConsultantAvailablity::START_TIME)  }} @else {{ old('event_start')  }} @endif">
                        </div>
                                            </div>
                                        <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Event End Time</label>
                            <input type="text" name="event_end" id="event_end" required class="form-control timepicker"
                                   placeholder="Enter End Time..." value="@if (isset($event)){{ $event->getDate(\App\ConsultantAvailablity::END_TIME) }} @else {{ old('event_end')  }} @endif">
                        </div>
</div>
                        @if(isset($event))
                            @if($event->image_file != null)
                                <img alt="{{ $event->name }}" src="{{ asset($event->image_file) }}" height="100" width="100"/>
                            @endif
                        @endif

                        <div class="form-group">
                            <label>Upload Image </label>
                            <input type="file" name="image_file" value="{{ old('image_file') }}">
                        </div>
                        <div class="form-group">
                            <label>Assign Consultant </label>
                           <select required name="consultant_id" class="form-control">
                               <option>---Select Consultant---</option>
                               @foreach($consultants as $consultant)
                                <option value="{{ $consultant->user_id }}" @if (isset($event)){{ $event->consultant_id == $consultant->user_id ? 'selected' : '' }}  @else {{ old('consultant_id') == $consultant->user_id ? 'selected' : ''  }} @endif> {{ $consultant->user->name }} </option>
                               @endforeach
                               </select>
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/events') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
    <script>
        $("#event_date").datepicker({
            startDate: new Date,
            format:'yyyy-mm-dd',
            autoclose:true
        });
        $(function () {
            //Timepicker

            $(".timepicker").timepicker({
                showInputs: false,
                showMeridian : false
            });
        });

    </script>
@endsection