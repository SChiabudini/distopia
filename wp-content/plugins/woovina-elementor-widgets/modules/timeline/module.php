<?php
namespace wvnElementor\Modules\Timeline;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Timeline',
		];
	}

	public function get_name() {
		return 'wew-timeline';
	}
}
