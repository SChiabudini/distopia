(function($) {
	var WidgetwewScrollUpHandler = function($scope, $) {

		var $btn = $scope.find('.wew-scroll-button a');

		$($btn).on('click', function(e){
			e.preventDefault();
			$('html, body').animate({ scrollTop: 0 }, 400);
			$(this).parent().removeClass('sfHover');
		});

	};
	
	// Make sure we run this code under Elementor
	$(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/wew-scroll-up.default', WidgetwewScrollUpHandler);
	});
})(jQuery);