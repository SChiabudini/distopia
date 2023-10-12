<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package WooVina WordPress theme
 */

function woovina_tgmpa_register() {

	// Get array of recommended plugins
	$plugins = array(
		
		array(
			'name'					=> 'WooVina Extra',
			'slug'					=> 'woovina-extra',
			'source'    			=> 'https://woovina.com/free-downloads/woovina-extra.zip',
			'external_url'    		=> 'https://woovina.com/extensions/woovina-extra',
			'required'				=> true,
			'force_activation'		=> false,
			'force_deactivation'	=> false,
		),
		
		array(
			'name'					=> 'WooVina Elementor Widgets',
			'slug'					=> 'woovina-elementor-widgets',
			'source'    			=> 'https://woovina.com/free-downloads/woovina-elementor-widgets.zip',
			'external_url'    		=> 'https://woovina.com/extensions/woovina-elementor-widgets',
			'required'				=> true,
			'force_activation'		=> false,
			'force_deactivation'	=> false,
		),
		
		array(
			'name'					=> 'WooVina Custom Sidebar',
			'slug'					=> 'woovina-custom-sidebar',
			'source'    			=> 'https://woovina.com/free-downloads/woovina-custom-sidebar.zip',
			'external_url'    		=> 'https://woovina.com/extensions/woovina-custom-sidebar',
			'required'				=> true,
			'force_activation'		=> false,
			'force_deactivation'	=> false,
		),		
		
		array(
			'name'					=> 'Elementor',
			'slug'					=> 'elementor', 
			'required'				=> true,
			'force_activation'		=> false,
			'force_deactivation'	=> false,
		),
		
		array(
			'name'					=> 'WooCommerce',
			'slug'					=> 'woocommerce', 
			'required'				=> false,
			'force_activation'		=> false,
			'force_deactivation'	=> false,
		),

	);

	// Register notice
	tgmpa($plugins, array(
		'id'           => 'woovina_theme',
		'domain'       => 'woovina',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => true,
	));

}
add_action('tgmpa_register', 'woovina_tgmpa_register');