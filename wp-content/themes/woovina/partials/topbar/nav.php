<?php
/**
 * Topbar menu displays inside the topbar "content" area
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
} ?>

<div id="top-bar-nav" class="navigation clr">

	<?php
	// Menu Location
	$menu_location = apply_filters('woovina_topbar_menu_location', 'topbar_menu');
	
	if(has_nav_menu($menu_location) || $ms_global_menu) : 

		// Display menu
		wp_nav_menu(array(
			'theme_location' => $menu_location,
			'fallback_cb'    => false,
			'container'      => false,
			'menu_class'     => 'top-bar-menu dropdown-menu sf-menu',
			'walker'         => new WooVina_Custom_Nav_Walker(),
		));

	endif; ?>

</div>