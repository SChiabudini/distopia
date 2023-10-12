(function($) {
	var WidgetwewAccordionHandler = function($scope, $) {

		var $accordion 	= $scope.find('.wew-accordion'),
			$data 		= $accordion.data('settings');

		if($accordion.hasClass('wew-has-active-item')) {
			$accordion.find('.wew-accordion-item:nth-child('+ $data['active_item'] +')').addClass('wew-active').find('.wew-accordion-content').slideDown(200);
		}

	    $accordion.find('.wew-accordion-title').on('click', function() {
			var $this 	= $(this),
				$parent =  $this.parent(),
				$next 	=  $this.next();
			
		    if('true' == $data['multiple']) {
		    	$parent.toggleClass('wew-active').find('.wew-accordion-content').slideToggle(200);
			} else {
		    	if($parent.hasClass('wew-active')) {
		    		$parent.removeClass('wew-active')
		    		$next.slideUp(200);
		    	} else {
			        $parent.parent().find('.wew-accordion-item').removeClass('wew-active');
			        $parent.parent().find('.wew-accordion-content').slideUp(200);

		    		$parent.toggleClass('wew-active');
		    		$next.slideToggle(200);
		    	}
			}

		});
	};
	
	// Make sure we run this code under Elementor
	$(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/wew-accordion.default', WidgetwewAccordionHandler);
	});
})(jQuery);