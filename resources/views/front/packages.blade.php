@extends('layouts.new_layout')
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
						<div class="workBoxMain row">
							@foreach($packages as $package)
								<div class="col-md-6 col-sm-6 col-xs-12 services_item_content Packages">
									<div class="workBoxText">
										<h3>
										<span class="pull-left"><b>{{ $package['title'] }}</b></span>
										<br/>	<h4>{!! \App\Package::find($package['id'])->getRelatedItems() !!}</h4>
										<span class="pull-right price">€{{ $package['price'] }}</span>
										</h3>
										<p>{!! $package['description'] !!}</p>
										@if($package['purchased'] == 'no')
											<a href="{{  url('package/'.$package['id'].'/buy') }}" class="applynow" >Buy Now</a>
										@else
											Purchased
										@endif
									</div>
								</div>
							@endforeach
						</div>
						<br clear="all">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection