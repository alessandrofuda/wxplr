@extends('front.new_layout')

@section('content')
	<div class="fancy_heading fancy_heading_icon">
		<h2 style="color:#54b141; background: url(/frontend/immagini/linea-titolo-verde.png) no-repeat bottom center; padding-bottom: 25px;">LOGIN</h2>
	</div>
	<div class="user_login_form">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-none">

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
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				  </div>
				  <div class="form-group has-feedback">
						<label for="password">Password : </label>
					<input type="password" name="password" required id="password" class="form-control" placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				  </div>
				  <div class="row">
					<div class="col-xs-8">
					  <div class="checkbox icheck">
						<label>
						  <input type="checkbox" name="remember"> Remember Me
						</label>
					  </div>
					</div>
					<!-- /.col -->
					<div class="col-md-4 col-xs-12">
					  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
					<!-- /.col -->
				  </div>
			</form>
			<div class="other-links">
				<a class="forgot-link" href="{{ URL::to('/password/email') }}">I forgot my password</a>

				<div class="register-block">
					Not registered? <a class="btn btn-success register-link" href="{{ URL::to('register?type=basic') }}">Register a new membership</a>
				</div>
			</div>
		</div>
	</div>
@endsection
