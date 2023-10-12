<?php
/**
 * Plugin Name: WooVina Hoang Sa Package
 * Plugin URI: https://woovina.com/demos/hoang-sa
 * Description: This plugin allows you to import all sample content, widgets, settings, CSS and JS of the demo Hoang Sa.
 * Version: 1.0.6
 * Tested up to:       	5.8.2
 * Requires at least:  	5.5
 * Requires PHP:       	7.4
 * Author: WooVina Team
 * Author URI: https://woovina.com
 * Text Domain: hoang-sa-package
 *
 * @package WooVina Hoang Sa Package
 */

// Exit if accessed directly
if(! defined('ABSPATH')) return;

// Define Single Package
if(! defined('WOOVINA_SINGLE_PACKAGE')) {
	define('WOOVINA_SINGLE_PACKAGE', true);
}
else {
	define('WOOVINA_SINGLE_DEACTIVATE', true);
	return;
}

/**
 * Returns the main instance of WooVina_Hoang_Sa_Package to prevent the need to use globals.
 *
 * @since 1.0.0
 * @return object WooVina_Hoang_Sa_Package
 */
function WooVina_Hoang_Sa_Package() {
	return WooVina_Hoang_Sa_Package::instance();
} // End WooVina_Hoang_Sa_Package()

WooVina_Hoang_Sa_Package();


/**
 * Main WooVina_Hoang_Sa_Package Class
 *
 * @class WooVina_Hoang_Sa_Package
 * @version	1.0.0
 * @since 1.0.0
 * @package	WooVina_Hoang_Sa_Package
 */
final class WooVina_Hoang_Sa_Package {
	/**
	 * WooVina_Hoang_Sa_Package The single instance of WooVina_Hoang_Sa_Package.
	 * @var 	object
	 * @access  private
	 * @since 	1.0
	 */
	private static $_instance = null;
	
	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0
	 * @return  void
	 */
	
	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0
	 */
	public $data;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0
	 */
	public $version;
	
	public function __construct() {
		define('WOOVINA_HOANG_SA_PACKAGE_FILE', __FILE__);
		define('WOOVINA_HOANG_SA_PACKAGE_BASE', plugin_basename(WOOVINA_HOANG_SA_PACKAGE_FILE));
		define('WOOVINA_HOANG_SA_PACKAGE_DIR',  plugin_dir_path(WOOVINA_HOANG_SA_PACKAGE_FILE));
		define('WOOVINA_HOANG_SA_PACKAGE_URI',  plugins_url('/', WOOVINA_HOANG_SA_PACKAGE_FILE));
		
		$this->version 			= '1.0.6';
		
		// Setup all the things
		add_action('init', array($this, 'setup'));
		
		// Deactivate other single package
		add_action('admin_notices', array($this, 'single_deactivate_notice'));
		
		// Prepare demo data
		add_filter('wvn_demos_data', array($this, 'data'));

		// Set CSS path for woocompare popup
		add_filter('woovina_woocompare_popup', function() { return WOOVINA_HOANG_SA_PACKAGE_URI . 'assets/css/'; });
		
		// Set update plugin
		add_action('init', array($this, 'updater'), 1);
	}
	
	/**
	 * Main WooVina_Hoang_Sa_Package Instance
	 *
	 * Ensures only one instance of WooVina_Hoang_Sa_Package is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see WooVina_Hoang_Sa_Package()
	 * @return Main WooVina_Hoang_Sa_Package instance
	 */
	public static function instance() {
		if(is_null(self::$_instance))
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()
	
	/**
	 * Setup all the things.
	 * Only executes if WooVina or a child theme using WooVina as a parent is active and the extension specific filter returns true.
	 * @return void
	 */
	public function setup() {
		$theme = wp_get_theme();
		
		if(('WooVina' == $theme->name || 'woovina' == $theme->template) && class_exists('WooVina_Theme_Licenses')) {
			$license = new WooVina_Theme_Licenses('Single Package Free', 'Hoang Sa');
			add_action('admin_notices', array($this, 'single_license_notice'));
			add_action('wp_enqueue_scripts', array($this, 'scripts'), 1000);			
		}
		else {
			add_action('admin_notices', array($this, 'woovina_required_notice'));
		}
	}
	
	/**
	 * Display notice message if WooVina theme isn't activate
	 *
	 * @since 1.0
	 */
	public function woovina_required_notice() {
		?>
		<div class="error is-dismissible">			
			<p><?php echo sprintf(
				esc_html__('Please activate %1$sWooVina Theme%2$s and all required plugins before activating this package.', 'woovina-hoang-sa-package'),
				'<strong>', '</strong>'); ?></p>
		</div>
		<?php
	}
	
	/**
	 * Display notice message if other packages activated
	 *
	 * @since 1.0
	 */
	public function single_deactivate_notice() {		
		if(!defined('WOOVINA_SINGLE_DEACTIVATE')) return;
		?>
		<div class="notice notice-warning woovina-demos-notice">
			<p><?php echo sprintf(
				esc_html__('You have installed %1$sWooVina Hoang Sa Package%2$s. So please deactivate other packages!!! %3$sDeactivate Now%4$s', 'woovina-hoang-sa-package'),
				'<strong>', '</strong>',
				'<a class="button button-primary" href="'.admin_url('plugins.php?s=Package&plugin_status=active').'">', '</a>'
				); ?></p>
		</div>
	<?php
	}
	
	/**
	 * Display notice message for license
	 *
	 * @since 1.0.3
	 */
	
	public function single_license_notice() {
		if(defined('WOOVINA_SINGLE_DEACTIVATE')) return;
		
		$license 			= get_option('edd_license_details');
		$license_details 	= (isset($license) && isset($license['woovina_hoang_sa'])) ? $license['woovina_hoang_sa'] : false;
		
		// Show activate license message
		if(false == $license_details || false != @$license_details->error): 
		?>
		<div class="notice notice-error">
			<p><?php echo sprintf(
				esc_html__('Please activate your %1$sHoang Sa%2$s license to Import Demo Content, Copyright Removal, and enable One-Click Updates! %3$sActivate Now%4$s', 'woovina-hoang-sa-package'),
				'<strong>', '</strong>',
				'<a class="button button-primary" href="'.admin_url('admin.php?page=woovina-panel-licenses').'">', '</a>'
				); ?></p>
		</div>
		<?php
		endif;
		
		// Show upgrade license message
		if((false != $license_details && false == @$license_details->error) && !$license_details->pro_plugins):
		?>
		<div class="notice notice-info is-dismissible">
			<p><?php echo sprintf(
				esc_html__('You are using the %1$sBasic Features & No Updates%2$s license. Please upgrade to use all Premium Features and get One-Click Updates! %3$sUpgrade Now%4$s', 'woovina-hoang-sa-package'),
				'<strong>', '</strong>',
				'<a class="button button-primary" target="_blank" href="https://woovina.com/demos/hoang-sa-subscription?ref=dashboard">', '</a>'
				); ?></p>
		</div>
		<?php
		endif;
	}
	
	/**
	 * Enqueue scripts
	 *
	 * @since   1.0.0
	 */
	public function scripts() {
		if('niche-03.css' != get_theme_mod('woovina_css_file')) return;

		// Only load font for logged user
		if(! is_user_logged_in()) {
			wp_deregister_style('dashicons');
		}

		wp_enqueue_style('woovina-niche', plugins_url('/assets/css/niche-03.css', __FILE__), false, $this->version);
		wp_enqueue_script('woovina-demo', plugins_url('/assets/js/niche-03.js', __FILE__), array('jquery'), $this->version, true);
	}
	
	/**
	 * Initialize License Updater.
	 * Load Updater initialize.
	 * @return void
	 */
	public function updater() {
		// Plugin Updater Code
		if(class_exists('WooVina_Plugin_Updater')) {
			$license = new WooVina_Plugin_Updater(__FILE__, 'WooVina Hoang Sa Package', $this->version, 'WooVina Team');
		}
	}
	
	/**
	 * Prepare data for this demo
	 * @return array
	 */
	public function data($data) {
		
		$data = array(
			'Hoang Sa' => array(
				'demo_class'        => 'free-demo',
				'xml_file'     		=> WOOVINA_HOANG_SA_PACKAGE_DIR . 'sample-data/niche_03_contents.xml',
				'theme_settings' 	=> WOOVINA_HOANG_SA_PACKAGE_URI . 'sample-data/niche_03_customizer.json',
				'widgets_file'  	=> WOOVINA_HOANG_SA_PACKAGE_URI . 'sample-data/niche_03_widgets.wie',				
				'preview_image'		=> WOOVINA_HOANG_SA_PACKAGE_URI . 'sample-data/niche-03.jpg',
				'preview_url'		=> 'https://niche-03.woovinafree.com/',
				'home_title'  		=> 'Home',
				'blog_title'  		=> 'Blog',
				'posts_to_show'  	=> '12',
				'elementor_width'  	=> '1190',
				'css_file'			=> 'niche-03.css',
				'woo_image_size'	=> '600',
				'woo_thumb_size'	=> '300',
				'woo_crop_width'	=> '3',
				'woo_crop_height'	=> '4',
				'required_plugins'  => array(
					'free' => array(
						array(
							'slug'  	=> 'elementor',
							'init'  	=> 'elementor/elementor.php',
							'name'  	=> 'Elementor',
						),
						array(
							'slug'  	=> 'woocommerce',
							'init'  	=> 'woocommerce/woocommerce.php',
							'name'  	=> 'WooCommerce',
						),
						array(
							'slug'  	=> 'contact-form-7',
							'init'  	=> 'contact-form-7/wp-contact-form-7.php',
							'name'  	=> 'Contact Form 7',
						),
						array(
                            'slug'      => 'ti-woocommerce-wishlist',
                            'init'      => 'ti-woocommerce-wishlist/ti-woocommerce-wishlist.php',
                            'name'      => 'TI WooCommerce Wishlist',
                        ),
                        array(
                            'slug'      => 'yith-woocommerce-compare',
                            'init'      => 'yith-woocommerce-compare/init.php',
                            'name'      => 'YITH WooCommerce Compare',
                        ),
					),
					'premium' => array(							
						array(
							'slug' 		=> 'woovina-product-sharing',
							'init' 		=> 'woovina-product-sharing/woovina-product-sharing.php',
							'name' 		=> 'WooVina Product Sharing',
						),
						array(
							'slug' 		=> 'woovina-popup-login',
							'init' 		=> 'woovina-popup-login/woovina-popup-login.php',
							'name' 		=> 'WooVina Popup Login',
						),
						array(
							'slug' 		=> 'woovina-woo-popup',
							'init' 		=> 'woovina-woo-popup/woovina-woo-popup.php',
							'name' 		=> 'WooVina Woo Popup',
						),
						array(
							'slug' 		=> 'woovina-sticky-header',
							'init' 		=> 'woovina-sticky-header/woovina-sticky-header.php',
							'name' 		=> 'WooVina Sticky Header',
						),
						array(
							'slug' 		=> 'woovina-preloader',
							'init'  	=> 'woovina-preloader/woovina-preloader.php',
							'name' 		=> 'WooVina Preloader',
						),
						array(
							'slug'  	=> 'woovina-variation-swatches',
							'init'  	=> 'woovina-variation-swatches/woovina-variation-swatches.php',
							'name'  	=> 'WooVina Variation Swatches',
						),
					),
				),
			),
		);
		
		return $data;
	}
}
