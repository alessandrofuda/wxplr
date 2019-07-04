@extends('front.dashboard_layout')

@section('content')
	<div class="page-container">
		<div class="row-first">
			<div class="heading" style="background-image: url('{{ asset('frontend/images/DASH2.png')}}')">
				<div class="heading-text-container">
					<div class="heading_title">Welcome {{ ucfirst(Auth::user()->name) }} to your personal space. </div>
					<div class="heading_sub-title">Are your ready for #yournextchange?</div>
				</div>
			</div>
		</div>
		<div class="row-second">
			<div class="container boxs">
				<div class="col-md-12" style="padding-right: 0;">
					<div class="box-title">
						Start your route
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
								<img src="{{asset('frontend/images/GOT_placeholder.png')}}">
							</div>
						</div>
					</div>
					<div class="box-title">
						Go ahead
					</div>
					<div class="box box-body got-pro">
						<div class="col-md-6 sx">
							<div class="box-top">got pro</div>
							<div class="box-middle">global orientation test pro</div>
							<div class="box-description">Take your journey one step further with our GOT Pro: find out exactly where in Europe your profile is most in demand.</div>
							<div class="box-cta">
								<a class="btn cta" href="#">buy for {{$user_services[5]['price']}}€</a>
								<!-- Button trigger modal -->
								<a type="button" class="how-it-w" data-toggle="modal" data-target="#how-got-pro">
  									How it works
								</a>
								<!-- Modal -->
								<div class="modal fade" id="how-got-pro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<h4 class="modal-title" id="myModalLabel">Modal title</h4>
											</div>
											<div class="modal-body">
												...
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary">Save changes</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 dx">
							<div class="box-img">
								<img src="{{asset('frontend/images/GOTPRO2.png')}}">
							</div>
						</div>
					</div>

					<div class="box box-body vic">
						<div class="col-md-6 sx">
							<div class="box-top">vic</div>
							<div class="box-middle">virtual international consultant</div>
							<div class="box-description">Your best ally to walk you through an international job search journey: 12 steps to prepare your journey.</div>
							<div class="box-cta">
								<a class="btn cta" href="#">buy for {{$user_services[6]['price']}}€</a>
								<!-- Button trigger modal -->
								<a type="button" class="how-it-w" data-toggle="modal" data-target="#how-vic-modal">
  									How it works
								</a>
								<!-- Modal -->
								<div class="modal fade" id="how-vic-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<h4 class="modal-title" id="myModalLabel">Modal title</h4>
											</div>
											<div class="modal-body">
												...
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary">Save changes</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 dx">
							<div class="box-img">
								<img src="{{asset('frontend/images/VIC2.png')}}">
							</div>
						</div>
					</div>
					<div class="box-title">
						Enjoy our wow
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
  									How it works
								</a>
								<!-- Modal -->
								<div class="modal fade" id="how-wow-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<h4 class="modal-title" id="myModalLabel">Modal title</h4>
											</div>
											<div class="modal-body">
												...
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary">Save changes</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 dx">
							<div class="row">
								<div class="col-md-6"> {{-- CICLARE da DB !! --}}
									<a class="video-prew" href="#">
										<img src="{{asset('frontend/images/aaaaaaaaaaa.png')}}">
									</a>
									<div class="video-author">Alessandro Donadio</div>
									<div class="video-title">intro</div>
								</div>
								<div class="col-md-6">
									<a class="video-prew" href="#">
										<img src="{{asset('frontend/images/aaaaaaaaaaa.png')}}">
									</a>
									<div class="video-author">Mario Rossi</div>
									<div class="video-title">Episode 1: multicultural</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<a class="video-prew" href="#">
										<img src="{{asset('frontend/images/aaaaaaaaaaa.png')}}">
									</a>
									<div class="video-author">Giovanni Storti</div>
									<div class="video-title">intro</div>
								</div>
								<div class="col-md-6">
									<a class="video-prew" href="#">
										<img src="{{asset('frontend/images/aaaaaaaaaaa.png')}}">
									</a>
									<div class="video-author">Laura Minella</div>
									<div class="video-title">Episode4: colorato e divertente</div>
								</div>
							</div>
						</div>
					</div>
					
					











					<div class="box-body">
						{{--
						@foreach($user_services as $service_id=>$service)
							<div class="col-md-6">
								<div class="box-style">
									<div class="top-stripe bckg-custom-orange"></div>
									<span class="imgblock"><img src="{{ asset($service["user_dashboard_image"]) }}" alt=""></span>											
									<div class="tile-title">
										<h3>{{ $service['name'] }}</h3>
									</div>
									<div class="hover_column">
										{!! substr($service['user_dashboard_desc'], 0, 300) !!}
									</div>
									<div class="button-block text-center">
										<div class="hr-right"></div>
										@if($service['price'] == 0)
											<a href="{{ $service['url'] }}"  class="applynow service_btn" >Start</a>
										@elseif($service['purchased']=='no')
											<form action="{{  url('service/payment/'.$service_id) }}" method="get">
												<input type="hidden"name="service_id" value="{{ $service_id }}">
												{{ csrf_field() }}
												<button type="submit" class="applynow service_btn" >Start</button>
											</form>
										@else
											<a href="{{ $service['url'] }}" class="service_btn" type="button">{{ $service['label'] }}</a>
										@endif
									</div>
								</div>
							</div>
						@endforeach
						--}}
					</div>
				</div>
			</div>




			<div class="clearfix"></div>
			{{-- @if(count($user_unpaid_services)>0)
				<div class="col-md-12">
				<div class="box">
				<div class="box-title">
				<h3 style="padding: 0px 10px;">You might be interested in following services:</h3>
				</div>
					<div class="box-body">
				@foreach($user_unpaid_services as $service_id=>$service)
					<div class="col-md-4">
						<div class="box-style">
							<div class="top-stripe bckg-custom-orange"></div>
							<span class="imgblock"><img src="{{ asset($service["user_dashboard_image"]) }}" alt=""></span>
							<div class="tile-title">
								<h3>{{ $service['name'] }}</h3>
								<h5>@if ($service['price']==0)Free @else Price: <span class="service_price">&euro;{{ $service['price'] }}</span>@endif</h5>
							</div>
							<div class="hover_column">
								{!! substr($service['user_dashboard_desc'], 0, 300) !!}
							</div>
							<div class="button-block text-center">
								<div class="hr-right"></div>
								@if($service['price'] == 0)
									<a href="{{ $service['url'] }}"  class="applynow service_btn" >Start</a>
								@elseif($service['purchased']=='no')
									<form action="{{  url('service/payment/'.$service_id) }}" method="get">
										<input type="hidden"name="service_id" value="{{ $service_id }}">
										{{ csrf_field() }}
										<button type="submit" class="applynow service_btn" >Start</button>
									</form>
								@else
									@if ($service_id == 1 && $service['price']==0)
										{{ $btn_url=url('global_orientation_test') }}
										{{ $btn_label='Start test' }}
									@elseif($service_id == 2 && $service['price']!=0)
										{{ $btn_url=url('user/professional_kit') }}
										{{ $btn_label='Start' }}
									@elseif($service_id == 3 && $service['price']!=0)
										{{ $btn_url=url('skill_development/videos') }}
										{{ $btn_label='Start' }}
									@elseif($service_id == 4 )
										{{ $btn_url=url('/global_toolbox') }}
										{{ $btn_label='Start' }}
									@else
										{{ $btn_url=url('user/dashboard') }}
										{{ $btn_label='Start' }}
									@endif
									<a href="{{ $btn_url }}" class="service_btn" type="button">{{ $btn_label }}</a>
								@endif
							</div>
						</div>
					</div>
				@endforeach
						</div>
				</div>
					</div>
			@endif --}}
		</div>
	</div>
	<!--/div-->
@endsection
