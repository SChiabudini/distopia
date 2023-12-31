<?php
/**
 * Perform all main WooCommerce configurations for this theme
 *
 * @package WooVina WordPress theme
 */

// Start and run class
if(! class_exists('WooVina_WooCommerce_Config')) {

	class WooVina_WooCommerce_Config {

		/**
		 * Main Class Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Include helper functions
			require_once(WOOVINA_INC_DIR .'woocommerce/woocommerce-helpers.php');

			// These filters/actions must run on init
			add_action('init', array($this, 'init'));

			// Pagination.
			add_action('wp', array($this, 'shop_pagination'), 999);

			// Move default WooCommerce customizer sections to the theme section
			add_action('customize_register', array($this, 'woo_section'), 11);

			// Body classes
			add_filter('body_class', array($this, 'body_class'));

			// Register Woo sidebar
			add_filter('widgets_init', array($this, 'register_woo_sidebar'));

			// Define accents
			add_filter('woovina_primary_texts', array($this, 'primary_texts'));
			add_filter('woovina_primary_borders', array($this, 'primary_borders'));
			add_filter('woovina_primary_backgrounds', array($this, 'primary_backgrounds'));
			add_filter('woovina_hover_primary_backgrounds', array($this, 'hover_primary_backgrounds'));

			/*-------------------------------------------------------------------------------*/
			/* -  Front-End only actions/filters
			/*-------------------------------------------------------------------------------*/
			if(! is_admin()) {

				// Remove default wrappers and add new ones
				remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
				remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
				add_action('woocommerce_before_main_content', array($this, 'content_wrapper'), 10);
				add_action('woocommerce_after_main_content', array($this, 'content_wrapper_end'), 10);

				// Display correct sidebar for products
				remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
				add_filter('woovina_get_sidebar', array($this, 'display_woo_sidebar'));

				// Set correct post layouts
				add_filter('woovina_post_layout_class', array($this, 'layouts'));

				// Set correct both sidebars layout style
				add_filter('woovina_both_sidebars_style', array($this, 'bs_class'));

				// Disable WooCommerce main page title
				add_filter('woocommerce_show_page_title', '__return_false');

				// Disable WooCommerce css
				add_filter('woocommerce_enqueue_styles', '__return_false');

				// Remove the category description under the page title on taxonomy
				add_filter('woovina_post_subheading', array($this, 'post_subheading'));

				// Show/hide next/prev on products
				add_filter('woovina_has_next_prev', array($this, 'next_prev'));

				// Border colors
				add_filter('woovina_border_color_elements', array($this, 'border_color_elements'));

			}

			// Main Woo Actions
			add_action('wp_enqueue_scripts', array($this, 'add_custom_scripts'));
			add_filter('woovina_localize_array', array($this, 'localize_array'));
			if(get_theme_mod('woovina_woo_shop_result_count', true)
				|| get_theme_mod('woovina_woo_shop_sort', true)
				|| get_theme_mod('woovina_woo_grid_list', true)
				|| true == get_theme_mod('woovina_woo_off_canvas_filter', false)) {
				add_action('woocommerce_before_shop_loop', array($this, 'add_shop_loop_div'));
			}
			if(true == get_theme_mod('woovina_woo_off_canvas_filter', false)) {
				add_filter('widgets_init', array($this, 'register_off_canvas_sidebar'));
				add_action('wp_footer', array($this, 'get_off_canvas_sidebar'));
				add_action('woocommerce_before_shop_loop', array($this, 'off_canvas_filter_button'), 10);
			}
			if(get_theme_mod('woovina_woo_grid_list', true)) {
				add_action('woocommerce_before_shop_loop', array($this, 'grid_list_buttons'), 10);
			}
			if(get_theme_mod('woovina_woo_shop_result_count', true)
				|| get_theme_mod('woovina_woo_shop_sort', true)
				|| get_theme_mod('woovina_woo_grid_list', true)
				|| true == get_theme_mod('woovina_woo_off_canvas_filter', false)) {
				add_action('woocommerce_before_shop_loop', array($this, 'close_shop_loop_div'), 40);
			}
			add_action('woocommerce_before_shop_loop_item', array($this, 'add_shop_loop_item_inner_div'));
			add_action('woocommerce_after_shop_loop_item', array($this, 'archive_product_content'), 10);
			add_action('woocommerce_after_shop_loop_item', array($this, 'close_shop_loop_item_inner_div'));
			add_action('woocommerce_before_subcategory_title', array($this, 'add_container_wrap_category'), 8);
			add_action('woocommerce_before_subcategory_title', array($this, 'add_div_before_category_thumbnail'), 9);
			add_action('woocommerce_before_subcategory_title', array($this, 'close_div_after_category_thumbnail'), 11);
			add_action('woocommerce_shop_loop_subcategory_title', array($this, 'add_div_before_category_title'), 9);
			add_action('woocommerce_shop_loop_subcategory_title', array($this, 'add_category_description'), 11);
			add_action('woocommerce_shop_loop_subcategory_title', array($this, 'close_div_after_category_title'), 12);
			add_action('woocommerce_shop_loop_subcategory_title', array($this, 'close_container_wrap_category'), 13);

			add_action('woocommerce_after_single_product_summary', array($this, 'clear_summary_floats'), 1);
			add_action('woocommerce_before_account_navigation', array($this, 'woovina_before_account_navigation'));
			add_action('woocommerce_after_account_navigation', array($this, 'woovina_after_account_navigation'));
			if(get_option('woocommerce_enable_myaccount_registration') !== 'yes') {
				add_action('woocommerce_before_customer_login_form', array($this, 'woovina_login_wrap_before'));
				add_action('woocommerce_after_customer_login_form', array($this, 'woovina_login_wrap_after'));
			}
			if(get_theme_mod('woovina_woo_category_image', 'no') == 'yes') {
				add_action('woocommerce_archive_description', array($this, 'woocommerce_category_image'), 2);
			}

			// Quick view
			if(get_theme_mod('woovina_woo_quick_view', true)) {
				add_action('woovina_after_product_entry_image', array($this, 'quick_view_button'));
				add_action('wp_ajax_woovina_product_quick_view', array($this, 'product_quick_view_ajax'));
				add_action('wp_ajax_nopriv_woovina_product_quick_view', array($this, 'product_quick_view_ajax'));
				add_action('wp_footer', array($this, 'quick_view_template'));
				add_action('woovina_woo_quick_view_product_image', 'woocommerce_show_product_sale_flash', 10);
				add_action('woovina_woo_quick_view_product_image', array($this, 'quick_view_image'), 20);
				add_action('woovina_woo_quick_view_product_content', array($this, 'single_product_content'), 10);
			}

			// Ajax single product add to cart
			add_action('wp_ajax_woovina_add_cart_single_product', array($this, 'add_cart_single_product_ajax'));
			add_action('wp_ajax_nopriv_woovina_add_cart_single_product', array($this, 'add_cart_single_product_ajax'));

			// Add cart overlay
			if('yes' == get_theme_mod('woovina_woo_display_cart_product_added', 'no')) {
				add_action('woovina_after_footer', array($this, 'cart_overlay'), 99);
			}

			// Add mobile menu mini cart
			if(get_theme_mod('woovina_woo_add_mobile_mini_cart', true)) {
				add_action('wp_footer', array($this, 'get_mini_cart_sidebar'));
			}

			// Remove the single product summary content to add the sortable control
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
			add_action('woocommerce_single_product_summary', array($this, 'single_product_content'), 10);

			// Add product navigation
			if(true == get_theme_mod('woovina_woocommerce_display_navigation', true)) {
				add_action('woocommerce_before_single_product_summary', array($this, 'product_next_prev_nav'), 10);
			}

			// Add floating bar
			if('on' == get_theme_mod('woovina_woo_display_floating_bar', 'off')) {
				add_action('woovina_before_main', array($this, 'floating_bar'));

				// Ajax add to cart
				add_action('wp_ajax_woovina_add_cart_floating_bar', array($this, 'add_cart_floating_bar_ajax'));
				add_action('wp_ajax_nopriv_woovina_add_cart_floating_bar', array($this, 'add_cart_floating_bar_ajax'));
			}

			// Main Woo Filters
			add_filter('wp_nav_menu_items', array($this, 'menu_compare_icon') , 10, 2);
			add_filter('wp_nav_menu_items', array($this, 'menu_wishlist_icon') , 10, 2);
			add_filter('wp_nav_menu_items', array($this, 'menu_cart_icon') , 10, 2);
			add_filter('woocommerce_add_to_cart_fragments', array($this, 'menu_cart_icon_fragments'));
			add_filter('woocommerce_general_settings', array($this, 'remove_general_settings'));
			add_filter('woocommerce_product_settings', array($this, 'remove_product_settings'));
			add_filter('loop_shop_per_page', array($this, 'loop_shop_per_page'), 20);
			add_filter('loop_shop_columns', array($this, 'loop_shop_columns'));
			add_filter('woocommerce_output_related_products_args', array($this, 'related_product_args'));
			add_filter('woocommerce_pagination_args', array($this, 'pagination_args'));
			add_filter('woocommerce_continue_shopping_redirect', array($this, 'continue_shopping_redirect'));
			add_filter('post_class', array($this, 'add_product_classes'), 40, 3);
			add_filter('product_cat_class', array($this, 'product_cat_class'));			
			
			// Sale badge content
			if('percent' == get_theme_mod('woovina_woo_sale_badge_content', 'sale')) {
				add_filter('woocommerce_sale_flash', array($this, 'sale_flash'), 10, 3);
			}

			// Add links Login/Register on the my account page
			add_action('woocommerce_before_customer_login_form', array($this, 'login_register_links'));

			// Distraction free cart/checkout
			add_filter('woovina_display_top_bar', array($this, 'distraction_free'), 11);
			add_filter('woovina_display_navigation', array($this, 'distraction_free'), 11);
			add_filter('wsh_enable_sticky_header', array($this, 'distraction_free'), 11);
			add_filter('osp_display_side_panel', array($this, 'distraction_free'), 11);
			add_filter('woovina_display_page_header', array($this, 'distraction_free'), 11);
			add_filter('woovina_display_footer_widgets', array($this, 'distraction_free'), 11);
			add_filter('woovina_display_scroll_up_button', array($this, 'distraction_free'), 11);
			add_filter('wsh_header_sticky_logo', array($this, 'distraction_free'), 11);
			add_filter('wfc_display_footer_callout', array($this, 'distraction_free'), 11);

			// Multi-step checkout
			if(true == get_theme_mod('woovina_woo_multi_step_checkout', false)) {

				// Add checkout timeline template
	            add_action('woocommerce_before_checkout_form', array($this, 'checkout_timeline'), 10);

				// Change checkout template
	            add_filter('woocommerce_locate_template', array($this, 'multistep_checkout'), 10, 3);

	            // Checkout hack
	            remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);
            	remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
	            remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);
	            remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
	            add_action('woovina_woocommerce_checkout_order_review', 'woocommerce_order_review', 20);
            	add_action('woovina_woocommerce_checkout_payment', 'woocommerce_checkout_payment', 10);
	            add_action('woovina_checkout_login_form', array($this, 'checkout_login_form'), 10);
	            add_action('woovina_woocommerce_checkout_coupon', 'woocommerce_checkout_coupon_form', 10);

	            // Prevent empty shipping tab
	            add_filter('woocommerce_enable_order_notes_field', '__return_true');

	            // Support to WooCommerce secure submit gateway
	            if(class_exists('WC_Gateway_SecureSubmit')) {
	                $secure_submit_options = get_option('woocommerce_securesubmit_settings');
	                if(! empty($secure_submit_options['use_iframes']) && 'yes' == $secure_submit_options['use_iframes']) {
	                    add_filter('option_woocommerce_securesubmit_settings', array($this, 'woocommerce_securesubmit_support'), 10, 2);
	                }
	            }

	        }

			// Add new typography settings
			add_filter('woovina_typography_settings', array($this, 'typography_settings'));

			// WooCommerce Match Box extension single product layout support.
			add_action('woocommerce_match_box_single_product_layout', array($this, 'remove_wc_match_box_single_product_summary'), 10);
			
			// Add Countdown for sale products
			if(true == get_theme_mod('woovina_woo_archives_countdown', true)) {
				add_action('woocommerce_shop_loop_item_title', array($this, 'sale_price_dates_to'));
			}
			add_action('woovina_after_single_product_price', array($this, 'sale_price_dates_to'));
			
			add_filter('woocommerce_product_tabs', array($this, 'remove_additional_information_tabs'), 98);
			add_action('woovina_after_archive_product_add_to_cart', array($this, 'show_stock_remaining'), 10);
			
			add_action('woovina_after_archive_product_title', array($this, 'dokan_sold_by'), 10);
			
			add_action('woocommerce_shop_loop_item_title', array($this, 'show_sold_count'));
			add_action('woovina_after_archive_product_title', array($this, 'display_new_badge'), 10);
			
			// Add custom compare button in header
			add_shortcode('woovina_compare_button', array($this, 'add_custom_compare_button'));
		} // End __construct

		/*-------------------------------------------------------------------------------*/
		/* -  Start Class Functions
		/*-------------------------------------------------------------------------------*/
		
		function sale_price_dates_to() {
			global $post;
			$sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);

			if($sales_price_to != "") {
				$sales_price_date_to = date("M j, Y H:i:s O", $sales_price_to);
				$labels = esc_attr__('Years,Months,Weeks,Days,Hours,Minutes,Seconds', 'woovina');
				$label1 = esc_attr__('Year,Month,Week,Day,Hour,Minute,Second', 'woovina');
				$isRTL  = is_rtl() ? "true" : "false";
				echo '<div class="jquery-countdown" data-timer="' . $sales_price_date_to . '" data-labels="' .$labels. '" data-label1="' .$label1. '" data-rtl="' .$isRTL. '"></div>';
			}			
		}
		
		/**
		 * Runs on Init.
		 * You can't remove certain actions in the constructor because it's too early.
		 *
		 * @since 1.0.0
		 */
		public function init() {

			// Remove WooCommerce breadcrumbs
			remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

			// Alter upsells display
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
			if('0' != get_theme_mod('woovina_woocommerce_upsells_count', '3')) {
				add_action('woocommerce_after_single_product_summary', array($this, 'upsell_display'), 15);
			}

			// Alter cross-sells display
			remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
			if('0' != get_theme_mod('woovina_woocommerce_cross_sells_count', '2')) {
				add_action('woocommerce_cart_collaterals', array($this, 'cross_sell_display'));
			}

			// Remove loop product sale badge
			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

			// Remove loop product thumbnail function and add our own that pulls from template parts
			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);	
			add_action('woocommerce_before_shop_loop_item_title', array($this, 'loop_product_thumbnail'), 10);

			// Remove related products if is set to no
			if('on' != get_theme_mod('woovina_woocommerce_display_related_items', 'on')) {
				remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
			}

			// Remove orderby if disabled
			if(! get_theme_mod('woovina_woo_shop_sort', true)) {
				remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
			}

			// Add result count if not disabled
			if(get_theme_mod('woovina_woo_shop_result_count', true)) {
				add_action('woocommerce_before_shop_loop', array($this, 'result_count'), 31);
			}

			// Remove default elements
			remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
			remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
			remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
			remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);
			remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

			if(defined('ELEMENTOR_WOOSTORE__FILE__')) {
				remove_action('woocommerce_after_shop_loop_item_title', 'woostore_output_product_excerpt', 35);
				add_action('woocommerce_after_shop_loop_item', 'woostore_output_product_excerpt', 21);
			}

			if(class_exists('WooCommerce_Germanized')) {
				remove_action('woocommerce_after_shop_loop_item', 'woocommerce_gzd_template_single_shipping_costs_info', 7);
				remove_action('woocommerce_after_shop_loop_item', 'woocommerce_gzd_template_single_tax_info', 6);
				remove_action('woocommerce_single_product_summary', 'woocommerce_gzd_template_single_legal_info', 12);
				add_action('woovina_after_archive_product_inner', array($this, 'woocommerce_germanized'));
				add_action('woovina_after_single_product_price', 'woocommerce_gzd_template_single_legal_info');
			}

		}

		/**
		 * Pagination.
		 *
		 * @since 1.4.16
		 */
		public function shop_pagination() {
			if('infinite_scroll' == get_theme_mod('woovina_woo_pagination_style', 'standard')) {
				remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
				add_action('woocommerce_after_shop_loop', array($this, 'infinite_pagination'), 10);
			}
		}

		/**
		 * Infinite scroll pagination.
		 *
		 * @since 1.4.16
		 */
		public static function infinite_pagination() {
			global $wp_query;

			if($wp_query->max_num_pages <= 1) {
				return;
			}

			// Load infinite scroll script
			wp_enqueue_script('infinitescroll');

			// Last text
			$last = get_theme_mod('woovina_woo_infinite_scroll_last_text');
			$last = woovina_tm_translation('woovina_woo_infinite_scroll_last_text', $last);
			$last = $last ? $last: esc_html__('End of content', 'woovina');

			// Error text
			$error = get_theme_mod('woovina_woo_infinite_scroll_error_text');
			$error = woovina_tm_translation('woovina_woo_infinite_scroll_error_text', $error);
			$error = $error ? $error: esc_html__('No more pages to load', 'woovina');
			
			// Output pagination HTML ?>
			<div class="scroller-status">
				<div class="loader-ellips infinite-scroll-request">
					<span class="loader-ellips__dot"></span>
					<span class="loader-ellips__dot"></span>
					<span class="loader-ellips__dot"></span>
					<span class="loader-ellips__dot"></span>
				</div>
				<p class="scroller-status__message infinite-scroll-last"><?php echo esc_attr($last); ?></p>
				<p class="scroller-status__message infinite-scroll-error"><?php echo esc_attr($error); ?></p>
			</div>
			<div class="infinite-scroll-nav clr">
				<div class="alignleft newer-posts"><?php echo get_previous_posts_link('&larr; '. esc_html__('Newer Posts', 'woovina')); ?></div>
				<div class="alignright older-posts"><?php echo get_next_posts_link(esc_html__('Older Posts', 'woovina') .' &rarr;', $wp_query->max_num_pages); ?></div>
			</div>
		<?php
		}

		/**
		 * Move default WooCommerce customizer sections to the theme section.
		 *
		 * @since 1.5.0
		 */
		public static function woo_section($wp_customize) {
			$wp_customize->get_section('woocommerce_store_notice')->panel = 'woovina_woocommerce_panel';
			$wp_customize->get_section('woocommerce_product_images')->panel = 'woovina_woocommerce_panel';
			$wp_customize->get_section('woocommerce_product_images')->priority = 999;
			$wp_customize->get_control('woocommerce_shop_page_display')->section = 'woovina_woocommerce_archives';
			$wp_customize->get_control('woocommerce_category_archive_display')->section = 'woovina_woocommerce_archives';
			$wp_customize->get_control('woocommerce_default_catalog_orderby')->section = 'woovina_woocommerce_archives';
		}

		/**
		 * Helper method to get the version of the currently installed WooCommerce.
		 *
		 * @since 1.1.7
		 * @return string woocommerce version number or null.
		 */
		public static function get_wc_version() {
			return defined('WC_VERSION') && WC_VERSION ? WC_VERSION : null;
		}

		/**
		 * Remove general settings from Woo Admin panel.
		 *
		 * @since 1.0.0
		 */
		public static function remove_general_settings($settings) {
			$remove = array('woocommerce_enable_lightbox');
			foreach($settings as $key => $val) {
				if(isset($val['id']) && in_array($val['id'], $remove)) {
					unset($settings[$key]);
				}
			}
			return $settings;
		}

		/**
		 * Remove product settings from Woo Admin panel.
		 *
		 * @since 1.0.0
		 */
		public static function remove_product_settings($settings) {
			$remove = array(
				'woocommerce_enable_lightbox'
			);
			foreach($settings as $key => $val) {
				if(isset($val['id']) && in_array($val['id'], $remove)) {
					unset($settings[$key]);
				}
			}
			return $settings;
		}

		/**
		 * Content wrapper.
		 *
		 * @since 1.4.7
		 */
		public static function content_wrapper() {
			get_template_part('woocommerce/wc-content-wrapper');
		}

		/**
		 * Content wrapper end.
		 *
		 * @since 1.4.7
		 */
		public static function content_wrapper_end() {
			get_template_part('woocommerce/wc-content-wrapper-end');
		}

		/**
		 * Body classes
		 *
		 * @since 1.5.0
		 */
		public static function body_class($classes) {

			// If dropdown categories widget style
			if('dropdown' == get_theme_mod('woovina_woo_cat_widget_style', 'default')) {
				$classes[] = 'woo-dropdown-cat';
			}

			// Distraction free class
			if((is_cart()
					&& true == get_theme_mod('woovina_woo_distraction_free_cart', false))
				|| (is_checkout()
					&& true == get_theme_mod('woovina_woo_distraction_free_checkout', false))) {
				$classes[] = 'distraction-free';
			}

			// Return
 			return $classes;
			
		}

		/**
		 * Register new WooCommerce sidebar.
		 *
		 * @since 1.0.0
		 */
		public static function register_woo_sidebar() {

			// Return if custom sidebar disabled
			if(! get_theme_mod('woovina_woo_custom_sidebar', true)) {
				return;
			}

			// Register new woo_sidebar widget area
			register_sidebar(array (
				'name'          => esc_html__('WooCommerce Sidebar', 'woovina'),
				'id'            => 'woo_sidebar',
				'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			));
			
			// Register new woo_product_sidebar widget area
			register_sidebar(array (
				'name'          => esc_html__('WooCommerce Product Sidebar', 'woovina'),
				'id'            => 'woo_product_sidebar',
				'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			));
			
		}

		/**
		 * Display WooCommerce sidebar.
		 *
		 * @since 1.0.0
		 */
		public static function display_woo_sidebar($sidebar) {

			// Alter sidebar display to show woo_sidebar where needed
			if(get_theme_mod('woovina_woo_custom_sidebar', true)
				&& is_active_sidebar('woo_sidebar')
				&& is_woocommerce()) {
				$sidebar = 'woo_sidebar';
			}
			
			if(woovina_is_woo_single() 
				&& is_active_sidebar('woo_product_sidebar')
				&& get_theme_mod('woovina_woo_product_sidebar', true)) {
				$sidebar = 'woo_product_sidebar';
			}
			
			// Return correct sidebar
			return $sidebar;

		}

		/**
		 * Tweaks the post layouts for WooCommerce archives and single product posts.
		 *
		 * @since 1.0.0
		 */
		public static function layouts($class) {
			if(woovina_is_woo_shop()
				|| woovina_is_woo_tax()) {
				$class = get_theme_mod('woovina_woo_shop_layout', 'left-sidebar');
			} elseif(woovina_is_woo_single()) {
				$class = get_theme_mod('woovina_woo_product_layout', 'left-sidebar');
			}
			return $class;
		}

		/**
		 * Set correct both sidebars layout style.
		 *
		 * @since 1.4.0
		 */
		public static function bs_class($class) {
			if(woovina_is_woo_shop()
				|| woovina_is_woo_tax()) {
				$class = get_theme_mod('woovina_woo_shop_both_sidebars_style', 'scs-style');
			} elseif(woovina_is_woo_single()) {
				$class = get_theme_mod('woovina_woo_product_both_sidebars_style', 'scs-style');
			}
			return $class;
		}

		/**
		 * Add Custom WooCommerce scripts.
		 *
		 * @since 1.0.0
		 */
		public static function add_custom_scripts() {

			// Register WooCommerce styles
			wp_enqueue_style('woovina-woocommerce', WOOVINA_CSS_DIR_URI .'woo/woocommerce.min.css');
			wp_enqueue_style('woovina-woo-star-font', WOOVINA_CSS_DIR_URI .'woo/woo-star-font.min.css');

			// If rtl
			if(is_RTL()) {
				wp_enqueue_style('woovina-woocommerce-rtl', WOOVINA_CSS_DIR_URI .'woo/woocommerce-rtl.css');
			}

			// If dropdown category widget style
			if('dropdown' == get_theme_mod('woovina_woo_cat_widget_style', 'default')) {
				wp_enqueue_script('woovina-woo-cat-widget', WOOVINA_JS_DIR_URI .'third/woo/woo-cat-widget.min.js', array('jquery'), WOOVINA_THEME_VERSION, true);
			}

			// If vertical thumbnails style
			if('vertical' == get_theme_mod('woovina_woo_product_thumbs_layout', 'horizontal')) {
				wp_enqueue_script('woovina-woo-thumbnails', WOOVINA_JS_DIR_URI .'third/woo/woo-thumbnails.min.js', array('jquery'), WOOVINA_THEME_VERSION, true);
			}

			// If quick view
			if(get_theme_mod('woovina_woo_quick_view', true)) {
				wp_enqueue_script('woovina-woo-quick-view', WOOVINA_JS_DIR_URI .'third/woo/woo-quick-view.min.js', array('jquery'), WOOVINA_THEME_VERSION, true);
				wp_enqueue_style('woovina-woo-quick-view', WOOVINA_CSS_DIR_URI .'woo/woo-quick-view.min.css');
				wp_enqueue_script('wc-add-to-cart-variation');
				wp_enqueue_script('flexslider');
			}

			// If whislist
			if(class_exists('TInvWL_Wishlist')) {
				wp_enqueue_style('woovina-wishlist', WOOVINA_CSS_DIR_URI .'woo/wishlist.min.css');
			}

			// If single product ajax add to cart
			if(true == get_theme_mod('woovina_woo_product_ajax_add_to_cart', false)
				&& woovina_is_woo_single()) {
				wp_enqueue_script('woovina-woo-ajax-addtocart', WOOVINA_JS_DIR_URI .'third/woo/woo-ajax-add-to-cart.min.js', array('jquery'), WOOVINA_THEME_VERSION, true);
			}

			// If floating bar
			if('on' == get_theme_mod('woovina_woo_display_floating_bar', 'off')
				&& woovina_is_woo_single()) {
				wp_enqueue_style('woovina-woo-floating-bar', WOOVINA_CSS_DIR_URI .'woo/woo-floating-bar.min.css');
				wp_enqueue_script('woovina-woo-floating-bar', WOOVINA_JS_DIR_URI .'third/woo/woo-floating-bar.min.js', array('jquery'), WOOVINA_THEME_VERSION, true);
			}

			// If display cart when product added
			if('yes' == get_theme_mod('woovina_woo_display_cart_product_added', 'no')) {
				wp_enqueue_script('woovina-woo-display-cart', WOOVINA_JS_DIR_URI .'third/woo/woo-display-cart.min.js', array('jquery'), WOOVINA_THEME_VERSION, true);
			}

			// If off canvas filter
			if(true == get_theme_mod('woovina_woo_off_canvas_filter', false)
				&& (woovina_is_woo_shop()
					|| woovina_is_woo_tax())) {
				wp_enqueue_script('woovina-woo-off-canvas', WOOVINA_JS_DIR_URI .'third/woo/woo-off-canvas.min.js', array('jquery'), WOOVINA_THEME_VERSION, true);
			}

			// If mobile menu mini cart
			if(get_theme_mod('woovina_woo_add_mobile_mini_cart', true)) {
				wp_enqueue_script('woovina-woo-mini-cart', WOOVINA_JS_DIR_URI .'third/woo/woo-mini-cart.min.js', array('jquery'), WOOVINA_THEME_VERSION, true);
			}

			// If multi step checkout
			if(true == get_theme_mod('woovina_woo_multi_step_checkout', false)
				&& is_checkout()) {
				wp_enqueue_style('woovina-woo-multistep-checkout', WOOVINA_CSS_DIR_URI .'woo/woo-multistep-checkout.min.css');

	            $woo_deps = array('jquery', 'wc-checkout', 'wc-country-select');

	            if(class_exists('WC_Ship_Multiple')){
	                $woo_deps[] = 'wcms-country-select';
	            }

				wp_enqueue_script('woovina-woo-multistep-checkout', WOOVINA_JS_DIR_URI .'third/woo/woo-multistep-checkout.min.js', $woo_deps, WOOVINA_THEME_VERSION, true);
			}

		}

		/**
		 * Localize array.
		 *
		 * @since 1.5.0
		 */
		public static function localize_array($array) {

			// If quick view
			if(get_theme_mod('woovina_woo_quick_view', true)) {
				$array['ajax_url'] = admin_url('admin-ajax.php');
				$array['cart_redirect_after_add'] = get_option( 'woocommerce_cart_redirect_after_add' );
			}

			// If single product ajax add to cart
			if(true == get_theme_mod('woovina_woo_product_ajax_add_to_cart', false)) {
				$array['ajax_url'] 			= admin_url('admin-ajax.php');
				$array['is_cart'] 			= is_cart();
				$array['cart_url'] 			= apply_filters('woovina_woocommerce_add_to_cart_redirect', wc_get_cart_url());
				$array['view_cart'] 		= esc_attr__('View cart', 'woovina');
				$array['cart_redirect_after_add'] = get_option( 'woocommerce_cart_redirect_after_add' );
			}

			// If multi step checkout
			if(true == get_theme_mod('woovina_woo_multi_step_checkout', false)) {
				$array['login_reminder_enabled'] = 'yes' == get_option('woocommerce_enable_checkout_login_reminder', 'yes') ? true : false;
				$array['is_logged_in'] 		 	 = is_user_logged_in();
				$array['no_account_btn'] 		 = esc_html__('I don&rsquo;t have an account', 'woovina');
				$array['next'] 		 			 = esc_html__('Next', 'woovina');
			}

			// If floating bar
			if('on' == get_theme_mod('woovina_woo_display_floating_bar', 'off')) {
				$array['ajax_url'] = admin_url('admin-ajax.php');
				$array['cart_redirect_after_add'] = get_option( 'woocommerce_cart_redirect_after_add' );
			}

			// Check if the floating bar is enabled for the quantity button
			$array['floating_bar'] = get_theme_mod('woovina_woo_display_floating_bar', 'off');
			
			// Grouped product button text in the quick view
			$array['grouped_text'] = esc_attr__( 'View products', 'woovina' );
			
			return $array;

		}

		/**
		 * Get current user ID.
		 *
		 * @since 1.5.0
		 */
		public static function isAuthorizedUser() {
			return get_current_user_id();
		}

		/**
		 * Single Product add to cart ajax request.
		 *
		 * @since 1.5.0
		 */
		public static function add_cart_single_product_ajax() {

			$product_id   	= sanitize_text_field($_POST['product_id']);
			$variation_id 	= sanitize_text_field($_POST['variation_id']);
			$variation 		= $_POST['variation'];
			$quantity     	= sanitize_text_field($_POST['quantity']);

			if($variation_id) {
				WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation);
			} else {
				WC()->cart->add_to_cart($product_id, $quantity);
			}
			die();

		}

		/**
		 * Add cart overlay.
		 *
		 * @since 1.5.0
		 */
		public static function cart_overlay() { ?>
			<div class="wvn-cart-overlay"></div>
		<?php
		}

		/**
		 * Get mini cart sidebar.
		 *
		 * @since 1.5.0
		 */
		public static function get_mini_cart_sidebar() {

			// Style
			$cart_style = get_theme_mod('woovina_woo_cart_dropdown_style', 'compact');

			// Define classes
			$classes = array('woovina-cart-sidebar');

			// Cart style
			if('compact' != $cart_style) {
				$classes[] = $cart_style;
			}

			// Turn classes into string
			$classes = implode(' ', $classes);

			echo '<div id="woovina-cart-sidebar-wrap">';
				echo '<div class="'. $classes .'">';
					echo '<a href="#" class="woovina-cart-close">×</a>';
					echo '<h4>'. esc_html__('Cart', 'woovina') .'</h4><div class="divider"></div>';
					echo '<div class="wvn-mini-cart">';
						the_widget('WC_Widget_Cart', 'title=');
					echo '</div>';
				echo '</div>';
				echo '<div class="woovina-cart-sidebar-overlay"></div>';
			echo '</div>';

		}

		/**
		 * Adds an opening div "woovina-toolbar" around top elements.
		 *
		 * @since 1.1.1
		 */
		public static function add_shop_loop_div() {
			echo '<div class="woovina-toolbar clr">';
		}

		/**
		 * Register off canvas filter sidebar.
		 *
		 * @since 1.5.0
		 */
		public static function register_off_canvas_sidebar() {

			register_sidebar(array (
				'name'          => esc_html__('Off-Canvas Filters', 'woovina'),
				'description'   => esc_html__('Widgets in this area are used in the off canvas sidebar. To enable the Off Canvas filter, go to the WooCommerce > Archives section of the customizer and enable the Display Filter Button option.', 'woovina'),
				'id'            => 'wvn_off_canvas_sidebar',
				'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			));

		}

		/**
		 * Get Off Canvas Sidebar.
		 *
		 * @since 1.5.0
		 */
		public static function get_off_canvas_sidebar() {

			// Return if is not in shop page
			if(! woovina_is_woo_shop()
				&& ! woovina_is_woo_tax()) {
				return;
			}

			if(function_exists('wc_get_template')) {
				wc_get_template('wvn-off-canvas-sidebar.php');
			}

		}

		/**
		 * Add off canvas filter button.
		 *
		 * @since 1.5.0
		 */
		public static function off_canvas_filter_button() {

			// Return if is not in shop page
			if(! woovina_is_woo_shop()
				&& ! woovina_is_woo_tax()) {
				return;
			}

			// Get filter text
			$text = get_theme_mod('woovina_woo_off_canvas_filter_text');
			$text = woovina_tm_translation('woovina_woo_off_canvas_filter_text', $text);
			$text = $text ? $text: esc_html__('Filter', 'woovina');

			$output = '<a href="#" class="woovina-off-canvas-filter"><i class="icon-menu"></i><span class="off-canvas-filter-text">'. esc_html($text) .'</span></a>';

			echo apply_filters('woovina_off_canvas_filter_button_output', $output);
		}

		/**
		 * Add grid/list buttons.
		 *
		 * @since 1.1.1
		 */
		public static function grid_list_buttons() {

			// Return if is not in shop page
			if(! woovina_is_woo_shop()
				&& ! woovina_is_woo_tax()) {
				return;
			}

			// Titles
			$grid_view = esc_html__('Grid view', 'woovina');
			$list_view = esc_html__('List view', 'woovina');

			// Active class
			if('list' == get_theme_mod('woovina_woo_catalog_view', 'grid')) {
				$list = 'active ';
				$grid = '';
			} else {
				$grid = 'active ';
				$list = '';
			}

			$output = sprintf('<nav class="woovina-grid-list"><a href="#" id="woovina-grid" title="%1$s" class="%2$sgrid-btn"><span class="icon-grid"></span></a><a href="#" id="woovina-list" title="%3$s" class="%4$slist-btn"><span class="icon-list"></span></a></nav>', esc_html($grid_view), esc_attr($grid), esc_html($list_view), esc_attr($list));

			echo wp_kses_post(apply_filters('woovina_grid_list_buttons_output', $output));
		}

		/**
		 * Closes the opening div "woovina-toolbar" around top elements.
		 *
		 * @since 1.1.1
		 */
		public static function close_shop_loop_div() {
			echo '</div>';
		}

		/**
		 * Add result count.
		 *
		 * @since 1.1.1
		 */
		public static function result_count() {

			// Return if is not in shop page
			if(! woovina_is_woo_shop()
				&& ! is_product_category()
				&& ! is_product_tag()) {
				return;
			}

			get_template_part('woocommerce/result-count');
		}

		/**
		 * Returns correct posts per page for the shop
		 *
		 * @since 1.0.0
		 */
		public static function loop_shop_per_page() {
			if(get_theme_mod('woovina_woo_shop_result_count', true)) {
				$posts_per_page = (isset($_GET['products-per-page'])) ? sanitize_text_field(wp_unslash($_GET['products-per-page'])) : get_theme_mod('woovina_woo_shop_posts_per_page', '12');

			    if($posts_per_page == 'all') {
			        $posts_per_page = wp_count_posts('product')->publish;
			    }
			} else {
				$posts_per_page = get_theme_mod('woovina_woo_shop_posts_per_page');
				$posts_per_page = $posts_per_page ? $posts_per_page : '12';
			}
			return $posts_per_page;
		}

		/**
		 * Change products per row for the main shop.
		 *
		 * @since 1.0.0
		 */
		public static function loop_shop_columns() {
			$columns = get_theme_mod('woovina_woocommerce_shop_columns', '3');
			$columns = $columns ? $columns : '3';
			return $columns;
		}

		/**
		 * Change products per row for upsells.
		 *
		 * @since 1.0.0
		 */
		public static function upsell_display() {

			// Get count
			$count = get_theme_mod('woovina_woocommerce_upsells_count', '3');
			$count = $count ? $count : '3';

			// Get columns
			$columns = get_theme_mod('woovina_woocommerce_upsells_columns', '3');
			$columns = $columns ? $columns : '3';

			// Alter upsell display
			woocommerce_upsell_display($count, $columns);

		}

		/**
		 * Change products per row for crossells.
		 *
		 * @since 1.0.0
		 */
		public static function cross_sell_display() {

			// Get count
			$count = get_theme_mod('woovina_woocommerce_cross_sells_count', '2');
			$count = $count ? $count : '2';

			// Get columns
			$columns = get_theme_mod('woovina_woocommerce_cross_sells_columns', '2');
			$columns = $columns ? $columns : '2';

			// Alter cross-sell display
			woocommerce_cross_sell_display($count, $columns);

		}

		/**
		 * Alter the related product arguments.
		 *
		 * @since 1.0.0
		 */
		public static function related_product_args() {

			// Get global vars
			global $product, $orderby, $related;

			// Get posts per page
			$posts_per_page = get_theme_mod('woovina_woocommerce_related_count', '3');
			$posts_per_page = $posts_per_page ? $posts_per_page : '3';

			// Get columns
			$columns = get_theme_mod('woovina_woocommerce_related_columns', '3');
			$columns = $columns ? $columns : '3';

			// Return array
			return array(
				'posts_per_page' => $posts_per_page,
				'columns'        => $columns,
			);

		}

		/**
		 * Adds an opening div "product-inner" around product entries.
		 *
		 * @since 1.0.0
		 */
		public static function add_shop_loop_item_inner_div() {
			echo '<div class="product-inner clr">';
		}

		/**
		 * Adds an out of stock tag to the products.
		 *
		 * @since 1.0.0
		 */
		public static function add_out_of_stock_badge() {
			if(function_exists('woovina_woo_product_instock') && ! woovina_woo_product_instock()) {
				$label = esc_html__('Out of Stock', 'woovina');  ?>
				<div class="outofstock-badge">
					<?php echo esc_html(apply_filters('woovina_woo_outofstock_text', $label)); ?>
				</div><!-- .product-entry-out-of-stock-badge -->
			<?php }
		}

		/**
		 * Returns our product thumbnail from our template parts based on selected style in theme mods.
		 *
		 * @since 1.0.0
		 */
		public static function loop_product_thumbnail($direct = false) {
			
			if(!$direct && !(is_shop() || is_product_category() || is_product_tag())) return;
			
			if(function_exists('wc_get_template')) {
				// Get entry product media style
				$style = get_theme_mod('woovina_woo_product_entry_style');
				$style = $style ? $style : 'image-swap';
				// Get entry product media template part
				wc_get_template('loop/thumbnail/'. $style .'.php');
			}
		}

		/**
		 * Archive product content.
		 *
		 * @since 1.1.4
		 */
		public static function archive_product_content() {
			if(function_exists('wc_get_template')) {
				wc_get_template('wvn-archive-product.php');
			}
		}

		/**
		 * Closes the "product-inner" div around product entries.
		 *
		 * @since 1.0.0
		 */
		public static function close_shop_loop_item_inner_div() {
			echo '</div><!-- .product-inner .clr -->';
		}

		/**
		 * Quick view button.
		 *
		 * @since 1.5.0
		 */
		public static function quick_view_button() {
			global $product;

			$button  = '<a href="#" id="product_id_' . $product->get_id() . '" class="wvn-quick-view" data-product_id="' . $product->get_id() . '"><i class="icon-eye"></i>' . esc_html__('Quick View', 'woovina') . '</a>';

			echo apply_filters('woovina_woo_quick_view_button_html', $button);
		}

		/**
		 * Quick view ajax.
		 *
		 * @since 1.5.0
		 */
		public static function product_quick_view_ajax() {
			if(! isset($_REQUEST['product_id'])) {
				die();
			}

			$product_id = intval($_REQUEST['product_id']);

			// wp_query for the product.
			wp('p=' . $product_id . '&post_type=product');

			ob_start();

			get_template_part('woocommerce/quick-view-content');

			echo ob_get_clean();

			die();
		}

		/**
		 * Quick view template.
		 *
		 * @since 1.5.0
		 */
		public static function quick_view_template() {
			get_template_part('woocommerce/quick-view');
		}

		/**
		 * Quick view image.
		 *
		 * @since 1.5.0
		 */
		public static function quick_view_image() {
			get_template_part('woocommerce/quick-view-image');
		}

		/**
		 * Clear floats after single product summary.
		 *
		 * @since 1.0.0
		 */
		public static function clear_summary_floats() {
			echo '<div class="clear-after-summary clr"></div>';
		}

		/**
		 * Single product content.
		 *
		 * @since 1.1.9
		 */
		public static function single_product_content() {
			if(function_exists('wc_get_template')) {
				wc_get_template('wvn-single-product.php');
			}
		}

		/**
		 * Add product navigation.
		 *
		 * @since 1.5.0
		 */
		public static function product_next_prev_nav() {
			global $post;

			$next_post = get_next_post(true, '', 'product_cat');
			$prev_post = get_previous_post(true, '', 'product_cat'); ?>

			<div class="wvn-product-nav-wrap">
				<ul class="wvn-product-nav">
			        <?php
			        if(is_a($next_post , 'WP_Post')) { ?>
						<li class="thumb-next">
							<a href="<?php echo get_the_permalink($next_post->ID); ?>" class="wvn-nav-link next" rel="next"><i class="zmdi zmdi-long-arrow-left zmdi-hc-fw"></i></a>
							<div class="wvn-nav-thumb">
								<a title="<?php echo get_the_title($next_post->ID); ?>" href="<?php echo get_the_permalink($next_post->ID); ?>"><?php echo get_the_post_thumbnail($next_post->ID, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail')); ?>
									<span><?php echo get_the_title($next_post->ID); ?></span>
								</a>
							</div>
						</li>
					<?php
					}

					if(is_a($prev_post , 'WP_Post')) { ?>
						<li class="thumb-prev">
							<a href="<?php echo get_the_permalink($prev_post->ID); ?>" class="wvn-nav-link prev" rel="next"><i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i></a>
							<div class="wvn-nav-thumb">
								<a title="<?php echo get_the_title($prev_post->ID); ?>" href="<?php echo get_the_permalink($prev_post->ID); ?>"><?php echo get_the_post_thumbnail($prev_post->ID, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail')); ?>
									<span><?php echo get_the_title($prev_post->ID); ?></span>
								</a>
							</div>
						</li>
					<?php
					} ?>
		        </ul>
		    </div>

		<?php
		}

		/**
		 * Add floating bar.
		 *
		 * @since 1.5.0
		 */
		public static function floating_bar() {

			// Return if is not single product
			if(! woovina_is_woo_single()) {
				return;
			}

			// Get product object
			$product = wc_get_product(get_the_ID()); ?>

			<div class="wvn-floating-bar">
				<div class="container clr">
					<div class="left">
				        <p class="selected"><?php esc_html_e('Selected:', 'woovina'); ?></p>
				        <h2 class="entry-title" itemprop="name"><?php echo esc_html($product->get_title()); ?></h2>
				    </div>
					<div class="right">
				        <div class="product_price">
				        	<p class="price"><?php echo wp_kses_post($product->get_price_html()); ?></p>
		                </div>
		                <?php
		                // If out of stock
		                if('outofstock' == $product->get_stock_status()) { ?>
		                	<p class="stock out-of-stock"><?php esc_html_e('Out of stock', 'woovina'); ?></p>
		            	<?php
		            	} else if($product && $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually()) {
		                	echo self::floating_bar_add_to_cart($product);
		            	} else { ?>
		                	<button type="submit" class="button top"><?php esc_html_e('Select Options', 'woovina'); ?></button>
		                <?php
		            	} ?>
				    </div>
		        </div>
		    </div>

		<?php
		}

		/**
		 * Floating bar add to cart button.
		 *
		 * @since 1.5.0
		 */
		public static function floating_bar_add_to_cart($product) {

			$html = '<form action="' . esc_url($product->add_to_cart_url()) . '" class="cart" method="post" enctype="multipart/form-data">';
			$html .= woocommerce_quantity_input(array(), $product, false);
			$html .= '<button type="submit" name="add-to-cart" value="' . get_the_ID() . '" class="floating_add_to_cart_button button alt">' . esc_html($product->add_to_cart_text()) . '</button>';
			$html .= '</form>';

			return $html;
		}

		/**
		 * Floating bar add to cart ajax request.
		 *
		 * @since 1.5.0
		 */
		public static function add_cart_floating_bar_ajax() {

			$product_id   = sanitize_text_field($_POST['product_id']);
			$quantity     = sanitize_text_field($_POST['quantity']);

			WC()->cart->add_to_cart($product_id, $quantity);

			die();

		}

		/**
		 * Add wrap and user info to the account navigation.
		 *
		 * @since 1.0.0
		 */
		public static function woovina_before_account_navigation() {

			// Name to display
			$current_user = wp_get_current_user();

			if($current_user->display_name) {
				$name = $current_user->display_name;
			} else {
				$name = esc_html__('Welcome!', 'woovina');
			}
			$name = apply_filters('woovina_user_profile_name_text', $name);

			echo '<div class="woocommerce-MyAccount-tabs clr">';
				echo '<div class="woovina-user-profile clr">';
					echo '<div class="image">'. get_avatar($current_user->user_email, 128) .'</div>';
					echo '<div class="user-info">';
						echo '<p class="name">'. esc_attr($name) .'</p>';
						echo '<a class="logout" href="'. esc_url(wp_logout_url(get_permalink())) .'">'. esc_html__('Logout', 'woovina') .'</a>';
					echo '</div>';
				echo '</div>';

		}

		/**
		 * Add wrap to the account navigation.
		 *
		 * @since 1.0.0
		 */
		public static function woovina_after_account_navigation() {
			echo '</div>';
		}

		/**
		 * Adds container wrap for the thumbnail and title of the categories products.
		 *
		 * @since 1.1.1.1
		 */
		public static function add_container_wrap_category() {
			echo '<div class="product-inner clr">';
		}

		/**
		 * Adds a container div before the thumbnail for the categories products.
		 *
		 * @since 1.1.1.1
		 */
		public static function add_div_before_category_thumbnail($category) {
			echo '<div class="woo-entry-image clr">';
				echo '<a href="' . esc_url(get_term_link($category, 'product_cat')) . '">';
		}

		/**
		 * Close a container div before the thumbnail for the categories products.
		 *
		 * @since 1.1.1.1
		 */
		public static function close_div_after_category_thumbnail() {
				echo '</a>';
			echo '</div>';
		}

		/**
		 * Adds a container div before the thumbnail for the categories products.
		 *
		 * @since 1.1.1.1
		 */
		public static function add_div_before_category_title($category) {
			echo '<div class="woo-entry-inner clr">';
				echo '<a href="' . esc_url(get_term_link($category, 'product_cat')) . '">';
		}

		/**
		 * Add description if list view for the categories products.
		 *
		 * @since 1.1.1.1
		 */
		public static function add_category_description($category) {
				// Close category link openend in add_div_before_category_title()
				echo '</a>';

			// Var
			$term 			= get_term($category->term_id, 'product_cat');
			$description 	= $term->description;

			// Description
			if(get_theme_mod('woovina_woo_grid_list', true)
				&& $description) {
				echo '<div class="woo-desc">';
					echo '<div class="description">' . wp_kses_post($description) . '</div>';
				echo '</div>';
			}
		}

		/**
		 * Close a container div before the thumbnail for the categories products.
		 *
		 * @since 1.1.1.1
		 */
		public static function close_div_after_category_title() {
			echo '</div>';
		}

		/**
		 * Close container wrap for the thumbnail and title of the categories products.
		 *
		 * @since 1.1.1.1
		 */
		public static function close_container_wrap_category() {
			echo '</div>';
		}

		/**
		 * Before my account login.
		 *
		 * @since 1.0.0
		 */
		public static function woovina_login_wrap_before() {
			echo '<div class="woovina-loginform-wrap">';
		}

		/**
		 * After my account login.
		 *
		 * @since 1.0.0
		 */
		public static function woovina_login_wrap_after() {
			echo '</div>';
		}

		/**
		 * Display the categories featured images.
		 *
		 * @since 1.0.0
		 */
		public static function woocommerce_category_image() {
			if(is_product_category()) {
			    global $wp_query;
			    $cat 			= $wp_query->get_queried_object();
			    $thumbnail_id 	= get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
			    $image 			= wp_get_attachment_url($thumbnail_id);

			    if($image) {
				    echo '<div class="category-image"><img src="' . $image . '" alt="' . $cat->name . '" /></div>';
				}
			}
		}

		/**
		 * Tweaks pagination arguments.
		 *
		 * @since 1.0.0
		 */
		public static function pagination_args($args) {
			$args['prev_text'] = '<i class="fa fa-angle-left"></i>';
			$args['next_text'] = '<i class="fa fa-angle-right"></i>';
			return $args;
		}

		/**
		 * Alter continue shoping URL.
		 *
		 * @since 1.0.0
		 */
		public static function continue_shopping_redirect($return_to) {
			$shop_id = wc_get_page_id('shop');
			if(function_exists('icl_object_id')) {
				$shop_id = icl_object_id($shop_id, 'page');
			}
			if($shop_id) {
				$return_to = get_permalink($shop_id);
			}
			return $return_to;
		}

		/**
		 * Add classes to WooCommerce product entries.
		 *
		 * @since 1.0.0
		 */
		public static function add_product_classes($classes) {
			global $product, $woocommerce_loop;

			// Vars
			$content_alignment 	= get_theme_mod('woovina_woo_product_entry_content_alignment', 'center');
			$content_alignment 	= $content_alignment ? $content_alignment : 'center';
			$thumbs_layout 		= get_theme_mod('woovina_woo_product_thumbs_layout', 'horizontal');
			$thumbs_layout 		= $thumbs_layout ? $thumbs_layout : 'horizontal';
			$tabs_layout 		= get_theme_mod('woovina_woo_product_tabs_layout', 'horizontal');
			$tabs_layout 		= $tabs_layout ? $tabs_layout : 'horizontal';
			$btn_style 			= get_theme_mod('woovina_woo_product_addtocart_style', 'normal');
			$btn_style 			= $btn_style ? $btn_style : 'normal';

			// Product entries
			if($product && ! empty($woocommerce_loop['columns'])) {

				// If has rating
				if($product->get_rating_count() || get_theme_mod('woovina_woo_empty_star', false)) {
					$classes[] = 'has-rating';
				}

				$classes[] = 'col';
				$classes[] = woovina_grid_class($woocommerce_loop['columns']);
				$classes[] = 'wvn-content-'. $content_alignment;

				// If infinite scroll
				if('infinite_scroll' == get_theme_mod('woovina_woo_pagination_style', 'standard')) {
					$classes[] = 'item-entry';
				}

			}

			// Single product
			if(post_type_exists('product')) {

				// Thumbnails layout
				$classes[] = 'wvn-thumbs-layout-' . $thumbs_layout;

				// Add to cart button style
				$classes[] = 'wvn-btn-' . $btn_style;

				// Tabs layout
				$classes[] = 'wvn-tabs-layout-' . $tabs_layout;

				// If no thumbnails
				$thumbnails = get_post_meta(get_the_ID(), '_product_image_gallery', true);
				if(empty($thumbnails)) {
					$classes[] = 'has-no-thumbnails';
				}

			}

			// Sale badge style
			$sale_style = get_theme_mod('woovina_woo_sale_badge_style', 'square');
			if('circle' == $sale_style) {
				$classes[] = $sale_style . '-sale';
			}

			return $classes;
		}

		/**
		 * Remove the category description under the page title on taxonomy.
		 *
		 * @since 1.4.7
		 */
		public static function post_subheading($return) {
			if(is_woocommerce() && is_product_taxonomy()) {
				$return = false;
			}
			return $return;
		}

		/**
		 * Disables the next/previous links.
		 *
		 * @since 1.0.0
		 */
		public static function next_prev($return) {
			if(is_woocommerce() && is_singular('product')) {
				$return = false;
			}
			return $return;
		}

		/**
		 * Adds color accents for WooCommerce styles.
		 *
		 * @since 1.0.0
		 */
		public static function primary_texts($texts) {
			return array_merge(array(
				'.woocommerce-MyAccount-navigation ul li a:before',
				'.woocommerce-checkout .woocommerce-info a',
				'.woocommerce-checkout #payment ul.payment_methods .wc_payment_method>input[type=radio]:first-child:checked+label:before',
				'.woocommerce-checkout #payment .payment_method_paypal .about_paypal',
				'.woocommerce ul.products li.product .category a:hover',
				'.woocommerce ul.products li.product .button:hover',
				'.woocommerce ul.products li.product .product-inner .added_to_cart:hover',
				'.product_meta .posted_in a:hover',
				'.product_meta .tagged_as a:hover',
				'.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover',
				'.woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
				'.woocommerce .woovina-grid-list a.active',
				'.woocommerce .woovina-grid-list a:hover',
				'.woocommerce .woovina-off-canvas-filter:hover',
				'.woocommerce .widget_shopping_cart ul.cart_list li .wvn-grid-wrap .wvn-grid a.remove:hover',
				'.widget_product_categories li a:hover ~ .count',
				'.widget_layered_nav li a:hover ~ .count',
			), $texts);
		}

		/**
		 * Adds border accents for WooCommerce styles.
		 *
		 * @since 1.0.0
		 */
		public static function primary_borders($borders) {
			return array_merge(array(
				'.current-shop-items-dropdown' => array('top'),
				'.woocommerce div.product .woocommerce-tabs ul.tabs li.active a' => array('bottom'),
				'.wcmenucart-details.count:before',
				'.woocommerce ul.products li.product .button:hover',
				'.woocommerce ul.products li.product .product-inner .added_to_cart:hover',
				'.woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
				'.woocommerce .woovina-grid-list a.active',
				'.woocommerce .woovina-grid-list a:hover',
				'.woocommerce .woovina-off-canvas-filter:hover',
				'.wvn-product-nav li a.wvn-nav-link:hover',
				'.widget_shopping_cart_content .buttons .button:first-child:hover',
				'.woocommerce .widget_shopping_cart ul.cart_list li .wvn-grid-wrap .wvn-grid a.remove:hover',
				'.widget_product_categories li a:hover ~ .count',
				'.woocommerce .widget_product_categories li.current-cat a ~ .count',
				'.woocommerce .widget_product_categories li.current-cat a:before',
				'.widget_layered_nav li a:hover ~ .count',
				'.woocommerce .widget_layered_nav li.chosen a ~ .count',
				'.woocommerce .widget_layered_nav li.chosen a:before',
				'#wvn-checkout-timeline.arrow .active .timeline-wrapper:before' => array('top', 'bottom'),
				'#wvn-checkout-timeline.arrow .active .timeline-wrapper:after' => array('left', 'right'),
				'.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count',
				'.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count:after',
				'.show-cart .wcmenucart-cart-icon .wcmenucart-count',
				'.show-cart .wcmenucart-cart-icon .wcmenucart-count:after',
			), $borders);
		}

		/**
		 * Adds background accents for WooCommerce styles.
		 *
		 * @since 1.0.0
		 */
		public static function primary_backgrounds($backgrounds) {
			return array_merge(array(
				'.woocommerce div.product div.images .open-image',
				'.wcmenucart-details.count',
				'.woocommerce-message a',
				'.woocommerce-error a',
				'.woocommerce-info a',
				'.woocommerce .widget_price_filter .ui-slider .ui-slider-handle',
				'.woocommerce .widget_price_filter .ui-slider .ui-slider-range',
				'.wvn-product-nav li a.wvn-nav-link:hover',
				'.woocommerce div.product.wvn-tabs-layout-vertical .woocommerce-tabs ul.tabs li a:after',
				'.woocommerce .widget_product_categories li.current-cat a ~ .count',
				'.woocommerce .widget_product_categories li.current-cat a:before',
				'.woocommerce .widget_layered_nav li.chosen a ~ .count',
				'.woocommerce .widget_layered_nav li.chosen a:before',
				'#wvn-checkout-timeline .active .timeline-wrapper',
				'.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count',
				'.show-cart .wcmenucart-cart-icon .wcmenucart-count',
			), $backgrounds);
		}

		/**
		 * Adds background hover accents for WooCommerce styles.
		 *
		 * @since 1.0.0
		 */
		public static function hover_primary_backgrounds($hover) {
			return array_merge(array(
				'.woocommerce div.product div.images .open-image:hover',
				'.woocommerce-error a:hover',
				'.woocommerce-info a:hover',
				'.woocommerce-message a:hover',
			), $hover);
		}

		/**
		 * Adds border color elements for WooCommerce styles.
		 *
		 * @since 1.0.0
		 */
		public static function border_color_elements($elements) {
			return array_merge(array(
				'.woocommerce table.shop_table',
				'.woocommerce table.shop_table td',
				'.woocommerce-cart .cart-collaterals .cart_totals tr td',
				'.woocommerce-cart .cart-collaterals .cart_totals tr th',
				'.woocommerce table.shop_table tth',
				'.woocommerce table.shop_table tfoot td',
				'.woocommerce table.shop_table tfoot th',
				'.woocommerce .order_details',
				'.woocommerce .shop_table.order_details tfoot th',
				'.woocommerce .shop_table.customer_details th',
				'.woocommerce .cart-collaterals .cross-sells',
				'.woocommerce-page .cart-collaterals .cross-sells',
				'.woocommerce .cart-collaterals .cart_totals',
				'.woocommerce-page .cart-collaterals .cart_totals',
				'.woocommerce .cart-collaterals h2',
				'.woocommerce .cart-collaterals h2',
				'.woocommerce .cart-collaterals h2',
				'.woocommerce-cart .cart-collaterals .cart_totals .order-total th',
				'.woocommerce-cart .cart-collaterals .cart_totals .order-total td',
				'.woocommerce ul.order_details',
				'.woocommerce .shop_table.order_details tfoot th',
				'.woocommerce .shop_table.customer_details th',
				'.woocommerce .woocommerce-checkout #customer_details h3',
				'.woocommerce .woocommerce-checkout h3#order_review_heading',
				'.woocommerce-checkout #payment ul.payment_methods',
				'.woocommerce-checkout form.login',
				'.woocommerce-checkout form.checkout_coupon',
				'.woocommerce-checkout-review-order-table tfoot th',
				'.woocommerce-checkout #payment',
				'.woocommerce ul.order_details',
				'.woocommerce #customer_login > div',
				'.woocommerce .col-1.address',
				'.woocommerce .col-2.address',
				'.woocommerce-checkout .woocommerce-info',
				'.woocommerce div.product form.cart',
				'.product_meta',
				'.woocommerce div.product .woocommerce-tabs ul.tabs',
				'.woocommerce #reviews #comments ol.commentlist li .comment_container',
				'p.stars span a',
				'.woocommerce ul.product_list_widget li',
				'.woocommerce .widget_shopping_cart .cart_list li',
				'.woocommerce.widget_shopping_cart .cart_list li',
				'.woocommerce ul.product_list_widget li:first-child',
				'.woocommerce .widget_shopping_cart .cart_list li:first-child',
				'.woocommerce.widget_shopping_cart .cart_list li:first-child',
				'.widget_product_categories li a',
				'.woocommerce .woovina-toolbar',
				'.woocommerce .products.list .product',
			), $elements);
		}

		/**
		 * Alter WooCommerce category classes
		 *
		 * @since 1.0.0
		 */
		public static function product_cat_class($classes) {
			global $woocommerce_loop;
			$classes[] = 'col';
			$classes[] = woovina_grid_class($woocommerce_loop['columns']);
			return $classes;
		}
		
		/**
		 * Adds compare icon to menu
		 *
		 * @since 4.7.5
		 */
		public static function menu_compare_icon($items, $args) {
			// Return items if is in the Elementor edit mode, to avoid error
			if(WOOVINA_ELEMENTOR_ACTIVE
				&& \Elementor\Plugin::$instance->editor->is_edit_mode()) {
				return $items;
			}
			
			// Return
			if(! defined('YITH_WOOCOMPARE')
				|| true != get_theme_mod('woovina_woo_compare_icon', false)
				|| 'main_menu' != $args->theme_location) {
				return $items;
			}
			
			// Add compare link to menu items
			$items .= '<li class="woo-compare-link">'. woovina_shortcode('[woovina_compare_button]') .'</li>';

			// Return menu items
			return $items;
		}
		
		/**
		 * Adds wishlist icon to menu
		 *
		 * @since 1.5.0
		 */
		public static function menu_wishlist_icon($items, $args) {

			// Return items if is in the Elementor edit mode, to avoid error
			if(WOOVINA_ELEMENTOR_ACTIVE
				&& \Elementor\Plugin::$instance->editor->is_edit_mode()) {
				return $items;
			}

			// Return
			if(! class_exists('TInvWL_Wishlist')
				|| true != get_theme_mod('woovina_woo_wishlist_icon', false)
				|| 'main_menu' != $args->theme_location) {
				return $items;
			}

			// Add wishlist link to menu items
			$items .= '<li class="woo-wishlist-link">'. woovina_shortcode('[ti_wishlist_products_counter]') .'</li>';

			// Return menu items
			return $items;
		}

		/**
		 * Adds cart icon to menu
		 *
		 * @since 1.0.0
		 */
		public static function menu_cart_icon($items, $args) {

			// Return items if is in the Elementor edit mode, to avoid error
			if(WOOVINA_ELEMENTOR_ACTIVE
				&& \Elementor\Plugin::$instance->editor->is_edit_mode()) {
				return $items;
			}

			// Only used for the main menu
			if('main_menu' != $args->theme_location) {
				return $items;
			}

			// Get style
			$style 			= woovina_menu_cart_style();
			$header_style 	= woovina_header_style();

			// Return items if no style
			if(! $style) {
				return $items;
			}

			// Return items if "hide if empty cart" is checked
			if(true == get_theme_mod('woovina_woo_menu_icon_hide_if_empty', false)
				&& ! WC()->cart->cart_contents_count > 0) {
				return $items;
			}

			// Add cart link to menu items
			if('full_screen' == $header_style) {
				$items .= '<li class="woo-cart-link"><a href="'. esc_url(wc_get_cart_url()) .'">'. esc_html__('Your cart', 'woovina') .'</a></li>';
			} else {
				$items .= self::get_cart_icon();
			}

			// Return menu items
			return $items;
		}

		/**
		 * Add cart icon
		 *
		 * @since 1.5.0
		 */
		public static function get_cart_icon() {

			// Style
			$style = woovina_menu_cart_style();
			$header_style = woovina_header_style();
			$cart_style = get_theme_mod('woovina_woo_cart_dropdown_style', 'compact');

			// Toggle class
			$toggle_class = 'toggle-cart-widget';

			// Define classes to add to li element
			$classes = array('woo-menu-icon');

			// Add style class
			$classes[] = 'wcmenucart-toggle-'. $style;

			// If bag style
			if('yes' == get_theme_mod('woovina_woo_menu_bag_style', 'no')) {
				$classes[] = 'bag-style';
			}

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

			// Turn classes into string
			$classes = implode(' ', $classes);

			ob_start(); ?>

			<li class="<?php echo esc_attr($classes); ?>">
				<?php woovina_wcmenucart_menu_item(); ?>
				<?php
				if('drop_down' == $style
					&& 'full_screen' != $header_style
					&& 'vertical' != $header_style) { ?>
					<div class="current-shop-items-dropdown wvn-mini-cart clr">
						<div class="current-shop-items-inner clr">
							<?php the_widget('WC_Widget_Cart', 'title='); ?>
						</div>
					</div>
				<?php } ?>
			</li>

			<?php
			return ob_get_clean();

		}

		/**
		 * Add menu cart item to the Woo fragments so it updates with AJAX
		 *
		 * @since 1.0.0
		 */
		public static function menu_cart_icon_fragments($fragments) {
			ob_start();
			woovina_wcmenucart_menu_item();
			$fragments['li.woo-menu-icon a.wcmenucart, .woovina-mobile-menu-icon a.wcmenucart'] = ob_get_clean();

			return $fragments;
		}

		/**
		 * Sale badge content
		 *
		 * @since 1.5.0
		 */
		public static function sale_flash() {
			global $product;

			// Value
			if('grouped' == $product->get_type() || 'variable' == $product->get_type()) {
				$value = esc_html__('Sale', 'woovina');
			} else {
				$s_price = $product->get_sale_price();
				$r_price = $product->get_regular_price();
				$percent = round(((($r_price - $s_price) / $r_price) * 100), 0);
				$value 	 = '-' . esc_html($percent) . '%';
			}

			// Sale flash
			return '<span class="onsale">' . esc_html($value) . '</span>';
		}

		/**
		 * Add links Login/Register on the my account page
		 *
		 * @since 1.5.0
		 */
		public static function login_register_links() {

			// Var
			$registration = get_option('woocommerce_enable_myaccount_registration');

			// Define classes
			$classes = array('wvn-account-links');

			// If registration disabled
			if('yes' != $registration) {
				$classes[] = 'registration-disabled';
			}

			// Turn classes into string
			$classes = implode(' ', $classes);

			// Login text
			$text = esc_html__('Login', 'woovina');

			$html = '<ul class="'. $classes .'">';
				$html .= '<li class="login">';
					if('yes' == $registration) {
					    $html .= '<a href="#" class="wvn-account-link current">'. $text .'</a>';
					} else {
					    $html .= '<span class="wvn-account-link current">'. $text .'</span>';
					}
				$html .= '</li>';

				// If registration
				if('yes' == $registration) {
					$html .= '<li class="or">'. esc_html__('Or', 'woovina') .'</li>';
					$html .= '<li class="register">';
						$html .= '<a href="#" class="wvn-account-link">'. esc_html__('Register', 'woovina') .'</a>';
					$html .= '</li>';
				}

			$html .= '</ul>';

			echo wp_kses_post($html);
		}

		/**
		 * Distraction free on cart/checkout
		 *
		 * @since 1.5.0
		 */
		public static function distraction_free($return) {

			if((is_cart()
					&& true == get_theme_mod('woovina_woo_distraction_free_cart', false))
				|| (is_checkout()
					&& true == get_theme_mod('woovina_woo_distraction_free_checkout', false))) {
				$return = false;
			}

			// Return
			return $return;
			
		}

		/**
		 * Checkout timeline template.
		 *
		 * @since 1.5.0
		 */
		public static function checkout_timeline() {
			get_template_part('woocommerce/checkout/checkout-timeline');
		}

		/**
		 * Change checkout template
		 *
		 * @since 1.5.0
		 */
		public static function multistep_checkout($template, $template_name, $template_path) {

			if('checkout/form-checkout.php' == $template_name) {
                $template = WOOVINA_THEME_DIR . '/woocommerce/checkout/form-multistep-checkout.php';
            }

			// Return
			return $template;
			
		}

		/**
		 * Checkout login form.
		 *
		 * @since 1.5.0
		 */
		public static function checkout_login_form($login_message) {
			woocommerce_login_form(
				array(
					'message'  => $login_message,
					'redirect' => wc_get_page_permalink('checkout'),
					'hidden'   => false
				)
			);

			// If WooCommerce social login
			if(class_exists('WC_Social_Login')) {
                woovina_shortcode('[woocommerce_social_login_buttons]');
            }
		}

		/**
		 * Support to WooCommerce secure submit gateway
		 *
		 * @since 1.5.0
		 */
		public static function woocommerce_securesubmit_support($value, $options) {
            $value['use_iframes'] = 'no';
            return $value;
        }

		/**
		 * Add typography options for the WooCommerce product title
		 *
		 * @since 1.0.0
		 */
		public static function typography_settings($settings) {
			$settings['woo_product_title'] = array(
				'label' 				=> esc_html__('WooCommerce Product Title', 'woovina'),
				'target' 				=> '.woocommerce div.product .product_title',
				'defaults' 				=> array(
					'font-size' 		=> '24',
					'color' 			=> '#333333',
					'line-height' 		=> '1.4',
					'letter-spacing' 	=> '0.6',
				),
			);

			$settings['woo_product_price'] = array(
				'label' 				=> esc_html__('WooCommerce Product Price', 'woovina'),
				'target' 				=> '.woocommerce div.product p.price',
				'defaults' 				=> array(
					'font-size' 		=> '36',
					'line-height' 		=> '1',
					'letter-spacing' 	=> '0',
				),
			);

			$settings['woo_product_add_to_cart'] = array(
				'label'                 => esc_html__('WooCommerce Product Add To Cart', 'woovina'),
				'target'                => '.woocommerce ul.products li.product .button, .woocommerce ul.products li.product .product-inner .added_to_cart',
				'exclude' 				=> array('font-color'),
				'defaults'              => array(
					'font-size'         => '12',
					'line-height'       => '1.5',
					'letter-spacing'    => '1',
				),
			);

			return $settings;
		}

		/**
		 * Supports WooCommerce Match Box extension by removing
		 * duplicate single product summary features on the
		 * product page.
		 *
		 * @since 1.2.9
		 * @author Sébastien Dumont
		 * @global object WC_Product $product
		 */
		public function remove_wc_match_box_single_product_summary() {
			global $product;

			if($product->is_type('mix-and-match')) {
				remove_action('woocommerce_single_product_summary', array($this, 'single_product_content'), 10);
				add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			}
		}

		/**
		 * Compatibility with WooCommerce Germanized.
		 *
		 * @since 1.5.6
		 */
		public function woocommerce_germanized() {
			echo '<li class="wc-gzd">';
				wc_get_template('single-product/tax-info.php');
				wc_get_template('single-product/shipping-costs-info.php');
			echo '</li>';
		}
		
		/**
		 * Remove product data tabs
		 *
		 * @since 3.3
		 */
		public function remove_additional_information_tabs($tabs) {
			
			// Return if remove additional information disabled
			if(! get_theme_mod('woovina_woo_product_tabs_addition_information', false)) {
				return $tabs;
			}
			
			unset($tabs['additional_information']);
			return $tabs;
		}
		
		/**
		 * Show Stock Counter in listing page
		 *
		 * @since 3.3
		 */
		public function show_stock_remaining() {
			
			if(! get_theme_mod('woovina_woo_stock_remaining', false)) return;
			
			global $product;

			$low_stock_notify = $product->get_low_stock_amount();
			$stock_amount	  = $product->get_stock_quantity();
			
			if(empty($low_stock_notify) && get_option('woocommerce_notify_low_stock_amount')) {
				$low_stock_notify = get_option('woocommerce_notify_low_stock_amount');
			}
			
			if(!$product->is_type('variable')) {
				if($stock_amount) {
					$stock_amount	  = wc_format_stock_quantity_for_display($stock_amount, $product);
					if($stock_amount < $low_stock_notify ) {
						echo '<li class="remaining">' . sprintf(__('Only %s left in stock', 'woovina'), $stock_amount) . '</li>';
					} 
					else {
						echo '<li class="remaining">' . sprintf(__('%s in stock', 'woovina'), $stock_amount) . '</li>';
					}
				}
			} 
			else {
				if($stock_amount) {
					$product_variations = $product->get_available_variations();
					$stock = 0;
					
					foreach($product_variations as $variation) {
					  $stock = $stock + $variation['max_qty'];
					}
					
					if($stock > 0) {
						if(wc_format_stock_quantity_for_display($stock, $product) < $low_stock_notify) { // if stock is low
							echo '<li class="remaining">' . sprintf(__('Only %s left in stock', 'woovina'), $stock) . '</li>';
						} 
						else {
							echo '<li class="remaining">' . sprintf(__('%s in stock', 'woovina'), $stock) . '</li>';
						}
					}
				}
			}
		}
		
		/**
		 * Show product sold by - for Dokan
		 *
		 * @since 3.3
		 */
		public function dokan_sold_by() {
			if(!class_exists("WeDevs_Dokan") || !get_theme_mod('woovina_woo_dokan_author', false)) return;
			
			global $product;
            $seller		= get_post_field('post_author', $product->get_id());
            $author  	= get_user_by('id', $seller);
            $store_info = dokan_get_store_info($author->ID);
			
			if(! empty($store_info['store_name'])) { 
				echo '<li class="sold-by">' . sprintf(__('Sold by: <a href="%s">%s</a>', 'woovina'), dokan_get_store_url($author->ID), $author->display_name) . '</li>';
			}
		}
		
		/**
		 * Show/hide product sold number
		 *
		 * @since 4.3
		 */
		public function show_sold_count() {
			if(!get_theme_mod('woovina_woo_sold_number', false)) return;
			
			global $product;
			$units_sold = get_post_meta($product->id, 'total_sales', true);
			
			echo '<div class="units-sold">' . sprintf(__('%s Sold ', 'woovina'), $units_sold) . '</div>';
		}
		
		/**
		 * Show/hide New Badge
		 *
		 * @since 4.3
		 */  
		public function display_new_badge() {
			if(!get_theme_mod('woovina_woo_new_badge_icon', false)) return;
			
			global $product;
			
			$newness_days 	= 30;
			$created 		= strtotime($product->get_date_created());
			
			if((time() - (60 * 60 * 24 * $newness_days)) < $created) {
				echo '<span class="new-badge">' . esc_html__('New!', 'woovina') . '</span>';
			}
		}
		
		/**
		 * Show custom compare button in header
		 *
		 * @since 4.7.4
		 */
		function add_custom_compare_button(){
			global $yith_woocompare;

			if(is_admin() || is_null($yith_woocompare)) {
				return '';
			}

			$link  = $yith_woocompare->obj->view_table_url();
			$count = '<span class="cp-count">' . count($yith_woocompare->obj->products_list) . '</span>';
			
			return '<a href="' . $link . '" class="woovina-compare-header-icon yith-woocompare-open">' . $count . '</a>';
		}
	}
}
new WooVina_WooCommerce_Config();