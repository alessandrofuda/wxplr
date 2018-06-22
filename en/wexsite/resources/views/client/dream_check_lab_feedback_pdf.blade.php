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
<div class="dream_check_lab">
   <div class="text-center">
        <h2>{{ $page_title }}</h2>
    </div>
    <h4>1. Product – Who are You</h4>
    <div class="col-md-12">
        <p><b>{{ isset($client->name) ? $client->name : 'n.a.' }}  {{ isset($client->surname) ? $client->surname : 'n.a.' }}</b></p>
        <p>Email: {{ isset($client->email) ? $client->email : 'n.a.' }}</p>
        <p>
            <a href="{{ url($dream_check_lab_feedback['cv_file']) }}" class="btn btn-primary">Download CV</a>
        </p>
        <p> </p>
    </div>
    <div class="clearfix"></div>
    <h4>2. Price – What you did</h4>
    <div class="clearfix"></div>
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
    <h4>3. Place – What you can do</h4>
    <div class="col-md-12">
        <p>{{ $dream_check_lab_feedback['place'] }}</p>
    </div>
    <h4>4. Promotion – Your USP</h4>
    <div class="col-md-12">
        <p>{{ $dream_check_lab_feedback['promotion_usp'] }}</p>
    </div>

</div>
</div>
        </div>
    </div>
</body>
</html>