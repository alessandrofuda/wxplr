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
	if (window.matchMedia('(max-width: 767px)').matches) {
		$('.dropdown-toggle').hide();
		$('.responsive-menu-toggle i').click(function() {
			$('.dropdown-toggle').hide();
			$('.dropdown-menu').toggle();
			$('.dropdown-menu').css('top', '65px');
		});
	}




	// loading page animation for dompdf report
	$('.report-loading-modal').hide(); // dashboard_layout.blade.php
	$('#Wrapper').removeClass('div-disabled');

	$('.loading-report-ajax.preparation-report').on('click', function() {
		$('.report-loading-modal').show();
		$('#Wrapper').addClass('div-disabled');		
		$.ajax({
	    	url: preparationReportGenerationUrl,
	    	success: function(result) {
	    		if(result.status == 200) {
	    			$('.loading-report-ajax.preparation-report').hide();
	    			$('.download-preparation-report').attr('href', preparationReportDownloadUrl).html('Report Ready<br/>Download').show();
	    			$(window.location).attr('href', preparationReportDownloadUrl);
	    		}	
	    	},
	    	error: function(xhr) {
	    		alert("Error occured. Please try later");
	    		console.error(xhr.statusText + xhr.responseText);
	    	},
	    	complete: function() {
	    		$('#Wrapper').removeClass('div-disabled');
	    		$('.report-loading-modal').hide();
	    	}
	    });
	});

	$('.report-loading-modal button[data-dismiss="modal"]').on('click', function() {
		$('#Wrapper').removeClass('div-disabled');
		$('.report-loading-modal').hide();
	});
});
