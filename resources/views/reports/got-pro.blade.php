@extends('reports.layout')

@section('title')
	<h1>{{ $title }}</h1>
@endsection

@section('content')
	<div class="">
		User: {{ $user_full_name }}
	</div>
	<div class="">
		Email: {{ $user_email }}
	</div>
	<div class="">
		Birth date: {{ $birth_date }}
	</div>
	<div class="">
		Gender: {{ $gender }}
	</div>
	<div class="">
		Study Level: {{ $study_level }}
	</div>
	<div class="">
		Work Function: {{ $work_function }}
	</div>
	<div class="">
		Work Sector: {{ $work_sector }}
	</div>
	<div class="">
		Work Level: {{ $work_level }}
	</div>
	<div class="">
		Countries: {{ $country1 }}, {{ $country2 }}, {{ $country3 }}
	</div>
	<div class="">
		Compilation date: {{ $crdate }}		
	</div>
@endsection