<?php
/**
 * Theme Panel
 *
 * @package WooVina_Extra
 * @category Core
 * @author WooVina
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

require_once(WE_PATH .'/includes/panel/push-monkey-client.php');
require_once(WE_PATH .'/includes/panel/push-monkey-woocommerce.php');

// Start Class
class WooVina_Extra_Theme_Panel {
	static $push_monkey_activate;

	const WOO_COMMERCE_ENABLED = 'we_push_monkey_woo_enabled';

	static $endpointURL;
	static $apiClient;
	static $woocommerce_is_active;
	static $woo_settings;
	static $woo_enabled;

	/**
	 * Start things up
	 */
	public function __construct() {

		// Add panel menu
		add_action('admin_menu', 				array('WooVina_Extra_Theme_Panel', 'add_page'), 0);

		// Add panel submenu
		add_action('admin_menu', 				array('WooVina_Extra_Theme_Panel', 'add_menu_subpage'));

		// Add custom CSS for the theme panel
		add_action('admin_enqueue_scripts', 	array('WooVina_Extra_Theme_Panel', 'css'));

		// Register panel settings
		add_action('admin_init', 				array('WooVina_Extra_Theme_Panel', 'register_settings'));

		if(self::get_push_monkey_account_key()) {

			add_action('wp_head', 				array('WooVina_Extra_Theme_Panel', 'add_push_monkey_manifest'));
			add_action('init', 				array('WooVina_Extra_Theme_Panel', 'enqueue_push_monkey_scripts'));

		}

		add_action('admin_init',  				array('WooVina_Extra_Theme_Panel', 'handle_action'));

	    // Theme panel push monkey disable notice
	    if(self::get_push_monkey_account_key()) {
			add_action('admin_menu', 			array('WooVina_Extra_Theme_Panel', 'add_woo_page'), 999);
		    add_action('init', 				array('WooVina_Extra_Theme_Panel', 'woovina_process_form'));
	    }
	    
	    // wc notice hide
	   	if(isset($_GET['notice']) && ($_GET['notice'] =="wc_notice")) {
	   		update_option('wc_notice_hide', 1);
	   	}

		if(is_ssl()) {
			self::$endpointURL = "https://www.getpushmonkey.com";
		} else {
			self::$endpointURL = "http://www.getpushmonkey.com";
		}

		self::$apiClient = new WooVina_Push_Monkey_Client(self::$endpointURL);

		// WooCommerce
		self::$woocommerce_is_active = false;
		self::$woo_settings = NULL;
		if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			self::$woocommerce_is_active = true;
			self::$woo_settings = self::$apiClient->get_woo_settings(self::account_key());
		}
		self::$woo_enabled = get_option(self::WOO_COMMERCE_ENABLED, false);
		
		if((isset($_GET['page'])) && ($_GET['page'] == "woovina-panel-woocommerce")) {
			add_action('admin_enqueue_scripts', array('WooVina_Extra_Theme_Panel', 'woo_setting_css'));
		}

		// Load addon files
		self::load_addons();

	}

	/**
	 * Checks if an Account Key is stored.
	 * @return boolean
	 * @since 1.4.0
	 */
	public function has_account_key() {
		if(self::account_key()) {
			return true;
		}
		return false;
	}

	/**
	 * Returns the stored Account Key.
	 * @return string - the Account Key
	 * @since 1.4.0
	 */
	public function account_key() {
		$account_key = self::get_push_monkey_account_key();
		if(! self::account_key_is_valid($account_key)) {
			return NULL;
		}
		return $account_key;
	}

	/**
	 * Checks if an Account Key is valid.
	 * @param string $account_key - the Account Key checked.
	 * @return boolean
	 * @since 1.4.0
	 */
	public static function account_key_is_valid($account_key) {
		if(! strlen($account_key)) {
			return false;
		}
		return true;
	}

	/**
	 * Central point to process forms.
	 *
	 * @since 1.4.0
	 */
	public static function woovina_process_form() {
		if(isset($_POST['push_monkey_woo_settings'])) {
			self::process_woo_settings($_POST, $_FILES);
		}
	}

	/**
	 * Process the WooCommerce settings form.
	 *
	 * @since 1.4.0
	 */
	public static function process_woo_settings($post, $files) {
		$account_key = self::account_key();
		$title = $post['abandoned_cart_title'];
		$message = $post['abandoned_cart_message'];
		$delay = $post['abandoned_cart_delay'];
		$image = NULL;
		$image_path = NULL;
		if(!empty($files["abandoned_cart_image"]["name"])) {
			$image_path = $files["abandoned_cart_image"]["tmp_name"];
			$image = $files["abandoned_cart_image"]["name"];
		}
		$woo_enabled_field = false;
		if(isset($post['push_monkey_woo_enabled'])) {
			$woo_enabled_field = true;
 		}
 		update_option(self::WOO_COMMERCE_ENABLED, $woo_enabled_field);
		$updated = self::$apiClient->update_woo_settings($account_key, $delay, $title, $message, $image_path, $image);
		if($updated) {
			add_action('admin_notices', array('WooVina_Extra_Theme_Panel', 'woo_settings_notice'));
			self::$woo_settings = self::$apiClient->get_woo_settings(self::account_key());
		}
		self::$woo_enabled = get_option(self::WOO_COMMERCE_ENABLED, false);
	}

	/**
	 * Admin notice to confirm that the Woo settings have been saved.
	 *
	 * @since 1.4.0
	 */
	public static function woo_settings_notice() {
		echo sprintf(esc_html__('%1$s%2$sAbandoned cart settings saved! *woohoo*%3$s%4$sDismiss this notice.%5$s', 'woovina-extra'), '<div class="notice notice-info is-dismissible">', '<p>', '</p>', '<button type="button" class="notice-dismiss"><span class="screen-reader-text">', '</span></button></div>');
	}

	/**
	 * Return customizer panels
	 *
	 * @since 1.0.8
	 */
	private static function get_panels() {

		$panels = array(
			'we_general_panel' => array(
				'label'     => esc_html__('General Panel', 'woovina-extra'),
			),
			'we_typography_panel' => array(
				'label'     => esc_html__('Typography Panel', 'woovina-extra'),
			),
			'we_topbar_panel' => array(
				'label'     => esc_html__('Top Bar Panel', 'woovina-extra'),
			),
			'we_header_panel' => array(
				'label'     => esc_html__('Header Panel', 'woovina-extra'),
			),
			'we_blog_panel' => array(
				'label'     => esc_html__('Blog Panel', 'woovina-extra'),
			),
			'we_sidebar_panel' => array(
				'label'     => esc_html__('Sidebar Panel', 'woovina-extra'),
			),
			'we_footer_widgets_panel' => array(
				'label'     => esc_html__('Footer Widgets Panel', 'woovina-extra'),
			),
			'we_footer_bottom_panel' => array(
				'label'     => esc_html__('Footer Bottom Panel', 'woovina-extra'),
			),
			'we_custom_code_panel' => array(
				'label'     => esc_html__('Custom CSS/JS Panel', 'woovina-extra'),
			),
		);

		// Apply filters and return
		return apply_filters('we_theme_panels', $panels);

	}

	/**
	 * Return customizer options
	 *
	 * @since 1.0.8
	 */
	private static function get_options() {

		$options = array(
			'custom_logo' => array(
				'label'    	=> esc_html__('Upload your logo', 'woovina-extra'),
				'desc'     	=> esc_html__('Add your own logo and retina logo used for retina screens.', 'woovina-extra'),
			),
			'site_icon' => array(
				'label'    	=> esc_html__('Add your favicon', 'woovina-extra'),
				'desc'     	=> esc_html__('The favicon is used as a browser and app icon for your website.', 'woovina-extra'),
			),
			'woovina_primary_color' => array(
				'label'    	=> esc_html__('Choose your primary color', 'woovina-extra'),
				'desc'     	=> esc_html__('Replace the default primary and hover color by your own colors.', 'woovina-extra'),
			),
			'woovina_typography_panel' => array(
				'label'    	=> esc_html__('Choose your typography', 'woovina-extra'),
				'desc'     	=> esc_html__('Choose your own typography for any parts of your website.', 'woovina-extra'),
				'panel' 	=> true,
			),
			'woovina_top_bar' => array(
				'label'    	=> esc_html__('Top bar options', 'woovina-extra'),
				'desc'     	=> esc_html__('Enable/Disable the top bar, add your own paddings and colors.', 'woovina-extra'),
			),
			'woovina_header_style' => array(
				'label'    	=> esc_html__('Header options', 'woovina-extra'),
				'desc'     	=> esc_html__('Choose the style, the height and the colors for your site header.', 'woovina-extra'),
			),
			'woovina_footer_widgets' => array(
				'label'    	=> esc_html__('Footer widgets options', 'woovina-extra'),
				'desc'     	=> esc_html__('Choose the columns number, paddings and colors for the footer widgets.', 'woovina-extra'),
			),
			'woovina_footer_bottom' => array(
				'label'    	=> esc_html__('Footer bottom options', 'woovina-extra'),
				'desc'     	=> esc_html__('Add your copyright, paddings and colors for the footer bottom.', 'woovina-extra'),
			),
		);

		// Apply filters and return
		return apply_filters('we_customizer_options', $options);

	}

	/**
	 * Registers a new menu page
	 *
	 * @since 1.0.0
	 */
	public static function add_page() {
	  	add_menu_page(
			esc_html__('Theme Panel', 'woovina-extra'),
			'Theme Panel', // This menu cannot be translated because it's used for the $hook prefix
			'manage_options',
			'woovina-panel',
			'',
			'dashicons-admin-generic',
			null
		);
	}

	/**
	* Add sub menu page
	*
	* @since 1.4.0
	*/
	public static function add_woo_page() {
	    add_submenu_page(
	        'woovina-panel',
	        esc_html__('Woocommerce', 'woovina-extra'),
	        esc_html__('Woocommerce', 'woovina-extra'),
	        'manage_options',
	        'woovina-panel-woocommerce',
	        array('WooVina_Extra_Theme_Panel', 'woocommerce_panel_html')
	   );
	}

	/**
	 * Registers a new submenu page
	 *
	 * @since 1.0.0
	 */
	public static function add_menu_subpage(){
		add_submenu_page(
			'woovina-general',
			esc_html__('General', 'woovina-extra'),
			esc_html__('General', 'woovina-extra'),
			'manage_options',
			'woovina-panel',
			array('WooVina_Extra_Theme_Panel', 'create_admin_page')
		);
	}

	/**
	 * Register a setting and its sanitization callback.
	 *
	 * @since 1.0.0
	 */
	public static function register_settings() {
		register_setting('we_panels_settings', 'we_panels_settings', array('WooVina_Extra_Theme_Panel', 'validate_panels'));
		register_setting('woovina_options', 'woovina_options', array('WooVina_Extra_Theme_Panel', 'admin_sanitize_license_options')); 
		register_setting('we_push_monkey_account_key', 'we_push_monkey_account_key', array('WooVina_Extra_Theme_Panel', 'validate_push_monkey_account_key'));
	}

	/**
	 * Validate Settings Options
	 * 
	 * @since 1.0.0
	 */
	public static function admin_sanitize_license_options($input) {

		// filter to save all settings to database
        $woovina_options = get_option('woovina_options');
        if(isset($input['licenses']) && ! empty($input['licenses'])) {
            foreach ($input['licenses'] as $key => $value) {
                if($woovina_options['licenses'][$key]) {
                    if(strpos($value, "XXX") !== FALSE && isset($woovina_options['licenses'][$key])) {
                        $input['licenses'][$key] = $woovina_options['licenses'][$key];
                    }
                }
            }
        }

		return $input;
	}

	/**
	 * Main Sanitization callback
	 *
	 * @since 1.2.2
	 */
	public static function validate_panels($settings) {

		// Get panels array
		$panels = self::get_panels();

		foreach ($panels as $key => $val) {

			$settings[$key] = ! empty($settings[$key]) ? true : false;

		}

		// Return the validated/sanitized settings
		return $settings;

	}

	/**
	 * Get settings.
	 *
	 * @since 1.2.2
	 */
	public static function get_setting($option = '') {

		$defaults = self::get_default_settings();

		$settings = wp_parse_args(get_option('we_panels_settings', $defaults), $defaults);

		return isset($settings[ $option ]) ? $settings[ $option ] : false;

	}

	/**
	 * Get default settings value.
	 *
	 * @since 1.2.2
	 */
	public static function get_default_settings() {

		// Get panels array
		$panels = self::get_panels();

		// Add array
		$default = array();

		foreach ($panels as $key => $val) {
			$default[$key] = 1;
		}

		// Return
		return apply_filters('we_default_panels', $default);

	}

	/**
	 * Sanitize and activate Push Monkey
	 *
	 * @since 1.4.0
	 */
	public static function validate_push_monkey_account_key($account_key) {
		$old_account_key = get_option('we_push_monkey_account_key');
		$url = 'https://getpushmonkey.com/v2/api/verify';
		$args = array('body' => array('account_key' => $account_key));
		$response = wp_remote_post($url, $args);
		if(! is_wp_error($response)) {
			
			$body = wp_remote_retrieve_body($response);
			$output = json_decode($body);
			if($output->response == "ok") {
				return $account_key;
			}
		}
	    add_settings_error(
			'we_push_monkey',
			esc_attr('settings_updated'),
			__('The Account Key seems to be invalid.', 'woovina-extra'),
			'error'
		);
		return false;

	}

	/**
	 * Get Push Monkey key
	 *
	 * @since 1.4.0
	 */	
	public static function get_push_monkey_account_key() {
		return get_option('we_push_monkey_account_key', '');
	}

	/**
	 * Handle the 'action' query parameter
	 *
	 * @since 1.4.0
	 */
	public static function handle_action() {

		if(! isset($_GET['action'])) {
			return;
		} 

		$action = $_GET['action'];
		switch ($action) {
			case 'we_push_monkey_deactivate':
				self::deactivate_push_monkey();
		}

	}

	/**
	 * Deactivate Push Monkey
	 *
	 * @since 1.4.0
	 */
	public static function deactivate_push_monkey() {
		delete_option('wc_notice_hide');
		delete_option('we_push_monkey_account_key');
		// Push Notifications
		$url = add_query_arg(
			array(
				'page' 	=> 'woovina-panel',
				'tab' 	=> 'push-notifications',
			),
			'admin.php'
		);
		wp_redirect($url);
		exit;
	}

	/**
	* Add a custom <link> tag for the manifest
	*
	* @since 1.4.0
	*/
	public static function add_push_monkey_manifest() {
		echo '<link rel="manifest" href="' . plugins_url('/assets/js/manifest.json', __FILE__) . '">';
	}

	/**
	* Add the JS for Push Notifications
	*
	* @since 1.4.0
	*/
	public static function enqueue_push_monkey_scripts() {

		if(is_admin()) return;

		$account_key = self::get_push_monkey_account_key();
		if(! $account_key) return;

		$url = "https://www.getpushmonkey.com/sdk/config-".$account_key.".js?subdomain_forced=1";
		wp_enqueue_script('push_monkey_sdk', $url, array('jquery'));
	}

	/**
	 * Settings page sidebar
	 *
	 * @since 1.4.0
	 */
	public static function admin_page_sidebar() {

		// Kinsta img url
		$kinsta = WE_URL . '/includes/panel/assets/img/kinsta.png'; ?>

		<div class="woovina-bloc woovina-review">
			<h3><?php esc_html_e('Are you a helpful person?', 'woovina-extra'); ?></h3>
			<div class="content-wrap">
				<p class="content"><?php esc_html_e('I&rsquo;m grateful that you&rsquo;ve decided to join the WooVina family. If I could take 2 min of your time, I&rsquo;d really appreciate if you could leave a review. By spreading the love, we can create even greater free stuff in the future!', 'woovina-extra'); ?></p>
				<a href="https://wordpress.org/support/theme/woovina/reviews/#new-post" class="button wvn-button" target="_blank"><?php esc_html_e('Leave my review', 'woovina-extra'); ?></a>
				<p class="bottom-text"><?php esc_html_e('Thank you very much!', 'woovina-extra'); ?></p>
			</div>
			<i class="dashicons dashicons-wordpress"></i>
		</div>

		<div class="woovina-button">
			<a href="https://www.youtube.com/c/WooVina" class="button wvn-button wvn-yt-btn" target="_blank"><i class="dashicons dashicons-video-alt3"></i><?php esc_html_e('Check video tutorials', 'woovina-extra'); ?></a>
		</div>

		<div class="woovina-bloc woovina-kinsta">
			<p class="wvn-img">
				<a href="https://goo.gl/Xp7XJy" target="_blank">
					<img src="<?php echo esc_url($kinsta); ?>" alt="Kinsta Hosting" />
				</a>
			</p>
			<div class="content-wrap">
				<p class="content"><?php echo sprintf(esc_html__('A fast theme is even better with a great host!%1$sWooVina proudly recommends Kinsta to anyone looking for speed, security, and fast support.', 'woovina-extra'), '<br>'); ?></p>
				<a href="https://goo.gl/Xp7XJy" class="button wvn-button" target="_blank"><?php esc_html_e('Check Kinsta Hosting', 'woovina-extra'); ?></a>
			</div>
			<i class="dashicons dashicons-cloud"></i>
		</div>

	<?php
	}

	/**
	 * Settings page output
	 *
	 * @since 1.0.0
	 */
	public static function create_admin_page() {

		// Get panels array
		$theme_panels = self::get_panels();

		// Get options array
		$options = self::get_options();

		// Push monkey img url
		$push_monkey = WE_URL . '/includes/panel/assets/img/push-monkey-devices.png'; ?>

		<div class="wrap woovina-theme-panel clr">
			
			<h1><?php esc_attr_e('Theme Panel', 'woovina-extra'); ?></h1>
			
			<h2 class="nav-tab-wrapper">
				<?php
				//Get current tab
				$curr_tab = !empty($_GET['tab']) ? $_GET['tab'] : 'features';

				// Feature url
				$feature_url = add_query_arg(
					array(
						'page' 	=> 'woovina-panel',
						'tab' 	=> 'features',
					),
					'admin.php'
				); ?>

				<?php do_action('woovina_theme_panel_before_tab'); ?>

				<a href="<?php echo esc_url($feature_url); ?>" class="nav-tab <?php echo $curr_tab == 'features' ? 'nav-tab-active' : ''; ?>"><?php esc_attr_e('Features', 'woovina-extra'); ?></a>

				<?php do_action('woovina_theme_panel_after_tab'); ?>
			</h2>
			
			<?php do_action('woovina_theme_panel_before_content'); ?>
			
			<div class="woovina-settings clr" <?php echo $curr_tab == 'features' ? '' : 'style="display:none;"'; ?>>

				<?php
				if(true != apply_filters('woovina_theme_panel_sidebar_enabled', false)) { ?>

					<div class="woovina-sidebar right clr">

						<div class="metabox-holder postbox woovina-doc popular-articles clr">
							<h3 class="hndle"><?php esc_html_e('Documentation', 'woovina-extra'); ?><a href="https://woovina.com/docs/getting-started?ref=dashboard" target="_blank"><?php esc_html_e('View all', 'woovina-extra'); ?></a></h3>
							<div class="inside">
								<ul>
									<li><a href="https://woovina.com/docs/getting-started/how-to-import-a-free-demo?ref=dashboard" target="_blank"><?php esc_html_e('Importing The Free Demo', 'woovina-extra'); ?></a></li>
									<li><a href="https://woovina.com/docs/getting-started/add-custom-css-and-js-to-your-website?ref=dashboard" target="_blank"><?php esc_html_e('Add Custom CSS and JS to Your Website', 'woovina-extra'); ?></a></li>
									<li><a href="https://woovina.com/docs/getting-started/how-to-create-a-custom-header?ref=dashboard" target="_blank"><?php esc_html_e('How To Create a Custom Header', 'woovina-extra'); ?></a></li>
									<li><a href="https://woovina.com/docs/getting-started/customize-your-layout-widths?ref=dashboard" target="_blank"><?php esc_html_e('Customize Your Layout Widths', 'woovina-extra'); ?></a></li>
									<li><a href="https://woovina.com/docs/getting-started/increasing-memory-limit-to-php?ref=dashboard" target="_blank"><?php esc_html_e('Increasing Memory Limit To PHP', 'woovina-extra'); ?></a></li>
									<li><a href="https://woovina.com/docs/getting-started/how-to-create-mega-menus?ref=dashboard" target="_blank"><?php esc_html_e('How To Create Mega Menus', 'woovina-extra'); ?></a></li>
									<li><a href="https://woovina.com/docs/getting-started/how-to-add-custom-fonts?ref=dashboard" target="_blank"><?php esc_html_e('How To Add Custom Fonts', 'woovina-extra'); ?></a></li>
								</ul>
							</div>
						</div>

						<div class="woovina-support clr">
							<p><?php esc_html_e('Need help? If you have checked the documentation and still having an issue, open a support ticket by clicking the button below.', 'woovina-extra'); ?></p>
							<a href="https://woovina.com/my-account/my-tickets?ref=dashboard" class="button wvn-button" target="_blank"><?php esc_html_e('Submit Support Request', 'woovina-extra'); ?></a>
						</div>

						<?php do_action('we_panels_sidebar_after'); ?>

					</div>

				<?php } ?>

				<div class="left clr">

					<form id="woovina-theme-panel-form" method="post" action="options.php">

						<?php settings_fields('we_panels_settings'); ?>

						<div class="woovina-panels clr">

							<h2 class="woovina-title"><?php esc_html_e('Customizer Sections', 'woovina-extra'); ?></h2>

							<p class="woovina-desc"><?php esc_html_e('Disable the Customizer panels that you do not have or need anymore to load it quickly. Your settings are saved, so do not worry.', 'woovina-extra'); ?></p>

							<?php
							// Loop through theme pars and add checkboxes
							foreach ($theme_panels as $key => $val) :

								// Var
								$label  = isset ($val['label']) ? $val['label'] : '';
								$desc  	= isset ($val['desc']) ? $val['desc'] : '';

								// Get settings
								$settings = self::get_setting($key); ?>

								<div id="<?php echo esc_attr($key); ?>" class="column-wrap clr">

									<label for="woovina-switch-[<?php echo esc_attr($key); ?>]" class="column-name clr">
										<h3 class="title"><?php echo esc_attr($label); ?></h3>
									    <input type="checkbox" name="we_panels_settings[<?php echo esc_attr($key); ?>]" value="true" id="woovina-switch-[<?php echo esc_attr($key); ?>]" <?php checked($settings); ?>>
										<?php if($desc) { ?>
											<div class="desc"><?php echo esc_attr($desc); ?></div>
										<?php } ?>
									</label>

								</div>

							<?php endforeach; ?>

							<?php submit_button(); ?>

						</div>

					</form>

					<?php do_action('we_theme_panel_after'); ?>

					<div class="divider clr"></div>

					<div class="woovina-options clr">

						<h2 class="woovina-title"><?php esc_html_e('Getting started', 'woovina-extra'); ?></h2>

						<p class="woovina-desc"><?php esc_html_e('Take a look in the options of the Customizer and see yourself how easy and quick to customize your website as you wish.', 'woovina-extra'); ?></p>

						<div class="options-inner clr">

							<?php
							// Loop through options
							foreach ($options as $key => $val) :

								// Var
								$label  = isset ($val['label']) ? $val['label'] : '';
								$desc  	= isset ($val['desc']) ? $val['desc'] : '';
								$panel  = isset ($val['panel']) ? $val['panel'] : false;
								$id   	= $key;

								if(true == $panel) {
									$focus = 'panel';
								} else {
									$focus = 'control';
								} ?>

								<div class="column-wrap">

									<div class="column-inner clr">

										<h3 class="title"><?php echo esc_attr($label); ?></h3>
										<?php if($desc) { ?>
											<p class="desc"><?php echo esc_attr($desc); ?></p>
										<?php } ?>

										<div class="bottom-column">
											<a class="option-link" href="<?php echo esc_url(admin_url('customize.php?autofocus['. $focus .']='. $id .'')); ?>" target="_blank"><?php esc_html_e('Go to the option', 'woovina-extra'); ?></a>
										</div>

									</div>

								</div>

							<?php endforeach; ?>

						</div><!-- .options-inner -->

					</div>

				</div>

			</div><!-- .woovina-settings -->
			
			<?php do_action('woovina_theme_panel_after_content'); ?>
		</div>

	<?php
	}

	/**
	 * Woo page output
	 *
	 * @since 1.4.0
	 */
	public static function woocommerce_panel_html() { ?>

		<div class="push-monkey push-monkey-bootstrap">
			<div class="container-fluid">
	    		<div class="panel panel-default">
	    			<div class="panel-heading">
	    				<h3 class="panel-title"><?php esc_attr_e('WooCommerce + Push Monkey', 'woovina-extra'); ?></h3>
	    			</div>
	    			<div class="panel-body">
	    				<?php if(! self::$woocommerce_is_active) { ?>
		    				<h3><?php esc_attr_e('Did you know Push Monkey works seamlessly with WooCommerce?', 'woovina-extra'); ?></h3>
		    				<p>
		    					<?php echo sprintf(esc_html__('The %1$sAbandoned Cart%2$s feature reminds your visitor about shopping carts that they did not check out.', 'woovina-extra'), '<strong>', '</strong>'); ?>
		    				</p>
		    				<p>
		    					<?php esc_attr_e('Install and activate WooCommerce to take full advantage of this feature.', 'woovina-extra'); ?>
		    				</p>
		    			<?php } else { ?>
		    				<h3><?php esc_attr_e('Abandoned Shopping Cart.', 'woovina-extra'); ?></h3>
		    				<p>
		    					<?php esc_attr_e('This will remind your visitors if they did not check out their shopping cart.', 'woovina-extra'); ?>
		    				</p>     
	    				<?php } ?>
	    			</div>
	    		</div>
	    		<?php if(self::$woocommerce_is_active) { ?>
		    		<form class="push_monkey_woo_settings" name="push_monkey_woo_settings" enctype="multipart/form-data" method="post" class="form-horizontal">
		    			<div class="panel panel-success">
		    				<div class="panel-heading">
		    					<h3 class="panel-title"><?php esc_attr_e('Abandoned Cart Options', 'woovina-extra'); ?></h3>
		    				</div>
		    				<div class="panel-body">

		    					<div class="form-group clearfix">
		    						<label class="col-md-3 control-label">
		    							<?php esc_attr_e('Enable Abandoned Cart Notifications', 'woovina-extra'); ?>
		    						</label>
		    						<div class="col-md-3">
		    							<label class="switch">
		    								<input type="checkbox" class="switch" name="push_monkey_woo_enabled" <?php if(self::$woo_enabled) { ?> checked="true" <?php } ?>
		    								>
		    								<span></span>
		    							</label>
		    							<span class="help-block"><?php esc_attr_e('Enable or disable this feature.', 'woovina-extra'); ?></span>
		    						</div>
		    					</div>

		    					<div class="form-group clearfix">
		    						<label class="col-md-3 col-xs-12 control-label" for="push-monkey-abandoned-delay">
		    							<?php esc_attr_e('Abandoned Cart Delay', 'woovina-extra'); ?>
		    						</label>
		    						<div class="col-md-4 col-xs-12">
		    							<input type="number" value="<?php echo self::$woo_settings['abandoned_cart_delay']; ?>" name="abandoned_cart_delay" id="push-monkey-abandoned-delay" class="form-control" min="0" step="1" />
		    							<span class="help-block">
			    							<?php echo sprintf(esc_html__('The number of %1$sminutes%2$s after which the abandoned cart reminder push notification is sent.', 'woovina-extra'), '<strong>', '</strong>'); ?>
		    							</span>
		    						</div>
		    					</div>

		    					<div class="form-group clearfix">
		    						<label class="col-md-3 col-xs-12 control-label" for="push-monkey-abandoned-title">
		    							<?php esc_attr_e('Abandoned Cart Title', 'woovina-extra'); ?>
		    						</label>
		    						<div class="col-md-6 col-xs-12">
		    							<input type="text" value="<?php echo self::$woo_settings['abandoned_cart_title']; ?>" name="abandoned_cart_title" id="push-monkey-abandoned-title" class="form-control" maxlength="30"/>
		    							<span class="help-block">
		    								<?php esc_attr_e('The title of the abandoned cart reminder push notifications.', 'woovina-extra'); ?>
		    							</span>
		    						</div>
		    					</div>

		    					<div class="form-group clearfix">
		    						<label class="col-md-3 col-xs-12 control-label" for="push-monkey-abandoned-message">
		    							<?php esc_attr_e('Abandoned Cart Message', 'woovina-extra'); ?>
		    						</label>
		    						<div class="col-md-6 col-xs-12">
		    							<textarea name="abandoned_cart_message" id="push-monkey-abandoned-message" class="form-control" rows="3" maxlength="120"><?php echo self::$woo_settings['abandoned_cart_message']; ?></textarea>
		    							<span class="help-block">
		    								<?php esc_attr_e('The message of the abandoned cart reminder push notifications.', 'woovina-extra'); ?>
		    							</span>
		    						</div>
		    					</div>

		    					<div class="form-group clearfix">
		    						<label class="col-md-3 col-xs-12 control-label" for="push-monkey-abandoned-image">
		    							<?php esc_attr_e('Abandoned Cart Image', 'woovina-extra'); ?>
		    						</label>
		    						<div class="col-md-6 col-xs-12">
		    							<input type="file" class="fileinput btn-primary"  value="24" name="abandoned_cart_image" id="push-monkey-abandoned-image"/>
		    							<span class="help-block">
		    								<?php esc_attr_e('The image of the abandoned cart reminder push notifications. Recommended size 675px x 506px.', 'woovina-extra'); ?>
		    							</span>
		    							<?php if(self::$woo_settings['abandoned_cart_image']) {?>
		    							<br />
		    							<p><?php esc_attr_e('Your current image:', 'woovina-extra'); ?></p>
		    							<img style="width: 337px; height: 253px" src="https://getpushmonkey.com/<?php echo self::$woo_settings['abandoned_cart_image']; ?>" />
		    							<?php } ?>
		    						</div>
		    					</div>                            

		    				</div>

		    				<div class="panel-footer">
		    					<button type="submit" name="push_monkey_woo_settings" class="btn btn-primary pull-right"><?php esc_attr_e('Save', 'woovina-extra'); ?></button>
		    				</div>      

		    			</div>
		    		</form>
	    		<?php }?>
	    	</div>
	    </div>

	<?php
	}

	public static function woo_setting_css() {
		// Css Add
		wp_enqueue_style('we-woo-styles', plugins_url('/assets/css/push-monkey.min.css', __FILE__));
	}

	/**
	 * Include addons
	 *
	 * @since 1.0.0
	 */
	private static function load_addons() {

		// Addons directory location
		$dir = WE_PATH .'/includes/panel/';

		if(is_admin()) {

			// Import/Export
			require_once($dir .'import-export.php');
			
			// Licenses
			require_once($dir .'licenses.php');

		}

		// Scripts panel - if minimum PHP 5.6
		if(version_compare(PHP_VERSION, '5.6', '>=')) {
			require_once($dir .'scripts.php');
		}

	}

	/**
	 * Theme panel CSS
	 *
	 * @since 1.0.0
	 */
	public static function css($hook) {

		// Only load scripts when needed
		if('toplevel_page_woovina-panel' != $hook) {
			return;
		}

		// CSS
		wp_enqueue_style('woovina-theme-panel', plugins_url('/assets/css/panel.min.css', __FILE__));

	}

}
new WooVina_Extra_Theme_Panel();