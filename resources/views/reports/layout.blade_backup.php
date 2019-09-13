<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>{{ $title }}</title>
		<!-- FONTS -->
	    <link rel='stylesheet' id='Roboto-css' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700'>
	    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	    <link rel='stylesheet' id='Patua+One-css' href='https://fonts.googleapis.com/css?family=Patua+One:100,300,400,400italic,700'>
	    <!-- STYLES -->
	    <link rel="stylesheet" href="{{ public_path('frontend/css/bootstrap.min.css') }}" type="text/css">
	    <link rel="stylesheet" href="{{ public_path('frontend/css/reports/reports.css') }}" type="text/css"> {{-- !! public_path('') !! --}}
	    <!-- <link rel="stylesheet" href="/frontend/css/bootstrap.min.css" type="text/css">
	    <link rel="stylesheet" href="/frontend/css/reports/reports.css" type="text/css"> -->
	</head>

	<body>
		<div class="report">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="top-bar">
							<img class="img-fluid top-bar-img" src="{{ public_path('frontend/images/reports/top-bar.jpg') }}"/>
						</div>
					</div>
				</div>
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
					<div class="vertical-right-bar">
						<img class="img-fluid vertical-img" src="{{ public_path('frontend/images/reports/vertical-bar.jpg') }}">
					</div>
				</div>
			</div>
		</div>
	</body>
</html>