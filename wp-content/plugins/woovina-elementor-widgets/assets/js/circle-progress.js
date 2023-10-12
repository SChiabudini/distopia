(function($) {
    var WidgetwewCircleProgressHandler = function($scope, $) {

        var $circle = $scope.find('.wew-circle-progress');

        $circle.appear(function() {

            $($circle).asPieProgress({
                namespace       : 'pieProgress',
                classes         : {
                    svg     : 'wew-circle-progress-svg',
                    number  : 'wew-circle-progress-number',
                    content : 'wew-circle-progress-content'
                }
            });

            $($circle).asPieProgress('start');

        });

    };
    
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/wew-circle-progress.default', WidgetwewCircleProgressHandler);
    });
})(jQuery);