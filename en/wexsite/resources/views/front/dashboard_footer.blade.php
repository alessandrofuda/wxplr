<div class="footer">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="social_icon bottom">
                    <ul class="social-profile s-rounded s-dark-gray-1 s-md">
                    <li><a title="Facebook" href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a title="Twitter" href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a title="GooglePlus" href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    <li><a title="Behance" href="#" target="_blank"><i class="fa fa-behance"></i></a></li>
                    <li><a title="Linkedin" href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="footer_content about">
                    <h3 class="footer_about">ABOUT US</h3>

                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at erosse Donec sed odio dui. Maecenas
                        faucibus mollis interdum isoets Praesent commodo cursus magna, vel scelerisque nisl brother
                        consectetur et.</p>
                </div>
                <div class="footer_content about">
                    <h3 class="footer_about">GET IN TOUCH</h3>

                    <div class="adress">
                        <ul class="adress">
                            <li><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>Lorem ipsum dolor sit
                                amet, consectetur adipiscing elit.
                            </li>
                            <li><span><i class="fa fa-phone" aria-hidden="true"></i></span>1234-567894</li>
                            <li><span><i class="fa fa-envelope-o" aria-hidden="true"></i></span>info@adivalue.com</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer_content">
                        <h3 class="footer_about">NEWSLETTER</h3>

                        <form>
                            <input type="text" placeholder="Your Name">
                            <input type="email" placeholder="Email Address">
                            <a class="button form" href="#">THANK YOU</a>
                        </form>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="footer_content">
                                <h3 class="footer_about">OUR FLICKR</h3>
                                <ul class="footer_img">
                                    <li><a href="#"><img class="img-responsive" alt="24156558794_c905aa7969_s.jpg"
                                                         src="{{ asset('frontend/images/footer_img/24156558794_c905aa7969_s.jpg') }}"></a></li>
                                    <li><a href="#"><img class="img-responsive" alt="24489188220_48f65ef257_s.jpg"
                                                         src="{{ asset('frontend/images/footer_img/24489188220_48f65ef257_s.jpg') }}"></a></li>
                                    <li><a href="#"><img class="img-responsive" alt="24666904092_77b13c3afe_s.jpg"
                                                         src="{{ asset('frontend/images/footer_img/24666904092_77b13c3afe_s.jpg') }}"></a></li>
                                    <li><a href="#"><img class="img-responsive" alt="24691216291_e15f731bf6_s.jpg"
                                                         src="{{ asset('frontend/images/footer_img/24691216291_e15f731bf6_s.jpg') }}"></a></li>
                                    <li><a href="#"><img class="img-responsive" alt="24758651836_ae089c90b0_s.jpg"
                                                         src="{{ asset('frontend/images/footer_img/24758651836_ae089c90b0_s.jpg') }}"></a></li>
                                    <li><a href="#"><img class="img-responsive" alt="24758652156_d79bb11efc_s.jpg"
                                                         src="{{ asset('frontend/images/footer_img/24758652156_d79bb11efc_s.jpg') }}"></a></li>
                                    <li><a href="#"><img class="img-responsive" alt="24784722645_60af85b420_s.jpg"
                                                         src="{{ asset('frontend/images/footer_img/24784722645_60af85b420_s.jpg') }}"></a></li>
                                    <li><a href="#"><img class="img-responsive" alt="24784873785_f25a251fcc_s.jpg"
                                                         src="{{ asset('frontend/images/footer_img/24784873785_f25a251fcc_s.jpg') }}"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="copyright">
                <p>© {{ date('Y') }} - adivalue</p>
            </div>
        </div>
    </div>
</div>
<!--footer close-->
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $('.workBoxMain').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 320,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $('.testomonialMain').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 320,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>
</body>
</html>
