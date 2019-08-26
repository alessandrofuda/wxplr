@extends('layouts.dashboard_layout')

@push('js-libraries')
	<!--got pro chatbot-->
    {{-- 
    	<script src="https://www.ew9102bot.it/lib/signalr/signalr.js"></script>
		<script src="https://www.ew9102bot.it/js/ewbot.js"></script> 
	--}}
	<script src="http://94.76.213.73:9999/lib/signalr/signalr.js"></script>
	<script src="http://94.76.213.73:9999/js/ewbot.js"></script>
@endpush

@section('content')
	<div id="vic" class="container-fluid">
	    <div class="row vic-container">
	    	<div class="col-md-6 sx">
		        <div class="top-heading"></div>
		        <div class="sub-heading" style="margin-bottom:10px;">Vic</div>
		        <!--div class="intro text-center">Take your journey one step further with our GOT Pro</div-->
		        <div id="chat-wrapper" class="body"></div>
		        
		        <div class="suspend-link">
		        	<a href="{{route('vic_middle')}}">do you want suspend ?</a>
		        </div>
	        </div>
	        <div class="col-md-6 dx" style="padding-right: 0;">
	        	<img class="img-got-pro-dx" src="{{asset('frontend/images/vic/img-dx.png')}}">
	        </div>
	    </div>
	</div>
@endsection



{{-- 
@push('scripts')
	<script>
		function resizeIframe(obj) {
			obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
		}

		//ricerca id sessione nella query string GET (SOLO PER SVILUPPO)
		function queryParameter(name){
			var parameters = window.location.search.substring(1);
			var properties = parameters.split("&");
			var result = null;
			properties.forEach(function(p){
				var tmp = p.split("=");
				if(tmp[0] == name){
					result = tmp[1];
				}
			});
			
			return result;
		}

		if(CheckCompatibility()){
			var chat = new Ewbot();
			chat.Init({
				hubendpoint : 'http://94.76.213.73:9999/Ewbot',  // 'https://www.ew9102bot.it/Ewbot',
				chat_image_welcome : '{{asset('custom/chat-vic/logo_apri_chat.png')}}',
				chat_image_header_opened : '{{asset('custom/chat-vic/header_chat.png')}}',
				chat_image_header_closed : '{{asset('custom/chat-vic/logo_chat_aperta.png')}}',			
				chat_send : '{{asset('custom/chat-vic/chat_send_msg.png')}}',
				css_headers : '{{asset('custom/chat-vic/chat_CT.css')}}',
				flow: 'Wexplore_B2C',  // 'WeExploreFlowNew',
				disable_signalR: true,  // false,
				// context: 'nn...',
				session_id: queryParameter("session_id"),
				parameters: 
				{ 
					user_id: {{Auth::user()->id}},
					chat_object_name: 'chat',
					current_page: window.location.href
				}
			});
			chat.InitializeContent();
		}	
	</script>

	<!--customization -->
	<script>
		jQuery(function($) {
			$('#chat-with-me').detach().appendTo('#chat-wrapper');
			$('#chat-main').detach().appendTo('#chat-wrapper');
			$('#chat-with-me').trigger('click');
			$('#chatMessageList .chat-message-container.darker img').attr('src', '/frontend/images/wexplore-logo-tondo-plain.png');
			$('#chatTextBox').attr('placeholder', 'Compose your message ...');
		});
	</script>
@endpush
 --}}