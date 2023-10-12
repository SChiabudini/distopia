<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WooVina WordPress theme
 */
 
// Core Constants
define('WOOVINA_THEME_DIR', get_template_directory());
define('WOOVINA_THEME_URI', get_template_directory_uri());

/*--- Remove Google Fonts ---*/
if(true == get_theme_mod('woovina_disable_elementor_google_font', true)) {
	add_filter('elementor/frontend/print_google_fonts', '__return_false');
}

/*--- Remove Awesome Fonts ---*/
if(true == get_theme_mod('woovina_disable_elementor_awesome_font', true)) {
	add_action('elementor/frontend/after_register_styles',function() {
		foreach(['solid', 'regular', 'brands'] as $style) {
			wp_deregister_style('elementor-icons-fa-' . $style);
		}
	}, 20);
}

/*--- Remove WooCommerce Block ---*/
if(true == get_theme_mod('woovina_disable_woocommerce_block', true)) {
	add_action('wp_enqueue_scripts', 'woovina_disable_woocommerce_block_styles');
	function woovina_disable_woocommerce_block_styles() {
		wp_dequeue_style('wc-blocks-style');
	}	
}

/*--- Disable Hearbeat ---*/
if(true == get_theme_mod('woovina_general_disable_heartbeat', true)) {
	add_action('init', 'woovina_stop_heartbeat', 1);
	function woovina_stop_heartbeat() {
		wp_deregister_script('heartbeat');
	}
}

/*--- Disable Ajax Call from WooCommerce on front page and posts ---*/
if(true == get_theme_mod('woovina_general_disable_wc_cart_fragments', true)) {
	add_action('wp_enqueue_scripts', 'woovina_dequeue_wc_cart_fragments', 11);
	function woovina_dequeue_wc_cart_fragments() {
		if(is_front_page() || is_single()) wp_dequeue_script('wc-cart-fragments');
	}
}

class WOOVINA_Theme_Class {

	/**
	 * Main Theme Class Constructor
	 *
	 * @since   1.0.0
	 */
	public function __construct() {

		// Define constants
		$this->woovina_constants();
		
		// Load required files.
		$this->woovina_has_setup();

		// Load framework classes
		add_action('after_setup_theme', array('WOOVINA_Theme_Class', 'classes'), 4);

		// Setup theme => add_theme_support, register_nav_menus, load_theme_textdomain, etc
		add_action('after_setup_theme', array('WOOVINA_Theme_Class', 'theme_setup'), 10);

		// Setup theme => Generate the custom CSS file
		add_action('admin_bar_init', array('WOOVINA_Theme_Class', 'save_customizer_css_in_file'), 9999);

		// register sidebar widget areas
		add_action('widgets_init', array('WOOVINA_Theme_Class', 'register_sidebars'));

		// Registers theme_mod strings into Polylang
		if(class_exists('Polylang')) {
			add_action('after_setup_theme', array('WOOVINA_Theme_Class', 'polylang_register_string'));
		}

		/** Admin only actions **/
		if(is_admin()) {						
			
			// Load scripts in the WP admin
			add_action('admin_enqueue_scripts', array('WOOVINA_Theme_Class', 'admin_scripts'));

			// Outputs custom CSS for the admin
			add_action('admin_head', array('WOOVINA_Theme_Class', 'admin_inline_css'));
			
			// Force WooVina welcome notice on theme activation.
			add_action('admin_notices', array('WOOVINA_Theme_Class', 'register_notices'));			
			
		/** Non Admin actions **/
		} else {

			// Load theme CSS
			add_action('wp_enqueue_scripts', array('WOOVINA_Theme_Class', 'theme_css'));

			// Load his file in last
			add_action('wp_enqueue_scripts', array('WOOVINA_Theme_Class', 'custom_style_css'), 9999);

			// Remove Customizer CSS script from Front-end
			add_action('init', array('WOOVINA_Theme_Class', 'remove_customizer_custom_css'));

			// Load theme js
			add_action('wp_enqueue_scripts', array('WOOVINA_Theme_Class', 'theme_js'));

			// Add a pingback url auto-discovery header for singularly identifiable articles
			add_action('wp_head', array('WOOVINA_Theme_Class', 'pingback_header'), 1);

			// Add meta viewport tag to header
			add_action('wp_head', array('WOOVINA_Theme_Class', 'meta_viewport'), 1);

			// Add an X-UA-Compatible header
			add_filter('wp_headers', array('WOOVINA_Theme_Class', 'x_ua_compatible_headers'));

			// Loads html5 shiv script
			add_action('wp_head', array('WOOVINA_Theme_Class', 'html5_shiv'));

			// Outputs custom CSS to the head
			add_action('wp_head', array('WOOVINA_Theme_Class', 'custom_css'), 9999);

			// Minify the WP custom CSS because WordPress doesn't do it by default
			add_filter('wp_get_custom_css', array('WOOVINA_Theme_Class', 'minify_custom_css'));

			// Alter the search posts per page
			add_action('pre_get_posts', array('WOOVINA_Theme_Class', 'search_posts_per_page'));			

			// Alter WP categories widget to display count inside a span
			add_filter('wp_list_categories', array('WOOVINA_Theme_Class', 'wp_list_categories_args'));

			// Add a responsive wrapper to the WordPress oembed output
			add_filter('embed_oembed_html', array('WOOVINA_Theme_Class', 'add_responsive_wrap_to_oembeds'), 99, 4);

			// Adds classes the post class
			add_filter('post_class', array('WOOVINA_Theme_Class', 'post_class'));

			// Add schema markup to the authors post link
			add_filter('the_author_posts_link', array('WOOVINA_Theme_Class', 'the_author_posts_link'));

			// Add support for Elementor Pro locations
			add_action('elementor/theme/register_locations', array('WOOVINA_Theme_Class', 'register_elementor_locations'));

			// Remove the default lightbox script for the beaver builder plugin
			add_filter('fl_builder_override_lightbox', array('WOOVINA_Theme_Class', 'remove_bb_lightbox'));			
			
			// Show copyright message for free subscription.
			add_action('woovina_copyright_removal', array('WOOVINA_Theme_Class', 'copyright_removal'));			
		}

	}

	/**
	 * Define Constants
	 *
	 * @since   1.0.0
	 */
	public static function woovina_constants() {

		$version = self::theme_version();

		// Theme version
		define('WOOVINA_THEME_VERSION', $version);

		// Javascript and CSS Paths
		define('WOOVINA_JS_DIR_URI', WOOVINA_THEME_URI .'/assets/js/');
		define('WOOVINA_CSS_DIR_URI', WOOVINA_THEME_URI .'/assets/css/');

		// Include Paths
		define('WOOVINA_INC_DIR', WOOVINA_THEME_DIR .'/inc/');
		define('WOOVINA_INC_DIR_URI', WOOVINA_THEME_URI .'/inc/');

		// Check if plugins are active
		define('WOOVINA_EXTRA_ACTIVE', class_exists('WooVina_Extra'));
		define('WOOVINA_ELEMENTOR_ACTIVE', class_exists('Elementor\Plugin'));
		define('WOOVINA_BEAVER_BUILDER_ACTIVE', class_exists('FLBuilder'));
		define('WOOVINA_WOOCOMMERCE_ACTIVE', class_exists('WooCommerce'));

	}

	/**
	 * Load all core theme function files
	 *
	 * @since 1.0.0
	 */
	public static function woovina_has_setup() {
		$dir = WOOVINA_INC_DIR;
		require_once($dir .'helpers.php');
		require_once($dir .'header-content.php');
		require_once($dir .'customizer/controls/typography/webfonts.php');
		require_once($dir .'walker/init.php');
		require_once($dir .'walker/menu-walker.php');
		require_once($dir .'third/class-gutenberg.php');
		require_once($dir .'third/class-elementor.php');
		require_once($dir .'third/class-beaver-themer.php');
		require_once($dir .'third/class-bbpress.php');
		require_once($dir .'third/class-buddypress.php');
		require_once($dir .'third/class-lifterlms.php');
		require_once($dir .'third/class-sensei.php');
		require_once($dir .'third/class-social-login.php');
		require_once($dir .'third/class-pwa.php');
		
		// WooCommerce
		if(WOOVINA_WOOCOMMERCE_ACTIVE) {
			require_once($dir .'woocommerce/woocommerce-config.php');
		}
	}

	/**
	 * Returns current theme version
	 *
	 * @since   1.0.0
	 */
	public static function theme_version() {

		// Get theme data
		$theme = wp_get_theme();

		// Return theme version
		return $theme->get('Version');

	}

	/**
	 * Load theme classes
	 *
	 * @since   1.0.0
	 */
	public static function classes() {

		// Admin only classes
		if(is_admin()) {

			// Recommend plugins
			require_once(WOOVINA_INC_DIR .'plugins/class-tgm-plugin-activation.php');
			require_once(WOOVINA_INC_DIR .'plugins/tgm-plugin-activation.php');
			require_once(WOOVINA_INC_DIR .'theme-update-checker.php');
			
			$theme_updater = new ThemeUpdateChecker('woovina', 'https://woovina.com/');
		}

		// Front-end classes
		else {

			// Breadcrumbs class
			require_once(WOOVINA_INC_DIR .'breadcrumbs.php');

		}

		// Customizer class
		require_once(WOOVINA_INC_DIR .'customizer/customizer.php');

	}

	/**
	 * Theme Setup
	 *
	 * @since   1.0.0
	 */
	public static function theme_setup() {

		// Load text domain
		load_theme_textdomain('woovina', WOOVINA_THEME_DIR .'/languages');

		// Get globals
		global $content_width;

		// Set content width based on theme's default design
		if(! isset($content_width)) {
			$content_width = 1200;
		}

		// Register navigation menus
		register_nav_menus(array(
			'topbar_menu'     	=> esc_html__('Top Bar', 'woovina'),
			'main_menu'       	=> esc_html__('Main', 'woovina'),
			'footer_menu'     	=> esc_html__('Footer', 'woovina'),
			'mobile_menu'     	=> esc_html__('Mobile Menu', 'woovina'),
			'mobile_categories' => esc_html__('Mobile Categories', 'woovina'),
			'mobile_navbar'   	=> esc_html__('Mobile Navbar', 'woovina')
		));

		// Adding Gutenberg support
		add_theme_support('gutenberg', array('wide-images' => true));

		// Enable support for Post Formats
		add_theme_support('post-formats', array('video', 'gallery', 'audio', 'quote', 'link'));

		// Enable support for <title> tag
		add_theme_support('title-tag');

		// Add default posts and comments RSS feed links to head
		add_theme_support('automatic-feed-links');

		// Enable support for Post Thumbnails on posts and pages
		add_theme_support('post-thumbnails');

		/**
		 * Enable support for header image
		 */
		add_theme_support('custom-header', apply_filters('woovina_custom_header_args', array(
			'width'              => 2000,
			'height'             => 1200,
			'flex-height'        => true,
			'video'              => true,
		)));

		/**
		 * Enable support for site logo
		 */
		add_theme_support('custom-logo', apply_filters('woovina_custom_logo_args', array(
			'height'      => 45,
			'width'       => 164,
			'flex-height' => true,
			'flex-width'  => true,
		)));

		/*
		 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'widgets',
		));

		// Declare WooCommerce support.
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');

		// Add editor style
		add_editor_style('assets/css/editor-style.min.css');

		// Declare support for selective refreshing of widgets.
		add_theme_support('customize-selective-refresh-widgets');

	}

	/**
	 * Adds the meta tag to the site header
	 *
	 * @since 1.1.0
	 */
	public static function pingback_header() {

		if(is_singular() && pings_open()) {
			printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
		}

	}

	/**
	 * Adds the meta tag to the site header
	 *
	 * @since 1.0.0
	 */
	public static function meta_viewport() {

		// Meta viewport
		$viewport = '<meta name="viewport" content="width=device-width, initial-scale=1">';

		// Apply filters for child theme tweaking
		echo apply_filters('woovina_meta_viewport', $viewport);

	}

	/**
	 * Load scripts in the WP admin
	 *
	 * @since 1.0.0
	 */
	public static function admin_scripts() {
		global $pagenow;
		if('nav-menus.php' == $pagenow) {
			wp_enqueue_style('woovina-menus', WOOVINA_INC_DIR_URI .'walker/assets/menus.css');
		}
	}

	/**
	 * Load front-end scripts
	 *
	 * @since   1.0.0
	 */
	public static function theme_css() {

		// Define dir
		$dir = WOOVINA_CSS_DIR_URI;
		$theme_version = WOOVINA_THEME_VERSION;

		// Remove font awesome style from plugins
		wp_deregister_style('font-awesome');
		wp_deregister_style('fontawesome');
		
		// Load font awesome 4 style
		wp_enqueue_style('fontawesome', $dir .'third/font-awesome.min.css', false, '4.7.0');
		
		// Load font awesome 5 style.
		wp_enqueue_style('font-awesome', WOOVINA_THEME_URI . '/assets/fonts/fontawesome/css/all.min.css', false, '5.15.1');		
		wp_enqueue_style('font-awesome-shims', WOOVINA_THEME_URI . '/assets/fonts/fontawesome/css/v4-shims.min.css', false, '5.15.1');		
		
		// Load animate style
		wp_enqueue_style('animate', $dir .'third/animate.css', false, '3.5.1');

		// Register simple line icons style
		wp_enqueue_style('simple-line-icons', $dir .'third/simple-line-icons.min.css', false, '2.4.0');
		
		// Register material design iconic font style
		wp_enqueue_style('material', $dir . 'third/material-design-iconic-font.min.css', array(), '2.2.0', 'all');
		
		// Register material design ionicons font style
		wp_enqueue_style('ionicons', $dir . 'third/ionicons.min.css', array(), '2.2.0', 'all');
		
		// Register the lightbox style
		wp_enqueue_style('magnific-popup', $dir .'third/magnific-popup.min.css', false, '1.0.0');

		// Main Style.css File
		wp_enqueue_style('woovina-style', $dir .'style.min.css', false, $theme_version);		

		// Register hamburgers buttons to easily use them
		wp_register_style('woovina-hamburgers', $dir .'third/hamburgers/hamburgers.min.css', false, $theme_version);

		// Register hamburgers buttons styles
		$hamburgers = woovina_hamburgers_styles();
		foreach ($hamburgers as $class => $name) {
			wp_register_style('woovina-'. $class .'', $dir .'third/hamburgers/types/'. $class .'.css', false, $theme_version);
		}

		// Get mobile menu icon style
		$mobileMenu = get_theme_mod('woovina_mobile_menu_open_hamburger', 'default');

		// Enqueue mobile menu icon style
		if(! empty($mobileMenu) && 'default' != $mobileMenu) {
			wp_enqueue_style('woovina-hamburgers');
			wp_enqueue_style('woovina-'. $mobileMenu .'');
		}

		// If Vertical header style
		if('vertical' == woovina_header_style()) {
			wp_enqueue_style('woovina-hamburgers');
			wp_enqueue_style('woovina-spin');
		}
		
		// Register the Mobile Navbar style
		wp_enqueue_style('mobile-navbar', $dir .'third/mobile-navbar.css', false, '1.0.0');
		
		// Set default CSS
		if(!get_theme_mod('woovina_css_file')) {
			set_theme_mod('woovina_css_file', 'niche-00.css');
		}
		
		// Load default Niche CSS file
		$woovina_css_file = get_theme_mod('woovina_css_file');
		$load_css_file    = ((strpos($woovina_css_file, 'niche-') !== false) || (strpos($woovina_css_file, 'demo-') !== false)) ? true : false;
		
		if($load_css_file && !defined('WOOVINA_SINGLE_PACKAGE')) {
			wp_enqueue_style('woovina-niche', 'https://repository.woovina.com/css/'. get_theme_mod('woovina_css_file'), false, $theme_version);
		}
	}

	/**
	 * Returns all js needed for the front-end
	 *
	 * @since 1.0.0
	 */
	public static function theme_js() {

		// Get js directory uri
		$dir = WOOVINA_JS_DIR_URI;

		// Get current theme version
		$theme_version = WOOVINA_THEME_VERSION;

		// Get localized array
		$localize_array = self::localize_array();

		// Comment reply
		if(is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

		// Add images loaded
		wp_enqueue_script('imagesloaded');

		// Register nicescroll script to use it in some extensions
		wp_register_script('nicescroll', $dir .'third/nicescroll.min.js', array('jquery'), $theme_version, true);

		// Enqueue nicescroll script if vertical header style
		if('vertical' == woovina_header_style()) {
			wp_enqueue_script('nicescroll');
		}

		// Register Infinite Scroll script
		wp_register_script('infinitescroll', $dir .'third/infinitescroll.min.js', array('jquery'), $theme_version, true);

		// WooCommerce scripts
		if(WOOVINA_WOOCOMMERCE_ACTIVE) {
			wp_enqueue_script('woovina-woocommerce', $dir .'third/woo/woo-scripts.min.js', array('jquery'), $theme_version, true);
		}

		// Load the lightbox scripts
		wp_enqueue_script('magnific-popup', $dir .'third/magnific-popup.min.js', array('jquery'), $theme_version, true);
		wp_enqueue_script('woovina-lightbox', $dir .'third/lightbox.min.js', array('jquery'), $theme_version, true);
		
		// Load the jQuery Countdown scripts
		wp_enqueue_script('jquery-plugin', $dir .'third/jquery.plugin.min.js', array('jquery'), $theme_version, true);
		wp_enqueue_script('jquery-countdown', $dir .'third/jquery.countdown.js', array('jquery'), $theme_version, true);
		
		// Load Mobile Navbar js
		wp_enqueue_script('mobile-navbar', $dir .'third/mobile-navbar.js', array('jquery'), $theme_version, true);
		
		// Load minified js
		wp_enqueue_script('woovina-main', $dir .'main.min.js', array('jquery'), $theme_version, true);
		
		// Localize array
		wp_localize_script('woovina-main', 'woovinaLocalize', $localize_array);
		
		// Load theme mod to get default css file
		if(!get_theme_mod('woovina_css_file')) {
			set_theme_mod('woovina_css_file', 'niche-00.css');
		}
		
		// Load custom JS for each specific demo
		$woovina_js_file = str_replace(".css", ".js", get_theme_mod('woovina_css_file'));
		$load_js_file    = ((strpos($woovina_js_file, 'niche-') !== false) || (strpos($woovina_js_file, 'demo-') !== false)) ? true : false;
		
		if($load_js_file && !defined('WOOVINA_SINGLE_PACKAGE')) {
			wp_enqueue_script('woovina-demo', 'https://repository.woovina.com/js/'. $woovina_js_file, array(), $theme_version, true);
		}
	}

	/**
	 * Functions.js localize array
	 *
	 * @since 1.0.0
	 */
	public static function localize_array() {

		// Create array
		$sidr_side 		= get_theme_mod('woovina_mobile_menu_sidr_direction', 'left');
		$sidr_side 		= $sidr_side ? $sidr_side : 'left';
		$sidr_target 	= get_theme_mod('woovina_mobile_menu_sidr_dropdown_target', 'icon');
		$sidr_target 	= $sidr_target ? $sidr_target : 'icon';
		$vh_target 		= get_theme_mod('woovina_vertical_header_dropdown_target', 'icon');
		$vh_target 		= $vh_target ? $vh_target : 'icon';
		$array = array(
			'isRTL'                 => is_rtl(),
			'menuSearchStyle'       => woovina_menu_search_style(),
			'sidrSource'       		=> woovina_sidr_menu_source(),
			'sidrDisplace'       	=> get_theme_mod('woovina_mobile_menu_sidr_displace', true) ? true : false,
			'sidrSide'       		=> $sidr_side,
			'sidrDropdownTarget'    => $sidr_target,
			'verticalHeaderTarget'  => $vh_target,
			'customSelects'         => '.woocommerce-ordering .orderby, #dropdown_product_cat, .widget_categories select, .widget_archive select, .single-product .variations_form .variations select',
		);

		// WooCart
		if(WOOVINA_WOOCOMMERCE_ACTIVE) {
			$array['wooCartStyle'] 	= woovina_menu_cart_style();
		}
		
		// Quick View Gallery Style
		$array['quickviewGalleryStyle'] = get_theme_mod('woovina_woo_quick_view_gallery', 'gallery-slider');
		$array['isMobile'] = (wp_is_mobile()) ? 'true' : 'false';
		
		// Apply filters and return array
		return apply_filters('woovina_localize_array', $array);
	}

	/**
	 * Add headers for IE to override IE's Compatibility View Settings
	 *
	 * @since 1.0.0
	 */
	public static function x_ua_compatible_headers($headers) {
		$headers['X-UA-Compatible'] = 'IE=edge';
		return $headers;
	}

	/**
	 * Load HTML5 dependencies for IE8
	 *
	 * @since 1.0.0
	 */
	public static function html5_shiv() {
		wp_register_script('html5shiv', WOOVINA_JS_DIR_URI . '/third/html5.min.js', array(), WOOVINA_THEME_VERSION, false);
		wp_enqueue_script('html5shiv');
		wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
	}

	/**
	 * Registers sidebars
	 *
	 * @since   1.0.0
	 */
	public static function register_sidebars() {

		// Right Sidebar
		register_sidebar(array(
			'name'			=> esc_html__('Right Sidebar', 'woovina'),
			'id'			=> 'sidebar',
			'description'	=> esc_html__('Widgets in this area are used in the right sidebar region.', 'woovina'),
			'before_widget'	=> '<div id="%1$s" class="sidebar-box %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		));

		// Left Sidebar
		register_sidebar(array(
			'name'			=> esc_html__('Left Sidebar', 'woovina'),
			'id'			=> 'sidebar-2',
			'description'	=> esc_html__('Widgets in this area are used in the left sidebar region.', 'woovina'),
			'before_widget'	=> '<div id="%1$s" class="sidebar-box %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		));

		// Search Results Sidebar
		if(get_theme_mod('woovina_search_custom_sidebar', true)) {
			register_sidebar(array(
				'name'			=> esc_html__('Search Results Sidebar', 'woovina'),
				'id'			=> 'search_sidebar',
				'description'	=> esc_html__('Widgets in this area are used in the search result page.', 'woovina'),
				'before_widget'	=> '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'	=> '</div>',
				'before_title'	=> '<h4 class="widget-title">',
				'after_title'	=> '</h4>',
			));
		}

		// Footer 1
		register_sidebar(array(
			'name'			=> esc_html__('Footer 1', 'woovina'),
			'id'			=> 'footer-one',
			'description'	=> esc_html__('Widgets in this area are used in the first footer region.', 'woovina'),
			'before_widget'	=> '<div id="%1$s" class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		));

		// Footer 2
		register_sidebar(array(
			'name'			=> esc_html__('Footer 2', 'woovina'),
			'id'			=> 'footer-two',
			'description'	=> esc_html__('Widgets in this area are used in the second footer region.', 'woovina'),
			'before_widget'	=> '<div id="%1$s" class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		));

		// Footer 3
		register_sidebar(array(
			'name'			=> esc_html__('Footer 3', 'woovina'),
			'id'			=> 'footer-three',
			'description'	=> esc_html__('Widgets in this area are used in the third footer region.', 'woovina'),
			'before_widget'	=> '<div id="%1$s" class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		));

		// Footer 4
		register_sidebar(array(
			'name'			=> esc_html__('Footer 4', 'woovina'),
			'id'			=> 'footer-four',
			'description'	=> esc_html__('Widgets in this area are used in the fourth footer region.', 'woovina'),
			'before_widget'	=> '<div id="%1$s" class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		));

	}

	/**
	 * Registers theme_mod strings into Polylang.
	 *
	 * @since 1.1.4
	 */
	public static function polylang_register_string() {

		if(function_exists('pll_register_string') && $strings = woovina_register_tm_strings()) {
			foreach($strings as $string => $default) {
				pll_register_string($string, get_theme_mod($string, $default), 'Theme Mod', true);
			}
		}

	}

	/**
	 * All theme functions hook into the woovina_head_css filter for this function.
	 *
	 * @since 1.0.0
	 */
	public static function custom_css($output = NULL) {
			    
	    // Add filter for adding custom css via other functions
		$output = apply_filters('woovina_head_css', $output);

		// If Custom File is selected
		if('file' == get_theme_mod('woovina_customzer_styling', 'head')) {

			global $wp_customize;
			$upload_dir = wp_upload_dir();

			// Render CSS in the head
			if(isset($wp_customize) || ! file_exists($upload_dir['basedir'] .'/woovina/custom-style.css')) {

				 // Minify and output CSS in the wp_head
				if(! empty($output)) {
					echo "<!-- WooVina CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags(woovina_minify_css($output)) . "\n</style>";
				}
			}

		} else {

			// Minify and output CSS in the wp_head
			if(! empty($output)) {
				echo "<!-- WooVina CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags(woovina_minify_css($output)) . "\n</style>";
			}

		}

	}

	/**
	 * Minify the WP custom CSS because WordPress doesn't do it by default.
	 *
	 * @since 1.1.9
	 */
	public static function minify_custom_css($css) {

		return woovina_minify_css($css);

	}

	/**
	 * Save Customizer CSS in a file
	 *
	 * @since 1.4.12
	 */
	public static function save_customizer_css_in_file($output = NULL) {

		// If Custom File is not selected
		if('file' != get_theme_mod('woovina_customzer_styling', 'head')) {
			return;
		}

		// Get all the customier css
	    $output = apply_filters('woovina_head_css', $output);

	    // Get Custom Panel CSS
	    $output_custom_css = wp_get_custom_css();

	    // Minified the Custom CSS
		$output .= woovina_minify_css($output_custom_css);
			
		// We will probably need to load this file
		require_once(ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php');
		
		global $wp_filesystem;
		$upload_dir = wp_upload_dir(); // Grab uploads folder array
		$dir = trailingslashit($upload_dir['basedir']) . 'woovina'. DIRECTORY_SEPARATOR; // Set storage directory path

		WP_Filesystem(); // Initial WP file system
		wp_mkdir_p($dir); // Make a new folder 'woovina' for storing our file if not created already.
		$wp_filesystem->put_contents($dir . 'custom-style.css', $output, 0644); // Store in the file.

	}

	/**
	 * Include Custom CSS file if present.
	 *
	 * @since 1.4.12
	 */
	public static function custom_style_css($output = NULL) {

		// If Custom File is not selected
		if('file' != get_theme_mod('woovina_customzer_styling', 'head')) {
			return;
		}

		global $wp_customize;
		$upload_dir = wp_upload_dir();

		// Get all the customier css
	    $output = apply_filters('woovina_head_css', $output);

	    // Get Custom Panel CSS
	    $output_custom_css = wp_get_custom_css();

	    // Minified the Custom CSS
		$output .= woovina_minify_css($output_custom_css);

		// Render CSS from the custom file
		if(! isset($wp_customize) && file_exists($upload_dir['basedir'] .'/woovina/custom-style.css') && ! empty($output)) { 
		    wp_enqueue_style('woovina-custom', trailingslashit($upload_dir['baseurl']) . 'woovina/custom-style.css', false, null);	    			
		}		
	}

	/**
	 * Remove Customizer style script from front-end
	 *
	 * @since 1.4.12
	 */
	public static function remove_customizer_custom_css() {

		// If Custom File is not selected
		if('file' != get_theme_mod('woovina_customzer_styling', 'head')) {
			return;
		}
		
		global $wp_customize;

		// Disable Custom CSS in the frontend head
		remove_action('wp_head', 'wp_custom_css_cb', 11);
		remove_action('wp_head', 'wp_custom_css_cb', 101);

		// If custom CSS file exists and NOT in customizer screen
		if(isset($wp_customize)) {
			add_action('wp_footer', 'wp_custom_css_cb', 9999);
		}
	}

	/**
	 * Adds inline CSS for the admin
	 *
	 * @since 1.0.0
	 */
	public static function admin_inline_css() {
		echo '<style>div#setting-error-tgmpa{display:block;}</style>';
	}


	/**
	 * Alter the search posts per page
	 *
	 * @since 1.3.7
	 */
	public static function search_posts_per_page($query) {
		$posts_per_page = get_theme_mod('woovina_search_post_per_page', '8');
		$posts_per_page = $posts_per_page ? $posts_per_page : '8';

		if($query->is_main_query() && is_search()) {
			$query->set('posts_per_page', $posts_per_page);
		}
	}

	/**
	 * Alter wp list categories arguments.
	 * Adds a span around the counter for easier styling.
	 *
	 * @since 1.0.0
	 */
	public static function wp_list_categories_args($links) {
		$links = str_replace('</a> (', '</a> <span class="cat-count-span">(', $links);
		$links = str_replace(')', ')</span>', $links);
		return $links;
	}

	/**
	 * Alters the default oembed output.
	 * Adds special classes for responsive oembeds via CSS.
	 *
	 * @since 1.0.0
	 */
	public static function add_responsive_wrap_to_oembeds($cache, $url, $attr, $post_ID) {

		// Supported video embeds
		$hosts = apply_filters('woovina_oembed_responsive_hosts', array(
			'vimeo.com',
			'youtube.com',
			'youtu.be',
			'blip.tv',
			'money.cnn.com',
			'dailymotion.com',
			'flickr.com',
			'hulu.com',
			'kickstarter.com',
			'vine.co',
			'soundcloud.com',
			'#http://((m|www)\.)?youtube\.com/watch.*#i',
			'#https://((m|www)\.)?youtube\.com/watch.*#i',
			'#http://((m|www)\.)?youtube\.com/playlist.*#i',
			'#https://((m|www)\.)?youtube\.com/playlist.*#i',
			'#http://youtu\.be/.*#i',
			'#https://youtu\.be/.*#i',
			'#https?://(.+\.)?vimeo\.com/.*#i',
			'#https?://(www\.)?dailymotion\.com/.*#i',
			'#https?://dai\.ly/*#i',
			'#https?://(www\.)?hulu\.com/watch/.*#i',
			'#https?://wordpress\.tv/.*#i',
			'#https?://(www\.)?funnyordie\.com/videos/.*#i',
			'#https?://vine\.co/v/.*#i',
			'#https?://(www\.)?collegehumor\.com/video/.*#i',
			'#https?://(www\.|embed\.)?ted\.com/talks/.*#i',
		));

		// Supports responsive
		$supports_responsive = false;

		// Check if responsive wrap should be added
		foreach($hosts as $host) {
			if(strpos($url, $host) !== false) {
				$supports_responsive = true;
				break; // no need to loop further
			}
		}

		// Output code
		if($supports_responsive) {
			return '<p class="responsive-video-wrap clr">' . $cache . '</p>';
		} else {
			return '<div class="woovina-oembed-wrap clr">' . $cache . '</div>';
		}

	}

	/**
	 * Adds extra classes to the post_class() output
	 *
	 * @since 1.0.0
	 */
	public static function post_class($classes) {

		// Get post
		global $post;

		// Add entry class
		$classes[] = 'entry';

		// Add has media class
		if(has_post_thumbnail()
			|| get_post_meta($post->ID, 'woovina_post_oembed', true)
			|| get_post_meta($post->ID, 'woovina_post_self_hosted_media', true)
			|| get_post_meta($post->ID, 'woovina_post_video_embed', true)
		) {
			$classes[] = 'has-media';
		}

		// Return classes
		return $classes;

	}

	/**
	 * Add schema markup to the authors post link
	 *
	 * @since 1.0.0
	 */
	public static function the_author_posts_link($link) {

		// Add schema markup
		$schema = woovina_get_schema_markup('author_link');
		if($schema) {
			$link = str_replace('rel="author"', 'rel="author" '. $schema, $link);
		}

		// Return link
		return $link;

	}

	/**
	 * Add support for Elementor Pro locations
	 *
	 * @since 1.5.6
	 */
	public static function register_elementor_locations($elementor_theme_manager) {
		$elementor_theme_manager->register_all_core_location();
	}

	/**
	 * Add schema markup to the authors post link
	 *
	 * @since 1.1.5
	 */
	public static function remove_bb_lightbox() {
		return true;
	}
	
	/**
	 * Show notice message
	 *
	 * @since 4.5.3
	 */
	public static function register_notices() {
		if('1' !== get_option('fresh_site') || !current_user_can('install_plugins')) return;
		if(defined('WOOVINA_SITES_NAME') || defined('WOOVINA_SITES_PRO_NAME') || defined('WC_STARTER_SITES_NAME')) return;
		if(!empty(apply_filters('wvn_demos_data', array()))) return;
		?>
		<div id="woovina-admin-notice" class="updated notice is-dismissible" style="padding-top: 10px;">
			<strong style="font-size: 16px;"><?php _e('Thank you for installing WooVina theme!', 'woovina'); ?></strong>
			<p style="font-size: 14px;"><?php echo sprintf(
					__('Did you know WooVina comes with %1$s85+ Starter Sites%2$s and %3$s15+ Free Child Themes%4$s?<br>You can use our pre-built website templates to build your own website instead of starting everything from scratch!', 'woovina'),
					'<strong>','</strong>', '<strong>','</strong>'
				); ?>
				</p>
			<p><a class="btn button-primary" target="_blank" href="https://woovina.com/demos?ref=dashboard"><?php _e('Browse 85+ Starter Sites', 'woovina'); ?></a> <a class="btn button-secondary" target="_blank" href="https://woovina.com/child-themes?ref=dashboard"><?php _e('Browse 15+ Free Child Themes', 'woovina'); ?></a></p>
		</div>
		<?php
	}
	
	/**
	 * Show activate message
	 *
	 * @since 4.5.3
	 */
	public static function activate_license() {		
		$license = get_option('edd_domain_infos');
		if(is_child_theme() || ($license && (isset($license['license']) && $license['license']))) return;
		?>
		<div id="woovina-admin-notice" class="updated notice is-dismissible" style="padding-top: 10px;">
			<strong style="font-size: 16px;"><?php _e('Thank you for using WooVina theme!', 'woovina'); ?></strong>
			<p><?php _e('Please activate your license to get feature updates, premium support and branding/copyright removal!', 'woovina'); ?>
					<br><?php echo sprintf(
						__('If you don\'t have any license key, you can %1$sget a FREE license here%2$s.', 'woovina'),
						'<a href="https://woovina.com/member/register" target="_blank" title="Click to get FREE license key!">',
						'</a>'
					); ?></p>
				<p><a class="btn button-primary" href="<?php echo admin_url('admin.php?page=woovina-panel-licenses'); ?>"><?php _e('Activate Now', 'woovina'); ?></a></p>
		</div>
		<?php
	}
	
	
	/**
	 * Show copyright message
	 *
	 * @since 4.5.3
	 */
	public static function copyright_removal() {
		$license = get_option('edd_domain_infos');
		$credit  = (isset($license) && $license) ? $license['show_credit'] : true;
		
		$woovina_css_file = get_theme_mod('woovina_css_file');
		$show_copyright   = ((strpos($woovina_css_file, 'niche-') !== false) || (strpos($woovina_css_file, 'demo-') !== false)) ? true : false;
		
		if(!$credit || 'niche-00.css' == get_theme_mod('woovina_css_file') || (is_child_theme() && !$show_copyright)) return;
		echo '<div id="woovina-copyright" class="hide-tablet hide-mobile">Powered by <br><a href="https://woovina.com/" title="Free WooCommerce WordPress Theme">WooVina Theme</a></div>';	
	}
}
$woovina_theme_class = new WOOVINA_Theme_Class;

/**
 * @since 2.2
 * Execute shortcode functions in the theme
 */
function woovina_shortcode($shortcode) {
	
	if(has_filter('woovina_run_shortcode')) {
		$shortcode = apply_filters('woovina_run_shortcode', $shortcode);
	}
	
	return $shortcode;
}
