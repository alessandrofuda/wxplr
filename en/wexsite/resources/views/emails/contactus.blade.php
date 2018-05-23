<div class="registered_user">
Hello Admin,
<br/>
<p>Someone submitted the Contact Us form:</p>
<p>Date : {{ $current_date }}</p>
<table>
	<tr><td>1.</td><td>Name : </td><td>{{ $contact_form_data['name'] }}</td></tr>
	<tr><td>2.</td><td>Email : </td><td>{{ $contact_form_data['email'] }}</td></tr>
	<tr><td>3.</td><td>Subject : </td><td>{{ $contact_form_data['subject'] }}</td></tr>
	<tr><td>4.</td><td>Message : </td><td>{{ $contact_form_data['message'] }}</td></tr>
</table>
	<br/>
Thanks,
</div>