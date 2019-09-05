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
                                        <img src="/frontend/immagini/maybe.png" class="scale-with-grid" alt="Step 2">
                                    </div>
                                    <p class="hrmargin_0 text-center text-white default-font text-bold size-xbig text-left">GLOBAL ORIENTATION TEST</p>
                                    <p class="hrmargin_0" style="color:#ffffff; text-align:left; font-family: 'Varela Round', sans-serif; font-size:16px; line-height:20px; font-weight:600;">A unique free tool to find your ideal company and country match.</p>
                                    <br>
                                    <ul class="list_mixed" style="color:#ffffff;">
                                        <li class="list_arrow text-white default-font size-small text-bold" style="line-height:25px;margin-bottom: 10px;">Lost in the job<br/>placement world?</li>
                                        <li class="list_arrow text-white default-font size-small text-bold" style="line-height:25px;margin-bottom: 10px;">Confused on where will your next career move take you?</li>
                                        <li class="list_arrow text-white default-font size-small text-bold" style="line-height:25px;margin-bottom: 10px;">Wondering how to pick the right direction?</li>
                                    </ul>
                                </div>

                                <!-- One Third (1/3) Column -->
                                <div class="column one-third column_quick_fact" style="background:rgba(0, 0, 0, 0.7);margin-top:40px; padding:20px;">
                                    <div class="aligncenter" style="margin-top: 10px;">
                                        @if(!\Auth::check())
                                            <a href="/register"> 
                                        @else
                                            <a href="/user/dashboard">
                                        @endif
                                            <img class="scale-with-grid" style="margin:-4px 0px 15px 0; float:left;width:330px;" src="/frontend/immagini/free-button.png" alt="" />
                                        </a>
                                    </div>
                                    <br/><br/><br/>
                                    <p class="hrmargin_0" style="color:#ffffff; text-align:left; font-family: 'Varela Round', sans-serif; font-size:16px; line-height:25px; font-weight:600;">CONTACT US for a first FREE orientation session with one of our consultants</p>
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
                                            <textarea name="message" required placeholder="Message" rows="2" cols="60">{{ old('message') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" name="policy" required>
                                            <span style="color: white;">I authorize the treatment of my personal data pursuant to the General Data Protection Regulation (EU GDPR) 2016/679. <a href="/privacy-policy" target="_blank">Read the privacy policy</a></span>
                                        </div>
                                        <!-- SUBMIT -->
                                        <p style="text-align:center;" class="no-margins"><input type="submit" name="invia" value="SEND"></p>
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
                                <p class="text-gray default-font text-left">In a world with so many changes and with increased competition, you might be tempted to accept the first offer you get, because you don’t know better, or because you don’t know <b>yourself</b> better.</p>
                                <p class="text-gray default-font text-left">How do you make the right choice when starting a new job? How do you find the right environment where you can grow your skills and ensure you can be well positioned for the future? <b>How do you know where in the global market is the right place for you?</b></p>
                                <p class="text-gray default-font text-left">Try out our exclusive Global Orientation Test to find: <br/>- The ideal company for you <br/>- In which Country it is most likely to be located <br/>- Which countries in Europe are most open to foreign workers</p>
                                <p class="text-gray default-font text-left">Aren’t you curious to see where your next career move might take you?</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        @if(!\Auth::check())
                            <a href="/register"> 
                        @else
                            <a href="/user/dashboard">
                        @endif
                            <img class="scale-with-grid" src="/frontend/immagini/free-button.png" alt="" />
                        </a>
                    </div>
				</div>
			</div>
		</div>
</div>


	</div>
</div>
