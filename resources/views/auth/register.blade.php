@extends('layouts.login_layout')


@section('content')


    <div id="registr" class="container-fluid user_register_form">
        <div class="row" style="height: 100%; margin:0;">
            <div class="col-md-6 registr-sx">
                <img class="registr-sx-img" src="{{asset('frontend/images/login/login-sx.png')}}" title="">
                <div class="sx-title">Registrazione</div>
            </div>
            <div class="col-md-6 registr-dx">
                <div class="registr-container">
                    <div class="registr-logo">
                        <img src="{{asset('frontend/images/login/login_logo.png')}}">
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('register') }}">
                        {!! csrf_field() !!}
                        <div class="form-group has-feedback">
                            <label for="email">Nome: </label>
                            <input type="text" class="form-control" required placeholder="Nome" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Cognome: </label>
                            <input type="text" class="form-control" required placeholder="Cognome" name="surname" value="{{ old('surname') }}">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Email: </label>
                            <input type="email" class="form-control" required placeholder="Email" name="email" value="{{ old('email') }}">
                        </div>
                        @if(app('request')->input('type') == 'professional' || app('request')->input('type') == 'skill')
                            <input type="hidden" name="type" value="{{ app('request')->input('type') }}">
                        @else
                            <input type="hidden" name="type" value="basic">
                        @endif
                        <div class="form-group has-feedback">
                            <label for="password">Password: </label>
                            <input type="password" name="password" required class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="password_confirmation">Confirm Password : </label>
                            <input type="password" class="form-control" required placeholder="Conferma Password" name="password_confirmation">
                        </div>
                        <div class="row">
                            <div class="col-md-11 other-links">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="tos" required> Accetto i termini del servizio
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="register-btn-container">
                            <button type="submit" class="btn btn-primary btn-block btn-flat registr-btn">Registrati</button>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-8 login-block">
                            Già registrato? <a class="register-link" href="{{ URL::to('/auth/login') }}">Accedi</a>
                        </div>
                    </div>
                    <div class="corner-bottom-img">
                        <img src="{{asset('frontend/images/registration/registr_corner_img.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
