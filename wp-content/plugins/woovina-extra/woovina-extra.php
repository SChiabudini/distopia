<?php
/**
 * Plugin Name:			WooVina Extra
 * Plugin URI:			https://woovina.com/extensions/woovina-extra
 * Description:			Add extra features like widgets, metaboxes, import/export and a panel to activate the premium extensions.
 * Version:				4.7.4
 * Author:				WooVina
 * Author URI:			https://woovina.com/
 * Requires at least:	5.0.0
 * Tested up to:		5.8.2
 * Requires PHP:       	7.4
 *
 * Text Domain: woovina-extra
 * Domain Path: /languages/
 *
 * @package WooVina_Extra
 * @category Core
 * @author WooVina
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

/**
 * Returns the main instance of WooVina_Extra to prevent the need to use globals.
 *
 * @since 1.3
 * @return object WooVina_Extra
 */
function WooVina_Extra() {
	return WooVina_Extra::instance();
} // End WooVina_Extra()

WooVina_Extra();

/**
 * @since 2.2
 * Execute do_shortcode functions in the theme
 */
function woovina_extra_run_shortcode($shortcode) {
	return do_shortcode($shortcode);
}
add_filter('woovina_run_shortcode', 'woovina_extra_run_shortcode');

/**
 * Main WooVina_Extra Class
 *
 * @class WooVina_Extra
 * @version	1.0
 * @since 1.0
 * @package	WooVina_Extra
 */
final class WooVina_Extra {
	/**
	 * WooVina_Extra The single instance of WooVina_Extra.
	 * @var 	object
	 * @access  private
	 * @since 	1.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0
	 */
	public $admin;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0
	 * @return  void
	 */
	public function __construct($widget_areas = array()) {
		$this->token 			= 'woovina-extra';
		$this->plugin_url 		= plugin_dir_url(__FILE__);
		$this->plugin_path 		= plugin_dir_path(__FILE__);
		$this->version 			= '4.7.4';

		define('WE_URL', $this->plugin_url);
		define('WE_PATH', $this->plugin_path);
		define('WE_VERSION', $this->version);
		define('WE_ADMIN_PANEL_HOOK_PREFIX', 'theme-panel_page_woovina-panel');

		// Elementor partner ID
		if(class_exists('Elementor\Plugin')
			&& ! defined('ELEMENTOR_PARTNER_ID')) {
			define('ELEMENTOR_PARTNER_ID', 2121);
		}

		// WooCommerce Wishlist partner ID
		if(class_exists('TInvWL_Wishlist')) {
			define('TINVWL_PARTNER', 'woovinaorg');
			define('TINVWL_CAMPAIGN', 'woovina_theme');
		}

		register_activation_hook(__FILE__, array($this, 'install'));

		add_action('init', array($this, 'load_plugin_textdomain'));

		// Setup all the things
		add_action('init', array($this, 'setup'));
		
		add_action('init', array( $this, 'updater' ), 1);
		
		// Menu icons
		$theme = wp_get_theme();
		if('WooVina' == $theme->name || 'woovina' == $theme->template) {			
			require_once(WE_PATH .'/includes/panel/theme-panel.php');
			require_once(WE_PATH .'/includes/panel/integrations-tab.php');
			require_once(WE_PATH .'/includes/panel/library.php');
			require_once(WE_PATH .'/includes/panel/library-shortcode.php');
			require_once(WE_PATH .'/includes/panel/licenses.php');
			require_once(WE_PATH .'/includes/panel/licenses-key.php');
			require_once(WE_PATH .'/includes/menu-icons/menu-icons.php');
			require_once(WE_PATH .'/includes/updater.php');
			
			// Outputs custom JS to the footer
			add_action('wp_footer', array($this, 'custom_js'), 9999);

			// Register Custom JS file
			add_action('init', array($this, 'register_custom_js'));

			// Move the Custom CSS section into the Custom CSS/JS section
			add_action('customize_register', array($this, 'customize_register'), 11);

			// Remove customizer unnecessary sections
			add_action('customize_register', array($this, 'remove_customize_sections'), 11);
		}

		// Load custom widgets
		add_action('widgets_init', array($this, 'custom_widgets'), 10);

		// Allow shortcodes in text widgets
		add_filter('widget_text', 'do_shortcode');

		// Allow for the use of shortcodes in the WordPress excerpt
		add_filter('the_excerpt', 'shortcode_unautop');
		add_filter('the_excerpt', 'do_shortcode');
	}

	/**
	 * Main WooVina_Extra Instance
	 *
	 * Ensures only one instance of WooVina_Extra is loaded or can be loaded.
	 *
	 * @since 1.0
	 * @static
	 * @see WooVina_Extra()
	 * @return Main WooVina_Extra instance
	 */
	public static function instance() {
		if(is_null(self::$_instance))
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()
	
	/**
	 * Initialize License Updater.
	 * Load Updater initialize.
	 * @return void
	 */
	public function updater() {
		// Plugin Updater Code
		if(class_exists('WooVina_Plugin_Updater')) {
			$license = new WooVina_Plugin_Updater(__FILE__, 'WooVina Extra', $this->version, 'WooVina Team');
		}
	}
	
	/**
	 * Load the localisation file.
	 * @access  public
	 * @since   1.0
	 * @return  void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain('woovina-extra', false, dirname(plugin_basename(__FILE__)) . '/languages/');
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0
	 */
	public function __clone() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), '1.0');
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0
	 */
	public function __wakeup() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), '1.0');
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 * @access  public
	 * @since   1.0
	 * @return  void
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0
	 * @return  void
	 */
	private function _log_version_number() {
		// Log the version number.
		update_option($this->token . '-version', $this->version);
	}
	
	/**
	 * All theme functions hook into the woovina_footer_js filter for this function.
	 *
	 * @since 1.3.8
	 */
	public static function custom_js($output = NULL) {

		// Add filter for adding custom js via other functions
		$output = apply_filters('woovina_footer_js', $output);

		// Minify and output JS in the wp_footer
		if(! empty($output)) { ?>

			<script type="text/javascript">

				/* WooVina JS */
				<?php echo WooVina_Extra_JSMin::minify($output); ?>

			</script>

		<?php
		}

	}

	/**
	 * Adds customizer options
	 *
	 * @since 1.3.8
	 */
	public function register_custom_js() {
		
		// Var
		$dir = WE_PATH .'/includes/';

		// File
		if(WooVina_Extra_Theme_Panel::get_setting('we_custom_code_panel')) {
			require_once($dir . 'custom-code.php');
		}

	}

	/**
	 * Move the Custom CSS section into the Custom CSS/JS section
	 *
	 * @since 1.3.8
	 */
	public static function customize_register($wp_customize) {

		// Move custom css setting
		$wp_customize->get_control('custom_css')->section = 'woovina_custom_code_panel';

	}

	/**
	 * Remove customizer unnecessary sections
	 *
	 * @since 1.0
	 */
	public static function remove_customize_sections($wp_customize) {

		// Remove core sections
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('themes');
		$wp_customize->remove_section('background_image');

		// Remove core controls
		$wp_customize->remove_control('header_textcolor');
		$wp_customize->remove_control('background_color');
		$wp_customize->remove_control('background_image');
		$wp_customize->remove_control('display_header_text');

		// Remove default settings
		$wp_customize->remove_setting('background_color');
		$wp_customize->remove_setting('background_image');

	}

	/**
	 * Setup all the things.
	 * Only executes if WooVina or a child theme using WooVina as a parent is active and the extension specific filter returns true.
	 * @return void
	 */
	public function setup() {
		$theme = wp_get_theme();

		if('WooVina' == $theme->name || 'woovina' == $theme->template) {
			require_once(WE_PATH .'/includes/metabox/butterbean/butterbean.php');
			require_once(WE_PATH .'/includes/metabox/metabox.php');
			require_once(WE_PATH .'/includes/metabox/shortcodes.php');
			require_once(WE_PATH .'/includes/metabox/gallery-metabox/gallery-metabox.php');
			require_once(WE_PATH .'/includes/shortcodes/shortcodes.php');
			require_once(WE_PATH .'/includes/image-resizer.php');
			require_once(WE_PATH .'/includes/jsmin.php');
			require_once(WE_PATH .'/includes/walker.php');
			require_once(WE_PATH .'/includes/panel/demos.php');
			
			add_action('wp_enqueue_scripts', array($this, 'scripts'), 999);
		}
	}

	/**
	 * Include flickr widget class
	 *
	 * @since   1.0
	 */
	public static function custom_widgets() {

		if(! version_compare(PHP_VERSION, '5.2', '>=')) {
			return;
		}

		// Define array of custom widgets for the theme
		$widgets = apply_filters('woovina_custom_widgets', array(
			'about-me',
			'contact-info',
			'custom-links',
			'custom-menu',
			'facebook',
			'flickr',
			'instagram',
			'mailchimp',
			'recent-posts',
			'social',
			'social-share',
			'tags',
			'twitter',
			'video',
			'custom-header-logo',
			'custom-header-nav',
		));

		// Loop through widgets and load their files
		if($widgets && is_array($widgets)) {
			foreach ($widgets as $widget) {
				$file = WE_PATH .'/includes/widgets/' . $widget .'.php';
				if(file_exists ($file)) {
					require_once($file);
				}
			}
		}

	}

	/**
	 * Enqueue scripts
	 *
	 * @since   1.0
	 */
	public function scripts() {

		// Load main stylesheet
		wp_enqueue_style('we-widgets-style', plugins_url('/assets/css/widgets.css', __FILE__));

		// If rtl
		if(is_RTL()) {
			wp_enqueue_style('we-widgets-style-rtl', plugins_url('/assets/css/rtl.css', __FILE__));
		}

	}

} // End Class

/**
 * Check link rel and return correct aria label
 * @since 4.7.0
 */

if ( ! function_exists( 'woovina_link_rel' ) ) {
	
	function woovina_link_rel( $woovina_srt, $nofollow, $target ) {
			
		if ( $nofollow === 'yes' ) {
			if ( $target === 'blank' ) {
				$link_rel = 'rel="nofollow noopener noreferrer"';
				$woovina_sr = $woovina_srt;
			} else {
				$link_rel = 'rel="nofollow"';
				$woovina_sr = '';
			}
		} elseif ( $nofollow === 'no' || $nofollow === '' ) {
			if ( $target === 'blank' ) {
				$link_rel = 'rel="noopener noreferrer"';
				$woovina_sr = $woovina_srt;
			} else {
				$link_rel = '';
				$woovina_sr = '';
			}
		}
	
		return array( $woovina_sr, $link_rel );
	}
}