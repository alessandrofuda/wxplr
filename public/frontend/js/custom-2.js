jQuery(document).ready(function($){

	// !! important content-wrapper height fix
	var sidebar_height = $('aside.main-sidebar').height();
	$('.content-wrapper.user-dash-wrapper').css('min-height', sidebar_height); 

	$('#got-page .outcome-content p').each(function(i) {
		console.log(i);
	});
});
