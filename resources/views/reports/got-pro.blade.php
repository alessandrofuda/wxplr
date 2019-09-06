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
								Countries: <span class="legend-1"></span> {{ $country1 }} <span class="legend-2"></span> {{ $country2 }} <span class="legend-3"></span> {{ $country3 }}
							</div> 
						</div>

						<div class="claim">
							These are the top 3 countries in Europe with the highest employment rate for your profile.						
						</div>
					</div>
				</div>
			</div>
			<div class="compilation-date">
				Compilation date: {{ $crdate }}
			</div>
		</div>
		<div class="bottom-section">
			<img class="img-fluid" src="{{ public_path('frontend/images/reports/bottom-image.jpg') }}">
		</div>
	</div>

@endsection