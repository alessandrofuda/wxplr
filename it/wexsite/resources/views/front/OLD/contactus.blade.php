@extends('front.new_layout')
@section('content')

</header>
</div>
<div class="row">
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
            <div class="box-header contact_us_heading">
              <h1 class="box-title">{{ $page_title }}</h1>
              <p>{{ $desc }}</p> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body">
                      <form class="contactUs-form" role="form" method="post" action="{{ url('contact') }}">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="name" required class="form-control" placeholder="Enter your name..." value="">
                        </div>
						<div class="form-group">
                          <label>E-mail</label>
                          <input type="email" name="email" required class="form-control" placeholder="Enter your email..." value="">
                        </div>
                        <div class="form-group">
                          <label>Subject</label>
                          <input type="text" name="subject" class="form-control" placeholder="Enter subject..." value="">
                        </div>
						<div class="form-group">
                          <label>Message</label>
                          <textarea name="message" rows=12 class="form-control" placeholder="Enter your message here..."></textarea>
                        </div>
						<div class="form-group">
                          <label>Informativa Privacy</label>
							<div>
							<input type="radio" name="policy" required>
							<span>Dichiaro di aver preso visione dell''<a href="{{ url('privacy_policy') }}">Informativa sulla privacy</a></span>
						  </div>
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Send</button>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>
@endsection