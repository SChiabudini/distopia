<?php
/**
 * Plugin Name:			WooVina Elementor Widgets
 * Plugin URI:			https://woovina.com/extensions/woovina-elementor-widgets
 * Description:			Add some new widgets to the popular free page builder Elementor.
 * Version:				2.7.8
 * Author:				WooVina
 * Author URI:			https://woovina.com/
 * Requires at least:	5.0.0
 * Tested up to:		5.8.2
 * Elementor tested up to: 3.5.1
 * Elementor Pro tested up to: 3.5.2
 * Requires PHP:       	7.4
 *
 * Text Domain: woovina-elementor-widgets
 * Domain Path: /languages/
 *
 * @package WooVina_Elementor_Widgets
 * @category Core
 * @author WooVina
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

/**
 * Returns the main instance of WooVina_Elementor_Widgets to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object WooVina_Elementor_Widgets
 */
function WooVina_Elementor_Widgets() {
	return WooVina_Elementor_Widgets::instance();
} // End WooVina_Elementor_Widgets()

WooVina_Elementor_Widgets();

/**
 * Main WooVina_Elementor_Widgets Class
 *
 * @class WooVina_Elementor_Widgets
 * @version	1.0.0
 * @since 1.0.0
 * @package	WooVina_Elementor_Widgets
 */
final class WooVina_Elementor_Widgets {
	/**
	 * WooVina_Elementor_Widgets The single instance of WooVina_Elementor_Widgets.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->token 			= 'woovina-elementor-widgets';
		$this->plugin_url 		= plugin_dir_url(__FILE__);
		$this->plugin_path 		= plugin_dir_path(__FILE__);
		$this->version 			= '2.7.8';

		define('WEW_ELEMENTOR__FILE__', __FILE__);
		define('WEW_ELEMENTOR_PATH', $this->plugin_path);
		define('WEW_ELEMENTOR_VERSION', $this->version);

		register_activation_hook(__FILE__, array($this, 'install'));

		add_action('init', array($this, 'load_plugin_textdomain'));	
		add_action('plugins_loaded', array($this, 'setup'));
		add_action('init', array($this, 'updater'), 1);
		
		add_action('elementor/frontend/after_enqueue_scripts', array($this, 'enqueue_site_scripts'));
		add_action('elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_styles' ]);
	}
	
	/**
	 * Loading site related script that needs all time such as uikit.
	 * @return [type] [description]
	 */
	public function enqueue_site_scripts() {
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script('elementor-sticky', plugins_url('/assets/js/jquery.sticky' . $suffix . '.js', WEW_ELEMENTOR__FILE__), [ 'jquery' ], WEW_ELEMENTOR_VERSION);
		wp_enqueue_script('wew-frontend', plugins_url('/assets/js/wew-frontend' . $suffix . '.js', WEW_ELEMENTOR__FILE__), ['jquery', 'elementor-frontend'], WEW_ELEMENTOR_VERSION);
	}
	
	public function enqueue_styles() {
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style('wew-frontend', plugins_url('/assets/css/wew-frontend' . $suffix . '.css', WEW_ELEMENTOR__FILE__));
	}
	
	/**
	 * Initialize License Updater.
	 * Load Updater initialize.
	 * @return void
	 */
	public function updater() {
		// Plugin Updater Code
		if(class_exists('WooVina_Plugin_Updater')) {
			$license = new WooVina_Plugin_Updater(__FILE__, 'WooVina Elementor Widgets', $this->version, 'WooVina Team');
		}
	}

	/**
	 * Main WooVina_Elementor_Widgets Instance
	 *
	 * Ensures only one instance of WooVina_Elementor_Widgets is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see WooVina_Elementor_Widgets()
	 * @return Main WooVina_Elementor_Widgets instance
	 */
	public static function instance() {
		if(is_null(self::$_instance))
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain('woovina-elementor-widgets', false, dirname(plugin_basename(__FILE__)) . '/languages/');
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), '1.0.0');
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), '1.0.0');
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number() {
		// Log the version number.
		update_option($this->token . '-version', $this->version);
	}

	/**
	 * Setup all the things.
	 * Only executes if WooVina or a child theme using WooVina as a parent is active and the extension specific filter returns true.
	 * @return void
	 */
	public function setup() {
		$theme = wp_get_theme();

		if('WooVina' == $theme->name || 'woovina' == $theme->template) {
			require(WEW_ELEMENTOR_PATH .'includes/plugin.php');
			require_once(WEW_ELEMENTOR_PATH .'includes/helpers.php');
			require_once(WEW_ELEMENTOR_PATH .'includes/class-instagram-api.php');
			require_once(WEW_ELEMENTOR_PATH .'includes/class-integration.php');
			require_once(WEW_ELEMENTOR_PATH .'includes/class-recaptcha.php');
		}
	}

} // End Class