(function($) {
    var WidgetwewGoogleMapHandler = function($scope, $) {

        var $container = $scope.find('.wew-map'),
            map,
            init,
            pins;

        if(! window.google) {
            return;
        }

        init = $container.data('init');
        pins = $container.data('pins');
        map  = new google.maps.Map($container[0], init);

        if(pins) {
            $.each(pins, function(index, pin) {

                var marker,
                    infowindow,
                    pinData = {
                        position: pin.position,
                        map: map
                    };

                if('' !== pin.image) {
                    pinData.icon = pin.image;
                }

                marker = new google.maps.Marker(pinData);

                if('' !== pin.desc) {
                    infowindow = new google.maps.InfoWindow({
                        content: pin.desc
                    });
                }

                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });

                if('visible' === pin.state && '' !== pin.desc) {
                    infowindow.open(map, marker);
                }

            });
        }

    };
    
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/wew-google-map.default', WidgetwewGoogleMapHandler);
    });
})(jQuery);