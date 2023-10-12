<?php
namespace wvnElementor\Modules\GravityForms;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Gravity_Forms',
		];
	}

	public function get_name() {
		return 'wew-gravity-forms';
	}
}
