<?php
namespace wvnElementor\Modules\Slides;

use wvnElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_name() {
		return 'wew-slides';
	}

	public function get_widgets() {
		return [
			'Slides',
		];
	}
}
