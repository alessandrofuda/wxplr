@extends('consultant.consultant_dashboard');
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-7  col-sm-8 col-xs-12">
			<div class="right_service_details">
				<div class="section_heading">
					<span class="fa-stack fa-lg">
					  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
					  <i class="fa fa-check" aria-hidden="true"></i>
					</span>{{ $page_title }}
				</div>
				<div class="row">
					<div class="form-group has-feedback ">
						<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:0;">
							<label for="name">Submitted By : </label>
							{{ $query->user->name }}
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group has-feedback ">
							<div style="padding-left:0;">
								<label for="country">Country</label>
								{{  $query->country }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group has-feedback ">
							<div style="padding-left:0;">
								<label for="question_type_id">Question : </label>
								{{ $query->getQuestionTypeOptions($query->question_type_id) }}
							</div>
						</div>
					</div>

					<div class="form-group has-feedback ">
						<div  style="padding-left:0;">
							<label for="Comment">Comment: </label>
							{{ $query->comment }}
						</div>
					</div>

					<div class="form-group has-feedback ">
						<div  style="padding-left:0;">
							<label for="Comment">Consultant Feedback: </label>
							{{ $query->feedback != null }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection