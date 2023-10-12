<?php
namespace wvnElementor\Modules\BlogGrid;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Blog_Grid',
		];
	}

	public function get_name() {
		return 'wew-blog-grid';
	}
}
