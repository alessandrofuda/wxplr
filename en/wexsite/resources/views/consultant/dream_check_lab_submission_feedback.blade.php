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
        @if(empty($dream_check_lab_feedback))
            <div class="col-md-12">
                <div class="alert-danger alert">
                    You are not authorized to access this page!
                </div>
            </div>
        @elseif($dream_check_lab_feedback['validate'] == 1)
            <div class="alert-danger alert">
                You have validated this form submission so you can check your feedback but can't make any changes!
            </div>
            <div class="col-md-12">
                <h3>1. Product – Who are You</h3>
                <div class="col-md-12">
                    <a href="{{ url($dream_check_lab_feedback['cv_file']) }}" class="btn btn-primary"><span class = "glyphicon glyphicon-download"></span> Download CV</a>
                </div>
                <h3>2. Price – What you did</h3>
                <h4>Achievement 1:</h4>
                <div class="col-md-12">
                    <label>Role & Organization</label>
                    <p>{{ $dream_check_lab_feedback->achievement_role_organization1 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Problem (issue to be solved – goal to be achieved – context)</label>
                    <p>{{ $dream_check_lab_feedback->achievement_problem1 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Action (what you did, how, which resources you used)</label>
                    <p>{{ $dream_check_lab_feedback->achievement_action1 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Result (tangible and quantifiable outcomes)</label>
                    <p>{{ $dream_check_lab_feedback->achievement_result1 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Which skills you have demonstrated through this achievement?</label>
                    <p>{{ $dream_check_lab_feedback->achievement_skills1 }}</p>
                </div>
                <div class="col-md-12">
                    <label>You feedback ?</label>
                    <p>{{ $dream_check_lab_feedback->feedback->achievement1 }}</p>
                </div>

                <h4>Achievement 2:</h4>
                <div class="col-md-12">
                    <label>Role & Organization</label>
                    <p>{{ $dream_check_lab_feedback->achievement_role_organization2 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Problem (issue to be solved – goal to be achieved – context)</label>
                    <p>{{ $dream_check_lab_feedback->achievement_problem2 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Action (what you did, how, which resources you used)</label>
                    <p>{{ $dream_check_lab_feedback->achievement_action2 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Result (tangible and quantifiable outcomes)</label>
                    <p>{{ $dream_check_lab_feedback->achievement_result2 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Which skills you have demonstrated through this achievement?</label>
                    <p>{{ $dream_check_lab_feedback->achievement_skills2 }}</p>
                </div>
                <div class="col-md-12">
                    <label>You feedback ?</label>
                    <p>{{ $dream_check_lab_feedback->feedback->achievement2 }}</p>

                </div>
                <h4>Achievement 3:</h4>
                <div class="col-md-12">
                    <label>Role & Organization</label>
                    <p>{{ $dream_check_lab_feedback->achievement_role_organization3 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Problem (issue to be solved – goal to be achieved – context)</label>
                    <p>{{ $dream_check_lab_feedback->achievement_problem3 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Action (what you did, how, which resources you used)</label>
                    <p>{{ $dream_check_lab_feedback->achievement_action3 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Result (tangible and quantifiable outcomes)</label>
                    <p>{{ $dream_check_lab_feedback->achievement_result3 }}</p>
                </div>
                <div class="col-md-12">
                    <label>Which skills you have demonstrated through this achievement?</label>
                    <p>{{ $dream_check_lab_feedback->achievement_skills3 }}</p>
                </div>
                <div class="col-md-12">
                    <label>You feedback ?</label>
                    <p>{{ $dream_check_lab_feedback->feedback->achievement3 }}</p>
                </div>

                <h3>3. Place – What you can do</h3>
                <div class="col-md-12">
                    <label>Your Objective</label>
                    <p>{{ $dream_check_lab_feedback->your_objective }}</p>
                </div>
                <div class="col-md-12">
                    <label>Your Motivation (why you want to move out of your own country)</label>
                    <p>{{ $dream_check_lab_feedback->motivation }}</p>
                </div>
                <div class="col-md-12">
                    <label>Role/position</label>
                    <p>{{ $dream_check_lab_feedback->role_position }}</p>
                </div>
                <div class="col-md-12">
                    <label>Industry/area of business</label>
                    <p>{{ $dream_check_lab_feedback->industry }}</p>
                </div>
                <div class="col-md-12">
                    <label>Company characteristics (size, geographical presence, markets, family owned or listed…)</label>
                    <p>{{ $dream_check_lab_feedback->company_characteristics }}</p>
                </div>
                <div class="col-md-12">
                    <label>Skills that support this objective</label>
                    <p>{{ $dream_check_lab_feedback->skills_support_objective }}</p>
                </div>
                <div class="col-md-12">
                    <label>Areas of weakness that hinder this objective</label>
                    <p>{{ $dream_check_lab_feedback->weakness_area }}</p>
                </div>
                <div class="col-md-12">
                    <label>Is the objective achievable? Why or why not?</label>
                    <p>{{ $dream_check_lab_feedback->achievable_objective }}</p>
                </div>
                <div class="col-md-12">
                    <label>What can you do to fill the gap?</label>
                    <p>{{ $dream_check_lab_feedback->fill_gap }}</p>
                </div>

                <div class="col-md-12">
                    <label>You feedback ?</label>
                    <p>{{ $dream_check_lab_feedback->feedback->place }}</p>
                </div>
                <h3>4. Promotion – Your USP</h3>
                <div class="col-md-12">
                    <label>why should we choose you?</label>
                    <p>{{ $dream_check_lab_feedback->promotion_usp }}</p>
                </div>
                <div class="col-md-12">
                    <label>You feedback ?</label>
                    <p>{{ $dream_check_lab_feedback->feedback->promotion_usp }}</p>
                </div>
            </div>
        @else
            <div class="col-md-12">
                {!! link_to_route('dreamcheck.lab.submission', 'Back to the submission', array($dream_check_lab_feedback['id']), array('class' => 'btn btn-primary pull-right')) !!}
            </div>
            <h2 class="box-title">{{ $page_title }}</h2>
            <div class="col-md-12">
                <div class="dream_check_lab">
                    <form method="post" action="{{ url('user/consultant/dream_check_lab/submission/feedback/store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if($dream_check_lab_feedback['cv_file'] != null)
                            <a href="{{ url($dream_check_lab_feedback['cv_file']) }}" class="btn btn-primary"><span class = "glyphicon glyphicon-download"></span> Download CV</a>
                        @else
                            CV not uploaded
                        @endif
                        <input type="hidden" name="dream_check_id" value = "{{ $dream_check_lab_feedback['id'] }}">
                        <p>Upload cv with your feedback here</p>
                        <div class="form-group">
                            <label for="upload_cv">Upload CV</label>
                            <input required type="file" name="upload_cv">
                        </div>
                        <p>Give your feedback on the user achievements </p>
                        @for ($i=1; $i <= 3; $i++)
                            <h4>Achievement {{ $i  }}:</h4>
                            <label>Role & Organization</label>
                            <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['achievement_role_organization'.$i] }}</p>

                            <label for="">Problem (issue to be solved – goal to be achieved – context)</label>
                            <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['achievement_problem'.$i] }}</p>

                            <label>Action (what you did, how, which resources you used)</label>
                            <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['achievement_action'.$i] }}</p>

                            <label>Result (tangible and quantifiable outcomes)</label>
                            <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['achievement_result'.$i] }}</p>

                            <label>Which skills you have demonstrated through this achievement?</label>
                            <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['achievement_skills'.$i] }}</p>
                            <div class="form-group">
                                <label for="achievement[{{ $i }}]">Your Feedback</label>
                                <textarea required name="achievement[{{ $i }}]">{{ old("achievement.".$i) }}</textarea>
                            </div>
                        @endfor
                        <label>Your Objective</label>
                        <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['your_objective'] }}</p>
                        <label>Your Motivation (why you want to move out of your own country)</label>
                        <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['motivation'] }}</p>
                        <label>Role/position</label>
                        <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['role_position'] }}</p>
                        <label>Industry/area of business</label>
                        <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['industry'] }}</p>
                        <label>Company characteristics (size, geographical presence, markets, family owned or listed…)</label>
                        <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['company_characteristics'] }}</p>
                        <label>Skills that support this objective</label>
                        <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['skills_support_objective'] }}</p>
                        <label>Areas of weakness that hinder this objective.</label>
                        <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['weakness_area'] }}</p>
                        <label>Is the objective achievable? Why or why not?</label>
                        <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['achievable_objective'] }}</p>
                        <label>What can you do to fill the gap?</label>
                        <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['fill_gap'] }}</p>
                        <div class="form-group">
                            <label for="place">Your Feedback</label>
                            <textarea required name="place">{{ old('[place') }}</textarea>
                        </div>
                        <label>Promotion – Your USP</label>
                        <p><strong>User Submission:</strong> {{ $dream_check_lab_feedback['promotion_usp'] }}</p>
                        <div class="form-group">
                            <lable for="promotion_usp">Your Feedback</lable>
                            <textarea required name="promotion_usp">{{ old('promotion_usp') }}</textarea>
                        </div>
                        <div class="form-group">
                            <input name="submit" type="submit" value="Validate & submit feedback">
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-md-12">
                {!! link_to_route('dreamcheck.lab.submission', 'Back to the submission', array($dream_check_lab_feedback['id']), array('class' => 'btn btn-primary pull-right')) !!}
            </div>
        @endif
        </div>
@endsection
