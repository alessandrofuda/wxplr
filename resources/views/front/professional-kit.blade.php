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
                    <div class="section flv_sections_67">
                        <div class="section_wrapper clearfix">
                            <div class="items_group clearfix flex-container">
                                <!-- One Third (1/3) Column -->
                                <div style="margin-bottom: -6px; padding-bottom: 0px;" class="column one-third column_quick_fact">
                                    <p class="hrmargin_0">
                                        &nbsp;
                                    </p>
                                </div>
                                <!-- One Third (1/3) Column -->
                                <div class="column one-third column_quick_fact" style="background:rgba(0, 0, 0, 0.7);margin-top:40px; padding:20px;">
                                    <div class="image aligncenter"><img src="/en/frontend/immagini/why-not.png" class="scale-with-grid" alt="Step 2">
                                                    </div>
                                    <p class="hrmargin_0 text-white default-font text-bold size-xbig text-left">PROFESSIONAL KIT</p>
                                    <p class="hrmargin_0" style="margin-top: 20px; color:#ffffff; text-align:left; font-family: 'Varela Round', sans-serif; font-size:16px; line-height:20px; font-weight:600;">A complete package to guide you through the process of finding a job abroad, distilled from years of experience in career services.</p>
                                    <div class="textwidget"><br><br>
                                    <ul class="list_mixed" style="color:#ffffff;">
                                        <li style="margin-bottom: 40px" class="list_arrow text-white default-font default-size text-bold" style="line-height:25px;">What is your employability on the global market?</li>
                                        <li style="margin-bottom: 40px" class="list_arrow text-white default-font default-size text-bold" style="line-height:25px;">How can you best adapt to work in a new country?</li>
                                        <li style="margin-bottom: 40px" class="list_arrow text-white default-font default-size text-bold" style="line-height:25px;">How can you secure your<br/>dream job?</li>
                                    </ul>
                                </div>

                                </div>

                                <!-- One Third (1/3) Column -->
                                <div class="column one-third column_quick_fact" style="background:rgba(0, 0, 0, 0.7);margin-top:40px; padding:20px;">
                                    <div class="aligncenter">
                                    <img class="scale-with-grid" style="margin:-4px 0px 15px 0; width:330px;" src="/en/frontend/immagini/prezzo-lancio-en.png" alt="" />
                                   <a class="button button_large aligncenter button_theme button_js" style="margin-bottom: 0" href="/en/service/payment/2"><span class="button_label">BUY NOW</span></a></div>
                                    <p class="hrmargin_0 default-font text-white text-bold size-xbig text-center">Is Professional Kit the right tool for me?</p>
                                    <p class="text-white default-font size-small text-bold">Contact us for a first FREE orientation session with one of our consultants.</p>
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

                                        <input type="hidden" name="service_id" value="2" />
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

				<div class="section flv_sections_6" style="margin-top:50px;" id="professional-kit">
					<div class="section_wrapper clearfix">
						<div class="items_group clearfix flex-container">
                            <div class="column one-second box-image-container flex-col">
                                <div class="box-image box-market"></div>
                                <div class="box-image-hover box-market-hover"></div>
                            </div>
                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">MARKET ANALYSIS</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">Not every Country is looking for skills like yours. Do not waste hours of your time by applying to job offers that will not bring any result. Select the best possible destination for your profile and your objectives through the most comprehensive overview available of: labor market, quality of work, quality of life</p>
                                </div>
                            </div>

                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">CULTURAL MATCH</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">Which countries are more suited to your personality? Living in a new country is much more than working there: you will experience differences and you will need to adjust to many things. This personalized report will offer you some tips on how to make the transition easier.</p>
                                </div>
                            </div>
                            <div class="column one-second box-image-container flex-col">
                                <div class="box-image box-cultural"></div>
                                <div class="box-image-hover box-cultural-hover"></div>
                            </div>

                            <div class="column one-second box-image-container flex-col">
                                <div class="box-image box-dream"></div>
                                <div class="box-image-hover box-dream-hover"></div>
                            </div>
                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">DREAMCHECK LAB<br/>AND CAREER CHECK SESSION</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">A first impression never happens twice! A one-to-one interactive session with one of our experts will support you in defining your career objective and in preparing for the interview process. You will have direct contact with a consultant operating in your target country, for a customized orientation and planning session to reach your goals. No filters, but direct knowledge of the best recruiters and companies for you.</p>
                                </div>
                            </div>

                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">STEADY, AIM, SHOOT</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">A practical guide on the best tools to use to get in touch with your prospect employers. Pros and cons of every channel, to better adjust your search strategy. Read the wind, select your best arrows, and hit the bull’s eye! This is where you put together the three major drives of your international job search process: what you want to do, what you can do, and what the market allows you to do, for the ultimate road to your objective</p>
                                </div>
                            </div>
                            <div class="column one-second box-image-container flex-col">
                                <div class="box-image box-steady"></div>
                                <div class="box-image-hover box-steady-hover"></div>
                            </div>

                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">WHAT IS INCLUDED?</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">All the phases detailed above, complete with reporting and recordings, available right away for a 6-month period.</p>
                                </div>
                            </div>

                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">WHAT AM I GETTING?</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">
													A one-stop solution to kick-start your next career move abroad. Access to unique information about your target market, combining hard data and profound expertise by a local consultant.
													Moreover, this session will be recorded, so you can replay it as many times as you need and use it as a learning tool.
												</p>
                                </div>
                            </div>
                        </div>
					</div>
				</div>

				<div class="section flv_sections_6" style=" background: url('/en/frontend/immagini/sfondo-azzurro.jpg') no-repeat bottom center;padding-top:20px;margin-top:30px;" id="orientation-test">
					<div class="section_wrapper  mcb-section-inner">
						<div class="items_group clearfix">
							<!-- Page Title-->
							<!-- One full width row-->
							<div id="orientation" class="column one column_fancy_heading">
								<div class="fancy_heading fancy_heading_icon">
									<h2 style="color:#1f87c7; background: url('/en/frontend/immagini/linea-titolo-blu.png') no-repeat bottom center; padding-bottom: 25px;font-family: 'Varela Round', sans-serif;">WHY PROFESSIONAL KIT?</h2>
								</div>
								<div class="column_attr">
									<p style="text-align:center;font-size:22px;line-height:26px;">Because there are countless websites that publish job offers, but only Wexplore focuses on my career journey.<br>
										Because it provides me with a truly global network just one click away.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
<br><br>
<div class="section " id="clients flv_sections_16" >
                            <div class="section_wrapper clearfix">
                                <div class="items_group clearfix">
                                    <!-- One full width row-->
                                  <div class="column one column_column">
                                        <div class="column_attr ">
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
                                                        <a target="_blank" href="#" title="Italia"><img width="145" height="75" src="/en/frontend/immagini/italia.png" class="scale-with-grid wp-post-image" alt="client_1" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Germania"><img width="145" height="75" src="/en/frontend/immagini/germania.png" class="scale-with-grid wp-post-image" alt="client_2" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Francia"><img width="145" height="75" src="/en/frontend/immagini/francia.png" class="scale-with-grid wp-post-image" alt="client_3" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="UK"><img width="145" height="75" src="/en/frontend/immagini/uk.png" class="scale-with-grid wp-post-image" alt="client_4" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Irlanda"><img width="145" height="75" src="/en/frontend/immagini/irlanda.png" class="scale-with-grid wp-post-image" alt="client_5" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Olanda"><img width="145" height="75" src="/en/frontend/immagini/olanda.png" class="scale-with-grid wp-post-image" alt="client_6" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Spagna"><img width="145" height="75" src="/en/frontend/immagini/spagna.png" class="scale-with-grid wp-post-image" alt="client_6" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Svizzera"><img width="145" height="75" src="/en/frontend/immagini/svizzera.png" class="scale-with-grid wp-post-image" alt="client_6" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Australia"><img width="145" height="75" src="/en/frontend/immagini/australia.png" class="scale-with-grid wp-post-image" alt="client_6" />
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
