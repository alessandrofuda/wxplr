@extends('layouts.dashboard_layout')

@section('content')
	<div class="page-container">
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
					<div class="box-title">
						Start your journey
					</div>
					<div class="box box-body got">
						<div class="col-md-6 sx">
							<div class="box-top">got</div>
							<div class="box-middle">global orientation test</div>
							<div class="box-description">Start your journey to discover more about you: which kind of companies and which countries better match your values and preferences?</div>
							<div class="box-cta">
								<a class="btn cta" href="#">Start now it's free!</a>
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
					<div class="box box-body got-pro">
						<div class="col-md-6 sx">
							<div class="box-top">got pro</div>
							<div class="box-middle">global orientation test pro</div>
							<div class="box-description">Take your journey one step further with our GOT Pro: find out exactly where in Europe your profile is most in demand.</div>
							<div class="box-cta">
								<a class="btn cta" href="#">buy for {{$user_services[App\Service::GOT_PRO]['price']}}€</a>
								<!-- Button trigger modal -->
								<a type="button" class="how-it-w" data-toggle="modal" data-target="#how-got-pro">
  									<i class="fas fa-question-circle"></i> How it works
								</a>
								<!-- Modal -->
								<div class="modal fade" id="how-got-pro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<h4 class="modal-title" id="myModalLabel">Got Pro</h4>
											</div>
											<div class="modal-body">
												<div class="modal-subtitle">How it works</div>
												<div class="modal-text">
													<ol>
														<li>Start the chat.</li>
														<li>Answer the profiling questions: the virtual consultant will guide you through the conversation.</li>
														<li>Discover the 3 countries in Europe that best match your professional skills.</li>
													</ol>
												</div>
												<div class="modal-img">
													<img class="" src="" style="border:1px solid gray; width:100%; height: 200px;">
												</div>
												<div class="modal-subtitle">how much is it ?</div>
												<div class="modal-text">
													Price: {{$user_services[App\Service::GOT_PRO]['price']}}€
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
							<div class="box-img">
								<img src="{{asset('frontend/images/hp/img_got-pro.png')}}">
							</div>
						</div>
					</div>

					<div class="box box-body vic">
						<div class="col-md-6 sx">
							<div class="box-top">vic</div>
							<div class="box-middle">virtual international consultant</div>
							<div class="box-description">Your best ally to walk you through an international job search journey: 11 steps to prepare your journey.</div>
							<div class="box-cta">
								<a class="btn cta" href="#">buy for {{$user_services[App\Service::VIC]['price']}}€</a>

								@include('partials.vic.how_it_works_modal')
								
							</div>
						</div>
						<div class="col-md-6 dx">
							<div class="box-img" style="margin-right: 100px;">
								<img src="{{asset('frontend/images/hp/img_vic.png')}}">
							</div>
						</div>
					</div>
					<div class="box-title">
						Enjoy our WOW Effect
					</div>
					<div class="box box-body wow">
						<div class="col-md-6 sx">
							<div class="box-top">wow</div>
							<div class="box-middle">Wexplore Original Webinar</div>
							<div class="box-description">Top managers and entrepreneurs open the doors to their “professional house” and share a wealth of insights and knowledge in short learning pills – just like taking a coffee with them.</div>
							<div class="box-cta">
								<a class="btn cta" href="#">explore wow</a>
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
												<div class="modal-img">
													<img class="" src="" style="border:1px solid gray; width:100%; height: 200px;">
												</div>
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
									<div class="col-md-6"> {{-- CICLARE da DB !! --}}
										<div class="video-prev-container">
											<a class="video-prev" href="#">
												<img class="video-prev-img" src="{{asset('frontend/images/hp/video_prev.jpg')}}">
												<span class="video-prev-icon">
													<i class="far fa-play-circle"></i>
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
