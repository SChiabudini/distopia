(function($) {
	var WidgetwewSkillbarHandler = function($scope, $) {
		$scope.find('.wew-skillbar').each(function() {
			$(this).appear(function() {
				$(this).find('.wew-skillbar-bar').animate({
					width: $(this).attr('data-percent')
				}, 800);
			});
		}, {
			accX : 0,
			accY : 0
		});
	};
	
	// Make sure we run this code under Elementor
	$(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/wew-skillbar.default', WidgetwewSkillbarHandler);
	});
})(jQuery);