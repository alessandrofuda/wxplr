@extends('layouts.new_layout')
@section('content')

</header>
</div>

@if(session('status'))
<div class="row">
	 <div class="col-md-12">
		  <div class="alert alert-success">
				<ul>
					 <li>{{ session('status') }}</li>
				</ul>
		  </div>
	 </div>
</div>
@endif

@if (count($errors) > 0)
<div class="row">
	 <div class="col-md-12">
		  <div class="alert alert-danger">
			   <ul>
					 @foreach ($errors->all() as $error)
						  <li>{{ $error }}</li>
					 @endforeach
			   </ul>
		  </div>
	 </div>
</div>
@endif

<div class="section flv_sections_8"  id="skills-development">
					<div class="section_wrapper clearfix">
						<div class="items_group clearfix">
							<!-- Page Title-->
							<!-- One full width row-->
							<div class="column one column_fancy_heading">
								<div class="fancy_heading fancy_heading_icon">
									<h2 style="color:#1f87c7; text-transform:uppercase; background: url('{{ asset('frontend/immagini/linea-titolo-blu.png') }}') no-repeat bottom center; padding-bottom: 25px;">{{ $page_title }}</h2><p style="text-transform:uppercase;">{{ $desc }}</p>
								</div>
                                <div class="image_wrapper"><img class="scale-with-grid" src="/frontend/immagini/contatti.jpg"alt="" />
									</div>
							</div>
                            <div class="column one column_fancy_heading">

                            <form role="form" method="post" action="{{ url('contact') }}">
                        <!-- text input -->
                        <div class="form-group column one-third column_column">
                          <label>Name*</label>
                          <input type="text" name="name" required class="form-control" placeholder="Enter your name..." value="{{ old('name') }}">
                        </div>
						<div class="form-group column one-third column_column">
                          <label>E-mail*</label>
                          <input type="email" name="email" required class="form-control" placeholder="Enter your email..." value="{{ old('email') }}">
                        </div>
                        <div class="form-group column one-third column_column">
                          <label>Subject</label>
                          <input type="text" name="subject" class="form-control" placeholder="Enter subject..." value="{{ old('subject') }}">
                        </div>
						<div class="form-group">
                          <label>Message</label>
                          <textarea name="message" rows=5 class="form-control" placeholder="Enter your message here...">{{ old('message') }}</textarea>
                        </div>
						<div class="form-group">
                          <label>Privacy Policy*</label>
							<div>
							<input type="radio" name="policy" required>
							<span>I authorize the treatment of my personal data pursuant to the Italian Legislative Decree on privacy 196/2003. <a href="/privacy-policy" target="_blank">Read the privacy policy</a></span>
						  </div>
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Send</button>
                      </form>
                            </div>


						</div>
					</div>
				</div>














</div>
@endsection
