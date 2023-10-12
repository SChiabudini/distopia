wp.customize.controlConstructor['woovina-dropdown-pages'] = wp.customize.Control.extend({

	ready: function() {

		'use strict';

		var control = this;

		control.container.on('change', 'select', function() {
			control.setting.set(jQuery(this).val());
		});

	}

});