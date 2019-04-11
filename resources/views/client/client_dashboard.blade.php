@extends('front.dashboard_layout')
@section('top_section')
	<h1>Dashboard<small>Services</small></h1>
	<!--<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>-->
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="heading">
				<h3>{{ $page_title }}</h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<p>Your basic package to kick-start your international career.</p>
				<p>Map your professional journey from the application to the recruitment phase, and get faster to your final destination, by avoiding slowdowns and pitfalls.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				@if(count($notifications) > 0)
					@foreach($notifications as $notification)
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">{{ $notification['heading'] }}</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body no-padding">
							<table class="table table-condensed">
								@foreach($notification['notifications'] as $key => $notification)
									<tr>
										<td>{{ $key+1 }}.</td>
										<td><strong>{{ $notification['heading'] }}</strong></td>
										<td>
											{!! $notification['noti_msg']  !!}
										</td>
										{{--<td>
											@if($notification['noti_url'] != null)
												<a target="_blank" class="btn btn-success" href="{{ url($notification['noti_url']) }}">Download Form</a>
												@endif
										</td>--}}
									</tr>
								@endforeach
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
					@endforeach
				@endif
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				{{-- service boxes --}}	
				@if(count($user_services)>0)
				<div class="box">
					<div class="box-title">
						<h3 style="padding: 0px 10px;">Your services:</h3>
					</div>
					<div class="box-body">
						@foreach($user_services as $service_id=>$service)
							<div class="col-md-4">
								<div class="box-style">
									<div class="top-stripe bckg-custom-orange"></div>
									<span class="imgblock"><img src="{{ asset($service["user_dashboard_image"]) }}" alt="Professional Kit"></span>											
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
												{{ $btn_url=url('/user/global/dashboard') }}
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
				@endif	
			</div>
			  
			<div class="clearfix"></div>
			<!-- @if(count($user_unpaid_services)>0)
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
							<span class="imgblock"><img src="{{ asset($service["user_dashboard_image"]) }}" alt="Professional Kit"></span>
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
			@endif -->
		</div>
	</div>
	<!--/div-->
@endsection
