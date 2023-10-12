<?php
namespace wvnElementor\Modules\SearchPro;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_name() {
		return 'wew-search-pro';
	}

	public function get_widgets() {
		$widgets = [
			'Search_Pro',
		];

		return $widgets;
	}
}