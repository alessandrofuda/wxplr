@extends('admin.layout')
@section('content')
    {{ $user=Auth::user() }}
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
                            <div class="box-header">
                                <a class="btn btn-primary" href="{{ url('admin/steady_aim_shoot/country_pdf/list') }}"><span class="glyphicon glyphicon-arrow-left"></span> Back to Country Pdf List</a>
                            </div>
                            <div id="country" class="">
                                <h3>Country PDFs</h3>
                                <form role="form" method="post" action="{{ url('admin/steady_aim_shoot/country_pdf/store') }}"   enctype="multipart/form-data">

                                    <input type="hidden" name="form_type" value="@if(isset($countryPdf['id']))edit @else create @endif">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="country_pdf_id" value="@if(isset($countryPdf['id'])){{ $countryPdf['id'] }}@endif">
                                    <div class="form-group">
                                        <label for="country_name">Category</label>
                                        @if (count($country_list) > 0)
                                            <select name="country_name" id="country" required class="form-control">
                                                <option value="">Select Country</option>
                                                @foreach ($country_list as $country)
                                                    <option value="{{ $country->country_name }}"@if(isset($countryPdf['country_name']) && $country->country_name == $countryPdf['country_name'])) selected @endif>{{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {{--@if(!empty($industry_data))--}}
                                            {{--<a href="{{ asset($industry_data['agriculture']['pdf_path']) }}" target="_blank">--}}
                                                {{--<img src="{{ asset('admin/custom/images/file-icon.png') }}">--}}
                                            {{--</a>--}}
                                        {{--@endif--}}
                                        <label for="country_pdf">File : </label>
                                        <input type="file" class="form-control" name="country_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="country_pdf_label">Label: </label>
                                        <input type="text" class="form-control" name="country_pdf_label" value="@if(isset($countryPdf['country_pdf_label'])){{ $countryPdf['country_pdf_label'] }}@endif">
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