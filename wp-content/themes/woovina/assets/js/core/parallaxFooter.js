var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
	// Parallax footer
	woovinaParallaxFooter();
});

$j(window).on('resize', function() {
	"use strict";
	// Parallax footer
	woovinaParallaxFooter();
});

/* ==============================================
PARALLAX FOOTER
============================================== */
function woovinaParallaxFooter() {
	"use strict"

	// Needed timeout for dynamic parallax content
	if($j('body').hasClass('has-parallax-footer')) {

		setTimeout(function() {
			$j('#main').css('margin-bottom', $j('.parallax-footer').outerHeight());
		}, 1);

	}

}