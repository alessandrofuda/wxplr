@extends('layouts.dashboard_layout')
@section('content')

	@include('front.navigation')
<div class="container user_profile_form" xmlns="http://www.w3.org/1999/html">
	<div class="row">
		<div class="heading">
			<h1>{{ $page_title }}</h1>
		</div>
	</div>
	<div class="row">
	<div class="col-md-12">
		@if (session('status'))
			<div class="alert alert-success">
			  {{ session('status') }}
			</div>
		@endif
		@if (session('error'))
		  <div class="alert alert-failure">
			  {{ session('error') }}
		  </div>
		@endif
		 @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
	</div>
	<div class="col-md-12">
		<div class="culture_match">
			<p>Welcome to the second phase of your Professional Kit!</p>
			<p>Now you have a better understanding of where to go as a professional. However, do you really know what I takes to live another country?</p>
			<p>Of course, during meetings, interviews or formal occasions you know how to be on your best behavior…but are you sure that what you consider best behavior translates into what people from another country consider best behavior?</p>
			<p>Do you know how your actions will be perceived by your future boss, colleagues, or next-door neighbors?</p>
			<p>Wexplore partners with the most reliable provider of cultural assessments, based on <a target="_blank" href="https://www.geert-hofstede.com/national-culture.html">Prof. G. Hofstede’s Model</a> to provide you with a personalized report on how to avoid embarrassing misunderstandings and awkward situations.</p>
			<p>Just fill in the form below to access the Assessment Tool:</p>



			<!--form action="https://geert-hofstede.com/cultural-survey-redirect.html{{--{{ url('user/culture_match/submit') }}--}}" method="post"-->
			<form action="https://hofstede-insights.com/integration/cultural-survey-redirect.php" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="firstName" value="{{ Auth::user()->name }}" />
				<input type="hidden" name="lastName" value="{{ Auth::user()->surname }}" />
				<input type="hidden" name="email" value="{{ Auth::user()->email }}" />
				<label>I am interested in :</label>
				<select id="country_interest" required name="country" class="form-control">
					<option value="">-- Country of Interest --</option>
					@if(count($countries_code)>0)
						@foreach ($countries_code as $country)
							<option value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>
						@endforeach
					@endif
				</select>
				<!--input type="hidden" name="country" value="United Kingdom" /><!-- Country of interest -->
				<input type="hidden" name="born" value="{{ Auth::user()->userProfile->country }}" /><!-- Country of birth -->
				<input type="hidden" name="role" value="-1" /><!-- Professional -->
				<input type="hidden" name="surveyCode" value="{{ $survey_code->survey_code }}" /><!-- Survey code -->
				<input type="hidden" name="returnURL" value="{{ url('culture_match/return_callback') }}" /><!-- Encoded -->
				<input type="hidden" name="language" value="" />
				<button type="submit" class="Country_submit" value="Next">Next</button>
			</form>

		  	</div>
			<h3>NOTE:</h3>
			<p>From this phase onwards of the Professional Kit, you will be asked to focus on a specific target Country. This may be the Country you already had in mind, or another country which has caught your interest after the Market Analysis phases.</p>
			<p>Why is this? We know, from our experience in the industry, that the more focused and specific you are on your objective, the more effective your job search process will be. Recruiters are not interested in candidates who are willing to go anywhere, they are interested in profiles with a very specific motivation.</p>
			<p>So let’s take it one step at the time: make a choice and set it as your primary goal. </p>
			<p>If you are still not convinced and feel ready to tackle multiple destinations, kindly contact us to adjust your Professional Kit accordingly:</p>
		 {{-- <a target="_blank" href="https://www.geert-hofstede.com/tools.html">Click to start Online Assessment</a> --}}
		</div>
	</div>
</div>	
</div>
@endsection