@extends('layouts.clean_layout')


@section('content')

<div id="checkout" class="container-fluid">
	<div class="row">
		<div class="col-md-12 logo-container">
			<img class="logo" src="{{asset('frontend/images/wexplore-logo-tondo.png')}}" title="Wexplore"> 
		</div>
	</div>
	<div class="row title-container">
		<div class="col-md-8 col-md-offset-2 boxed no-bg no-padding">
			<div class="title">Checkout</div>
		</div>
	</div>
	<div class="row alerts-container">
		<div class="col-md-12">	
			<div id="success_div" style="display: none;">
				<div class="alert alert-success boxed" id="success_data"></div>
			</div>
		</div>
		@if(session('error'))
	        <div class="col-md-12">
	            <div class="alert alert-danger">
	                <ul>
	                    <li>{!! session('error') !!}</li>
	                </ul>
	            </div>
	        </div>
		@endif
	    @if (count($errors) > 0)
	        <div class="col-md-12">
	            <div class="alert alert-danger">
	                <ul>
	                    @foreach ($errors->all() as $error)
	                        <li>{!! $error !!}</li>
	                    @endforeach
	                </ul>
	            </div>
	        </div>
	    @endif
	</div>
	<div class="row checkout-page-intro boxed no-bg no-padding text-center">
		<div class="col-md-12">
			@if (Auth::check())
				You're almost there! Welcome to the Checkout page!<br>
				Few steps left and you will be able to use the VIC made by Wexplore.
			@else
				Ci sei quasi! Benvenuto nella pagina di Checkout!<br>
				Mancano pochissimi passi e riuscirai ad utilizzare il VIC realizzato da Wexplore.
			@endif
			
		</div>
	</div>
	<div class="row promo-code-container boxed no-bg no-padding text-right">
		<div class="col-md-12">
			<div class="promo-code-title">
				<a id="have_promo" class="btn btn-success promo-code-btn">Do you have a PROMO CODE ?</a>
			</div>
			<div id="promo_div" style="display: {{ isset($code) ? '' : 'none' }};">
				<div class="col-md-6">
					<form id="promo_form" action="{{ url('service/checkcode') }}" method="POST">
						{{ csrf_field() }}
						<input type="text" class="form-control" id="code" value="{{ isset($code) ? $code : '' }}" name="code" placeholder="Enter Code"/>
						<div class="error text-left" id="code_error"></div>
					</form>
				</div>
				<div class="col-md-6">
					<button class="btn cta" id="submit_promo">
						Apply Now
					</button>
					<button class="btn cta" id="cancel_promo">
						Cancel
					</button>
				</div>
			</div>
		</div>
	</div>
	<form id="checkout-form" class="" action="{{ $url }}" method="post">
		{{ csrf_field() }}
		<input type="hidden" id="nonce" name="payment_method_nonce" />

		@if(isset($service))
			<input type="hidden" id="selected_service_price"  name="amount" value="@if(is_object($service) && !empty($service)){{ $amount }}@endif">
			<input type="hidden" name="service_name" value="@if(is_object($service) && !empty($service)){{ $service->name }}@endif">
			<input type="hidden" id="service_id" name="service_id" value="@if(is_object($service) && !empty($service)){{ $service->id }}@endif">
			<input type="hidden" id="service_type" name="service_type" value="{{ \App\OrderTransaction::TYPE_SERVICE }}">
            <input type="hidden" id="usdprice" value="{{ round($service->usdprice($service->currency_type,'USD',$service->price)) }}">
		@elseif(isset($video))
			<input type="hidden" id="service_id" name="service_id" value="@if(is_object($video) && !empty($video)){{ $video->id }}@endif">
			<input type="hidden" id="selected_service_price"  name="amount" value="@if(is_object($video) && !empty($video)){{ $video->price }}@endif">
			<br/>
			<img alt="{{ $video->video_title }}" border="0" width="150" src="{{ asset($video->video_image) }}" />
			<input type="hidden" id="service_type" name="service_type" value="{{ \App\OrderTransaction::TYPE_VIDEO }}">
            <input type="hidden" id="usdprice" value="{{ round(App\Service::usdprice('EUR','USD',$video->price)) }}">
        @elseif(isset($event))
            <input type="hidden" id="service_id" name="service_id" value="@if(is_object($event) && !empty($event)){{ $event->id }}@endif">
            <input type="hidden" id="selected_service_price"  name="amount" value="@if(is_object($event) && !empty($event)){{ $event->price }}@endif">
			<br/>
		    <img alt="{{ $event->name  }}" border="0" width="150" src="{{ asset($event->image_file) }}" />
            <input type="hidden" id="service_type" name="service_type" value="{{ \App\OrderTransaction::TYPE_EVENT }}">
            <input type="hidden" id="usdprice" value="{{ round(App\Service::usdprice('EUR','USD',$event->price)) }}">
        @elseif(isset($package))
			<input type="hidden" id="service_id" name="service_id" value="@if(is_object($package) && !empty($package)){{ $package->id }}@endif">
			<input type="hidden" id="selected_service_price"  name="amount" value="@if(is_object($package) && !empty($package)){{ $package->price }}@endif">
			<br/>
			<input type="hidden" id="service_type" name="service_type" value="{{ \App\OrderTransaction::TYPE_PACKAGE }}">
			<input type="hidden" id="usdprice" value="{{ round(App\Service::usdprice('EUR','USD',$package->price)) }}">

			<div class="clearfix"></div>
			<br/>
			<input type="hidden" id="selected_service_price"  name="amount" value="">
            <input type="hidden" id="service_type" name="service_type" value="{{ \App\OrderTransaction::TYPE_SERVICE }}">
            <input type="hidden" id="usdprice" value="">
			<input type="hidden" id="service_id" name="service_id">
		@endif
		<input type="hidden" name="code_id" id="code_id" value="{{ isset($code) ? $code : "" }}">
		<div class="row personal-data-container">
			<div class="col-md-8 col-md-offset-2 boxed">
				<div class="title-box personal-data-title">Personal Data</div>
				<div class="row">
					<div class="col-md-6 form-group has-feedback">
						<label for="name">Name</label>
						@if($user != null)
							<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ $user->name }}">
						@else
							<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ old('name') }}">
						@endif
					</div>
					<div class="col-md-6 form-group has-feedback">
						<label for="surname">Surname</label>
						@if($user != null)
							<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ $user->surname }}">
						@else
							<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ old('surname') }}">
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group has-feedback">
						<label for="email">Email</label>
						@if(Auth::check() && $user != null)
							<span class="precompiled">{{ $user->email }}</span>
						@else
							<div class="email-wrap">
								<input type="email" class="form-control" required  placeholder="Email" name="email" value="{{ old('email') }}">
								<button id="email-check" class="btn">Check Email</button>
								<div class="check-email-validation"></div>
							</div>
							<div class="login-wrap">
								<label for="password">You are already registered.<br/>Enter the password and proceed to checkout.</label>
								<input type="password" class="form-control" name="" placeholder="Password"> <!--name compiled via js-->
								<span class="forgot-psw"><a href="{{route('forgot-psw')}}">Forgot password?</a></span>
							</div>
							<div class="register-wrap">
								<label for="password">You are not registered.<br>Choose a password and proceed to checkout.</label>
								<input class="form-control password" type="password" name="" placeholder="Type password"><!--name compiled via js-->
								<input class="form-control password-confirmation" type="password" name="" placeholder="Retype password"><!--name compiled via js-->
							</div>
						@endif
					</div>
					<div class="col-md-6 form-group has-feedback">
						<label for="pan">Fiscal Code</label>
						@if($userProfile  != null && $userProfile->pan  != null) 
							<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="{{ $userProfile->pan }}" title="fiscal code">
						@else 
							<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="{{ old('pan') }}" title="fiscal code">
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group has-feedback">
						<label for="address">Invoice Address (Street and Number)</label>
						@if($userProfile != null && $userProfile->address  != null)
							<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="{{ $userProfile->address }}">{{ $userProfile->address }}</textarea>
						@else
							<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}">{{ old('address') }}</textarea>
						@endif
					</div>
					<div class="col-md-6 form-group has-feedback">
						<label for="zip_code">ZIP Code</label>
						@if($userProfile != null && $userProfile->zip_code  != null)
	                        <input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="{{ $userProfile->zip_code }}">
	                    @else
	                        <input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="{{ old('zip_code') }}">
	                    @endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group has-feedback">
						<label for="city">City</label>
						@if($userProfile != null && $userProfile->city  != null)
							<input type="text" name="city" placeholder="City" required class="form-control" value="{{ $userProfile->city }}">
						@else
							<input type="text" name="city" placeholder="City" required class="form-control" value="{{ old('city') }}">
						@endif
					</div>
					<div class="col-md-6 form-group has-feedback">
						<label for="province">Province</label>
						@if($userProfile != null && $userProfile->province  != null)
							<input type="text" name="province" placeholder="Prov" class="form-control" value="{{ $userProfile->province }}">
						@else
							<input type="text" name="province" placeholder="Prov" class="form-control" value="{{ old('province') }}">
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group has-feedback">
						<label for="country">Country</label>
						@if (count($country_list) > 0)
							<select name="country" id="country" required class="form-control" style="clear: both;">
								<option value="">Select Country</option>
								@foreach ($country_list as $country)
									@if($userProfile != null && $userProfile->country  != null)
										<option @if($userProfile->country == $country['country_name']) selected="selected" @endif value = "{{  $country['country_name'] }}">{{  $country['country_name'] }}</option>
									@else
										<option @if(old('country') == $country['country_name']) selected="selected" @endif value = "{{  $country['country_name'] }}">{{  $country['country_name'] }}</option>
									@endif
								@endforeach
							</select>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="row order-container">
			<div class="col-md-8 col-md-offset-2 boxed">
				<div class="title-box your-order-title">your order</div>
				<div class="row">
					<div class="col-md-6">
						@if(isset($service))
							<div class="first-row">Service</div>
							<div class="service-name">{!! $service != null ? $service->name : "" !!}</div>
						@elseif(isset($video))
							<div class="first-row">Video name</div>
							<div class="service-name">{!! $video->video_title !!}</div>
						@elseif(isset($event))
							<div class="first-row">Event name</div>
							<div class="service-name">{!! $event->name !!}</div>
						@elseif(isset($package))
							<div class="first-row">Package name</div>
							<div class="service-name">{!! $package->title !!}</div>
						@else
							<div class="first-row">- Service not defined -</div>
							<div class="service-name"></div>
						@endif
					</div>
					<div class="col-md-6">
						<div class="prices-container text-right">
							<div class="first-row spacer" style="visibility: hidden;">AAA</div>
							@if(isset($service))
								<div class="price original_price">
									{{ $service != null ? '€ '.$service->price : "" }}
								</div>
								<div class="vat-disclaimer">
									Include VAT 22% {{  $service != null ? '€ '.round(($service->vatprice(true) * 22/100), 2) : "" }}
								</div>
								<div class="discounted_price">
									Discounted Price: <span class="price">€ 9089</span>
								</div>
							@elseif(isset($video))
								<div class="price original_price">
									{{  '€'.$video->price  }}
								</div>
								<div class="vat-disclaimer">
									Include VAT 22% {{ '€ '.round(($video->vatprice() * 22/100), 2)  }}
								</div>
							@elseif(isset($event))
								<div class="price original_price">
									{{  '€'.$event->price  }}
								</div>
								<div class="vat-disclaimer">
									Include VAT 22% {{ '€ '.round(($event->vatprice() * 22/100), 2)  }}
								</div>
							@elseif(isset($package))
								<div class="price original_price">
									{{  '€'.$package->price  }}
								</div>
								<div class="vat-disclaimer">
									Include VAT 22% {{ '€ '.round(($package->vatprice() * 22/100), 2)  }}
								</div>
							@else
								<div class="price original_price">n.a.</div>
								<div class="vat-disclaimer">n.a.</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row payment-method-container">
			<div class="col-md-8 col-md-offset-2 boxed">
				<div class="title-box payment-method-title">Payment Method</div>
					<div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
				<div class="ligle_terms servic_Payment_method">
                    <span class="paymentOption_div">
                        <input type="checkbox" name="tos" required>
                        <i></i>
                        <b>I have read and accepted the General <a href="/terms-service" target="_blank">Terms and Conditions</a>.*</b>
                    </span>
                    <span class="paymentOption_div">
                    	<input type="checkbox" name="tos" required>
                    	<i></i>
                    	<b>I give my consent to the processing of my personal data as per the <a href="/privacy-policy" target="_blank">Privacy Policy</a> for the purpose of service delivery.*</b>	
                    </span>
                    <span class="paymentOption_div">
                        <input  type="checkbox" value="1" name="allow_personal_data">
                        <i></i>
                        <b>I give my consent to the processing of my personal data as per the <a href="/privacy-policy" target="_blank">Privacy Policy</a> for newsletter and other institutional communication purposes (optional)</b>
                    </span>
                    <span class="paymentOption_div">
                    	<input type="checkbox" value="1" name="allow_personal_data_to_third_parties">
                    	<i></i>
                    	<b>I give my consent to the processing of my personal data to be communicated to recruiting and/or headhunting and/or partner companies (optional)</b>
                    </span>
                </div>
			</div>
		</div>
		<div class="row buttons-container">
			<div class="col-md-8 col-md-offset-2 boxed no-bg no-padding">
				<div class="back-btn">
					<a href="#" class="back-link" title="Go Back" onclick="goBack(event)">Back</a>
					<script>
						function goBack(e) {
							e.preventDefault();
							window.history.back();
						}
					</script>
				</div>
				<div class="get-btn">
					@if(isset($service))
	                    <button type="submit" value="Pay" class="order_now">
	                        @if(is_object($service) && !empty($service))
	                            Get Now
	                        @endif
	                    </button>
	                @elseif(isset($video))
	                    <button value="Pay $@if(is_object($video) && !empty($video)){{ round(\App\Service::usdprice('EUR', 'USD', $video->price)) }}@endif" type="submit" class="order_now">
	                        @if(is_object($video) && !empty($video))
	                            Get Now Video
	                        @endif
	                    </button>
	                @elseif(isset($event))
	                    <button value="Pay $@if(is_object($event) && !empty($event)){{ round(\App\Service::usdprice('EUR', 'USD', $event->price)) }}@endif" type="submit" class="order_now">
	                        @if(is_object($event) && !empty($event))
	                            Get Now Event
	                        @endif
	                    </button>
	                @elseif(isset($package))
                        <button value="Pay $@if(is_object($package) && !empty($package)){{ round(\App\Service::usdprice('EUR', 'USD', $package->price)) }}@endif" type="submit" class="order_now">
                            @if(is_object($package) && !empty($package))
                                Get Now Package
                            @endif
                        </button>
	                @else
	                    <button  id="submit-button" value="" type="submit" class="order_now">
	                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
	                    </button>
	                @endif
				</div>
			</div>
		</div>
	</form>
</div>

@php 
	$clientToken = \Braintree\ClientToken::generate();
@endphp

<script src="{{ asset('frontend/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
<script src="https://js.braintreegateway.com/web/dropin/1.19.0/js/dropin.min.js"></script>

<script>
    var form = document.querySelector('#checkout-form');
    var client_token = "{{ $clientToken }}";
    var price = $('#selected_service_price').val();
    var dropinInstance;

    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      paypal: {
        flow: 'checkout',
        amount: price, 
        currency: 'EUR'
      }
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }
      form.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            return;
          }
          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          form.submit();
        });
      });
      dropinInstance = instance;
    });
</script>

<script>
    var clientToken = "{{ $clientToken }}";
    var price = $('#selected_service_price').val();
    var paymentFormCard = $('#payment-form-card');
    var paymentFormPaypal = $('#payment-form');
    var PaypalInstance;

    paymentFormPaypal.hide();
    paymentFormCard.hide();

	// $.ajaxSetup({
	// 	headers: {
	// 		'X-CSRF-TOKEN': "{{-- csrf_token() --}}"
	// 	}
	// });
	
	$("#have_promo").click(function(){
		$("#promo_div").show();
	});
	$("#cancel_promo").click(function(){
		$("#promo_div").hide();
	});
	
	$('.discounted_price').hide();

	$("#submit_promo").click(function(){   // interviene solo all'eventuale submit del promo code
		var code = $("#code").val();
		var service_id = $("#service_id").val();
		var type = $("#service_type").val();
	    var token = "{{ csrf_token() }}";
		var value = {'code':code, 'service_id':service_id,'type':type,'_token':token};
		$.ajax({
			url:"{{ url('availcode') }}",
			method:'POST',
			_token:"{{ csrf_token() }}",
			data:value,
			success:function(response) {
				// console.log(response);
				if(response.status == 'OK') {
					//$("#promo_form").submit();
					$("#code_error").html('');
	            	$("#submit_promo").attr('id','');
					$("#code_id").val(code);
					$('#submit_promo').html('<i class="fa fa-check"></i> Available');
					$('#success_div').show();
					$('#success_data').html('Congratulations!!! You have successfully availed discount');
					//$("#code_id").val(response.id);
					$("#discount_avail").show();
	            	// console.log(response.amount);
					$("#discount_value").html('€'+response.amount);

					var price = $("#selected_service_price").val();
					// console.log("current-price: " + price);

					var total_price = response.total;
					// console.log("Total-price: " + total_price + "(" + price + " - " + response.amount + ")");

	            	//var total_price = total_price.toPrecision(2);
					// console.log("Total-price-round: " + total_price);

					$("#total_price_new").show();
					$("#total_price_value_new").html('€' + total_price);
					var total_price_usd = response.total_usd;
					// console.log("Total-price-USD: " + total_price_usd);

					$("#selected_service_price").val(total_price_usd);

					if(total_price_usd > 0) {
						$('#payment-form').empty();

						// new for promo code
						braintree.dropin.create({
							authorization: client_token,
							selector: '#bt-dropin',
							paypal: {
								flow: 'checkout',
								amount: total_price_usd, 
								currency: 'EUR'
							}
						}, function (createErr, instance) {
							if (createErr) {
								console.log('Create Error', createErr);
								return;
							}
							form.addEventListener('submit', function (event) {
								event.preventDefault();
								instance.requestPaymentMethod(function (err, payload) {
							  		if (err) {
							    		console.log('Request Payment Method Error', err);
							    		return;
							  		}
							  		// Add the nonce to the form and submit
							  		document.querySelector('#nonce').value = payload.nonce;
							  		form.submit();
								});
							});
						});
					}

					// rewrite price in page
					$('.prices-container .original_price').css({
						'text-decoration': 'line-through',
						'color': '#cccccc',
					});
					$('.discounted_price').show();
					$('.discounted_price .price').text('€ '+total_price_usd);

				} else {
					$('#success_div').hide();
					$('#submit_promo').text('Check Availability');
					$("#code_error").html('');
					try {
						response = JSON.parse(response);
					} catch(e) {
						response = JSON.stringify(response);
						response = JSON.parse(response);
					}
					console.log(response);
					if(typeof response.service_id != 'undefined') {
						$("#code_error").append('<p style="color:red;" >'+response.service_id+'</p>');
					}
					if(typeof response.code != 'undefined') {
						$("#code_error").append('<p style="color:red;" >'+response.code+'</p>');
					}
					if(typeof response.code_error != 'undefined') {
						$("#code_error").append('<p style="color:red;" >'+response.code_error+'</p>');
					}
				}
			}
		});  
	});


	// email check
	var emailCheckBtn = $('#email-check');
	var email_notif = $('.check-email-validation');
	var login = $('.login-wrap');
	var register = $('.register-wrap');

	login.hide(); 
	register.hide();
	emailCheckBtn.on('click', function(e) {

		e.preventDefault();
		var email = $('[name="email"]').val();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
			}
		});

		$.ajax({
			url:'{{ route('email_check') }}',
			method:'POST',
			data:{'email': email},
			success:function(response) {
				email_notif.text('');

				if(response.user_status == 'registered') {
					login.show();
					login.find('input').attr('name','password');
					register.hide();
					register.find('input').removeAttr('name');
				} else if(response.user_status == 'not_registered') {
					login.hide();
					login.find('input').removeAttr('name','password');
					register.show();
					register.find('input.password').attr('name','password');
					register.find('input.password-confirmation').attr('name','password_confirmation');
				} else {
					email_notif.text('Unknown error');
					login.hide();
					login.find('input').removeAttr('name');
					register.hide();
					register.find('input').removeAttr('name');
				}
			},
			error:function(error) {
				email_notif.text(error.responseJSON.message);  // The given data was invalid
			}
		});
	});

	@if (session('login_failed') || session('register_failed'))
		emailCheckBtn.trigger('click');
	@endif
</script>
@endsection
