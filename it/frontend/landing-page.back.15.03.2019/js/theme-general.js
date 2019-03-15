$(document).ready(function() {
	function checkMyHead() {
		fromTop = jQuery(document).scrollTop();
		if ( fromTop > 100 ) {
				jQuery('#header').removeClass( "not-scrolled-header" ).addClass( "scrolled-header" );
		}
		else {
			jQuery('#header').removeClass( "scrolled-header" ).addClass( "not-scrolled-header" );
		}
	}
	checkMyHead();

	jQuery(document).scroll(function() {
		checkMyHead();
	});

	documentWidth = $(document).width();
	if ( documentWidth > 1024) {
		headerOffset = 30;
	}
	else {
		headerOffset = 30;
	}
	var scrollSpeed = 2000;

	function scrollSectionOne() {
		$([document.documentElement, document.body]).animate({
        scrollTop: $("#SectionOne").offset().top - headerOffset
    }, scrollSpeed);
	}

	$("#goToSectionOne").click(function() {
		scrollSectionOne();
	});



	$.fn.moveIt = function(){
  var $window = $(window);
  var instances = [];

  $(this).each(function(){
    instances.push(new moveItItem($(this)));
  });

  window.addEventListener('scroll', function(){
    var scrollTop = $window.scrollTop();
    instances.forEach(function(inst){
      inst.update(scrollTop);
    });
  }, {passive: true});
}

var moveItItem = function(el){
  this.el = $(el);
  this.speed = parseInt(this.el.attr('data-scroll-speed'));
};

moveItItem.prototype.update = function(scrollTop){
  this.el.css('transform', 'translateY(' + -(scrollTop / this.speed) + 'px)');
};

// Initialization
$(function(){
  $('[data-scroll-speed]').moveIt();
});


});
