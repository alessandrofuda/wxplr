@extends('front.layout')
@section('content')
{{--*/ $user=Auth::user() /*--}}
<div class="container">
	<div class="row">
		<div class="heading">
			<h1>{{ $page_title }}</h1>
		</div>
	</div>
	<div class="row">
	<div class="col-md-12">
		@if (session('status'))
			<div class="alert alert-success">
			  {{ session('status') }}
			</div>
		@endif
		@if (session('error'))
		  <div class="alert alert-failure">
			  {{ session('error') }}
		  </div>
		@endif
		 @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
	</div>
		<div class="col-md-6 col-md-offset-3">
            <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Complete Profile</h3>
                    </div>
                    <div class="panel-body">
            <form accept-charset="UTF-8" method="post" action="{{ URL::to('/service/profile/save') }}" class="checkout-form">
                {{ csrf_field() }}
				<input type="hidden" name="user_id" value="{{ $user->id }}">
				<div class="form-group has-feedback">
					<label for="name">Name : </label>
					<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ $user->name }}">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				  </div>
						<div class="form-group has-feedback">
						<label for="surname">Surname : </label>
					<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ $user->surname }}">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				  </div>
				  <div class="form-group has-feedback">
						<label for="email">Email : </label>
					<input type="email" class="form-control" required email placeholder="Email" name="email" value="{{ $user->email }}">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				  </div>
					<div class="form-group">
                    <label>Gender</label>
                    <input type="radio" name="gender" @if(isset($user->userProfile->gender)) checked @endif class="" value="Male">Male
					<input type="radio" name="gender"@if(isset($user->userProfile->gender)) checked @endif class="" value="Female">Female
                </div>
                <div class="form-group has-feedback">
				<label for="age_range">Age : </label>
				<div class="input-group date">
					<select required name="age_range" id="age_range" class="form-control">
						<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '20-24') selected @endif value="20-24">20-24</option>
						<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '25-29') selected @endif value="25-29">25-29</option>
						<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '30-34') selected @endif value="30-34">30-34</option>
						<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '35-39') selected @endif value="35-39">35-39</option>
						<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '40-44') selected @endif value="40-44">40-44</option>
						<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '45-49') selected @endif value="45-49">45-49</option>
						<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '50-54') selected @endif value="50-54">50-54</option>
						<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == 'over 55') selected @endif value="over-55">over 55</option>
					</select>
				</div>
			 </div>
				
			<div class="form-group has-feedback">
				<label for="country_origin">Country of Origin : </label>
				<select id="country_origin" required name="country_origin" class="form-control">
				<option value="">-- Country of origin --</option>
				@if(count($countries_code)>0)
				@foreach ($countries_code as $country)
					<option @if(isset($user->userProfile->country_origin) && $user->userProfile->country_origin == $country['country_code']) selected @endif value="{{ $country['country_code'] }}">{{ $country['country_name'] }}</option>
				@endforeach
				@endif
				</select>    
			</div>
			<div class="form-group has-feedback">
				<label for="country_interest">Country of Interest : </label>
				<select id="country_origin" required name="country_interest" class="form-control">
					<option value="">-- Country of interest --</option>
				@if(count($countries_code)>0)
				@foreach ($countries_code as $country)
					<option @if(isset($user->userProfile->country_interest) && $user->userProfile->country_interest == $country['country_code']) selected @endif value="{{ $country['country_code'] }}">{{ $country['country_name'] }}</option>
				@endforeach
				@endif
				</select>    
			</div>
			<div class="form-group has-feedback">
				<label for="education">Education : </label>
				<div class="input-group date">
				<select name="education" class="form-control">
					<option value="">-- Choose Education --</option>
					<option @if(isset($user->userProfile->education) && $user->userProfile->education == 'high_school_diploma') selected @endif value="high_school_diploma">High School Diploma</option>
					<option @if(isset($user->userProfile->education) && $user->userProfile->education == 'bachelor_degree') selected @endif value="bachelor_degree">Bachelor’s degree</option>
					<option @if(isset($user->userProfile->education) && $user->userProfile->education == 'master_degree') selected @endif value="master_degree">Master’s degree</option>
					<option @if(isset($user->userProfile->education) && $user->userProfile->education == 'post_university_education') selected @endif value="post_university_education">Post-university education</option>
				</select>
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="industry">Industry : </label>
				<div class="input-group date">	
				<select required name="industry" class="form-control">
					<option value="">-- Choose Industry --</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'agriculture') selected @endif value="agriculture">Agriculture</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'manufacturing') selected @endif value="manufacturing">Manufacturing</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'electricity') selected @endif value="electricity">Electricity</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'wholesale') selected @endif value="wholesale">Wholesale</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'transport') selected @endif value="transport">Transport</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'ict') selected @endif value="ict">ICT</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'financial_services') selected @endif value="financial_services">Financial Services</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'professional_services') selected @endif value="professional_services">Professional Services</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'administrative_services') selected @endif value="administrative_services">Administrative Services</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'public_administration') selected @endif value="public_administration">Public Administration</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'education') selected @endif value="education">Education</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'health') selected @endif value="health">Health</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'arts') selected @endif value="arts">Arts</option>
					<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'other_services') selected @endif value="other_services">Other Services</option>
				</select>
					<a class="tooltips" href="#">
						<div class="glyphicon glyphicon-question-sign"></div>
						<span>Industry help text will be added soon</span>
					</a>
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="occupational">Occupation : </label>
				<div class="input-group date">
					<select name="Occupation" required id="Occupation" class="form-control">
						<option value="">-- Select Occupation --</option>
						<option @if(isset($user->userProfile->occupational) && $user->userProfile->occupational == 'managers') selected @endif value="managers">Managers</option>
						<option @if(isset($user->userProfile->occupational) && $user->userProfile->occupational == 'professionals') selected @endif value="professionals">Professionals</option>
						<option @if(isset($user->userProfile->occupational) && $user->userProfile->occupational == 'technicians') selected @endif value="technicians">Technicians</option>
						<option @if(isset($user->userProfile->occupational) && $user->userProfile->occupational == 'clerical') selected @endif value="clerical">Clerical</option>
						<option @if(isset($user->userProfile->occupational) && $user->userProfile->occupational == 'service_and_sale') selected @endif value="service_and_sale">Service and Sales</option>
						<option @if(isset($user->userProfile->occupational) && $user->userProfile->occupational == 'crafts_related_trade') selected @endif value="crafts_related_trade">Crafts and Related Trade</option>
						<option @if(isset($user->userProfile->occupational) && $user->userProfile->occupational == 'plant_machine_operators') selected @endif value="plant_machine_operators">Plant and Machine operators</option>
					</select>
					<a class="tooltips" href="#">
						<div class="glyphicon glyphicon-question-sign"></div>
						<span>Occupation help text will be added soon</span>
					</a>
				</div>
			</div>				
			<div class="form-group has-feedback">
				<label for="occupational_status">Current Occupational status : </label>
				<div class="input-group date">
					<select name="occupational_status" required id="occupational_status" class="form-control">
						<option value="">-- Select Occupational status --</option>
						<option @if(isset($user->userProfile->occupational_status) && $user->userProfile->occupational_status == 'student') selected @endif value="student">Student</option>
						<option @if(isset($user->userProfile->occupational_status) && $user->userProfile->occupational_status == 'employed') selected @endif value="employed">Employed</option>
						<option @if(isset($user->userProfile->occupational_status) && $user->userProfile->occupational_status == 'unemployed') selected @endif value="unemployed">Unemployed</option>
					</select>
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="salary_range">Salary Range : </label>
				<div class="input-group date">
					<select name="salary_range" required id="salary_range" class="form-control">
						<option value="">-- Select Salary Range --</option>
						<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == 'upto-25000') selected @endif value="upto-25000">Up to 25,000</option>
						<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == '25001-40000') selected @endif value="25001-40000">25,001 - 40,000</option>
						<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == '40001-55000') selected @endif value="40001-55000">40,001 - 55,000</option>
						<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == '55001-70000') selected @endif value="55001-70000">55,001 - 70,000</option>
						<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == 'more-than-70000') selected @endif value="more-than-70000">More than 70,000</option>
					</select>
				</div>
			 </div>
			<div class="form-group has-feedback">
				<div class="input-group date">
					<input type="submit" class="btn btn-primary btn-action-form" value="Save Profile" name="save_profile">
				</div>
			</div>
            </form>
        </div></div></div>
	</div>	
</div>
@endsection