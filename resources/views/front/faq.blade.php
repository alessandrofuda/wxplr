<div class="content_wrapper clearfix">
	<div class="sections_group">
		<div class="entry-content">
			<div class="section flv_sections_8" id="orientation-test">
				<div class="section_wrapper clearfix">
					<div class="items_group clearfix">
                        <!-- Page Title-->
                        <!-- One full width row-->
                        <div class="column one column_fancy_heading">
                            <div class="fancy_heading fancy_heading_icon">
                                <h2 style="color:#54b141; background: url(/frontend/immagini/linea-titolo-verde.png) no-repeat bottom center; padding-bottom: 25px;">FAQ</h2>
                            </div>
                        </div>
                        <div class="column one column_column">
                            <div class="column_attr">
                                <div class="faq-container">
                                    <div class="faq-domanda-container">
                                        <h3>How do I know that Wexplore is what I need?</h3>
                                    </div>
                                    <div class="faq-risposta-expander">
                                        <i class="fa fa-chevron-down fa-2x"></i>
                                    </div>
                                    <div class="faq-risposta-container">
                                        <p>Just <a href="/en/contact-us">contact us</a>, we will go through your questions and objectives together in a free session with one of our consultants, to make sure you are not taking any false steps in the direction of your next big step. </p>
                                    </div>
                                </div>

                                <div class="faq-container">
                                    <div class="faq-domanda-container">
                                        <h3>How does it work?</h3>
                                    </div>
                                    <div class="faq-risposta-expander">
                                        <i class="fa fa-chevron-down fa-2x"></i>
                                    </div>
                                    <div class="faq-risposta-container">
                                        <p>Just register and go through the steps we have created for you!</p>
                                    </div>
                                </div>

								<div class="faq-container">
                                    <div class="faq-domanda-container">
                                        <h3>If I purchase the Professional Kit, does it mean you will find me a job?</h3>
                                    </div>
                                    <div class="faq-risposta-expander">
                                        <i class="fa fa-chevron-down fa-2x"></i>
                                    </div>
                                    <div class="faq-risposta-container">
                                        <p>That would be impossible, and whoever asks for money in exchange for a job is most likely cheating you. Our goal is to make the process easier, and by being included in our network it can happen that potential employers ask us for talented profiles. However, we would be dishonest if we promised this for everyone. It would be more correct to say that, with the Professional Kit, it means YOU will find yourself a job.</p>
                                    </div>
                                </div>

								<div class="faq-container">
									<div class="faq-domanda-container">
										<h3>How long does the PK take? Do I have a time limit?</h3>
									</div>
									<div class="faq-risposta-expander">
										<i class="fa fa-chevron-down fa-2x"></i>
									</div>
									<div class="faq-risposta-container">
										<p>Nope! You set your own pace based on your availability and deadlines. In terms of effort required, the Professional Kit can be completed within 7-8 days. You can proceed gradually and book your session with your consultant whenever is most convenient. You have 6 months of unlimited access, but we advise you to complete the Professional Kit within 1 month of starting it.</p>
									</div>
								</div>

								<div class="faq-container">
									<div class="faq-domanda-container">
										<h3>How many Countries are included in each PK?</h3>
									</div>
									<div class="faq-risposta-expander">
										<i class="fa fa-chevron-down fa-2x"></i>
									</div>
									<div class="faq-risposta-container">
										<p>Each Professional Kit will focus on one Country in particular. Specifically, you have included a session with one consultant from the Country you will select. This is derived from a tested methodology, by which it is more effective to focus your energies and efforts on one very clear target at the time.
Should you be interested in approaching more than one Country at the time, please <a href="/en/contact-us">contact us</a>, and we will customize our offer to suit our need...because we want your success as much as you do!</p>
									</div>
								</div>

								<div class="faq-container">
									<div class="faq-domanda-container">
										<h3>I would like to approach a country outside Europe: can you help me?</h3>
									</div>
									<div class="faq-risposta-expander">
										<i class="fa fa-chevron-down fa-2x"></i>
									</div>
									<div class="faq-risposta-container">
										<p>Of course we can! What you see on Wexplore is only the tip of the iceberg. Even as you read, we are currently working on processing and elaborating data on America, Latin America, Asia, and Oceania. However, our global network means we can activate right away a consultant in any of those countries. <a href="/en/contact-us">Leave us your contact details</a>, we will discuss together how to make it work.</p>
									</div>
								</div>

								<div class="faq-container">
									<div class="faq-domanda-container">
										<h3>What about any tax or immigration issues? Whom can I ask for help?</h3>
									</div>
									<div class="faq-risposta-expander">
										<i class="fa fa-chevron-down fa-2x"></i>
									</div>
									<div class="faq-risposta-container">
										<p>You don’t need to look any further! We are activating partners also for these issues, to make sure you have all the necessary documentation, you find your house away from home, you don’t end up paying double taxation. <a href="/en/contact-us">Leave us your contact details</a>, we will connect you to some reliable and expert advice.</p>
									</div>
								</div>

								<div class="faq-container">
									<div class="faq-domanda-container">
										<h3>Before leaving, I need to improve my knowledge of the local language. Do you have any suggestions?</h3>
									</div>
									<div class="faq-risposta-expander">
										<i class="fa fa-chevron-down fa-2x"></i>
									</div>
									<div class="faq-risposta-container">
										<p>Of course we do! What you see on Wexplore is only the tip of the iceberg. Even as you read, we are currently working on selecting the best partners to enhance your confidence and fluency in the language you plan to use for the next years. <a href="/en/contact-us">Leave us your contact details</a>, we will discuss together how to make it work.</p>
									</div>
								</div>

                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
    </div>
</div>
<script>
    jQuery(function() {
        jQuery(".faq-domanda-container, .faq-risposta-expander").click(function(event) {
            var faqContainer = jQuery(this).parent();
            var icon = faqContainer.find(".faq-risposta-expander .fa");
            var rispostaContainer = faqContainer.find(".faq-risposta-container");
            if(rispostaContainer.hasClass("expanded")) {
                rispostaContainer.removeClass("expanded");
                rispostaContainer.slideUp();
                icon.removeClass("fa-chevron-up");
                icon.addClass("fa-chevron-down");
            } else {
                rispostaContainer.addClass("expanded");
                rispostaContainer.slideDown();
                icon.removeClass("fa-chevron-down");
                icon.addClass("fa-chevron-up");
            }
        });
    });
</script>
