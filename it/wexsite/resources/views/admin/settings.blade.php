@extends('admin.layout')
@section('content')
<div class='row'>
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class='col-md-12'>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $page_title }}</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body">
					<form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/settings') }}">
					 {{ csrf_field() }}
					 <!-- text input --> 
                    <div class="form-group">
                          <label for="logo">Upload Logo</label>                          
							@if(isset($settings->logo) && !empty($settings->logo))
								<input type="file" name="logo" >
								  <br/><img alt="Setting_logo" src="{{ asset($settings->logo) }}" width="100">
							@else
								<input type="file" required name="logo" >
							@endif
                    </div>				
					<div class="form-group">
                          <label>Website Email</label>
							@if(isset($settings->website_email) && !empty($settings->website_email))
								<input type="text" name="website_email" required class="form-control" placeholder="Website Email" value="{{ $settings->website_email }}">
							@else
								<input type="text" name="website_email" required class="form-control" placeholder="Website Email" value="{{ old('website_email') }}">							 
							@endif
					</div>
					<div class="form-group">
                          <label>Timings</label>
							@if(isset($settings->timings) && !empty($settings->timings))
							 <input type="text" name="timings" required class="form-control" placeholder="Timings" value="{{ $settings->timings }}">
							@else
							 <input type="text" name="timings" required class="form-control" placeholder="Timings" value="{{ old('timings') }}">
							@endif
					</div>
								
					<div class="form-group">
						<div class="checkbox">
							<label>
							@if(isset($settings->facebook_active) && $settings->facebook_active == 1)
								<input type="checkbox" checked name="facebook_active" value="1">
							@else
								<input type="checkbox" @if(old('facebook_active')) checked @endif name="facebook_active" value="1">
							@endif
							Show Facebook</label>
						</div>
					</div>
					<div class="form-group">						
                          <label>Facebook URL</label>
							@if(isset($settings->facebook_url) && !empty($settings->facebook_url))
							 <input type="text" name="facebook_url" class="form-control" placeholder="Facebook URL" value="{{ $settings->facebook_url }}">
							@else
							 <input type="text" name="facebook_url" class="form-control" placeholder="Facebook URL" value="{{ old('facebook_url') }}">
							@endif
					</div>
					<div class="form-group">
						<div class="checkbox">
                          <label>
							@if(isset($settings->twitter_active) && $settings->twitter_active == 1)
								<input type="checkbox" checked name="twitter_active" value="1">
							@else
								<input type="checkbox" @if(old('twitter_active')) checked @endif name="twitter_active" value="1">
							@endif
						 Show Twitter</label>
						</div>
					</div>
					<div class="form-group">						
                          <label>Twitter URL</label>
							@if(isset($settings->twitter_url) && !empty($settings->twitter_url))
							 <input type="text" name="twitter_url" class="form-control" placeholder="Twitter URL" value="{{ $settings->twitter_url }}">
							@else
							 <input type="text" name="twitter_url" class="form-control" placeholder="Twitter URL" value="{{ old('twitter_url') }}">
							@endif
					</div>
					<div class="form-group">
						<div class="checkbox">
                          <label>
							@if(isset($settings->linkedin_active) && $settings->linkedin_active == 1)
								<input type="checkbox" checked name="linkedin_active" value="1">
							@else
								<input type="checkbox" @if(old('linkedin_active')) checked @endif name="linkedin_active" value="1">
							@endif
							Show Linkedin</label>
						</div>
					</div>
					<div class="form-group">
                          <label>Linkedin URL</label>
							@if(isset($settings->linkedin_url) && !empty($settings->linkedin_url))
							 <input type="text" name="linkedin_url" class="form-control" placeholder="Linkedin URL" value="{{ $settings->linkedin_url }}">
							@else
							 <input type="text" name="linkedin_url" class="form-control" placeholder="Linkedin URL" value="{{ old('linkedin_url') }}">
							@endif
					</div>
					<div class="form-group">
						<div class="checkbox">
                          <label>
							@if(isset($settings->google_plus_active) && $settings->google_plus_active == 1)
								<input type="checkbox" checked name="google_plus_active" value="1">
							@else
								<input type="checkbox" @if(old('google_plus_active')) checked @endif name="google_plus_active" value="1">
							@endif
							Show Google Plus</label>
						</div>
					</div>
					<div class="form-group">
                          <label>Google Plus URL</label>
							@if(isset($settings->google_plus_url) && !empty($settings->google_plus_url))
							 <input type="text" name="google_plus_url" class="form-control" placeholder="Google Plus URL" value="{{ $settings->google_plus_url }}">
							@else
							 <input type="text" name="google_plus_url" class="form-control" placeholder="Google Plus URL" value="{{ old('google_plus_url') }}">
							@endif
					</div>
					<div class="form-group">
						<div class="checkbox">
                          <label>
							@if(isset($settings->behance_active) && $settings->behance_active == 1)
								<input type="checkbox" checked name="behance_active" value="1">
							@else
								<input type="checkbox" @if(old('behance_active')) checked @endif name="behance_active" value="1">
							@endif
							Show Behance</label>
						</div>
					</div>
					<div class="form-group">
                          <label>Behance URL</label>
							@if(isset($settings->behance_url) && !empty($settings->behance_url))
							 <input type="text" name="behance_url" class="form-control" placeholder="Behance URL" value="{{ $settings->behance_url }}">
							@else
							 <input type="text" name="behance_url" class="form-control" placeholder="Behance URL" value="{{ old('behance_url') }}">
							@endif
					</div>
					<div class="form-group">
                          <label>Location Address</label>
							@if(isset($settings->location_address) && !empty($settings->location_address))
							 <textarea name="location_address" required class="form-control">{{ $settings->location_address }}</textarea>
							@else
							 <textarea name="location_address" required class="form-control">{{ old('location_address') }}</textarea>
							@endif
					</div>
					<div class="form-group">
                          <label>Website Phone</label>
							@if(isset($settings->website_phone) && !empty($settings->website_phone))
							 <input type="text" name="website_phone" class="form-control" placeholder="Website Phone" value="{{ $settings->website_phone }}">
							@else
							 <input type="text" name="website_phone" class="form-control" placeholder="Website Phone" value="{{ old('website_phone') }}">
							@endif
					</div>
					<div class="form-group">
                          <label>Contact Us Email</label>
							@if(isset($settings->contact_us_email) && !empty($settings->contact_us_email))
							 <input type="text" name="contact_us_email" required class="form-control" placeholder="Contact Us Email" value="{{ $settings->contact_us_email }}">
							@else
							 <input type="text" name="contact_us_email" required class="form-control" placeholder="Contact Us Email" value="{{ old('contact_us_email') }}">
							@endif
					</div>
					<div class="form-group">
                          <label>Copyright</label>
							@if(isset($settings->copyright) && !empty($settings->copyright))
							 <input type="text" name="copyright" required class="form-control" placeholder="Copyright" value="{{ $settings->copyright }}">
							@else
							 <input type="text" name="copyright" required class="form-control" placeholder="Copyright" value="{{ old('copyright') }}">
							@endif
					</div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/dashboard') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection