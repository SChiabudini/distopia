(function($) {
	var WidgetwewAlertMessageHandler = function($scope, $) {
		$scope.find('.wew-alert-close-btn').click(function() {

	        $(this).parents('div[class^="wew-alert"]').fadeOut(500);

	    });
	};
	
	// Make sure we run this code under Elementor
	$(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/wew-alert.default', WidgetwewAlertMessageHandler);
	});
})(jQuery);