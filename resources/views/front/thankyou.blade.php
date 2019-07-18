@extends('layouts.new_layout')

@section('content')
	@if(isset($service_id) && $service_id == 2)
		<!-- Google Code for Wexplore Conversion Page -->
		<script type="text/javascript">
			/* <![CDATA[ */
			var google_conversion_id = 922912440;
			var google_conversion_language = "en";
			var google_conversion_format = "3";
			var google_conversion_color = "ffffff";
			var google_conversion_label = "T81rCNOm3G8QuI2KuAM";
			var google_remarketing_only = false;
			/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
		<noscript>
			<div style="display:inline;">
				<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/922912440/?label=T81rCNOm3G8QuI2KuAM&amp;guid=ON&amp;script=0"/>
			</div>
		</noscript>
	@endif
	<div class="container">
		<div class="row">
			<div class="column one column_fancy_heading">
				<div style="margin-top:40px;" class="fancy_heading fancy_heading_icon">
					<h2 style="background: url(/frontend/immagini/linea-titolo-verde.png)   no-repeat bottom center; padding-bottom: 25px;color:#54b141;">{{ $page_title }}</h2>
				</div>
			</div>
			<div class="page_desc text-center">
				<p>Thank you for your choice.<br/>
				Details of your order will be sent to you by email.<br/>
				In a few seconds you will be redirected to your personal dashboard…</p>
				<a href="{{ url('user/dashboard') }}">Got to Dashboard</a>
			</div>
			<div class="redirect-cls"><img src="{{ asset('frontend/images/ajax-load.gif') }}" alt="Loading..."></div>
		</div>
	</div>
	<script>
		jQuery('document').ready(function(){
			setTimeout(function() {
				window.location.href="{{ url('user/dashboard') }}";
			},10000);
		})
	</script>
@endsection
