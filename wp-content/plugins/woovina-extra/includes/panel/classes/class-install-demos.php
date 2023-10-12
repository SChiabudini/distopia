<?php
/**
 * Install demos page
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
class WVN_Install_Demos {

	/**
	 * Start things up
	 */
	public function __construct() {
		add_action('admin_menu', array($this, 'add_page'), 999);
	}

	/**
	 * Add sub menu page for the custom CSS input
	 *
	 * @since 1.0.0
	 */
	public function add_page() {

		// If the plugin Starter Sites activated or demos data isn't empty
		$demos = WooVina_Demos::get_demos_data();
		if(function_exists('WC_STARTER_SITES_SETUP') || empty($demos)) return;

		add_submenu_page(
			'woovina-panel',
			esc_html__('Install Demos', 'woovina-extra'),
			esc_html__('Install Demos', 'woovina-extra'),
			'manage_options',
			'woovina-panel-install-demos',
			array($this, 'create_admin_page')
		);
	}

	/**
	 * Settings page output
	 *
	 * @since 1.0.0
	 */
	public function create_admin_page() {

		// Theme branding
		$brand = woovina_theme_branding(); ?>

		<div class="wvn-demo-wrap wrap">

			<h2><?php echo esc_attr($brand); ?> - <?php esc_attr_e('Install Demos', 'woovina-extra'); ?></h2>

			<div class="theme-browser rendered">

				<?php
				// Vars
				$demos = WooVina_Demos::get_demos_data();
				$categories = WooVina_Demos::get_demo_all_categories($demos);				
				if(! empty($categories)) :
				unset($categories['pro']);
				unset($categories['free']);				
				asort($categories);
				?>
					<div class="wvn-header-bar">
						<nav class="wvn-navigation">
							<ul>
								<li class="active"><a href="#all" class="wvn-navigation-link"><?php esc_html_e('All', 'woovina-extra'); ?></a></li>
								<li><a href="#free" class="wvn-navigation-link"><?php esc_html_e('FREE', 'woovina-extra'); ?></a></li>
								<li><a href="#pro" class="wvn-navigation-link"><?php esc_html_e('PRO', 'woovina-extra'); ?></a></li>
								<?php foreach ($categories as $key => $name) : if($key == 'other') continue; ?>
									<li><a href="#<?php echo esc_attr($key); ?>" class="wvn-navigation-link"><?php echo esc_html($name); ?></a></li>
								<?php endforeach; ?>
								<?php if(isset($categories['other'])) : ?><li><a href="#other" class="wvn-navigation-link"><?php esc_html_e('Other', 'woovina-extra'); ?></a></li><?php endif; ?>
							</ul>
						</nav>
						<div clas="wvn-search">
							<input type="text" class="wvn-search-input" name="wvn-search" value="" placeholder="<?php esc_html_e('Search demos...', 'woovina-extra'); ?>">
						</div>
					</div>
				<?php endif; ?>

				<div class="themes wp-clearfix">

					<?php
					// Loop through all demos
					foreach ($demos as $demo => $key) {

						// Vars
						$item_categories 	= WooVina_Demos::get_demo_item_categories($key);
						$demo_class 		= isset($key['demo_class']) ? $key['demo_class'] : 'free-demo';						
						$demo_access 		= WooVina_Demos::demo_access($demo_class, $demo);						
					?>

						<div class="theme-wrap <?php echo esc_attr($demo_access);?>" data-categories="<?php echo esc_attr($item_categories); ?>" data-name="<?php echo esc_attr(strtolower($demo)); ?>">

							<div class="theme wvn-open-popup <?php echo esc_attr($demo_class); ?>" data-demo-id="<?php echo esc_attr($demo); ?>">

								<div class="theme-screenshot">
									<img src="<?php echo $key['preview_image']; ?>" />

									<div class="demo-import-loader preview-all preview-all-<?php echo esc_attr($demo); ?>"></div>

									<div class="demo-import-loader preview-icon preview-<?php echo esc_attr($demo); ?>"><i class="custom-loader"></i></div>
								</div>

								<div class="theme-id-container">
		
									<h2 class="theme-name" id="<?php echo esc_attr($demo); ?>"><span><?php echo ucwords($demo); ?></span></h2>

									<div class="theme-actions">
										<a class="button button-primary" href="<?php echo $key['preview_url']; ?>" target="_blank"><?php _e('Live Preview', 'woovina-extra'); ?></a>
									</div>

								</div>

							</div>

						</div>

					<?php } ?>

				</div>

			</div>

		</div>

	<?php }
}
new WVN_Install_Demos();