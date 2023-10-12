<?php
/**
 * Header content.
 *
 * @package WooVina WordPress theme
 */

// Vars
$header_style = woovina_header_style();
$position = get_theme_mod('woovina_mobile_elements_positioning', 'one');
$woo_icon_visibility = get_theme_mod('woovina_woo_menu_icon_visibility', 'default');

if(WOOVINA_WOOCOMMERCE_ACTIVE
	&& 'disabled' != $woo_icon_visibility
	&& 'two' == $position) {
	add_action('woovina_header_inner_left_content', 'woovina_mobile_cart_icon', 1);
}

if('three' == $position) {
	add_action('woovina_header_inner_left_content', 'woovina_mobile_icon', 1);
}

if('full_screen' == $header_style
	|| 'center' == $header_style) {
	add_action('woovina_header_inner_left_content', 'woovina_header_logo', 10);
}

add_action('woovina_header_inner_middle_content', 'woovina_header_logo', 10);

if(true == get_theme_mod('woovina_menu_social', false)) {
	add_action('woovina_header_inner_middle_content', 'woovina_header_social', 11);
}

add_action('woovina_header_inner_middle_content', 'woovina_header_navigation', 12);

if('three' != $position) {
	add_action('woovina_header_inner_right_content', 'woovina_mobile_icon', 99);
}

if(WOOVINA_WOOCOMMERCE_ACTIVE
	&& 'disabled' != $woo_icon_visibility
	&& 'three' == $position) {
	add_action('woovina_header_inner_right_content', 'woovina_mobile_cart_icon', 99);
}

if(WOOVINA_WOOCOMMERCE_ACTIVE) {
	add_action('woovina_before_mobile_icon_inner', 'woovina_mobile_cart_icon_medium_header', 10);
}

if(WOOVINA_WOOCOMMERCE_ACTIVE
	&& 'disabled' != get_theme_mod('woovina_woo_menu_icon_visibility', 'default')
	&& 'one' == get_theme_mod('woovina_mobile_elements_positioning', 'one')) {
	add_action('woovina_before_mobile_icon_inner', 'woovina_mobile_cart_icon_not_medium_header', 10);
}

/**
 * Mobile cart icon
 *
 * @since 1.5.6
 */
if(! function_exists('woovina_mobile_cart_icon')) {

	function woovina_mobile_cart_icon() {

		// If bag style
		$bag = get_theme_mod('woovina_woo_menu_bag_style', 'no');

		// Classes
		$classes = array('woovina-mobile-menu-icon', 'clr', 'woo-menu-icon');

		// Position
		$position = get_theme_mod('woovina_mobile_elements_positioning', 'one');
		if('two' == $position) {
			$classes[] = 'mobile-left';
		} else if('three' == $position) {
			$classes[] = 'mobile-right';
		}

		// Turn classes into space seperated string
		$classes = implode(' ', $classes);

		echo '<div class="'. $classes .'">';
			if('yes' == $bag) {
				echo '<div class="bag-style">';
			}
			echo woovina_wcmenucart_menu_item();
			if('yes' == $bag) {
				echo '</div>';
			}
		echo '</div>';

	}

}

/**
 * Header logo
 *
 * @since 1.5.6
 */
if(! function_exists('woovina_header_logo')) {

	function woovina_header_logo() {

		get_template_part('partials/header/logo');

	}

}

/**
 * Header social
 *
 * @since 1.5.6
 */
if(! function_exists('woovina_header_social')) {

	function woovina_header_social() {

		get_template_part('partials/header/social');

	}

}

/**
 * Header navigation
 *
 * @since 1.5.6
 */
if(! function_exists('woovina_header_navigation')) {

	function woovina_header_navigation() {

		get_template_part('partials/header/nav');

	}

}

/**
 * Header navigation
 *
 * @since 1.5.6
 */
if(! function_exists('woovina_mobile_icon')) {

	function woovina_mobile_icon() {

		get_template_part('partials/mobile/mobile-icon');

	}

}

/**
 * Mobile cart icon for the Medium header style
 *
 * @since 1.5.6
 */
if(! function_exists('woovina_mobile_cart_icon_medium_header')) {

	function woovina_mobile_cart_icon_medium_header() {
		$header_style = woovina_header_style();

		// Return if it is not medium or vertical header styles
		if('medium' != $header_style
			&& 'vertical' != $header_style) {
			return;
		}

		echo woovina_wcmenucart_menu_item();

	}

}

/**
 * Mobile cart icon if it is not the Medium header style
 *
 * @since 1.5.6
 */
if(! function_exists('woovina_mobile_cart_icon_not_medium_header')) {

	function woovina_mobile_cart_icon_not_medium_header() {
		$header_style = woovina_header_style();

		// Return if medium or vertical header styles
		if('medium' == $header_style
			|| 'vertical' == $header_style) {
			return;
		}

		echo woovina_wcmenucart_menu_item();

	}

}