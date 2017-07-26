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
								<div class="image aligncenter"><img src="/it/frontend/immagini/prepare.png" class="scale-with-grid" alt="Step 2">
												</div>
								<p class="hrmargin_0 text-white default-font text-bold size-xbig text-center">SKILLS<br/>DEVELOPMENT</p>
								<p class="hrmargin_0" style="margin-top: 5px; margin-bottom: 5px; color:#ffffff; text-align:left; font-family: 'Varela Round', sans-serif; font-size:16px; line-height:20px; font-weight:600;">La ricetta segreta per il tuo successo professionale:</p>
								<div class="textwidget">
								<ul class="list_mixed" style="color:#ffffff;">
									<li style="margin-bottom: 10px" class="list_arrow text-white default-font default-size text-bold" style="line-height:25px;">Aggiungi un pizzico di sicurezza alle tue capacità</li>
									<li style="margin-bottom: 10px" class="list_arrow text-white default-font default-size text-bold" style="line-height:25px;">Mescola con nuove intuizioni sulle abilità per cercare lavoro e per il tuo sviluppo personale</li>
									<li style="margin-bottom: 10px" class="list_arrow text-white default-font default-size text-bold" style="line-height:25px;">Impara come servire i tuoi talenti ad i tuoi datori di lavoro</li>
								</ul>
							</div>

							</div>

							<!-- One Third (1/3) Column -->
							<div class="column one-third column_quick_fact" style="background:rgba(0, 0, 0, 0.7);margin-top:40px; padding:20px;">
								<div class="aligncenter">
								<img class="scale-with-grid" style="margin:-4px 0px 15px 0; width:230px;" src="/it/frontend/immagini/get-updated.png" alt="" />
								</div>
								<p class="hrmargin_0 default-font text-white text-bold size-big text-center">Ti informeremo quando il servizio sarà online</p>
								<form method="post" action="{{ url('services') }}" style="margin-top: 6px;">
									<!-- CASELLE DI TESTO -->
									<div class="column one-second form-row">
										<input type="text" required placeholder="Nome" name="name" value="{{ old('name') }}">
									</div>
									<div class="column one-second form-row">
										<input type="text" required placeholder="Cognome" name="surname" value="{{ old('surname') }}">
									</div>
									<div class="column one-second form-row">
										<input type="text" required placeholder="Indirizzo" name="address" value="{{ old('address') }}">
									</div>
									<div class="column one-second form-row">
										<input type="text" required placeholder="Email" name="email" value="{{ old('email') }}">
									</div>
									<div style="margin-bottom: 10px;" class="column form-row">
										<textarea name="message" placeholder="Messaggio" rows="2" cols="60">{{ old('message') }}</textarea>
									</div>
									<div class="form-group">
										<input type="radio" name="policy" required>
										<span style="color: white;">
											Autorizzo al trattamento dei miei dati personali ai sensi del Decreto Legislativo 196/2003. <a class="text-white" href="/it/informativa-privacy" target="_blank">Leggi la privacy policy</a></span>
									</div>

									<!-- SUBMIT -->
									<p class="no-margins text-center"><input type="submit" name="invia" value="INVIA"></p>

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
                                    <p class="text-gray default-font text-left">
													Hai un <b>colloquio</b> importante in arrivo e vuoi saperne di più sulle tecniche per superarlo al meglio?
													Hai già fatto il grande passo e ti sei trasferito in un altro paese ma stai affrontando uno <b>shock culturale</b>? Vorresti ascoltare <b>l’esperienza in prima persona</b> di qualcuno che ha affrontato le tue stesse sfide?
													Vuoi sapere come puoi contattare i tuoi <b>potenziali datori di lavoro</b>?
												</p>
									<p class="text-gray default-font text-left">
										<b>Accedi alla nostra vasta libreria di podcasts o partecipa ad uno dei nostri live webinar per accrescere I tuo talenti!</b>
									</p>
									<p class="text-gray default-font text-left">
										Una raccolta di podcasts con relative slides, completata da live webinar. Puoi selezionare qualsiasi traccia audio o sessione uno ad uno man mano che catturano il tuo interesse, o comprare uno dei nostri pacchetti consigliati per ottenere il meglio dal rapporto qualità-prezzo.
									</p>
                                </div>
                            </div>

							<div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">COSA COMPRENDE?</h3>
                                    <hr class="primary-line" />
									<p class="text-gray default-font">Per ogni video, otterrai l’accesso illimitato per 6 mesi, per riguardarlo tutte le volte che vuoi.</p>
                                </div>
                            </div>

                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">COSA OTTENGO?</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">Le risposte a tutte le domande chiave per la ricerca di un lavoro e per il passaggio di carrier in un ambiente internazionale.</p>
									<p class="text-gray default-font">L’opportunità di ampliare la tua mente ed ottenere nuovi spunti sulle soft skills che gioveranno alla tua crescita professionale.</p>
									<p class="text-gray default-font">Un ambiente dedicato allo sviluppo della leadership dove riflettere, crescere e responsabilizzarti.</p>
                                </div>
                            </div>
						</div>
					</div>
				</div>


				<div class="section flv_sections_6" style=" background: url('/it/frontend/immagini/sfondo-azzurro.jpg') no-repeat bottom center;padding-top:20px;margin-top:30px;" id="orientation-test">
					<div class="section_wrapper  mcb-section-inner">
						<div class="items_group clearfix">
							<!-- Page Title-->
							<!-- One full width row-->
							<div id="orientation" class="column one column_fancy_heading">
								<div class="fancy_heading fancy_heading_icon">
									<h2 style="color:#1f87c7; background: url('/it/frontend/immagini/linea-titolo-blu.png') no-repeat bottom center; padding-bottom: 25px;font-family: 'Varela Round', sans-serif;">PERCH&Eacute; SKILLS DEVELOPMENT?</h2>
								</div>
								<div class="column_attr">
									<p style="text-align:center;font-size:22px;line-height:26px;">
										Perché i video in pillole mi aiutano ad ampliare i miei orizzonti ed accedere a know-how di qualità come supporto al mio sviluppo personale.<br/>
										Perché sono pietre miliari del percorso di auto-realizzazione.
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
									<h4 class="flv_style_4">Al momento lavoriamo in questi paesi</h4>
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
												<a title="Italia"><img width="145" height="75" src="/it/frontend/immagini/italia.png" class="scale-with-grid wp-post-image" alt="client_1" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Germania"><img width="145" height="75" src="/it/frontend/immagini/germania.png" class="scale-with-grid wp-post-image" alt="client_2" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Francia"><img width="145" height="75" src="/it/frontend/immagini/francia.png" class="scale-with-grid wp-post-image" alt="client_3" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="UK"><img width="145" height="75" src="/it/frontend/immagini/uk.png" class="scale-with-grid wp-post-image" alt="client_4" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Irlanda"><img width="145" height="75" src="/it/frontend/immagini/irlanda.png" class="scale-with-grid wp-post-image" alt="client_5" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Olanda"><img width="145" height="75" src="/it/frontend/immagini/olanda.png" class="scale-with-grid wp-post-image" alt="client_6" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Spagna"><img width="145" height="75" src="/it/frontend/immagini/spagna.png" class="scale-with-grid wp-post-image" alt="client_6" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Svizzera"><img width="145" height="75" src="/it/frontend/immagini/svizzera.png" class="scale-with-grid wp-post-image" alt="client_6" />
												</a>
											</div>
										</li>
										<li>
											<div class="client_wrapper">
												<a title="Australia"><img width="145" height="75" src="/it/frontend/immagini/australia.png" class="scale-with-grid wp-post-image" alt="client_6" />
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
