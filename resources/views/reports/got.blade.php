@extends('reports.layout')

@section('title')
	{{ $title }}
@endsection

@section('content')
	<div id="got-report">
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
					<div class="sub-title" style="margin-bottom:20px;">
						YOU ARE A: <span class="profile-name">{{ $outcome_name }}</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="body">
						{!! $description !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="compilation-date">
					Compilation date: {{ $created_at }}
				</div>
			</div>
		</div>
		<div class="bottom-section">
			<img class="img-fluid" src="{{ public_path('frontend/images/reports/bottom-image.jpg') }}">
		</div>
	</div>
@endsection