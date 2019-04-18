<?php $__env->startSection('content'); ?>
</header>
</div>
<div class="container">
	<div id="success_div" style="display: none;">
		<div class="alert alert-success" id="success_data"></div>
	</div>
    <?php if(!isset($service) && !isset($package) && !isset($event) && !isset($video)): ?>
        <div class="select-div">
            <div class="form-group has-feedback ">
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0;">
                    <div class="col-md-9 col-md-offset-2">
                        <select class="form-control" name="select_service_id" id="select_service_id">
                            <option>---Select Service---</option>
                            <?php $__currentLoopData = \App\Service::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $select_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($select_service->id); ?>"> <?php echo e($select_service->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
		<div class="login_and_register_div">
			<p>Please register and refill all the required fields in order to proceed to Checkout.
				<span class="pull-right"><?php if(!Auth::check()): ?>
					Already Have an Account? <a class="btn btn-primary" href="<?php echo e(url('auth/login')); ?>">Login</a>
				<?php endif; ?>
				<a class="btn btn-success" id="have_promo">
					Have a Promo Code?
				</a>
					</span>
			</p>
			<div id="promo_div" style="display: <?php echo e(isset($code) ? '' : 'none'); ?>;">
				<div class="col-md-8">
				<form id="promo_form" action="<?php echo e(url('service/checkcode')); ?>" method="POST">
					<?php echo e(csrf_field()); ?>

					<input type="text" class="form-control" id="code" value="<?php echo e(isset($code) ? $code : ''); ?>" name="code" placeHolder="Enter Code"/>
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
		</div>
		<div class="row">
		    <?php if(session('error')): ?>
		        <div class="col-md-12">
		            <div class="alert alert-danger">
		                <ul>
		                    <li><?php echo e(session('error')); ?></li>
		                </ul>
		            </div>
		        </div>
			<?php endif; ?>
		    <?php if(count($errors) > 0): ?>
		        <div class="col-md-12">
		            <div class="alert alert-danger">
		                <ul>
		                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                        <li><?php echo e($error); ?></li>
		                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                </ul>
		            </div>
		        </div>
		    <?php endif; ?>
			<form id="checkout" class="Credit_Card" action="<?php echo e($url); ?>" method="post">
				<input type="hidden" id="payment_method_nonce_paypal" name="payment_method_nonce_paypal">
		        <div class="col-lg-7 col-sm-8 col-xs-12">
					<div class="right_service_details">
						<div class="section_heading">
							<span class="fa-stack fa-lg">
							  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
							  <i class="fa fa-check" aria-hidden="true"></i>
							</span><?php echo e($page_title); ?>

						</div>
							<?php if(isset($service)): ?>
									<input type="hidden" id="selected_service_price"  name="amount" value="<?php if(is_object($service) && !empty($service)): ?><?php echo e($amount); ?><?php endif; ?>">
									<input type="hidden" name="service_name" value="<?php if(is_object($service) && !empty($service)): ?><?php echo e($service->name); ?><?php endif; ?>">
									<input type="hidden" id="service_id" name="service_id" value="<?php if(is_object($service) && !empty($service)): ?><?php echo e($service->id); ?><?php endif; ?>">
									 <input type="hidden" id="service_type" name="service_type" value="<?php echo e(\App\OrderTransaction::TYPE_SERVICE); ?>">
		                              <input type="hidden" id="usdprice" value="<?php echo e(round($service->usdprice($service->currency_type,'USD',$service->price))); ?>">
								 <?php elseif(isset($video)): ?>
									  <input type="hidden" id="service_id" name="service_id" value="<?php if(is_object($video) && !empty($video)): ?><?php echo e($video->id); ?><?php endif; ?>">
									  <input type="hidden" id="selected_service_price"  name="amount" value="<?php if(is_object($video) && !empty($video)): ?><?php echo e($video->price); ?><?php endif; ?>">
										<br/>
									<img alt="<?php echo e($video->video_title); ?>" border="0" width="150" src="<?php echo e(asset($video->video_image)); ?>" />
									  <input type="hidden" id="service_type" name="service_type" value="<?php echo e(\App\OrderTransaction::TYPE_VIDEO); ?>">
		                              <input type="hidden" id="usdprice" value="<?php echo e(round(App\Service::usdprice('EUR','USD',$video->price))); ?>">
		                          <?php elseif(isset($event)): ?>
		                              <input type="hidden" id="service_id" name="service_id" value="<?php if(is_object($event) && !empty($event)): ?><?php echo e($event->id); ?><?php endif; ?>">
		                              <input type="hidden" id="selected_service_price"  name="amount" value="<?php if(is_object($event) && !empty($event)): ?><?php echo e($event->price); ?><?php endif; ?>">
										<br/>
							          <img alt="<?php echo e($event->name); ?>" border="0" width="150" src="<?php echo e(asset($event->image_file)); ?>" />
		                              <input type="hidden" id="service_type" name="service_type" value="<?php echo e(\App\OrderTransaction::TYPE_EVENT); ?>">
		                              <input type="hidden" id="usdprice" value="<?php echo e(round(App\Service::usdprice('EUR','USD',$event->price))); ?>">
		                          <?php elseif(isset($package)): ?>
							<input type="hidden" id="service_id" name="service_id" value="<?php if(is_object($package) && !empty($package)): ?><?php echo e($package->id); ?><?php endif; ?>">
							<input type="hidden" id="selected_service_price"  name="amount" value="<?php if(is_object($package) && !empty($package)): ?><?php echo e($package->price); ?><?php endif; ?>">
							<br/>
							<input type="hidden" id="service_type" name="service_type" value="<?php echo e(\App\OrderTransaction::TYPE_PACKAGE); ?>">
							<input type="hidden" id="usdprice" value="<?php echo e(round(App\Service::usdprice('EUR','USD',$package->price))); ?>">

							<div class="clearfix"></div>
							<br/>
									  <input type="hidden" id="selected_service_price"  name="amount" value="">
		                              <input type="hidden" id="service_type" name="service_type" value="<?php echo e(\App\OrderTransaction::TYPE_SERVICE); ?>">
		                              <input type="hidden" id="usdprice" value="">
									  <input type="hidden" id="service_id" name="service_id">
								  <?php endif; ?>
		                          	<?php echo e(csrf_field()); ?>

								  	<input type="hidden" name="code_id" id="code_id" value="<?php echo e(isset($code) ? $code : ""); ?>">
									<div class="form-group has-feedback" style="margin-top: 20px">
										<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:0;">
											<label for="name">Name</label>
											<?php if($user != null): ?>
												<input type="text" class="form-control" required placeholder="Name" name="name" value="<?php echo e($user->name); ?>">
											<?php else: ?>
												<input type="text" class="form-control" required placeholder="Name" name="name" value="<?php echo e(old('name')); ?>">
											<?php endif; ?>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12" style="padding-right:0;">
											<label for="surname">Surname</label>
											<?php if($user != null): ?>
												<input type="text" class="form-control" required placeholder="Surname" name="surname" value="<?php echo e($user->surname); ?>">
											<?php else: ?>
												<input type="text" class="form-control" required placeholder="Surname" name="surname" value="<?php echo e(old('surname')); ?>">
											<?php endif; ?>
										</div>
									</div>

									<div class="form-group has-feedback email">
										<label for="email">Email</label>
										<?php if($user == null): ?>
											<input type="email" class="form-control" required  placeholder="Email" name="email" value="<?php echo e(old('email')); ?>">
										<?php else: ?>
											<span class="form-control" > <?php echo e($user->email); ?></span>
										<?php endif; ?>
									</div>
									<?php if($user == null): ?>
										<div class="form-group has-feedback ">
											<label for="password">Password</label>
											<input type="password" class="form-control" required placeholder="Password" name="password">
										</div>
										<div class="form-group has-feedback">
											<label>Confirm Password</label>
											<input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation">
										</div>
									<?php endif; ?>

									<div class="form-group has-feedback ">
										<label for="pan"> Tax Code / Fiscal Code</label>
										<?php if($userProfile  != null && $userProfile->pan  != null): ?> 
											<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="<?php echo e($userProfile->pan); ?>" title="fiscal code">
										<?php else: ?> 
											<input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="<?php echo e(old('pan')); ?>" title="fiscal code">
										<?php endif; ?> 
									</div>
									<div class="form-group has-feedback ">
										<label for="company">Company <span style="font-size: 70%;">(If Applicable)</span></label>
										<?php if($userProfile != null && $userProfile->company  != null): ?>
											<input type="text" class="form-control"  placeholder="Company" name="company" value="<?php echo e($userProfile->company); ?>">
										<?php else: ?>
											<input type="text" class="form-control"  placeholder="Company" name="company" value="<?php echo e(old('company')); ?>">
										<?php endif; ?>
									</div>
									<div class="form-group has-feedback ">
										<label for="vat">VAT <span style="font-size: 70%;">(Required if 'Company' is compiled)</span></label>
										<?php if($userProfile != null && $userProfile->vat  != null): ?>
											<input type="text" class="form-control" placeholder="VAT number" name="vat" value="<?php echo e($userProfile->vat); ?>">
										<?php else: ?>
											<input type="text" class="form-control" placeholder="VAT number" name="vat" value="<?php echo e(old('vat')); ?>">
										<?php endif; ?>
									</div>
									
									<div class="form-group has-feedback ">
										<label for="address">Invoice Address</label>
										<?php if($userProfile != null && $userProfile->address  != null): ?>
											<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="<?php echo e($userProfile->address); ?>"><?php echo e($userProfile->address); ?></textarea>
										<?php else: ?>
										<textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="<?php echo e(old('address')); ?>"><?php echo e(old('address')); ?></textarea>
										<?php endif; ?>
									</div>
									<div class="form-group has-feedback email">
										<label for="country">Country</label>
										<?php if(count($country_list) > 0): ?>
											<select name="country" id="country" required class="form-control" style="clear: both;">
												<option value="">Select Country</option>
												<?php $__currentLoopData = $country_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php if($userProfile != null && $userProfile->country  != null): ?>
														<option <?php if($userProfile->country == $country['country_name']): ?> selected="selected" <?php endif; ?> value = "<?php echo e($country['country_name']); ?>"><?php echo e($country['country_name']); ?></option>
													<?php else: ?>
														<option <?php if(old('country') == $country['country_name']): ?> selected="selected" <?php endif; ?> value = "<?php echo e($country['country_name']); ?>"><?php echo e($country['country_name']); ?></option>
													<?php endif; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										<?php endif; ?>
									</div>

						<div class="form-group has-feedback">
							<label for="city" style="display: block; padding-top: 20px;"> City</label>
							<?php if($userProfile != null && $userProfile->city  != null): ?>
								<input type="text" name="city" placeholder="City" required class="form-control" value="<?php echo e($userProfile->city); ?>"> 
							<?php else: ?>
								<input type="text" name="city" placeholder="City" required="" class="form-control" value="<?php echo e(old('city')); ?>">
							<?php endif; ?>
						</div>

		                <div class="form-group has-feedback ">
		                    <label for="zip_code">ZIP Code</label>
		                    <?php if($userProfile != null && $userProfile->zip_code  != null): ?>
		                        <input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="<?php echo e($userProfile->zip_code); ?>">
		                    <?php else: ?>
		                        <input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="<?php echo e(old('zip_code')); ?>">
		                    <?php endif; ?>
		                </div>
		        	</div>
		    	</div>
		    	<div class="col-lg-5 col-sm-4 col-xs-12">
			    <div class="right_service_details">
				    <div class="section_heading">
					    <span class="fa-stack fa-lg">
					      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
					     <i class="fa fa-check" aria-hidden="true"></i>
					    </span>Your Order</div>
					    <ul class="service_order">
		                    <?php if(isset($service)): ?>
		                    <li><span>Service</span>
		                        <span class="service-name"><?php echo $service != null ? $service->name : ""; ?></span>
		                    </li>
		                    <li><span>Price</span>
		                        <span><?php echo e($service != null ? '€'.round($service->vatprice()) : ""); ?></span>
		                    </li>
		                    <li><span>Vat</span>
		                        <span><?php echo e($service != null ? '€'.round($service->vatprice(true) * 22/100) : ""); ?></span>
		                    </li>
		                    <li><span>Total Price</span>
		                        <span id="total_price"><?php echo e($service != null ? '€'.$service->price : ""); ?> </span>
		                    </li>
		                    <?php elseif(isset($video)): ?>
		                        <li><span class="service-name">Video Name</span>
		                            <span ><?php echo $video->video_title; ?></span>
		                        </li>
		                        <li><span>Price</span>
		                            <span><?php echo e('€'.$video->vatprice()); ?></span>
		                        </li>
		                        <li><span>Vat</span>
		                            <span><?php echo e('€'.round($video->vatprice() * 22/100)); ?></span>
		                        </li>
		                        <li><span>Total Price</span>
		                            <span id="total_price"><?php echo e('€'.$video->price); ?> </span>
		                        </li>
		                    <?php elseif(isset($event)): ?>
		                        <li><span class="service-name">Event Name</span>
		                            <span><?php echo $event->name; ?></span>
		                        </li>
		                        <li><span>Price</span>
		                            <span><?php echo e('€'.$event->vatprice()); ?></span>
		                        </li>
		                        <li><span>Vat</span>
		                            <span><?php echo e('€'.round($event->vatprice() * 22/100)); ?></span>
		                        </li>
		                        <li><span>Total Price</span>
		                            <span id="total_price"><?php echo e('€'.$event->price); ?> </span>
		                        </li>
		                    <?php elseif(isset($package)): ?>
		                        <li><span class="service-name">Package Name</span>
		                            <span><?php echo $package->title; ?></span>
		                        </li>
		                        <li><span>Price</span>
		                            <span><?php echo e('€'.$package->vatprice()); ?></span>
		                        </li>
		                        <li><span>Vat</span>
		                            <span><?php echo e('€'.round($package->vatprice() * 22/100)); ?></span>
		                        </li>
		                        <li><span>Total Price</span>
		                            <span id="total_price"><?php echo e('€'.$package->price); ?> </span>
		                        </li>
		                    <?php else: ?>
		                        <li><span>Service</span>
		                        <span id="selected_service_name"></span>
			                    </li>
			                    <li><span>Price</span>
			                        <span id="selected_service_amount"></span>
			                    </li>
			                    <li><span>Vat</span>
			                        <span id="selected_service_vat"></span>
			                    </li>
			                    <li><span>Total Price</span>
			                        <span id="total_price"></span>
			                    </li>
		                    <?php endif; ?>
		                    <li id="discount_avail" style="display: <?php echo e(isset($discount_amount) ? '' : 'none'); ?>;"><span>Discount</span><span id="discount_value"><?php echo e(isset($discount_amount) ? '€'.$discount_amount : '0.00'); ?></span></li>
						    <li id="total_price_new" style="display: <?php echo e(isset($discount_amount) ? '' : 'none'); ?>;"><span>Discounted Amount</span><span id="total_price_value_new"><?php echo e(isset($amount) ? '€'.$amount : '0.00'); ?></span></li>
					    </ul>
					    <style>
					    	.service_order .service-name { padding: 0 15px; background-color: #5cb85c; color: #fff; }
					    </style>
			        </div>
			        <div class="right_service_details">
				        <div class="section_heading">Payment Method</div><br/>
						<?php echo e($price = $amount); ?>

		                <?php if(isset($service)): ?>
		                    <?php if(is_object($service) && !empty($service)): ?>
		                        <?php if($service->price > 0 ): ?><?php endif; ?>
		                    <?php endif; ?>
		                <?php endif; ?>
		                <?php if(isset($video)): ?>
		                    <?php if(is_object($video) && !empty($video)): ?>
		                        <?php if($video->price > 0 ): ?><?php endif; ?>
		                    <?php endif; ?>
		                <?php endif; ?>
		                <?php if(isset($event)): ?>
		                    <?php if(is_object($event) && !empty($event)): ?>
		                        <?php if($event->price > 0 ): ?><?php endif; ?>
		                    <?php endif; ?>
		                <?php endif; ?>
		                <?php if(isset($package)): ?>
		                    <?php if(is_object($package) && !empty($package)): ?>
		                        <?php if($package->price > 0 ): ?><?php endif; ?>
		                    <?php endif; ?>
		                <?php endif; ?>
		                <?php if($price > 0): ?>
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

				            <div class="clearfix"></div>

		                    
		                    <?php
		                    	$clientToken = Braintree_ClientToken::generate();
		                    ?>
		                    <script src="https://js.braintreegateway.com/js/braintree-2.27.0.min.js"></script>

		                    <script>
		                    	console.log('start');
		                        var clientToken = "<?php echo e($clientToken); ?>"; //eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiI1Mjc3NzQ2ZjY5MzM5NzYzMWFmODYzYmUyZGU5ZGJmYTUzODE5ZDYxNjc0NTkyZmZhMjdkNWE4NTE3YzY2NDUyfGNyZWF0ZWRfYXQ9MjAxNi0wOC0yMlQwNTowOTowOS40NzgwNDMzNjIrMDAwMFx1MDAyNm1lcmNoYW50X2lkPTM0OHBrOWNnZjNiZ3l3MmJcdTAwMjZwdWJsaWNfa2V5PTJuMjQ3ZHY4OWJxOXZtcHIiLCJjb25maWdVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvMzQ4cGs5Y2dmM2JneXcyYi9jbGllbnRfYXBpL3YxL2NvbmZpZ3VyYXRpb24iLCJjaGFsbGVuZ2VzIjpbXSwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwiY2xpZW50QXBpVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzLzM0OHBrOWNnZjNiZ3l3MmIvY2xpZW50X2FwaSIsImFzc2V0c1VybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tIiwiYXV0aFVybCI6Imh0dHBzOi8vYXV0aC52ZW5tby5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIiwiYW5hbHl0aWNzIjp7InVybCI6Imh0dHBzOi8vY2xpZW50LWFuYWx5dGljcy5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tLzM0OHBrOWNnZjNiZ3l3MmIifSwidGhyZWVEU2VjdXJlRW5hYmxlZCI6dHJ1ZSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImRpc3BsYXlOYW1lIjoiQWNtZSBXaWRnZXRzLCBMdGQuIChTYW5kYm94KSIsImNsaWVudElkIjpudWxsLCJwcml2YWN5VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3BwIiwidXNlckFncmVlbWVudFVybCI6Imh0dHA6Ly9leGFtcGxlLmNvbS90b3MiLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJhbGxvd0h0dHAiOnRydWUsImVudmlyb25tZW50Tm9OZXR3b3JrIjp0cnVlLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJ1bnZldHRlZE1lcmNoYW50IjpmYWxzZSwiYnJhaW50cmVlQ2xpZW50SWQiOiJtYXN0ZXJjbGllbnQzIiwiYmlsbGluZ0FncmVlbWVudHNFbmFibGVkIjp0cnVlLCJtZXJjaGFudEFjY291bnRJZCI6ImFjbWV3aWRnZXRzbHRkc2FuZGJveCIsImN1cnJlbmN5SXNvQ29kZSI6IlVTRCJ9LCJjb2luYmFzZUVuYWJsZWQiOmZhbHNlLCJtZXJjaGFudElkIjoiMzQ4cGs5Y2dmM2JneXcyYiIsInZlbm1vIjoib2ZmIn0=";
		                        var price = $('#selected_service_price').val();
		                        var checkout;

								$('#payment-form').empty();
		                        braintree.setup(clientToken, 'custom', {id: 'checkout'});
		                        braintree.setup(clientToken, "custom", {
		                            onReady: function (integration) {
		                                checkout = integration;
		                                loginPayPalEffettuato = false;
		                                // checkAbilitazioneButtonOrderNow();
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

		                        if($("#paypal-method").is(":checked")) {
		                          //  $('form').attr('id','');
		                            $("#payment-form").show();
		                            $("#payment-form-card").hide();

		                        }
		                        if($("#card-method").is(":checked")) {
		                           // $('form').attr('id','checkout');
		                            $("#payment-form-card").show();
		                            $("#payment-form").hide();
		                            $("#payment-form-card").find('input').attr('required', true);
		                           /* checkout.teardown(function () {
		                                checkout = null;
		                                // braintree.setup can safely be run again!
		                            });
		                            var checkout;
		                            braintree.setupXXXXX(clientToken, 'custom', { onReady: function (integration) {
		                                checkout = integration;
		                            },id: 'checkout'});*/
		                        }
		                        $("[name=payment_method]").change(function () {
		                            if($("#paypal-method").is(":checked")) {
		                           //     $('form').attr('id','');
		                                $("#payment-form").show();
		                                $("#payment-form-card").hide();
		                                $("#payment-form-card").find('input').attr('required', false);


		                               /* checkout.teardown(function () {
		                                    checkout = null;
		                                    // braintree.setup can safely be run again!
		                                });
		                                var checkout;
		                                braintree.setupXXXXX(clientToken, "custom", {
		                                    onReady: function (integration) {
		                                        checkout = integration;
		                                    },
		                                    container: "payment-form",
		                                    paypal: {
		                                        container: "payment-form",
		                                        singleUse: true,
		                                        amount:price ,
		                                        currency: 'USD',

		                                    },
		                                    onPaymentMethodReceived: function (obj) {
		                                    setNonce(obj.nonce);
		                                }
		                                });*/
		                            }
		                            if($("#card-method").is(":checked")) {
		                                $("#payment-form-card").show();
		                                $("#payment-form").hide();
										$("#payment-form-card").find('input').attr('required', true);
		                                /*  checkout.teardown(function () {
		                                    checkout = null;
		                                    // braintree.setup can safely be run again!
		                                });
		                                var checkout;
		                                braintree.setupXXXXX(clientToken, 'custom', { onReady: function (integration) {
		                                    checkout = integration;
		                                },id: 'checkout'});*/
		                            }
		                        })
		                        // We generated a client token for you so you can test out this code
		                        // immediately. In a production-ready integration, you will need to
		                        // generate a client token on your server (see section below).
		                    </script>
					        <hr/>
				        <?php endif; ?>
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
		                <?php if(isset($service)): ?>
		                    <button  value="Pay $<?php if(is_object($service) && !empty($service)): ?><?php echo e($service->usdprice($service->currency_type, 'USD', $service->price)); ?><?php endif; ?>" type="submit"
		                             class="order_now">
		                        <?php if(is_object($service) && !empty($service)): ?>
		                            <?php if($service->usdprice($service->currency_type, 'USD', $service->price) > 0 ): ?>
		                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
		                            <?php else: ?>
		                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Get Now
		                            <?php endif; ?>
		                        <?php endif; ?>
		                    </button>
		                <?php elseif(isset($video)): ?>
		                    <button  value="Pay $<?php if(is_object($video) && !empty($video)): ?><?php echo e(round(\App\Service::usdprice('EUR', 'USD', $video->price))); ?><?php endif; ?>" type="submit"
		                             class="order_now">
		                        <?php if(is_object($video) && !empty($video)): ?>
		                            <?php if(\App\Service::usdprice('EUR', 'USD', $video->price) > 0 ): ?>
		                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
		                            <?php else: ?>
		                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Get Now
		                            <?php endif; ?>
		                        <?php endif; ?>
		                    </button>
		                <?php elseif(isset($event)): ?>
		                    <button  value="Pay $<?php if(is_object($event) && !empty($event)): ?><?php echo e(round(\App\Service::usdprice('EUR', 'USD', $event->price))); ?><?php endif; ?>" type="submit"
		                             class="order_now">
		                        <?php if(is_object($event) && !empty($event)): ?>
		                            <?php if(\App\Service::usdprice('EUR', 'USD', $event->price) > 0 ): ?>
		                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
		                            <?php else: ?>
		                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Get Now
		                            <?php endif; ?>
		                        <?php endif; ?>
		                    </button>
		                <?php elseif(isset($package)): ?>
		                                <button  value="Pay $<?php if(is_object($package) && !empty($package)): ?><?php echo e(round(\App\Service::usdprice('EUR', 'USD', $package->price))); ?><?php endif; ?>" type="submit"
		                                         class="order_now">
		                                    <?php if(is_object($package) && !empty($package)): ?>
		                                        <?php if(\App\Service::usdprice('EUR', 'USD', $package->price) > 0 ): ?>
		                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
		                                        <?php else: ?>
		                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Get Now
		                                        <?php endif; ?>
		                                    <?php endif; ?>
		                                </button>
		                <?php else: ?>
		                    <button  id="submit-button" value="" type="submit" class="order_now">
		                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Now
		                    </button>
		                <?php endif; ?>
		            </div>
		        </div>
		    </form>
		</div>
    <?php endif; ?>
</div>
<script src="<?php echo e(asset('frontend/js/jquery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/jquery.ui.js')); ?>"></script>
<script>

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
		}
	});
	
	$("#have_promo").click(function(){
		$("#promo_div").show();
	});
	$("#cancel_promo").click(function(){
		$("#promo_div").hide();
	});

	$("#select_service_id").change(function() {    // interviene SOLO SE non viene specificato nessun ID servizio nell'URL (..2..)
	    var val = $(this).val();
	    $("#service_id").val(val);
	    $.ajax({
	        url:"<?php echo e(url('service_detail')); ?>",
	        method:'POST',
	        _token:"<?php echo e(csrf_token()); ?>",
	        data:{'service_id':val,'_token':"<?php echo e(csrf_token()); ?>"},
	        success:function(response) {
				location.reload();
	            $("#selected_service_price").val(response.price);
	            $("#submit-button").val('PAY $'+response.usdprice);
	            $("#usdprice").val(response.usdprice);
	            $("#selected_service_name").html(response.name);
	            $("#selected_service_vat").html(response.vat);
	            $("#code_error").html('');
	            $("#code_id").val('');
	            $("#code").val('');
	            $('#submit_promo').html('Check Availability');
	            $('#success_div').hide();
	            $("#discount_avail").hide();
	            $("#discount_value").html('');
	            $("#total_price").html('€'+response.price);
	            $("#selected_service_amount").html('€'+response.vatprice);
	            $("#total_price_new").hide();
	            $("#total_price_value_new").html('');
	            var total_price_usd = response.usdprice;
				if(total_price_usd == 0) {
					$("#braintree-dropin-frame").hide();
				}

					$('#payment-form').empty();
					braintree.setup(clientToken, "custom", {
						paypal: {
							container: "payment-form",
							singleUse: true,
							amount: response.price,
							currency: 'EUR'
						},
						onPaymentMethodReceived: function (obj) {
							setNonce(obj.nonce);
						}
					});
	        }
	    }); 
	});

	function setNonce(nonce) {   // definizione di funzione ...
	    console.log('nonce'+nonce);
		$("#payment_method_nonce_paypal").val(nonce);
	    loginPayPalEffettuato = true;
	    // checkAbilitazioneButtonOrderNow();
	}

	$(document).ready(function() { // se esiste, setta 'required' al nome Company
	    var val = $('[name=company]').val(); // val = nome company
	    if(val != '') {
	        $('[name=vat]').attr('required','required');
	    }else{
	        $('[name=vat]').attr('required',false);
	    }
	});

	$('[name=company]').change(function(){ // come sopra ...
	   var val = $(this).val(); // this = name company
	    if(val != '') {
	        $('[name=vat]').attr('required','required');
	    }else{
	        $('[name=vat]').attr('required',false);
	    }
	});

	$("#submit_promo").click(function(){   // interviene solo all'eventuale submit del promo code
		var code = $("#code").val();
		var service_id = $("#service_id").val();
		var type = $("#service_type").val();
	    var token = "<?php echo e(csrf_token()); ?>";
		var value = {'code':code, 'service_id':service_id,'type':type,'_token':token};
		$.ajax({
			url:"<?php echo e(url('availcode')); ?>",
			method:'POST',
			_token:"<?php echo e(csrf_token()); ?>",
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
	                            loginPayPalEffettuato = false;
	                            // checkAbilitazioneButtonOrderNow();
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

	var loginPayPalEffettuato = false;

	//var checkAbilitazioneButtonOrderNow = function() {
	//    $(".order_now").prop("disabled", !isFormPagamentoValido());
	//}

	var isFormPagamentoValido = function() {  // true or false
	    var isValido = true;
	    // verifica TOS
	    $("input[type='checkbox'][name='tos']").each(function() {
	        if(!$(this).is(':checked')) {
	            isValido = false;
	        }
	    });

	    var metodoPagamentoSelezionato = $("input[type='radio'][name='payment_method']:checked").val();

	    if(metodoPagamentoSelezionato == "1") {
	        // verifica PAYPAL
	        if(!loginPayPalEffettuato) {
	            isValido = false;
	        }
	    } else if(metodoPagamentoSelezionato == "2") {
	        // verifica CC
	        if(
	            !$("input[name='credit_card_number']").val() ||
	            !$("input[name='credit_card_cvv']").val() ||
	            !$("input[name='credit_card_exp_date']").val() ||
	            !$("input[name='credit_card_postal_code']").val() ||
	            !$("input[name='credit_card_card_holder']").val()
	        ) {
	            isValido = false;
	        }
	    }
	    return isValido;
	}

	$(function() {
		console.log('middle');
	    // $("input[type='checkbox'][name='tos']").change(checkAbilitazioneButtonOrderNow);
	    // $("input[type='radio'][name='payment_method']").change(checkAbilitazioneButtonOrderNow);
	    // $("input[name='credit_card_number']").keyup(checkAbilitazioneButtonOrderNow); // keyup = digitazione su tastiera
	    // $("input[name='credit_card_cvv']").keyup(checkAbilitazioneButtonOrderNow);
	    // $("input[name='credit_card_exp_date']").keyup(checkAbilitazioneButtonOrderNow);
	    // $("input[name='credit_card_postal_code']").keyup(checkAbilitazioneButtonOrderNow);
	    // $("input[name='credit_card_card_holder']").keyup(checkAbilitazioneButtonOrderNow);
	    $("#payment-form").on("click", "#bt-pp-cancel", function() {
	        loginPayPalEffettuato = false;
	    //    checkAbilitazioneButtonOrderNow();
	    });

	    // checkAbilitazioneButtonOrderNow();
	    console.log('end --> ok no error');
	});

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.new_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>