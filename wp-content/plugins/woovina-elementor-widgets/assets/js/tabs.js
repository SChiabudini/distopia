(function($) {
	var WidgetwewTabsHandler = function($scope, $) {

		var $tabs 	= $scope.find('.wew-tabs'),
			$data 	= $tabs.data('settings');

		if($tabs.hasClass('wew-has-active-item')) {
			$tabs.find('.wew-tab-title[data-tab="'+ $data['active_item'] +'"]').addClass('wew-active');
			$tabs.find('#wew-tab-content-'+ $data['active_item']).addClass('wew-active');
		} else {
			$tabs.find('.wew-tab-title[data-tab="1"]').addClass('wew-active');
			$tabs.find('#wew-tab-content-1').addClass('wew-active');
		}

	    $tabs.find('.wew-tab-title').on('click', function() {
			var $this 	= $(this),
				$tab_id = $this.data('tab');

			// Remove the active classes
			$scope.find('.wew-tab-title').removeClass('wew-active');
			$scope.find('.wew-tab-content').removeClass('wew-active');

			// Add the class in the normal and mobile title
			$scope.find('.wew-tab-title[data-tab="'+ $tab_id + '"]').addClass('wew-active');
			
			// Display the content
		    $scope.find('.wew-tab-title[data-tab="'+ $tab_id + '"]').next('.wew-tab-content').addClass('wew-active');
		});
	};
	
	// Make sure we run this code under Elementor
	$(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/wew-tabs.default', WidgetwewTabsHandler);
	});
})(jQuery);