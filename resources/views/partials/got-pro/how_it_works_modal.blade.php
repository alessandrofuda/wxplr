<!-- Button trigger modal -->
<a type="button" class="how-it-w" data-toggle="modal" data-target="#how-got-pro-modal">
		<i class="fas fa-question-circle"></i> How it works
</a>
<!-- Modal -->
<div class="modal fade" id="how-got-pro-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">GOT Pro</h4>
			</div>
			<div class="modal-body">
				<div class="modal-subtitle">How it works</div>
				<div class="modal-text">
					<ol>
						<li>Start the chat.</li>
						<li>Answer the profiling questions: the virtual consultant will guide you through the conversation.</li>
						<li>Discover the 3 countries in Europe that best match your professional skills.</li>
					</ol>
				</div>
				{{-- <div class="modal-img">
					<img class="" src="" style="border:1px solid gray; width:100%; height: 200px;">
				</div> --}}
				<div class="modal-subtitle">how much is it ?</div>
				<div class="modal-text">
					Price: {{ $user_services[App\Service::GOT_PRO]['price'] ?? $price }}€
				</div>
			</div>
			<div class="modal-footer">
				<a type="button" class="btn cta" data-dismiss="modal">Go</a>
			</div>
		</div>
	</div>
</div>