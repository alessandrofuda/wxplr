@extends('admin.layout')
@section('content')
	<div class='col-md-12'>
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">{{ $page_title }}</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body ">
				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
				@if (session('error'))
					<div class="alert alert-danger">
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

				<div class="Profile_details col-md-9 col-sm-10 col-xs-12 columns-center">
	<div class="Profile_details_main">
		<h3 class="Profile_Data_heading">Profile Data</h3>
		{{-- dd($consultant->consultantProfile) --}}
		@if(isset($consultant->consultantProfile->profile_picture) && $consultant->consultantProfile->profile_picture != null)
			<img alt="{{ $consultant->name }}" src="{{ asset($consultant->consultantProfile->profile_picture) }}" width="150" height="150" style="float:left">
		@else
			<img alt="{{ $consultant->name }}" src="https://organicthemes.com/demo/profile/files/2012/12/profile_img.png" width="150" height="150" style="float:left">
		@endif
		<div class="form columns-center" style="display: none;" id="edit_profile_data">
			<a  class=edit_profile" id="view_profile"><i class="fa fa-times" aria-hidden="true"></i></a>
		<form action="{{ url('admin/consultant/'.$consultant->id.'/profile/update')}}" method="POST" class="Profile-Data-form" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="user_id" value="{{ $consultant->id }}">
			<input type="hidden" name="name" value="{{ $consultant->name }}">
			<input type="hidden" name="surname" value="{{ $consultant->surname }}">
			<div class="form-group has-feedback profile_picture">
					<label for="profile_picture">Profile Picture : </label>
					<input type="file" class="form-control" name="profile_picture">
			</div>
			<div class="form-group  Gender">
				<label>Gender</label>
				<span><input type="radio" required name="gender" @if(isset($consultant->consultantProfile->gender) && $consultant->consultantProfile->gender == 'Male') checked @endif class="" value="Male">Male</span>
				<span><input type="radio" required name="gender" @if(isset($consultant->consultantProfile->gender) && $consultant->consultantProfile->gender == 'Female') checked @endif class="" value="Female">Female</span>
			</div>
			<div class="form-group has-feedback">
				<label for="age_range">Date Of Birth : </label>
				<div class="date">
					<input type="text" id="datepicker" required @if(isset($consultant->consultantProfile->date_of_birth) && $consultant->consultantProfile->date_of_birth != '') value="{{ date('Y-m-d',strtotime($consultant->consultantProfile->date_of_birth)) }}" @endif name="date_of_birth" class="form-control">
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="qualification">Qualification : </label>
				<div class="date">
					<input name="qualification" required @if(isset($consultant->consultantProfile->qualification) && $consultant->consultantProfile->qualification != '') value="{{ $consultant->consultantProfile->qualification }}" @endif class="form-control">
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="qualification">Experience (in Years) : </label>
				<div class="date">
					<input name="experience" required @if(isset($consultant->consultantProfile->experience) && $consultant->consultantProfile->qualification != '') value="{{ $consultant->consultantProfile->experience }}" @endif class="form-control">
				</div>
			</div>
			<div class="form-group  has-feedback">
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
			<div class="form-group  has-feedback">
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
			<div class="form-group has-feedback">
				<label for="languages">Short Bio: </label>
				<div class="date">
					<textarea class="form-control" value="{{ isset($consultant->consultantProfile->bio)  ? $consultant->consultantProfile->bio : ''}}" name="bio" required id="bio">{{ isset($consultant->consultantProfile->bio)  ? $consultant->consultantProfile->bio : ''}}</textarea>
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="languages">Languages : </label>
				<div class="date">
					<input class="form-control" @if(isset($consultant->consultantProfile->languages) && $consultant->consultantProfile->languages != '') value="{{ $consultant->consultantProfile->languages }}" @endif name="languages" required type="text" id="languages">
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="oigp_company">Company : </label>
				<div class="date">
					<input class="form-control" name="company" required type="text" id="company" @if(isset($consultant->consultantProfile->oigp_company) && $consultant->consultantProfile->company != '') value="{{ $consultant->consultantProfile->company }}" @endif>
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="vat_number">Vat Number : </label>
				<div class="date">
					<input class="form-control" @if(isset($consultant->consultantProfile->vat_number) && $consultant->consultantProfile->vat_number != '') value="{{ $consultant->consultantProfile->vat_number }}" @endif name="vat_number" required type="text" id="vat_number">
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="vat_number">Personal Identfication Number : </label>
				<div class="date">
					<input class="form-control" @if(isset($consultant->consultantProfile->pin_number) && $consultant->consultantProfile->vat_number != '') value="{{ $consultant->consultantProfile->vat_number }}" @endif name="pin_number" required type="text" id="pin_number">
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="area_expertise">Area of Expertise : </label>
				<select style="height:100px;" id="area_expertise" required name="area_expertise[]" multiple="true" class="form-control">
					<option value="">-- Area of Expertise--</option>
					@foreach ($areas as $k => $area)
						<option @if(isset($consultant->consultantProfile->area_expertise)
					&& in_array($k, $consultant->consultantProfile->getAreaExpertise())) selected @endif value="{{ $k }}">{{ $area }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group has-feedback">
				<label for="address">Address : </label>
				<div class="date">
					<textarea class="form-control" name="address" required id="address">@if(isset($consultant->consultantProfile->address) && $consultant->consultantProfile->address != '') {{ $consultant->consultantProfile->address }} @endif</textarea>
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="city">City : </label>
				<div class="date">
					<input class="form-control" name="city" required type="text" id="city" @if(isset($consultant->consultantProfile->oigp_company) && $consultant->consultantProfile->city != '') value="{{ $consultant->consultantProfile->city }}" @endif>
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="bank_iban">Bank IBAN : </label>
				<div class="date">
					<textarea class="form-control" name="bank_iban" required id="bank_iban">@if(isset($consultant->consultantProfile->bank_details) && $consultant->consultantProfile->bank_iban != '') {{ $consultant->consultantProfile->bank_iban }} @endif</textarea>
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="bank_details">Bank Details : </label>
				<div class="date">
					<textarea class="form-control" name="bank_details" required id="bank_details">@if(isset($consultant->consultantProfile->bank_details) && $consultant->consultantProfile->bank_details != '') {{ $consultant->consultantProfile->bank_details }} @endif</textarea>
				</div>
			</div>
			<div class="form-group has-feedback">
				<label for="oigp_company">OIGP Company : </label>
				<div class="date">
					<input class="form-control" name="oigp_company" required type="text" id="oigp_company" @if(isset($consultant->consultantProfile->oigp_company) && $consultant->consultantProfile->oigp_company != '') value="{{ $consultant->consultantProfile->oigp_company }}" @endif>
				</div>
			</div>
			<div class="clearfix"></div>
			<br/>
			<div class="form-group has-feedback">
				<div class="date">
					<input type="submit" class="Save_profile" value="Save Profile" name="save_profile">
				</div>
			</div>
		</form>
			</div>

		@if(isset($consultant->consultantProfile->id))
			<div class="Profile-Data"  id="view_profile_data">
				<a  class="edit_profile" id="edit_profile"><span class="glyphicon glyphicon-pencil"></span></a>
				@if(isset($consultant->consultantProfile))
				<ul>
					<li><span>Gender:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->gender }}</span></li>

					<li><span>Date Of Birth:</span> <span class="Fill_detais">{{ date('d M,Y',strtotime($consultant->consultantProfile->date_of_birth)) }}</span></li>

					<li><span>Qualification:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->qualification }}</span></li>

					<li><span>Years of Experience:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->experience }}</span></li>

					<li><span>Industry of Expertise</span> <span class="Fill_detais">{{ $consultant->consultantProfile->industry_expertise }}</span></li>

					<li><span>Country of Interest:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->country_expertise }}</span></li>

					<li><span>Short Bio:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->bio }}</span></li>

					<li><span>Languages:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->languages }}</span></li>

					<li><span>Personal Identification Number:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->pin_number }}</span></li>

					<li><span>Company:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->company }}</span></li>

					<li><span>Vat Number:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->vat_number }}</span></li>

					<li><span>Area Expertise:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->getExpertiesOptions($consultant->consultantProfile->area_expertise) }}</span></li>

					<li><span>Address:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->address }}</span></li>

					<li><span>City:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->city }}</span></li>

					<li><span>Bank Details:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->bank_details }}</span></li>

					<li><span>Bank IBAN:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->bank_iban }}</span></li>

					<li><span>OIGP Company:</span> <span class="Fill_detais">{{ $consultant->consultantProfile->oigp_company }}</span></li>
				</ul>
				@endif
			</div>
		@endif

	</div>
</div>



<div class="Profile_details  col-md-9 col-sm-10 col-xs-12 columns-center">
		<div class="Profile_details_main">
			<h3 class="Profile_Data_heading">Login Data</h3>
			<div class="Profile-Data"  id="view_login_data">
			<ul>
					<li><span>Name : </span> <span class="Fill_detais">{{ $consultant->name.' '.$consultant->surname }}</span></li>
					<li><span>Email : </span> <span class="Fill_detais">{{ $consultant->email }}</span></li>
				</ul>
					</div>

			</div>
		</div>
</div>
		</div>
		</div>

	<script>
		$("#edit_login").click(function () {
			$("#view_login_data").hide();
			$("#edit_login_data").show();
		});
		$("#view_login").click(function () {
			$("#view_login_data").show();
			$("#edit_login_data").hide();
		});
		$("#edit_profile").click(function () {
			$("#view_profile_data").hide();
			$("#edit_profile_data").show();
		});
		$("#view_profile").click(function () {
			$("#view_profile_data").show();
			$("#edit_profile_data").hide();
		});
	</script>
	</div>
@endsection
