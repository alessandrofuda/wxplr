@extends('front.new_layout')
@section('content')

</header>
</div>
<div class="column one column_fancy_heading">
								<div class="fancy_heading fancy_heading_icon">
									<h2 style="color:#54b141; background: url(/frontend/immagini/linea-titolo-verde.png) no-repeat bottom center; padding-bottom: 25px;">REGISTRATION</h2><p style="text-align:center;">Register now to enter in the world of Wexplore.<br>For you our free Global Orientation Test: find out your best destination!</p>
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
                    <label for="name">Name : </label>
                    <input type="text" class="form-control" required placeholder="Name" name="name" value="{{ old('name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="surname">Surname : </label>
                    <input type="text" class="form-control" required placeholder="Surname" name="surname" value="{{ old('surname') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback email">
                    <label for="email">Email : </label>
                    <input type="email" class="form-control" required email placeholder="Email" name="email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                @if(app('request')->input('type') == 'professional' || app('request')->input('type') == 'skill')
                    <input type="hidden" name="type" value="{{ app('request')->input('type') }}">
                @else
                    <input type="hidden" name="type" value="basic">
                @endif
                <div class="form-group has-feedback">
                    <label for="password">Password : </label>
                    <input type="password" class="form-control" required placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="password_confirmation">Confirm Password : </label>
                    <input type="password" class="form-control" required placeholder="Confirm password" name="password_confirmation">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
               <span class="paymentOption_div">
                        <input   type="checkbox" required name="tos">
                            <b>I have read and accepted the General <a href="/en/terms-service" target="_blank">Terms and Conditions</a> and have read the <a href="/en/privacy-policy" target="_blank">Privacy Policy</a></b>
                    </span>
                    <span class="paymentOption_div">
                            <input  type="checkbox" required name="tos">
                            <b>I have read and accepted the terms pursuant to art. 1341 and 1342 of the Civil Code</b><br>
                            <div style="overflow:scroll; max-height:50px; overflow-style:marquee-line;font-size:8px; line-height:10px;">Pursuant to the artt. 1341 and 1342 of the Italian Civil Code, the Client expressly acknowledges and agrees to the following clauses, after having thoroughly examined them: 2)Registration to the Website and finalization of the Services delivery contract for Services reserved to Users and Payment Services; 4)Registration Policy; 5)Characteristics of the Services; 6)Fees and Payment of Payment Services; 7)Service activation and delivery; 8)Duration, extension, termination, and cancellation of the Contract; 9)Blog usage; 10)Minors protection; 11)Functionalities of the Services; 12)Services modifications and changes in the offer conditions; 13)Subcontracting; 14)Industrial and/or intellectual property rights – downloadable contents; 15)Limitation of Liability; 16)Service Suspension; 17)Client Data; 18)Limitation of Liability of Gielle; 20)Express termination clause; 21)Final provisions and communications; 22)Governing law, Jurisdiction, and Dispute resolution.
</div>
                    </span>
                    <span class="paymentOption_div">
                        <input  type="checkbox" value="1" name="allow_personal_data">
                            <b>I give my consent to the processing of my personal data for marketing purposes and trade in such Regulations (optional)</b>
                    </span>

                <div class="row form-group has-feedback submit-btn">
                    <!-- /.col -->
                    <div class="Register_now">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <a style="padding-left: 0px;" href="{{ URL::to('/auth/login') }}" class="text-center">I already have a membership</a>
    </div>
    </div>

</div>
</div>
@endsection
