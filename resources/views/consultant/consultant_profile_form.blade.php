@extends('consultant.consultant_dashboard_layout')
@section('content')  
{{--*/ $consultant=Auth::user(); /*--}}
<div class="container user_profile_form">
	<div class="row">
		<div class="heading">
			<h1>{{ $page_title }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
            <div class="">
                    <div class="panel-heading">
                        <h3 class="panel-title">Complete Profile</h3>
                    </div>
                    <div class="panel-body">
            <form accept-charset="UTF-8" method="post" action="{{ URL::to('consultant/profile/update') }}" class="checkout-form"  enctype="multipart/form-data">
                {{ csrf_field() }}
				<input type="hidden" name="user_id" value="{{ $consultant->id }}">
				<div class="form-group col-md-6 has-feedback">
					<label for="name">Name : </label>
					<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ $consultant->name }}">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				  </div>
					<div class="form-group col-md-6 has-feedback">
						<label for="surname">Surname : </label>
                        <input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ $consultant->surname }}">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
				  </div>
                    <div class="form-group col-md-6 has-feedback profile_picture">
                    	<div class="col-lg-2">
                    		@if(isset($consultant->consultantProfile->profile_picture))
	                        <img alt="{{ $consultant->name }}"  src="{{ asset($consultant->consultantProfile->profile_picture) }}">
	                    	@endif
                    	</div>
						<div class="col-lg-10">
							<label for="profile_picture">Profile Picture : </label>
                        	<input type="file" class="form-control" name="profile_picture">
						</div>
				    </div>
				  <div class="form-group col-md-6 has-feedback">
						<label for="email">Email : </label>
					<input type="email" class="form-control" disabled required email placeholder="Email" name="email" value="{{ $consultant->email }}">
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
                    <span><input type="radio" required name="gender" @if(isset($consultant->consultantProfile->gender) && $consultant->consultantProfile->gender == 'Male') checked @endif class="" value="Male">Male</span>
					<span><input type="radio" required name="gender" @if(isset($consultant->consultantProfile->gender) && $consultant->consultantProfile->gender == 'Female') checked @endif class="" value="Female">Female</span>
                </div>
					
                <div class="form-group col-md-6 has-feedback">
				<label for="age_range">Date Of Birth : </label>
				<div class="date">
					<input type="text" id="datepicker" required @if(isset($consultant->consultantProfile->date_of_birth) && $consultant->consultantProfile->date_of_birth != '') value="{{ date('Y-m-d',strtotime($consultant->consultantProfile->date_of_birth)) }}" @endif name="date_of_birth" class="form-control">
				</div>
			 </div>
			<div class="form-group col-md-6 has-feedback">				
				<label for="industry">Industry Of Expertise : </label>
				<div class="date">	
				<select required name="industry_expertise" class="form-control">
					<option value="">-- Choose Industry --</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Agriculture') selected @endif value="Agriculture">Agriculture</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Manufacturing') selected @endif value="Manufacturing">Manufacturing</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Electricity') selected @endif value="Electricity">Electricity</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Wholesale') selected @endif value="Wholesale">Wholesale</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Transport') selected @endif value="Transport">Transport</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'ICT') selected @endif value="ICT">ICT</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Financial Services') selected @endif value="Financial Services">Financial Services</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Professional Services') selected @endif value="Professional Services">Professional Services</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Administrative Services') selected @endif value="Administrative Services">Administrative Services</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Public Administration') selected @endif value="Public Administration">Public Administration</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Education') selected @endif value="Education">Education</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Health') selected @endif value="Health">Health</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Arts') selected @endif value="Arts">Arts</option>
					<option @if(isset($consultant->consultantProfile->industry_expertise) && $consultant->consultantProfile->industry_expertise == 'Other Services') selected @endif value="Other Services">Other Services</option>
				</select>					
				</div>
			</div>
				<div class="form-group has-feedback">
					<label for="experience">Experience(in years): </label>
					<input type="text" class="form-control" required placeholder="Experience" name="experience" value="{{isset($consultant->consultantProfile->experience) ? $consultant->consultantProfile->experience : ""  }}">
				</div>
				<div class="form-group col-md-6 has-feedback">
					<label for="area_expertise">Area of Expertise : </label>
					<select style="height:100px;" id="area_expertise" required name="area_expertise[]"  multiple class="form-control">
						@foreach ($areas as $k => $area)
							<option @if(isset($consultant->consultantProfile->area_expertise)
					&& in_array($k, $consultant->consultantProfile->getAreaExpertise())) selected @endif value="{{ $k }}">{{ $area }}</option>
						@endforeach
					</select>
				</div>
			<div class="form-group col-md-6 has-feedback">
				<label for="country_expertise">Country of Expertise : </label>
				<select id="country_expertise" required name="country_expertise" class="form-control">
					<option value="">-- Country of Expertise --</option>
				@if(count($countries_code)>0)
				@foreach ($countries_code as $country)
					<option @if(isset($consultant->consultantProfile->country_expertise) && $consultant->consultantProfile->country_expertise == $country['country_name']) selected @endif value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>
				@endforeach
				@endif
				</select>    
			</div>
			<div class="form-group col-md-6 has-feedback">
				<label for="qualification">Qualification : </label>
				<div class="date">
				<input name="qualification" required @if(isset($consultant->consultantProfile->qualification) && $consultant->consultantProfile->qualification != '') value="{{ $consultant->consultantProfile->qualification }}" @endif class="form-control">
				</div>
			</div>
			<div class="form-group col-md-6 has-feedback">
				<label for="languages">Short Bio: </label>
				<div class="date">
					<textarea class="form-control" value="{{ isset($consultant->consultantProfile->bio)  ? $consultant->consultantProfile->bio : ''}}" name="bio" required id="bio">{{ isset($consultant->consultantProfile->bio)  ? $consultant->consultantProfile->bio : ''}}</textarea>
				</div>
			</div>
			<div class="form-group col-md-6 has-feedback">				
				<label for="languages">Languages : </label>
				<div class="date">
					<input class="form-control" @if(isset($consultant->consultantProfile->languages) && $consultant->consultantProfile->languages != '') value="{{ $consultant->consultantProfile->languages }}" @endif name="languages" required type="text" id="languages">									
				</div>
			</div>
				<div class="form-group has-feedback full-cls">
					<label for="vat_number">Personal Identification Number : </label>
					<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pin_number" value="{{ isset($consultant->consultantProfile->pin_number) ? $consultant->consultantProfile->pin_number : "" }}">
				</div>
			<?php /*<div class="form-group col-md-6 has-feedback">
				<label for="vat_number">Vat Number : </label>
				<div class="date">
					<input class="form-control" @if(isset($consultant->consultantProfile->vat_number) && $consultant->consultantProfile->vat_number != '') value="{{ $consultant->consultantProfile->vat_number }}" @endif name="vat_number" required type="text" id="vat_number">									
				</div>
			</div>
			<div class="form-group col-md-6 has-feedback">				
				<label for="address">Address : </label>
				<div class="date">
					<textarea class="form-control" name="address" required id="address">@if(isset($consultant->consultantProfile->address) && $consultant->consultantProfile->address != '') {{ $consultant->consultantProfile->address }} @endif</textarea>									
				</div>
			</div>
			<div class="form-group col-md-6 has-feedback">				
				<label for="bank_details">Bank Details : </label>
				<div class="date">
					<textarea class="form-control" name="bank_details" required id="bank_details">@if(isset($consultant->consultantProfile->bank_details) && $consultant->consultantProfile->bank_details != '') {{ $consultant->consultantProfile->bank_details }} @endif</textarea>										
				</div>
			</div>
			<div class="form-group col-md-6 has-feedback">				
				<label for="oigp_company">OIGP Company : </label>
				<div class="date">
					<input class="form-control" name="oigp_company" required type="text" id="oigp_company" @if(isset($consultant->consultantProfile->oigp_company) && $consultant->consultantProfile->oigp_company != '') value="{{ $consultant->consultantProfile->oigp_company }}" @endif>									
				</div>
			</div>*/?>
            <div class="form-group col-md-6 checkbox check-label">
                <input type="checkbox" name="allow_personal_data" value="1" @if(isset($consultant->consultantProfile->allow_personal_data) && $consultant->consultantProfile->allow_personal_data==1) checked @endif>
                <label for="read_and_accepted">I give my consent to the processing of my personal data for marketing purposes and trade in such Regulations (optional)</label>
            </div>
			<div class="form-group col-md-6 has-feedback">
				<div class="date">
					<input type="submit" class="Save_profile" value="Save Profile" name="save_profile">
				</div>
			</div>
            </form>
        </div></div></div>
	</div>	
</div>

<script>
	//Date picker
	$(document).ready(function () {
		$('#datepicker').datepicker({
			autoclose: true,
			dateFormat: "Y-m-d",
			endDate:new Date()
		});
	});

</script>
@endsection
