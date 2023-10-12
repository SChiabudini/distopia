<?php
namespace wvnElementor\Modules\ScrollUp;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Scroll_Up',
		];
	}

	public function get_name() {
		return 'wew-scroll-up';
	}
}
