(function($) {
	
	"use strict";
	
	var lastScrollTop = 0;
	
	// Scroll Class
	$(window).on('scroll', function() {
		var scrollTop = $(this).scrollTop();
    
		if (scrollTop > lastScrollTop) {
			$('#mobile-navbar.hide_on_footer').removeClass('active');
		} 
		else {
			$('#mobile-navbar.hide_on_footer').addClass('active');
		}
		
		lastScrollTop = scrollTop;
	});
	
})(jQuery);