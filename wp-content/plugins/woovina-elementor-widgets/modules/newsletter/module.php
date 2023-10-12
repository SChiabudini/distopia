<?php
namespace wvnElementor\Modules\Newsletter;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Newsletter',
		];
	}

	public function get_name() {
		return 'wew-newsletter';
	}
}
