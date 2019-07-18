@extends('layouts.dashboard_layout')

@section('content')
	<div id="got-intro-page" class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="got-intro-container">
					<div class="got-page-title">GOT</div>
					<div class="got-page-subtitle">global orientation test</div>
					<div class="got-paragr-title">Every journey starts with you!</div>
					<div class="got-page-body">
						And if you know who you are and where your playground is, then really the horizon is your only limit! Find out your ideal company and your country match.
					</div>
					<div class="box-cta">
						<a class="btn cta" href="{{url('global_orientation_test')}}">Start</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 dx-block">
				<img class="got-page-img" src="{{asset('frontend/images/got/got_intro_page.png')}}" title="">
			</div>
		</div>
	</div>
@endsection
