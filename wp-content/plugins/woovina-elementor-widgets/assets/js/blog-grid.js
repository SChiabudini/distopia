(function($) {
    var WidgetwewBlogGridsHandler = function($scope, $) {

        // Make sure scripts are loaded
        if($('body').hasClass('no-isotope') || undefined == $.fn.imagesLoaded || undefined == $.fn.isotope) {
            return;
        }

        var $wrap = $scope.find('.wew-blog-grid.wew-masonry');
        if($wrap.length === 0) {
            return;
        }

        $wrap.each(function() {

            // Run only once images have been loaded
            $wrap.imagesLoaded(function() {

                // Create the isotope layout
                $wrap.isotope({
                    itemSelector       : '.isotope-entry',
                    transformsEnabled  : true,
                    isOriginLeft       : woovinaLocalize.isRTL ? false : true,
                    transitionDuration : '0.0',
                    layoutMode         : 'masonry'
                });

            });

        });

    };
    
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/wew-blog-grid.default', WidgetwewBlogGridsHandler);
    });
})(jQuery);