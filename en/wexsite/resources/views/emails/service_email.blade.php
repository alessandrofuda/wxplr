<div class="registered_user">
Hello Admin,
<br/>
<p>Someone submitted the Service Contact Us form:</p>
<p>Date : {{ $current_date }}</p>
<table>
	<tr><td>1.</td><td>Service : </td><td>{{ $service_name }}</td></tr>
	<tr><td>2.</td><td>Name : </td><td>{{ $contact_form_data['name'] }}</td></tr>
	<tr><td>3.</td><td>Surname : </td><td>{{ $contact_form_data['surname'] }}</td></tr>
	<tr><td>4.</td><td>Address : </td><td>{{ $contact_form_data['address'] }}</td></tr>
	<tr><td>5.</td><td>Email : </td><td>{{ $contact_form_data['email'] }}</td></tr>
	@if($contact_form_data['message'] != '')
	<tr><td>6.</td><td>Message : </td><td>{{ $contact_form_data['message'] }}</td></tr>
	@endif
</table>
	<br/>
Thanks,
</div>
