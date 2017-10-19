@extends('front.dashboard_layout')
@section('content')
    <div class="container user_profile_form">
        <div class="row">
            <div class="heading">
                <h1>{{ $page_title }}</h1>
            </div>
        </div>
        <div class="row">
            @if(empty($dream_check_lab_feedback))
                <div class="col-md-12">
                    <div class="alert-danger alert">
                        You are not authorized to access this page because this Dream check Lab form is not validated yet or invalid id!
                    </div>
                </div>
            @else
                <div class="col-md-12">
                    <div class="dream_check_lab">
                        <div class="col-md-12">
                            {!! link_to_route('user.dashboard', '<< Back to dashboard', array(), array('class' => 'btn btn-primary pull-right')) !!}
                        </div>
                        <h2 class="box-title">{{ $page_title }}</h2>
                        <div class="col-md-12">
                            <h3>1. Product – Who are You</h3>
                            <div class="col-md-12">
                                <a href="{{ url($dream_check_lab_feedback['cv_file']) }}" class="btn btn-primary"><span class = "glyphicon glyphicon-download"></span> Download CV</a>
                            </div>
                            <h3>2. Price – What you did</h3>
                            <h4>Achievement 1:</h4>
                            <div class="col-md-12">
                                <p>{{ $dream_check_lab_feedback['achievement1'] }}</p>
                            </div>

                            <h4>Achievement 2:</h4>
                            <div class="col-md-12">
                                <p>{{ $dream_check_lab_feedback['achievement2'] }}</p>
                            </div>
                            <h4>Achievement 3:</h4>
                            <div class="col-md-12">
                                <p>{{ $dream_check_lab_feedback['achievement3'] }}</p>
                            </div>
                            <h3>3. Place – What you can do</h3>
                            <div class="col-md-12">
                                <p>{{ $dream_check_lab_feedback['place'] }}</p>
                            </div>
                            <h3>4. Promotion – Your USP</h3>
                            <div class="col-md-12">
                                <p>{{ $dream_check_lab_feedback['promotion_usp'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            {!! link_to_route('user.dashboard', '<< Back to dashboard', array(), array('class' => 'btn btn-primary pull-right')) !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection