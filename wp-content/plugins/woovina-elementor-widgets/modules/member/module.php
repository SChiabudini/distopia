<?php
namespace wvnElementor\Modules\Member;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Member',
		];
	}

	public function get_name() {
		return 'wew-member';
	}
}
