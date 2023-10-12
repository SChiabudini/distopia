<?php
/**
 * Licenses
 *
 * @package 	WooVina_Extra
 * @category 	Core
 * @author 		WooVina
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Start Class
class WooVina_Extra_Licenses {

	/**
	 * Start things up
	 */
	public function __construct() {
		add_action('admin_menu', array($this, 'add_page'), 99999);
		add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
	}

	/**
	 * Add sub menu page
	 *
	 * @since 1.0.0
	 */
	public function add_page() {
		$theme 		= wp_get_theme();
		$func_class	= $theme->get('Name') . '_copyright_removal';
		$func_class	= strtolower($func_class);
		
		// If no premium extensions
		if(true != apply_filters('woovina_licence_tab_enable', false) || function_exists('WC_STARTER_SITES_SETUP')) {
			return;
		}
		
		if($theme->name == 'WooVina' || !is_callable($func_class)) {
			add_submenu_page(
				'woovina-panel',
				esc_html__('Theme Licenses', 'woovina-extra'),
				esc_html__('Theme Licenses', 'woovina-extra'),
				'manage_options',
				'woovina-panel-licenses',
				array($this, 'create_admin_page')
			);
		}
		
		if($theme->name != 'WooVina' && is_callable($func_class)) {
			add_submenu_page(
				'woovina-panel',
				esc_html__($theme->name . ' Licenses', 'woovina-extra'),
				esc_html__($theme->name . ' Licenses', 'woovina-extra'),
				'manage_options',
				'woovina-panel-licenses',
				array($this, 'create_admin_page')
			);
		}
	}

	/**
	 * Admin page
	 *
	 * @since 1.0.0
	 */
	public function create_admin_page() { 
		$theme = wp_get_theme();	
	?>

		<div class="wrap woovina-scripts-panel woovina-clr">

			<h1><?php esc_attr_e('Licenses Settings', 'woovina-extra'); ?></h1>

			<form id="woovina-license-form" method="post" action="options.php">
				<?php settings_fields('woovina_options'); ?>

				<?php do_action('woovina_licenses_tab_top'); ?>

				<table id="woovina-licenses" class="form-table <?php echo ($theme->name != 'WooVina') ? 'child-theme-license' : 'parent-license'; ?>">
					<tbody>
						<?php do_action('woovina_licenses_tab_fields'); ?>
					</tbody>
				</table>

				<p class="submit"><input type="submit" name="woovina_licensekey_activateall" id="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes', 'woovina-extra'); ?>"></p>
			</form>

		</div>

	<?php
	}

	/**
	 * Admin Scripts
	 *
	 * @since 1.0.0
	 */
	public static function admin_scripts($hook) {

		// Only load scripts when needed
		if(WE_ADMIN_PANEL_HOOK_PREFIX . '-licenses' != $hook) {
			return;
		}

		// CSS
		wp_enqueue_style('woovina-licenses-panel', plugins_url('/assets/css/licenses.min.css', __FILE__));

	}
}
new WooVina_Extra_Licenses();