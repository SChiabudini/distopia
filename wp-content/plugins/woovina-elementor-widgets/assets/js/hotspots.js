(function($) {

    var getElementSettings = function($element) {
        var elementSettings = {},
            modelCID        = $element.data('model-cid');

        if(elementorFrontend.isEditMode() && modelCID) {
            var settings        = elementorFrontend.config.elements.data[ modelCID ],
                settingsKeys    = elementorFrontend.config.elements.keys[ settings.attributes.widgetType || settings.attributes.elType ];

            jQuery.each(settings.getActiveControls(), function(controlKey) {
                if(-1 !== settingsKeys.indexOf(controlKey)) {
                    elementSettings[ controlKey ] = settings.attributes[ controlKey ];
                }
            });
        } else {
            elementSettings = $element.data('settings') || {};
        }

        return elementSettings;
    };

    var WidgetwewHotspotsHandler = function($scope, $) {

        var $wrap = $scope.find('.wew-hotspot-inner');

        if(! $wrap.hasClass('wew-hotspot-tooltip')) {
            return;
        }

        var elementSettings = getElementSettings($scope),
            fadeIn          = elementSettings.fade_in_time.size,
            fadeOut         = elementSettings.fade_out_time.size;

        $scope.find('.wew-tooltip-n').powerTip({ placement: 'n', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-e').powerTip({ placement: 'e', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-s').powerTip({ placement: 's', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-w').powerTip({ placement: 'w', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-nw').powerTip({ placement: 'nw', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-ne').powerTip({ placement: 'ne', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-sw').powerTip({ placement: 'sw', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-se').powerTip({ placement: 'se', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-nw-alt').powerTip({ placement: 'nw-alt', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-ne-alt').powerTip({ placement: 'ne-alt', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-sw-alt').powerTip({ placement: 'sw-alt', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });
        $scope.find('.wew-tooltip-se-alt').powerTip({ placement: 'se-alt', popupClass: 'wew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut });

    };
    
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/wew-hotspots.default', WidgetwewHotspotsHandler);
    });
})(jQuery);