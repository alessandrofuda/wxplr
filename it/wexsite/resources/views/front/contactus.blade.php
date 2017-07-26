@extends('front.new_layout')
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

<div class="section flv_sections_8" id="skills-development">
	<div class="section_wrapper clearfix">
		<div class="items_group clearfix">
			<!-- Page Title-->
			<!-- One full width row-->
			<div class="column one column_fancy_heading">
				<div class="fancy_heading fancy_heading_icon">
					<h2 style="color:#1f87c7; text-transform:uppercase; background: url('{{ asset('frontend/immagini/linea-titolo-blu.png') }}') no-repeat bottom center; padding-bottom: 25px;">{{ $page_title }}</h2><p style="text-transform:uppercase;">{{ $desc }}</p>
				</div>
				<div class="image_wrapper"><img class="scale-with-grid" src="/en/frontend/immagini/contatti.jpg"alt="" /></div>
			</div>
			<div class="column one column_fancy_heading">
				<form role="form" method="post" action="{{ url('contact') }}">
					<!-- text input -->
					<div class="form-group column one-third column_column">
						<label>Nome*</label>
						<input type="text" name="name" required class="form-control" placeholder="Inserisci il nome..." value="{{ old('name') }}">
					</div>
					<div class="form-group column one-third column_column">
						<label>E-mail*</label>
						<input type="email" name="email" required class="form-control" placeholder="Inserisci l'email..." value="{{ old('email') }}">
					</div>
					<div class="form-group column one-third column_column">
						<label>Oggetto</label>
						<input type="text" name="subject" class="form-control" placeholder="Inserisci l'oggetto..." value="{{ old('subject') }}">
					</div>
					<div class="form-group">
						<label>Messaggio</label>
						<textarea name="message" rows=5 class="form-control" placeholder="Scrivi un messaggio...">{{ old('message') }}</textarea>
					</div>
					<div class="form-group">
						<label>Informativa Privacy*</label>
						<div>
							<input type="radio" name="policy" required>
							<span>Dichiaro di aver preso visione dell'<a href="/it/informativa-privacy" target="_blank">Informativa sulla privacy</a></span>
						</div>
					</div>
					{{ csrf_field() }}
					<button type="submit" class="btn btn-primary">Invia</button>
				</form>
			</div>
		</div>
	</div>
</div>

</div>
@endsection
