@extends('front.new_layout')
@section('content')

</header>
</div>
<div class="column one column_fancy_heading">
								<div style="margin-top:40px;" class="fancy_heading fancy_heading_icon">
									<h2 style="background: url(/en/frontend/immagini/linea-titolo-verde.png)   no-repeat bottom center; padding-bottom: 25px;color:#54b141;">REGISTRATI</h2><p style="text-align:center;">Registrati ora per entrare nel mondo di Wexplore.<br>Per te gratis il nostro Global Orientation Test: scopri quale destinazione ti aspetta!</p>
								</div>
							</div>
<div class="user_login_form">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-none">

        @if($errors->any())
            <div class="row">
                <ul class="alert-box warning radius">
                    @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form method="POST" action="{{ url('register') }}">
                {!! csrf_field() !!}
                <div class="form-group has-feedback">
                    <label for="name">Nome: </label>
                    <input type="text" class="form-control" required placeholder="Nome" name="name" value="{{ old('name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="surname">Cognome: </label>
                    <input type="text" class="form-control" required placeholder="Cognome" name="surname" value="{{ old('surname') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback email">
                    <label for="email">Email: </label>
                    <input type="email" class="form-control" required email placeholder="Email" name="email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                @if(app('request')->input('type') == 'professional' || app('request')->input('type') == 'skill')
                    <input type="hidden" name="type" value="{{ app('request')->input('type') }}">
                @else
                    <input type="hidden" name="type" value="basic">
                @endif
                <div class="form-group has-feedback">
                    <label for="password">Password: </label>
                    <input type="password" class="form-control" required placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="password_confirmation">Conferma Password: </label>
                    <input type="password" class="form-control" required placeholder="Conferma password" name="password_confirmation">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                    <span class="paymentOption_div">
                        <input   type="checkbox" required name="tos">
                            <b>Ho letto e accettato i <a href="/it/condizioni-vendita" target="_blank">Termini e Condizioni</a> di vendita e ho letto la <a href="/it/informativa-privacy" target="_blank">Privacy Policy</a></b>
                    </span>
                    <span class="paymentOption_div">
                            <input  type="checkbox" required name="tos">
                            <b>Ho letto e accettato i termini di cui all'art. 1341 e 1342 del codice civile</b><br>
                            <div style="overflow:scroll; max-height:50px; overflow-style:marquee-line;font-size:8px; line-height:10px;"><span>Clausole vessatorie[C1]: Ai sensi e per gli effetti di cui agli artt. 1341 e 1342 Cod. Civ., il Cliente, dopo averne presa attenta e specifica conoscenza e visione, approva e ed accetta espressamente le seguenti clausole: 2)  Registrazione al Sito e conclusione del contratto di fornitura dei Servizi riservati agli Utenti e dei Servizi a Pagamento; 4) Modalità di registrazione; 5) Caratteristiche dei servizi; 6) Corrispettivi e modalità di pagamento dei Servizi a Pagamento; 7) Attivazione ed erogazione del servizio; 8) Durata, rinnovo, cessazione, recesso dal contratto; 9) Utilizzo dei blog; 10) Tutela minori; 11) Funzionalità dei Servizi; 12) Modifiche dei servizi e variazioni alle condizioni dell'offerta; 13) Cessione del Contratto; 14) Diritti di proprietà industriale e/o intellettuale – contenuti scaricabili; 15) Limitazione della responsabilità; 16) Sospensione del Servizio; 17) Dati del Cliente; 18) Limitazioni di responsabilità di Gielle; 20) Clausola risolutiva espressa; 21) Disposizioni finali e comunicazioni 22) Legge applicabile e Foro competente.</span></div>
                    </span>
                    <span class="paymentOption_div">
                        <input  type="checkbox" value="1" name="allow_personal_data">
                            <b>Autorizzo al trattamento dei miei dati personali per finalità di marketing. (opzionale)</b>
                    </span>


                <div class="row form-group has-feedback submit-btn">
                    <!-- /.col -->
                    <div class="Register_now">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrati</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <a style="padding-left: 0px;" href="{{ URL::to('/auth/login') }}" class="text-center">Possiedo già un account</a>
    </div>
    </div>

</div>
</div>
@endsection
