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
	                    <li>{{ session('error') }}</li>
	                </ul>
	            </div>
	        </div>
		@endif
	    @if (count($errors) > 0)
	        <div class="col-md-12">
	            <div class="alert alert-danger">
	                <ul>
	                    @foreach ($errors->all() as $error)
	                        <li>{{ $error }}</li>
	                    @endforeach
	                </ul>
	            </div>
	        </div>
	    @endif
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
		<input type="hidden" id="payment_method_nonce_paypal" name="payment_method_nonce_paypal" />
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
						<label>Name</label>
						@if($user != null)
							<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ $user->name }}">
						@else
							<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ old('name') }}">
						@endif
					</div>
					<div class="col-md-6 form-group has-feedback">
						<label>Surname</label>
						@if($user != null)
							<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ $user->surname }}">
						@else
							<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ old('surname') }}">
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group has-feedback">
						<label>Email</label>
						@if($user != null)
							<span class="precompiled">{{ $user->email }}</span>
						@else
							<input type="email" class="form-control" required  placeholder="Email" name="email" value="{{ old('email') }}">
						@endif
					</div>
					<div class="col-md-6 form-group has-feedback">
						<label>Fiscal Code</label>
						@if($userProfile  != null && $userProfile->pan  != null) 
							<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="{{ $userProfile->pan }}" title="fiscal code">
						@else 
							<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="{{ old('pan') }}" title="fiscal code">
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group has-feedback">
						<label>Invoice Address (Street and Number)</label>
						@if($userProfile != null && $userProfile->address  != null)
							<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="{{ $userProfile->address }}">{{ $userProfile->address }}</textarea>
						@else
							<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}">{{ old('address') }}</textarea>
						@endif
					</div>
					<div class="col-md-6 form-group has-feedback">
						<label>ZIP Code</label>
						@if($userProfile != null && $userProfile->zip_code  != null)
	                        <input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="{{ $userProfile->zip_code }}">
	                    @else
	                        <input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="{{ old('zip_code') }}">
	                    @endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group has-feedback">
						<label>City</label>
						@if($userProfile != null && $userProfile->city  != null)
							<input type="text" name="city" placeholder="City" required class="form-control" value="{{ $userProfile->city }}">
						@else
							<input type="text" name="city" placeholder="City" required class="form-control" value="{{ old('city') }}">
						@endif
					</div>
					<div class="col-md-6 form-group has-feedback">
						<label>Province</label>
						@if($userProfile != null && $userProfile->province  != null)
							<input type="text" name="province" placeholder="Prov" class="form-control" value="{{ $userProfile->province }}">
						@else
							<input type="text" name="province" placeholder="Prov" class="form-control" value="{{ old('province') }}">
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group has-feedback">
						<label>Country</label>
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
								<div class="price">
									{{ $service != null ? '€ '.$service->price : "" }}
								</div>
								<div class="vat-disclaimer">
									Include VAT 22% {{  $service != null ? '€ '.round(($service->vatprice(true) * 22/100), 2) : "" }}
								</div>
							@elseif(isset($video))
								<div class="price">
									{{  '€'.$video->price  }}
								</div>
								<div class="vat-disclaimer">
									Include VAT 22% {{ '€ '.round(($video->vatprice() * 22/100), 2)  }}
								</div>
							@elseif(isset($event))
								<div class="price">
									{{  '€'.$event->price  }}
								</div>
								<div class="vat-disclaimer">
									Include VAT 22% {{ '€ '.round(($event->vatprice() * 22/100), 2)  }}
								</div>
							@elseif(isset($package))
								<div class="price">
									{{  '€'.$package->price  }}
								</div>
								<div class="vat-disclaimer">
									Include VAT 22% {{ '€ '.round(($package->vatprice() * 22/100), 2)  }}
								</div>
							@else
								<div class="price">n.a.</div>
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
					@if($amount > 0)
						<div id="payment-method-div" class="form-group">
	                        <div class="payment-method-radios">
	                        	<input type="radio" value="1" id="paypal-method" name="payment_method"> Paypal <input id="card-method" type="radio" value="2" name="payment_method" style="margin-left: 25px;"> Credit Card
	                        </div>
	                    </div>
	                    <br/>
	                    <div id="payment-form" class="text-center"></div><!--js paypal button injection-->
	                    <div id="payment-form-card">
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <div class="form-group">
	                                <label for="credit_card_number">Number</label>
	                                <input id="credit_card_number" data-braintree-name="number" class="form-control" placeholder="4111111111111111">
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <div class="form-group">
	                                <label for="credit_card_cvv">CVV</label>
	                                <input id="credit_card_cvv" data-braintree-name="cvv" class="form-control" placeholder="100">
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <div class="form-group">
	                                <label for="credit_card_exp_date">Expiration date</label>
	                                <input id="credit_card_exp_date" data-braintree-name="expiration_date" class="form-control" placeholder="10/20">
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <div class="form-group">
	                                <label for="credit_card_postal_code">Postal code</label>
	                                <input id="credit_card_postal_code" data-braintree-name="postal_code" class="form-control" placeholder="94107">
	                            </div>
	                        </div>
	                        <div class="col-md-12">
	                            <div class="form-group">
	                                <label for="credit_card_card_holder">Card holder</label>
	                                <input id="credit_card_card_holder" data-braintree-name="cardholder_name" class="form-control" placeholder="John Smith">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="clearfix"></div>
	                    <hr/>
					@endif

				<div class="ligle_terms servic_Payment_method">
                    <span class="paymentOption_div">
                        <input   type="checkbox" required name="tos">
                            <i></i>
                            <b>I have read and accepted the General <a href="/terms-service" target="_blank">Terms and Conditions</a> and have read the <a href="/privacy-policy" target="_blank">Privacy Policy</a></b>
                    </span>
                    <span class="paymentOption_div">
                            <input  type="checkbox" required name="tos">
                            <i></i>
                            <b>I have read and accepted the terms pursuant to art. 1341 and 1342 of the Civil Code</b><br>
                            <div class="tos-disclaimer">
                            	Clausole vessatorie[C1]: Ai sensi e per gli effetti di cui agli artt. 1341 e 1342 Cod. Civ., il Cliente, dopo averne presa attenta e specifica conoscenza e visione, approva e ed accetta espressamente le seguenti clausole:<br/><br/> 1)  Registrazione al Sito e conclusione del contratto di fornitura dei Servizi riservati agli Utenti e dei Servizi a Pagamento; 2) Modalità di registrazione; 3) Caratteristiche dei servizi; 4) Corrispettivi e modalità di pagamento dei Servizi a Pagamento; 5) Attivazione ed erogazione del servizio; 6) Durata, rinnovo, cessazione, recesso dal contratto; 7) Utilizzo dei blog; 8) Tutela minori; 9) Funzionalità dei Servizi; 10) Modifiche dei servizi e variazioni alle condizioni dell'offerta; 11) Cessione del Contratto; 12) Diritti di proprietà industriale e/o intellettuale – contenuti scaricabili; 13) Limitazione della responsabilità; 14) Sospensione del Servizio; 15) Dati del Cliente; 16) Limitazioni di responsabilità di Gielle; 17) Clausola risolutiva espressa; 18) Disposizioni finali e comunicazioni 19) Legge applicabile e Foro competente.
                            </div>
                    </span>
                    <span class="paymentOption_div">
                        <input  type="checkbox" value="1" name="allow_personal_data">
                            <i></i>
                            <b>I give my consent to the processing of my personal data for marketing purposes and trade in such Regulations (optional)</b>
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

	{{-- OLD STYLES CODE --}}
	{{--
		<!--div class="row">
			<div class="col-md-12">	
				<div id="success_div" style="display: none;">
					<div class="alert alert-success" id="success_data"></div>
				</div>
			</div>
		</div-->
		<!--div class="login_and_register_div">
			<div class="pull-right">
				<a id="have_promo" class="btn btn-success">
					Have a Promo Code?
				</a>
			</div>
			<div id="promo_div" style="display: {{ isset($code) ? '' : 'none' }};">
				<div class="col-md-8">
					<form id="promo_form" action="{{ url('service/checkcode') }}" method="POST">
						{{ csrf_field() }}
						<input type="text" class="form-control" id="code" value="{{ isset($code) ? $code : '' }}" name="code" placeHolder="Enter Code"/>
						<div class="error" id="code_error"></div>
					</form>
				</div>
				<div class="col-md-4">
					<button class="btn btn-success" id="submit_promo">
						Apply Now
					</button>
					<button class="btn btn-success" id="cancel_promo">
						Cancel
					</button>
				</div>
			</div>
			<div class="clearfix"></div>
		</div-->
	
		<div class="row">
			
		    @if(session('error'))
		        <div class="col-md-12">
		            <div class="alert alert-danger">
		                <ul>
		                    <li>{{ session('error') }}</li>
		                </ul>
		            </div>
		        </div>
			@endif
		    @if (count($errors) > 0)
		        <div class="col-md-12">
		            <div class="alert alert-danger">
		                <ul>
		                    @foreach ($errors->all() as $error)
		                        <li>{{ $error }}</li>
		                    @endforeach
		                </ul>
		            </div>
		        </div>
		    @endif
		    
			<form id="checkout" class="Credit_Card" action="{{ $url }}" method="post">
				<!--input type="hidden" id="payment_method_nonce_paypal" name="payment_method_nonce_paypal"-->
		        <div class="col-lg-7 col-sm-8 col-xs-12">
					<div class="right_service_details">
						<!--div class="section_heading">
							<span class="fa-stack fa-lg">
							  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
							  <i class="fa fa-check" aria-hidden="true"></i>
							</span>{{ $page_title }}  ZZZZZ
						</div-->
						
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
						
	                    {{ csrf_field() }}
						<!--input type="hidden" name="code_id" id="code_id" value="{{ isset($code) ? $code : "" }}"-->
						
							<div class="form-group has-feedback" style="margin-top: 20px">
								<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:0;">
									<label for="name">Name</label>
									@if($user != null)
										<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ $user->name }}">
									@else
										<input type="text" class="form-control" required placeholder="Name" name="name" value="{{ old('name') }}">
									@endif
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12" style="padding-right:0;">
									<label for="surname">Surname</label>
									@if($user != null)
										<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ $user->surname }}">
									@else
										<input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ old('surname') }}">
									@endif
								</div>
							</div>
						
						
							<div class="form-group has-feedback email">
								<label for="email">Email</label>
								@if($user == null)
									<input type="email" class="form-control" required  placeholder="Email" name="email" value="{{ old('email') }}">
								@else
									<span class="form-control" > {{ $user->email }}</span>
								@endif
							</div>
						
							@if($user == null)
								<div class="form-group has-feedback ">
									<label for="password">Password</label>
									<input type="password" class="form-control" required placeholder="Password" name="password">
								</div>
								<div class="form-group has-feedback">
									<label>Confirm Password</label>
									<input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation">
								</div>
							@endif
						
						
							<div class="form-group has-feedback ">
								<label for="pan"> Tax Code / Fiscal Code</label>
								@if($userProfile  != null && $userProfile->pan  != null) 
									<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="{{ $userProfile->pan }}" title="fiscal code">
								@else 
									<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="{{ old('pan') }}" title="fiscal code">
								@endif 
							</div>
						
						
							<div class="form-group has-feedback ">
								<label for="company">Company <span style="font-size: 70%;">(If Applicable)</span></label>
								@if($userProfile != null && $userProfile->company  != null)
									<input type="text" class="form-control"  placeholder="Company" name="company" value="{{ $userProfile->company }}">
								@else
									<input type="text" class="form-control"  placeholder="Company" name="company" value="{{ old('company') }}">
								@endif
							</div>
							<div class="form-group has-feedback ">
								<label for="vat">VAT <span style="font-size: 70%;">(Required if 'Company' is compiled)</span></label>
								@if($userProfile != null && $userProfile->vat  != null)
									<input type="text" class="form-control" placeholder="VAT number" name="vat" value="{{ $userProfile->vat }}">
								@else
									<input type="text" class="form-control" placeholder="VAT number" name="vat" value="{{ old('vat') }}">
								@endif
							</div>
						
						
							<div class="form-group has-feedback ">
								<label for="address">Invoice Address</label>
								@if($userProfile != null && $userProfile->address  != null)
									<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="{{ $userProfile->address }}">
										{{ $userProfile->address }}
									</textarea>
								@else
									<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}">
										{{ old('address') }}
									</textarea>
								@endif
							</div>
						
						
							<div class="form-group has-feedback email">
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
						
						
							<div class="form-group has-feedback">
								<label for="city" style="display: block; padding-top: 20px;"> City</label>
								@if($userProfile != null && $userProfile->city  != null)
									<input type="text" name="city" placeholder="City" required class="form-control" value="{{ $userProfile->city }}">
								@else
									<input type="text" name="city" placeholder="City" required class="form-control" value="{{ old('city') }}">
								@endif
							</div>
						
						
			                <div class="form-group has-feedback ">
			                    <label for="zip_code">ZIP Code</label>
			                    @if($userProfile != null && $userProfile->zip_code  != null)
			                        <input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="{{ $userProfile->zip_code }}">
			                    @else
			                        <input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="{{ old('zip_code') }}">
			                    @endif
			                </div>
		                
		        	</div>
		    	</div>
		    	<div class="col-lg-5 col-sm-4 col-xs-12">
		    		
				    	<div class="right_service_details">
						    <div class="section_heading">
							    <span class="fa-stack fa-lg">
							      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
							     <i class="fa fa-check" aria-hidden="true"></i>
							    </span>Your Order
							</div>
						    <ul class="service_order">
			                    @if(isset($service))
				                    <li>
				                    	<span>Service</span>
				                        <span class="service-name">{!! $service != null ? $service->name : "" !!}</span>
				                    </li>
				                    <li>
				                    	<span>Price</span>
				                        <span>{{ $service != null ? '€'.round($service->vatprice(),2) : ""}}</span>
				                    </li>
				                    <li>
				                    	<span>Vat</span>
				                        <span>{{  $service != null ? '€'.round(($service->vatprice(true) * 22/100), 2) : "" }}</span>
				                    </li>
				                    <li>
				                    	<span>Total Price</span>
				                        <span id="total_price">{{ $service != null ? '€'.$service->price : "" }} </span>
				                    </li>
			                    @elseif(isset($video))
			                        <li>
			                        	<span class="service-name">Video Name</span>
			                            <span >{!! $video->video_title !!}</span>
			                        </li>
			                        <li>
			                        	<span>Price</span>
			                            <span>{{ '€'.round($video->vatprice(), 2) }}</span>
			                        </li>
			                        <li>
			                        	<span>Vat</span>
			                            <span>{{ '€'.round(($video->vatprice() * 22/100), 2)  }}</span>
			                        </li>
			                        <li>
			                        	<span>Total Price</span>
			                            <span id="total_price">{{  '€'.$video->price  }} </span>
			                        </li>
			                    @elseif(isset($event))
			                        <li>
			                        	<span class="service-name">Event Name</span>
			                            <span>{!! $event->name !!}</span>
			                        </li>
			                        <li>
			                        	<span>Price</span>
			                            <span>{{ '€'.round($event->vatprice(), 2) }}</span>
			                        </li>
			                        <li>
			                        	<span>Vat</span>
			                            <span>{{ '€'.round(($event->vatprice() * 22/100), 2)  }}</span>
			                        </li>
			                        <li>
			                        	<span>Total Price</span>
			                            <span id="total_price">{{  '€'.$event->price  }} </span>
			                        </li>
			                    @elseif(isset($package))
			                        <li>
			                        	<span class="service-name">Package Name</span>
			                            <span>{!! $package->title !!}</span>
			                        </li>
			                        <li>
			                        	<span>Price</span>
			                            <span>{{ '€'.round($package->vatprice(), 2) }}</span>
			                        </li>
			                        <li>
			                        	<span>Vat</span>
			                            <span>{{ '€'.round(($package->vatprice() * 22/100), 2)  }}</span>
			                        </li>
			                        <li>
			                        	<span>Total Price</span>
			                            <span id="total_price">{{  '€'.$package->price  }} </span>
			                        </li>
			                    @else
			                        <li>
			                        	<span>Service</span>
			                        <span id="selected_service_name"></span>
				                    </li>
				                    <li>
				                    	<span>Price</span>
				                        <span id="selected_service_amount"></span>
				                    </li>
				                    <li>
				                    	<span>Vat</span>
				                        <span id="selected_service_vat"></span>
				                    </li>
				                    <li>
				                    	<span>Total Price</span>
				                        <span id="total_price"></span>
				                    </li>
			                    @endif


			                    <li id="discount_avail" style="display: {{ isset($discount_amount) ? '' : 'none' }};"><span>Discount</span><span id="discount_value">{{ isset($discount_amount) ? '€'.$discount_amount : '0.00' }}</span></li>
							    <li id="total_price_new" style="display: {{ isset($discount_amount) ? '' : 'none' }};"><span>Discounted Amount</span><span id="total_price_value_new">{{ isset($amount) ? '€'.$amount : '0.00' }}</span></li>
						    </ul>
						    <style>
						    	.service_order .service-name { padding: 0 15px; background-color: #5cb85c; color: #fff; }
						    </style>
				        </div>
			        
			        <div class="right_service_details">
				        <div class="section_heading">Payment Method</div><br/>
				        
							@php 
								$price = $amount 
							@endphp
						
						
			                @if(isset($service))
			                    @if(is_object($service) && !empty($service))
			                        @if($service->price > 0 )@endif
			                    @endif
			                @endif
			                @if(isset($video))
			                    @if(is_object($video) && !empty($video))
			                        @if($video->price > 0 )@endif
			                    @endif
			                @endif
			                @if(isset($event))
			                    @if(is_object($event) && !empty($event))
			                        @if($event->price > 0 )@endif
			                    @endif
			                @endif
			                @if(isset($package))
			                    @if(is_object($package) && !empty($package))
			                        @if($package->price > 0 )@endif
			                    @endif
			                @endif
						

						
			                @if($amount > 0)
			                	
			                    <div id="payment-method-div" class="form-group">
			                        <div class="col-md-12">
			                        	<input checked type="radio" value="1" id="paypal-method" name="payment_method"> Paypal <input id="card-method" type="radio" value="2" name="payment_method"> Credit Card
			                        </div>
			                    </div>
			                    <br/>
			                    <div id="payment-form" class="text-center"></div><!--js paypal button injection-->
			                    <div id="payment-form-card">
			                        <div class="col-md-6 col-sm-6 col-xs-12">
			                            <div class="form-group">
			                                <label for="credit_card_number">Number</label>
			                                <input name="credit_card_number" data-braintree-name="number" class="form-control" placeholder="4111111111111111">
			                            </div>
			                        </div>
			                        <div class="col-md-6 col-sm-6 col-xs-12">
			                            <div class="form-group">
			                                <label for="credit_card_cvv">CVV</label>
			                                <input name="credit_card_cvv" data-braintree-name="cvv" class="form-control" placeholder="100">
			                            </div>
			                        </div>
			                        <div class="col-md-6 col-sm-6 col-xs-12">
			                            <div class="form-group">
			                                <label for="credit_card_exp_date">Expiration date</label>
			                                <input name="credit_card_exp_date" data-braintree-name="expiration_date" class="form-control" placeholder="10/20">
			                            </div>
			                        </div>
			                        <div class="col-md-6 col-sm-6 col-xs-12">
			                            <div class="form-group">
			                                <label for="credit_card_postal_code">Postal code</label>
			                                <input name="credit_card_postal_code" data-braintree-name="postal_code" class="form-control" placeholder="94107">
			                            </div>
			                        </div>
			                        <div class="col-md-12">
			                            <div class="form-group">
			                                <label for="credit_card_card_holder">Card holder</label>
			                                <input name="credit_card_card_holder" data-braintree-name="cardholder_name" class="form-control" placeholder="John Smith">
			                            </div>
			                        </div>
			                    </div>

					            <!--div class="clearfix"></div>
						        <hr/-->
					        @endif
					    

					    
			                <div class="ligle_terms servic_Payment_method">
			                    <span class="paymentOption_div">
			                        <input   type="checkbox" required name="tos">
			                            <i></i>
			                            <b>I have read and accepted the General <a href="/terms-service" target="_blank">Terms and Conditions</a> and have read the <a href="/privacy-policy" target="_blank">Privacy Policy</a></b>
			                    </span>
			                    <span class="paymentOption_div">
			                            <input  type="checkbox" required name="tos">
			                            <i></i>
			                            <b>I have read and accepted the terms pursuant to art. 1341 and 1342 of the Civil Code</b><br>
			                            <div style="overflow:scroll; max-height:50px; overflow-style:marquee-line;font-size:8px; line-height:10px;"><span>Clausole vessatorie[C1]: Ai sensi e per gli effetti di cui agli artt. 1341 e 1342 Cod. Civ., il Cliente, dopo averne presa attenta e specifica conoscenza e visione, approva e ed accetta espressamente le seguenti clausole: 2)  Registrazione al Sito e conclusione del contratto di fornitura dei Servizi riservati agli Utenti e dei Servizi a Pagamento; 4) Modalità di registrazione; 5) Caratteristiche dei servizi; 6) Corrispettivi e modalità di pagamento dei Servizi a Pagamento; 7) Attivazione ed erogazione del servizio; 8) Durata, rinnovo, cessazione, recesso dal contratto; 9) Utilizzo dei blog; 10) Tutela minori; 11) Funzionalità dei Servizi; 12) Modifiche dei servizi e variazioni alle condizioni dell'offerta; 13) Cessione del Contratto; 14) Diritti di proprietà industriale e/o intellettuale – contenuti scaricabili; 15) Limitazione della responsabilità; 16) Sospensione del Servizio; 17) Dati del Cliente; 18) Limitazioni di responsabilità di Gielle; 20) Clausola risolutiva espressa; 21) Disposizioni finali e comunicazioni 22) Legge applicabile e Foro competente.</span></div>
			                    </span>
			                    <span class="paymentOption_div">
			                        <input  type="checkbox" value="1" name="allow_personal_data">
			                            <i></i>
			                            <b>I give my consent to the processing of my personal data for marketing purposes and trade in such Regulations (optional)</b>
			                    </span>
			                </div>
		                

		                
			                @if(isset($service))
			                    <button  value="Pay $@if(is_object($service) && !empty($service)){{ $service->usdprice($service->currency_type, 'USD', $service->price) }}@endif" type="submit" class="order_now">
			                        @if(is_object($service) && !empty($service))
			                            @if($service->usdprice($service->currency_type, 'USD', $service->price) > 0 )
			                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
			                            @else
			                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Get Now
			                            @endif
			                        @endif
			                    </button>
			                @elseif(isset($video))
			                    <button  value="Pay $@if(is_object($video) && !empty($video)){{ round(\App\Service::usdprice('EUR', 'USD', $video->price)) }}@endif" type="submit"
			                             class="order_now">
			                        @if(is_object($video) && !empty($video))
			                            @if(\App\Service::usdprice('EUR', 'USD', $video->price) > 0 )
			                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
			                            @else
			                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Get Now
			                            @endif
			                        @endif
			                    </button>
			                @elseif(isset($event))
			                    <button  value="Pay $@if(is_object($event) && !empty($event)){{ round(\App\Service::usdprice('EUR', 'USD', $event->price)) }}@endif" type="submit"
			                             class="order_now">
			                        @if(is_object($event) && !empty($event))
			                            @if(\App\Service::usdprice('EUR', 'USD', $event->price) > 0 )
			                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
			                            @else
			                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Get Now
			                            @endif
			                        @endif
			                    </button>
			                @elseif(isset($package))
		                        <button  value="Pay $@if(is_object($package) && !empty($package)){{ round(\App\Service::usdprice('EUR', 'USD', $package->price)) }}@endif" type="submit"
		                                 class="order_now">
		                            @if(is_object($package) && !empty($package))
		                                @if(\App\Service::usdprice('EUR', 'USD', $package->price) > 0 )
		                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
		                                @else
		                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Get Now
		                                @endif
		                            @endif
		                        </button>
			                @else
			                    <button  id="submit-button" value="" type="submit" class="order_now">
			                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
			                    </button>
			                @endif
		                
		            </div>
		        </div>
		    </form>
		</div>
	--}} 
</div>

@php 
	$clientToken = Braintree_ClientToken::generate();
@endphp






<script src="{{ asset('frontend/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
<!--script src="https://js.braintreegateway.com/js/braintree-2.27.0.min.js"></script-->
<script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
<!--script src="https://js.braintreegateway.com/web/dropin/1.19.0/js/dropin.min.js"></script-->
<script>
	console.log('start');

    var clientToken = "{{ $clientToken }}";
    var price = $('#selected_service_price').val();
    var paymentFormCard = $('#payment-form-card');
    var paymentFormPaypal = $('#payment-form');
    var checkoutPP;
    var checkoutCC;

    paymentFormPaypal.hide();
    paymentFormCard.hide();

	{{-- https://developers.braintreepayments.com/guides/credit-cards/client-side/javascript/v2 --}}


 	// if paypal checked on FIRST page load ..
    /*if($("#paypal-method").is(":checked")) {
      	// $('form').attr('id','');
        $("#payment-form").show();
        $("#payment-form-card").hide();

        //new
        $('#payment-form').empty();
	    //braintree.setup(clientToken, 'custom', {id: 'checkout-form'});
	    braintree.setup(clientToken, "custom", {
	    	id: 'checkout-form',
	        onReady: function (integration) {
	            checkout = integration;
	        },
	        paypal: {
	            container: "payment-form",
	            singleUse: true,
	            amount: price,
	            currency: 'EUR',
	        },
	        onPaymentMethodReceived: function (obj) {
	            setNonce(obj.nonce);
	        }
	    });
    }*/

    // if credit card checked on FIRST page load..
    /*if($("#card-method").is(":checked")) {
        // $('form').attr('id','checkout');
        $("#payment-form-card").show();
        $("#payment-form").hide();
        $("#payment-form-card").find('input').attr('required', true);
        
        //new
        //braintree.setup(clientToken, 'custom', {id: 'checkout-form'});
	    braintree.setup(clientToken, 'custom', {
	    	id: 'checkout-form',
	      	// onReady: function (integration) {
	       	//     checkout = integration;
	       	// },
	       	onPaymentMethodReceived: function (obj) {
		        //setNonce(obj.nonce);
		        $("#payment_method_nonce").val(obj.nonce);
		    }
	    });
    }*/






    // radio buttons --> ON CHANGE ...
    $("[name=payment_method]").change(function () {
        if($("#paypal-method").is(":checked")) {
            paymentFormPaypal.show();
            paymentFormCard .hide();
            paymentFormCard.find('input').attr('required', false);
            paymentFormPaypal.empty();

            if(checkoutCC) {
            	checkoutCC.teardown(function () {
	            	checkoutCC = null;
	            	// braintree.setup can safely be run again!
	        	});
            }
            
            braintree.setup(clientToken, 'custom', {id: 'checkout-form'});
		    braintree.setup(clientToken, "custom", {
		        onReady: function (integration) {
		            checkoutPP = integration;
		        },
		        paypal: {
		            container: "payment-form",
		            singleUse: true,
		            amount: price,
		            currency: 'EUR',
		        },
		        onPaymentMethodReceived: function (obj) {
		            setNoncePaypalInTheForm(obj.nonce);
		        }
		    });
        }

        if($("#card-method").is(":checked")) {
        	if(paymentFormPaypal.lenght) {
        		paymentFormPaypal.hide();
        		paymentFormPaypal.empty();
        	}
            paymentFormCard.show();
			paymentFormCard.find('input').attr('required', true);

			if(checkoutPP) {
            	checkoutPP.teardown(function () {
	            	checkoutPP = null;
	            	// braintree.setup can safely be run again!
	        	});
            }
            
            braintree.setup(clientToken, 'custom', {id: 'checkout-form'});
            braintree.setup(clientToken, 'custom', { 
          		onReady: function (integration) {
          			checkoutCC = integration;
          		},
            	onPaymentMethodReceived: function (obj) {
		            setNonceCreditCardInTheForm(obj.nonce);  
		        }
            });
        }
    });



</script>
<script>

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': "{{ csrf_token() }}"
		}
	});
	
	$("#have_promo").click(function(){
		$("#promo_div").show();
	});
	$("#cancel_promo").click(function(){
		$("#promo_div").hide();
	});

	function setNoncePaypalInTheForm(nonce) {  
	    //console.log('Paypal nonce: '+nonce);
	    $('input[name="payment_method_nonce"]').val('');
		$('input[name="payment_method_nonce_paypal"]').val(nonce);
	}
	function setNonceCreditCardInTheForm(nonce) {  
	    //console.log('Credit Card nonce: '+nonce);
	    $('input[name="payment_method_nonce_paypal"]').val('');
		$('input[name="payment_method_nonce"]').val(nonce);
	}

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
						$("#braintree-dropin-frame").remove();

						$('#payment-form').empty();
						braintree.setup(clientToken, "custom", {
							onReady: function (integration) {
								checkout = integration;
							},
							paypal: {
								container: "payment-form",
								singleUse: true,
								amount: total_price_usd, //response.amount,
								currency: 'EUR'
							},
							onPaymentMethodReceived: function (obj) {
								setNonce(obj.nonce);
							}
						});

						if($("#card-method").is(":checked")) {
							$("#payment-method-div").show();
							$("#payment-form-card").show();
						}
					} else {
	                    // When you are ready to tear down your integration
		                checkout.teardown(function () {
		                    checkout = null;
		                    // braintree.setup can safely be run again!
		                });
						$("input[type='radio'][name='payment_method']").removeAttr('checked');
						$("#payment-method-div").hide();
						$("#payment-form-card").hide();
		                $("#note").hide();
		                $('#braintree-dropin-frame').contents().find('#expiration').val('myValue');
		                $("#braintree-dropin-frame").hide();
		                $("#credit-card-number").val(0);
		                $("#expiration").val(20 / 2020);
					}
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

	$(function() {
	    console.log('end --> ok no error');
	});
</script>

@endsection
