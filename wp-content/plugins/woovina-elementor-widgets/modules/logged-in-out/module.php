<?php
namespace wvnElementor\Modules\LoggedInOut;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Logged_In_Out',
		];
	}

	public function get_name() {
		return 'wew-logged-in-out';
	}
}
