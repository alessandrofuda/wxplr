@extends('consultant.consultant_dashboard_layout')
@section('top_section')
    <h1>Dashboard<small>Consultant</small></h1>
    <!--<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol>-->
@endsection
@section('content')
    <div class="col-md-12">
        <h2 class="box-title">{!! $page_title !!}</h2>
        <div class="col-md-12">
            <div class="dream_check_lab">
               <p>Your feedback on the user achievements </p>
                @for ($i=1; $i <= 3; $i++)
                    <h4>Achievement {{ $i  }}:</h4>
                    <label>Role & Organization</label>
                    <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->achievement_role_organization.$i }}</p>

                    <label for="">Problem (issue to be solved – goal to be achieved – context)</label>
                    <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->achievement_problem.$i }}</p>

                    <label>Action (what you did, how, which resources you used)</label>
                    <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->achievement_action.$i }}</p>

                    <label>Result (tangible and quantifiable outcomes)</label>
                    <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->achievement_result.$i }}</p>

                    <label>Which skills you have demonstrated through this achievement?</label>
                    <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->achievement_skills.$i }}</p>
                    <div class="form-group">
                        <label for="achievement[{{ $i }}]">Your Feedback</label>
                        {{ $dream_check_lab_feedback["achievement.".$i] }}
                    </div>
                @endfor
                <label>Your Objective</label>
                <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->your_objective }}</p>
                <label>Your Motivation (why you want to move out of your own country)</label>
                <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->motivation }}</p>
                <label>Role/position</label>
                <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->role_position }}</p>
                <label>Industry/area of business</label>
                <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->industry }}</p>
                <label>Company characteristics (size, geographical presence, markets, family owned or listed…)</label>
                <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->company_characteristics }}</p>
                <label>Skills that support this objective</label>
                <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->skills_support_objective }}</p>
                <label>Areas of weakness that hinder this objective.</label>
                <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->weakness_area }}</p>
                <label>Is the objective achievable? Why or why not?</label>
                <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->achievable_objective }}</p>
                <label>What can you do to fill the gap?</label>
                <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->fill_gap }}</p>
                <div class="form-group">
                    <label for="place">Your Feedback</label>
                    {{ $dream_check_lab_feedback['place'] }}</textarea>
                </div>
                <label>Promotion – Your USP</label>
                <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback->dreamchecklab->promotion_usp }}</p>
                <div class="form-group">
                    <lable for="promotion_usp">Your Feedback</lable>
                    {{  $dream_check_lab_feedback['promotion_usp'] }}
                </div>
            </div>
        </div>
    </div>
@endsection
