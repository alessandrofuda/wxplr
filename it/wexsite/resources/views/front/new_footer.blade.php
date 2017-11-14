<!-- Footer-->
<footer id="Footer" class="clearfix">

    <div class="widgets_wrapper">
        <div class="container">
            <div class="one-second column">
                <!-- Text Area -->
                <aside id="text-7" class="widget widget_text">
                    <div class="textwidget"><img width="250px" src="{{ asset('frontend/immagini/logo-wexplore-bianco.png') }}" alt="" />
                        <p>
                            <span class="big">Wexplore is the only career service that supports you<br>in finding your dream job abroad.</p>
                            <br>
                            <!--<a href="{{ isset($settings->facebook_url) ? $settings->facebook_url : ""}}" class="icon_bar icon_bar_facebook icon_bar_small"><span class="t"><i class="icon-facebook"></i></span><span class="b"><i class="icon-facebook"></i></span></a><a href="{{ isset($settings->google_plus_url) ? $settings->google_plus_url : ""}}" class="icon_bar icon_bar_google icon_bar_small"><span class="t"><i class="icon-gplus"></i></span><span class="b"><i class="icon-gplus"></i></span></a><a href="{{ isset($settings->twitter_url) ? $settings->twitter_url : ""}}" class="icon_bar icon_bar_twitter icon_bar_small"><span class="t"><i class="icon-twitter"></i></span><span class="b"><i class="icon-twitter"></i></span></a>{{--<a href="" class="icon_bar icon_bar_vimeo icon_bar_small"><span class="t"><i class="icon-vimeo"></i></span><span class="b"><i class="icon-vimeo"></i></span></a><a href="#" class="icon_bar icon_bar_youtube icon_bar_small"><span class="t"><i class="icon-play"></i></span><span class="b"><i class="icon-play"></i></span></a>--}}-->
                    </div>
                </aside>
            </div>


            <div class="one-fourth column">
                <!-- Text Area -->
                <aside id="text-8" class="widget widget_text">
                    <h4>Wexplore</h4>
                    <div class="textwidget">
                        <ul class="list_mixed">
                            <li class="list_check">
                                <a style="color:#ffffff;" href="/it/servizi">Servizi</a>
                            </li>
                            <li class="list_check">
                                <a style="color:#ffffff;" href="/it/chi-siamo">Chi siamo</a>
                            </li>
                            <li class="list_check">
                                <a style="color:#ffffff;" href="/it/contatti">Contatti</a>
                            </li>
							<li class="list_check">
                                <a style="color:#ffffff;" href="/it/faq">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>

            <div class="one-fourth column">
                <!-- Text Area -->
                <aside id="text-8" class="widget widget_text">
                    <h4><br></h4>
                    <div class="textwidget">
                        <ul class="list_mixed">
                            <li class="list_check">
                                <a style="color:#ffffff;" href="/it/condizioni-vendita">Condizioni di vendita</a>
                            </li>
                            <li class="list_check">
                                <a style="color:#ffffff;" href="/it/informativa-privacy">Privacy Policy</a>
                            </li>
                            <li class="list_check">
                                <a style="color:#ffffff;" href="/it/cookie-policy">Cookie Policy</a>
                            </li>
                            <li class="list_check">
                                <a style="color:#ffffff;" href="/it/codice-etico">Codice Etico</a>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>


        </div>
    </div>
    <!-- Footer copyright-->
    <div class="container">
    <div class="footer_copy" style="border-top:none !important;">

            <div class="column one">

                <div class="copyright">
                    &copy; {{ date('Y') }} Wexplore
                </div>
                <!--Social info area-->
                <a id="back_to_top" href="#" class="button button_left button_js"> <span class="button_icon"> <i class="icon-up-open-big"></i> </span> </a>
             <!--   <ul class="social">
                    @if(isset($settings))
                        @if($settings->facebook_active)
                            <li class="facebook">
                                <a href="{{ $settings->facebook_url }}" title="Facebook"><i class="icon-facebook"></i></a>
                            </li>
                        @endif
                        @if($settings->twitter_active)
                            <li><a title="Twitter" href="{{ $settings->twitter_url }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        @endif
                        @if($settings->google_plus_active)
                            <li class="googleplus">
                                <a href="{{ $settings->google_plus_url }}" title="Google+"><i class="icon-gplus"></i></a>
                            </li>
                        @endif
                        @if($settings->behance_active)
                            <li><a title="Behance" href="{{ $settings->behance_url }}" target="_blank"><i class="fa fa-behance"></i></a></li>
                        @endif
                        @if($settings->linkedin_active)
                            <li><a title="Linkedin" href="{{ $settings->linkedin_url }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        @endif
                    @endif
                </ul> -->
            </div>
        </div>
    </div>
</footer>
</div>

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

<!-- JS -->
<script type="text/javascript" src="{{ asset('frontend/js/mfn.menu.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.jplayer.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/animations/animations.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/email.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/scripts.js') }}"></script>

<script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.video.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/rs-plugin/js/extensions/revolution.extension.parallax.min.js') }}"></script>

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
            retinaEl.attr("src", "{{ asset('frontend/immagini/logo-wexplore-retina.png') }}").width(retinaLogoW).height(retinaLogoH)
        }
    });
</script>
<input type="hidden" id="user_timezone" value="{{ session('timezone') }}">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js">
</script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    jQuery(document).ready(function(){
        var tz = jstz.determine(); // Determines the time zone of the browser client
        var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.
        var val = jQuery("#user_timezone").val();

        if(val == "") {
            jQuery.ajax({
                url:"{{ url('user/set-timezone') }}",
                type:"POST",
                _token:"{{ csrf_token() }}",
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
