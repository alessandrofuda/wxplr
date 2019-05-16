@extends('front.dashboard_layout')

@push('js-libraries')
	<!--vic chatbot-->
    <script src="http://94.76.213.73/lib/signalr/signalr.js"></script>
	<script src="http://94.76.213.73/js/ewbot.js"></script>
@endpush

@section('content')
	<div class="container">
	    <div class="row">
	    	<div class="col-md-12">
		        <div class="heading">
		            <h1>{{ $page_title }}</h1>
		        </div>
	        </div>
	    </div>
	    <div class="row">
	        <div class="col-md-12">
	        	chatbot 1 PRO
	        </div>
	    </div>
	</div>
@endsection



@push('scripts')
	<script>
		function resizeIframe(obj) {
			obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
		}

		if(CheckCompatibility()){
			var chat = new Ewbot();
			chat.Init({
				hubendpoint : 'http://94.76.213.73/Ewbot',
				chat_image_welcome : '{{asset('custom/chat-vic/logo_apri_chat.png')}}',
				chat_image_header_opened : '{{asset('custom/chat-vic/header_chat.png')}}',
				chat_image_header_closed : '{{asset('custom/chat-vic/logo_chat_aperta.png')}}',			
				chat_send : '{{asset('custom/chat-vic/chat_send_msg.png')}}',
				css_headers : '{{asset('custom/chat-vic/chat_CT.css')}}',
				flow: 'WeExploreFlowNew',
				disable_signalR: true,
				context: 'nn...',
				parameters: 
				{ 
					user_id: 10,
					chat_object_name: 'chat'
				}
			});
			chat.InitializeContent();
		}	
	</script>
@endpush
