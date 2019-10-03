@extends('layouts.dashboard_layout')

@push('js-libraries')
	<!--Vic_B2C chatbot-->
	<script src="https://www.ew9102bot.it/lib/signalr/signalr.js"></script>
	<script src="https://www.ew9102bot.it/js/ewbot.js"></script> 
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
		        	<a class="cta btn" href="{{ route('vic_middle') }}">Click here to pause your Career Ready session.</a>
		        	<div class="txt" style="font-size: 12px;">Remember that you can come back any time and resume from where you stopped.</div>
		        </div>
	        </div>
	        <div class="col-md-6 dx" style="padding-right: 0;">
	        	<img class="img-got-pro-dx" src="{{asset('frontend/images/vic/img-dx.png')}}">
	        </div>
	    </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="countries-list-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			    <div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				        <span aria-hidden="true">&times;</span>
				    </button>
				     <!--h6 class="modal-title" id="exampleModalLabel">Lista paesi</h6-->
			    </div>
			    <div class="modal-body">
			    	<ul>
			    		<li>Francia</li>
			    		<li>Italia</li>
			    		<li>Olanda</li>
			    		<li>Regno Unito</li>
			    	</ul>
			    	{{-- <ol id="countryList" style="">
						<li>Africa</li>
						<li>Albania</li>
						<li>Arabia Saudita</li>
						<li>Argentina</li>
						<li>Australia</li>
						<li>Austria</li>
						<li>Belgio</li>
						<li>Bhutan</li>
						<li>Brasile</li>
						<li>Bulgaria</li>
						<li>Canada</li>
						<li>Capo Verde</li>
						<li>Cina</li>
						<li>Colombia</li>
						<li>Corea del Sud</li>
						<li>Costa Rica</li>
						<li>Croazia</li>
						<li>Danimarca</li>
						<li>Ecuador</li>
						<li>Egitto</li>
						<li>Estonia</li>
						<li>Fiji</li>
						<li>Filippine</li>
						<li>Finlandia</li>
						<li>Francia</li>
						<li>Germania</li>
						<li>Giamaica</li>
						<li>Giordania</li>
						<li>Grecia</li>
						<li>Guatemala</li>
						<li>Honduras</li>
						<li>Hong Kong</li>
						<li>India</li>
						<li>Indonesia</li>
						<li>Iran</li>
						<li>Iraq</li>
						<li>Irlanda</li>
						<li>Islanda</li>
						<li>Israele</li>
						<li>Italia</li>
						<li>Libano</li>
						<li>Libia</li>
						<li>Lituania</li>
						<li>Lussemburgo</li>
						<li>Malesia</li>
						<li>Malta</li>
						<li>Marocco</li>
						<li>Medio Oriente</li>
						<li>Messico</li>
						<li>Namibia</li>
						<li>Nepal</li>
						<li>Norvegia</li>
						<li>Nuova Zelanda</li>
						<li>Olanda</li>
						<li>Pakistan</li>
						<li>Peru</li>
						<li>Polonia</li>
						<li>Portogallo</li>
						<li>Repubblica Ceca</li>
						<li>Repubblica Dominicana</li>
						<li>Romania</li>
						<li>Russia</li>
						<li>Serbia</li>
						<li>Singapore</li>
						<li>Slovacchia</li>
						<li>Slovenia</li>
						<li>Spagna</li>
						<li>Sri Lanka</li>
						<li>Sud Africa</li>
						<li>Svezia</li>
						<li>Svizzera non tedesca</li>
						<li>Svizzera tedesca</li>
						<li>Taiwan</li>
						<li>Thailandia</li>
						<li>Turchia</li>
						<li>UAE</li>
						<li>UK</li>
						<li>Ungheria</li>
						<li>Uruguay</li>
						<li>USA</li>
						<li>Venezuela</li>
						<li>Vietnam</li>
					</ol> --}}
			    </div>
			    <div class="modal-footer">
			        <button type="button" class="cta btn btn-secondary" data-dismiss="modal">Chiudi</button>
			    </div>
			</div>
		</div>
	</div>
	
@endsection




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
				hubendpoint : 'https://www.ew9102bot.it/Ewbot',
				chat_image_welcome : '{{asset('custom/chat-vic/logo_apri_chat.png')}}',
				chat_image_header_opened : '{{asset('custom/chat-vic/header_chat.png')}}',
				chat_image_header_closed : '{{asset('custom/chat-vic/logo_chat_aperta.png')}}',			
				chat_send : '{{asset('custom/chat-vic/chat_send_msg.png')}}',
				css_headers : '{{asset('custom/chat-vic/chat_CT.css')}}',
				flow: 'Wexplore_B2C',
				disable_signalR: true, 
				// session_id: queryParameter("session_id"),
				session_id: '{{ $session_id }}',
				customer_key: '{{ config('services.ewhere.customer_key') }}',
				parameters: 
				{ 
					base_address: '{{ url('/') }}', 
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


			// countries list in modal
			// $('#countries-list-modal').on('click', function(e) {
			// 	e.preventDefault();
			// 	countriesListModal();
			// 	function countriesListModal(){
			// 	}
			// });

		});
	</script>
	
@endpush
