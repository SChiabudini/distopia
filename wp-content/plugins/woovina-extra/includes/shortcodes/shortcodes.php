<?php
/**
 * All shortcodes
 */

/**
 * Logo shortcode for the Custom Header style
 *
 * @since 1.1.1
 */
if(! function_exists('woovina_logo_shortcode')) {

	function woovina_logo_shortcode($atts) {

		// Extract attributes
		extract(shortcode_atts(array(
			'position' 		=> 'left',
		), $atts));

		// Add classes
		$classes 		= array('custom-header-logo', 'clr');
		$classes[] 		= $position;
		$classes 		= implode(' ', $classes); ?>

		<div class="<?php echo esc_attr($classes); ?>">
			<?php get_template_part('partials/header/logo'); ?>
		</div>

	<?php
	}

}
add_shortcode('woovina_logo', 'woovina_logo_shortcode');

/**
 * Nav menu shortcode for the Custom Header style
 *
 * @since 1.1.1
 */
if(! function_exists('woovina_nav_shortcode')) {

	function woovina_nav_shortcode($atts) {

		// Extract attributes
		extract(shortcode_atts(array(
			'position' 		=> 'left',
		), $atts));

		// Add classes
		$classes 		= array('custom-header-nav', 'clr');
		$classes[] 		= $position;
		$classes 		= implode(' ', $classes); ?>

		<div class="<?php echo esc_attr($classes); ?>">
			<?php
			// Navigation
			get_template_part('partials/header/nav');

			// Mobile nav
			get_template_part('partials/header/mobile-icon'); ?>
		</div>

	<?php
	}

}
add_shortcode('woovina_nav', 'woovina_nav_shortcode');

/**
 * Dynamic date shortcode
 *
 * @since 1.1.1
 */
if(! function_exists('woovina_date_shortcode')) {

	function woovina_date_shortcode($atts) {

		// Extract attributes
		extract(shortcode_atts(array(
			'year' => '',
		), $atts));

		// Var
		$date = '';

		if('' != $year) {
			$date .= $year . ' - ';
		}

		$date .= date('Y');

		return esc_attr($date);
			
	}

}
add_shortcode('woovina_date', 'woovina_date_shortcode');

/**
 * Search form shortcode
 *
 * @since 1.1.9
 */
if(! function_exists('woovina_search_shortcode')) {

	function woovina_search_shortcode($atts) {

		// Extract attributes
		extract(shortcode_atts(array(
			'width' 		=> '',
			'height' 		=> '',
			'placeholder' 	=> esc_html__('Search', 'woovina-extra'),
			'btn_icon' 		=> 'icon-magnifier',
		), $atts));

		// Styles
		$style = array();
		if(! empty($width)) {
			$style[] = 'width: '. intval($width) .'px;';
		}
		if(! empty($height)) {
			$style[] = 'height: '. intval($height) .'px;min-height: '. intval($height) .'px;';
		}
		$style = implode('', $style);

		if($style) {
			$style = wp_kses($style, array());
			$style = ' style="' . esc_attr($style) . '"';
		}

		$html = '<form method="get" class="woovina-searchform" id="searchform" action="'. esc_url(home_url('/')) .'"'. $style .'>';
			$html .= '<input type="text" class="field" name="s" id="s" placeholder="'. strip_tags($placeholder) .'">';
			$html .= '<button type="submit" class="search-submit" value=""><i class="'. esc_attr($btn_icon) .'"></i></button>';
		$html .= '</form>';

		// Return
		return $html;

	}

}
add_shortcode('woovina_search', 'woovina_search_shortcode');

/**
 * Site url shortcode
 *
 * @since 1.1.9
 */
if(! function_exists('woovina_site_url_shortcode')) {

	function woovina_site_url_shortcode($atts) {

		// Extract attributes
		extract(shortcode_atts(array(
			'target' => 'self',
		), $atts));

		$html = '<a href="'. esc_url(home_url('/')) .'" target="_'. esc_attr($target) .'">'. esc_html(get_bloginfo('name')) .'</a>';

		// Return
		return $html;
			
	}

}
add_shortcode('woovina_site_url', 'woovina_site_url_shortcode');

/**
 * Login/logout link
 *
 * @since 1.1.9
 */
if(! function_exists('woovina_login_shortcode')) {

	function woovina_login_shortcode($atts) {

		extract(shortcode_atts(array(
			'custom_url' 		=> '',
			'login_text' 		=> esc_html__('Login', 'woovina-extra'),
			'logout_text' 		=> esc_html__('Log Out', 'woovina-extra'),
			'target' 			=> 'self',
			'logout_redirect' 	=> '',
		), $atts));

		// Custom login url
		if(! empty($custom_url)) {
			$login_url = $custom_url;
		} else {
			$login_url = wp_login_url();
		}

		// Logout redirect
		if(! empty($logout_redirect)) {
			$current = get_permalink();
			if('current' == $logout_redirect
				&& $current) {
				$logout_redirect = $current;
			} else {
				$logout_redirect = $logout_redirect;
			}
		} else {
			$logout_redirect = home_url('/');
		}

		// Logged in link
		if(is_user_logged_in()) {
			return '<a href="'. wp_logout_url($logout_redirect) .'" title="'. esc_attr($logout_text) .'" class="woovina-logout">'. strip_tags($logout_text) .'</a>';
		}

		// Logged out link
		else {
			return '<a href="'. esc_url($login_url) .'" title="'. esc_attr($login_text) .'" class="woovina-login" target="_'. esc_attr($target) .'">'. strip_tags($login_text) .'</a>';
		}

	}

}
add_shortcode('woovina_login', 'woovina_login_shortcode');

/**
 * Login/logout link
 *
 * @since 1.2.1
 */
if(! function_exists('woovina_current_user_shortcode')) {

	function woovina_current_user_shortcode($atts) {

		extract(shortcode_atts(array(
			'text' 			=> esc_html__('Welcome back', 'woovina-extra'),
			'display' 		=> 'display_name',
		), $atts));

		// Get current user
		$current_user = wp_get_current_user();

		// Text
		if(! empty($text)) {
			$text = $text . ' ';
		}

	    // If logged in
		if(is_user_logged_in()) {
			return $text . $current_user->$display;
		}

		// Return if not logged in
		else {
			return;
		}

	}

}
add_shortcode('woovina_current_user', 'woovina_current_user_shortcode');

/**
 * WooCommerce fragments
 *
 * @since 1.2.2
 */
if(! function_exists('woovina_woo_fragments')) {

	function woovina_woo_fragments($fragments) {
		$text = woovina_tm_translation('wvn_popup_bottom_text', get_theme_mod('wvn_popup_bottom_text', '[woovina_woo_free_shipping_left]'));
		$fragments['.wcmenucart-shortcode .wcmenucart-total'] = '<span class="wcmenucart-total">'. WC()->cart->get_cart_total() .'</span>';
		$fragments['.wcmenucart-shortcode .wcmenucart-count'] = '<span class="wcmenucart-count">'. WC()->cart->get_cart_contents_count() .'</span>';
		$fragments['.woovina-woo-total'] 			= '<span class="woovina-woo-total">' . WC()->cart->get_cart_total() . '</span>';
	    $fragments['.woovina-woo-cart-count'] 		= '<span class="woovina-woo-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
	    $fragments['.woovina-woo-free-shipping'] 	= '<span class="woovina-woo-free-shipping">' . do_shortcode($text) . '</span>';
	    return $fragments;
	}

}
add_filter('woocommerce_add_to_cart_fragments', 'woovina_woo_fragments', 10, 1);

/**
 * WooCommerce cart icon
 *
 * @since 1.4.4
 */
if(! function_exists('woovina_woo_cart_icon_shortcode')) {

	function woovina_woo_cart_icon_shortcode($atts) {

		// Return if WooCommerce is not enabled or if admin to avoid error
		if(! class_exists('WooCommerce') || is_admin()) {
			return;
		}

		// Return if is in the Elementor edit mode, to avoid error
		if(class_exists('Elementor\Plugin')
			&& \Elementor\Plugin::$instance->editor->is_edit_mode()) {
			return;
		}

		extract(shortcode_atts(array(
			'class' 			=> '',
			'style' 			=> 'drop_down',
			'custom_link' 		=> '',
			'total' 			=> false,
			'cart_style' 		=> 'compact',
			'hide_if_empty' 	=> false,
			'color' 			=> '',
			'hover_color' 		=> '',
			'count_color' 		=> '',
			'count_hover_color' => '',
		), $atts));

		// Return items if "hide if empty cart" is checked (for mobile)
		if(true == $hide_if_empty
			&& ! WC()->cart->cart_contents_count > 0) {
			return;
		}

		// Toggle class
		$toggle_class = 'toggle-cart-widget';

		// Define classes to add to li element
		$classes = array('woo-menu-icon', 'bag-style', 'woo-cart-shortcode');

		// Add style class
		$classes[] = 'wcmenucart-toggle-'. $style;

		// Cart style
		if('compact' != $cart_style) {
			$classes[] = $cart_style;
		}

		// Prevent clicking on cart and checkout
		if('custom_link' != $style && (is_cart() || is_checkout())) {
			$classes[] = 'nav-no-click';
		}

		// Add toggle class
		else {
			$classes[] = $toggle_class;
		}

		// If custom class
		if(! empty($class)) {
			$classes[] = $class;
		}

		// Turn classes into string
		$classes = implode(' ', $classes);

		// URL
		if('custom_link' == $style && $custom_link) {
			$url = esc_url($custom_link);
		} else {
			$cart_id = wc_get_page_id('cart');
			if(function_exists('icl_object_id')) {
				$cart_id = icl_object_id($cart_id, 'page');
			}
			$url = get_permalink($cart_id);
		}

		// Style
		if(! empty($color)
			|| ! empty($hover_color)
			|| ! empty($count_color)
			|| ! empty($count_hover_color)) {

			// Vars
			$css = '';
			$output = '';

			if(! empty($color)) {
				$css .= '.woo-cart-shortcode .wcmenucart-cart-icon .wcmenucart-count {color:'. $color .'; border-color:'. $color .';}';
				$css .= '.woo-cart-shortcode .wcmenucart-cart-icon .wcmenucart-count:after {border-color:'. $color .';}';
			}

			if(! empty($hover_color)) {
				$css .= '.woo-cart-shortcode.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count, .show-cart .wcmenucart-cart-icon .wcmenucart-count {background-color: '. $hover_color .'; border-color:'. $hover_color .';}';
				$css .= '.woo-cart-shortcode.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count:after, .show-cart .wcmenucart-cart-icon .wcmenucart-count:after {border-color:'. $hover_color .';}';
			}

			if(! empty($count_color)) {
				$css .= '.woo-cart-shortcode .wcmenucart-cart-icon .wcmenucart-count {color:'. $count_color .';}';
			}

			if(! empty($count_hover_color)) {
				$css .= '.woo-cart-shortcode.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count, .show-cart .wcmenucart-cart-icon .wcmenucart-count {color:'. $count_hover_color .';}';
			}

			// Add style
			if(! empty($css)) {
				echo "<style type=\"text/css\">\n" . wp_strip_all_tags(woovina_minify_css($css)) . "\n</style>";
			}

		}

		ob_start(); ?>

	    <div class="<?php echo esc_attr($classes); ?>">
			<a href="<?php echo esc_url($url); ?>" class="wcmenucart-shortcode">
				<?php
				if(true == $total) { ?>
					<span class="wcmenucart-total"><?php WC()->cart->get_cart_total(); ?></span>
				<?php } ?>
				<span class="wcmenucart-cart-icon">
					<span class="wcmenucart-count"><?php WC()->cart->get_cart_contents_count(); ?></span>
				</span>
			</a>
			<?php
			if('drop_down' == $style
				&& ! is_cart()
				&& ! is_checkout()) { ?>
				<div class="current-shop-items-dropdown wvn-mini-cart clr">
					<div class="current-shop-items-inner clr">
						<?php the_widget('WC_Widget_Cart', 'title='); ?>
					</div>
				</div>
			<?php } ?>
		</div>

		<?php
		return ob_get_clean();

	}

}
add_shortcode('woovina_woo_cart', 'woovina_woo_cart_icon_shortcode');

/**
 * WooCommerce total cart
 *
 * @since 1.2.2
 */
if(! function_exists('woovina_woo_total_cart_shortcode')) {

	function woovina_woo_total_cart_shortcode() {

		// Return if WooCommerce is not enabled
		if(! class_exists('WooCommerce') || is_admin()) {
			return;
		}

		// Return if is in the Elementor edit mode, to avoid error
		if(class_exists('Elementor\Plugin')
			&& \Elementor\Plugin::$instance->editor->is_edit_mode()) {
			return;
		}

		$html  = '<span class="woovina-woo-total">';
	    $html .= WC()->cart->get_cart_total();
	    $html .= '</span>';
			
		return $html;

	}

}
add_shortcode('woovina_woo_total_cart', 'woovina_woo_total_cart_shortcode');

/**
 * WooCommerce items cart
 *
 * @since 1.2.2
 */
if(! function_exists('woovina_woo_cart_items_shortcode')) {

	function woovina_woo_cart_items_shortcode() {

		// Return if WooCommerce is not enabled
		if(! class_exists('WooCommerce') || is_admin()) {
			return;
		}

		// Return if is in the Elementor edit mode, to avoid error
		if(class_exists('Elementor\Plugin')
			&& \Elementor\Plugin::$instance->editor->is_edit_mode()) {
			return;
		}

		$html  = '<span class="woovina-woo-cart-count">';
	    $html .= WC()->cart->get_cart_contents_count();
	    $html .= '</span>';
			
		return $html;

	}

}
add_shortcode('woovina_woo_cart_items', 'woovina_woo_cart_items_shortcode');

/**
 * WooCommerce free shipping left
 *
 * @since 1.2.2
 */
if(! function_exists('woovina_woo_free_shipping_left')) {

	function woovina_woo_free_shipping_left($content, $content_reached, $multiply_by = 1) {

		// Return if WooCommerce is not enabled
		if(! class_exists('WooCommerce') || is_admin()) {
			return;
		}

		// Return if is in the Elementor edit mode, to avoid error
		if(class_exists('Elementor\Plugin')
			&& \Elementor\Plugin::$instance->editor->is_edit_mode()) {
			return;
		}

		if(empty($content)) {
			$content = esc_html__('Buy for %left_to_free% more and get free shipping', 'woovina-extra');
		}

		if(empty($content_reached)) {
			$content_reached = esc_html__('You have Free delivery!', 'woovina-extra');
		}

		$min_free_shipping_amount = 0;

		$legacy_free_shipping = new WC_Shipping_Legacy_Free_Shipping();
		if('yes' === $legacy_free_shipping->enabled) {
			if(in_array($legacy_free_shipping->requires, array('min_amount', 'either', 'both'))) {
				$min_free_shipping_amount = $legacy_free_shipping->min_amount;
			}
		}
		if(0 == $min_free_shipping_amount) {
			if(function_exists('WC') && ($wc_shipping = WC()->shipping) && ($wc_cart = WC()->cart)) {
				if($wc_shipping->enabled) {
					if($packages = $wc_cart->get_shipping_packages()) {
						$shipping_methods = $wc_shipping->load_shipping_methods($packages[0]);
						foreach ($shipping_methods as $shipping_method) {
							if('yes' === $shipping_method->enabled && 0 != $shipping_method->instance_id) {
								if('WC_Shipping_Free_Shipping' === get_class($shipping_method)) {
									if(in_array($shipping_method->requires, array('min_amount', 'either', 'both'))) {
										$min_free_shipping_amount = $shipping_method->min_amount;
										break;
									}
								}
							}
						}
					}
				}
			}
		}
		
		if(0 != $min_free_shipping_amount) {
			if(isset(WC()->cart->cart_contents_total)) {
				$total = (WC()->cart->prices_include_tax) ? (WC()->cart->cart_contents_total + WC()->cart->get_cart_contents_tax()) : WC()->cart->cart_contents_total;
				if($total >= $min_free_shipping_amount) {
					return do_shortcode($content_reached);
				} else {
					$content = str_replace('%left_to_free%',             '<span class="woovina-woo-left-to-free">'. wc_price(($min_free_shipping_amount - $total) * $multiply_by) .'</span>', $content);
					$content = str_replace('%free_shipping_min_amount%', '<span class="woovina-woo-left-to-free">'. wc_price(($min_free_shipping_amount)          * $multiply_by) .'</span>', $content);
					return $content;
				}
			}
		}

	}

}

if(! function_exists('woovina_woo_free_shipping_left_shortcode')) {

	function woovina_woo_free_shipping_left_shortcode($atts, $content) {

		if(! class_exists('WooCommerce') || is_admin()) {
			return;
		}

		extract(shortcode_atts(array(
			'content' 			=> esc_html__('Buy for %left_to_free% more and get free shipping', 'woovina-extra'),
			'content_reached' 	=> esc_html__('You have Free delivery!', 'woovina-extra'),
			'multiply_by' 		=> 1,
		), $atts));

		return woovina_woo_free_shipping_left('<span class="woovina-woo-free-shipping">'. $content .'</span>', '<span class="woovina-woo-free-shipping">'. $content_reached .'</span>', $multiply_by);

	}

}
add_shortcode('woovina_woo_free_shipping_left', 'woovina_woo_free_shipping_left_shortcode');

/**
 * Breadcrumb shortcode
 *
 * @since 1.3.3
 */
if(! function_exists('woovina_breadcrumb_shortcode')) {

	function woovina_breadcrumb_shortcode($atts) {

		// Return if is in the Elementor edit mode, to avoid error
		if(class_exists('Elementor\Plugin')
			&& \Elementor\Plugin::$instance->editor->is_edit_mode()) {
			return esc_html__('This shortcode only works in front end', 'woovina-extra');
		}

		// Return if WooVina_Breadcrumb_Trail doesn't exist
		if(! class_exists('WooVina_Breadcrumb_Trail')) {
			return;
		}

		extract(shortcode_atts(array(
			'class' 		=> '',
			'color' 		=> '',
			'hover_color' 	=> '',
		), $atts));

		$args = '';

		// Add a space for the beginning of the class attr
		if(! empty($class)) {
			$class = ' ' . $class;
		}

		// Style
		if(! empty($color) || ! empty($hover_color)) {

			// Vars
			$css = '';
			$output = '';

			if(! empty($color)) {
				$css .= '.woovina-breadcrumb .site-breadcrumbs, .woovina-breadcrumb .site-breadcrumbs a {color:'. $color .';}';
			}

			if(! empty($hover_color)) {
				$css .= '.woovina-breadcrumb .site-breadcrumbs a:hover {color:'. $hover_color .';}';
			}

			// Add style
			if(! empty($css)) {
				echo "<style type=\"text/css\">\n" . wp_strip_all_tags(woovina_minify_css($css)) . "\n</style>";
			}

		}

		// Yoast breadcrumbs
		if(function_exists('yoast_breadcrumb') && current_theme_supports('yoast-seo-breadcrumbs')) {
			$classes = 'site-breadcrumbs clr';
			if($breadcrumbs_position = get_theme_mod('woovina_breadcrumbs_position')) {
				$classes .= ' position-'. $breadcrumbs_position;
			}
			return yoast_breadcrumb('<nav class="'. $classes .'">', '</nav>');
		}

		$breadcrumb = apply_filters('breadcrumb_trail_object', null, $args);

		if(! is_object($breadcrumb)) {
			$breadcrumb = new WooVina_Breadcrumb_Trail($args);
		}

		return '<span class="woovina-breadcrumb'. $class .'">'. $breadcrumb->get_trail() .'</span>';

	}

}
add_shortcode('woovina_breadcrumb', 'woovina_breadcrumb_shortcode');