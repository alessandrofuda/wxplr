<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Adivalue</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(isset($meta_tags))
        @foreach($meta_tags as $meta_tag)
            <meta name="{{ $meta_tag->name }}" content="{{ $meta_tag->content }}">
            @endforeach
            @endif
                    <!-- owl carousel css-->
            <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.css') }}" type="text/css">
            <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}" type="text/css">
            <link rel="stylesheet" href="{{ asset('frontend/css/owl-custom.css') }}" type="text/css">

            <!-- owl carousel css-->
            <link rel="stylesheet" href="{{ asset('/admin/plugins/datepicker/datepicker3.css') }}">
            <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
            <!--link rel="stylesheet" href="{{-- asset('frontend/css/bootstrap.css') --}}" type="text/css"-->
            <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
            <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
            <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}" type="text/css">
            <link href='https://fonts.googleapis.com/css?family=Roboto:500' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
            <script src="{{ asset('frontend/js/jquery-1.12.4.js') }}"></script>
            <link rel="stylesheet" type="text/css" href="{{ asset('frontend/slick/slick-theme.css') }}"/>
            <link rel="stylesheet" type="text/css" href="{{ asset('frontend/slick/slick.css') }}"/>
            <script type="text/javascript" src="{{ asset('frontend/slick/slick.js') }}"></script>
            <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
            <script src="{{ asset('frontend/js/MSelectDBox.js') }}"></script>
            <!-- datepicker -->
            <script src="{{ asset('/admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
            <!-- tabModule css-->
            <link rel="stylesheet" href="{{ asset('frontend/css/tabModule.css') }}" type="text/css">
            <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}" type="text/css">
            <script src="{{ asset('frontend/js/tabModule.js') }}"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    tabModule.init();
                });
            </script>
            <!-- end tabModule css-->
</head>
<body>
    <div class="container user_profile_form">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h2>{{ $page_title }}</h2>
                </div>
                <div class="clearfix"></div>
                <h3>1. Product – Who are You</h3>
                <div class="col-md-12">
                    <p><b>{{ isset($user->name) ? $user->name : 'n.a.'}} {{ isset($user->surname) ? $user->surname : 'n.a.'}}</b></p>
                    <p>Mail: {{ isset($user->email) ? $user->email : 'n.a.'}}</p>
                    <p style="font-size: x-small;">
                        <!--a class="btn btn-primary"-->
                            <span class="glyphicon glyphicon-upload"></span> CV uploaded: <em>"{{ isset($dream_check_lab['cv_file']) ? $dream_check_lab['cv_file'] : 'n.a.' }}"</em>
                        <!--/a-->
                    </p>
                    <p>______________</p>
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
                    <input type="hidden" name="state_id" value="1">
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
                </div><input type="hidden" name="state_id" value="1">
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
    </div>
        </div>
</body>
</html>

