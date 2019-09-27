@extends('reports.layout')

@section('title')
	{{ $title }}
@endsection

@section('content')

	<div id="got-pro-report">
		<div class="top-section">
			<div class="name">
				Report of: {{$user_full_name}}
			</div>
			<div class="email">
				Mail: {{$user_email}}
			</div>		
		</div>
		<div class="middle-section">
			<div class="row">
				<div class="col-md-12">
					<div class="body">
						<div class="chart-container">
							<div class="chart">
								<img class="img-fluid chart-img" src="{{ public_path('frontend/images/reports/chart.jpg') }}">
							</div>

							<div class="legend">
								<div class="legend-block" style="margin-left: 40px;">Countries:</div>
								<div class="legend-block"><img src="{{ public_path('frontend/images/reports/chart-legend-1.jpg') }}"> {{ $country1 }}</div> 
								<div class="legend-block"><img src="{{ public_path('frontend/images/reports/chart-legend-2.jpg') }}"> {{ $country2 }}</div>
								<div class="legend-block"><img src="{{ public_path('frontend/images/reports/chart-legend-3.jpg') }}"> {{ $country3 }}</div>
							</div> 
						</div>

						<div class="claim">
							These are the top 3 countries in Europe with the highest employment rate for your profile.						
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="compilation-date">
					Compilation date: {{ $crdate }}
				</div>
			</div>
		</div>
		<div class="bottom-section">
			<img class="img-fluid" src="{{ public_path('frontend/images/reports/bottom-image.jpg') }}">
		</div>
	</div>
@endsection