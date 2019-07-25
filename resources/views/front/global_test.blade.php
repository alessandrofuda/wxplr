@extends('layouts.dashboard_layout')


@section('content')
	<div id="got-page" class="container">
		<div class="row">
			<div class="col-md-6 sx-block">
				<div class="got-container">
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
					</div>
					<div class="got-page-bread-crumbs">GOT</div>
					<div class="global-test-container content">
						@if( ($last_question && !empty($outcome_data)) || ($global_test_compiled_yet === true && !empty($outcome_data)) )
							
							@if($global_test_compiled_yet === true && !empty($outcome_data))
								<div class="alert alert-info got-compiled-yet">
									You have already completed the <b>Global Orientation Test</b>. If you want to recompile <a class="link" href="{{ asset('global_orientation_test?force=recompile') }}">click here</a> otherwise proceed to <a class="btn btn-success got-pro" href="{{route('got_pro')}}" style="text-decoration: none; line-height:30px; margin:3px 0 3px 15px;">Global Orientation Test PRO</a>
								</div>
							@endif
							
							<div class="output-title">You are a {{ $outcome_data['outcome_name'] }}</div>
							<div class="col-md-12 outcome-content">

								{!! $outcome_data['description'] !!}

								{{--@ if (!empty($outcome_data['outcome_file']))
									<div class="download_pdf">
										<a class="download-cls pull-right" target="blank" href="{{ asset($outcome_data['outcome_file']) }}">
											<span class="glyphicon glyphicon-download-alt"></span>
											Download your European Labour Market Map
										</a>
									</div>
								@ endif--}}
								<div class="redo-test">
									<a href="{{ asset('global_orientation_test?force=recompile') }}">REDO THE TEST</a>
								</div>
							</div>
						@else
							<div class="box-header"> {{-- NOT last question --}}
							  <h2 class="Question_heading">{{ $question['question'] }}</h2>
							</div>
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
									<button id="back" class="prev btn btn-primary">Prev</button>
									<button class="next btn btn-primary" type="submit" value="">Next</button>
								</form>
							</div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-6 dx-block">
				@if( ($last_question && !empty($outcome_data)) || ($global_test_compiled_yet === true && !empty($outcome_data)) )
					<!--img class="got-page-img" src="{{-- asset('frontend/images/got/got_output_page.png') --}}" title=""-->
					<img class="got-page-img" src="{{ asset( $outcome_data['outcome_image']) }}" title=""> {{-- 'uploads/club-privato.jpg' --}}
					<div class="cta-to-got-pro">
						<div class="text">
							How can you use this information to your best advantage? How can you get more insights on your target countries? Find out with the Global Orientation Test PRO!
						</div>
						<a class="btn cta" href="{{route('got_pro')}}">GO PRO!</a>
					</div>				
				@else
					<img class="got-page-img" src="{{asset('frontend/images/got/got_intro_page.png')}}" title="">
				@endif
			</div>
		</div>
	</div>
@endsection
