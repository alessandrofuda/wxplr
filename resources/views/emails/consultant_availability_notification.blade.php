@extends('emails.templates.layout1')


@section('content')

	<div class="body">
		Hello {{ $client_name }},<br/>
		<br/>
		your Consultant has booked the agreed date for Conference Call: <br/>
		<br/>
		<p>
			<b>Consultant Name</b>: {{ $consultant_name }} <br>
			<b>Call Type</b>: {{ $type }} <br>
		</p>
		<br/>
	</div>
	<p><br/>Please,</p>
	<!--button-->
	<table class="m--row" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
		<tr>
			<th class="m--col" align="center" valign="middle" width="100%" style="border-collapse:collapse;padding:0;font-size:1px;line-height:1px;font-weight:normal;width:100%;">
				<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
					<tr>
						<td align="center" valign="middle" style="border-collapse:collapse;font-size:1px;line-height:1px;padding:10px;">
							<table border="0" cellspacing="0" cellpadding="0" class="m--button" style="border-collapse:separate;">
								<tr>
									<td align="center" style="-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;font-size:12px;padding:3px 9px;" bgcolor="#8fcb49">
										<a href="{{ url('user/role_play_interview#calendar') }}" target="_blank" style="font-size:14px;line-height:15px;padding:8px 10px;font-weight:bold;font-family:Arial;color:#ffffff;text-decoration: none;-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;display:block;">
											<span style="color: #ffffff;">

												click here to View or Confirm agreed Date

											</span>
										</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</th>
		</tr>
	</table>

@endsection


@if(isset($client_id))
	@section('unsubscribe')

		<a href="{{ UrlSigner::sign(route('delete-account', ['user_id' => $client_id ]), 7) }}" target="_blank">deleting account</a>

	@endsection
@endif