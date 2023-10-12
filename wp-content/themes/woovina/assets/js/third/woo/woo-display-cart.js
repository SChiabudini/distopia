var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
    // Woo display cart
    woovinaWooDisplayCart();
});

/* ==============================================
WOOCOMMERCE DISPLAY CART
============================================== */
function woovinaWooDisplayCart() {
	"use strict"

	var $overlay = $j('.wvn-cart-overlay');

	$j('body').on('added_to_cart', function() {
		$overlay.fadeIn();
		$j('body').addClass('show-cart');
		
		$j('html, body').animate({
			scrollTop: 0
		}, 600);
		
		// Close quick view modal if enabled
		var qv_modal 		= $j('#wvn-qv-wrap'),
			qv_content 		= $j('#wvn-qv-content');

		if(qv_modal.length) {	
			$j('html').css({
				'overflow': '',
				'margin-right': '' 
			});
			$j('html').removeClass('wvn-qv-open');

			qv_modal.fadeOut();
			qv_modal.removeClass('is-visible');

			setTimeout(function() {
				qv_content.html('');
			}, 600);
		}
    });

    $overlay.on('click', function() {
		$j(this).fadeOut();
		$j('body').removeClass('show-cart');
	});

	// Close on resize to avoid conflict
	$j(window).resize(function() {
		$overlay.fadeOut();
		$j('body').removeClass('show-cart');
	});

}