<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Wexplore - {{ $meta_title }}</title>
	    <!-- STYLES -->



	    {{-- <link rel="stylesheet" href="{{ public_path('frontend/css/bootstrap.min.css') }}" type="text/css"> --}}
	    <style>
	    	/*layout*/
	    	

	    	/*from external file*/
	    	/* got gotPro Vic reports styles */
			@page { margin: 100px 25px; }

			body { color: #055b76; line-height: 1.3; }
			header { position: fixed; top: -60px; left: 0px; right: 0px; height: 50px; }
			footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; }
			verticalbar { position: fixed; bottom: 0px; right: 0px; height: 100%; width:50px; }
			.page { page-break-after: always; }
			.page:last-child { page-break-after: never; }

			.container {position: relative;}
	    	.row {width:100%; position: relative; padding-left:20px; padding-right: 20px;}
	    	.col-md-6 {position: relative; width: 50%; display: inline-block;}
	    	.img-fluid{  }
	    	.text-right {text-align: right;}
	    	.text-center {text-align: center;}
			.col-md-10 { width: 90%; }
			.top-bar { height: 30px; margin-top: 5px; margin-bottom: 20px; }
			.img-fluid { max-width: 100%; height: auto; }
			.top-bar-img { width:100%; }
			.vertical-img { vertical-align: bottom; }
			.vertical-right-bar { position: absolute; bottom: 100px; }
			.report-logo { width: 220px; margin-top: -30px; }
			.report-title { text-transform: uppercase; text-align: center; margin-top: 30px; margin-bottom: 30px; }
			.top-section { text-align: center; margin-top: 20px; margin-bottom: 30px; }
			.sub-title { text-align: center; margin-bottom: 50px; }
			.top-section .name { margin-top: 10px; }
			.bottom-section { position: absolute; bottom: 10px; }
			.page-break { page-break-after: always; }
			.bold { font-weight: bold; }
			/*got-report*/
			#got-report { padding-left: 20px; padding-right: 20px; }
			#got-report .countries { font-weight: bold; margin-top: 30px; margin-bottom: 40px; }
			#got-report .middle-section { margin-bottom:70px; }
			/*got-pro report*/
			#got-pro-report { padding-left: 20px; padding-right: 20px; }
			#got-pro-report .legend { text-align: center; margin-bottom: 10px; display: block; }
			#got-pro-report .chart-container { border:1px solid #888888; margin-bottom: 30px; text-align: center; }
			#got-pro-report .claim { margin-bottom: 30px; }
			#got-pro-report .legend-block { display: inline-block; margin-right: 20px; }
			 /*vic b2c report*/
			 .fullname { font-size:16px; margin-bottom: 30px; }
			.contries-wrap { margin-bottom: 30px; }
			.title { margin-top: 30px; margin-bottom: 40px; font-size: 14px; }
			.section-title { text-transform: uppercase; margin-top: 30px; margin-bottom: 25px; font-weight: bold; }
			.section-title.underlined { text-decoration: underline; font-weight: bold; margin-top: 30px; }
			.slogan { margin-top:40px; margin-bottom: 40px; }
			a { text-decoration: underline!important; }
			table.star-table td { padding-top: 20px; padding-bottom: 20px; padding-left: 20px; padding-right: 20px; }
	    </style>
	</head>

	<body>
		<header class="row">
			<div class="col-md-12">
				<div class="top-bar">
					<img class="img-fluid top-bar-img" src="{{ public_path('frontend/images/reports/top-bar.jpg') }}"/>
				</div>
			</div>
		</header>
		<footer>
			<div class="col-md-12">
				<div class="top-bar">
					<img class="img-fluid top-bar-img" src="{{ public_path('frontend/images/reports/top-bar.jpg') }}"/>
				</div>
			</div>
		</footer>
		<verticalbar>
			<div class="vertical-right-bar">
				<img class="img-fluid vertical-img" src="{{ public_path('frontend/images/reports/vertical-bar.jpg') }}">
			</div>
		</verticalbar>
		
		<main class="report">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="address">
							Wexplore Srl<br>
							Via Sangallo, 33 20133 Milano<br>
							P.IVA 09896070969
						</div>
					</div>
					<div class="col-md-6">
						<div class="logo text-right">
							<img class="img-fluid report-logo" src="{{ public_path('frontend/images/reports/wexplore_colore.jpg') }}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-12">
								<div class="report-title">
									@yield('title')
								</div>
							</div>
							<div class="col-md-12">
								<div class="report-content">
									@yield('content')
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</body>
</html>