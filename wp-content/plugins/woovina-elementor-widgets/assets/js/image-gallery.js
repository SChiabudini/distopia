(function($) {

	var WidgetwewImageGalleryHandler = function($scope, $) {

        $scope.find('.wew-image-gallery').magnificPopup({
	        delegate: 'a.wew-gallery-item-inner',
	        type: 'image',
	        mainClass: 'mfp-fade',
	        gallery: {
	            enabled: true,
	        },
	    });

	    // Make sure scripts are loaded
        if($('body').hasClass('no-isotope') || undefined == $.fn.imagesLoaded || undefined == $.fn.isotope) {
            return;
        }

        var $wrap = $scope.find('.wew-image-gallery.wew-masonry');
        
        if(! $('body').hasClass('no-isotope')
        	|| undefined != $.fn.imagesLoaded
        	|| undefined != $.fn.isotope
        	|| $wrap.length != 0) {

	        $wrap.each(function() {

	            // Run only once images have been loaded
	            $wrap.imagesLoaded(function() {

	                // Create the isotope layout
	                $wrap.isotope({
	                    itemSelector       : '.isotope-entry',
	                    transformsEnabled  : true,
	                    isOriginLeft       : woovinaLocalize.isRTL ? false : true,
	                    transitionDuration : '0.0',
	                    layoutMode         : 'masonry'
	                });

	            });

	        });

        }

	};
	
	// Make sure we run this code under Elementor
	$(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/wew-image-gallery.default', WidgetwewImageGalleryHandler);
	});
})(jQuery);