@extends('layouts.dashboard_layout')
@section('top_section')
	<h1>Dashboard<small>Services</small></h1>
	<!--<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>-->
@endsection
@section('content')
<div class="row">
	{{-- service boxes --}}	
	@if(count($user_services)>0)
		@foreach($user_services as $service_id=>$service)
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
								<a href="{{ $service['url'] }}"  class="applynow service_btn" >Browse Now</a>
							@elseif($service['purchased']=='no')
								<form action="{{  url('service/payment') }}" method="post">
									<input type="hidden"name="service_id" value="{{ $service_id }}">
									{{ csrf_field() }}
									<button type="submit" class="applynow service_btn" >Get Now</button>
								</form>
							@else
								@if ($service_id == 1 && $service['price']==0)
								{{ $btn_url=url('global_orientation_test') }}
								{{ $btn_label='Start test' }}
								@elseif($service_id == 2 && $service['price']!=0)
									{{ $btn_url=url('user/professional_kit') }}
									{{ $btn_label='Continue' }}
								@elseif($service_id == 3 && $service['price']!=0)
									{{ $btn_url=url('skill_development/videos') }}
									{{ $btn_label='Continue' }}
								@elseif($service_id == 4 )
									{{ $btn_url=url('/global_toolbox') }}
									{{ $btn_label='Continue' }}
								@else
									{{ $btn_url=url('user/dashboard') }}
									{{ $btn_label='Continue' }}
								@endif
								<a href="{{ $btn_url }}" class="service_btn" type="button">{{ $btn_label }}</a>
							@endif
						</div>
				</div>
			</div>
		@endforeach
	@endif
</div>
@endsection