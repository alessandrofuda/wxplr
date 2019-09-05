{{-- @extends('layouts.new_layout') --}}
@extends('layouts.login_layout')

<!-- Main Content -->
@section('content')
<div id="login" class="container-fluid user_login_form">
    <div class="row" style="height: 100%; margin:0;">
        <div id ="reset-password" class="col-md-6 login-sx">
            <img class="login-sx-img" src="{{asset('frontend/images/login/login-sx.png')}}" title="">
            <div class="sx-title">Reset password</div>
        </div>
        <div class="col-md-6 login-dx">
            <div class="login-container">
                <div class="login-logo">
                    <img src="{{asset('frontend/images/login/login_logo.png')}}">
                </div>

                <div id="reset-psw-page" class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default" style="opacity:1;max-height:none;padding:0;">
                                <div class="panel-heading">Reset Password</div>
                                <div class="panel-body">
                                    
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">Inserisci il tuo indirizzo E-mail</label>

                                            <div class="col-md-7">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn cta btn-primary">
                                                    Inviami Link per Resettare la Password
                                                </button>
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


        

    </div>
</div>


@endsection



