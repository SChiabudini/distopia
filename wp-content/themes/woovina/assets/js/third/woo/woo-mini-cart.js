var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
    // Woo mobile cart sidebar
    woovinaWooMobileCart();
});

/* ==============================================
WOOCOMMERCE MOBILE CART SIDEBAR
============================================== */
function woovinaWooMobileCart() {
	"use strict"

	if($j('body').hasClass('woocommerce-cart')
		|| $j('body').hasClass('woocommerce-checkout')) {
		return;
	}
	
	var woovina_cart_filter_close = function() {
		$j('html').css({
			'overflow': '',
			'margin-right': '' 
		});

		$j('body').removeClass('show-cart-sidebar');
	};

	$j(document).on('click', '.woovina-mobile-menu-icon a.wcmenucart', function(e) {
		e.preventDefault();

		var innerWidth = $j('html').innerWidth();
		$j('html').css('overflow', 'hidden');
		var hiddenInnerWidth = $j('html').innerWidth();
		$j('html').css('margin-right', hiddenInnerWidth - innerWidth);

		$j('body').addClass('show-cart-sidebar');
	});

	$j('.woovina-cart-sidebar-overlay, .woovina-cart-close').on('click', function(e) {
		e.preventDefault();
		
		woovina_cart_filter_close();

		// Remove show-cart here to let the header mini cart working
		$j('body').removeClass('show-cart');
	});

	// Close on resize to avoid conflict
	$j(window).resize(function() {
		woovina_cart_filter_close();
	});

}