@extends('layouts.dashboard_layout')

@section('content')
	<div id="vic" class="container-fluid">
	    <div class="row vic-container">
	    	<div class="col-md-6 sx vic-middle">
		        <div class="top-heading">VIC</div>
		        <div class="sub-heading">virtual international consultant</div>
		        <div class="intro">you are ready to go</div>
		        <div id="chat-wrapper" class="body">
		        	<div class="citation">
		        		<span class="cit-text">Choose a job you love, and you will never have to work in your entire life</span> – Confucius
		        	</div>
		        	<div class="completed-description">
		        		You have completed your journey with VIC and are now ready to take off and start a new and exciting journey in your professional life. <br>We wish you fun, challenges, learning, and fulfillment. <br>And for any “down” moments, let us know if we can lift you up again – after all, we are the wings that make your goals fly higher!
		        	</div>

		        	@if ($vic_b2c_interrupted)
		        		<p><i class="text-danger">You have an interrupted chat session</i></p>
		        	@endif

			        <div class="buttons-section">

			        	@if ($preparation_report && !$vic_b2c_interrupted)
			        		<a class="btn cta report one" href="{{ route('vic_userReport_download', ['report_name' => 'preparation-report']) }}">
			        			Download<br/>Preparation Report
			        		</a>
			        	@elseif ($vic_b2c_interrupted)
			        		<a class="btn cta report" href="{{ route('vic_preparation_report') }}">Partial<br/>Preparation Report</a>
			        	@else
			        		<a class="btn cta report one loading-report-ajax preparation-report" href="javascript:void(0)">Preparation Report</a>
			        		<a class="btn cta report download-preparation-report" style="display: none;" href=""></a>
			        	@endif

			        	@if ($jobhunt_report && !$vic_b2c_interrupted)
			        		<a class="btn cta report two" href="{{ route('vic_userReport_download', ['report_name' => 'jobhunt-report']) }}">
			        			Download<br/>Job Hunt Report
			        		</a>
			        	@elseif($vic_b2c_interrupted)
			        		<a class="btn cta report" href="{{ route('vic_job_hunt_report') }}">Partial<br/>Job Hunt Report</a>
			        	@else
			        		<a class="btn cta report two loading-report-ajax jobhunt-report" href="javascript:void(0)">Job Hunt Report</a>
			        		<a class="btn cta report download-jobhunt-report" style="display: none;" href=""></a>
			        	@endif

			        	<br><br>
			        </div>
	        	</div>
	        </div>
	        <div class="col-md-6 dx" style="padding-right: 0;">
	        	<img class="img-got-pro-dx completed" src="{{asset('frontend/images/vic/completed.png')}}">
	        </div>
		</div>
	</div>
@endsection

@section('js')
	<script>
		var preparationReportGenerationUrl = '{{ route('vic_preparation_report_ajax') }}';
		var preparationReportDownloadUrl = '{{ route('vic_userReport_download', ['report_name' => 'preparation-report']) }}';
		var jobHuntReportGenerationUrl = '{{ route('vic_jobhunt_report_ajax') }}';
		var jobHuntReportDownloadUrl = '{{ route('vic_userReport_download', ['report_name' => 'jobhunt-report']) }}';
	</script>
@endsection