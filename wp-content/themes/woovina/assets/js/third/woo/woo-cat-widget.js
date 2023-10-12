var $j = jQuery.noConflict();

$j(document).ready(function() {
    "use strict";
    // Woo categories widget
    woovinaWooCategoriesWidget();
});

/* ==============================================
WOOCOMMERCE CATEGORIES WIDGET
============================================== */
function woovinaWooCategoriesWidget() {
    "use strict"

    $j('.woo-dropdown-cat .product-categories, .woo-dropdown-cat .wc-block-product-categories > ul').each(function() {

        var IconDown = '<i class="fa fa-angle-down"></i>',
        	IconUp 	 = '<i class="fa fa-angle-up"></i>';
        
		$j(this).find('li').has('ul').has('li').prepend('<div class="open-this">'+ IconDown +'</div>');

        $j(this).find('.open-this').on('click', function(){
            if($j(this).parent().hasClass('opened')) {
                $j(this).html(IconDown).parent().removeClass('opened').find('> ul').slideUp(200);
            } else {
                $j(this).html(IconUp).parent().addClass('opened').find('> ul').slideDown(200);
            }
        });

    });
    
}