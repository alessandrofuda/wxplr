{{-- @extends('consultant.consultant_dashboard'); --}}
@section('content')
<div class="container user_profile_form">
	<div class="row">
		<div class="heading">
			<h3>{{ $page_title }}</h3>
			<p>{!! isset($noti_mesg) ? $noti_mesg : '' !!}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="meeting-btn">
				<!--a class="btn btn-success"target="_blank" href="{{-- $hostUrl --}}">Start Meeting</a-->
				<a class="btn btn-success"target="_blank" href="javascript:close();">Close</a>
			</div>
			<img src="" />
		</div>
	</div>	
</div>
@endsection