@extends('admin.layout')
@section('content')
    {{--*/ $user=Auth::user(); /*--}}
    <div class='row'>
        <div class='col-md-12'>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $page_title }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <div class="box-body">
                            <div id="country" class="">
                                <form role="form" method="post" action="{{ url('admin/steady_aim_shoot/store') }}" enctype="multipart/form-data">
                                    <input type="hidden" name="form_type" value="@if(isset($steady_aim_shoot['id']))edit @else create @endif">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="steady_aim_shoot_id" value="@if(isset($steady_aim_shoot['id'])){{ $steady_aim_shoot['id'] }}@endif">

                                    <div class="form-group">
                                        @if(!empty($steady_aim_shoot['steady_aim_shoot_pdf']))
                                            <a href="{{ asset($steady_aim_shoot['steady_aim_shoot_pdf']) }}" target="_blank">
                                                <img alt="steady_aim_shoot_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="steady_aim_shoot_pdf">File : </label>
                                        <input type="file" class="form-control" name="steady_aim_shoot_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="steady_aim_shoot_pdf_label">Label for Pdf: </label>
                                        <input type="text" class="form-control" name="steady_aim_shoot_pdf_label" value="@if(isset($steady_aim_shoot['steady_aim_shoot_pdf_label'])){{ $steady_aim_shoot['steady_aim_shoot_pdf_label'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="top_description">Top description: </label>
                                        <textarea required rows="4" cols="50" class="form-control" name="top_description" placeholder="Top Description">@if(isset($steady_aim_shoot['top_description'])){{ $steady_aim_shoot['top_description'] }}@endif</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="bottom_description">Bottom Description</label>
                                        <textarea required rows="4" cols="50" class="form-control" name="bottom_description" placeholder="Bottom Description">@if(isset($steady_aim_shoot['bottom_description'])){{ $steady_aim_shoot['bottom_description'] }}@endif</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="whats_new">What's Now</label>
                                        <textarea required rows="4" cols="50" class="form-control" name="whats_now" placeholder="What's Now">@if(isset($steady_aim_shoot['whats_now'])){{ $steady_aim_shoot['whats_now'] }}@endif</textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="submit" class="btn btn-primary btn-action-form" value="Save" name="save">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection