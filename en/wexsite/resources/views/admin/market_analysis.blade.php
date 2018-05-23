@extends('admin.layout')
@section('content')
    
{{--*/ $user=Auth::user(); /*--}}
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
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#age">Age</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#gender">Gender</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#education">Education</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#occupation">Occupation</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#industry">Industry</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#market_analysis">Market Analysis</a>
                        </li>
                    </ul>
                      <div class="tab-content">
                        <div id="age" class="tab-pane fade in active">
                          <h3>Age PDFs</h3>
                            <form role="form" method="post" action="{{ url('admin/market_analysis/agepdf') }}"   enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <fieldset>
                                    <legend>20-24 Age</legend>
                                    <div class="form-group">
                                        @if(!empty($age_data))
                                            <a href="{{ asset($age_data['20-24']['pdf_path']) }}" target="_blank">
                                                <img alt="Age_20-24_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="age_range">File : </label>
                                        <input type="file" class="form-control" name="age_20_24">
                                    </div>
                                    <div class="form-group">
                                        <label for="age_range">Name: </label>
                                        <input type="text" class="form-control" name="age_20_24_name" value="@if(!empty($age_data)){{ $age_data['20-24']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="age_20_24_range" value="20-24">
                                </fieldset>
                                <fieldset>
                                    <legend>25-29 Age</legend>
                                    <div class="form-group">
                                        @if(!empty($age_data))
                                            <a href="{{ asset($age_data['25-29']['pdf_path']) }}" target="_blank">
                                                <img alt="Age_25-29_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="age_range">File : </label>
                                        <input type="file" class="form-control" name="age_25_29">
                                    </div>
                                    <div class="form-group">
                                        <label for="age_range">Name: </label>
                                        <input type="text" class="form-control" name="age_25_29_name" value="@if(!empty($age_data)){{ $age_data['25-29']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="age_25_29_range" value="25-29">
                                </fieldset>
                                <fieldset>
                                    <legend>30-34 Age</legend>
                                    <div class="form-group">
                                        @if(!empty($age_data))
                                            <a href="{{ asset($age_data['30-34']['pdf_path']) }}" target="_blank">
                                                <img  alt="Age_30-34_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="age_range">File : </label>
                                        <input type="file" class="form-control" name="age_30_34">
                                    </div>
                                    <div class="form-group">
                                        <label for="age_range">Name: </label>
                                        <input type="text" class="form-control" name="age_30_34_name" value="@if(!empty($age_data)){{ $age_data['30-34']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="age_30_34_range" value="30-34">
                                </fieldset>
                                <fieldset>
                                    <legend>35-39 Age</legend>
                                    <div class="form-group">
                                        @if(!empty($age_data))
                                            <a href="{{ asset($age_data['35-39']['pdf_path']) }}" target="_blank">
                                                <img alt="Age_35-39_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="age_range">File : </label>
                                        <input type="file" class="form-control" name="age_35_39">
                                    </div>
                                    <div class="form-group">
                                        <label for="age_range">Name: </label>
                                        <input type="text" class="form-control" name="age_35_39_name" value="@if(!empty($age_data)){{ $age_data['35-39']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="age_35_39_range" value="35-39">
                                </fieldset>
                                <fieldset>
                                    <legend>40-44 Age</legend>
                                    <div class="form-group">
                                        @if(!empty($age_data))
                                            <a href="{{ asset($age_data['40-44']['pdf_path']) }}" target="_blank">
                                                <img alt="Age_40-44_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="age_range">File : </label>
                                        <input type="file" class="form-control" name="age_40_44">
                                    </div>
                                    <div class="form-group">
                                        <label for="age_range">Name: </label>
                                        <input type="text" class="form-control" name="age_40_44_name" value="@if(!empty($age_data)){{ $age_data['40-44']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="age_40_44_range" value="40-44">
                                </fieldset>
                                <fieldset>
                                    <legend>45-49 Age</legend>
                                    <div class="form-group">
                                        @if(!empty($age_data))
                                            <a href="{{ asset($age_data['45-49']['pdf_path']) }}" target="_blank">
                                                <img alt="Age_45-49_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="age_range">File : </label>
                                        <input type="file" class="form-control" name="age_45_49">
                                    </div>
                                    <div class="form-group">
                                        <label for="age_range">Name: </label>
                                        <input type="text" class="form-control" name="age_45_49_name" value="@if(!empty($age_data)){{ $age_data['45-49']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="age_45_49_range" value="45-49">
                                </fieldset>
                                <fieldset>
                                    <legend>50-54 Age</legend>
                                    <div class="form-group">
                                        @if(!empty($age_data))
                                            <a href="{{ asset($age_data['50-54']['pdf_path']) }}" target="_blank">
                                                <img alt="Age_50-54_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="age_range">File : </label>
                                        <input type="file" class="form-control" name="age_50_54">
                                    </div>
                                    <div class="form-group">
                                        <label for="age_range">Name: </label>
                                        <input type="text" class="form-control" name="age_50_54_name" value="@if(!empty($age_data)){{ $age_data['50-54']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="age_50_54_range" value="50-54">
                                </fieldset>
                                <fieldset>
                                    <legend>over 55 Age</legend>
                                    <div class="form-group">
                                        @if(!empty($age_data))
                                            <a href="{{ asset($age_data['over-55']['pdf_path']) }}" target="_blank">
                                                <img alt="Age_over-55_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="age_range">File : </label>
                                        <input type="file" class="form-control" name="age_over_55">
                                    </div>
                                    <div class="form-group">
                                        <label for="age_range">Name: </label>
                                        <input type="text" class="form-control" name="age_over_55_name" value="@if(!empty($age_data)){{ $age_data['over-55']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="age_over_55_range" value="over-55">
                                </fieldset>
                                <div class="form-group has-feedback">
                                <div class="input-group date">
                                    <input type="submit" class="btn btn-primary btn-action-form" value="Save Profile" name="save_profile">
                                </div>
                                </div>
                        </form>
                        </div>
                        <div id="gender" class="tab-pane fade">
                          <h3>Gender PDFs</h3>
                          <form role="form" method="post" action="{{ url('admin/market_analysis/genderpdf') }}"   enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <fieldset>
                                    <legend>Male</legend>
                                    <div class="form-group">
                                        @if(!empty($gender_data))
                                            <a href="{{ asset($gender_data['Male']['pdf_path']) }}" target="_blank">
                                                <img alt="Male_Gender_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="gender_male_pdf">File : </label>
                                        <input type="file" class="form-control" name="gender_male_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender_male_name">Name: </label>
                                        <input type="text" class="form-control" name="gender_male_name" value="@if(!empty($gender_data)){{ $gender_data['Male']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="gender_male" value="male">
                                </fieldset>
                                <fieldset>
                                    <legend>Female</legend>
                                    <div class="form-group">
                                        @if(!empty($gender_data))
                                            <a href="{{ asset($gender_data['Female']['pdf_path']) }}" target="_blank">
                                                <img alt="Female_Gender_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="gender_female_pdf">File : </label>
                                        <input type="file" class="form-control" name="gender_female_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender_female_name">Name: </label>
                                        <input type="text" class="form-control" name="gender_female_name" value="@if(!empty($gender_data)){{ $gender_data['Female']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="gender_female" value="female">
                                </fieldset>
                                <div class="form-group has-feedback">
                                    <div class="input-group date">
                                        <input type="submit" class="btn btn-primary btn-action-form" value="Update PDF" name="update_pdf">
                                    </div>
                                </div>
                        </form>
                        </div>
                        <div id="education" class="tab-pane fade">
                            <h3>Education PDFs</h3>
                            <form role="form" method="post" action="{{ url('admin/market_analysis/educationpdf') }}"   enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <fieldset>
                                    <legend>High School Diploma</legend>
                                    <div class="form-group">
                                        @if(!empty($education_data))
                                            <a href="{{ asset($education_data['high_school_diploma']['pdf_path']) }}" target="_blank">
                                                <img alt="high_school_diploma_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="education_highschool_diploma_pdf">File : </label>
                                        <input type="file" class="form-control" name="education_highschool_diploma_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="education_highschool_diploma_name">Name: </label>
                                        <input type="text" class="form-control" name="education_highschool_diploma_name" value="@if(!empty($education_data)){{ $education_data['high_school_diploma']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="education_highschool_diploma" value="high_school_diploma">
                                </fieldset>
                                <fieldset>
                                    <legend>Bachelor’s degree</legend>
                                    <div class="form-group">
                                        @if(!empty($education_data))
                                            <a href="{{ asset($education_data['bachelor_degree']['pdf_path']) }}" target="_blank">
                                                <img alt="bachelor_degree_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="education_bdergee_pdf">File : </label>
                                        <input type="file" class="form-control" name="education_bachelor_dergee_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="education_bachelor_dergee_name">Name: </label>
                                        <input type="text" class="form-control" name="education_bachelor_dergee_name" value="@if(!empty($education_data)){{ $education_data['bachelor_degree']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="education_bachelor_dergee" value="bachelor_degree">
                                </fieldset>
                                <fieldset>
                                    <legend>Master’s degree</legend>
                                    <div class="form-group">
                                        @if(!empty($education_data))
                                            <a href="{{ asset($education_data['master_degree']['pdf_path']) }}" target="_blank">
                                                <img alt="master_degree_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="education_master_dergee_pdf">File : </label>
                                        <input type="file" class="form-control" name="education_master_dergee_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="education_master_dergee_name">Name: </label>
                                        <input type="text" class="form-control" name="education_master_dergee_name" value="@if(!empty($education_data)){{ $education_data['master_degree']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="education_master_dergee" value="master_degree">
                                </fieldset>
                                <fieldset>
                                    <legend>Post-university education</legend>
                                    <div class="form-group">
                                        @if(!empty($education_data))
                                            <a href="{{ asset($education_data['post_university']['pdf_path']) }}" target="_blank">
                                                <img  alt="post_university_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="education_post_university_pdf">File : </label>
                                        <input type="file" class="form-control" name="education_post_university_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="education_post_university_name">Name: </label>
                                        <input type="text" class="form-control" name="education_post_university_name" value="@if(!empty($education_data)){{ $education_data['post_university']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="education_post_university" value="post_university">
                                </fieldset>
                                <div class="form-group has-feedback">
                                    <div class="input-group date">
                                        <input type="submit" class="btn btn-primary btn-action-form" value="Update PDF" name="update_pdf">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="occupation" class="tab-pane fade">
                            <h3>Occupation PDFs</h3>
                            <form role="form" method="post" action="{{ url('admin/market_analysis/occupationpdf') }}"   enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <fieldset>
                                    <legend>Managers</legend>
                                    <div class="form-group">
                                        @if(!empty($occupation_data))
                                            <a href="{{ asset($occupation_data['managers']['pdf_path']) }}" target="_blank">
                                                <img alt="managers_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="occupation_managers_pdf">File : </label>
                                        <input type="file" class="form-control" name="occupation_managers_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="occupation_managers_name">Name: </label>
                                        <input type="text" class="form-control" name="occupation_managers_name" value="@if(!empty($occupation_data) && isset($occupation_data['managers']['pdf_name'])){{ $occupation_data['managers']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="occupation_managers" value="managers">
                                </fieldset>
                                <fieldset>
                                    <legend>Professionals</legend>
                                    <div class="form-group">
                                            @if(!empty($occupation_data) && isset($occupation_data['professionals']['pdf_path']))
                                                    <a href="{{ asset($occupation_data['professionals']['pdf_path']) }}" target="_blank">
                                                            <img alt="professionals_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                                    </a>
                                            @endif
                                            <label for="occupation_professionals_pdf">File : </label>
                                            <input type="file" class="form-control" name="occupation_professionals_pdf">
                                    </div>
                                    <div class="form-group">
                                            <label for="occupation_professionals_name">Name: </label>
                                            <input type="text" class="form-control" name="occupation_professionals_name" value="@if(!empty($occupation_data) && isset($occupation_data['professionals']['pdf_name'])){{ $occupation_data['professionals']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="occupation_professionals" value="professionals">
                                </fieldset>
                                <fieldset>
                                    <legend>Technicians</legend>
                                    <div class="form-group">
                                            @if(!empty($occupation_data) && isset($occupation_data['technicians']['pdf_path']))
                                                    <a href="{{ asset($occupation_data['technicians']['pdf_path']) }}" target="_blank">
                                                        <img alt="technicians_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                                    </a>
                                            @endif
                                            <label for="occupation_technicians_pdf">File : </label>
                                            <input type="file" class="form-control" name="occupation_technicians_pdf">
                                    </div>
                                    <div class="form-group">
                                            <label for="occupation_technicians_name">Name: </label>
                                            <input type="text" class="form-control" name="occupation_technicians_name" value="@if(!empty($occupation_data) && isset($occupation_data['technicians']['pdf_name'])){{ $occupation_data['technicians']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="occupation_technicians" value="technicians">
                                </fieldset>
                                <fieldset>
                                    <legend>Clerical</legend>
                                    <div class="form-group">
                                            @if(!empty($occupation_data) && isset($occupation_data['clerical']['pdf_path']))
                                                    <a href="{{ asset($occupation_data['clerical']['pdf_path']) }}" target="_blank">
                                                            <img alt="clerical_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                                    </a>
                                            @endif
                                            <label for="occupation_clerical_pdf">File : </label>
                                            <input type="file" class="form-control" name="occupation_clerical_pdf">
                                    </div>
                                    <div class="form-group">
                                            <label for="occupation_clerical_name">Name: </label>
                                            <input type="text" class="form-control" name="occupation_clerical_name" value="@if(!empty($occupation_data) && isset($occupation_data['clerical']['pdf_name'])){{ $occupation_data['clerical']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="occupation_clerical" value="clerical">
                                </fieldset>
                                <fieldset>
                                    <legend>Service and Sale</legend>
                                    <div class="form-group">
                                            @if(!empty($occupation_data) && isset($occupation_data['service_and_sale']['pdf_path']))
                                                    <a href="{{ asset($occupation_data['service_and_sale']['pdf_path']) }}" target="_blank">
                                                            <img alt="service_and_sale_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                                    </a>
                                            @endif
                                            <label for="occupation_service_and_sale_pdf">File : </label>
                                            <input type="file" class="form-control" name="occupation_service_and_sale_pdf">
                                    </div>
                                    <div class="form-group">
                                            <label for="occupation_service_and_sale_name">Name: </label>
                                            <input type="text" class="form-control" name="occupation_service_and_sale_name" value="@if(!empty($occupation_data) && isset($occupation_data['service_and_sale']['pdf_name'])){{ $occupation_data['service_and_sale']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="occupation_service_and_sale" value="service_and_sale">
                                </fieldset>
                                <fieldset>
                                    <legend>Crafts Related Trade</legend>
                                    <div class="form-group">
                                            @if(!empty($occupation_data) && isset($occupation_data['crafts_related_trade']['pdf_path']))
                                                    <a href="{{ asset($occupation_data['crafts_related_trade']['pdf_path']) }}" target="_blank">
                                                            <img  alt="crafts_related_trade_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                                    </a>
                                            @endif
                                            <label for="occupation_crafts_related_trade_pdf">File : </label>
                                            <input type="file" class="form-control" name="occupation_crafts_related_trade_pdf">
                                    </div>
                                    <div class="form-group">
                                            <label for="occupation_crafts_related_trade_name">Name: </label>
                                            <input type="text" class="form-control" name="occupation_crafts_related_trade_name" value="@if(!empty($occupation_data) && isset($occupation_data['crafts_related_trade']['pdf_name'])){{ $occupation_data['crafts_related_trade']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="occupation_crafts_related_trade" value="crafts_related_trade">
                                </fieldset>
                                <fieldset>
                                    <legend>Plant Machine Operators</legend>
                                    <div class="form-group">
                                            @if(!empty($occupation_data) && isset($occupation_data['plant_machine_operators']['pdf_path']))
                                                    <a href="{{ asset($occupation_data['plant_machine_operators']['pdf_path']) }}" target="_blank">
                                                            <img alt="plant_machine_operators_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                                    </a>
                                            @endif
                                            <label for="occupation_plant_machine_operators_pdf">File : </label>
                                            <input type="file" class="form-control" name="occupation_plant_machine_operators_pdf">
                                    </div>
                                    <div class="form-group">
                                            <label for="occupation_plant_machine_operators_name">Name: </label>
                                            <input type="text" class="form-control" name="occupation_plant_machine_operators_name" value="@if(!empty($occupation_data) && isset($occupation_data['plant_machine_operators']['pdf_name'])){{ $occupation_data['plant_machine_operators']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="occupation_plant_machine_operators" value="plant_machine_operators">
                                </fieldset>
                                <div class="form-group has-feedback">
                                    <div class="input-group date">
                                        <input type="submit" class="btn btn-primary btn-action-form" value="Update PDF" name="update_pdf">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="industry" class="tab-pane fade">
                            <h3>Industry PDFs</h3>
                            <form role="form" method="post" action="{{ url('admin/market_analysis/industrypdf') }}"   enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <fieldset>
                                    <legend>Agriculture</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['agriculture']['pdf_path']) }}" target="_blank">
                                                <img alt="agriculture_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_agriculture_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_agriculture_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_agriculture_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_agriculture_name" value="@if(!empty($industry_data) && isset($industry_data['agriculture']['pdf_name'])){{ $industry_data['agriculture']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_agriculture" value="agriculture">
                                </fieldset>
                                <fieldset>
                                    <legend>Manufacturing</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['manufacturing']['pdf_path']) }}" target="_blank">
                                                <img  alt="manufacturing_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_manufacturing_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_manufacturing_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_manufacturing_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_manufacturing_name" value="@if(!empty($industry_data) && isset($industry_data['manufacturing']['pdf_name']) ){{ $industry_data['manufacturing']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_manufacturing" value="manufacturing">
                                </fieldset>
                                <fieldset>
                                    <legend>Electricity</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['electricity']['pdf_path']) }}" target="_blank">
                                                <img  alt="electricity_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_electricity_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_electricity_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_electricity_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_electricity_name" value="@if(!empty($industry_data) && isset($industry_data['electricity']['pdf_name'])){{ $industry_data['electricity']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_electricity" value="electricity">
                                </fieldset>
                                <fieldset>
                                    <legend>Wholesale</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['wholesale']['pdf_path']) }}" target="_blank">
                                                <img alt="wholesale_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_wholesale_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_wholesale_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_wholesale_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_wholesale_name" value="@if(!empty($industry_data)){{ $industry_data['wholesale']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_wholesale" value="wholesale">
                                </fieldset>
                                <fieldset>
                                    <legend>Transport</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['transport']['pdf_path']) }}" target="_blank">
                                                <img  alt="transport_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_transport_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_transport_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_transport_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_transport_name" value="@if(!empty($industry_data)){{ $industry_data['transport']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_transport" value="transport">
                                </fieldset>
                                <fieldset>
                                    <legend>ICT</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['ICT']['pdf_path']) }}" target="_blank">
                                                <img   alt="ICT_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_ICT_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_ICT_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_ICT_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_ICT_name" value="@if(!empty($industry_data)){{ $industry_data['ICT']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_ICT" value="ICT">
                                </fieldset>
                                <fieldset>
                                    <legend>Financial Services</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['financial_services']['pdf_path']) }}" target="_blank">
                                                <img  alt="financial_services_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_financial_services_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_financial_services_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_financial_services_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_financial_services_name" value="@if(!empty($industry_data)){{ $industry_data['financial_services']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_financial_services" value="financial_services">
                                </fieldset>
                                <fieldset>
                                    <legend>Professional Services</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['professional_services']['pdf_path']) }}" target="_blank">
                                                <img  alt="professional_services_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_professional_services_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_professional_services_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_professional_services_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_professional_services_name" value="@if(!empty($industry_data)){{ $industry_data['professional_services']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_professional_services" value="professional_services">
                                </fieldset>
                                <fieldset>
                                    <legend>Administrative Services</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['administrative_services']['pdf_path']) }}" target="_blank">
                                                <img alt="administrative_services_pdf"   src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_administrative_services_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_administrative_services_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_administrative_services_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_administrative_services_name" value="@if(!empty($industry_data)){{ $industry_data['administrative_services']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_administrative_services" value="administrative_services">
                                </fieldset>
                                <fieldset>
                                    <legend>Public Administration</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['public_administration']['pdf_path']) }}" target="_blank">
                                                <img alt="public_administration_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_public_administration_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_public_administration_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_public_administration_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_public_administration_name" value="@if(!empty($industry_data)){{ $industry_data['public_administration']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_public_administration" value="public_administration">
                                </fieldset>
                                <fieldset>
                                    <legend>Education</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['education']['pdf_path']) }}" target="_blank">
                                                <img alt="education_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_education_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_education_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_education_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_education_name" value="@if(!empty($industry_data)){{ $industry_data['education']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_education" value="education">
                                </fieldset>
                                <fieldset>
                                    <legend>Health</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['health']['pdf_path']) }}" target="_blank">
                                                <img alt="health_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_health_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_health_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_health_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_health_name" value="@if(!empty($industry_data)){{ $industry_data['health']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_health" value="health">
                                </fieldset>
                                <fieldset>
                                    <legend>Arts</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['arts']['pdf_path']) }}" target="_blank">
                                                <img alt="arts_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_arts_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_arts_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_arts_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_arts_name" value="@if(!empty($industry_data)){{ $industry_data['arts']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_arts" value="arts">
                                </fieldset>
                                <fieldset>
                                    <legend>Other Services</legend>
                                    <div class="form-group">
                                        @if(!empty($industry_data))
                                            <a href="{{ asset($industry_data['other_services']['pdf_path']) }}" target="_blank">
                                                <img alt="other_services_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="industry_other_services_pdf">File : </label>
                                        <input type="file" class="form-control" name="industry_other_services_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="industry_other_services_name">Name: </label>
                                        <input type="text" class="form-control" name="industry_other_services_name" value="@if(!empty($industry_data)){{ $industry_data['other_services']['pdf_name'] }}@endif">
                                    </div>
                                    <input type="hidden" class="form-control" name="industry_other_services" value="other_services">
                                </fieldset>
                                <div class="form-group has-feedback">
                                    <div class="input-group date">
                                        <input type="submit" class="btn btn-primary btn-action-form" value="Update PDF" name="update_pdf">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="market_analysis" class="tab-pane fade">
                            <h3>Market Analysis PDFs</h3>
                            <form role="form" method="post" action="{{ url('admin/market_analysis/contentpdf') }}"   enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <fieldset>
                                    <legend>Market Analysis</legend> 
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['market_analysis']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img  alt="market_analysis_pdf"  src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="market_analysis_pdf">File : </label>
                                        <input type="file" class="form-control" name="market_analysis_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="market_analysis_pdf_label">Market Analysis File Label</label>
                                        <input class="form-control" name="market_analysis_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['market_analysis']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="market_analysis_desc">Market Analysis </label>
                                        <textarea class="form-control" name="market_analysis_desc" id="textarea-ckeditor" value="" rows="10">@if(!empty($market_analysis_data)){{ $market_analysis_data['market_analysis']['desc'] }}@endif</textarea>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Labour Market Situation</legend>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['labour_market_situation']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="labour_market_situation_pdf">Labour Market Situation File : </label>
                                        <input type="file" class="form-control" name="labour_market_situation_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="labour_market_situation_pdf_label">Labour Market Situation File Label</label>
                                        <input class="form-control" name="labour_market_situation_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['labour_market_situation']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="labour_market_situation_desc">Labour Market Situation </label>
                                        <textarea class="form-control" name="labour_market_situation_desc" id="textarea-ckeditor1" value="" rows="10">
                                            @if(!empty($market_analysis_data)){{ $market_analysis_data['labour_market_situation']['desc'] }}@endif
                                        </textarea>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Quality of Work</legend>
                                    <div class="form-group">
                                        <label for="quality_of_work_desc">Quality of Work Description</label>
                                        <textarea class="form-control" name="quality_of_work_desc" id="textarea-ckeditor2" value="" rows="10">
                                            @if(!empty($market_analysis_data)){{ $market_analysis_data['quality_of_work']['desc'] }}@endif
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['quality_of_work']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="quality_of_work_pdf">Quality of work : </label>
                                        <input type="file" class="form-control" name="quality_of_work_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="quality_of_work_pdf_label">Quality of work File Label</label>
                                        <input class="form-control" name="quality_of_work_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['quality_of_work']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['employment_stability']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="employment_stability_pdf">Employment stability : </label>
                                        <input type="file" class="form-control" name="employment_stability_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_stability_pdf_label">Employment stability File Label</label>
                                        <input class="form-control" name="employment_stability_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['employment_stability']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['safety_at_work']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="safety_at_work_pdf">Safety at work : </label>
                                        <input type="file" class="form-control" name="safety_at_work_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="safety_at_work_pdf_label">Safety at work File Label</label>
                                        <input class="form-control" name="safety_at_work_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['safety_at_work']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['work_life_balance']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="work_life_balance_pdf">Work-life balance : </label>
                                        <input type="file" class="form-control" name="work_life_balance_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="work_life_balance_pdf_label">Work-life balance File Label</label>
                                        <input class="form-control" name="work_life_balance_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['work_life_balance']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Quality of Life</legend>
                                    <div class="form-group">
                                        <label for="quality_of_life_desc">Quality of life Description</label>
                                        <textarea class="form-control" name="quality_of_life_desc" id="textarea-ckeditor3" value="" rows="10">
                                            @if(!empty($market_analysis_data)){{ $market_analysis_data['quality_of_life']['desc'] }}@endif
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['quality_of_life']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="quality_of_life_pdf">Quality of life : </label>
                                        <input type="file" class="form-control" name="quality_of_life_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="quality_of_life_pdf_label">Quality of life File Label</label>
                                        <input class="form-control" name="quality_of_life_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['quality_of_life']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['cost_of_life']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="cost_of_life_pdf">Cost of life : </label>
                                        <input type="file" class="form-control" name="cost_of_life_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="cost_of_life_pdf_label">Cost of life File Label</label>
                                        <input class="form-control" name="cost_of_life_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['cost_of_life']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['environmental_quality']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="environmental_quality_pdf">Environmental quality : </label>
                                        <input type="file" class="form-control" name="environmental_quality_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="environmental_quality_pdf_label">Environmental quality File Label</label>
                                        <input class="form-control" name="environmental_quality_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['environmental_quality']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['security']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="security_pdf">Security : </label>
                                        <input type="file" class="form-control" name="security_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="security_pdf_label">Security File Label</label>
                                        <input class="form-control" name="security_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['security']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['life_satisfaction']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="life_satisfaction_pdf">Life satisfaction : </label>
                                        <input type="file" class="form-control" name="life_satisfaction_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="life_satisfaction_pdf_label">Life satisfaction File Label</label>
                                        <input class="form-control" name="life_satisfaction_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['life_satisfaction']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['health_care_system']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="health_care_system_pdf">Health care system coverage : </label>
                                        <input type="file" class="form-control" name="health_care_system_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="health_care_system_pdf_label">Health care system coverage File Label</label>
                                        <input class="form-control" name="health_care_system_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['health_care_system']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                    <div class="form-group">
                                        @if(!empty($market_analysis_data))
                                            <a href="{{ asset($market_analysis_data['family_friendly_policies']['pdfs']['pdf_path']) }}" target="_blank">
                                                <img alt="market_analysis_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                            </a>
                                        @endif
                                        <label for="family_friendly_policies_pdf">Family friendly policies : </label>
                                        <input type="file" class="form-control" name="family_friendly_policies_pdf">
                                    </div>
                                    <div class="form-group">
                                        <label for="family_friendly_policies_pdf_label">Family friendly policies File Label</label>
                                        <input class="form-control" name="family_friendly_policies_pdf_label" value="@if(!empty($market_analysis_data)){{ $market_analysis_data['family_friendly_policies']['pdfs']['pdf_name'] }}@endif">
                                    </div>
                                </fieldset>
                                <div class="form-group has-feedback">
                                    <div class="input-group date">
                                        <input type="submit" class="btn btn-primary btn-action-form" value="Update" name="update">
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection