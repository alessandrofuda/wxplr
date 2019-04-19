@extends('front.dashboard_layout')


@section('top_section')
	<h1>Dashboard<small>Services</small></h1>
	<!--<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>-->
@endsection


@section('content')

	<div class="row">	
		<div class="col-md-offset-1 col-md-10 col-xs-12 profile_page columns-center">
			<h3 class="box-title">{{ $page_title }}</h3>
		</div>
		<div class="col-md-offset-1 col-md-10 col-xs-12 Profile_details columns-center">
			<div class="Profile_details_main">
				<h3 class="Profile_Data_heading">Profile Data</h3>
				@if(isset($user->userProfile->profile_picture) && !empty($user->userProfile->profile_picture))
					<img alt="{{ $user->name }}" src="{{ asset($user->userProfile->profile_picture) }}" width="150" height="150" style="float:left;">
				@else
					<img alt="{{ $user->name }}" src="{{ asset('uploads/profile_image.jpg') }}" width="150" height="150" style="float:left; border:1px solid #CCC;">
				@endif
				@if(isset($user->userProfile->id))

				   <div class="Profile-Data" id="view_profile_data">
						<a  href="{{ url('user/profile/edit') }}" class="edit_profile"><span class="glyphicon glyphicon-pencil"></span></a>
						<ul>
							<li><span>Name : </span> <span class="Fill_detais">{{ $user->name.' '.$user->surname }}</span></li>
							<li><span>Gender: </span> <span class="Fill_detais">{{ $user->userProfile->gender }}</span></li>
							<li><span>Age: </span> <span class="Fill_detais">{{ $user->userProfile->age_range }}</span></li>
							<li><span>Country of Origin : </span> <span class="Fill_detais">{{ $user->userProfile->country_origin }}</span></li>
							<li><span>Country of interest: </span> <span class="Fill_detais">{{ $user->userProfile->country_interest }}</span></li>
							<li><span>Education: </span> <span class="Fill_detais">{{ $user->userProfile->education }}</span></li>
							<li><span>Industry: </span> <span class="Fill_detais">{{ $user->userProfile->industry }}</span></li>
							<li><span>Occupation: </span> <span class="Fill_detais">{{ $user->userProfile->occupation }}</span></li>
							<li><span>Current Occupational status: </span> <span class="Fill_detais">{{ $user->userProfile->occupational_status }}</span></li>
							<li><span>Salary Range: </span> <span class="Fill_detais">{{ $user->userProfile->salary_range }}</span></li>
							</ul>
					</div>
					@endif
			</div>
		</div>
		<div class="Profile_details other-details-main col-md-offset-1 col-md-10 col-xs-12 columns-center">
			<div class="col-md-6 col-sm-6 col-xs-12 other-details one">
				<div class="Profile_details_main">
					<h3 class="Profile_Data_heading">Login Data</h3>
					<div class="columns-center" style="display: none;" id="edit_login_data">
						<a  class="edit_profile" id="view_login"><i class="fa fa-times" aria-hidden="true"></i></a>
						<form action="{{ url('user/profile/update_login') }}" method="POST">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="name">Name</label>
								<div class="date">
									<input type="text" required class="form-control"  name="name" value="{{ isset($user->name) ? $user->name : old('name')  }}" />
								</div>
							</div>
							<div class="form-group">
								<label for="surname">Surname</label>
								<div class="date">
									<input type="text" required class="form-control" name="surname" value="{{ isset($user->surname) ? $user->surname : old('surname')  }}" />
								</div>
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<div class="date">
									<input class="form-control"  type="text" email name="email" disabled value="{{ isset($user->email) ? $user->email : old('email')  }}" />
								</div>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<div class="date">
									<input class="form-control" required type="password" name="password"  />
								</div>
							</div>
							<div class="form-group">
								<label for="confirm_password">Confirm Password</label>
								<div class="date">
									<input class="form-control" required type="password" name="password_confirmation" />
								</div>
							</div>
							<div class="clearfix"></div>
							<br/>
							<div class="form-group col-md-6 has-feedback">
								<div class="date">
									<input type="submit" class="Save_profile" value="Save" name="save_profile">
								</div>
							</div>
						</form>
					</div>
					   <div class="Profile-Data" id="view_login_data">
							<a id="edit_login" class="edit_profile"><span class="glyphicon glyphicon-pencil"></span></a>
							<ul>
								<li><span>Name : </span> <span class="Fill_detais">{{ $user->name.' '.$user->surname }}</span></li>
								<li><span>Email : </span> <span class="Fill_detais">{{ $user->email }}</span></li>
								<li><span>Password : </span> <span class="Fill_detais">******</span></li>
							</ul>
						</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 other-details two">
				<div class="Profile_details_main">
					<h3 class="Profile_Data_heading">Personal / invoice Data</h3>
					@if(isset($user->userProfile->id))
						<div class="columns-center" style="display: none;" id="edit_personal_data">
							<a  class="edit_profile" id="view_personal"><i class="fa fa-times" aria-hidden="true"></i></a>
							<form action="{{ url('user/profile/update_personal') }}" method="POST">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="pan">Tax Code</label>
									<div class="date">
										<input type="text" required class="form-control" name="pan" value="{{ isset($user->userProfile->pan) ? $user->userProfile->pan : old('pan')  }}" />
									</div>
								</div>
								<div class="form-group">
									<label for="vat">VAT</label>
									<div class="date">
										<input type="text" name="vat" class="form-control" value="{{ isset($user->userProfile->vat) ? $user->userProfile->vat : old('vat')  }}" />
									</div>
								</div>
								<div class="form-group">
									<label for="company">Company</label>
									<div class="date">
										<input type="text" name="company" class="form-control" value="{{ isset($user->userProfile->company) ? $user->userProfile->company : old('company')  }}" />
									</div>
								</div>
								<div class="form-group">
									<label for="city">Address</label>
									<div class="date">
										<input type="text" required name="address" class="form-control" value="{{ isset($user->userProfile->address) ? $user->userProfile->address : old('address')  }}" />
									</div>
								</div>
								<div class="form-group has-feedback email">
									<label for="country">Country</label>
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
								<div class="form-group">
									<label for="city">City</label>
									<div class="date">
										<input type="text" required name="city" class="form-control" value="{{ isset($user->userProfile->city) ? $user->userProfile->city : old('city')  }}" />
									</div>
								</div>
								<div class="form-group">
									<label for="zip_code">Zip Code</label>
									<div class="date">
										<input type="text" required class="form-control" name="zip_code" value="{{ isset($user->userProfile->zip_code) ? $user->userProfile->zip_code : old('zip_code')  }}" />
									</div>
								</div>
								<div class="form-group">
									<label for="city">Telephone</label>
									<div class="date">
										<input type="text" required name="telephone" class="form-control" value="{{ isset($user->userProfile->telephone) ? $user->userProfile->telephone : old('telephone')  }}" />
									</div>
								</div>
								<div class="clearfix"></div>
								<br/>
								<div class="form-group col-md-6 has-feedback">
									<div class="date">
										<input type="submit" class="Save_profile" value="Save" name="save_profile">
									</div>
								</div>
							</form>
						</div>
					    <div class="Profile-Data" id="view_personal_data">
							<a id="edit_personal" class="edit_profile"><span class="glyphicon glyphicon-pencil"></span></a>
							<ul>
								<li><span>Tax Code: </span> <span class="Fill_detais">{{ $user->userProfile->pan }}</span></li>
								<li><span>VAT: </span> <span class="Fill_detais">{{ $user->userProfile->vat }}</span></li>
								<li><span>Company (If Applicable): </span> <span class="Fill_detais">{{ $user->userProfile->company }}</span></li>
								<li><span>Address: </span> <span class="Fill_detais">{{ $user->userProfile->address }}</span></li>
								<li><span>Country: </span> <span class="Fill_detais">{{ $user->userProfile->country }}</span></li>
								<li><span>City: </span> <span class="Fill_detais">{{ $user->userProfile->city }}</span></li>
								<li><span>ZIP Code: </span> <span class="Fill_detais">{{ $user->userProfile->zip_code }}</span></li>
								<li><span>Telephone: </span> <span class="Fill_detais">{{ $user->userProfile->telephone }}</span></li>
							</ul>
						</div>
						@endif
				</div>
			</div>
		</div>
		<div class="clearfix" style="clear: both;"></div>
		<div id="account" class="Profile_details col-md-offset-1 col-md-10 col-xs-12 columns-center">
			<div class="Profile_details_main">
				<h3 class="Profile_Data_heading">&nbsp;Account&nbsp;</h3>
				<div class="Profile-Data" id="view_profile_data">
					<!--a href="" class="edit_profile"><span class="glyphicon glyphicon-pencil"></span></a-->
					<ul>
						<li style="border-bottom: none; line-height: 45px;">
							<span>Account status: </span>
							<span class="Fill_detais" style="float: none;">Active since {!! $active_from_date .'&nbsp;&nbsp;&nbsp; ('.$active_from_time.')' !!}</span>
							<button style="float: right; font-size: 110%;" type="button" class="btn btn-danger btn-lg delete_modal_btn" data-toggle="modal" data-target="#deleteModal_{{ $user->id }}">
								<span class="glyphicon glyphicon-trash" style="margin-right: 10px;"></span>Delete Account
							</button>
							<!-- Modal -->
							<div id="deleteModal_{{ $user->id }}" class="modal fade" role="dialog" style="z-index: 99999;">
							  <div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Are you sure you want to delete your account?</h4>
								  </div>
								  <div class="modal-body">
									<form role="form" class="delete_form operations_form" method="post" action="{{ url('user/profile/delete') }}">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-trash" style="margin-right: 10px;"></span> Yes, delete my Account</button>
									</form>
								</div>
								<div class="modal-footer">
								  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							  </div>
							</div>
						  </div><!-- end Modal -->
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>


	<script src="{{ asset('frontend/js/jquery-2.1.4.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
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
		$("#edit_personal").click(function () {
			$("#view_personal_data").hide();
			$("#edit_personal_data").show();
		});
		$("#view_personal").click(function () {
			$("#view_personal_data").show();
			$("#edit_personal_data").hide();
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

@endsection
