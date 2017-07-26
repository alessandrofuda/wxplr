@extends('front.new_layout')
@section('content')

</header>
</div>
<div class="container">
	<div class="row">
	<div class="heading">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="container">
		<div class="row">       
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="workBoxMain">
					@foreach($services as $service)

					<div class="col-md-12 services_main">
						<div class="workBox">
							<div class="col-lg-6 services_item">
								<img alt="{{ $service['name']  }}" src="{{ asset($service['image']) }}" class="img-responsive">
							</div>
							<div class="col-lg-6 services_item_content">
								<div class="workBoxText">
								<h3><span class="pull-left">{{ $service['name'] }}</span>
								<span class="pull-right price">@if($service['price']>0)&euro;{{ $service['price'] }}@else TBD @endif</span>
								</h3>
								<p class="clearfix"></p>
							   <!-- <p>
									<i class="fa fa-calendar"></i> 3M 2H &nbsp;&nbsp;
									<i class="fa fa-user"></i> 3M 2H &nbsp;&nbsp;
									<i class="fa fa-graduation-cap"></i> 3M 2H &nbsp;&nbsp;
								</p>-->
								{!! $service['description'] !!}
								@if($service['price'] == 0)
									<a href="{{ $service['url'] }}" class="applynow">Start</a>
								@elseif($service['purchased'] == 'no')
								<form action="{{  url('service/payment') }}" method="post">
									<input type="hidden" name="service_id" value="{{ $service['id'] }}">
									{{ csrf_field() }}
									<button type="submit" class="applynow" >Start</button>
								</form>
									@else
										@if ($service['id'] == 1 && $service['price'] ==0)
											{{--*/ $btn_url=url('global_orientation_test'); /*--}}
											{{--*/ $btn_label='Start test'; /*--}}
										@elseif($service['id'] == 2 && $service['price'] !=0)
											{{--*/ $btn_url=url('user/professional_kit'); /*--}}
											{{--*/ $btn_label='Continue'; /*--}}
										@elseif($service['id'] == 3 && $service['price'] !=0)
											{{--*/ $btn_url=url('skill_development/videos'); /*--}}
											{{--*/ $btn_label='Continue'; /*--}}
										@elseif($service['id'] == 4 )
											{{--*/ $btn_url=url('/global_toolbox'); /*--}}
											{{--*/ $btn_label='Continue'; /*--}}
										@else
											{{--*/ $btn_url=url('user/dashboard'); /*--}}
											{{--*/ $btn_label='Continue'; /*--}}
										@endif
										<a href="{{ $btn_url }}" class="applynow" type="button">{{ $btn_label }}</a>
									@endif
							</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<br clear="all">
					<p class="note">NOTE: Each Professional Kit will focus on one Country in particular, from the Culture Match Analysis to the Role Play Interview. this is derived from a tested methodology, by which it is more effective to focus your energies and efforts on one very clear target at the time.
Should you be interested in approaching more than one Country at the time, please contact us, and we will customize our offer to suit our need...because we want your success as much as you do!</p>
			</div>
        </div>
    </div>
	</div>
</div>
@endsection