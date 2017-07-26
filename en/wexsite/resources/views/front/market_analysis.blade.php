@extends('front.dashboard_layout')
@section('content')
	@include('front.navigation')
<div class="container user_profile_form">
	<div class="row">
		<div class="heading">
			<h1>{{ $page_title }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="Market_files">
			{!! $market_analysis_data['market_analysis']['market_analysis_desc'] !!}
			<p>For further information, feel free to consult our <a target="_blank" href="{{ asset($market_analysis_data['market_analysis']['pdfs'][0]['pdf_path']) }}">{{ $market_analysis_data['market_analysis']['pdfs'][0]['pdf_name'] }}</a></p>
			<div class="acc-container">
				<div class="acc-btn"><h1 class="selected">Labour Market Situation</h1></div>
				<div class="acc-content open">
					<div class="acc-content-inner">
						{!! $market_analysis_data['labour_market_situation']['market_analysis_desc'] !!}
						<div id="pdf-carousel">
							<div class="span12">
								<div id="owl_labour_market" class="owl-carousel">
									@if(isset($market_analysis_data['labour_market_situation']['pdfs'][0]['pdf_path']))
										<div class="item">
											<a target="_blank" href="{{ asset($market_analysis_data['labour_market_situation']['pdfs'][0]['pdf_path']) }}">
												<img alt="market_analysis_pdf_file-icon" src="{{ asset('admin/custom/images/file-icon.png') }}">
												<h1>{{ $market_analysis_data['labour_market_situation']['pdfs'][0]['pdf_name'] }}</h1>
											</a>
										</div>
									@endif
									@if(count($related_pdfs)>0)
										@foreach($related_pdfs as $related_pdf)
											<div class="item">
												<a target="_blank" href="{{ asset($related_pdf['pdf_path']) }}">
													<img alt="market_analysis_pdf_file-icon" src="{{ asset('admin/custom/images/file-icon.png') }}">
													<h1>{{ $related_pdf['pdf_name'] }}</h1>
												</a>
											</div>
										@endforeach
									@endif
								</div>
								<div class="customNavigation">
									<a class="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
									<a class="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
								</div>
							</div>
						</div>
						<div class="download_pdf"><a href="{{ route('labourZipDownload') }}">Download all files</a></div>
					</div>
				</div>
				<div class="acc-btn"><h1>Quality of Work</h1></div>
				<div class="acc-content">
					<div class="acc-content-inner">
						{!! $market_analysis_data['quality_of_work']['market_analysis_desc'] !!}
						<div id="pdf-carousel">
							<div class="span12">
							  <div id="owl_quality_of_work" class="owl-carousel">
								{{--*/ $quality_work_pdfs = $market_analysis_data['quality_of_work']['pdfs'] /*--}}
								@if(count($quality_work_pdfs)>0)
									@foreach($quality_work_pdfs as $quality_work_pdf)
										<div class="item">
											<a target="_blank" href="{{ asset($quality_work_pdf['pdf_path']) }}">
												<img alt="market_analysis_pdf_file-icon" src="{{ asset('admin/custom/images/file-icon.png') }}">
												<h1>{{ $quality_work_pdf['pdf_name'] }}</h1>
											</a>
										</div>
									@endforeach
								@endif

							</div>
							  <div class="customNavigation">
								<a class="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
								<a class="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
							  </div>
							</div>
						</div>
						<div class="download_pdf"><a href="{{ route('qualityWorkZipDownload') }}">Download all files</a></div>
					</div>
				</div>
				<div class="acc-btn"><h1>Quality of life</h1></div>
				<div class="acc-content">
					<div class="acc-content-inner">
						{!! $market_analysis_data['quality_of_life']['market_analysis_desc'] !!}
						<div id="pdf-carousel">
							<div class="span12">
							  <div id="owl_quality_of_life" class="owl-carousel">
								{{--*/ $quality_life_pdfs = $market_analysis_data['quality_of_life']['pdfs'] /*--}}
								@if(count($quality_life_pdfs)>0)
									@foreach($quality_life_pdfs as $quality_life_pdf)
										<div class="item">
											<a target="_blank" href="{{ asset($quality_life_pdf['pdf_path']) }}">
												<img alt="market_analysis_pdf_file-icon" src="{{ asset('admin/custom/images/file-icon.png') }}">
												<h1>{{ $quality_life_pdf['pdf_name'] }}</h1>
											</a>
										</div>
									@endforeach
								@endif
							</div>
							  <div class="customNavigation">
								<a class="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
								<a class="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
							  </div>
							</div>
						</div>
						<div class="download_pdf"><a href="{{ route('qualityLifeZipDownload') }}">Download all files</a></div>
					</div>
				</div>
				<div>
				<br/>
					<p>Thank you for completing this phase! We hope that now you have a better understanding of where to direct your search efforts. Please proceed to Culture Match.</p>
					<a style="display:inline-block;" class="btn btn-primary" href="{{ url('user/culture_match') }}">Culture Match >></a>
					<br clear="all" />
					<br/>
					<!--<form class="not_form">
						<input type="text" name="name" placeholder="Name">
						<input type="button" name="" value="Submit">
					</form>-->
<p><strong>Note:</strong> Not found what you were looking for? We are working to make the data available at worldwide level, however if Europe is too small for you, contact us: we will provide you with all the information on the country you need!</p>

				</div>
			</div>
		</div>
		</div>
	</div>
</div>
<!-- <script type="text/javascript">
	jQuery(function() {
	jQuery('.ss_button').on('click',function() {
		jQuery('.ss_content').slideUp('fast');
		jQuery(this).next('.ss_content').slideDown('fast');
	});
});
</script> -->
<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
<script>

    $(document).ready(function() {
      var owl_labour_market = $("#owl_labour_market");
      owl_start(owl_labour_market);
	  var owl_quality_of_work = $("#owl_quality_of_work");
	  owl_start(owl_quality_of_work);
	  var owl_quality_of_life = $("#owl_quality_of_life");
	  owl_start(owl_quality_of_life);
	  function owl_start(owl) {
        owl.owlCarousel({

		items : 4, //10 items above 1000px browser width
		itemsDesktop : [1000,5], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
		itemsTablet: [600,2], //2 items between 600 and 0;
		itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option

		});
		// Custom Navigation Events
		owl.closest("#pdf-carousel").find(".next").click(function(){
		  owl.trigger('owl.next');
		})
		owl.closest("#pdf-carousel").find(".prev").click(function(){
		  owl.trigger('owl.prev');
		})
		owl.closest("#pdf-carousel").find(".play").click(function(){
		  owl.trigger('owl.play',1000);
		})
		owl.closest("#pdf-carousel").find(".stop").click(function(){
		  owl.trigger('owl.stop');
		})
		// hide next/pre if item is less than 4
		if ($('#pdf-carousel').length > 0) {
            var viewport = jQuery(window).width();
			var itemCount = owl.closest("#pdf-carousel").find("div.item").length;

			if(viewport >= 900 && itemCount < 5)
			{
				 owl.closest("#pdf-carousel").find(".next").hide();
				 owl.closest("#pdf-carousel").find(".prev").hide();
			}
        }
      }


    });
    </script>
    <script>
$('#about-link').addClass('current');
$('#menu li a').on('click', function (e) {
    e.preventDefault();
    $('#menu li a.current').removeClass('current');
    $(this).addClass('current');
});


/******** Accordion js *************/

$(document).ready(function(){
  var animTime = 500,
      clickPolice = false;

  $(document).on('touchstart click', '.acc-btn', function(){
    if(!clickPolice){
       clickPolice = true;

      var currIndex = $(this).index('.acc-btn'),
          targetHeight = $('.acc-content-inner').eq(currIndex).outerHeight();

      $('.acc-btn h1').removeClass('selected');
      $(this).find('h1').addClass('selected');

      $('.acc-content').stop().animate({ height: 0 }, animTime);
      $('.acc-content').eq(currIndex).stop().animate({ height: targetHeight }, animTime);

      setTimeout(function(){ clickPolice = false; }, animTime);
    }
  });
});




</script>
@endsection
