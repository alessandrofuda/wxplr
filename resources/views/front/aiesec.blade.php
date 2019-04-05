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
                                        <img id="logoaiesec" src="/frontend/immagini/aiesec.png" />
                                    </p>
                                </div>
                                <!-- One Third (1/3) Column -->
                                <div class="column one-third column_quick_fact" style="background:rgba(0, 0, 0, 0.7);margin-top:40px; padding:20px;">
                                    <div class="image aligncenter"><img src="/frontend/immagini/why-not.png" class="scale-with-grid" alt="Step 2">
                                                    </div>
                                    <p class="hrmargin_0 text-white default-font text-bold size-xbig text-left">PROFESSIONAL KIT</p>
                                    <p class="hrmargin_0" style="color:#ffffff; text-align:left; font-family: 'Varela Round', sans-serif; font-size:16px; line-height:20px; font-weight:600;">Il pacchetto completo per guidarti passo passo in ogni fase del tuo percorso di carriera.</p>
                                    <div class="textwidget"><br><br>
                                    <ul class="list_mixed" style="color:#ffffff;">
                                        <li class="list_arrow text-white default-font size-small text-bold" style="line-height:25px;">Verifica dove il tuo profilo è più appetibile nel mercato globale</li>
                                        <li class="list_arrow text-white default-font size-small text-bold" style="line-height:25px;">Scopri come adattarti a lavorare in un nuovo Paese</li>
                                        <li class="list_arrow text-white default-font size-small text-bold" style="line-height:25px;">Ottieni il lavoro dei tuoi sogni grazie ai nostri esperti</li>
                                    </ul>
                                    <p class="default-font text-white text-bold size-small">La tua destinazione ti aspetta!<br/>Raggiungiamola insieme!</p>
                                </div>

                                </div>

                                <!-- One Third (1/3) Column -->
                                <div class="column one-third column_quick_fact" style="background:rgba(0, 0, 0, 0.7);margin-top:40px; padding:20px;">
                                    <div class="aligncenter">
                                    <img class="scale-with-grid" style="margin:-4px 0px 15px 0; width:330px;" src="/frontend/immagini/prezzo-lancio-it.png" alt="" />
                                   <a class="button button_large aligncenter button_theme button_js" style="margin-bottom: 0" href="/service/payment/2"><span class="button_label">ORDINA ADESSO*</span></a></div>
                                    <p class="default-font text-white size-xsmall text-center">*Non scordarti di utilizzare il tuo codice sconto riservato</p>
                                    <p class="hrmargin_0 default-font text-white text-bold size-big text-center">Registrati per ottenere subito il tuo codice sconto riservato</p>
                                    <form method="post" action="{{ url('aiesec') }}" style="margin-top: 6px;">
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
                                            <span style="color: white;">Autorizzo al trattamento dei miei dati personali ai sensi del Decreto Legislativo 196/2003. <a class="text-white" href="/privacy-policy" target="_blank">Leggi la privacy policy</a></span>
                                        </div>

                                        <!-- SUBMIT -->
                                        <p class="no-margins text-center"><input type="submit" name="invia" value="INVIA"></p>

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
                                    <p class="text-gray default-font">Non tutti i Paesi sono alla ricerca di competenze come le tue. Non sprecare ore del tuo tempo rispondendo ad annunci che non porteranno a risposte. Seleziona la migliore destinazione possibile per il tuo profilo e i tuoi obiettivi attraverso la panoramica più completa a disposizione su: mercato del lavoro, qualità del lavoro, qualità della vita.</p>
                                </div>
                            </div>

                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">CULTURAL MATCH</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">Quali Paesi rispecchiano maggiormente la tua personalità? Vivere in un nuovo Paese vuol dire molto di più che lavorarci: sperimenterai delle differenze, e dovrai adattarti a molte cose. Questo report personalizzato ti offre alcuni spunti su come rendere più facile la transizione.</p>
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
                                    <p class="text-gray default-font">La prima impressione non avviene mai due volte! In questa sessione one-to-one con uno dei nostri esperti ti supporteremo a definire il tuo obiettivo di carriera e a prepararti per i colloqui. Potrai contattare direttamente un consulente che opera nel Paese che hai scelto, per un orientamento customizzato e una pianificazione ad hoc per raggiungere i tuoi obiettivi. Tutta l’esperienza diretta del consulente e la sua conoscenza dei migliori recruiter e aziende per il tuo profilo.</p>
                                </div>
                            </div>

                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">STEADY, AIM, SHOOT</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">Una guida pratica ai principali canali che puoi utilizzare per entrare in contatto con il tuo futuro impiego. I pro e i contro di ogni strumento, per calibrare al meglio la tua strategia di ricerca. Calcola il vento, seleziona le tue frecce migliori, e colpisci il bersaglio! Qui è dove metterai insieme i tre drive principali della tua ricerca di lavoro internazionale: quello che vuoi fare, quello che puoi fare, e quello che il mercato ti consente di fare.</p>
                                </div>
                            </div>
                            <div class="column one-second box-image-container flex-col">
                                <div class="box-image box-steady"></div>
                                <div class="box-image-hover box-steady-hover"></div>
                            </div>

                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">COSA COMPRENDE?</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">Tutte le fasi descritte sopra, complete di reportistica e registrazioni, attivabili da subito e disponibili fino a 6 mesi.</p>
                                </div>
                            </div>

                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <h3 class="text-primary default-font">COSA OTTENGO?</h3>
                                    <hr class="primary-line" />
                                    <p class="text-gray default-font">Una soluzione one-stop per avviare la tua prossima mossa di carriera all’estero. Accesso a informazioni esclusive sul tuo mercato target, attraverso un mix di solidi dati e significativa esperienza di un consulente locale. In aggiunta, questa sessione verrà registrata: potrai riascoltarla tutte le volte che vuoi e utilizzarla come strumento di apprendimento.</p>
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
									<h2 style="color:#1f87c7; background: url('/frontend/immagini/linea-titolo-blu.png') no-repeat bottom center; padding-bottom: 25px;font-family: 'Varela Round', sans-serif;">PERCH&Eacute; PROFESSIONAL KIT?</h2>
								</div>
								<div class="column_attr">
									<p style="text-align:center;font-size:22px;line-height:26px;">
										Perché ci sono infiniti siti che pubblicano offerte di lavoro, ma solo Wexplore si concentra sul mio percorso professionale.<br/>
										Perché mi dà un network davvero globale, a portata di mouse.
									</p>
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
                                                        <a target="_blank" href="#" title="Italia"><img width="145" height="75" src="/frontend/immagini/italia.png" class="scale-with-grid wp-post-image" alt="client_1" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Germania"><img width="145" height="75" src="/frontend/immagini/germania.png" class="scale-with-grid wp-post-image" alt="client_2" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Francia"><img width="145" height="75" src="/frontend/immagini/francia.png" class="scale-with-grid wp-post-image" alt="client_3" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="UK"><img width="145" height="75" src="/frontend/immagini/uk.png" class="scale-with-grid wp-post-image" alt="client_4" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Irlanda"><img width="145" height="75" src="/frontend/immagini/irlanda.png" class="scale-with-grid wp-post-image" alt="client_5" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Olanda"><img width="145" height="75" src="/frontend/immagini/olanda.png" class="scale-with-grid wp-post-image" alt="client_6" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Spagna"><img width="145" height="75" src="/frontend/immagini/spagna.png" class="scale-with-grid wp-post-image" alt="client_6" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Svizzera"><img width="145" height="75" src="/frontend/immagini/svizzera.png" class="scale-with-grid wp-post-image" alt="client_6" />
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="client_wrapper">
                                                        <a target="_blank" href="#" title="Australia"><img width="145" height="75" src="/frontend/immagini/australia.png" class="scale-with-grid wp-post-image" alt="client_6" />
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
