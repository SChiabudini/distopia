(function($) {
	var WidgetwewToggleHandler = function($scope, $) {

		var $switch = $scope.find('.wew-switch-container').eq(0),
			$label 	= $switch.find('.wew-switch-label');

	    $label.toggle(
            function() {
				$(this).closest('.wew-switch-wrap').addClass('wew-switch-on');
				$(this).closest('.wew-switch-container').find('.wew-switch-secondary-wrap').addClass('show');
		    	$(this).closest('.wew-switch-container').find('.wew-switch-primary-wrap').addClass('hide');
		    	
				wewProductSlider();
            },
            function() {
				$(this).closest('.wew-switch-wrap').removeClass('wew-switch-on');
				$(this).closest('.wew-switch-container').find('.wew-switch-secondary-wrap').removeClass('show');
		    	$(this).closest('.wew-switch-container').find('.wew-switch-primary-wrap').removeClass('hide');
		    	
				wewProductSlider();
            }
       );

		// Re-run function
		var wewProductSlider = function() {
			if(! $('body').hasClass('no-carousel')
				&& $scope.find('.woo-entry-image.product-entry-slider').length) {
                setTimeout(function() {
                    $scope.find('.woo-entry-image.product-entry-slider').slick('unslick');
                    woovinaInitCarousel();
                }, 200);
            }
        }

	};
	
	// Make sure we run this code under Elementor
	$(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/wew-toggle.default', WidgetwewToggleHandler);
	});
})(jQuery);