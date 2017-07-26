@extends(Auth::user() ?'front.dashboard_layout' : 'front.layout');
@section('content')
<div class="container">
	<div class="col-md-12">
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
		@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
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
	</div>
	<div id="success_div" style="display: none;">
		<div class="alert alert-success" id="success_data">
		</div>
	</div>
	<div class="login_and_register_div">
		@if(!Auth::check())
			<a href="{{ url('login') }}">Login</a>
		@endif
	</div>
	<div class="row">

		<form class="Credit_Card" action="{{ url('/global/query') }}" method="post" enctype= "multipart/form-data">
			{{ csrf_field() }}
			<div class="col-lg-7  col-sm-8 col-xs-12">
				<div class="right_service_details">
					<div class="section_heading">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
						  <i class="fa fa-check" aria-hidden="true"></i>
						</span>{{ $page_title }}
					</div>
					<div class="row">
						@if($query == null)
						<div class="col-sm-6">
							<div class="form-group has-feedback ">
								<div style="padding-left:0;">
									<label for="country">Country Of Interest</label>
									@if (count($country_list) > 0)
										<select name="country" id="country" required class="form-control">
											<option value="">Select Country of Interest</option>
											@foreach ($country_list as $country)
													<option @if(old('country') == $country['country_name']) selected="selected" @endif value = "{{  $country['country_name'] }}">{{  $country['country_name'] }}</option>
											@endforeach
										</select>
									@endif
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group has-feedback ">
								<div style="padding-left:0;">
									<label for="question_type_id">Select your query below : </label>
									<select name="question_type_id" id="question_type_id" required class="form-control">
										<option value="">Select Question</option>
										@foreach ($questions as $k=>$question)
											<option @if(old('question_type_id') == $k) selected="selected" @endif value = "{{  $k }}">{{  $question}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group has-feedback ">
						<div  style="padding-left:0;">
							<label for="Comment">Feel free to attach any documentation which can help your Consultant support you: </label>
							<input type="file" class="form-control" name="attach_file"/>
						</div>
					</div>
					<div class="form-group has-feedback ">
						<div  style="padding-left:0;">
							<label for="Comment">Please insert below your question, detailing as much as possible the support you need: </label>
							<textarea class="form-control"  placeholder="Write Comment" name="comment">{{ old('comment')  }}</textarea>
						</div>
					</div>
					@if(!Auth::check())
					<div class="form-group has-feedback ">
						<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:0;">
						<label for="name">Name : </label>
						@if($user != null)
							<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ $user->name }}">
						@else
							<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ old('name') }}">
						@endif
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12" style="padding-right:0;">
						<label for="surname">Surname : </label>
						@if($user != null)
							<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ $user->surname }}">
						@else
							<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ old('surname') }}">
						@endif
					</div>
					</div>

					<div class="form-group has-feedback email">
						<label for="email">Email : </label>
						@if($user != null)
							<input type="email" disabled class="form-control" required email placeholder="Email" name="email" value="{{ $user->email }}">
						@else
							<input type="email" class="form-control" required email placeholder="Email" name="email" value="{{ old('email') }}">
						@endif
					</div>
					@if($user == null)
					<div class="form-group has-feedback ">
						<label for="pan">Password : </label>
						<input type="password" class="form-control" required placeholder="Password" name="password">
					</div>
					<div class="form-group has-feedback">
						<label>Confirm Password</label>
						<input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation">
					</div>
					@endif

					<div class="form-group has-feedback ">
						<label for="pan">Personal Identification Number : </label>
						@if(isset($user->userProfile) &&  $user->userProfile != null)
							<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="{{ $user->userProfile->pan }}">
						@else
							<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="{{ old('pan') }}">
						@endif
					</div>
					<div class="form-group has-feedback ">
						<label for="vat">VAT : </label>
						@if(isset($user->userProfile) &&  $user->userProfile != null)
							<input type="text" class="form-control" placeholder="VAT" name="vat" value="{{ $user->userProfile->vat }}">
						@else
							<input type="text" class="form-control" placeholder="VAT" name="vat" value="{{ old('vat') }}">
						@endif
					</div>
					<div class="form-group has-feedback ">
						<label for="company">Company (If Applicable)</label>
						@if(isset($user->userProfile) &&  $user->userProfile != null)
							<input type="text" class="form-control"  placeholder="Company" name="company" value="{{ $user->userProfile->company }}">
						@else
							<input type="text" class="form-control"  placeholder="Company" name="company" value="{{ old('company') }}">
						@endif
					</div>
					<div class="form-group has-feedback ">
						<label for="address">Address</label>
						@if(isset($user->userProfile) &&  $user->userProfile != null)
							<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="{{ $user->userProfile->address }}">{{ $user->userProfile->address }}</textarea>
						@else
						<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}">{{ old('address') }}</textarea>
						@endif
					</div>
					<div class="form-group has-feedback email">
						<label for="country">Country</label>
						@if (count($country_list) > 0)
							<select name="country" id="country" required class="form-control">
								<option value="">Select Country</option>
								@foreach ($country_list as $country)
									@if(isset($user->userProfile) &&  $user->userProfile != null)
										<option @if($user->userProfile->country == $country['country_name']) selected="selected" @endif value = "{{  $country['country_name'] }}">{{  $country['country_name'] }}</option>
									@else
										<option @if(old('country') == $country['country_name']) selected="selected" @endif value = "{{  $country['country_name'] }}">{{  $country['country_name'] }}</option>
									@endif
									@endforeach
							</select>
						@endif
					</div>
					<div class="form-group has-feedback ">
						<label for="text">City</label>
						@if(isset($user->userProfile) &&  $user->userProfile != null)
							<input type="text" class="form-control" required placeholder="City" name="city" value="{{ $user->userProfile->city }}">
						@else
							<input type="text" class="form-control" required placeholder="City" name="city" value="{{ old('city') }}">
						@endif
					</div>
					<div class="form-group has-feedback ">
						<label for="zip_code">ZIP Code</label>
						@if(isset($user->userProfile) &&  $user->userProfile != null)
							<input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="{{ $user->userProfile->zip_code }}">
						@else
							<input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="{{ old('zip_code') }}">
						@endif
					</div>
					<div class="checkbox check-label">
						<input type="checkbox" required name="tos">
						<label for="terms_and_policy">I have read and accepted the General <a href="#">Terms and Conditions</a> and have read the <a href="#">Privacy Policy</a></label>
					</div>
					<div class="checkbox check-label">
						<input type="checkbox" required name="tos">
						<label for="read_and_accepted">I have read and accepted the terms pursuant to art. 1341 and 1342 of the Civil Code</label>
						<p style="padding-left: 26px;">Privacy policy</p>
					</div>
					<div class="checkbox check-label">
						<input type="checkbox" value="1" name="allow_personal_data">
						<label for="read_and_accepted">I give my consent to the processing of my personal data for marketing purposes and trade in such Regulations (optional)</label>
					</div>
					@endif
					<div class="form-group has-feedback ">
						<input type="submit" class="applynow" value="Submit" name="submit">
					</div>
					@else
						You have already submitted your query,This can not be redone.
						<div class="col-sm-6">
							<div class="form-group has-feedback ">
								<div style="padding-left:0;">
									<label for="country">Country</label>
									@if (count($country_list) > 0)
										<select name="country" id="country" required class="form-control">
											<option value="">Select Country of Interest</option>
											@foreach ($country_list as $country)
												<option @if(old('country') == $country['country_name']) selected="selected" @endif value = "{{  $country['country_name'] }}">{{  $country['country_name'] }}</option>
											@endforeach
										</select>
									@endif
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group has-feedback ">
								<div style="padding-left:0;">
									<label for="question_type_id">Question : </label>
									<select name="question_type_id" id="question_type_id" required class="form-control">
										<option value="">Select Question</option>
										@foreach ($questions as $k=>$question)
											<option @if(old('question_type_id') == $k) selected="selected" @endif value = "{{  $k }}">{{  $question}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
				</div>
				<div class="form-group has-feedback ">
					<div  style="padding-left:0;">
						<label for="Comment">Attach a file: </label>
						<input type="file" class="form-control" name="attach_file"/>
					</div>
				</div>
				<div class="form-group has-feedback ">
					<div  style="padding-left:0;">
						<label for="Comment">Comment: </label>
						<textarea class="form-control"  placeholder="Write Comment" name="comment">{{ old('comment')  }}</textarea>
					</div>
				</div>
				@if(!Auth::check())
					<div class="form-group has-feedback ">
						<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:0;">
							<label for="name">Name : </label>
							@if($user != null)
								<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ $user->name }}">
							@else
								<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ old('name') }}">
							@endif
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12" style="padding-right:0;">
							<label for="surname">Surname : </label>
							@if($user != null)
								<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ $user->surname }}">
							@else
								<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ old('surname') }}">
							@endif
						</div>
					</div>

					<div class="form-group has-feedback email">
						<label for="email">Email : </label>
						@if($user != null)
							<input type="email" disabled class="form-control" required email placeholder="Email" name="email" value="{{ $user->email }}">
						@else
							<input type="email" class="form-control" required email placeholder="Email" name="email" value="{{ old('email') }}">
						@endif
					</div>
				@endif
						@endif
				</div>
			</div>


			<div class="col-lg-5  col-sm-8 col-xs-12">
				<div class="right_service_details">
					<div class="section_heading">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
						  <i class="fa fa-check" aria-hidden="true"></i>
						</span>{{ $page_title }}
					</div>
					<div class="row">
						<div class="description" style="padding: 21px;">
							<p>{{ strip_tags($service->description) }}</p>
							</div>
						</div>
					</div>
				</div>
		</form>
	</div>
</div>
@endsection