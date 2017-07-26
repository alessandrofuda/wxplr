@extends('consultant.consultant_dashboard_layout')
@section('top_section')
    <h1>Dashboard<small>Consultant</small></h1>
    <!--<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol>-->
@endsection
@section('content')
    @if(empty($dream_check_lab))
        <div class="col-md-12">
            <div class="alert-danger alert">
                Invalid input. You are not authorized to access this page!
            </div>
        </div>
    @else
     <div class="col-md-12 profile_page">
         <div class="col-md-12">
             {!! link_to_route('dreamcheck.lab.submission.feedback', 'Validate it and give feedback', array($dream_check_lab['id']), array('class' => 'btn btn-primary pull-right')) !!}
         </div>
        <h2 class="box-title">{!! $page_title  !!}</h2>
        <div class="col-md-12">
            <h3>1. Product – Who are You</h3>
            <div class="col-md-12">
                <a href="{{ url($dream_check_lab['cv_file']) }}" class="btn btn-primary"><span class = "glyphicon glyphicon-download"></span> Download CV</a>
            </div>
            <h3>2. Price – What you did</h3>
            <h4>Achievement 1:</h4>
            <div class="col-md-12">
                <label>Role & Organization</label>
                <p>{{ $dream_check_lab['achievement_role_organization1'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Problem (issue to be solved – goal to be achieved – context)</label>
                <p>{{ $dream_check_lab['achievement_problem1'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Action (what you did, how, which resources you used)</label>
                <p>{{ $dream_check_lab['achievement_action1'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Result (tangible and quantifiable outcomes)</label>
                <p>{{ $dream_check_lab['achievement_result1'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Which skills you have demonstrated through this achievement?</label>
                <p>{{ $dream_check_lab['achievement_skills1'] }}</p>
            </div>
            <h4>Achievement 2:</h4>
            <div class="col-md-12">
                <label>Role & Organization</label>
                <p>{{ $dream_check_lab['achievement_role_organization2'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Problem (issue to be solved – goal to be achieved – context)</label>
                <p>{{ $dream_check_lab['achievement_problem2'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Action (what you did, how, which resources you used)</label>
                <p>{{ $dream_check_lab['achievement_action2'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Result (tangible and quantifiable outcomes)</label>
                <p>{{ $dream_check_lab['achievement_result2'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Which skills you have demonstrated through this achievement?</label>
                <p>{{ $dream_check_lab['achievement_skills2'] }}</p>
            </div>
            <h4>Achievement 3:</h4>
            <div class="col-md-12">
                <label>Role & Organization</label>
                <p>{{ $dream_check_lab['achievement_role_organization3'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Problem (issue to be solved – goal to be achieved – context)</label>
                <p>{{ $dream_check_lab['achievement_problem3'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Action (what you did, how, which resources you used)</label>
                <p>{{ $dream_check_lab['achievement_action3'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Result (tangible and quantifiable outcomes)</label>
                <p>{{ $dream_check_lab['achievement_result3'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Which skills you have demonstrated through this achievement?</label>
                <p>{{ $dream_check_lab['achievement_skills3'] }}</p>
            </div>
            <h3>3. Place – What you can do</h3>
            <div class="col-md-12">
                <label>Your Objective</label>
                <p>{{ $dream_check_lab['your_objective'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Your Motivation (why you want to move out of your own country)</label>
                <p>{{ $dream_check_lab['motivation'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Role/position</label>
                <p>{{ $dream_check_lab['role_position'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Industry/area of business</label>
                <p>{{ $dream_check_lab['industry'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Company characteristics (size, geographical presence, markets, family owned or listed…)</label>
                <p>{{ $dream_check_lab['company_characteristics'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Skills that support this objective</label>
                <p>{{ $dream_check_lab['skills_support_objective'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Areas of weakness that hinder this objective</label>
                <p>{{ $dream_check_lab['weakness_area'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Is the objective achievable? Why or why not?</label>
                <p>{{ $dream_check_lab['achievable_objective'] }}</p>
            </div>
            <div class="col-md-12">
                <label>What can you do to fill the gap?</label>
                <p>{{ $dream_check_lab['fill_gap'] }}</p>
            </div>
            <h3>4. Promotion – Your USP</h3>
            <div class="col-md-12">
                <label>why should we choose you?</label>
                <p>{{ $dream_check_lab['promotion_usp'] }}</p>
            </div>
            <div class="col-md-12">
                <label>Interested Country</label>
                <p>{{ $dream_check_lab['interest_country'] }}</p>
            </div>
        </div>
         <div class="col-md-12">
             {!! link_to_route('dreamcheck.lab.submission.feedback', 'Validate it and give feedback', array($dream_check_lab['id']), array('class' => 'btn btn-primary pull-right')) !!}
         </div>
    </div>
    @endif
@endsection
