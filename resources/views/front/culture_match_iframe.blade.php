@extends('front.layout')
@section('content')
	<iframe src="{{ url('culture/match/survey/'.$country) }}" width="100%" style="height:100vh;" />

@endsection