@extends('emails.templates.layout1')



@section('content')

	<div class="body">
		<p>
			Hello {{ $msg['to'] }},<br/>
			<br/>
			You have new message from {{ $msg['from'] }}:<br/>
		</p>
		<br/>

		<p><blockquote><i>{{ $msg['message'] }}</i></blockquote></p>

		<br/>
		<br/>
		<div class="buttons">
			<!--button-->
			<table class="m--row" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
					<th class="m--col" align="center" valign="middle" width="100%" style="border-collapse:collapse;padding:0;font-size:1px;line-height:1px;font-weight:normal;width:100%;">
						<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
							<tr>
								<td align="center" valign="middle" style="border-collapse:collapse;font-size:1px;line-height:1px;padding:10px;">
									<table border="0" cellspacing="0" cellpadding="0" class="m--button" style="border-collapse:separate;">
										<tr>
											<td align="center" style="-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;font-size:14px;padding:12px 15px;" bgcolor="#8fcb49">
												<a href="{{ url('consultant/availability/form#discussion') }}" target="_blank" style="font-size:12px;line-height:12px;padding:6px 9px;font-weight:bold;font-family:Arial;color:#ffffff;text-decoration: none;-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;display:block;">
													<span style="color: #ffffff;"><!--[if mso]>&nbsp;<![endif]-->

														Reply to the message

													<!--[if mso]>&nbsp;<![endif]--></span>
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
			<table class="m--row" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
					<th class="m--col" align="center" valign="middle" width="100%" style="border-collapse:collapse;padding:0;font-size:1px;line-height:1px;font-weight:normal;width:100%;">
						<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
							<tr>
								<td align="center" valign="middle" style="border-collapse:collapse;font-size:1px;line-height:1px;padding:10px;">
									<table border="0" cellspacing="0" cellpadding="0" class="m--button" style="border-collapse:separate;">
										<tr>
											<td align="center" style="font-size:15px;" >
												or
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</th>
				</tr>
			</table>
			<!--button-->
			<table class="m--row" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
					<th class="m--col" align="center" valign="middle" width="100%" style="border-collapse:collapse;padding:0;font-size:1px;line-height:1px;font-weight:normal;width:100%;">
						<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
							<tr>
								<td align="center" valign="middle" style="border-collapse:collapse;font-size:1px;line-height:1px;padding:10px;">
									<table border="0" cellspacing="0" cellpadding="0" class="m--button" style="border-collapse:separate;">
										<tr>
											<td align="center" style="-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;font-size:14px;padding:12px 15px;" bgcolor="#8fcb49">
												<a href="{{ url('consultant/availability/form#availability-form') }}" target="_blank" style="font-size:12px;line-height:12px;padding:6px 9px;font-weight:bold;font-family:Arial;color:#ffffff;text-decoration: none;-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;display:block;">
													<span style="color: #ffffff;"><!--[if mso]>&nbsp;<![endif]-->

														Proceed to Booking for the agreed date

													<!--[if mso]>&nbsp;<![endif]--></span>
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
		</div>
		<p style="font-size: x-small; margin-top: 30px; text-align: center;">(Automatic notification. Do not Reply to this e-mail. Click a button above.)</p>
		<br/>
	</div>

@endsection