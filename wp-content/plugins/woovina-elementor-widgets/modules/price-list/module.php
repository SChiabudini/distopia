<?php
namespace wvnElementor\Modules\PriceList;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Price_List',
		];
	}

	public function get_name() {
		return 'wew-price-list';
	}
}
