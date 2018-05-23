@extends('front.new_layout')
@section('content')
</header>
</div>
<div class="">
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
        <form method="POST" action="{{ url('client/register') }}">
            {!! csrf_field() !!}
            <div class="form-group has-feedback">
                <label for="name">Name* : </label>
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
            <div class="form-group has-feedback ">
                <label for="pan">Password : </label>
                <input type="password" class="form-control" required placeholder="Password" name="password">
            </div>
            <div class="form-group col-md-6">
                <label>Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation">
            </div>
            <div class="form-group has-feedback ">
                <label for="pan">Personal Identification Number : </label>
                <input type="text" class="form-control" required placeholder="Personal Identification Number" name="pan" value="{{ old('pan') }}">
            </div>
            <div class="form-group has-feedback ">
                <label for="vat">VAT : </label>
                <input type="text" class="form-control" placeholder="VAT" name="vat" value="{{ old('vat') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback ">
                <label for="company">Company (If Applicable)</label>
                <input type="text" class="form-control" placeholder="Company" name="company" value="{{ old('company') }}">
            </div>
            <div class="form-group has-feedback ">
                <label for="address">Address</label>
                <textarea required rows="4" cols="50" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}">{{ old('address') }}</textarea>
                <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback email">
                <label for="country">Country</label>
                @if (count($country_list) > 0)
                    <select name="country" id="country" required class="form-control">
                        <option value="">Select Country</option>
                        @foreach ($country_list as $country)
                            <option @if(old('country') == $country['country_name']) selected="selected" @endif value = "{{  $country['country_name'] }}">{{  $country['country_name'] }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <div class="form-group has-feedback ">
                <label for="text">City</label>
                <input type="text" class="form-control" required placeholder="City" name="city" value="{{ old('city') }}">
            </div>
            <div class="form-group has-feedback ">
                <label for="zip_code">ZIP Code</label>
                <input type="text" class="form-control" required placeholder="ZIP Code" name="zip_code" value="{{ old('zip_code') }}"></div>
            <div class="form-group has-feedback">
                <label for="telephone">Telephone</label>
                <input type="tel" class="form-control" placeholder="Telephone Number" name="telephone" value="{{ old('telephone') }}">
                <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
            </div>
            <div class="checkbox check-label">
                <input type="checkbox" required name="terms_and_privacy">
                <label for="terms_and_policy">I have read and accepted the General <a href="#">Terms and Conditions</a> and have read the <a href="#">Privacy Policy</a></label>
            </div>
            <div class="checkbox check-label">
                <input type="checkbox" required name="read_and_accepted">
                <label for="read_and_accepted">I have read and accepted the terms pursuant to art. 1341 and 1342 of the Civil Code</label>
            </div>
            <div class="checkbox check-label">
                <input type="checkbox" value="1" name="allow_personal_data">
                <label for="read_and_accepted">I give my consent to the processing of my personal data for marketing purposes and trade in such Regulations (optional)</label>

            </div>
            <div class="row form-group has-feedback submit-btn">
                <!-- /.col -->
                <div class="Register">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
                </div>

    </div>
</div>

<style>
    .container.client_register {
        width: 100%;
        padding: 0;
        background: url('http://bartonwyatt.co.uk/wp-content/uploads/2014/07/register-with-barton-wyatt.jpg');
        background-size: 100% 100%;
        padding: 0px 0;
    }
    .container.client_register .wrapper {
        padding: 0;
    }
    .overlay {
        background: rgba(255,255,255, 0.6);
        padding: 80px 0px;
    }
    .container.client_register .Register {
        width: 100%;
        max-width: 1170px;
        margin: 0px auto;
        border-radius: 3px;
    }
    .container.client_register .Register .row {
        margin: 0;
    }
    .container.client_register .Register h3 {
        margin: 0 0 20px;
        padding: 20px 0px 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: solid 2px rgba(204, 204, 204, 0.59);
    }
    .container.client_register .Register .row form .form-group,
    .container.consultant_register .Register .row form .form-group {
        width: 50%;
        display: inline-block;
        float: left;
        padding: 0px 5px;
    }
    .container.client_register .row.form-group.has-feedback.submit-btn {
        padding: 0;
    }
    .container.client_register .Register .row form .form-group.email,
    .container.consultant_register .Register .row form .form-group.email{
        width: 100%;
    }
    .container.client_register .Register .row form .form-group:nth-child(odd),
    .container.consultant_register .Register .row form .form-group:nth-child(odd) {
        /* margin-left: 17px;*/
    }
    .container.client_register .Register .row form .form-group input, .container.consultant_register .Register .row form .form-group input {
        border-radius: 0;
        height: 40px;
        width: 100%;
    }
    .container.client_register .Register .row form .form-group span ,
    .container.consultant_register .Register .row form .form-group span{
        height: 40px;
        line-height: 40px;
    }
    .container.client_register .Register .row form .checkbox input[type="checkbox"],
    .container.consultant_register .Register .row form .checkbox input[type="checkbox"]{
        margin: 0;
        left: 0;
        top: 2px;
    }
    .Register_now button {
        background-color: #2087c8;
        border: none;
        font-size: 16px;
        height: 40px;
        margin: 20px auto 20px;
        width: 100%;
        -webkit-transition: all .5s;
        -moz-transition: all .5s;
        -o-transition: all .5s;
        border-radius: 0;
    }
    .container.client_register .Register .row form .form-group.submit-btn,
    .container.consultant_register .Register .row form .form-group.submit-btn{
        width: 100%;
        margin: 0;
        text-align: center;
    }
</style>
@endsection