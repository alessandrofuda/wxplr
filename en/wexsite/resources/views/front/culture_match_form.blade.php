<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 "> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>

	<!-- Basic Page Needs -->
	<meta charset="utf-8">
	<title>Wexplore</title>
	<meta name="description" content="">
	<meta name="author" content="">

<!-- Favicons -->
	<link rel="shortcut icon" href="{{ asset('frontend/immagini/favicon.ico') }}">
	<script src="{{ asset('frontend/js/jquery-1.12.4.js') }}"></script>

</head>

<body>

<form id="culture_form" action="https://geert-hofstede.com/cultural-survey-redirect.html" method="post">
	<input type="hidden" name="firstName" value="{{ Auth::user()->name }}" />
	<input type="hidden" name="lastName" value="{{ Auth::user()->surname }}" />
	<input type="hidden" name="email" value="{{ Auth::user()->email }}" />
	<input name="country" type="hidden" id="country_interest" value="{{ session('country')  }}">
	<!--input type="hidden" name="country" value="United Kingdom" /><!-- Country of interest -->
	<input type="hidden" name="born" value="{{ Auth::user()->userProfile->country }}" /><!-- Country of birth -->
	<input type="hidden" name="role" value="-1" /><!-- Professional -->
	<input type="hidden" name="surveyCode" value="90906B45A6{{--{{ $survey_code->survey_code }}--}}" /><!-- Survey code -->
	<input type="hidden" name="returnURL" value="{{ url('culture_match/return_callback') }}" /><!-- Encoded -->
	<input type="hidden" name="language" value="" />
</form>
<script>
	$(document).ready(function () {
		$("#culture_form").submit();
	})
	</script>
	</body>
</html>