(function($) {
    var WidgetwewModalHandler = function($scope, $) {

        var $btn    = $scope.find('.wew-modal-button a');

        // Move the modal to the footer
        $('.wew-modal-wrap').appendTo('body');

        $($btn).on('click', function(e) {
            e.preventDefault();
            var $target = $(this).attr('href');

            var innerWidth = $('html').innerWidth();
            $('html').css('overflow', 'hidden');
            var hiddenInnerWidth = $('html').innerWidth();
            $('html').css('margin-right', hiddenInnerWidth - innerWidth);

            // Open the modal
            $($target).fadeIn(500);
        });

        $('.wew-modal-close, .wew-modal-overlay').on('click', function() {
            $('html').css({
                'overflow': '',
                'margin-right': '' 
            });

            // Close the modal
            $(this).closest('.wew-modal-wrap').fadeOut(500);
        });

    };
    
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/wew-modal.default', WidgetwewModalHandler);
    });
})(jQuery);