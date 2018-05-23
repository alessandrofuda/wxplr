@extends('front.dashboard_layout')
@section('content')
<div class="container user_profile_form">
	<div class="row">
		<div class="heading">
			<h1>{{ $page_title }}</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="">
					<div class="panel-body">
						<p>Thank you for choosing Wexplore’s Professional Kit. In order to customize your journey to your future dream job, kindly fill in the profile form below:</p>
						<form accept-charset="UTF-8" method="post" action=" {{ url('user/profile/update') }}" class="checkout-form"  enctype="multipart/form-data">
							{{ csrf_field() }}
							@if(Route::current()->getName() == 'professional.kit')
								{{--*/ $redirect_url = 'user/market_analysis' /*--}}
								{{--*/ $submit_label = 'Save & Proceed to Market Analysis' /*--}}
							@else
								{{--*/ $redirect_url = 'user/profile' /*--}}
								{{--*/ $submit_label = 'Save Profile' /*--}}
							@endif

							<input type="hidden" name="redirect_url" value="{{ $redirect_url }}">
							<input type="hidden" name="user_id" value="{{ $user->id }}">
							<div class="form-group col-md-6 has-feedback">
								<label for="name">Name : </label>
								<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ $user->name }}">
								<span class="glyphicon glyphicon-user form-control-feedback"></span>
							</div>
							<div class="form-group col-md-6 has-feedback">
								<label for="surname">Surname : </label>
								<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ $user->surname }}">
								<span class="glyphicon glyphicon-user form-control-feedback"></span>
							</div>
							<div class="form-group col-md-6 has-feedback profile_picture">
								<div class="col-lg-2">
									@if(isset($user->userProfile->profile_picture))
										<img alt="{{ $user->name }}" src="{{ asset($user->userProfile->profile_picture) }}">
									@endif
								</div>
								<div class="col-lg-10">
									<label for="profile_picture">Profile Picture : </label>
									<input type="file" class="form-control" name="profile_picture">
								</div>
							</div>
							<div class="form-group col-md-6 has-feedback">
								<label for="email">Email : </label>
								<input type="email" class="form-control" disabled required email placeholder="Email" name="email" value="{{ $user->email }}">
								<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
							</div>
							<div class="form-group col-md-6">
								<label>Password</label>
								<input type="password" name="password" class="form-control" placeholder="Enter password..." value="">
							</div>
							<div class="form-group col-md-6">
								<label>Confirm Password</label>
								<input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation">
							</div>
							<div class="form-group col-md-6 Gender">
								<label>Gender</label>
								<span><input type="radio" required name="gender" @if(isset($user->userProfile->gender) && $user->userProfile->gender == 'Male') checked @endif class="" value="Male">Male</span>
								<span><input type="radio" required name="gender" @if(isset($user->userProfile->gender) && $user->userProfile->gender == 'Female') checked @endif class="" value="Female">Female</span>
							</div>

							<div class="form-group col-md-6 has-feedback">
								<label for="age_range">Age : </label>
								<div class="date">
									<select required name="age_range" id="age_range" class="form-control">
										<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '20-24') selected @endif value="20-24">20-24</option>
										<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '25-29') selected @endif value="25-29">25-29</option>
										<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '30-34') selected @endif value="30-34">30-34</option>
										<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '35-39') selected @endif value="35-39">35-39</option>
										<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '40-44') selected @endif value="40-44">40-44</option>
										<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '45-49') selected @endif value="45-49">45-49</option>
										<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == '50-54') selected @endif value="50-54">50-54</option>
										<option @if(isset($user->userProfile->age_range) && $user->userProfile->age_range == 'over 55') selected @endif value="over 55">over 55</option>
									</select>
								</div>
							</div>

							<div class="form-group col-md-6 has-feedback">
								<label for="country_origin">Country of Origin : </label>
								<select id="country_origin" required name="country_origin" class="form-control">
									<option value="">-- Country of origin --</option>
									@if(count($countries_code)>0)
										@foreach ($countries_code as $country)
											<option @if(isset($user->userProfile->country_origin) && $user->userProfile->country_origin == $country['country_name']) selected @endif value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="form-group col-md-6 has-feedback">
								<label for="country_interest">Country of Interest : </label>
								<select id="country_origin" required name="country_interest" class="form-control">
									<option value="">-- Country of interest --</option>
									@if(count($countries_code)>0)
										@foreach ($countries_code as $country)
											<option @if(isset($user->userProfile->country_interest) && $user->userProfile->country_interest == $country['country_name']) selected @endif value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="form-group col-md-6 has-feedback">
								<label for="education">Education : </label>
								<div class="date">
									<select name="education" class="form-control">
										<option value="">-- Choose Education --</option>
										<option @if(isset($user->userProfile->education) && $user->userProfile->education == 'High School Diploma') selected @endif value="High School Diploma">High School Diploma</option>
										<option @if(isset($user->userProfile->education) && $user->userProfile->education == 'Bachelor’s degree') selected @endif value="Bachelor’s degree">Bachelor’s degree</option>
										<option @if(isset($user->userProfile->education) && $user->userProfile->education == 'Master’s degree') selected @endif value="Master’s degree">Master’s degree</option>
										<option @if(isset($user->userProfile->education) && $user->userProfile->education == 'Post-university education') selected @endif value="Post-university education">Post-university education</option>
									</select>
								</div>
							</div>
							<div class="form-group col-md-6 has-feedback">
								<div class="industry-help-wrap">
									<div id="agriculture" class="profile-help-desc" style="display:none;">
										Includes agriculture, foresting, fishing, mining and quarrying
									</div>
									<div id="manufacturing" class="profile-help-desc" style="display:none;">
										Any industry involving the physical or chemical transformation of materials, substances or components into new products, either finished or semi-finished
									</div>
									<div id="electricity" class="profile-help-desc" style="display:none;">Any industry involving the distribution of electricity, gas, and steam, but also waste management and construction
									</div>
									<div id="wholesale" class="profile-help-desc" style="display:none;">
										Includes any wholesale or retail distribution activity, including packaging and storing, but also accommodation and food activities, and household assistance
									</div>
									<div id="transport" class="profile-help-desc" style="display:none;">
										Passenger or freight transport, including postal and courier activities
									</div>
									<div id="ICT" class="profile-help-desc" style="display:none;">
										Any industry related to production, distribution, and processing of data and/or information
									</div>
									<div id="financial_services" class="profile-help-desc" style="display:none;">
										Financial, insurance or real estate activities
									</div>
									<div id="professional_services" class="profile-help-desc" style="display:none;">
										Activities requiring a high degree of training, which involves making know-how available to others. For example management consulting activities
									</div>
									<div id="administrative_services" class="profile-help-desc" style="display:none;">
										Basic support activities to business operations, from payroll to tax accounting
									</div>
									<div id="public_administration" class="profile-help-desc" style="display:none;">
										Includes governmental activities and those for international NGOs
									</div>
									<div id="education" class="profile-help-desc" style="display:none;">
										Includes education at any level and for any profession, whether public or private
									</div>
									<div id="health" class="profile-help-desc" style="display:none;">
										Healthcare activities delivered at sanitary or residential institutions
									</div>
									<div id="arts" class="profile-help-desc" style="display:none;">
										Includes entertainment, recreation, gambling, and sports
									</div>
									<div id="other_services" class="profile-help-desc" style="display:none;">
										Anything not fitting the descriptions above
									</div>
								</div>
								<label for="industry">Industry : </label>
								<div class="date">
									<select required name="industry" class="form-control">
										<option value="">-- Choose Industry --</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Agriculture') selected @endif value="Agriculture">Agriculture</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Manufacturing') selected @endif value="Manufacturing">Manufacturing</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Electricity') selected @endif value="Electricity">Electricity</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Wholesale') selected @endif value="Wholesale">Wholesale</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Transport') selected @endif value="Transport">Transport</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'ICT') selected @endif value="ICT">ICT</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Financial Services') selected @endif value="Financial Services">Financial Services</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Professional Services') selected @endif value="Professional Services">Professional Services</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Administrative Services') selected @endif value="Administrative Services">Administrative Services</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Public Administration') selected @endif value="Public Administration">Public Administration</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Education') selected @endif value="Education">Education</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Health') selected @endif value="Health">Health</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Arts') selected @endif value="Arts">Arts</option>
										<option @if(isset($user->userProfile->industry) && $user->userProfile->industry == 'Other Services') selected @endif value="Other Services">Other Services</option>
									</select>
									<a class="tooltips" href="#">
										<div class="glyphicon glyphicon-question-sign"></div>
										<span>Industry help text will be added soon</span>
									</a>
								</div>
							</div>
							<div class="form-group col-md-6 has-feedback">
								<div class="occupation-help-wrap">
									<div id="managers" class="profile-help-desc" style="display:none;">
										You are a Manager if you: plan, direct, coordinate and evaluate the overall activities of your organization and/or organizational units, and formulate and review their policies, laws, rules and regulations
									</div>
									<div id="professionals" class="profile-help-desc" style="display:none;">
										You are a Professional if your work involves: increasing the existing stock of knowledge within your organization and/or applying scientific or artistic concepts, theories, frameworks and methodologies in your work
									</div>
									<div id="technicians" class="profile-help-desc" style="display:none;">You are a Technician if you:  perform mostly technical and related tasks connected with research and the application of operational methods.
									</div>
									<div id="clerical" class="profile-help-desc" style="display:none;">
										You are a Clerical support worker if you: record, organise, store, compute and retrieve information for duties in connection with money-handling operations, travel arrangements, requests for information, and appointments.
									</div>
									<div id="service_and_sale" class="profile-help-desc" style="display:none;">
										You are a Service and sales worker if you: provide personal and protective services related to travel, housekeeping, catering, personal care, or demonstrate and sell goods in wholesale or retail shops and similar establishments.
									</div>
									<div id="crafts_related_trade" class="profile-help-desc" style="display:none;">
										You are a Craft and related trades worker if you: apply specific knowledge and skills in the fields to construct and maintain buildings, machinery, equipment or tools; produce or process foodstuffs, textiles, or wooden, metal and other articles, including handicraft goods with the support of tools to reduce the amount of physical effort and time required for specific tasks, as well as to improve the quality of the products.
									</div>
									<div id="plant_machine_operators" class="profile-help-desc" style="display:none;">
										You are a Plant and machine operator if you: operate and monitor industrial and agricultural machinery and equipment on the spot or by remote control, drive and operate trains, motor vehicles and mobile machinery and equipment, or assemble products from component parts according to strict specifications and procedures.
									</div>
								</div>
								<label for="occupational">Occupation : </label>
								<div class="date">
									<select class="form-control" name="occupation" required id="Occupation">
										<option value="">-- Select Occupation --</option>
										<option @if(isset($user->userProfile->occupation) && $user->userProfile->occupation == 'Managers') selected @endif value="Managers">Managers</option>
										<option @if(isset($user->userProfile->occupation) && $user->userProfile->occupation == 'Professionals') selected @endif value="Professionals">Professionals</option>
										<option @if(isset($user->userProfile->occupation) && $user->userProfile->occupation == 'Technicians') selected @endif value="Technicians">Technicians</option>
										<option @if(isset($user->userProfile->occupation) && $user->userProfile->occupation == 'Clerical') selected @endif value="Clerical">Clerical</option>
										<option @if(isset($user->userProfile->occupation) && $user->userProfile->occupation == 'Service and Sales') selected @endif value="Service and Sales">Service and Sales</option>
										<option @if(isset($user->userProfile->occupation) && $user->userProfile->occupation == 'Crafts and Related Trade') selected @endif value="Crafts and Related Trade">Crafts and Related Trade</option>
										<option @if(isset($user->userProfile->occupation) && $user->userProfile->occupation == 'Plant and Machine operators') selected @endif value="Plant and Machine operators">Plant and Machine operators</option>
									</select>
									<a class="tooltips" href="#">
										<div class="glyphicon glyphicon-question-sign"></div>
										<span>Occupation help text will be added soon</span>
									</a>
								</div>
							</div>
							<div class="form-group col-md-6 has-feedback">
								<label for="occupational_status">Current Occupational status : </label>
								<div class="date">
									<select name="occupational_status" required id="occupational_status" class="form-control">
										<option value="">-- Select Occupational status --</option>
										<option @if(isset($user->userProfile->occupational_status) && $user->userProfile->occupational_status == 'Student') selected @endif value="Student">Student</option>
										<option @if(isset($user->userProfile->occupational_status) && $user->userProfile->occupational_status == 'Employed') selected @endif value="Employed">Employed</option>
										<option @if(isset($user->userProfile->occupational_status) && $user->userProfile->occupational_status == 'Unemployed') selected @endif value="Unemployed">Unemployed</option>
									</select>
								</div>
							</div>
							<div class="form-group col-md-6 has-feedback">
								<label for="salary_range">Salary Range : </label>
								<div class="date">
									<select name="salary_range" required id="salary_range" class="form-control">
										<option value="">-- Select Salary Range --</option>
										<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == 'Up to 25,000') selected @endif value="Up to 25,000">Up to 25,000</option>
										<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == '25,001 - 40,000') selected @endif value="25,001 - 40,000">25,001 - 40,000</option>
										<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == '40,001 - 55,000') selected @endif value="40,001 - 55,000">40,001 - 55,000</option>
										<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == '55,001 - 70,000') selected @endif value="55,001 - 70,000">55,001 - 70,000</option>
										<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == 'More than 70,000') selected @endif value="More than 70,000">More than 70,000</option>
									</select>
								</div>
							</div>
							{{--<div class="form-group col-md-6 checkbox check-label">
								<input type="checkbox" name="allow_personal_data" value="1" @if(isset($user->userProfile->allow_personal_data) && $user->userProfile->allow_personal_data==1) checked @endif>
								<label for="read_and_accepted">I give my consent to the processing of my personal data for marketing purposes and trade in such Regulations (optional)</label>
							</div>--}}
							<div class="form-group col-md-6 has-feedback">
								<div class="date">
									<input type="submit" class="Save_profile" value="{{ $submit_label }}" name="save_profile">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
@endsection