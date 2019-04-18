<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
	<!--<![endif]-->
	<head>
	    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(env('GOOGLE_ANALYTICS_ID')); ?>"></script>
	    <script>
	      window.dataLayer = window.dataLayer || [];
	      function gtag(){dataLayer.push(arguments);}
	      gtag('js', new Date());

	      gtag('config', '<?php echo e(env('GOOGLE_ANALYTICS_ID')); ?>');
	    </script>

	    <!-- Facebook Pixel Code -->
	    <script>
		    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		    document,'script','https://connect.facebook.net/en_US/fbevents.js');
		    fbq('init', '395106547540931'); // Insert your pixel ID here.
		    fbq('track', 'PageView');
	    </script>
	    <noscript><img height="1" width="1" style="display:none"
	    src="https://www.facebook.com/tr?id=395106547540931&ev=PageView&noscript=1"
	    /></noscript>
	    <!-- DO NOT MODIFY -->
	    <!-- End Facebook Pixel Code -->

	    <!-- Basic Page Needs -->
	    <meta charset="utf-8">
	    <title><?php echo e(isset($meta_tag->title ) ? $meta_tag->title : "Wexplore"); ?></title>
	    <meta name="description" content="<?php echo e(isset($meta_tag->meta_description ) ? $meta_tag->meta_description : ""); ?>">
	    <meta name="title" content="<?php echo e(isset($meta_tag->meta_title ) ? $meta_tag->meta_title : ""); ?>">
	    <meta name="author" content="">
	    <!-- Mobile Specific Metas -->
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	    <!-- Favicons -->
	    <link rel="shortcut icon" href="<?php echo e(asset('frontend/immagini/favicon.ico')); ?>">

	    <!-- FONTS -->
	    <link rel='stylesheet' id='Roboto-css' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700'>
	    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	    <link rel='stylesheet' id='Patua+One-css' href='https://fonts.googleapis.com/css?family=Patua+One:100,300,400,400italic,700'>

	    <!-- CSS -->
	    <link rel='stylesheet' id='global-css'  href="<?php echo e(asset('frontend/css/global.css')); ?>">
	    <link rel='stylesheet' id='structure-css' href='<?php echo e(asset('frontend/css/structure.css')); ?>'>
	    <link rel='stylesheet' id='style-static' href='<?php echo e(asset('frontend/css/be_style.css')); ?>'>
	    <link rel='stylesheet' id='style-static' href='<?php echo e(asset('frontend/css/style.css')); ?>'>
	    <link rel='stylesheet' id='custom-css' href='<?php echo e(asset('frontend/css/custom.css')); ?>'>

	    <link rel="stylesheet" href="<?php echo e(\Route::getCurrentRoute()->uri() != "/" ? asset('frontend/css/bootstrap.min.css') : ""); ?>" type="text/css">
	    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/main.css')); ?>" type="text/css">
	    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/custom_old.css')); ?>" type="text/css">
	    <!-- Revolution Slider -->
	    <link rel="stylesheet" href="<?php echo e(asset('frontend/plugins/rs-plugin/css/settings.css')); ?>">
	    <link rel="stylesheet" href="<?php echo e(asset('frontend/font-awesome/css/font-awesome.min.css')); ?>">
	    <script src="<?php echo e(asset('frontend/js/jquery-1.11.3.js')); ?>"></script>
	</head>

	<body class="home page template-slider menu-line-below layout-full-width header-classic sticky-header sticky-white subheader-title-left no-content-padding">
		<!-- Main Theme Wrapper -->
		<div id="Wrapper">
	    	<!-- Header Wrapper -->
		    <div id="Header_wrapper">
		    	<?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		    	<!-- Header -->
			    <header id="Header">
			        <!-- Header Top -  Info Area -->
			        <div id="Action_bar">
			            <div class="container">
			                <div class="column one">
			                    <!-- Header - contact info area-->
			                    <!--ul class="contact_details">
			                        <li class="phone">
			                            <i class="icon-clock"></i>
			                        </li>
			                        <li class="mail">
			                            <i class="icon-mail-line"></i><a style="color:#ffffff;" href="mailto:"> </a>
			                        </li>
			                    </ul-->
			                    <!--Social info area-->
			                    <!--ul class="social">
			                        <li class="skype">
			                            <a href="#" title="Skype"><i class="icon-skype"></i></a>
			                        </li>
			                        <li class="facebook">
			                            <a href="http://www.facebook.com/Beantown-Themes-653197714728193" title="Facebook"><i class="icon-facebook"></i></a>
			                        </li>
			                        <li class="googleplus">
			                            <a href="http://plus.google.com/" title="Google+"><i class="icon-gplus"></i></a>
			                        </li>
			                        <li class="twitter">
			                            <a href="http://twitter.com/Muffin_Group" title="Twitter"><i class="icon-twitter"></i></a>
			                        </li>
			                        <li class="vimeo">
			                            <a href="http://vimeo.com/" title="Vimeo"><i class="icon-vimeo"></i></a>
			                        </li>
			                        <li class="youtube">
			                            <a href="#" title="Dribbble"><i class="icon-play"></i></a>
			                        </li>
			                        <li class="flickr">
			                            <a href="http://www.flickr.com/" title="Flickr"><i class="icon-flickr"></i></a>
			                        </li>
			                        <li class="pinterest">
			                            <a href="http://www.pinterest.com/" title="Pinterest"><i class="icon-pinterest"></i></a>
			                        </li>
			                        <li class="dribbble">
			                            <a href="https://dribbble.com" title="Dribbble"><i class="icon-dribbble"></i></a>
			                        </li>
			                    </ul-->

			                </div>
			            </div>
			        </div>
			        <!-- Header -  Logo and Menu area -->
			        <div id="Top_bar">
			            <div class="container">
			                <div class="column one">
			                    <div class="top_bar_left clearfix">
			                        <!-- Logo-->
			                        <div class="logo">
			                            <a id="logo" href="<?php echo e(URL::to('/')); ?>" title="Wexplore">
			                                <?php if(isset($settings)): ?>
			                                    <img class="scale-with-grid"  src="<?php echo e(asset($settings->logo)); ?>" alt="Wexplore">
			                                <?php else: ?>
			                                    <img class="scale-with-grid" src="<?php echo e(asset('frontend/immagini/logo-wexplore.png')); ?>" alt="Wexplore" />
			                                <?php endif; ?>
			                            </a>
			                        </div>
			                        <!-- Main menu-->
			                            <div class="menu_wrapper">
			                                <nav id="menu">
			                                    <ul class="menu" id="menu-main-menu" style="margin-bottom: auto;">
			                                        <!--<?php if(isset($navigation)): ?>
			                                            <?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                                                <li  id="menu-item-1354"  class="" ><a href=""><span></span></a></li>
			                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
			                                        <?php endif; ?>
			                                            <li>
			                                                <a href="<?php echo e(url('/')); ?>"><span>Home</span></a>
			                                            </li>
			                                        <?php if(!\Auth::check()): ?>
			                                            <!--li>
			                                                <a href=""><span>Login</span></a>
			                                            </li-->
			                                        <?php else: ?>
			                                            <li>
			                                                <a href="<?php echo e(url('auth/logout')); ?>"><span>Logout</span></a>
			                                            </li>


			                                            <?php if(\Auth::user()->isConsultant()): ?>
			                                                <li>
			                                                    <a href="/consultant/dashboard" style="padding-bottom: 10px;">
			                                                        <span>Dashboard 
			                                                            <?php if(!empty(Auth::user()->consultantProfile->profile_picture)): ?>
			                                                                <img class="img-circle" src="<?php echo e(asset(Auth::user()->consultantProfile->profile_picture)); ?>" alt="" width="35px" height="35px"/>
			                                                            <?php else: ?>
			                                                                <img class="img-circle" src="/frontend/immagini/user.png" alt="" />
			                                                            <?php endif; ?>
			                                                        </span>
			                                                    </a>
			                                                </li>



			                                            <?php else: ?>
			                                                <li>
			                                                    <a href="/user/dashboard" style="padding-bottom: 10px;">
			                                                        <span>Dashboard 
			                                                            <?php if(!empty(Auth::user()->userProfile->profile_picture)): ?>
			                                                                <img class="img-circle" src="<?php echo e(asset(Auth::user()->userProfile->profile_picture)); ?>" alt="" width="35px" height="35px" />
			                                                            <?php else: ?>
			                                                                <img class="img-circle" src="/frontend/immagini/user.png" alt="" />
			                                                            <?php endif; ?>
			                                                            
			                                                        </span>
			                                                    </a>
			                                                </li>
			                                            <?php endif; ?>
			                                        <?php endif; ?>

			                                    </ul>
			                                </nav><a href="#" class="responsive-menu-toggle "><i class="icon-menu"></i></a>
			                            </div>
			                        <!-- Secondary menu area - only for certain pages -->
			                        <div class="secondary_menu_wrapper">
			                            <nav id="secondary-menu" class="menu-secondary-menu-container">
			                                <ul id="menu-secondary-menu" class="secondary-menu">
			                                    <li class="_menu-item-1568">
			                                        <a href="index.html">Home</a>
			                                    </li>
			                                    <li class=" menu-item-1573">
			                                        <a href="contact.html"> </a>
			                                    </li>
			                                    <li class="menu-item-1574">
			                                        <a href="shop.html">Shop</a>
			                                        <ul class="sub-menu">
			                                            <li class=" menu-item-1569">
			                                                <a href="#">Shopping Cart</a>
			                                            </li>
			                                            <li class=" menu-item-1570">
			                                                <a href="#">Checkout</a>
			                                            </li>
			                                            <li class=" menu-item-1571">
			                                                <a href="#">My Account</a>
			                                            </li>
			                                        </ul>
			                                    </li>
			                                    <li class="menu-item-1583">
			                                        <a target="_blank" href="http://themeforest.net/user/BeantownThemes/portfolio?ref=BeantownThemes">Buy it now !</a>
			                                    </li>
			                                </ul>
			                            </nav>
			                        </div>
			                        <!-- Banner area - only for certain pages-->
			                        <div class="banner_wrapper">
			                            <a href="#" target="_blank"></a>
			                        </div>
			                        <!-- Header Searchform area-->
			                        <div class="search_wrapper">
			                            <form method="get" action="#">
			                                <i class="icon_search icon-search"></i><a href="#" class="icon_close"><i class="icon-cancel"></i></a>
			                                <input type="text" class="field" name="s" placeholder="Enter your search" />
			                                <input type="submit flv_disp_none" class="submit" value="" />
			                            </form>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			        <!-- Revolution slider area-->
			    </header>
			</div>
			<?php echo $__env->yieldContent('slider'); ?>
			<?php echo $__env->yieldContent('content'); ?>
			

			<!-- Footer-->
			<footer id="Footer" class="clearfix">

			    <div class="widgets_wrapper">
			        <div class="container">
			            <div class="one-second column">
			                <!-- Text Area -->
			                <aside id="text-7" class="widget widget_text">
			                    <div class="textwidget"><img width="250px" src="<?php echo e(asset('frontend/immagini/logo-wexplore-bianco.png')); ?>" alt="" />
			                        <p>
			                            <span class="big">Wexplore is the only career service that supports you<br>in finding your dream job abroad.</p>
			                            <br>
			                            <!--<a href="<?php echo e(isset($settings->facebook_url) ? $settings->facebook_url : ""); ?>" class="icon_bar icon_bar_facebook icon_bar_small"><span class="t"><i class="icon-facebook"></i></span><span class="b"><i class="icon-facebook"></i></span></a><a href="<?php echo e(isset($settings->google_plus_url) ? $settings->google_plus_url : ""); ?>" class="icon_bar icon_bar_google icon_bar_small"><span class="t"><i class="icon-gplus"></i></span><span class="b"><i class="icon-gplus"></i></span></a><a href="<?php echo e(isset($settings->twitter_url) ? $settings->twitter_url : ""); ?>" class="icon_bar icon_bar_twitter icon_bar_small"><span class="t"><i class="icon-twitter"></i></span><span class="b"><i class="icon-twitter"></i></span></a>-->
			                    </div>
			                </aside>
			            </div>


			            <!--div class="one-fourth column">
			                <aside id="text-8" class="widget widget_text">
			                    <h4>Wexplore</h4>
			                    <div class="textwidget">
			                        <ul class="list_mixed">
			                            <li class="list_check">
			                                <a style="color:#ffffff;" href="/services">Services</a>
			                            </li>
			                            <li class="list_check">
			                                <a style="color:#ffffff;" href="/about-us">About</a>
			                            </li>
			                            <li class="list_check">
			                                <a style="color:#ffffff;" href="/contact-us">Contacts</a>
			                            </li>
										<li class="list_check">
			                                <a style="color:#ffffff;" href="/faq">FAQ</a>
			                            </li>
			                        </ul>
			                    </div>
			                </aside>
			            </div>

			            <div class="one-fourth column">
			                <aside id="text-8" class="widget widget_text">
			                    <h4><br></h4>
			                    <div class="textwidget">
			                        <ul class="list_mixed">
			                            <li class="list_check">
			                                 <a style="color:#ffffff;" href="/terms-service">Terms Of Service</a>
			                            </li>
			                            <li class="list_check">
			                                <a style="color:#ffffff;" href="/privacy-policy">Privacy Policy</a>
			                            </li>
			                            <li class="list_check">
			                                <a style="color:#ffffff;" href="/cookies-policy">Cookie Policy</a>
			                            </li>
			                            <li class="list_check">
			                                <a style="color:#ffffff;" href="/code-ethics">Code of Ethics</a>
			                            </li>
			                        </ul>
			                    </div>
			                </aside>
			            </div-->


			        </div>
			    </div>
			    <!-- Footer copyright-->
			    <div class="container">
			    <div class="footer_copy" style="border-top:none !important;">

			            <div class="column one">

			                <div class="copyright">
			                    &copy; <?php echo e(date('Y')); ?> Wexplore
			                </div>
			                <!--Social info area-->
			                <a id="back_to_top" href="#" class="button button_left button_js"> <span class="button_icon"> <i class="icon-up-open-big"></i> </span> </a>
			             <!--   <ul class="social">
			                    <?php if(isset($settings)): ?>
			                        <?php if($settings->facebook_active): ?>
			                            <li class="facebook">
			                                <a href="<?php echo e($settings->facebook_url); ?>" title="Facebook"><i class="icon-facebook"></i></a>
			                            </li>
			                        <?php endif; ?>
			                        <?php if($settings->twitter_active): ?>
			                            <li><a title="Twitter" href="<?php echo e($settings->twitter_url); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			                        <?php endif; ?>
			                        <?php if($settings->google_plus_active): ?>
			                            <li class="googleplus">
			                                <a href="<?php echo e($settings->google_plus_url); ?>" title="Google+"><i class="icon-gplus"></i></a>
			                            </li>
			                        <?php endif; ?>
			                        <?php if($settings->behance_active): ?>
			                            <li><a title="Behance" href="<?php echo e($settings->behance_url); ?>" target="_blank"><i class="fa fa-behance"></i></a></li>
			                        <?php endif; ?>
			                        <?php if($settings->linkedin_active): ?>
			                            <li><a title="Linkedin" href="<?php echo e($settings->linkedin_url); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			                        <?php endif; ?>
			                    <?php endif; ?>
			                </ul> -->
			            </div>
			        </div>
			    </div>
			</footer>
			

			<!-- Popup contact form-->
			<!--div id="popup_contact">
			    <a class="button button_js" href="#"><i class="icon-mail-line"></i></a>
			    <div class="popup_contact_wrapper">

			        <div id="contactWrapper_popup"-->
			            <!-- Contact form area-->
			            <!-- <form id="contactform_popup">
			                <h4>Send us a message</h4>
			                <p>
			                        <span>
											<input type="text" name="name_popup" id="name_popup" size="40" aria-required="true" aria-invalid="false" placeholder="Your name" />
										</span><span>
											<input type="email" name="email_popup" id="email_popup" size="40" aria-required="true" aria-invalid="false" placeholder="Your email" />
										</span><span>
											<input type="text" name="subject_popup" id="subject_popup" size="40" aria-required="true" aria-invalid="false" placeholder="Subject" />
										</span><span> 								<textarea name="body_popup" cols="40" id="body_popup" rows="2" aria-required="true" aria-invalid="false" placeholder="Message"></textarea></span>

			                    <input type="button" value="Send Message" id="submit_popup" onClick="return check_values_popup();">
			                </p>
			            </form>
			            <div id="confirmation_popup"></div>
			        </div>

			        <span class="arrow"></span>
			    </div>
			</div> -->
		</div>
		<!-- JS -->
		<script type="text/javascript" src="<?php echo e(asset('frontend/js/mfn.menu.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/js/jquery.plugins.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/js/jquery.jplayer.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/js/animations/animations.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/js/email.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/js/scripts.js')); ?>"></script>

		<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/rs-plugin/js/jquery.themepunch.tools.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js')); ?>"></script>

		<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.video.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.slideanims.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.actions.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.kenburn.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.navigation.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.migration.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.parallax.min.js')); ?>"></script>

		<script type="text/javascript">
		    var tpj = jQuery;
		    tpj.noConflict();
		    var revapi34;
		    tpj(document).ready(function() {
		        if (tpj("#rev_slider_34_2").revolution == undefined) {
		            revslider_showDoubleJqueryError("#rev_slider_34_2");
		        } else {
		            revapi34 = tpj("#rev_slider_34_2").show().revolution({
		                sliderType: "standard",

		                sliderLayout: "auto",
		                dottedOverlay: "none",
		                delay: 7000,
		                navigation: {
		                    keyboardNavigation: "off",
		                    keyboard_direction: "horizontal",
		                    mouseScrollNavigation: "off",
		                    onHoverStop: "on",
		                    touch: {
		                        touchenabled: "on",
		                        swipe_threshold: 0.7,
		                        swipe_min_touches: 1,
		                        swipe_direction: "horizontal",
		                        drag_block_vertical: false
		                    },
		                    arrows: {
		                        style: "uranus",
		                        enable: true,
		                        hide_onmobile: false,
		                        hide_onleave: false,
		                        tmp: '',
		                        left: {
		                            h_align: "right",
		                            v_align: "bottom",
		                            h_offset: 90,
		                            v_offset: 40
		                        },
		                        right: {
		                            h_align: "right",
		                            v_align: "bottom",
		                            h_offset: 40,
		                            v_offset: 40
		                        }
		                    },
		                    thumbnails: {
		                        style: "hesperiden",
		                        enable: true,
		                        width: 200,
		                        height: 80,
		                        min_width: 100,
		                        wrapper_padding: 5,
		                        wrapper_color: "transparent",
		                        wrapper_opacity: "1",
		                        tmp: '<span class="tp-thumb-image"></span><span class="tp-thumb-title">Slide</span>',
		                        visibleAmount: 3,
		                        hide_onmobile: true,
		                        hide_under: 0,
		                        hide_onleave: false,
		                        direction: "horizontal",
		                        span: false,
		                        position: "inner",
		                        space: 5,
		                        h_align: "left",
		                        v_align: "bottom",
		                        h_offset: 40,
		                        v_offset: 40
		                    }
		                },
		                gridwidth: 1180,
		                gridheight: 550,
		                lazyType: "none",
		                shadow: 0,
		                spinner: "spinner3",
		                stopLoop: "off",
		                stopAfterLoops: -1,
		                stopAtSlide: -1,
		                shuffle: "off",
		                autoHeight: "off",
		                disableProgressBar: "on",
		                hideThumbsOnMobile: "on",
		                hideSliderAtLimit: 0,
		                hideCaptionAtLimit: 0,
		                hideAllCaptionAtLilmit: 0,
		                startWithSlide: 0,
		                debugMode: false,
		                fallbacks: {
		                    simplifyAll: "on",
		                    nextSlideOnWindowFocus: "off",
		                    disableFocusListener: "off",
		                }
		            });
		        }
		    });
		</script>

		<script>
		    jQuery(window).load(function() {
		        var retina = window.devicePixelRatio > 1 ? true : false;
		        if (retina) {
		            var retinaEl = jQuery("#logo img");
		            var retinaLogoW = retinaEl.width();
		            var retinaLogoH = retinaEl.height();
		            retinaEl.attr("src", "<?php echo e(asset('frontend/immagini/logo-wexplore-retina.png')); ?>").width(retinaLogoW).height(retinaLogoH)
		        }
		    });
		</script>
		<input type="hidden" id="user_timezone" value="<?php echo e(session('timezone')); ?>">
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js">
		</script>
		<script src="<?php echo e(asset('frontend/js/bootstrap.min.js')); ?>"></script>
		<script type="text/javascript">
		    jQuery.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
		        }
		    });
		    jQuery(document).ready(function(){
		        var tz = jstz.determine(); // Determines the time zone of the browser client
		        var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.
		        var val = jQuery("#user_timezone").val();

		        if(val == "") {
		            jQuery.ajax({
		                url:"<?php echo e(url('user/set-timezone')); ?>",
		                type:"POST",
		                _token:"<?php echo e(csrf_token()); ?>",
		                data:{'timezone':timezone},
		                success:function() {
		                    jQuery("#user_timezone").val(timezone);
		                }
		            })

		        }

		    });
		</script>
		<script id="dsq-count-scr" src="//wexplore-com.disqus.com/count.js" async></script>
	</body>
</html>