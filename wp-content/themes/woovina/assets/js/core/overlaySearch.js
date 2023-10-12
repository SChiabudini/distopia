var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
	// Overlay search
	woovinaOverlaySearch();
});

/* ==============================================
OVERLAY SEARCH
============================================== */
function woovinaOverlaySearch() {
	"use strict"

	// Return if is the not this search style
	if('overlay' != woovinaLocalize.menuSearchStyle) {
		return;
	}

	var $searchOverlayToggle 	= $j('a.search-overlay-toggle'),
		$searchOverlayClose 	= $j('a.search-overlay-close'),
		$searchOverlay 			= $j('#searchform-overlay');

	if($searchOverlayToggle.length) {

		$searchOverlayToggle.on('click', function(e) {
			e.preventDefault();

			$searchOverlay.addClass('active');
			$searchOverlay.fadeIn(200);

            setTimeout(function() {
				$j('html').css('overflow', 'hidden');
            }, 400);

		});

	}

	$searchOverlayClose.on('click', function(e) {
		e.preventDefault();

		$searchOverlay.removeClass('active');
		$searchOverlay.fadeOut(200);

        setTimeout(function() {
			$j('html').css('overflow', 'visible');
        }, 400);

	});

	$searchOverlayToggle.on('click', function() {
		$j('#searchform-overlay input').focus();
	});

}