var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
    // Woo catalog view
    woovinaWooGridList();
});

/* ==============================================
WOOCOMMERCE GRID LIST VIEW
============================================== */
function woovinaWooGridList() {
	"use strict"

	if($j('body').hasClass('has-grid-list')) {

		$j('#woovina-grid').on('click', function() {
			$j(this).addClass('active');
			$j('#woovina-list').removeClass('active');
			Cookies.set('gridcookie', 'grid', { path: '' });
			$j('.archive.woocommerce ul.products').fadeOut(300, function() {
				$j(this).addClass('grid').removeClass('list').fadeIn(300);
			});
			return false;
		});

		$j('#woovina-list').on('click', function() {
			$j(this).addClass('active');
			$j('#woovina-grid').removeClass('active');
			Cookies.set('gridcookie', 'list', { path: '' });
			$j('.archive.woocommerce ul.products').fadeOut(300, function() {
				$j(this).addClass('list').removeClass('grid').fadeIn(300);
			});
			return false;
		});

		if(Cookies.get('gridcookie') == 'grid') {
	        $j('.woovina-grid-list #woovina-grid').addClass('active');
	        $j('.woovina-grid-list #woovina-list').removeClass('active');
	        $j('.archive.woocommerce ul.products').addClass('grid').removeClass('list');
	    }

	    if(Cookies.get('gridcookie') == 'list') {
	        $j('.woovina-grid-list #woovina-list').addClass('active');
	        $j('.woovina-grid-list #woovina-grid').removeClass('active');
	        $j('.archive.woocommerce ul.products').addClass('list').removeClass('grid');
	    }

	} else {

		Cookies.remove('gridcookie', { path: '' });

	}

}