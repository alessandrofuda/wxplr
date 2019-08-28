@extends('reports.layout')

@section('title')
	<h1>{{ $title }}</h1>
@endsection

@section('content')
	<div class="user-section">
		<div class="name">
			Report of: {{$user_full_name}}
		</div>
		<div class="email">
			Mail: {{$user_email}}
		</div>		
	</div>
	<div class="got-section">
		<div class="type-name">
			You are a: <span class="profile-name">{{ $outcome_name }}</span>
		</div>

		<div class="description">
			{!! $description !!}
		</div>

		<div class="compilation-date">
			Compilation date: {{ $created_at }}
		</div>
	</div>
@endsection