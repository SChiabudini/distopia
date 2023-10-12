(function($) {
    var WidgetwewNavBarHandler = function($scope, $) {

        var $wrap = $scope.find('.wew-navbar-wrap'),
            $btn = $scope.find('.wew-off-canvas-button');

        if($wrap.hasClass('wew-has-off-canvas')) {

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

        }

        if($wrap.hasClass('wew-is-responsive')) {

            $('.wew-mobile-button').on('click', function(e) {
                e.preventDefault();

                $j('.wew-navbar-wrap.wew-is-responsive ul.wew-navbar').slideToggle(500);
                $j(this).toggleClass('opened');
            });

        }

    };
    
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/wew-navbar.default', WidgetwewNavBarHandler);
    });
})(jQuery);