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
						<div class="workBoxMain row">
							@foreach($partners as $partner)
							<div class="col-md-6 col-sm-6 col-xs-12 partner_items">
											<div class="workBoxText">
												<img alt="{{ $partner['name'] }}" src="{{ asset($partner->logo_file)  }}" height="100" width="100"/>
												<div class="partner_details">
													<h3><a href="{{ $partner->url }}" target="blank">{{ $partner['name'] }}</a></h3>
													<p>{!! $partner['description'] !!}</p>
												</div>
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