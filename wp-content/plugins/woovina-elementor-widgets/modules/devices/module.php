<?php
namespace wvnElementor\Modules\Devices;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Devices',
		];
	}

	public function get_name() {
		return 'wew-devices';
	}
}
