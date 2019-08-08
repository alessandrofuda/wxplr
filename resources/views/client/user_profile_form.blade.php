@extends('layouts.dashboard_layout')


@section('content')

<div id="personal-area" class="container user_profile_form">


	<form class="personal-area-form" accept-charset="UTF-8" method="post" action="{{ url('user/profile/update') }}"  enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="user_id" value="{{ $user->id }}">
		<div class="row">
			<div class="col-md-offset-1 col-md-4">
				<div class="page-title">{{ $page_title }}</div>
			</div>
			<div class="col-md-offset-1 col-md-4 text-right">
				<div class="submit-container">
					<input type="submit" class="Save_profile" value="Save" name="save_profile">
				</div>
			</div>
		</div>
		<div class="row line-separator">
			<div class="col-md-offset-1 col-md-9">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-1 col-md-4">
				<div class="sub-title">
					Personal Data
				</div>
				<div class="img-container">
					@if(isset($user->userProfile->profile_picture) && !empty($user->userProfile->profile_picture))
						<img alt="{{ $user->name }}" src="{{ asset($user->userProfile->profile_picture) }}" width="150" height="150">
					@else
						<img alt="{{ $user->name }}" src="{{ asset('uploads/profile_image.jpg') }}" width="150" height="150">
					@endif
				</div>
				<div class="upload-container">
                    <label for="profile_picture" class="upload-custom-btn">upload</label>
                    <input id="profile_picture" type="file" name="profile_picture">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-1 col-md-4">
				<div class="form-group">
					<div class="pa-label">Name</div>
					<input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') ?? $user->name }}" required>
				</div>
				<div class="form-group">
					<div class="pa-label">Address</div>
					<textarea rows="2" cols="50" class="form-control" name="address" placeholder="Address" value="{{old('address') ?? ($user->userProfile->address ?? 'n.a.') }}" required>{{old('address') ?? ($user->userProfile->address ?? 'n.a.') }}</textarea>
				</div>
				<div class="form-group">
					<div class="pa-label">ZIP code</div>
					<input type="text" class="form-control" placeholder="ZIP Code" name="zip_code" value="{{ old('zip_code') ?? ($user->userProfile->zip_code ?? 'n.a.') }}" required>
				</div>
				<div class="form-group">
					<div class="pa-label">CF</div>
					<input type="text" class="form-control" placeholder="Fiscal Code" name="pan" value="{{ old('pan') ?? ($user->userProfile->pan ?? 'n.a.')  }}" required>
				</div>
			</div>
			<div class="col-md-offset-1 col-md-4">
				<div class="form-group">
					<div class="pa-label">Surname</div>
					<input type="text" class="form-control" placeholder="Surname" name="surname" value="{{ old('surname') ?? ($user->surname ?? 'n.a.') }}" required>
				</div>
				<div class="form-group">
					<div class="pa-label">E-Mail</div>
					<div class="value" style="height: 66px;">{{ $user->email ?? 'n.a.' }}</div>
				</div>
				<div class="form-group">
					<div class="pa-label">City</div>
					<input type="text" class="form-control" placeholder="City" name="city" value="{{ old('city') ?? ($user->userProfile->city ?? 'n.a.') }}" required>
				</div>
				<div class="form-group">
					<div class="pa-label">Country</div>
					<select id="country" name="country" class="form-control" required>
						<option value="">-- Select Country --</option>
						@if(count($countries_code)>0)
							@foreach ($countries_code as $country)
								<option @if(isset($user->userProfile->country_origin) && $user->userProfile->country_origin == $country['country_name']) selected @endif value="{{ $country['country_name'] }}">
									{{ $country['country_name'] }}
								</option>
							@endforeach
						@endif
					</select>
				</div>
			</div>
		</div>
		<div class="row line-separator">
			<div class="col-md-offset-1 col-md-9">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-1 col-md-9 text-right submit-container">
				<input type="submit" class="Save_profile" value="Save" name="save_profile">
			</div>
		</div>
	</form>



{{-- // OLD CODE TYLE

	<div class="row">
		<div class="heading">
			<h1>{{ $page_title }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
            <div class="">
				<div class="panel-body">
					<p>Thank you for choosing Wexplore’s Professional Kit. In order to customize your journey to your future dream job, kindly fill in the profile form below:</p>
            	<form accept-charset="UTF-8" method="post" action=" {{ url('user/profile/update') }}" class="checkout-form"  enctype="multipart/form-data">
                	{{ csrf_field() }}
					@if(Route::current()->getName() == 'professional.kit')
						@php
							$redirect_url = 'market_analysis';
							$submit_label = 'Save & Proceed to Market Analysis';
						@endphp
					@else
						@php
							$redirect_url = 'user_profile';
							$submit_label = 'Save Profile';
						@endphp
					@endif
					<input type="hidden" name="redirect_url" value="{{ $redirect_url }}">
					<input type="hidden" name="user_id" value="{{ $user->id }}">
					@if(Route::current()->getName() != 'professional.kit')
						<div class="form-group col-md-6 has-feedback">
							<label for="name">Name </label>
							<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ $user->name }}">
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
						<div class="form-group col-md-6 has-feedback">
							<label for="surname">Surname </label>
							<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ $user->surname }}">
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
					  	</div>
					@endif
                    <div class="form-group col-md-6 has-feedback profile_picture">

                		@if(isset($user->userProfile->profile_picture))
							@if($user->userProfile->profile_picture != null)
							<div class="col-xs-2">
                        		<img alt="{{ $user->name }}" src="{{ asset($user->userProfile->profile_picture) }}">
							</div>
							@endif
                    	@endif

						<div class="col-xs-10">
							<label for="profile_picture">Profile Picture </label>
                        	<input type="file" name="profile_picture">
						</div>
				    </div>
					@if(Route::current()->getName() != 'professional.kit')
						<div class="form-group col-md-6 has-feedback">
							<label for="email">Email </label>
							<input type="email" class="form-control" disabled required email placeholder="Email" name="email" value="{{ $user->email }}">
							<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						</div>
					@endif
				<div class="form-group col-md-6 Gender">
                    <label>Gender</label>
                    <span><input type="radio" required name="gender" @if(isset($user->userProfile->gender) && $user->userProfile->gender == 'Male') checked @endif class="" value="Male">Male</span>
					<span><input type="radio" required name="gender" @if(isset($user->userProfile->gender) && $user->userProfile->gender == 'Female') checked @endif class="" value="Female">Female</span>
                </div>

                <div class="form-group col-md-6 has-feedback">
				<label for="age_range">Age </label>
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
				<label for="country_origin">Country of Origin </label>
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
				<label for="country_interest">Country of Interest </label>
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
				<label for="education">Education </label>
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
				<label for="industry"> Industry </label>
				<div class="date industry">
					<div class='selectBox'>
						<input type="hidden" id="selected_option_id" value="{{ isset($user->userProfile->industry) ? $user->userProfile->industry :"" }}" class="price_values" name="industry"/>
						<span class='selected'></span>
						<span class='selectArrow'>&#9660</span>
						<ul class="selectOptions" >
							<li class="selectOption" id="industry_0">---Choose Industry---</li>
							@foreach(\App\User::getIndustryList() as $industry)
								<li class="selectOption" id="industry_{{ explode(' ',$industry)[0] }}" data-value="value {{ $industry }}">{{ $industry }}</li>
								<div class="occupation-help-wrap">
									<div id="industry_tip_{{ explode(' ',$industry)[0] }}" class="profile-help-desc" style="display:none;">
										{{ \App\User::getIndustryText($industry) }}
									</div>
								</div>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="form-group col-md-6 has-feedback">
				<label for="occupational">Occupation </label>
				<div class="date Occupation">
					<div class='selectBox'>
						<input type="hidden" id="selected_option_id" value="{{ isset($user->userProfile->occupation) ? $user->userProfile->occupation :"" }}" class="price_values" name="occupation"/>
						<span class='selected'></span>
						<span class='selectArrow'>&#9660</span>
						<ul class="selectOptions" >
							<li class="selectOption" id="occupation_0">---Choose Occupation---</li>
							@foreach(\App\User::getOccupationsList() as $occupation)
								<li class="selectOption" id="occupation_{{ explode(' ',$occupation)[0] }}" data-value="value {{ $occupation }}">{{ $occupation }}</li>
								<div class="occupation-help-wrap">
									<div id="occupation_tip_{{ explode(' ',$occupation)[0] }}" class="profile-help-desc" style="display:none;">
										{{ \App\User::getOccupationText($occupation) }}
									</div>
								</div>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="form-group col-md-6 has-feedback">
				<label for="occupational">Occupational Status </label>
				<div class="date Occupation">
					<select name="occupational_status" class="form-control">
						<option>---Select Occupation status</option>
						<option @if(isset($user->userProfile->occupational_status) && $user->userProfile->occupational_status == 'Student') selected @endif value="Student">Student</option>
						<option @if(isset($user->userProfile->occupational_status) && $user->userProfile->occupational_status == 'Employed') selected @endif value="Employed">Employed</option>
						<option @if(isset($user->userProfile->occupational_status) && $user->userProfile->occupational_status == 'Unemployed') selected @endif value="Unemployed">Unemployed</option>
					</select>
				</div>
			</div>
			<div class="form-group col-md-6 has-feedback">
				<label for="salary_range">Salary Range </label>
				<div class="date">
					<select name="salary_range" required id="salary_range" class="form-control">
						<option>-- Select Salary Range --</option>
						<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == 'Up to 25,000') selected @endif value="Up to 25,000">Up to 25,000</option>
						<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == '25,001 - 40,000') selected @endif value="25,001 - 40,000">25,001 - 40,000</option>
						<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == '40,001 - 55,000') selected @endif value="40,001 - 55,000">40,001 - 55,000</option>
						<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == '55,001 - 70,000') selected @endif value="55,001 - 70,000">55,001 - 70,000</option>
						<option @if(isset($user->userProfile->salary_range) && $user->userProfile->salary_range == 'More than 70,000') selected @endif value="More than 70,000">More than 70,000</option>
					</select>
				</div>
			</div>
					@if(Route::current()->getName() != 'professional.kit')
						<div class="form-group col-md-6 has-feedback email">
							<label for="pan">Personal Identification Number </label>
							<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="{{ $user->userProfile->pan }}">
						</div>
						<div class="form-group col-md-6 has-feedback email">
							<label for="vat">VAT (If Applicable) </label>
							<input type="text" class="form-control" required placeholder="VAT" name="vat"
								   value="{{ $user->userProfile->vat }}">
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>
						<div class="form-group col-md-6 has-feedback email">
							<label for="company">Company (If Applicable) </label>
							<input type="text" class="form-control" placeholder="Company" name="company"
								   value="{{ $user->userProfile->company }}">
						</div>
						<div class="form-group col-md-6 has-feedback email">
							<label for="address">Address </label>
							<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="{{$user->userProfile->address }}">{{ $user->userProfile->address  }}</textarea>
							<span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
						</div>
						<div class="form-group col-md-6 has-feedback email">
							<label for="country">Country </label>
							@if (count($countries_code) > 0)
								<select name="country" id="country" required class="form-control">
									<option value="">Select Country</option>
									@foreach ($countries_code as $country)
										<option @if($user->userProfile->country == $country['country_name'] ) selected @endif value = "{{  $country['country_name'] }}">
											{{  $country['country_name'] }}</option>
									@endforeach
								</select>
							@endif
						</div>
						<div class="form-group col-md-6 has-feedback email">
							<label for="text">City</label>
							<input type="text" class="form-control" required placeholder="City" name="city" value="{{ $user->userProfile->city}}">
						</div>
						<div class="form-group col-md-6 has-feedback email">
							<label for="zip_code">ZIP Code </label>
							<input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="{{ $user->userProfile->zip_code }}">
						</div>
						<div class="form-group col-md-6 has-feedback">
							<label for="telephone">Telephone </label>
							<input type="tel" class="form-control"  placeholder="Telephone Number" name="telephone" value="{{ $user->userProfile->telephone }}">
							<span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
						</div>

						@endif
					<input type="hidden" name="allow_personal_data" value="1" >

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
--}}


</div>


{{--
	<style type='text/css'>
	div.selectBox{position: relative; display: inline-block; cursor: default; text-align: left; line-height: 30px; clear: both; color: rgb(114, 97, 97);}
	span.selected{width: 167px; text-indent: 10px; border: 1px solid rgb(233, 233, 233); border-right: none; border-top-left-radius: 5px; border-bottom-left-radius: 5px; background: #f6f6f6; overflow: hidden;font-family: Arial, sans-serif;font-size: 12px;font-weight: bold;
		background: #ffffff;
		background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
		background: -moz-linear-gradient(top, #ffffff 0%, #f3f3f3 50%, #ededed 51%, #ffffff 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(50%,#f3f3f3), color-stop(51%,#ededed), color-stop(100%,#ffffff));
		background: -webkit-linear-gradient(top, #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%);
		background: -o-linear-gradient(top, #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%);
		background: -ms-linear-gradient(top, #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%);
		background: linear-gradient(to bottom, #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ffffff',GradientType=0 );
	}
	span.selectArrow{width: 30px; border: 1px solid #60abf8; border-top-right-radius: 5px; border-bottom-right-radius: 5px; text-align: center; font-size: 12px; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -o-user-select: none; user-select: none; background: #4096ee; color: #fff;}
	span.selectArrow,span.selected{position: relative; float: left; height: 30px; z-index: 1;}
	ul.selectOptions{position: absolute; top: 28px; left: 0; width: 198px; border: 1px solid #ccc; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; overflow: hidden; background: rgb(250, 250, 250); padding-top: 2px; display: none;margin: 0;list-style: none inside none;padding-left: 0;z-index:1;}
	li.selectOption{display: block; line-height: 20px; padding: 5px 0 5px 10px; font-size: 12px; font-weight: bold; font-family: arial, sans-serif;list-style: none;margin: 0}
	li.selectOption:hover{color: #f6f6f6;background: #4096ee;}
	</style>
	<script src="{{ asset('frontend/js/jquery-2.1.4.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
	<script>
		function enable() {
			$('div.selectBox').each(function () {
				$(this).children('span.selected').html($(this).children('ul.selectOptions').children('li.selectOption:first').html());
				$('input.price_values').attr('value', $(this).children('ul.selectOptions').children('li.selectOption:first').attr('data-value'));

				$(this).children('span.selected,span.selectArrow').click(function () {
					if ($(this).parent().children('ul.selectOptions').css('display') == 'none') {
						$(this).parent().children('ul.selectOptions').css('display', 'block');
					}
					else {
						$(this).parent().children('ul.selectOptions').css('display', 'none');
					}
				});

				$(this).children().find('li.selectOption').click(function () {
					$(this).parent().css('display', 'none');
					var ori_value = $(this).attr('data-value').split('value ')[1];
					console.log('ori'+ori_value);
					$(this).parent().siblings('input.price_values').attr('value', ori_value);
					$(this).parent().siblings('span.selected').html($(this).html());
				});
				var value = $(this).find("#selected_option_id").val();
				var value = "value "+value;
				$(this).children().find("[data-value='" + value + "']").parent().css('display', 'none');
				$(this).children().find("[data-value='" + value + "']").parent().siblings('span.selected').html($(this).children().find("[data-value='" + value + "']").html());
			});
		}
		$(document).ready(function () {
			enable();
			$(".date.industry").click(function() {
				$(".date.Occupation .selectOptions").css("display", "none");
			});
			$(".date.Occupation").click(function() {
				$(".date.industry .selectOptions").css("display", "none");
			});
		});
		$(document).delegate('.selectOptions li','mouseover mouseout', function(event) {
			if (event.type == 'mouseover') {
				var id = $(this).attr('id');
				var id = id.split('occupation_')[1];
				$('#occupation_tip_'+id).show();
				$('[id^=occupation_tip_]').not('#occupation_tip_'+id).each(function(){
					$(this).hide();
				});

				var id = $(this).attr('id');
				var id = id.split('industry_')[1];
				$('#industry_tip_'+id).show();
				$('[id^=industry_tip_]').not('#industry_tip_'+id).each(function(){
					$(this).hide();
				});
			}else{
				var id = $(this).attr('id').split('occupation_')[1];
				$('#occupation_tip_'+id).hide();
			}

			$(this).parent().toggleClass('over');
		});

		$(document).ready(function() {
			var val = $('[name=company]').val();
			if(val != '') {
				$('[name=vat]').attr('required','required');
			}else{
				$('[name=vat]').attr('required',false);
			}
		});

		$('[name=company]').change(function(){
			var val = $(this).val();
			if(val != '') {
				$('[name=vat]').attr('required','required');
			}else{
				$('[name=vat]').attr('required',false);
			}
		});
	</script>
--}}
@endsection

@push('scripts')
	<script>

		{{-- https://www.codovel.com/ajax-image-upload-with-laravel-example.html --}}
		//$('#profile_picture').val();
		jQuery(function($) {
			$('#profile_picture').on('change', function(e) {
				if( $(this).val() != '' ) {
					var form_data = new FormData();
			        form_data.append('file', e.target.files[0]);
			        form_data.append('_token', '{{csrf_token()}}');
					// var fileName = e.target.files[0].name;   
					// var selected = $('#profile_picture').val();
					$.ajax({
						url: "{{route('user_profile_upload_image')}}",
						data: form_data,
						type: 'POST',
						contentType: false,
			            processData: false,
			            success: function (data) {
			            	alert('ok');
			            	console.log(data);
			                if (data.fail) {
			                    $('.img-container img').attr('src', '{{ asset('uploads/profile_image.jpg') }}');
			                    alert(data.errors['file']);
			                } else {
			                    $(this).val(data);
			                    $('.img-container img').attr('src', '{{ asset($user->userProfile->profile_picture) }}');
			                }
			                //$('#loading').css('display', 'none');
			            },
			            error: function (xhr, status, error) {
			                alert(xhr.responseText);
			                $('.img-container img').attr('src', '{{ asset('uploads/profile_image.jpg') }}');
			            }

					});
				} else {
					// remove TODO ....
				    /*function removeFile() {
				        if ($('#file_name').val() != '')
				            if (confirm('Are you sure want to remove profile picture?')) {
				                $('#loading').css('display', 'block');
				                var form_data = new FormData();
				                form_data.append('_method', 'DELETE');
				                form_data.append('_token', '{{--csrf_token()--}}');
				                $.ajax({
				                    url: "ajax-remove-image/" + $('#file_name').val(),
				                    data: form_data,
				                    type: 'POST',
				                    contentType: false,
				                    processData: false,
				                    success: function (data) {
				                        $('#preview_image').attr('src', '{{--asset('images/noimage.jpg')--}}');
				                        $('#file_name').val('');
				                        $('#loading').css('display', 'none');
				                    },
				                    error: function (xhr, status, error) {
				                        alert(xhr.responseText);
				                    }
				                });
				            }
				    }*/
				}
			});
		});
	</script>
@endpush
