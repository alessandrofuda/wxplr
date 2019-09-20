@extends('layouts.dashboard_layout')

@section('content')
	<div id="dashboard" class="page-container">
		<div class="row-first">
			<div class="heading" style="background-image: url('{{ asset('frontend/images/hp/top_img.png')}}')">
				<div class="heading-text-container">
					<div class="heading_title">Welcome to your personal space {{ ucfirst(Auth::user()->name) }}. </div>
					<div class="heading_sub-title">Are your ready for #yournextchange?</div>
				</div>
			</div>
		</div>
		<div class="row-second">
			<div class="container boxs">
				<div class="col-md-12" style="padding-right: 0;">

					{{-- dd($user_services) /*elenca sempre TUTTI i servizi ACQUISTABILI (cioè ESCLUSO il GOT! */ --}}
					{{-- dd($user_unpaid_services)  /*elenca solo quelli NON ancora acquistati tra gli ACQUISTABILI (cioè EsCLUSO il GOT*/  --}}
					
					{{-- dd($user_unpaid_services) --}}
					@if ($got_compiled)    {{-- && ONLY got compiled --}}
						<div class="box-title">
							My Milestones
						</div>
						<div class="box box-body got compiled">
							<div class="col-md-6 sx">
								<div class="box-above-top">got</div>
								<div class="box-top">You are a {{ $got_outcome_data->outcome_name ?? 'n.a.'}}</div>
								<div class="box-description">
									{{-- Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et. --}}
									{{-- !! $got_outcome_data->description ?? 'n.a.' !! --}}
								</div>
								<div class="box-cta">
									<a class="btn cta report" href="{{route('got_report')}}">Report</a>
									<a class="redo-link" href="{{ asset('global_orientation_test?force=recompile') }}">REDO TEST</a>
								</div>
							</div>
							<div class="col-md-6 dx got-compiled">
								<div class="box-img got-compiled">
									<img src="{{asset('frontend/images/hp/img_got_compiled.png')}}">
								</div>
							</div>
						</div>
						@if(!$got_pro_completed)
							<div class="box-title">
								Take another step in your journey
							</div>
						@endif
					@else
						<div class="box-title">
							Start your journey
						</div>
						<div class="box box-body got">
							<div class="col-md-6 sx">
								<div class="box-top">got</div>
								<div class="box-middle">global orientation test</div>
								<div class="box-description">Find out your international professional profile and start from here to define the next step in your career: which country works best for you? In which company you are most likely to thrive?</div>
								<div class="box-cta">
									<a class="btn cta" href="{{route('got_intro')}}">Start now it's free!</a>
								</div>
							</div>
							<div class="col-md-6 dx">
								<div class="box-img">
									<img src="{{asset('frontend/images/hp/img_got.png')}}">
								</div>
							</div>
						</div>
						<div class="box-title">
							Take it one Step Further
						</div>
					@endif
					
					@if ($got_pro_completed)
						<div class="box box-body got-pro completed">
							<div class="col-md-6 sx">
								<div class="box-above-top">got pro</div>
								<div class="box-top">{{ $got_pro_completed->country1 }}, {{ $got_pro_completed->country2 }}, {{ $got_pro_completed->country3 }}.</div>
								<div class="box-description"></div>
								<div class="box-cta">
									<a class="btn cta light report" href="{{route('got_pro_report')}}">Report</a>
									<a class="go-chat-link" href="{{route('got_pro_start')}}">Go to chat</a>
								</div>
							</div>
							<div class="col-md-6 dx got-compiled">
								<div class="box-img got-compiled">
									<img src="{{asset('frontend/images/hp/avion.png')}}">
								</div>
							</div>
						</div>
					@else
						<div class="box box-body got-pro">
							<div class="col-md-6 sx">
								<div class="box-top">got pro</div>
								<div class="box-middle">global orientation test pro</div>
								<div class="box-description">Take your journey one step further with our GOT Pro: find out exactly where in Europe your profile is most in demand.</div>
								<div class="box-cta">
									@if ($got_pro_payed)
										<a class="btn cta" href="{{ route('got_pro_start') }}">Start</a>
									@else
										<a class="btn cta" href="{{ route('got_pro') }}">buy for {{$user_services[App\Service::GOT_PRO]['price'] ?? 'n.a.'}}€</a>
									@endif

									@include('partials.got-pro.how_it_works_modal')

								</div>
							</div>
							<div class="col-md-6 dx">
								<div class="box-img">
									<img src="{{asset('frontend/images/hp/img_got-pro.png')}}">
								</div>
							</div>
						</div>
					@endif

					@if ($vic_b2c_completed)
						<div class="box box-body vic completed" style="overflow: hidden;">
							<div class="col-md-9 sx">
								<div class="box-above-top">Vic Journey</div>
								<div class="box-top">You are ready to go!</div>
								<div class="box-description"></div>
								{{-- <div class="box-cta">
									<a class="btn cta light report" href="#">Prepare your letter</a>
									<a class="btn cta light report" href="#">Prepare your interview</a>
									<a class="btn cta light report" href="#">Prepare your transfer</a>
								</div> --}}
								<div class="box-cta">
									<a class="btn cta light report" href="{{ route('vic_preparation_report') }}">Preparation Report</a>
									<a class="btn cta light report" href="{{ route('vic_job_hunt_report') }}">Job Hunt Report</a>
									<a class="btn cta light report" href="{{ route('vic_take_off_report') }}">Take Off Report</a>
								</div>
							</div>
							<div class="col-md-3 dx got-compiled">
								<div class="box-img got-compiled">
									<img src="{{asset('frontend/images/vic/completed.png')}}">
								</div>
							</div>
						</div>
					@else
						<div class="box box-body vic">
							<div class="col-md-6 sx">
								<div class="box-top">vic</div>
								<div class="box-middle">virtual international consultant</div>
								<div class="box-description">Your best ally to walk you through an international job search journey: 11 steps to prepare your journey.</div>
								<div class="box-cta">
									@if ($vic_b2c_payed)
										<a class="btn cta" href="{{route('vic_start')}}">Start</a>
									@else
										<a class="btn cta" href="{{route('vic')}}">buy for {{$user_services[App\Service::VIC]['price'] ?? 'n.a.'}}€</a>
									@endif

									@include('partials.vic.how_it_works_modal')
									
								</div>
							</div>
							<div class="col-md-6 dx">
								<div class="box-img" style="margin-right: 100px;">
									<img src="{{asset('frontend/images/hp/img_vic.png')}}">
								</div>
							</div>
						</div>
					@endif

					<div class="box-title">
						Enjoy our WOW Effect
					</div>
					<div class="box box-body wow">
						<div class="col-md-6 sx">
							<div class="box-top">wow</div>
							<div class="box-middle">Wexplore Original Webinar</div>
							<div class="box-description">Top managers and entrepreneurs open the doors to their “professional house” and share a wealth of insights and knowledge in short learning pills – just like taking a coffee with them.</div>
							<div class="box-cta">
								<a class="btn cta" href="http://eepurl.com/grpRwb">explore wow</a>
								<!-- Button trigger modal -->
								<a type="button" class="how-it-w" data-toggle="modal" data-target="#how-wow-modal">
  									<i class="fas fa-question-circle"></i> How it works
								</a>
								<!-- Modal -->
								<div class="modal fade" id="how-wow-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<h4 class="modal-title" id="myModalLabel">WOW</h4>
											</div>
											<div class="modal-body">
												<div class="modal-subtitle">How it works</div>
												<div class="modal-text">
													Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
												</div>
												{{-- <div class="modal-img">
													<img class="" src="" style="border:1px solid gray; width:100%; height: 200px;">
												</div> --}}
												<div class="modal-subtitle">how much is it ?</div>
												<div class="modal-text">
													Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
												</div>
											</div>
											<div class="modal-footer">
												<a type="button" class="btn cta" data-dismiss="modal">Go</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 dx">
							<div class="row">
								@for ($i = 0; $i < 4; $i++)
									<div class="col-sm-6 col-md-6"> {{-- CICLARE da DB !! --}}
										<div class="video-prev-container">
											<a class="video-prev" href="#">
												<img class="video-prev-img" src="{{asset('frontend/images/hp/video_prev.jpg')}}">
												<span class="video-prev-icon">
													<i class="far fa-play-circle"></i>
												</span>
												<span class="video-payment-icon">
													@if($i == 0 || $i == 2)
														FREE
													@else
														€
													@endif
												</span>
											</a>
										</div>
										<div class="video-author">Author {{$i}}</div>
										<div class="video-title">intro {{ $i }}</div>
									</div>
								@endfor
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
@endsection

@section('js')
{{--
	<script>
		var preparationReportUrl = ' route('vic_preparation_report') ';
	</script>
--}}
@endsection