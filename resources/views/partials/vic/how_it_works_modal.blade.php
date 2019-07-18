<!-- Button trigger modal -->
<a type="button" class="how-it-w" data-toggle="modal" data-target="#how-vic-modal">
		<i class="fas fa-question-circle"></i> How it works
</a>
<!-- Modal -->
<div class="modal fade" id="how-vic-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Vic</h4>
			</div>
			<div class="modal-body">
				<div class="modal-subtitle">How it works</div>
				<div class="modal-text">
					<ol>
						<li>Start the chat</li>
						<li>VIC recommends a program based on 11 steps: you can complete them in the suggested sequence or browse through them in the order you prefer</li>
						<li>You can log out and log back in as many times as you want: there is no limit on time or on the number of sessions, and you will pick up the chat from where you left it</li>
						<li>Once you complete a set of steps, you will receive a summary report on the phases you will have completed. Again, you can shuffle around, but we do encourage you to complete them to collect and download the necessary information</li>
						<li>The 3 reports are: preparation (from step 1 to 4) - hunt (from step 5 to 9) - take off (steps 10 and 11). The reports contain all the information you have discussed with VIC, and additional sources for your job search</li>
					</ol>
				</div>
				<div class="modal-img">
					<img class="" src="" style="border:1px solid gray; width:100%; height: 200px;">
				</div>
				<div class="modal-subtitle">how much is it ?</div>
				<div class="modal-text">
					Price: {{ $user_services[App\Service::VIC]['price'] ?? $price }}€
				</div>
			</div>
			<div class="modal-footer">
				<a type="button" class="btn cta" data-dismiss="modal">Go</a>
			</div>
		</div>
	</div>
</div>