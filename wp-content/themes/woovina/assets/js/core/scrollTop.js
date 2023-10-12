var $j 		= jQuery.noConflict(),
	$window = $j(window);

$j(document).ready(function() {
	"use strict";
	// Scroll top
	woovinaScrollTop();
});

/* ==============================================
SCROLL TOP
============================================== */
function woovinaScrollTop() {
	"use strict"

	var selectors  = {
		scrollTop  		: '#scroll-top',
		topLink    		: 'a[href="#go-top"]',
		slashTopLink 	: 'body.home a[href="/#go-top"]'
	}

	$window.on('scroll', function() {
		if($j(this).scrollTop() > 100) {
			$j('#scroll-top').fadeIn();
			$j('#scroll-top').css('right','0');
		} else {
			$j('#scroll-top').fadeOut();
		}
	});

	$j.each(selectors, function(key, value){
		$j(value).on('click', function(e){
			e.preventDefault();
			$j('html, body').animate({ scrollTop:0 }, 400);
			$j(this).parent().removeClass('sfHover');
		});
	});

}