jQuery(document).ready(function($){

	// !! important content-wrapper height fix
	var sidebar_height = $('aside.main-sidebar').height();
	$('.content-wrapper.user-dash-wrapper').css('min-height', sidebar_height); 

	$('#got-page .outcome-content p').each(function(i) {
		console.log(i);
	});



	// toggle menu on screen small than 1240px
	if (window.matchMedia('(max-width: 1240px)').matches) {
		$('.dropdown-toggle').show();
		$('#menu').click(function() {
			$('.dropdown-menu').toggle();
		});
	};
	if (window.matchMedia('(max-width: 768px)').matches) {
		$('.dropdown-toggle').hide();
		$('.responsive-menu-toggle i').click(function() {
			$('.dropdown-toggle').hide();
			$('.dropdown-menu').toggle();
			$('.dropdown-menu').css('top', '65px');
		});
	}




	// loading page animation for dompdf report
	$('.report-loading-modal').hide(); // dashboard_layout.blade.php

	$('.loading-report-ajax.preparation-report').on('click', function() {
		$('.report-loading-modal').show();
		$.ajax({
	    	url: preparationReportUrl,
	    	success: function(result) {
	    		console.log(result);
	        	alert('success');
	        	$('.report-loading-modal').hide();
	    	},
	    	complete: function(){
	    		//
	    	}
	    });
	});

});
