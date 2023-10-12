var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
	// Nav no click
	woovinaNavNoClick();
});

/* ==============================================
NAV NO CLICK
============================================== */
function woovinaNavNoClick() {
	"use strict"

	$j('li.nav-no-click > a').on('click', function() {
		return false;
	});

}