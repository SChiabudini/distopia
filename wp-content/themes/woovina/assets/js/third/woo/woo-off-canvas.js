var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
    // Woo off canvas
    woovinaWooOffCanvas();
});

/* ==============================================
WOOCOMMERCE OFF CANVAS
============================================== */
function woovinaWooOffCanvas() {
	"use strict"

	$j(document).on('click', '.woovina-off-canvas-filter', function(e) {
		e.preventDefault();

		var innerWidth = $j('html').innerWidth();
		$j('html').css('overflow', 'hidden');
		var hiddenInnerWidth = $j('html').innerWidth();
		$j('html').css('margin-right', hiddenInnerWidth - innerWidth);

		$j('body').addClass('off-canvas-enabled');
	});

	$j('.woovina-off-canvas-overlay').on('click', function() {
		$j('html').css({
			'overflow': '',
			'margin-right': '' 
		});

		$j('body').removeClass('off-canvas-enabled');
	});

}