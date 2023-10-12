(function($) {

    var WidgetwewMemberHandler = function($scope, $) {

        var $wrap = $scope.find('.wew-member-wrap');

        if(! $scope.find('.wew-member-icon').hasClass('wew-member-tooltip')) {
            return;
        }

        $scope.find('.wew-tooltip-n').powerTip({ placement: 'n', popupClass: 'wew-member-powertip', fadeInTime: 200, fadeOutTime: 100 });
        $scope.find('.wew-tooltip-s').powerTip({ placement: 's', popupClass: 'wew-member-powertip', fadeInTime: 200, fadeOutTime: 100 });

    };
    
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/wew-member.default', WidgetwewMemberHandler);
    });
})(jQuery);