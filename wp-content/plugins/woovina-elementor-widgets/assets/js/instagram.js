(function($) {
    var WidgetwewInstagramHandler = function($scope, $) {

        var $wrap = $scope.find('.wew-instagram-item');
        if($wrap.length === 0) {
            return;
        }

        var wewFitImage = function($this) {
            var $imageParent = $this.find('.wew-instagram-image'),
                $image       = $imageParent.find('img'),
                image        = $image[0];

            if(! image) {
                return;
            }

            var imageParentRatio = $imageParent.outerHeight() / $imageParent.outerWidth(),
                imageRatio       = image.naturalHeight / image.naturalWidth;

            $imageParent.toggleClass('wew-fit-height', imageRatio < imageParentRatio);
        };

        $wrap.each(function() {
            var $this   = $(this),
                $image  = $this.find('.wew-instagram-image img');

            wewFitImage($this);

            $image.on('load', function() {
                wewFitImage($this);
            });
        });

    };
    
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/wew-instagram.default', WidgetwewInstagramHandler);
    });
})(jQuery);