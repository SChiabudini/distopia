<?php
namespace wvnElementor\Modules\ContactForm;

use wvnElementor\Base\Module_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Contact_Form',
		];
	}

	public function get_name() {
		return 'wew-contact-form-7';
	}
}
