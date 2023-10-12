<?php
/**
 * Demos
 *
 * @package WooVina_Extra
 * @category Core
 * @author WooVina
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Start Class
if(! class_exists('WooVina_Demos')) {

	class WooVina_Demos {

		/**
		 * Start things up
		 */
		public function __construct() {

			// Return if not in admin
			if(! is_admin() || is_customize_preview()) {
				return;
			}

			// Import demos page
			if(version_compare(PHP_VERSION, '5.4', '>=')) {
				require_once(WE_PATH .'/includes/panel/classes/importers/class-helpers.php');
				require_once(WE_PATH .'/includes/panel/classes/class-install-demos.php');
			}

			// Disable Woo Wizard
			add_filter('woocommerce_enable_setup_wizard', '__return_false');
			add_filter('woocommerce_show_admin_notice', '__return_false');
			add_filter('woocommerce_prevent_automatic_wizard_redirect', '__return_false');

			// Start things
			add_action('admin_init', array($this, 'init'));

			// Demos scripts
			add_action('admin_enqueue_scripts', array($this, 'scripts'));

			// Allows xml uploads
			add_filter('upload_mimes', array($this, 'allow_xml_uploads'));

			// Demos popup
			add_action('admin_footer', array($this, 'popup'));

			// Display notice if the Demo Import and Pro Demos are activated
			if(class_exists('WooVina_Demo_Import')
				&& class_exists('WooVina_Pro_Demos')) {
				add_action('admin_notices', array($this, 'demos_notice'));
	            add_action('admin_init', array($this, 'dismiss_demos_notice'));
	        }

		}

		/**
		 * Register the AJAX methods
		 *
		 * @since 1.0.0
		 */
		public function init() {

			// Demos popup ajax
			add_action('wp_ajax_wvn_ajax_get_demo_data', array($this, 'ajax_demo_data'));
			add_action('wp_ajax_wvn_ajax_required_plugins_activate', array($this, 'ajax_required_plugins_activate'));

			// Get data to import
			add_action('wp_ajax_wvn_ajax_get_import_data', array($this, 'ajax_get_import_data'));

			// Import XML file
			add_action('wp_ajax_wvn_ajax_import_xml', array($this, 'ajax_import_xml'));

			// Import customizer settings
			add_action('wp_ajax_wvn_ajax_import_theme_settings', array($this, 'ajax_import_theme_settings'));

			// Import widgets
			add_action('wp_ajax_wvn_ajax_import_widgets', array($this, 'ajax_import_widgets'));
			
			// Import forms
			add_action('wp_ajax_wvn_ajax_import_forms', array($this, 'ajax_import_forms'));
			
			// After import
			add_action('wp_ajax_wvn_after_import', array($this, 'ajax_after_import'));
			
			// Install Premium Plugins
			add_action('wp_ajax_wvn_ajax_install_plugin', array($this, 'ajax_install_plugin'));
		}
		
		/**
		 * AJAX Install WooVina Premium Plugins
		 *
		 * @since 1.0.2
		 */
		public static function ajax_install_plugin() {
			if(! current_user_can('install_plugins') || ! isset($_POST['init']) || ! $_POST['init']) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => __('No plugin specified', 'woovina-extra'),
					)
				);
			}

			require_once ABSPATH .'wp-admin/includes/misc.php';
			require_once ABSPATH .'wp-admin/includes/file.php';
			require_once ABSPATH .'wp-admin/includes/class-wp-upgrader.php';
			require_once ABSPATH .'wp-admin/includes/class-plugin-upgrader.php';
			require_once ABSPATH .'wp-admin/includes/class-theme-upgrader.php';
			
			$license 	 = get_option('edd_domain_infos');			
			$license_key = (isset($license) && isset($license['license_key'])) ? $license['license_key'] : false;			
			$plugin_slug = (isset($_POST['slug'])) ? esc_attr($_POST['slug']) : '';
			$plugin_init = (isset($_POST['init'])) ? esc_attr($_POST['init']) : '';
			$plugin_path = WP_PLUGIN_DIR . '/' . $plugin_init;
			
			if(!file_exists($plugin_path)) {
				
				// Data to send to the API
				$api_params = array(
					'edd_action'  => 'install_plugin',
					'license'     => $license_key,					
					'plugin_slug' => $plugin_slug,
					'url'         => home_url()
				);
				
				// Call the API
				$response = wp_remote_post(
					'https://woovina.com/',
					array(
						'timeout'   => 15,
						'sslverify' => false,
						'body'      => $api_params
					)
				);
								
				$response_data = json_decode(wp_remote_retrieve_body($response));
				$plugin_source = $response_data->download_url;
				
				if(is_wp_error($response) || empty($plugin_source)) {
					wp_send_json_error(
						array(
							'success' => false,
							'message' => __('No plugin specified', 'woovina-extra'),
						)
					);
				}
				
				$upgrader = new Plugin_Upgrader(new Plugin_Installer_Skin(compact('type', 'title', 'nonce', 'url')));
				$result   = $upgrader->install($plugin_source);				
			}
			
			activate_plugin($plugin_path);
			
			wp_send_json_success(
				array(
					'success' => true,
					'message' => __('Plugin Successfully Activated', 'woovina-extra'),
				)
			);
		}
		
		/**
		 * Load scripts
		 *
		 * @since 1.0
		 */
		public static function scripts($hook_suffix) {

			if('theme-panel_page_woovina-panel-install-demos' == $hook_suffix) {

				// CSS
				wp_enqueue_style('wvn-demos-style', plugins_url('/assets/css/demos.min.css', __FILE__));

				// JS
				wp_enqueue_script('wvn-demos-js', plugins_url('/assets/js/demos.min.js', __FILE__), array('jquery', 'wp-util', 'updates'), '1.0', true);

				wp_localize_script('wvn-demos-js', 'wvnDemos', array(
					'ajaxurl' 					=> admin_url('admin-ajax.php'),
					'demo_data_nonce' 			=> wp_create_nonce('get-demo-data'),
					'wvn_import_data_nonce' 	=> wp_create_nonce('wvn_import_data_nonce'),
					'content_importing_error' 	=> esc_html__('There was a problem during the importing process resulting in the following error from your server:', 'woovina-extra'),
					'button_activating' 		=> esc_html__('Activating', 'woovina-extra') . '&hellip;',
					'button_active' 			=> esc_html__('Active', 'woovina-extra'),
				));

			}

		}

		/**
		 * Allows xml uploads so we can import from github
		 *
		 * @since 1.0.0
		 */
		public function allow_xml_uploads($mimes) {
			$mimes = array_merge($mimes, array(
				'xml' 	=> 'application/xml'
			));
			return $mimes;
		}

	    /**
	     * Display notice if the Demo Import and Pro Demos are activatede
	     *
		 * @since 1.0
	     */
	    public static function demos_notice() {
	    	global $pagenow;

	        if('1' === get_option('wvn_dismiss_demos_notice')
	            || ! current_user_can('manage_options')) {
	            return;
	        }

	        // Display on the plugins and demos pages
	        if('plugins.php' == $pagenow
	            || ('admin.php' == $pagenow && (isset($_GET['page']) && 'woovina-panel-install-demos' == $_GET['page']))) {

		        $dismiss = wp_nonce_url(add_query_arg('wvn_demos_notice', 'dismiss_btn'), 'dismiss_btn'); ?>
		        
		        <div class="notice notice-warning wvn-demos-notice">
		        	<p><?php echo sprintf(
		        		esc_html__('As you use %1$sWooVina Pro Demos%2$s, you don&rsquo;t need to use the %3$sWooVina Demo Import%4$s plugin anymore, you can disable it. %5$sDismiss this notice%6$s.', 'woovina-extra'),
		        		'<strong>', '</strong>',
		        		'<strong>', '</strong>',
		        		'<a href="'. $dismiss .'">', '</a>'
		        		); ?></p>
		        </div>

	    	<?php
	    	}
	    }

	    /**
	     * Dismiss demos admin notice
	     *
		 * @since 1.0
	     */
	    public static function dismiss_demos_notice() {
	        if(! isset($_GET['wvn_demos_notice'])) {
	            return;
	        }

	        if('dismiss_btn' === $_GET['wvn_demos_notice']) {
	            check_admin_referer('dismiss_btn');
	            update_option('wvn_dismiss_demos_notice', '1');
	        }

	        wp_redirect(remove_query_arg('wvn_demos_notice'));
	        exit;
	    }

		/**
		 * Get demos data to add them in the Demo Import and Pro Demos plugins
		 *
		 * @since 1.0
		 */
		public static function get_demos_data() {

			return apply_filters('wvn_demos_data', array());

		}

		/**
		 * Get the category list of all categories used in the predefined demo imports array.
		 *
		 * @since 1.0
		 */
		public static function get_demo_all_categories($demo_imports) {
			$categories = array();

			foreach ($demo_imports as $item) {
				if(! empty($item['categories']) && is_array($item['categories'])) {
					foreach ($item['categories'] as $category) {
						$categories[ sanitize_key($category) ] = $category;
					}
				}
			}

			if(empty($categories)) {
				return false;
			}

			return $categories;
		}

		/**
		 * Return the concatenated string of demo import item categories.
		 * These should be separated by comma and sanitized properly.
		 *
		 * @since 1.0
		 */
		public static function get_demo_item_categories($item) {
			$sanitized_categories = array();

			if(isset($item['categories'])) {
				foreach ($item['categories'] as $category) {
					$sanitized_categories[] = sanitize_key($category);
				}
			}

			if(! empty($sanitized_categories)) {
				return implode(',', $sanitized_categories);
			}

			return false;
		}

	    /**
	     * Demos popup
	     *
		 * @since 1.0
	     */
	    public static function popup() {
	    	global $pagenow;

	        // Display on the demos pages
	        if(('admin.php' == $pagenow && (isset($_GET['page']) && 'woovina-panel-install-demos' == $_GET['page']))
	            || ('admin.php' == $pagenow && (isset($_GET['page']) && 'woovina-panel-pro-demos' == $_GET['page']))) { ?>
		        
		        <div id="wvn-demo-popup-wrap">
					<div class="wvn-demo-popup-container">
						<div class="wvn-demo-popup-content-wrap">
							<div class="wvn-demo-popup-content-inner">
								<a href="#" class="wvn-demo-popup-close">×</a>
								<div id="wvn-demo-popup-content"></div>
							</div>
						</div>
					</div>
					<div class="wvn-demo-popup-overlay"></div>
				</div>

	    	<?php
	    	}
	    }

		/**
		 * Demos popup ajax.
		 *
		 * @since 1.0
		 */
		public static function ajax_demo_data() {

			if(! wp_verify_nonce($_GET['demo_data_nonce'], 'get-demo-data')) {
				die('This action was stopped for security purposes.');
			}

			// Database reset url
			if(is_plugin_active('wp-reset/wp-reset.php')) {
				$plugin_link 	= admin_url('tools.php?page=wp-reset');
			} else {
				$plugin_link 	= admin_url('plugin-install.php?s=Wordpress+Database+Reset&tab=search');
			}

			// Get all demos
			$demos = self::get_demos_data();

			// Get selected demo
			$demo = $_GET['demo_name'];

			// Get required plugins
			$plugins = $demos[$demo][ 'required_plugins' ];

			// Get free plugins
			$free = $plugins[ 'free' ];

			// Get premium plugins
			$premium = $plugins[ 'premium' ];
			
			// Check demo access
			$demo_class 	= isset($demos[$demo]['demo_class']) ? $demos[$demo]['demo_class'] : 'free-demo';						
			$demo_access 	= self::demo_access($demo_class, $demo);
			$premium_access = self::premium_access($demo);
			?>

			<div id="wvn-demo-plugins">

				<h2 class="title"><?php echo sprintf(esc_html__('Import the %1$s demo', 'woovina-extra'), esc_attr($demo)); ?></h2>
				
				<?php if('inactivate' != $demo_access) { ?>
				<div class="wvn-popup-text">

					<p><?php echo
						sprintf(
							esc_html__('For your site to look exactly like this demo, the plugins below need to be activated. %1$sNOTE: You should install or activate only one plugin at a time!', 'woovina-extra'),
							'<br>'						
						); ?></p>
					
					<div class="wvn-required-plugins-wrap">
					
						<h3 class="status-ready"><?php esc_html_e('Required Plugins', 'woovina-extra'); ?> <span><?php esc_html_e('Ready', 'woovina-extra'); ?></span></h3>
						<div class="wvn-required-plugins we-plugin-installer">
							<?php self::required_plugins($free, 'free', $demo); ?>
						</div>
						
						<?php if(count($premium)): ?>
							<?php if($premium_access){ ?>
							<h3 class="status-ready"><?php esc_html_e('Premium Plugins', 'woovina-extra'); ?> <span><?php esc_html_e('Ready', 'woovina-extra'); ?></span></h3>
							<?php } else { ?>
							<h3 class="status-need-activate"><?php esc_html_e('Premium Plugins', 'woovina-extra'); ?> <span><?php esc_html_e('Need Activate', 'woovina-extra'); ?></span></h3>
							<?php } ?>
							<div class="wvn-required-plugins we-plugin-installer">
								<?php self::required_plugins($premium, 'premium', $demo); ?>
							</div>
						<?php endif; ?>
					</div>

				</div>

				<a class="wvn-button wvn-plugins-next" href="#"><?php esc_html_e('Go to the next step', 'woovina-extra'); ?></a>
				
				<?php } else { ?>
				
				<div class="wvn-popup-text">
					<p><?php esc_html_e('You have not activated your license, or your license does not have permission to import this demo. Please click the button below to activate or update your license!', 'woovina-extra'); ?></p>
				</div>
				
				<a class="wvn-button" href="admin.php?page=woovina-panel-licenses"><?php esc_html_e('Activate License Now', 'woovina-extra'); ?></a>
				
				<?php } ?>
				
			</div>

			<form method="post" id="wvn-demo-import-form">

				<input id="wvn_import_demo" type="hidden" name="wvn_import_demo" value="<?php echo esc_attr($demo); ?>" />

				<div class="wvn-demo-import-form-types">

					<h2 class="title"><?php esc_html_e('Select what you want to import:', 'woovina-extra'); ?></h2>
					
					<ul class="wvn-popup-text">
						<li>
							<label for="wvn_import_xml">
								<input id="wvn_import_xml" type="checkbox" name="wvn_import_xml" checked="checked" />
								<strong><?php esc_html_e('Import XML Data', 'woovina-extra'); ?></strong> (<?php esc_html_e('pages, posts, images, menus, etc...', 'woovina-extra'); ?>)
							</label>
						</li>

						<li>
							<label for="wvn_theme_settings">
								<input id="wvn_theme_settings" type="checkbox" name="wvn_theme_settings" checked="checked" />
								<strong><?php esc_html_e('Import Customizer Settings', 'woovina-extra'); ?></strong>
							</label>
						</li>

						<li>
							<label for="wvn_import_widgets">
								<input id="wvn_import_widgets" type="checkbox" name="wvn_import_widgets" checked="checked" />
								<strong><?php esc_html_e('Import Widgets', 'woovina-extra'); ?></strong>
							</label>
						</li>
						
						<?php if(isset($demos[$demo]['form_file'])): ?>
						<li>
							<label for="wvn_import_forms">
								<input id="wvn_import_forms" type="checkbox" name="wvn_import_forms" checked="checked" />
								<strong><?php esc_html_e('Import Contact Form', 'woovina-extra'); ?></strong>
							</label>
						</li>
						<?php endif; ?>
					</ul>

				</div>
				
				<?php wp_nonce_field('wvn_import_demo_data_nonce', 'wvn_import_demo_data_nonce'); ?>
				<input type="submit" name="submit" class="wvn-button wvn-import" value="<?php esc_html_e('Install this demo', 'woovina-extra'); ?>"  />

			</form>

			<div class="wvn-loader">
				<h2 class="title"><?php esc_html_e('The import process could take some time, please be patient', 'woovina-extra'); ?></h2>
				<div class="wvn-import-status wvn-popup-text"></div>
			</div>

			<div class="wvn-last wvn-success">
				<div class="wvn-notice">
					<h3><?php esc_html_e('Demo Imported!', 'woovina-extra'); ?></h3>
					<p><?php esc_html_e('But you need to replace URLs in Elementor', 'woovina-extra'); ?></p>
					<ul>
						<li><?php esc_html_e('Old URL:', 'woovina-extra'); ?> <strong><?php echo $demos[$demo]['preview_url']; ?></strong></li>
						<li><?php esc_html_e('New URL:', 'woovina-extra'); ?> <strong><?php echo home_url('/'); ?></strong></li>
					</ul>
					<a href="admin.php?page=elementor-tools#tab-replace_url" target="_blank"><?php esc_html_e('Replace URLs', 'woovina-extra'); ?></a>
				</div>
				
				<div class="wvn-checkmark">
					<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"></circle><path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path></svg>					
				</div>
			</div>
			
			<div class="wvn-last wvn-error">				
				<h3><?php esc_html_e('Demo is not Fully Imported!', 'woovina-extra'); ?></h3>
				<a href="https://woovina.com/docs/getting-started/demo-is-not-fully-imported" target="_blank"><?php esc_html_e('See how to fix', 'woovina-extra'); ?></a>
			</div>

			<?php
			die();
		}

		/**
		 * Required plugins.
		 *
		 * @since 1.0
		 */
		public static function required_plugins($plugins, $return, $demo) {

			foreach ($plugins as $key => $plugin) {

				$api = array(
					'slug' 	=> isset($plugin['slug']) ? $plugin['slug'] : '',
					'init' 	=> isset($plugin['init']) ? $plugin['init'] : '',
					'name' 	=> isset($plugin['name']) ? $plugin['name'] : '',
				);

				if(! is_wp_error($api)) { // confirm error free

					// Installed but Inactive.
					if(file_exists(WP_PLUGIN_DIR . '/' . $plugin['init']) && is_plugin_inactive($plugin['init'])) {

						$button_classes = 'button activate-now button-primary';
						$button_text 	= esc_html__('Activate', 'woovina-extra');

					// Not Installed.
					} elseif(! file_exists(WP_PLUGIN_DIR . '/' . $plugin['init'])) {

						$button_classes = 'button install-now';
						$button_text 	= esc_html__('Install Now', 'woovina-extra');

					// Active.
					} else {
						$button_classes = 'button disabled';
						$button_text 	= esc_html__('Activated', 'woovina-extra');
					} ?>

					<div class="wvn-plugin wvn-clr wvn-plugin-<?php echo $api['slug']; ?>" data-slug="<?php echo $api['slug']; ?>" data-init="<?php echo $api['init']; ?>">
						<h2><?php echo $api['name']; ?></h2>

						<?php
						// If premium plugins and not installed
						if('premium' == $return) { 							
						$premium_access = self::premium_access($demo);
						$button_classes = ($premium_access) ? $button_classes : 'button disabled';
						?>
							<button class="<?php echo $button_classes; ?>" data-type="premium" data-init="<?php echo $api['init']; ?>" data-slug="<?php echo $api['slug']; ?>" data-name="<?php echo $api['name']; ?>"><?php echo $button_text; ?></button>
						<?php
						} else { ?>
							<button class="<?php echo $button_classes; ?>" data-type="free" data-init="<?php echo $api['init']; ?>" data-slug="<?php echo $api['slug']; ?>" data-name="<?php echo $api['name']; ?>"><?php echo $button_text; ?></button>
						<?php
						} ?>
					</div>

				<?php
				}
			}

		}

		/**
		 * Required plugins activate
		 *
		 * @since 1.0
		 */
		public function ajax_required_plugins_activate() {

			if(! current_user_can('install_plugins') || ! isset($_POST['init']) || ! $_POST['init']) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => __('No plugin specified', 'woovina-extra'),
					)
				);
			}

			$plugin_init = (isset($_POST['init'])) ? esc_attr($_POST['init']) : '';
			$activate 	 = activate_plugin($plugin_init, '', false, true);

			if(is_wp_error($activate)) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => $activate->get_error_message(),
					)
				);
			}

			wp_send_json_success(
				array(
					'success' => true,
					'message' => __('Plugin Successfully Activated', 'woovina-extra'),
				)
			);

		}

		/**
		 * Returns an array containing all the importable content
		 *
		 * @since 1.0
		 */
		public function ajax_get_import_data() {
			check_ajax_referer('wvn_import_data_nonce', 'security');

			echo json_encode(
				array(
					array(
						'input_name' 	=> 'wvn_import_xml',
						'action' 		=> 'wvn_ajax_import_xml',
						'method' 		=> 'ajax_import_xml',
						'loader' 		=> esc_html__('Importing XML Data', 'woovina-extra')
					),

					array(
						'input_name' 	=> 'wvn_theme_settings',
						'action' 		=> 'wvn_ajax_import_theme_settings',
						'method' 		=> 'ajax_import_theme_settings',
						'loader' 		=> esc_html__('Importing Customizer Settings', 'woovina-extra')
					),

					array(
						'input_name' 	=> 'wvn_import_widgets',
						'action' 		=> 'wvn_ajax_import_widgets',
						'method' 		=> 'ajax_import_widgets',
						'loader' 		=> esc_html__('Importing Widgets', 'woovina-extra')
					),
					
					array(
						'input_name' 	=> 'wvn_import_forms',
						'action' 		=> 'wvn_ajax_import_forms',
						'method' 		=> 'ajax_import_forms',
						'loader' 		=> esc_html__('Importing Form', 'woovina-extra')
					)
				)
			);

			die();
		}

		/**
		 * Import XML file
		 *
		 * @since 1.0
		 */
		public function ajax_import_xml() {
			if(! wp_verify_nonce($_POST['wvn_import_demo_data_nonce'], 'wvn_import_demo_data_nonce')) {
				die('This action was stopped for security purposes.');
			}

			// Get the selected demo
			$demo_type 			= $_POST['wvn_import_demo'];

			// Get demos data
			$demo 				= WooVina_Demos::get_demos_data()[ $demo_type ];

			// Content file
			$xml_file 			= isset($demo['xml_file']) ? $demo['xml_file'] : '';

			// Delete the default post and page
			$sample_page 		= get_page_by_path('sample-page', OBJECT, 'page');
			$hello_world_post 	= get_page_by_path('hello-world', OBJECT, 'post');

			if(! is_null($sample_page)) {
				wp_delete_post($sample_page->ID, true);
			}

			if(! is_null($hello_world_post)) {
				wp_delete_post($hello_world_post->ID, true);
			}

			// Import Posts, Pages, Images, Menus.
			$result = $this->process_xml($xml_file);

			if(is_wp_error($result)) {
				echo json_encode($result->errors);
			} else {
				echo 'successful import';
			}

			die();
		}

		/**
		 * Import customizer settings
		 *
		 * @since 1.0
		 */
		public function ajax_import_theme_settings() {
			if(! wp_verify_nonce($_POST['wvn_import_demo_data_nonce'], 'wvn_import_demo_data_nonce')) {
				die('This action was stopped for security purposes.');
			}

			// Include settings importer
			include WE_PATH . 'includes/panel/classes/importers/class-settings-importer.php';

			// Get the selected demo
			$demo_type 			= $_POST['wvn_import_demo'];

			// Get demos data
			$demo 				= WooVina_Demos::get_demos_data()[ $demo_type ];

			// Settings file
			$theme_settings 	= isset($demo['theme_settings']) ? $demo['theme_settings'] : '';

			// Import settings.
			$settings_importer = new WVN_Settings_Importer();
			$result = $settings_importer->process_import_file($theme_settings);
			
			// Set default CSS
			set_theme_mod('woovina_css_file', $demo['css_file']);
			
			if(is_wp_error($result)) {
				echo json_encode($result->errors);
			} else {
				echo 'successful import';
			}

			die();
		}

		/**
		 * Import widgets
		 *
		 * @since 1.0
		 */
		public function ajax_import_widgets() {
			if(! wp_verify_nonce($_POST['wvn_import_demo_data_nonce'], 'wvn_import_demo_data_nonce')) {
				die('This action was stopped for security purposes.');
			}

			// Include widget importer
			include WE_PATH . 'includes/panel/classes/importers/class-widget-importer.php';

			// Get the selected demo
			$demo_type 			= $_POST['wvn_import_demo'];

			// Get demos data
			$demo 				= WooVina_Demos::get_demos_data()[ $demo_type ];

			// Widgets file
			$widgets_file 		= isset($demo['widgets_file']) ? $demo['widgets_file'] : '';

			// Import settings.
			$widgets_importer = new WVN_Widget_Importer();
			$result = $widgets_importer->process_import_file($widgets_file);
			
			// Set default CSS
			set_theme_mod('woovina_css_file', $demo['css_file']);
			
			if(is_wp_error($result)) {
				echo json_encode($result->errors);
			} else {
				echo 'successful import';
			}

			die();
		}
		
		/**
		 * Import forms
		 *
		 * @since 1.4.5
		 */
		public function ajax_import_forms() {
			if(!current_user_can('manage_options') ||! wp_verify_nonce($_POST['wvn_import_demo_data_nonce'], 'wvn_import_demo_data_nonce')) {
				die('This action was stopped for security purposes.');
			}

			// Include form importer
			include WE_PATH . 'includes/panel/classes/importers/class-wpforms-importer.php';

			// Get the selected demo
			$demo_type 			= $_POST['wvn_import_demo'];

			// Get demos data
			$demo 				= WooVina_Demos::get_demos_data()[$demo_type];

			// Widgets file
			$form_file 			= isset($demo['form_file'] ) ? $demo['form_file'] : '';

			// Import form 2
			$form_file_2 		= isset($demo['form_file_2'] ) ? $demo['form_file_2'] : '';

			// Import settings.
			$forms_importer = new WVN_WPForms_Importer();
			$result  = $forms_importer->process_import_file( $form_file );
			$result2 = $forms_importer->process_import_file( $form_file_2 );

			if(is_wp_error($result) || (!empty($form_file_2) && is_wp_error($result2))) {
				echo json_encode($result->errors);
			} else {
				echo 'successful import';
			}

			die();
		}
		
		/**
		 * After import
		 *
		 * @since 1.0
		 */
		public function ajax_after_import() {
			if(! wp_verify_nonce($_POST['wvn_import_demo_data_nonce'], 'wvn_import_demo_data_nonce')) {
				die('This action was stopped for security purposes.');
			}

			// If XML file is imported
			if($_POST['wvn_import_is_xml'] === 'true') {

				// Get the selected demo
				$demo_type 			= $_POST['wvn_import_demo'];

				// Get demos data
				$demo 				= WooVina_Demos::get_demos_data()[ $demo_type ];

				// Elementor width setting
				$elementor_width 		= isset($demo['elementor_width']) ? $demo['elementor_width'] : '';
				$elementor_viewport_md	= isset($demo['elementor_viewport_md']) ? $demo['elementor_viewport_md'] : '';
				
				// Reading settings
				$homepage_title 	= isset($demo['home_title']) ? $demo['home_title'] : 'Home';
				$blog_title 		= isset($demo['blog_title']) ? $demo['blog_title'] : '';

				// Posts to show on the blog page
				$posts_to_show 		= isset($demo['posts_to_show']) ? $demo['posts_to_show'] : '';

				// If shop demo
				$shop_demo 			= isset($demo['is_shop']) ? $demo['is_shop'] : true;

				// Product image size
				$image_size 		= isset($demo['woo_image_size']) ? $demo['woo_image_size'] : '';
				$thumbnail_size 	= isset($demo['woo_thumb_size']) ? $demo['woo_thumb_size'] : '';
				$crop_width 		= isset($demo['woo_crop_width']) ? $demo['woo_crop_width'] : '';
				$crop_height 		= isset($demo['woo_crop_height']) ? $demo['woo_crop_height'] : '';

				// Assign WooCommerce pages if WooCommerce Exists
				if(class_exists('WooCommerce') && true == $shop_demo) {

					$woopages = array(
						'woocommerce_shop_page_id' 				=> 'Shop',
						'woocommerce_cart_page_id' 				=> 'Cart',
						'woocommerce_checkout_page_id' 			=> 'Checkout',
						'woocommerce_pay_page_id' 				=> 'Checkout &#8594; Pay',
						'woocommerce_thanks_page_id' 			=> 'Order Received',
						'woocommerce_myaccount_page_id' 		=> 'My Account',
						'woocommerce_edit_address_page_id' 		=> 'Edit My Address',
						'woocommerce_view_order_page_id' 		=> 'View Order',
						'woocommerce_change_password_page_id' 	=> 'Change Password',
						'woocommerce_logout_page_id' 			=> 'Logout',
						'woocommerce_lost_password_page_id' 	=> 'Lost Password'
					);

					foreach ($woopages as $woo_page_name => $woo_page_title) {

						$woopage = get_page_by_title($woo_page_title);
						if(isset($woopage) && $woopage->ID) {
							update_option($woo_page_name, $woopage->ID);
						}

					}

					// We no longer need to install pages
					delete_option('_wc_needs_pages');
					delete_transient('_wc_activation_redirect');

					// Get products image size
					update_option('woocommerce_single_image_width', $image_size);
					update_option('woocommerce_thumbnail_image_width', $thumbnail_size);
					update_option('woocommerce_thumbnail_cropping', 'custom');
					update_option('woocommerce_thumbnail_cropping_custom_width', $crop_width);
					update_option('woocommerce_thumbnail_cropping_custom_height', $crop_height);
					
					// Fix bug Sale Products doesn't show after import
					delete_transient('wc_products_onsale');
					wc_update_product_lookup_tables();
				}

				// Set imported menus to registered theme locations
				$locations 	= get_theme_mod('nav_menu_locations');
				$menus 		= wp_get_nav_menus();

				if($menus) {
					
					foreach ($menus as $menu) {

						if($menu->name == 'Main Menu') {
							$locations['main_menu'] = $menu->term_id;
						} else if($menu->name == 'Top Menu') {
							$locations['topbar_menu'] = $menu->term_id;
						} else if($menu->name == 'Footer Menu') {
							$locations['footer_menu'] = $menu->term_id;
						} else if($menu->name == 'Sticky Footer') {
							$locations['sticky_footer_menu'] = $menu->term_id;
						} else if($menu->name == 'Mobile Menu') {
							$locations['mobile_menu'] = $menu->term_id;
						} else if($menu->name == 'Categories') {
							$locations['mobile_categories'] = $menu->term_id;						
						} else if($menu->name == 'Mobile Navbar') {
							$locations['mobile_navbar'] = $menu->term_id;
						}
					}

				}
				
				// Set default CSS
				set_theme_mod('woovina_css_file', $demo['css_file']);
				
				// Set menus to locations
				set_theme_mod('nav_menu_locations', $locations);

				// Disable Elementor default settings
				update_option('elementor_disable_color_schemes', 'yes');
				update_option('elementor_disable_typography_schemes', 'yes');
			    if(! empty($elementor_width)) {
					update_option('elementor_container_width', $elementor_width);
				}
				if(! empty($elementor_viewport_md)) {
					update_option('elementor_viewport_md', $elementor_viewport_md);
				}				
				
				// Load Font Awesome 4 Support
				update_option('elementor_load_fa4_shim', 'yes');
				
				// Update Default Kit
				$default_kit = get_page_by_title('Default Kit', OBJECT, 'elementor_library');
				update_option('elementor_active_kit', $default_kit->ID);
				
				// Assign front page and posts page (blog page).
			    $home_page = get_page_by_title($homepage_title);
			    $blog_page = get_page_by_title($blog_title);

			    update_option('show_on_front', 'page');

			    if(is_object($home_page)) {
					update_option('page_on_front', $home_page->ID);
				}

				if(is_object($blog_page)) {
					update_option('page_for_posts', $blog_page->ID);
				}

				// Posts to show on the blog page
			    if(! empty($posts_to_show)) {
					update_option('posts_per_page', $posts_to_show);
				}
				
			}

			die();
		}

		/**
		 * Import XML data
		 *
		 * @since 1.0.0
		 */
		public function process_xml($file) {
			
			// Set temp xml to attachment url for use
			$attachment_url = $file;

			// If file exists lets import it
			if(file_exists($attachment_url)) {
				$this->import_xml($attachment_url);
			} else {
				// Import file can't be imported - we should die here since this is core for most people.
				return new WP_Error('xml_import_error', __('The xml import file could not be accessed. Please try again or contact the theme developer.', 'woocommerce-starter-sites'));
			}

		}
		
		/**
		 * Import XML file
		 *
		 * @since 1.0.0
		 */
		private function import_xml($file) {

			// Make sure importers constant is defined
			if(! defined('WP_LOAD_IMPORTERS')) {
				define('WP_LOAD_IMPORTERS', true);
			}

			// Import file location
			$import_file = ABSPATH . 'wp-admin/includes/import.php';

			// Include import file
			if(! file_exists($import_file)) {
				return;
			}

			// Include import file
			require_once($import_file);

			// Define error var
			$importer_error = false;

			if(! class_exists('WP_Importer')) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

				if(file_exists($class_wp_importer)) {
					require_once $class_wp_importer;
				} else {
					$importer_error = __('Can not retrieve class-wp-importer.php', 'woovina-extra');
				}
			}

			if(! class_exists('WP_Import')) {
				$class_wp_import = WE_PATH . 'includes/panel/classes/importers/class-wordpress-importer.php';

				if(file_exists($class_wp_import)) {
					require_once $class_wp_import;
				} else {
					$importer_error = __('Can not retrieve wordpress-importer.php', 'woovina-extra');
				}
			}

			// Display error
			if($importer_error) {
				return new WP_Error('xml_import_error', $importer_error);
			} else {

				// No error, lets import things...
				if(! is_file($file)) {
					$importer_error = __('Sample data file appears corrupt or can not be accessed.', 'woovina-extra');
					return new WP_Error('xml_import_error', $importer_error);
				} else {
					$importer = new WP_Import();
					$importer->fetch_attachments = true;
					$importer->import($file);
				}
			}
		}
		
		
		/**
		 * Check demo access
		 *
		 * @since 2.15
		 */
		public static function demo_access($demo_class, $demo_name) {
			$theme = wp_get_theme();
			$name  = strtolower($theme->name);
			$dname = preg_replace('/[^a-zA-Z0-9_\s]/', '', str_replace(' ', '_', strtolower($demo_name)));
			
			$key   = ($name == 'woovina') ? 'woovina_starter_sites' : 'woovina_' . $name;
			$key2  = 'woovina_' . $dname;
			
			$license 			= get_option('edd_license_details');
			$license_details 	= (isset($license) && isset($license[$key2])) ? $license[$key2] : false;
			$license_details 	= (isset($license) && isset($license[$key]) && !$license_details) ? $license[$key] : $license_details;
			$return_class		= 'inactivate';
			
			$now        	= current_time('timestamp');
			$expire_date	= isset($license_details->expires) && trim($license_details->expires) != '' ? $license_details->expires : '';
			$expiration 	= strtotime($expire_date, current_time('timestamp'));
			
			if((! empty($license_details) && is_object($license_details) && true === $license_details->success 
			&& $license_details->pro_demos && $now < $expiration) || $demo_class == 'free-demo') {
				$return_class = 'activate';
			}
			
			return $return_class;
		}
		
		
		/**
		 * Check install premium plugins access
		 *
		 * @since 4.6.1
		 */
		public static function premium_access($demo_name) {
			$theme = wp_get_theme();
			$name  = strtolower($theme->name);
			$dname = preg_replace('/[^a-zA-Z0-9_\s]/', '', str_replace(' ', '_', strtolower($demo_name)));
			
			$key   = ($name == 'woovina') ? 'woovina_starter_sites' : 'woovina_' . $name;
			$key2  = 'woovina_' . $dname;
			
			$license 			= get_option('edd_license_details');			
			$license_details 	= (isset($license) && isset($license[$key2])) ? $license[$key2] : false;
			$license_details 	= (isset($license) && isset($license[$key]) && !$license_details) ? $license[$key] : $license_details;
			
			$now        	= current_time('timestamp');
			$expire_date	= isset($license_details->expires) && trim($license_details->expires) != '' ? $license_details->expires : '';
			$expiration 	= strtotime($expire_date, current_time('timestamp'));
			
			if(!$license_details) 	return false;
			if($now > $expiration) 	return false;
			
			return $license_details->pro_plugins;			
		}
	}

}
new WooVina_Demos();