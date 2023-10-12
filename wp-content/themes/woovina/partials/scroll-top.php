<?php
/**
 * The template for displaying the scroll top button.
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// If no scroll top button
if(! woovina_display_scroll_up_button()) {
	return;
}

// Get arrow
$arrow = apply_filters('woovina_scroll_top_arrow', get_theme_mod('woovina_scroll_top_arrow'));
$arrow = $arrow ? $arrow : 'fa fa-angle-up'; ?>

<a id="scroll-top" class="<?php echo has_nav_menu('mobile_navbar') ? 'has-mobile-navbar' : 'no-navbar'; ?>" href="#"><span class="<?php echo esc_attr($arrow); ?>"></span></a>