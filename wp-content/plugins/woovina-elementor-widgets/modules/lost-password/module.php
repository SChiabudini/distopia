<?php
namespace wvnElementor\Modules\LostPassword;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'LostPassword',
		];
	}

	public function get_name() {
		return 'wew-lost-password';
	}
}
