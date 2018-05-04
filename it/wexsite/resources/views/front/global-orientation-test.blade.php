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
				<div class="section flv_sections_63">
                        <div class="section_wrapper clearfix" style="padding:20px;">
                            <div class="items_group clearfix flex-container">
                                <!-- One Third (1/3) Column -->
                                <div style="margin-bottom: -6px; padding-bottom: 0px;" class="column one-third column_quick_fact">
                                    <p class="hrmargin_0" style="color:#3d3d3f; font-family: 'Varela Round', sans-serif; font-size:50px; line-height:60px; font-weight:600;">&nbsp;</p>
                                </div>
                                <!-- One Third (1/3) Column -->
                                <div class="column one-third column_quick_fact" style="background:rgba(0, 0, 0, 0.7);margin-top:40px; padding:20px;">
                                    <div class="image aligncenter">
                                        <img src="/it/frontend/immagini/maybe.png" class="scale-with-grid" alt="Step 2">
                                    </div>
                                    <p class="hrmargin_0 text-center text-white default-font text-bold size-xbig text-left">GLOBAL ORIENTATION TEST</p>
                                    <p class="hrmargin_0" style="color:#ffffff; text-align:left; font-family: 'Varela Round', sans-serif; font-size:16px; line-height:20px; font-weight:600;">Uno strumento unico e gratuito per trovare la giusta combinazione tra la tua azienda ideale ed il paese.</p>
                                    <br>
                                    <ul class="list_mixed" style="color:#ffffff;">
                                        <li class="list_arrow text-white default-font size-small text-bold" style="line-height:25px;margin-bottom: 10px;">Ti senti perso nel <br/>mondo del lavoro?</li>
                                        <li class="list_arrow text-white default-font size-small text-bold" style="line-height:25px;margin-bottom: 10px;">Ti senti confuso su dove potrebbe portarti la prossima mossa della tua carriera?</li>
                                        <li class="list_arrow text-white default-font size-small text-bold" style="line-height:25px;margin-bottom: 10px;">Ti chiedi come potresti prendere la decisione giusta?</li>
                                    </ul>
                                </div>

                                <!-- One Third (1/3) Column -->
                                <div class="column one-third column_quick_fact" style="background:rgba(0, 0, 0, 0.7);margin-top:40px; padding:20px;">
                                    <div class="aligncenter" style="margin-top: 10px;">
                                        @if(!\Auth::check())
                                            <a href="/en/register"> 
                                        @else
                                            <a href="/en/user/dashboard">
                                        @endif
                                            <img class="scale-with-grid" style="margin:-4px 0px 15px 0; float:left;width:330px;" src="/it/frontend/immagini/free-button.png" alt="" />
                                        </a></div>
                                        <br/><br/><br/>
                                        <p class="hrmargin_0" style="color:#ffffff; text-align:left; font-family: 'Varela Round', sans-serif; font-size:16px; line-height:25px; font-weight:600;">Contattaci per una prima sessione orientativa gratuita con uno dei nostri consulenti</p>
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
                                            <textarea name="message" required placeholder="Messaggio" rows="2" cols="60">{{ old('message') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" name="policy" required>
                                            <span style="color: white;">
															  Autorizzo al trattamento dei miei dati personali ai sensi del Decreto Legislativo 196/2003. <a href="/it/informativa-privacy" target="_blank">Leggi la privacy policy</a></span>
                                        </div>
                                        <!-- SUBMIT -->
                                        <p style="text-align:center;" class="no-margins"><input type="submit" name="invia" value="INVIA"></p>
                                            <input type="hidden" name="service_id" value="1" />
                                            {{ csrf_field() }}
                                        </form>
					                </div>
                                </div>
                            </div>
                        </div>
                    </div>

				<div class="section flv_sections_6" style="padding-top:50px;" id="global-toolbox">
					<div class="section_wrapper clearfix">
                        <div class="items_group clearfix flex-container">
                            <div class="column one-second box-image-container flex-col">
                                <div class="box-image box-globaltest"></div>
                                <div class="box-image-hover box-globaltest-hover"></div>
                            </div>
                            <div class="column one-second box-border-container flex-col">
                                <div class="box-border">
                                    <p class="text-gray default-font text-left">
													In mondo dove tutto cambia di continuo e la competizione cresce ogni giorno, potresti essere tentato di accettare la prima offerta che ricevi, perché non sai che puoi avere di meglio, o perché ancora non <b>ti conosci abbastanza</b>.
												</p>
                                    <p class="text-gray default-font text-left">
													Come fare la scelta giusta nell’iniziare un nuovo lavoro? Come trovare l’ambiente ideale dove poter far crescere le tue competenze ed assicurarti una buona posizione lavorativa futura? <b>Come fare per sapere qual è il posto giusto per te?</b>
												</p>
                                    <p class="text-gray default-font text-left">
													Prova il nostro esclusivo Global Orientation Test per scoprire:
													<br/>- L’azienda ideale per te
													<br/>- In quale paese è più probabile trovarla
													<br/>- Quali sono i paesi europei più aperti ai lavoratori stranieri
												</p>
                                    <p class="text-gray default-font text-left">Non sei curioso di vedere dove potrebbe portarti la prossima mossa della tua carriera?</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            @if(!\Auth::check())
                                <a href="/en/register"> 
                            @else
                                <a href="/en/user/dashboard">
                            @endif
                                <img class="scale-with-grid" src="/it/frontend/immagini/free-button.png" alt="" />
                            </a>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
