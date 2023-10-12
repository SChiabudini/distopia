var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
    // Woo vertical thumbnails
    woovinaWooThumbnails();
});

// On load
$j(window).on('load', function() {
	"use strict";
    // Woo vertical thumbnails
    woovinaWooThumbnails();
});

// On resize
$j(window).on('resize', function() {
	"use strict";
    // Woo vertical thumbnails
    woovinaWooThumbnails();
});

/* ==============================================
WOOCOMMERCE VERTICAL THUMBNAILS
============================================== */
function woovinaWooThumbnails() {
	"use strict"

	var $thumbnails = $j('.wvn-thumbs-layout-vertical'),
		$nav 		= $thumbnails.find('.flex-control-nav');

	if($nav.length > 0) {

		if($j(window).width() > 768) {
				
			var $image_height 	= $thumbnails.find('.flex-viewport').height(),
				$nav_height 	= $thumbnails.find('.flex-control-nav').height();

			if($nav_height > ($image_height + 50)) {
				$nav.css({
					'max-height' : $image_height + 'px',
				});
			}

		} else {
			$nav.css({
				'max-height' : '',
			});
		}

	}

}