@extends('front.login_layout')

@section('content')
	
	<div id="login" class="container-fluid user_login_form">
		<div class="row" style="height: 100%; margin:0;">
			<div class="col-md-6 login-sx">
				<img class="login-sx-img" src="{{asset('frontend/images/login/login-sx.png')}}" title="">
				<div class="sx-title">Login</div>
			</div>
			<div class="col-md-6 login-dx">
				<div class="login-container">
					<div class="login-logo">
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

					<form method="POST" action="{{ url('/auth/login') }}">
						{!! csrf_field() !!}
						<div class="form-group has-feedback">
							<label for="email">Email : </label>
							<input type="email" class="form-control" required placeholder="Email" name="email" value="{{ old('email') }}">
						</div>
						<div class="form-group has-feedback">
							<label for="password">Password : </label>
							<input type="password" name="password" required id="password" class="form-control" placeholder="Password">
						</div>
						<div class="row">
							<div class="col-md-6 other-links">
								<div class="checkbox icheck">
									<label>
										<input type="checkbox" name="remember"> Ricordami
									</label>
								</div>
							</div>
							<div class="col-md-6 other-links">
								<a class="forgot-link" href="{{ URL::to('/password/email') }}">Password dimenticata?</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 register-block">
								Prima volta nella nostra area riservata? <a class="register-link" href="{{ URL::to('register?type=basic') }}">Registrati</a>
							</div>
						</div>
						<button type="submit" class="btn btn-primary btn-block btn-flat login-btn">Accedi</button>
					</form>
					<div class="corner-bottom-img">
						<img src="{{asset('frontend/images/login/login-corner-img.png')}}">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
