(function($) {
    var WidgetwewOffCanvassHandler = function($scope, $) {

        var $btn = $scope.find('.wew-off-canvas-button a');

        // Move the off canvas sidebar to the footer
        $('.wew-off-canvas-wrap').appendTo('body');

        $($btn).on('click', function(e) {
            e.preventDefault();
            var $target = $(this).attr('href');

            // Open the off canvas sidebar
            $($target).toggleClass('show');
        });

        $('.wew-off-canvas-close, .wew-off-canvas-overlay').on('click', function() {
            $(this).closest('.wew-off-canvas-wrap').removeClass('show');
        });

    };
    
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/wew-off-canvas.default', WidgetwewOffCanvassHandler);
    });
})(jQuery);