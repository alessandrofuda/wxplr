<!-- Footer-->
<footer id="Footer" class="clearfix">

    <div class="widgets_wrapper">
        <div class="container">
            <div class="one-second column">
                <!-- Text Area -->
                <aside id="text-7" class="widget widget_text">
                    <div class="textwidget">
                        <a href="<?php echo e(url('/')); ?>"><img class="footer_logo" src="<?php echo e(asset('frontend/images/Wexplore_colore.png')); ?>" alt="" /></a>
                        <a href="<?php echo e(isset($settings->facebook_url) ? $settings->facebook_url : ""); ?>"><img class="footer_social fb" src="<?php echo e(asset('frontend/images/fb_footer_logo.png')); ?>" alt="" /></a>
                        <a href="<?php echo e(isset($settings->linkedin_url) ? $settings->linkedin_url : ""); ?>"><img class="footer_social lkn" src="<?php echo e(asset('frontend/images/linkedin_footer_logo.png')); ?>" alt="" /></a>
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
                    &copy; <?php echo e(date('Y')); ?> Wexplore | <a href="<?php echo e(url('privacy-policy')); ?>">Privacy policy</a> | <a href="<?php echo e(url('cookies-policy')); ?>">Cookie policy</a>
                </div>
                <!--Social info area-->
                <!--a id="back_to_top" href="#" class="button button_left button_js"> <span class="button_icon"> <i class="icon-up-open-big"></i> </span> </a-->
            </div>
        </div>
    </div>
</footer>