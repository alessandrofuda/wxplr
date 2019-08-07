@extends('layouts.dashboard_layout')

@push('js-libraries')
	<!--got pro chatbot-->
    <script src="https://www.ew9102bot.it/lib/signalr/signalr.js"></script>
	<script src="https://www.ew9102bot.it/js/ewbot.js"></script>
@endpush

{{-- @section('content')
	<div class="container">
	    <div class="row">
	    	<div class="col-md-12">
		        <div class="heading">
		            <h1>{{ $page_title }}</h1>
		        </div>
	        </div>
	    </div>
	    <div class="row">
	        <div class="col-md-12" style="font-size: 16px;">
	        	<div class="box" style="margin-top:20px;">
	        		<div class="box-title"></div>
	        		<div class="box-body">
	        			<p>Run the Chat-Bot by clicking on the button below.</p>
	        			<div class="img-container" style="max-height: 500px; overflow: hidden; text-align: center; ">
	        				<img src="{{asset('frontend/images/got-pro-img.jpg')}}" style="width: 100%; position: relative; top: -1020px; ">
	        			</div>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</div>
@endsection --}}

@section('content')
	<div id="got-pro" class="container-fluid">
	    <div class="row got-pro-container">
	    	<div class="col-md-6 sx">
		        <div class="top-heading"></div>
		        <div class="sub-heading" style="margin-bottom:10px;">GOT Pro</div>
		        <!--div class="intro text-center">Take your journey one step further with our GOT Pro</div-->
		        <div id="chat-wrapper" class="body"></div>
		        

	        </div>
	        <div class="col-md-6 dx" style="padding-right: 0;">
	        	<img class="img-got-pro-dx" src="{{asset('frontend/images/got-pro/green-world.png')}}">
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
				hubendpoint : 'https://www.ew9102bot.it/Ewbot',
				chat_image_welcome : '{{asset('custom/chat-vic/logo_apri_chat.png')}}',
				chat_image_header_opened : '{{asset('custom/chat-vic/header_chat.png')}}',
				chat_image_header_closed : '{{asset('custom/chat-vic/logo_chat_aperta.png')}}',			
				chat_send : '{{asset('custom/chat-vic/chat_send_msg.png')}}',
				css_headers : '{{asset('custom/chat-vic/chat_CT.css')}}',
				flow: 'WeExploreFlowNew',
				disable_signalR: false,
				context: 'nn...',
				parameters: 
				{ 
					user_id: {{Auth::user()->id}},
					chat_object_name: 'chat'
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
