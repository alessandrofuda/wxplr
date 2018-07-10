@extends('emails.templates.layout1')



@section('content')


	<div class="registered_user">
		[-- wexplore Admin notification --]<br/><br/>
		Hello Admins,
		<br/>
		<p>Someone submitted the Service Contact Us form:</p>
		<p>Date : {{ $current_date }}</p>
		<table>
			<tr><td>1.</td><td><b>Service</b>: {{ $service_name }}</td></tr>
			<tr><td>2.</td><td><b>Name</b>: {{ $contact_form_data['name'] }}</td></tr>
			<tr><td>3.</td><td><b>Surname</b>: {{ $contact_form_data['surname'] }}</td></tr>
			<tr><td>4.</td><td><b>Address</b>: {{ $contact_form_data['address'] }}</td></tr>
			<tr><td>5.</td><td><b>Email</b>: {{ $contact_form_data['email'] }}</td></tr>
			@if($contact_form_data['message'] != '')
			<tr><td>6.</td><td><b>Message</b>: {{ $contact_form_data['message'] }}</td></tr>
			@endif
		</table>
		<br/>
	</div>

@endsection