@extends('emails.templates.layout1')


@section('content')


	<div class="body">
	    Hello {{ $data['consultant_name'] }},<br/>
	    <br/>
	    a client has submitted a Dream Check Lab form with his/her CV. <br/>

	    {{-- link_to_route('dreamcheck.lab.submission', 'Click here', $data['dream_check_lab_id'], array('class' => 'btn btn-default')) --}}


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
											<a href="{{ route('dreamcheck.lab.submission', ['dreamcheck_id' => $data['dream_check_lab_id']] ) }}" target="_blank" style="font-size:12px;line-height:12px;padding:6px 9px;font-weight:bold;font-family:Arial;color:#ffffff;text-decoration: none;-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;display:block;">
												<span style="color: #ffffff;"><!--[if mso]>&nbsp;<![endif]-->

													CLICK HERE

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



	    to check the submission.<br/>
	    <br/>
	    <br/>
	</div>

@endsection