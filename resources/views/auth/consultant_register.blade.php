@extends('front.new_layout')
@section('content')
</header>
</div>
<div class="">
	<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
	<div class="user_login_form container">
		<div class="text-center"><h3><b>Consultant Registration</b></h3></div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-none">

			@if($errors->any())
				<div class="row">
					<ul class="alert-box warning radius">
						@foreach($errors->all() as $error)
							<li> {{ $error }} </li>
						@endforeach
					</ul>
				</div>
			@endif

    <form method="POST" action="{{ url('consultant/register') }}" enctype= "multipart/form-data">
		{!! csrf_field() !!}
		<div class="form-group has-feedback">
			<label for="name">Name : </label>
			<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ old('name') }}">
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			<label for="surname">Surname : </label>
			<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ old('surname') }}">
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback email">
			<label for="email">Email : </label>
			<input type="email" class="form-control" required email placeholder="Email" name="email" value="{{ old('email') }}">
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			<label for="password">Password : </label>
			<input type="password" class="form-control" required placeholder="Password" name="password">
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			<label for="password_confirmation">Confirm Password : </label>
			<input type="password" class="form-control" required placeholder="Confirm password" name="password_confirmation">
			<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback profile_picture">
			<label for="profile_picture">Profile Picture : </label>
			<input type="file" class="form-control" name="profile_picture">
		</div>
		<div class="form-group has-feedback">
			<label for="date_of_birth">Date of birth : </label>
			<div class="input-group date">
				<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</div>
				<input type="text" class="form-control pull-right" name="date_of_birth" value="{{ old('date_of_birth') }}" id="datepicker">
            </div>
		</div>
		<div class="form-group has-feedback">
			<label for="qualification">Qualification : </label>
			<input type="text" class="form-control" required placeholder="Qualification" name="qualification" value="{{ old('qualification') }}">
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
		<label for="industry">Industry of Expertise: </label>
				<div class="date">
				<select required name="industry_expertise" class="form-control">
					<option value="">-- Choose Industry --</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Agriculture') selected @elseif(old('industry_expertise') == "Agriculture") selected @endif value="Agriculture">Agriculture</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Manufacturing') selected @elseif(old('industry_expertise') == "Manufacturing") selected @endif value="Manufacturing">Manufacturing</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Electricity') selected @elseif(old('industry_expertise') == "Electricity") selected @endif value="Electricity">Electricity</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Wholesale') selected @elseif(old('industry_expertise') == "Wholesale") selected @endif value="Wholesale">Wholesale</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Transport') selected @elseif(old('industry_expertise') == "Transport") selected @endif value="Transport">Transport</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'ICT') selected @elseif(old('industry_expertise') == "ICT") selected @endif value="ICT">ICT</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Financial Services') selected @elseif(old('industry_expertise') == "Financial Services") selected @endif value="Financial Services">Financial Services</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Professional Services') selected @elseif(old('industry_expertise') == "Professional Services") selected @endif value="Professional Services">Professional Services</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Administrative Services') selected @elseif(old('industry_expertise') == "Administrative Services") selected @endif value="Administrative Services">Administrative Services</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Public Administration') selected @elseif(old('industry_expertise') == "Public Administration") selected @endif value="Public Administration">Public Administration</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Education') selected @elseif(old('industry_expertise') == "Education") selected @endif value="Education">Education</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Health') selected @elseif(old('industry_expertise') == "Health") selected @endif value="Health">Health</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Arts') selected @elseif(old('industry_expertise') == "Other Services") selected @endif value="Arts">Arts</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Other Services') selected @elseif(old('industry_expertise') == "Other Services") selected @endif value="Other Services">Other Services</option>
				</select>
			</div>
		</div>
		<div class="form-group has-feedback">
			<label for="experience">Experience(in years): </label>
			<input type="text" class="form-control" required placeholder="Experience" name="experience" value="{{ isset($user->consultantProfile->experience) ? $user->consultantProfile->experience : old('experience') }}">
		</div>
		<div class="form-group has-feedback">
			<label for="country_origin">Country of Expertise : </label>
			<select id="country_origin" required name="country_expertise" class="form-control">
			<option value="">-- Country of origin --</option>
			@if(count($countries_code)>0)
			@foreach ($countries_code as $country)
				<option @if(isset($user->userProfile->country_expertise) && $user->userProfile->country_expertise == $country['country_name']) selected @elseif(old('country_expertise') == $country['country_name'] ) selected @endif
				value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>
			@endforeach
			@endif
			</select>
		</div>
		<div class="form-group has-feedback">
			<label for="area_expertise">Area of Expertise : </label>
			<select style="height:100px;" id="area_expertise" required name="area_expertise[]" class="form-control" multiple="true">
				@foreach ($areas as $k=>$area)
					<option @if(isset($user->userProfile->area_expertise)
					&& in_array($k, $user->userProfile->getAreaExpertise())) selected @endif
					@if(is_array( old('area_expertise')) &&  in_array($k, old('area_expertise')))  selected @endif
					value="{{ $k }}">{{ $area }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group has-feedback full-cls">
			<label for="languages">Short Bio: </label>
			<div class="date">
				<textarea class="form-control"  value="{{ isset($consultant->consultantProfile->bio)  ? $consultant->consultantProfile->bio : ''}}" name="bio" required id="bio">{{ isset($consultant->consultantProfile->bio)  ? $consultant->consultantProfile->bio : old('bio')}}</textarea>
			</div>
		</div>
		<!-- <div class="form-group has-feedback full-cls">
			<label for="oigp_company">Company : </label>
			<input type="text" class="form-control" placeholder="Company" name="company" value="{{ old('company') }}">
		</div> -->
		<div class="form-group has-feedback full-cls">
			<label for="languages">Languages : </label>
			<input type="text" class="form-control" placeholder="Languages" name="languages" value="{{ old('languages') }}">
		</div>
		<!-- <div class="form-group has-feedback full-cls">
			<label for="vat_number">Personal Identification Number : </label>
			<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pin_number" value="{{ old('pin_number') }}">
		</div> -->
		<?php /*<div class="form-group has-feedback full-cls">
			<label for="vat_number">VAT Number : </label>
			<input type="text" class="form-control" required placeholder="VAT Number" name="vat_number" value="{{ old('vat_number') }}">
		</div>
		<div class="form-group has-feedback full-cls">
			<label for="address">Address : </label>
			<textarea class="form-control" required placeholder="Address" name="address">{{ old('address') }}</textarea>
		</div>
		<div class="form-group has-feedback full-cls">
			<label for="vat_number">City : </label>
			<input type="text" class="form-control" required placeholder="City" name="city" value="{{ old('city') }}">
		</div>
		<div class="form-group has-feedback full-cls">
			<label for="bank_details">Bank details : </label>
			<textarea class="form-control" required placeholder="Bank details" name="bank_details">{{ old('bank_details') }}</textarea>
		</div>
		<div class="form-group has-feedback full-cls">
			<label for="oigp_company">OIGP Company : </label>
			<input type="text" class="form-control" required placeholder="OIGP Company" name="oigp_company" value="{{ old('oigp_company') }}">
		</div>
		<div class="form-group has-feedback full-cls">
			<label for="bank_iban">Bank IBAN : </label>
			<input type="text" class="form-control" required placeholder="Bank IBAN" name="bank_iban" value="{{ old('bank_iban') }}">
		</div>*/?>


		<div class="form-group">
			<label>Privacy Policy*</label>
			<div>
				<input type="radio" name="policy" required>
				<span>I authorize the treatment of my personal data pursuant to the Italian Legislative Decree on privacy 196/2003. <a href="/en/privacy_policy">Read the privacy policy</a></span>
			</div>
		</div>

		<!-- <div class="checkbox check-label">
			<input type="checkbox" required name="terms_and_privacy">
			<label for="terms_and_policy">I have read and accepted the General <a href="#">Terms and Conditions</a> and have read the <a href="#">Privacy Policy</a></label>
		</div>
		<div class="checkbox check-label">
			<input type="checkbox" required name="read_and_accepted">
			<label for="read_and_accepted">I have read and accepted the terms pursuant to art. 1341 and 1342 of the Civil Code</label>
			<p style="padding-left: 26px;">Privacy policy</p>
		</div>
		<div class="checkbox check-label">
			<input type="checkbox" value="1" name="allow_personal_data">
			<label for="read_and_accepted">I give my consent to the processing of my personal data for marketing purposes and trade in such Regulations (optional)</label>
		</div> -->
		<div class="row form-group has-feedback submit-btn">
        <!-- /.col -->
        <div class="Register_now">
			<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
		<div class="clearfix"></div>
    </form>
	{{--<div class="form-group has-feedback membership">
    <a style="padding-left: 0px;" href="{{ URL::to('login') }}" class="text-center">I already have a membership</a>
			</div>--}}
  </div>{{--
		<div class="col-md-5 pull-right">
			<div class="register_welcome_text">
				<h3>Welcome !</h3>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
			</div>
		</div>--}}
</div>
</div>

</div>



<style>
	.container.client_register {
		width: 100%;
		padding: 0;
		background: url('http://bartonwyatt.co.uk/wp-content/uploads/2014/07/register-with-barton-wyatt.jpg');
		background-size: 100% 100%;
		padding: 0px 0;
	}
	.container.client_register .wrapper {
		padding: 0;
	}
	.overlay {
		background: rgba(255,255,255, 0.6);
		padding: 80px 0px;
	}
	.container.client_register .Register {
		width: 100%;
		max-width: 1170px;
		margin: 0px auto;
		border-radius: 3px;
	}
	.container.client_register .Register .row {
		margin: 0;
	}
	.container.client_register .Register h3 {
		margin: 0 0 20px;
		padding: 20px 0px 15px;
		text-transform: uppercase;
		letter-spacing: 1px;
		border-bottom: solid 2px rgba(204, 204, 204, 0.59);
	}
	.container.client_register .Register .row form .form-group,
	.container.consultant_register .Register .row form .form-group {
		width: 50%;
		display: inline-block;
		float: left;
		padding: 0px 5px;
	}
	.container.client_register .row.form-group.has-feedback.submit-btn {
		padding: 0;
	}
	.container.client_register .Register .row form .form-group.email,
	.container.consultant_register .Register .row form .form-group.email{
		width: 100%;
	}
	.container.client_register .Register .row form .form-group:nth-child(odd),
	.container.consultant_register .Register .row form .form-group:nth-child(odd) {
		/* margin-left: 17px;*/
	}
	.container.client_register .Register .row form .form-group input, .container.consultant_register .Register .row form .form-group input {
		border-radius: 0;
		height: 40px;
		width: 100%;
	}
	.container.client_register .Register .row form .form-group span ,
	.container.consultant_register .Register .row form .form-group span{
		height: 40px;
		line-height: 40px;
	}
	.container.client_register .Register .row form .checkbox input[type="checkbox"],
	.container.consultant_register .Register .row form .checkbox input[type="checkbox"]{
		margin: 0;
		left: 0;
		top: 2px;
	}
	.Register_now button {
		background-color: #2087c8;
		border: none;
		font-size: 16px;
		height: 40px;
		margin: 20px auto 20px;
		width: 100%;
		-webkit-transition: all .5s;
		-moz-transition: all .5s;
		-o-transition: all .5s;
		border-radius: 0;
	}
	.container.client_register .Register .row form .form-group.submit-btn,
	.container.consultant_register .Register .row form .form-group.submit-btn{
		width: 100%;
		margin: 0;
		text-align: center;
	}
</style>
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
	 //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
	    dateFormat: "Y-m-d",
		endDate: new Date()
    });
</script>
@endsection
