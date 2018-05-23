@extends('consultant.consultant_dashboard')
@section('content')
<div class="container">
	<div id="success_div" style="display: none;">
		<div class="alert alert-success" id="success_data">
		</div>
	</div>

	<div class="row">
		<form class="Credit_Card" action="{{ url('consultant/global_tool_form/feedback/'.$query->id.'/store') }}" method="post">
			{{ csrf_field() }}
			<div class="col-lg-6 col-md-offset-3 col-sm-8 col-xs-12">
				<div class="right_service_details">
					<div class="section_heading">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
						  <i class="fa fa-check" aria-hidden="true"></i>
						</span>{{ $page_title }}
					</div>
					<div class="row">
						<div class="col-sm-6">
						<div class="form-group has-feedback ">
							<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:0;">
								<label for="name">Submitted By : </label>
								{{ $query->user->name }}
							</div>
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
						@if($query->attach_file != null)
						<div class="col-sm-6">
							<div class="form-group has-feedback ">
								<div style="padding-left:0;">
									<label for="country">Download Attachment</label>
									<a class="btn btn-success" href="{{  url($query->attach_file) }}">Download Attachment</a>
								</div>
							</div>
						</div>
						@endif
						<div class="col-sm-12">
						<div class="form-group has-feedback ">
							<div  style="padding-left:0;">
								<label for="Comment">Comment: </label>
								{{ $query->comment }}
							</div>
						</div>
						</div>
						<div class="col-sm-12">
						<div class="form-group has-feedback ">
							<div  style="padding-left:0;">
								<label for="Comment">Give Feedback: </label>
								<textarea name="feedback" required class="form-control">{{ $query->feedback != null ? $query->feedback : old('feedback') }}</textarea>
							</div>
						</div>
							</div>
						<div class="col-sm-12">
						<div class="form-group has-feedback ">
							<input type="submit" class="applynow" value="Submit" name="submit">
						</div>
							</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection