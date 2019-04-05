<div class="container">
    @if(session('status'))
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="alert alert-success">
                    <ul>
                        <li>{{ session('status') }}</li>
                    </ul>
            </div>
        </div>
    </div>
    @endif

    @if (count($errors) > 0)
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>

	<div class="content_wrapper clearfix">
		<div class="sections_group">
			<div class="entry-content">
				<div class="section flv_sections_69">
					<div class="section_wrapper clearfix" style="padding:20px;">
						<div class="items_group clearfix flex-container">
							<!-- One Third (1/3) Column -->
							<div style="margin-bottom: -6px; padding-bottom: 0px;" class="column one-third column_quick_fact">
								<p class="hrmargin_0">
									&nbsp;
								</p>
							</div>
							<!-- One Third (1/3) Column -->
							<div class="column one-third column_quick_fact" style="background:rgba(0, 0, 0, 0.7);margin-top:40px; padding:20px;">
								<div class="image aligncenter"><img src="/frontend/immagini/prepare.png" class="scale-with-grid" alt="Step 2">
												</div>
								<p class="hrmargin_0 text-white default-font text-bold size-xbig text-center">SKILLS<br/>DEVELOPMENT</p>
								<p class="hrmargin_0" style="margin-top: 5px; margin-bottom: 5px; color:#ffffff; text-align:left; font-family: 'Varela Round', sans-serif; font-size:16px; line-height:20px; font-weight:600;">The secret recipe to professional success:</p>
								<div class="textwidget">
								<ul class="list_mixed" style="color:#ffffff;">
									<li style="margin-bottom: 10px" class="list_arrow text-white default-font default-size text-bold" style="line-height:25px;">Add a pinch of confidence to your competence</li>
									<li style="margin-bottom: 10px" class="list_arrow text-white default-font default-size text-bold" style="line-height:25px;">Mix with new insights on job search skills and personal development</li>
									<li style="margin-bottom: 10px" class="list_arrow text-white default-font default-size text-bold" style="line-height:25px;">Learn how to serve your talents to your employers</li>
								</ul>
							</div>

							</div>

							<!-- One Third (1/3) Column -->
							<div class="column one-third column_quick_fact" style="background:rgba(0, 0, 0, 0.7);margin-top:40px; padding:20px;">
								<div class="aligncenter">
								<img class="scale-with-grid" style="margin:-4px 0px 15px 0; width:230px;" src="/frontend/immagini/get-updated.png" alt="" />
								</div>
								<p class="hrmargin_0 default-font text-white text-bold size-big text-center">We will inform you when the service will be online</p>
								<form method="post" action="{{ url('services') }}" style="margin-top: 6px;">
									<!-- CASELLE DI TESTO -->
									<div class="column one-second form-row">
										<input type="text" required placeholder="Name" name="name" value="{{ old('name') }}">
									</div>
									<div class="column one-second form-row">
										<input type="text" required placeholder="Surname" name="surname" value="{{ old('surname') }}">
									</div>
									<div class="column one-second form-row">
										<input type="text" required placeholder="Address" name="address" value="{{ old('address') }}">
									</div>
									<div class="column one-second form-row">
										<input type="text" required placeholder="Email" name="email" value="{{ old('email') }}">
									</div>
									<div style="margin-bottom: 10px;" class="column form-row">
										<textarea name="message" placeholder="Message" rows="2" cols="60">{{ old('message') }}</textarea>
									</div>
									<div class="form-group">
										<input type="radio" name="policy" required>
										<span style="color: white;">I authorize the treatment of my personal data pursuant to the Italian Legislative Decree on privacy 196/2003. <a class="text-white" href="/en/privacy-policy" target="_blank">Read the privacy policy</a></span>
									</div>

									<!-- SUBMIT -->
									<p class="no-margins text-center"><input type="submit" name="invia" value="SEND"></p>

									<input type="hidden" name="service_id" value="3" />
									{{ csrf_field() }}
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="section" style="margin-top:50px;">
					<div class="section_wrapper clearfix">
						<div class="items_group clearfix flex-container">
                            <div class="column one-second box-image-container flex-col">
                                <div class="box-image box-skill"></div>
                                <div class="box-image-hover box-skill-hover"></div>
                            </div>
                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <p class="text-gray default-font text-left">You have an important <b>interview</b> coming up and want to learn more about job interview techniques? You have already taken the leap and relocated to another country but are experiencing a <b>culture shock</b>? Would you like to hear a <b>first-hand experience</b> of someone who went through the same path? Do you want to know how to get in touch with <b>potential employers</b>?</p>
									<p class="text-gray default-font text-left"><b>Access our extensive library of podcasts or join in one of our live webinar sessions to enhance your talents!</b></p>
									<p class="text-gray default-font text-left">A library of podcasts with related slides, complemented by live webinars. You can select any audio file or single session one by one as they catch your interest, or buy one of our suggested bundles to get the best value for money.</p>
                                </div>
                            </div>

							<div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">WHAT IS INCLUDED?</h3>
                                    <hr class="primary-line" />
									<p class="text-gray default-font">For each video, you will get a 6 months unlimited access, to consult it as many times you want.</p>
                                </div>
                            </div>

                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">WHAT AM I GETTING?</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">The answers to all your key questions about a job search process and a career transition in an international environment.</p>
									<p class="text-gray default-font">The opportunity to expand your mind and gain new insights on soft skills that will benefit your career progression.</p>
									<p class="text-gray default-font">A dedicated leadership development environment where to reflect, grow, and empower yourself.</p>
                                </div>
                            </div>
						</div>
					</div>
				</div>


				<div class="section flv_sections_6" style=" background: url('/frontend/immagini/sfondo-azzurro.jpg') no-repeat bottom center;padding-top:20px;margin-top:30px;" id="orientation-test">
					<div class="section_wrapper  mcb-section-inner">
						<div class="items_group clearfix">
							<!-- Page Title-->
							<!-- One full width row-->
							<div id="orientation" class="column one column_fancy_heading">
								<div class="fancy_heading fancy_heading_icon">
									<h2 style="color:#1f87c7; background: url('/frontend/immagini/linea-titolo-blu.png') no-repeat bottom center; padding-bottom: 25px;font-family: 'Varela Round', sans-serif;">WHY SKILLS DEVELOPMENT?</h2>
								</div>
								<div class="column_attr">
									<p style="text-align:center;font-size:22px;line-height:26px;">
										Because the video pills help me to expand my horizons and to access quality know-how to support my personal development.<br/>
										Because they are milestones on a journey to self-realization.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br/><br/>
				<div class="section">
					<div class="section_wrapper clearfix">
						<div class="items_group clearfix">
							<!-- One full width row-->
							<div class="column one column_column">
								<div class="column_attr">
									<h4 class="flv_style_4">Currently we work in these countries</h4>
								</div>
							</div>

							<!-- One full width row-->
							<div class="column one column_clients_slider" style="margin-top:-60px;">
								<div class="clients_slider">
									<div class="clients_slider_header">
										<a class="button button_js slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a><a class="button button_js slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>
									</div>
									<ul class="clients clients_slider_ul">
										<li>
											<div class="client_wrapper">
												<a title="Italia"><img width="145" height="75" src="/frontend/immagini/italia.png" class="scale-with-grid wp-post-image" alt="client_1" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Germania"><img width="145" height="75" src="/frontend/immagini/germania.png" class="scale-with-grid wp-post-image" alt="client_2" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Francia"><img width="145" height="75" src="/frontend/immagini/francia.png" class="scale-with-grid wp-post-image" alt="client_3" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="UK"><img width="145" height="75" src="/frontend/immagini/uk.png" class="scale-with-grid wp-post-image" alt="client_4" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Irlanda"><img width="145" height="75" src="/frontend/immagini/irlanda.png" class="scale-with-grid wp-post-image" alt="client_5" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Olanda"><img width="145" height="75" src="/frontend/immagini/olanda.png" class="scale-with-grid wp-post-image" alt="client_6" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Spagna"><img width="145" height="75" src="/frontend/immagini/spagna.png" class="scale-with-grid wp-post-image" alt="client_6" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Svizzera"><img width="145" height="75" src="/frontend/immagini/svizzera.png" class="scale-with-grid wp-post-image" alt="client_6" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Australia"><img width="145" height="75" src="/frontend/immagini/australia.png" class="scale-with-grid wp-post-image" alt="client_6" />
												</a>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- FAQ Area --></div>
		</div>
	</div>
</div>
