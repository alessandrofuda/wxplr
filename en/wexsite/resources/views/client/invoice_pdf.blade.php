<!DOCTYPE html>
<html>
<head>
    <title>Wexplore Invoice</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0;">
<br/>
<br/>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <thead>
    <tr style="text-align: left;">
        <th width="50%"><img width="350px" src="{{ asset('/frontend/immagini/logo-wexplore.png') }}" /></th>
        <th width="50%">
            <ul style="list-style: none; padding: 0;font-family: 'Open Sans', sans-serif;font-size: 10pt; font-weight: normal; color: #58585a;">
                <li style="font-size: 15pt;"><strong style="font-weight: bold;">Wexplore</strong></li>
                <li>{!! $settings->location_address !!}{{--Via Sangallo, 33 - 20133 Milano (MI), Italy--}}</li>
               {{-- <li>P.IVA: {!! $settings->website_phone !!}</li>
                <li>PEC: {!! $settings->website_email !!}--}}{{--pec@adivalue.it--}}{{--</li>
                <li>REA: 32154841</li>--}}
            </ul>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr style="text-align: left;">
        <td style="font-family: 'Open Sans', sans-serif;font-size: 17pt; font-weight: bold; color: #2788c4;"><h2 style="margin: 10px 0 0 0;">INVOICE</h2></td>
    </tr>
    <tr>
        <td style="vertical-align: top;">
            <ul style="font-family: 'Open Sans', sans-serif;font-size: 10pt; font-weight: normal; color: #58585a; list-style: none; padding: 0;">
                <li>{{ $order_obj->user->name }} {{ $order_obj->user->surname }}</li>
                <li>{{ isset($order_obj->user->userProfile->address) ? $order_obj->user->userProfile->address : "" }}</li>
                <li>{{ isset($order_obj->user->userProfile->address) ? $order_obj->user->userProfile->city : "" }}</li>
                <li>{{ isset($order_obj->user->userProfile->address) ? $order_obj->user->userProfile->country : "" }}</li>
                <li>{{ isset($order_obj->user->userProfile->address) ? $order_obj->user->userProfile->zip_code : "" }}</li>

               {{-- <li>STUDIO IL GRANELLO s.c.s.</li>

                <li>Via S.Prospero, 24</li>
                <li>Correggio - RE</li>
                <li>42015</li>
                <li>IT 02212160358</li>--}}
                <li>{{ $order_obj->user->email }}</li>
                @if($order_obj->user->userProfile->company != null)
                    <li>{{ isset($order_obj->user->userProfile) ? $order_obj->user->userProfile->vat : "" }}</li>
                @endif
                <li>{{ isset($order_obj->user->userProfile) ? $order_obj->user->userProfile->pan : "" }}</li>
                <li>{{ isset($order_obj->user->userProfile) ? $order_obj->user->userProfile->telephone : "" }}</li>
               {{-- <li>0522690186</li>--}}
            </ul>
        </td>
        <td style="vertical-align: top;">
            <ul style="font-family: 'Open Sans', sans-serif;font-size: 10pt; font-weight: normal; color: #58585a; list-style: none; padding: 0;">
                <li><span style="width: 110px;display: inline-block;">Invoice N.:</span> {{ $order_obj->invoice_number }}</li>
                <li><span style="width: 110px;display: inline-block;">Invoice date:</span> {{ date('d M, Y') }}</li>
                <li><span style="width: 110px;display: inline-block;">Order N.:</span> {{ $order_obj->id }}</li>
                <li><span style="width: 110px;display: inline-block;">Order Date:</span> {{ date('d M, Y',strtotime($order_obj->created_at)) }}</li>
                @if($total != 0)  <li><span style="width: 110px;display: inline-block;">Payment</span> </li>
                <li><span style="width: 110px;display: inline-block;">method:</span>  {{ $payment_method }}</li> @endif
            </ul>
        </td>
    </tr>
    </tbody>
</table>
<br/>
<br/>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <thead style="font-family: 'Open Sans', sans-serif;font-size: 10pt; font-weight: normal; color: #58585a;">
    <tr style="text-align: left;background: #2788c4;color: #fff;">
        <th style="padding: 10px;">Product</th>
        <th style="padding: 10px;">Unit Price</th>
        <th style="padding: 10px;">Quantity</th>
        <th style="padding: 10px;">VAT</th>
        <th style="padding: 10px;">Price</th>
    </tr>
    </thead>
    <tbody style="font-family: 'Open Sans', sans-serif;font-size: 10pt; font-weight: normal; color: #58585a;">
    <tr>
        <td style="padding: 10px; border-bottom: solid 1px #9c9e9f;">{{ $product_name }}</td>
        <td style="padding: 10px; border-bottom: solid 1px #9c9e9f;">{{ $price }}&euro;</td>
        <td style="padding: 10px; border-bottom: solid 1px #9c9e9f;">1</td>
        <td style="padding: 10px; border-bottom: solid 1px #9c9e9f;">{{ $vat_price }} &euro;</td>
        <td style="padding: 10px; border-bottom: solid 1px #9c9e9f;">{{ $price }} @if($price > 0) &euro;@endif</td>
    </tr>
    </tbody>
</table>
<br/>
<br/>
<table width="50%" border="0" cellspacing="0" cellpadding="0" align="right">
    <tbody style="font-family: 'Open Sans', sans-serif;font-size: 10pt; font-weight: normal; color: #58585a;">
    <tr>
        <td style="padding: 10px;border-bottom: solid 1px #9c9e9f;"><strong>Subtotal</strong></td>
        <td style="padding: 10px;border-bottom: solid 1px #9c9e9f;">{{ $price }}&euro;</td>
    </tr>

    @if($discount > 0)
        <tr>
            <td style="padding: 10px;border-bottom: solid 1px #9c9e9f;"><strong>Discount</strong></td>
            <td style="padding: 10px;border-bottom: solid 1px #9c9e9f;">{{ $discount }}&euro;</td>
        </tr>
    @endif
    <tr>
        <td style="padding: 10px;border-bottom: solid 1px #9c9e9f;"><strong>Total</strong></td>
        <td style="padding: 10px;border-bottom: solid 1px #9c9e9f;">{{ $total }} @if($total > 0)  &euro; (include {{ $vat_price }}&euro; VAT 22%)@endif</td>
    </tr>
    </tbody>
</table>
<br/>
<br/>
<table style="height: 80px;">
    <tr>
        <td></td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tbody style="font-family: 'Open Sans', sans-serif;font-size: 10pt; font-weight: normal; color: #58585a;">
   {{-- <tr>
        <td style="text-align: center; border-bottom: solid 2px #9c9e9f;"><img src="/en/frontend/immagini/logo-wexplore.png"></td>
    </tr>--}}
    <tr>
        <td style="text-align: center; padding: 10px;">
				<a style="font-family: 'Open Sans', sans-serif;font-size: 10pt; font-weight: normal; color: #58585a; text-decoration: none;" href="https://www.wexplore.co">www.wexplore.co | </a>
        <a style="font-family: 'Open Sans', sans-serif;font-size: 10pt; font-weight: normal; color: #58585a; text-decoration: none;" href="mailto:info@wexplore.co">info@wexplore.co</a>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>

















{{--



<style type="text/css">
@import 'https://fonts.googleapis.com/css?family=Oxygen';
    body{
        font-family: 'Oxygen', sans-serif;
    }
.left_contant {
    float: left;
}
.right_contant {
    float: right;
    text-align: right;
}
.left_contant address, .right_contant address {
    font-style: normal;
    font-size: 13px;
}
.right_contant h2 {
    margin: 15px 0 15px 0px;
}
hr{height: 1px; background: #ddd; float: left; width: 100%; border: none; margin-top: 40px}
.Invoice_content {
    clear: both;
    font-size: 13px;
    padding: 40px 70px;
    border-top: solid 1px #ddd;
    margin-top: 50px;
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    font-size: 12px;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 5px 8px;

}


tfoot th {
    border-right: 0px solid #dddddd;
    border-left: 0px solid #dddddd;
}
</style>

<div class="MAIN_INVOICE">
    <div class="left_contant">
    <h3>Wexplore</h3>
    <address>
        <br/>
        {!! $settings->location_address !!}<br/>
        {!! $settings->website_email !!}
    </address>
    </div>
    <div class="right_contant">
        <h2>INVOICE</h2>
        <address>
            {!! $order->created_at !!}<br/>
            Invoice #{{ $order->id }}<br/>
           <br/><br/>
            <b>Att: {!! $order->user->name !!}</b><br/>
           @if(isset( $order->user->userProfile->company )) <b>{!! $order->user->userProfile->company !!}</b><br/>@endif
        </address>
    </div>

<div class="Invoice_content">
    Dear {!! $order->user->name !!},<br/>
    <p>Please find below a cost-breakdown for the recent payment completed. Please confirm the same and do not hesitate to contact me with any questions.</p><br/>
    Many thanks,<br/>
    Wexplore Team
</div>

<table>
  <thead>
    <tr>
        <th>#</th>
        <th>Item Description</th>
        <th>Amount Paid &euro;</th>
     </tr>
  </thead>
  <tbody>
    <tr>
    <td>1</td>
    <td>{!! $order->transaction->getItemDetails() !!}</td>
    <td>{!! $order->transaction->amount !!}</td>
  </tr>
  </tbody>
</table>

<div class="Invoice_content">
    Many thanks for your custom! I look forward to doing business with you again in due course.<br/>
    Payment terms: to be received within 60 days.
</div>

</div>
</div>
--}}
