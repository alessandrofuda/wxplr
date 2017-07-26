
<div class="section flv_sections_8"  id="skills-development">
					<div class="section_wrapper clearfix">
						<div class="items_group clearfix">
							<!-- Page Title-->
							<!-- One full width row-->
							<div class="column one column_fancy_heading">
								<div class="fancy_heading fancy_heading_icon">
									<h2 style="color:#1f87c7; text-transform:uppercase; background: url(/en/frontend/immagini/linea-titolo-blu.png) no-repeat bottom center; padding-bottom: 25px;">CONTATTI</h2><p style="text-transform:uppercase;">Hai bisogno di informazioni? Siamo qui per aiutarti.</p>
								</div>
                                <div class="image_wrapper"><img class="scale-with-grid" src="/it/frontend/immagini/contatti.jpg"alt="" />
									</div>
							</div>
                            <div class="column one column_fancy_heading">

                            <form role="form" method="post" action="{{ url('contact') }}">
                        <!-- text input -->
                        <div class="form-group column one-third column_column">
                          <label>Nome*</label>
                          <input type="text" name="name" required class="form-control" placeholder="Inserisci il nome..." value="">
                        </div>
						<div class="form-group column one-third column_column">
                          <label>E-mail*</label>
                          <input type="email" name="email" required class="form-control" placeholder="Inserisci l'email..." value="">
                        </div>
                        <div class="form-group column one-third column_column">
                          <label>Oggetto</label>
                          <input type="text" name="subject" class="form-control" placeholder="Inserisci l'oggetto..." value="">
                        </div>
						<div class="form-group">
                          <label>Messaggio</label>
                          <textarea name="message" rows=5 class="form-control" placeholder="Scrivi un messaggio..."></textarea>
                        </div>
						<div class="form-group">
                          <label>Informativa Privacy*</label>
							<div>
							<input type="radio" name="policy" required>
							<span>Dichiaro di aver preso visione dell'<a href="/it/informativa-privacy">Informativa sulla privacy</a></span>
						  </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Invia</button>
                      </form>
                            </div>


						</div>
					</div>
				</div>
