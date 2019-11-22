@extends('emails.templates.layout1')
                
@section('content')
    <table border="0" cellpadding="0" cellspacing="0" width="" id="template_container" style="box-shadow: 0 1px 4px rgba(0,0,0,0.1) !important; background-color: #fdfdfd; border: 1px solid #dcdcdc; border-radius: 3px !important; max-width: 100%;">
        <tr>
            <td align="center" valign="top">
                <!-- Header -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header" style="background-color: #1f87c7; border-radius: 3px 3px 0 0 !important; color: #ffffff; border-bottom: 0; font-weight: bold; line-height: 100%; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; max-width: 100%;">
                    <tr>
                        <td id="header_wrapper" style="padding: 36px 48px; display: block;">
                            <h1 style="text-align: center!important; color: #ffffff; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 30px; font-weight: 300; line-height: 150%; margin: 0; text-align: left; text-shadow: 0 1px 0 #1f87c7; -webkit-font-smoothing: antialiased;">Thank you for your order</h1>
                        </td>
                    </tr>
                </table>
                <!-- End Header -->
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">
                <!-- Body -->
                <table border="0" cellpadding="0" cellspacing="0" width="" id="template_body">
                    <tr>
                        <td valign="top" id="body_content" style="background-color: #fdfdfd;">
                            <!-- Content -->
                            <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                <tr>
                                    <td valign="top" style="padding: 48px;">
                                        <div id="body_content_inner" style="color: #737373; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 150%; text-align: left;">
                                            <p style="margin: 0 0 16px;">Your order has been received and is being processed. Please find below the order details:</p>
                                            <h2 style="color: #1f87c7; display: block; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 16px 0 8px; text-align: left;">Order n° {!! $order_id !!}</h2>
                                            <table width="90%" border="1px" style="border-color:#c1c1c1;" cellspacing="0" cellpadding="10px">
                                                <tbody>
                                                <tr>
                                                    <td><strong>Product</strong></td>
                                                    <td><strong>Quantity</strong></td>
                                                    <td><strong>Price</strong></td>
                                                </tr>

                                                <tr>
                                                    <td>{!! $product_name !!}</td>
                                                    <td>{!! $quantity !!}</td>
                                                    <td>{!! $price.'€' !!}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2">Subtotal:</td>
                                                    <td>{!! $subtotal !!}€</td>
                                                </tr>

                                                @if($discount != 0)
                                                    <tr>
                                                        <td colspan="2">Discount:</td>
                                                        <td>{!! $discount !!}€</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">Promo Code:</td>
                                                        <td>{!! $promo_code !!}</td>
                                                    </tr>
                                                @endif
                                                {{-- <tr>
                                                     <td colspan="2">Spedizione:</td>
                                                     <td>1,00€ tramite Standard</td>
                                                 </tr>--}}
                                                @if($total != 0)
                                                    <tr>
                                                        <td colspan="2">Payment method:</td>
                                                        <td>{!! $payment_method !!}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="2">Total:</td>
                                                    <td>{!! $total !!} @if($total != 0) €(include {{ $vat_price }}&euro; IVA 22%)@endif</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <p><strong>I authorize the treatment of my personal data pursuant to the General Data Protection Regulation (EU GDPR) 2016/679.</strong></p>
                                            @if($total != 0) <p><strong>Payment method:</strong> {!! $payment_method !!}</p>@endif
                                            <h2 style="color: #1f87c7; display: block; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 16px 0 8px; text-align: left;">
                                                Client details
                                            </h2>
                                            <p>Email: <a href="mailto:{{ $user->email }}">{!! $user->email !!}</a><br>
                                                Tel: {{ isset($user->userProfile->Telephone) ?  $user->userProfile->Telephone :""}}<br>
                                            </p>
                                            <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td><h2 style="color: #1f87c7; display: block; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 16px 0 8px; text-align: left;">
                                                            Billing address</h2>
                                                        {{ $user->name }}<br>
                                                        {!! isset($user->userProfile->address) ?  $user->userProfile->address : "" !!}<br>
                                                        {!! isset($user->userProfile->city) ?  $user->userProfile->city : "" !!}<br>
                                                        {!! isset($user->userProfile->country) ?  $user->userProfile->country : "" !!}<br>
                                                        {!! isset($user->userProfile->zip_code) ?  $user->userProfile->zip_code : "" !!}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <p style="margin: 0 0 16px;">&nbsp;</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <!-- End Content -->
                        </td>
                    </tr>
                </table>
                <!-- End Body -->
            </td>
        </tr>
    </table>
@endsection
