<?php
namespace wvnElementor\Modules\LinkEffects;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Link_Effects',
		];
	}

	public function get_name() {
		return 'wew-link-effects';
	}
}
