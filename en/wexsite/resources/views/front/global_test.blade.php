@extends('front.dashboard_layout')
@section('content')

@if(!$last_question)
	<div class="online-test-banner">
	<!--<h1>Global Orientation Test</h1>-->
		<!--<img src="{{ asset('frontend/images/online-test-banner.jpg') }}" alt="test-banner.jpg">-->
		<h2>Global Orientation Test</h2>
	    <p>Every journey starts with you! And if you know who you are and where your playground is, then really the horizon is your only limit! Find out your ideal company and your country match.</p>
	</div>
@endif


<div class="upper-test-container">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<!--<h1></h1>-->
		<div class="global-test-container content box">

			@if ( ($last_question && !empty($outcome_data)) || ($global_test_compiled_yet === true && !empty($outcome_data)) )
				
				@if ($global_test_compiled_yet === true && !empty($outcome_data))
				
					<div class="alert alert-info">You have already completed the <b>Global Orientation Test</b>. If you want to recompile click <a href="{{ asset('global_orientation_test?force=recompile') }}">here</a> otherwise <a href="#proceed">proceed to Professional Kit</a></div>
				
				@endif
				
				<h2>You are a – {{ $outcome_data['outcome_name'] }}</h2>
				<div class="col-md-12 outcome-content">

					@if (!empty($outcome_data['outcome_image']))
						<div class="col-md-6 outcome_image">
							<img src="{{ asset($outcome_data['outcome_image']) }}" alt="{!! $outcome_data['outcome_name'] !!}">
						</div>
					@endif

					<div class="col-md-6">
						{!! $outcome_data['description'] !!}
					</div>

					<div class="Colorfull-window">
						<p><!--span class="opning_cot"><img alt="open-cot" src="{{-- asset('frontend/images/open-cot.png') --}}"></span-->No journey starts without direction: the European Labour Market Map will provide you with a comparison of the labour market situation across the EU countries. All treasure hunters had a map of some sort to guide them…why shouldn’t you? <!--span  class="end_cot"><img src="{{-- asset('frontend/images/end-cot.png') --}}"></span--></p>
					</div>

					@if (!empty($outcome_data['outcome_file']))
						<div class="download_pdf">
							<a class="download-cls pull-right" target="blank" href="{{ asset($outcome_data['outcome_file']) }}">
								<span class="glyphicon glyphicon-download-alt"></span>
								Download your European Labour Market Map
							</a>
						</div>
					@endif

				</div>
			@else
				<div class="box-header"> {{-- NOT last question --}}
				  <h2 class="Question_heading"><span class="glyphicon glyphicon-triangle-right"></span>{{ $question['question'] }}</h2>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form class="ask-Question" id="ask-Question" method="post" action="{{ url('global_orientation_test') }}">
						<ul>
							<li>
								<input type="radio" id="f-option" required name="choice"  value="{{ $question['choice'][0]->id }}">
								<label for="f-option">{{ $question['choice'][0]->choice }}</label>
								<div class="check"></div>
							</li>
							<li>
								<input type="radio" id="s-option" required name="choice" value="{{ $question['choice'][1]->id }}">
								<label for="s-option">{{ $question['choice'][1]->choice }}</label>
								<div class="check"><div class="inside"></div></div>
							</li>
						</ul>
						<input type="hidden" name="question_id" value="{{ $question['id'] }}"/>
						{{ csrf_field() }}
						<button type="submit" value="" class="next btn btn-primary"><span>Next</span></button>
						<div class="back"><i class="fa fa-arrow-left" aria-hidden="true"></i> <a href="">Return Back</a></div>
						<script>
							$(document).ready(function(){
								jQuery('.back a').click(function(){
									parent.history.back();
									return false;
								});
							});
						</script>
					</form>
				</div>
			@endif
		</div>
</div>

@if ( ($last_question && !empty($outcome_data)) || ($global_test_compiled_yet === true && !empty($outcome_data)) )
<div class="bottom_content">
	<div class="col-md-8">
		<p>How can you use this information to your best advantage? How can you get more insights on your target countries? Find out with the <span style="color: #2087C8;">Professional Kit!</span></p>
		<a id="proceed" style="position:relative; top:-50px; visibility: hidden;"></a>
		<a href="{{ url('professional-kit') }}" class="btn btn-success btn-lg btn-block" style="margin:25px auto;">
			Proceed to <b>Professional Kit</b> <span class="glyphicon glyphicon-triangle-right" style="font-size: 17px; 
			margin-left: 30px; position: relative; display: inline-block;"></span>
		</a>
	</div>
	<!--div class="col-md-2 pull-right">
		<a href="{{ url('user/dashboard') }}" class="btn btn-primary back-dashboard"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to dashboard</a>
	</div-->
</div>
@endif

@endsection
