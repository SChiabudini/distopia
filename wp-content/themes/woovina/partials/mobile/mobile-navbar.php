<?php
/**
 * Mobile navbar template part.
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Menu Location
$menu_location = apply_filters('woovina_mobile_menu_location', 'mobile_navbar');

// Menu arguments
$menu_args = array(
	'theme_location' => $menu_location,
	'container'      => false,
	'fallback_cb'    => false,
);

// Display menu if defined
if(has_nav_menu($menu_location)) : ?>

	<div id="mobile-navbar" class="navigation active hide_on_footer navbar-bottom hide_on_standard hide_on_desktop hide_on_tablet clr">

		<?php
		// Display menu
		wp_nav_menu($menu_args); ?>

	</div>

<?php endif; ?>