<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>{{ $title }}</title>
		<style type="text/css">
			.countries {
				font-weight: bold;
				color: #055b76;
			}
			.profile-name {
				font-weight: bold;
				color: #055b76;	
			}
		</style>
	</head>

	<body>
		<div class="report">
			<div class="report-title">
				@yield('title')
			</div>
			<div class="report-content">
				@yield('content')
			</div>
		</div>
	</body>
</html>