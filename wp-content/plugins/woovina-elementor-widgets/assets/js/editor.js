(function($) {
    var WidgetControlHandler = function(panel, model, view) {
        var $control        = null,
            $element        = view.$el,
            isBackSection   = -1 !== [ 'section_back', 'section_style_back' ].indexOf(model),
            $backLayer      = $element.find('.wew-flip-box-back');

        /*$element.toggleClass('wew-flip-box-flipped', isBackSection);

        if(isBackSection) {
            $backLayer.css('transition', 'none');
        }

        if(! isBackSection) {
            setTimeout(function() {
                $backLayer.css('transition', '');
            }, 10);
        }*/

        panel.$el.find('.elementor-control-section_back').on('click', function() {
            $backLayer.toggleClass('wew-flip-box-cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc');

        });

    };
    
    // Make sure we run this code under Elementor
    $(window).on('elementor:init', function() {
        elementor.hooks.addAction('panel/open_editor/widget/wew-flip-box', WidgetControlHandler);
    });
})(jQuery);