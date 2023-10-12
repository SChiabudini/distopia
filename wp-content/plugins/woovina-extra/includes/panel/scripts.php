<?php
/**
 * Scripts Panel
 *
 * @package WooVina_Extra
 * @category Core
 * @author WooVina
 */

use Leafo\ScssPhp\Compiler;

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Start Class
class WooVina_Extra_Scripts_Panel {

	/**
	 * Start things up
	 */
	public function __construct() {

		if(is_admin()) {

			// Add panel menu
			add_action('admin_menu', 				array($this, 'add_page'), 10);

			// Add custom scripts
			add_action('admin_enqueue_scripts', 	array($this, 'admin_scripts'));

			// Register panel settings
			add_action('admin_init', 				array($this, 'register_settings'));

		} else {

			// Enqueue scripts
			add_action('wp_enqueue_scripts', 		array($this, 'enqueue_scripts'), 999);

			// Add body classes
			add_filter('body_class', 				array($this, 'body_classes'));

		}

	}

	/**
	 * Return scripts
	 *
	 * @since 1.2.1
	 */
	private static function get_scripts() {

		$scripts = array(
			'we_customSelect_script'        => array(
				'label' => esc_html__('Custom Select', 'woovina-extra'),
				'desc'  => esc_html__('This script uses the native select box and add overlays a stylable <span> element in order to acheive the desired look.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_dropDownSearch_script'      => array(
				'label' => esc_html__('Drop Down Search', 'woovina-extra'),
				'desc'  => esc_html__('This script is for the drop down search style in your navigation.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_headerReplaceSearch_script' => array(
				'label' => esc_html__('Header Replace Search', 'woovina-extra'),
				'desc'  => esc_html__('This script is for the header replace search style in your navigation.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_overlaySearch_script'       => array(
				'label' => esc_html__('Overlay Search', 'woovina-extra'),
				'desc'  => esc_html__('This script is for the overlay search style in your navigation.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_fitVids_script'             => array(
				'label' => esc_html__('FitVids', 'woovina-extra'),
				'desc'  => esc_html__('This script is to achieve fluid width videos in your responsive web design, your videos looks good on all devices.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_fixedFooter_script'         => array(
				'label' => esc_html__('Fixed Footer', 'woovina-extra'),
				'desc'  => esc_html__('This script adds a height to your content to keep your footer at the bottom of your page, the Fixed Footer option need to be activated in the customizer&rsquo;s Footer Widgets section.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_parallax_footer_script'     => array(
				'label' => esc_html__('Parallax Footer', 'woovina-extra'),
				'desc'  => esc_html__('This script is used for the parallax footer effect.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_fullScreenMenu_script'      => array(
				'label' => esc_html__('Full Screen Menu', 'woovina-extra'),
				'desc'  => esc_html__('This script is to open your menu in overlay for the full screen header style, you can disable this function if you do not use this header style.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_headerSearchForm_script'    => array(
				'label' => esc_html__('Header Search Form', 'woovina-extra'),
				'desc'  => esc_html__('This script is to add a class to the search form to make the label disappear when text is inserted, used on some header style like medium or full screen and the full screen mobile menu style.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_infiniteScroll_script'      => array(
				'label' => esc_html__('Infinite Scroll', 'woovina-extra'),
				'desc'  => esc_html__('This script create an infinite scrolling effect, used for the blog archives page if Infinite Scroll is selected as pagination style.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_isotope_script'             => array(
				'label' => esc_html__('Isotope', 'woovina-extra'),
				'desc'  => esc_html__('This script is to filter & sort layouts, used for the masonry grid style of your blog and will be used in some extensions.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_lightbox_script'            => array(
				'label' => esc_html__('Lightbox', 'woovina-extra'),
				'desc'  => esc_html__('This script enables you to overlay your images on the current page, used for the gallerie, single product and content images.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_matchHeight_script'         => array(
				'label' => esc_html__('Match Height', 'woovina-extra'),
				'desc'  => esc_html__('This script is a responsive equal heights script makes the height of all selected elements exactly equal, used for the grid blog style.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_megaMenu_script'            => array(
				'label' => esc_html__('Mega Menu', 'woovina-extra'),
				'desc'  => esc_html__('This script is to create the mega menus, so if you don&rsquo;t use mega menus at all on your website, you can disable this script.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_navNoClick_script'          => array(
				'label' => esc_html__('Nav No Click', 'woovina-extra'),
				'desc'  => esc_html__('This script is to prevent clicking on your links, used for the "Disable link" field of your menu items.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_scrollEffect_script'        => array(
				'label' => esc_html__('Scroll Effect', 'woovina-extra'),
				'desc'  => esc_html__('This script create an animation to your anchor links, mainly used for a one page site but also for some links like the comment link on your single posts.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_scrollTop_script'           => array(
				'label' => esc_html__('Scroll Top', 'woovina-extra'),
				'desc'  => esc_html__('This script is to displays the scroll up button and brings you back to the top of your page when you click on it.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_sidr_script'                => array(
				'label' => esc_html__('Sidr', 'woovina-extra'),
				'desc'  => esc_html__('This script is for easily creating responsive side menus, used for the Sidebar mobile menu style.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_dropdown_mobile_script'     => array(
				'label' => esc_html__('Drop Down Mobile', 'woovina-extra'),
				'desc'  => esc_html__('This script is used for the Drop Down mobile menu style.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_fullscreen_mobile_script'   => array(
				'label' => esc_html__('Full Screen Mobile', 'woovina-extra'),
				'desc'  => esc_html__('This script is used for the Full Screen mobile menu style.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_slick_script'               => array(
				'label' => esc_html__('Slick', 'woovina-extra'),
				'desc'  => esc_html__('This script is used for all the carousel of your site, gallerie images, WooCommerce single product images and thumbnails.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_smoothScroll_script'        => array(
				'label' => esc_html__('SmoothScroll', 'woovina-extra'),
				'desc'  => esc_html__('This script adds a smooth scrolling to the browser.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_superfish_script'           => array(
				'label' => esc_html__('Superfish', 'woovina-extra'),
				'desc'  => esc_html__('This script adds usability enhancements to existing multi-level drop-down menus.', 'woovina-extra'),
				'type'  => 'js',
			),
			'we_wooAccountLinks_script'    => array(
				'label'     => esc_html__('WooCommerce Account Links', 'woovina-extra'),
				'desc'      => esc_html__('This script is to switch between login/register in your account page.', 'woovina-extra'),
				'type'      => 'js',
				'condition' => class_exists('WooCommerce'),
			),
			'we_wooGridList_script'         => array(
				'label'     => esc_html__('WooCommerce Grid/List Buttons', 'woovina-extra'),
				'desc'      => esc_html__('This script is to switch between grid and list view on your WooCommerce catalog products.', 'woovina-extra'),
				'type'      => 'js',
				'condition' => class_exists('WooCommerce'),
			),
			'we_wooQuantityButtons_script'  => array(
				'label'     => esc_html__('WooCommerce Quantity Buttons', 'woovina-extra'),
				'desc'      => esc_html__('This script is to add a up and down button for the quantity input number on your WooCommerce single products and cart pages.', 'woovina-extra'),
				'type'      => 'js',
				'condition' => class_exists('WooCommerce'),
			),
			'we_wooReviewsScroll_script'    => array(
				'label'     => esc_html__('WooCommerce Reviews Scroll', 'woovina-extra'),
				'desc'      => esc_html__('This script is to show and scroll down to your review tab to your WooCommerce single products when you click on the review link.', 'woovina-extra'),
				'type'      => 'js',
				'condition' => class_exists('WooCommerce'),
			),

			// type css
			'we_fontAwesome_style'            => array(
				'label' => esc_html__('Font Awesome Icons v.4', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the font awesome icons version 4.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_font_awesome_style'           => array(
				'label' => esc_html__('Font Awesome Icons v.5', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the font awesome icons version 5.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_font_awesome_shims_style'     => array(
				'label' => esc_html__('Font Awesome Icons v.4 Shims', 'woovina-extra'),
				'desc'  => esc_html__('A shim helps to achieve compatibility with Font Awesome 4 icon references on a Font Awesome 5 installation.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_animate_style'            => array(
				'label' => esc_html__('Animate Style', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the animate style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_simpleLineIcons_style'        => array(
				'label' => esc_html__('Simple Line Icons', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the simple line icons.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_material_style'        		  => array(
				'label' => esc_html__('Material Design Icons', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the material design icons.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_material_ionicons_style'        		  => array(
				'label' => esc_html__('Material Design Ionicons', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the material design ionicons.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_topBar_style'                 => array(
				'label' => esc_html__('Top Bar', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the top bar.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_header_style'                 => array(
				'label' => esc_html__('Header', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the header.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_transparentHeader_style'      => array(
				'label' => esc_html__('Transparent Header', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the transparent header style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_topHeader_style'              => array(
				'label' => esc_html__('Top Header', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the top header style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_fullScreenHeader_style'       => array(
				'label' => esc_html__('Full Screen Header', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the full screen header style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_centerHeader_style'           => array(
				'label' => esc_html__('Center Header', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the center header style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_mediumHeader_style'           => array(
				'label' => esc_html__('Medium Header', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the medium header style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_verticalHeader_style'         => array(
				'label' => esc_html__('Vertical Header', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the vertical header style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_customHeader_style'           => array(
				'label' => esc_html__('Custom Header', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the custom header style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_navigation_style'             => array(
				'label' => esc_html__('Navigation', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the navigation of the principal menu.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_menu_links_effect_style'      => array(
				'label' => esc_html__('Links Effect', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the links effect of the principal menu.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_socialMenu_style'             => array(
				'label' => esc_html__('Social Icons Menu', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the social icons in the navigation of the header.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_pageHeader_style'             => array(
				'label' => esc_html__('Page Header', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the page header (title).', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_blog_style'                   => array(
				'label' => esc_html__('Blog', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the blog and post formats.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_blogLarge_style'              => array(
				'label' => esc_html__('Blog Large Style', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the blog large style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_blogGrid_style'               => array(
				'label' => esc_html__('Blog Grid Style', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the blog grid style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_blogThumbnail_style'          => array(
				'label' => esc_html__('Blog Thumbnail Style', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the blog thumbnail style.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_singlePostPrevNext_style'     => array(
				'label' => esc_html__('Single Post Next/Prev Pagination', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the next/previous pagination on single post.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_singlePostAuthorBio_style'    => array(
				'label' => esc_html__('Single Post Author Box', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the author box on single post.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_singlePostRelatedPosts_style' => array(
				'label' => esc_html__('Single Post Related Posts', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the related posts on single post.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_sidebar_style'                => array(
				'label' => esc_html__('Sidebar', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the sidebar.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_comment_style'                => array(
				'label' => esc_html__('Comment', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the comments.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_pagination_style'             => array(
				'label' => esc_html__('Pagination', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the pagination.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_footerWidgets_style'          => array(
				'label' => esc_html__('Footer Widgets', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the footer widgets area.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_footerBottom_style'           => array(
				'label' => esc_html__('Footer Bottom', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the footer bottom area.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_searchResults_style'          => array(
				'label' => esc_html__('Search Results', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the search results page.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_scrollTop_style'              => array(
				'label' => esc_html__('Scroll Top Button', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the scroll top button.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_errorPage_style'              => array(
				'label' => esc_html__('404 Page', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the 404 error page.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_responsive_style'             => array(
				'label' => esc_html__('Responsive', 'woovina-extra'),
				'desc'  => esc_html__('This style is all the css for the responsive view.', 'woovina-extra'),
				'type'  => 'css',
			),
			'we_wooMenuCart_style'         	=> array(
				'label'     => esc_html__('WooCommerce Menu Cart', 'woovina-extra'),
				'desc'      => esc_html__('This style is to display and hide your WooCommerce cart drop down in the navigation.', 'woovina-extra'),
				'type'      => 'css',
				'condition' => class_exists('WooCommerce'),
			),
			'we_wooNav_style'         => array(
				'label'     => esc_html__('WooCommerce Navigation', 'woovina-extra'),
				'desc'      => esc_html__('This style is for the single product navigation.', 'woovina-extra'),
				'type'      => 'css',
				'condition' => class_exists('WooCommerce'),
			),
			'we_wooOffCanvas_style'         => array(
				'label'     => esc_html__('WooCommerce Off Canvas Filter', 'woovina-extra'),
				'desc'      => esc_html__('This style is for the off canvas filter.', 'woovina-extra'),
				'type'      => 'css',
				'condition' => class_exists('WooCommerce'),
			),
			'we_wooMobileCart_style'         => array(
				'label'     => esc_html__('WooCommerce Mobile Cart Sidebar', 'woovina-extra'),
				'desc'      => esc_html__('This style is for the mini cart sidebar on mobile.', 'woovina-extra'),
				'type'      => 'css',
				'condition' => class_exists('WooCommerce'),
			),
			'we_wooCategoriesWidget_style'         => array(
				'label'     => esc_html__('WooCommerce Categories Widget', 'woovina-extra'),
				'desc'      => esc_html__('This style is for the WooCommerce categories widget.', 'woovina-extra'),
				'type'      => 'css',
				'condition' => class_exists('WooCommerce'),
			),
		);

		// Apply filters and return
		return apply_filters('we_theme_scripts', $scripts);

	}

	/**
	 * Add sub menu page
	 *
	 * @since 1.2.1
	 */
	public function add_page() {
		add_submenu_page(
			'woovina-panel',
			esc_html__('Scripts & Styles', 'woovina-extra'),
			esc_html__('Scripts & Styles', 'woovina-extra'),
			'manage_options',
			'woovina-panel-scripts',
			array($this, 'create_admin_page')
		);
	}

	/**
	 * Register a setting and its sanitization callback.
	 *
	 * @since 1.2.1
	 */
	public static function register_settings() {
		register_setting('we_scripts_settings', 'we_scripts_settings', array('WooVina_Extra_Scripts_Panel', 'validate_settings'));
	}

	/**
	 * Main Sanitization callback
	 *
	 * @since 1.2.1
	 */
	public static function validate_settings($settings) {

		// Get scripts array
		$scripts = self::get_scripts();

		foreach ($scripts as $key => $val) {

			$settings[$key] = ! empty($settings[$key]) ? true : false;

		}

		// Return the validated/sanitized settings
		return $settings;

	}

	/**
	 * Get settings.
	 *
	 * @since 1.2.1
	 */
	public static function get_setting($option = '') {

		$defaults = self::get_default_settings();

		$settings = wp_parse_args(get_option('we_scripts_settings', $defaults), $defaults);

		return isset($settings[ $option ]) ? $settings[ $option ] : false;

	}

	/**
	 * Get default settings value.
	 *
	 * @since 1.2.1
	 */
	public static function get_default_settings() {

		// Get scripts array
		$scripts = self::get_scripts();

		// Add array
		$default = array();

		foreach ($scripts as $key => $val) {
			$default[$key] = 1;
		}

		// Return
		return apply_filters('we_default_scripts', $default);

	}

	/**
	 * Settings page output
	 *
	 * @since 1.2.1
	 */
	public static function create_admin_page() {

		// If settings updated
		if(isset($_GET['settings-updated'])
			&& 'true' == $_GET['settings-updated']) {
			self::generate_js();
			self::generate_css();
		}

		// Get scripts array
		$scripts = self::get_scripts(); ?>

		<div class="wrap woovina-scripts-panel woovina-clr">

			<h1><?php esc_attr_e('Scripts & Styles Panel', 'woovina-extra'); ?></h1>

			<div class="woovina-desc notice notice-warning">
				<p><?php esc_html_e('Disable scripts and styles that you do not need to improve the loading speed of your website.', 'woovina-extra'); ?></p>
			</div>

			<form id="woovina-scripts-panel-form" method="post" action="options.php">

				<?php settings_fields('we_scripts_settings'); ?>

				<div class="woovina-modules">

					<div class="modules-top clr">

						<?php submit_button(); ?>

						<div class="wvn-all-wrap">
							<p><?php esc_attr_e('Switch to check or un-check every scripts:', 'woovina-extra'); ?></p>
							<div id="wvn-switch">
							    <input type="checkbox" name="we_scripts_settings[switch-all]" value="true" id="wvn-switch-all" <?php checked(true); ?>>
							    <label for="wvn-switch-all"></label>
							</div>
						</div>

						<ul class="btn-switcher clr">
							<li class="active"><a href="#all"><?php esc_html_e('All', 'woovina-extra'); ?></a></li>
							<li><a href="#js"><?php esc_html_e('JS', 'woovina-extra'); ?></a></li>
							<li><a href="#css"><?php esc_html_e('CSS', 'woovina-extra'); ?></a></li>
						</ul>

					</div>

					<div class="modules-inner clr">

						<?php
						// Loop through scripts
						foreach ($scripts as $key => $val) :

							// Display setting?
							$display = true;
							if(isset($val['condition'])) {
								$display = $val['condition'];
							}

							// Var
							$label  = isset($val['label']) ? $val['label'] : '';
							$desc  	= isset($val['desc']) ? $val['desc'] : '';
							$type  	= isset($val['type']) ? $val['type'] : '';

							// Classes
							$classes = 'column-wrap';
							$classes .= ! $display ? ' hidden' : '';

							// Get settings
							$settings = self::get_setting($key); ?>

							<div class="<?php echo esc_attr($classes); ?>" data-type="<?php echo esc_attr($type); ?>">

								<?php if($type) { ?>
									<div class="type <?php echo esc_attr($type); ?>"><?php echo esc_attr($type); ?></div>
								<?php } ?>

								<div class="column-inner clr">

									<h3 class="info"><?php echo esc_attr($label); ?></h3>
									<?php if($desc) { ?>
										<p class="desc"><?php echo esc_attr($desc); ?></p>
									<?php } ?>

									<div class="bottom-column">
										<label for="woovina-[<?php echo esc_attr($key); ?>]" class="title"><?php esc_attr_e('Enable or Disable', 'woovina-extra'); ?></label>
										<div id="wvn-switch">
										    <input type="checkbox" name="we_scripts_settings[<?php echo esc_attr($key); ?>]" value="true" class="wvn-checkbox" id="woovina-[<?php echo esc_attr($key); ?>]" <?php checked($settings); ?>>
										    <label for="woovina-[<?php echo esc_attr($key); ?>]"></label>
										</div>
									</div>

								</div>

							</div>

						<?php endforeach; ?>

					</div><!-- .modules-inner -->

					<?php submit_button(); ?>

				</div><!-- .woovina-modules -->

			</form>

		</div>

	<?php
	}

	/**
	 * Admin Scripts
	 *
	 * @since 1.2.1
	 */
	public static function admin_scripts($hook) {

		// Only load scripts when needed
		if(WE_ADMIN_PANEL_HOOK_PREFIX . '-scripts' != $hook) {
			return;
		}

		// CSS
		wp_enqueue_style('woovina-scripts-panel', plugins_url('/assets/css/scripts.min.css', __FILE__));

		// JS
		wp_enqueue_script('woovina-scripts-panel', plugins_url('/assets/js/scripts.min.js', __FILE__), false, true);

	}

	/**
	 * Returns all JS needed
	 *
	 * @since 1.2.1
	 */
	public static function generate_js() {

		// Return if is not WooVina or not writable
		if(! class_exists('WOOVINA_Theme_Class')
			|| ! self::is_writable('js')) {
			return;
		}

		// Scripts
		$customSelect 			= self::get_setting('we_customSelect_script');
		$dropDownSearch 		= self::get_setting('we_dropDownSearch_script');
		$headerReplaceSearch 	= self::get_setting('we_headerReplaceSearch_script');
		$overlaySearch 			= self::get_setting('we_overlaySearch_script');
		$fitVids 				= self::get_setting('we_fitVids_script');
		$fixedFooter 			= self::get_setting('we_fixedFooter_script');
		$parallax_footer 		= self::get_setting('we_parallax_footer_script');
		$fullScreenMenu 		= self::get_setting('we_fullScreenMenu_script');
		$verticalHeader 		= self::get_setting('we_verticalHeader_style');
		$headerSearchForm 		= self::get_setting('we_headerSearchForm_script');
		$infiniteScroll 		= self::get_setting('we_infiniteScroll_script');
		$isotope 				= self::get_setting('we_isotope_script');
		$lightbox 				= self::get_setting('we_lightbox_script');
		$matchHeight 			= self::get_setting('we_matchHeight_script');
		$megaMenu 				= self::get_setting('we_megaMenu_script');
		$navNoClick 			= self::get_setting('we_navNoClick_script');
		$scrollEffect 			= self::get_setting('we_scrollEffect_script');
		$scrollTop 				= self::get_setting('we_scrollTop_script');
		$sidr 					= self::get_setting('we_sidr_script');
		$dropdown_mobile 		= self::get_setting('we_dropdown_mobile_script');
		$fullscreen_mobile 		= self::get_setting('we_fullscreen_mobile_script');
		$slick 					= self::get_setting('we_slick_script');
		$smoothScroll 			= self::get_setting('we_smoothScroll_script');
		$superfish 				= self::get_setting('we_superfish_script');
		$wooAccountLinks 		= self::get_setting('we_wooAccountLinks_script');
		$wooGridList 			= self::get_setting('we_wooGridList_script');
		$wooQuantityButtons 	= self::get_setting('we_wooQuantityButtons_script');
		$wooReviewsScroll 		= self::get_setting('we_wooReviewsScroll_script');

		// Get js directory uri
		$tDir = get_template_directory() . '/assets/js/';

		// If a script is disabled
		if(! $customSelect
			|| ! $dropDownSearch
			|| ! $headerReplaceSearch
			|| ! $overlaySearch
			|| ! $fitVids
			|| ! $fixedFooter
			|| ! $parallax_footer
			|| ! $fullScreenMenu
			|| ! $verticalHeader
			|| ! $headerSearchForm
			|| ! $infiniteScroll
			|| ! $isotope
			|| ! $lightbox
			|| ! $matchHeight
			|| ! $megaMenu
			|| ! $navNoClick
			|| ! $scrollEffect
			|| ! $scrollTop
			|| ! $sidr
			|| ! $dropdown_mobile
			|| ! $fullscreen_mobile
			|| ! $slick
			|| ! $smoothScroll
			|| ! $superfish
			|| ! $wooAccountLinks
			|| ! $wooGridList
			|| ! $wooQuantityButtons
			|| ! $wooReviewsScroll) {

		    // Array
		    $aFiles = array();

		    // Load customSelect js
			if($customSelect) {
				$aFiles[] = $tDir .'devs/customselect.js';
				$aFiles[] = $tDir .'core/customSelect.js';
			}

		    // Load dropDownSearch js
			if($dropDownSearch) {
				$aFiles[] = $tDir .'core/dropDownSearch.js';
			}

		    // Load headerReplaceSearch js
			if($headerReplaceSearch) {
				$aFiles[] = $tDir .'core/headerReplaceSearch.js';
			}

		    // Load overlaySearch js
			if($overlaySearch) {
				$aFiles[] = $tDir .'core/overlaySearch.js';
			}

			// Load fitVids js
			if($fitVids) {
				$aFiles[] = $tDir .'devs/fitvids.js';
				$aFiles[] = $tDir .'core/fitVids.js';
			}

			// Load fixedFooter js
			if($fixedFooter) {
				$aFiles[] = $tDir .'core/fixedFooter.js';
			}

			// Load parallax footer js
			if($parallax_footer) {
				$aFiles[] = $tDir .'core/parallaxFooter.js';
			}

			// Load fullScreenMenu js
			if($fullScreenMenu) {
				$aFiles[] = $tDir .'core/fullScreenMenu.js';
			}

			// Load verticalHeader js
			if($verticalHeader) {
				$aFiles[] = $tDir .'core/verticalHeader.js';
			}

			// Load headerSearchForm js
			if($headerSearchForm) {
				$aFiles[] = $tDir .'core/headerSearchForm.js';
			}

			// Load infiniteScroll js
			if($infiniteScroll) {
				$aFiles[] = $tDir .'third/infinitescroll.js';
				$aFiles[] = $tDir .'core/infiniteScroll.js';
			}

			// Load isotope js
			if($isotope) {
				$aFiles[] = $tDir .'devs/isotope.js';
				$aFiles[] = $tDir .'core/isotope.js';
			}

			// Load matchHeight js
			if($matchHeight) {
				$aFiles[] = $tDir .'devs/matchHeight.js';
				$aFiles[] = $tDir .'core/matchHeight.js';
			}

			// Load megaMenu js
			if($megaMenu) {
				$aFiles[] = $tDir .'core/megaMenu.js';
			}

			// Load navnoclick js
			if($navNoClick) {
				$aFiles[] = $tDir .'core/navNoClick.js';
			}

			// Load scrollEffect js
			if($scrollEffect) {
				$aFiles[] = $tDir .'core/scrollEffect.js';
			}

			// Load scrollTop js
			if($scrollTop) {
				$aFiles[] = $tDir .'core/scrollTop.js';
			}

			// Load sidr js
			if($sidr) {
				$aFiles[] = $tDir .'devs/sidr.js';
				$aFiles[] = $tDir .'core/sidr.js';
			}

			// Load dropdown_mobile js
			if($dropdown_mobile) {
				$aFiles[] = $tDir .'core/dropDownMobile.js';
			}

			// Load fullscreen_mobile js
			if($fullscreen_mobile) {
				$aFiles[] = $tDir .'core/fullScreenMobile.js';
			}

			// Load slick js
			if($slick) {
				$aFiles[] = $tDir .'devs/slick.js';
				$aFiles[] = $tDir .'core/slick.js';
			}

			// Load smoothScroll js
			if($smoothScroll) {
				$aFiles[] = $tDir .'devs/smoothscroll.js';
			}

			// Load superfish js
			if($superfish) {
				$aFiles[] = $tDir .'devs/superfish.js';
				$aFiles[] = $tDir .'core/superfish.js';
			}

			// If WooCommerce exist
			if(WOOVINA_WOOCOMMERCE_ACTIVE) {

				// Remove brackets from categories and filter widgets
				$aFiles[] = $tDir .'third/woo/devs/wooWidgets.js';

		    	// Load wooAccountLinks js
		    	if($wooAccountLinks) {
					$aFiles[] = $tDir .'third/woo/devs/wooAccountLinks.js';
				}

		    	// Load wooGridList js
		    	if($wooGridList) {
					$aFiles[] = $tDir .'devs/cookie.js';
					$aFiles[] = $tDir .'third/woo/devs/wooGridList.js';
				}

		    	// Load wooQuantityButtons js
		    	if($wooQuantityButtons) {
					$aFiles[] = $tDir .'third/woo/devs/wooQuantityButtons.js';
				}

		    	// Load wooReviewsScroll js
		    	if($wooReviewsScroll) {
					$aFiles[] = $tDir .'third/woo/devs/wooReviewsScroll.js';
				}

			}
				
			// Check WP_Filesystem
			global $wp_filesystem;
			self::init_filesystem();

			// Get JS files content
			$strJS = '';
			foreach($aFiles as $file) :
			    $strJS .= $wp_filesystem->get_contents($file);
			endforeach;

			// Minifying JS files
			$jsMignifier = WooVina_Extra_JSMin::minify($strJS);

			// Putting all the scripts into one JS file
			$wp_filesystem->put_contents(self::get_file('js', 'path'), $jsMignifier);
		    
		} else {

			if(file_exists(self::get_file('js', 'path'))) {
				unlink(self::get_file('js', 'path'));
			}

		}

	}

	/**
	 * Returns all CSS needed
	 *
	 * @since 1.2.1
	 */
	public static function generate_css() {

		// Sass Compiler (vendor)
		require_once(WE_PATH .'/includes/panel/scssphp/scss.inc.php');

		// Return if is not WooVina or not writable
		if(! class_exists('WOOVINA_Theme_Class')
			|| ! self::is_writable('css')) {
			return;
		}

		// Styles & scripts
		$customSelect 			= self::get_setting('we_customSelect_script');
		$dropDownSearch 		= self::get_setting('we_dropDownSearch_script');
		$headerReplaceSearch 	= self::get_setting('we_headerReplaceSearch_script');
		$overlaySearch 			= self::get_setting('we_overlaySearch_script');
		$megaMenu 				= self::get_setting('we_megaMenu_script');
		$sidr 					= self::get_setting('we_sidr_script');
		$dropdown_mobile 		= self::get_setting('we_dropdown_mobile_script');
		$fullscreen_mobile 		= self::get_setting('we_fullscreen_mobile_script');
		$fontAwesome 			= self::get_setting('we_fontAwesome_style');
		$fontAwesome5 			= self::get_setting('we_font_awesome_style');
		$fontAwesome45 			= self::get_setting('we_font_awesome_shims_style');
		$animateStyle 			= self::get_setting('we_animate_style');	
		$simpleLineIcons 		= self::get_setting('we_simpleLineIcons_style');
		$fontMaterial 			= self::get_setting('we_material_style');
		$fontMaterialIonicons 	= self::get_setting('we_material_ionicons_style');
		$wooMenuCart 			= self::get_setting('we_wooMenuCart_style');
		$wooNav 				= self::get_setting('we_wooNav_style');
		$wooOffCanvas 			= self::get_setting('we_wooOffCanvas_style');
		$wooMobileCart 			= self::get_setting('we_wooMobileCart_style');
		$wooCategoriesWidget 	= self::get_setting('we_wooCategoriesWidget_style');
		$wooQuantityButtons 	= self::get_setting('we_wooQuantityButtons_script');
		$topBar 				= self::get_setting('we_topBar_style');
		$header 				= self::get_setting('we_header_style');
		$transparentHeader 		= self::get_setting('we_transparentHeader_style');
		$topHeader 				= self::get_setting('we_topHeader_style');
		$fullScreenHeader 		= self::get_setting('we_fullScreenHeader_style');
		$centerHeader 			= self::get_setting('we_centerHeader_style');
		$mediumHeader 			= self::get_setting('we_mediumHeader_style');
		$verticalHeader 		= self::get_setting('we_verticalHeader_style');
		$customHeader 			= self::get_setting('we_customHeader_style');
		$navigation 			= self::get_setting('we_navigation_style');
		$links_effect 			= self::get_setting('we_menu_links_effect_style');
		$socialMenu 			= self::get_setting('we_socialMenu_style');
		$pageHeader 			= self::get_setting('we_pageHeader_style');
		$blog 					= self::get_setting('we_blog_style');
		$blogLarge 				= self::get_setting('we_blogLarge_style');
		$blogGrid 				= self::get_setting('we_blogGrid_style');
		$blogThumbnail 			= self::get_setting('we_blogThumbnail_style');
		$singlePostPrevNext 	= self::get_setting('we_singlePostPrevNext_style');
		$singlePostAuthorBio 	= self::get_setting('we_singlePostAuthorBio_style');
		$singlePostRelatedPosts = self::get_setting('we_singlePostRelatedPosts_style');
		$sidebar 				= self::get_setting('we_sidebar_style');
		$comment 				= self::get_setting('we_comment_style');
		$pagination 			= self::get_setting('we_pagination_style');
		$footerWidgets 			= self::get_setting('we_footerWidgets_style');
		$footerBottom 			= self::get_setting('we_footerBottom_style');
		$searchResults 			= self::get_setting('we_searchResults_style');
		$scrollTop 				= self::get_setting('we_scrollTop_style');
		$errorPage 				= self::get_setting('we_errorPage_style');
		$responsive 			= self::get_setting('we_responsive_style');
		$slick 					= self::get_setting('we_slick_script');

		// Get css directory uri
		$tSass 	= get_template_directory() . '/sass/';
		$tDir 	= $tSass .'components/';
		$cssDir = get_template_directory() . '/assets/css/';

		// If a style is disabled
		if(! $customSelect
			|| ! $dropDownSearch
			|| ! $headerReplaceSearch
			|| ! $overlaySearch
			|| ! $megaMenu
			|| ! $sidr
			|| ! $dropdown_mobile
			|| ! $fullscreen_mobile
			|| ! $fontAwesome
			|| ! $fontAwesome5
			|| ! $fontAwesome45
			|| ! $animateStyle
			|| ! $simpleLineIcons
			|| ! $fontMaterial
			|| ! $fontMaterialIonicons
			|| ! $wooMenuCart
			|| ! $wooNav
			|| ! $wooOffCanvas
			|| ! $wooMobileCart
			|| ! $wooCategoriesWidget
			|| ! $wooQuantityButtons
			|| ! $topBar
			|| ! $header
			|| ! $transparentHeader
			|| ! $topHeader
			|| ! $fullScreenHeader
			|| ! $centerHeader
			|| ! $mediumHeader
			|| ! $verticalHeader
			|| ! $customHeader
			|| ! $navigation
			|| ! $links_effect
			|| ! $socialMenu
			|| ! $pageHeader
			|| ! $blog
			|| ! $blogLarge
			|| ! $blogGrid
			|| ! $blogThumbnail
			|| ! $singlePostPrevNext
			|| ! $singlePostAuthorBio
			|| ! $singlePostRelatedPosts
			|| ! $sidebar
			|| ! $comment
			|| ! $pagination
			|| ! $footerWidgets
			|| ! $footerBottom
			|| ! $searchResults
			|| ! $scrollTop
			|| ! $errorPage
			|| ! $responsive
			|| ! $slick) {

		    // Array
		    $aFiles = array();

			$aFiles[] = $tSass .'_config.scss';
			$aFiles[] = $tSass .'_mixins.scss';
			$aFiles[] = $tSass .'base/_main.scss';
			$aFiles[] = $tSass .'base/_normalize.scss';
			$aFiles[] = $tSass .'_layout.scss';
			$aFiles[] = $tSass .'base/_shared.scss';
			$aFiles[] = $tSass .'base/_typography.scss';
			$aFiles[] = $tSass .'base/_form.scss';
			$aFiles[] = $tDir .'plugins/_general.scss';

			// Load customSelect
			if($customSelect) {
				$aFiles[] = $tDir .'_custom-selects.scss';
			}

			// Load dropDownSearch
			if($dropDownSearch) {
				$aFiles[] = $tDir .'header/_search-dropdown.scss';
			}

		    // Load headerReplaceSearch
			if($headerReplaceSearch) {
				$aFiles[] = $tDir .'header/_search-replace.scss';
			}

		    // Load overlaySearch
			if($overlaySearch) {
				$aFiles[] = $tDir .'header/_search-overlay.scss';
			}

		    // Load megaMenu
			if($megaMenu) {
				$aFiles[] = $tDir .'header/_megamenu.scss';
			}

		    // Load sidr
			if($sidr) {
				$aFiles[] = $tDir .'plugins/_sidr.scss';
			}

		    // Load dropdown_mobile
			if($dropdown_mobile) {
				$aFiles[] = $tDir .'mobile/_dropdown-mobile.scss';
			}

		    // Load fullscreen_mobile
			if($fullscreen_mobile) {
				$aFiles[] = $tDir .'mobile/_fullscreen-mobile.scss';
			}

			// Load topBar
			if($topBar) {
				$aFiles[] = $tDir .'topbar/_topbar.scss';
				$aFiles[] = $tDir .'topbar/_topbar-content.scss';
				$aFiles[] = $tDir .'topbar/_topbar-menu.scss';
				$aFiles[] = $tDir .'topbar/_topbar-social.scss';
			}

			// Load header
			if($header) {
				$aFiles[] = $tDir .'header/_header.scss';
			}

			// Load transparentHeader
			if($transparentHeader) {
				$aFiles[] = $tDir .'header/_header-transparent.scss';
			}

			// Load topHeader
			if($topHeader) {
				$aFiles[] = $tDir .'header/_header-top.scss';
			}

			// Load fullScreenHeader
			if($fullScreenHeader) {
				$aFiles[] = $tDir .'header/_header-fullscreen.scss';
			}

			// Load centerHeader
			if($centerHeader) {
				$aFiles[] = $tDir .'header/_header-center.scss';
			}

			// Load mediumHeader
			if($mediumHeader) {
				$aFiles[] = $tDir .'header/_header-medium.scss';
			}

			// Load verticalHeader
			if($verticalHeader) {
				$aFiles[] = $tDir .'header/_header-vertical.scss';
			}

			// Load customHeader
			if($customHeader) {
				$aFiles[] = $tDir .'header/_header-custom.scss';
			}

			// Load navigation
			if($navigation) {
				$aFiles[] = $tDir .'header/_navigation.scss';
			}

			// Load menu links effect
			if($links_effect) {
				$aFiles[] = $tDir .'header/_links_effect.scss';
			}

			// Load socialMenu
			if($socialMenu) {
				$aFiles[] = $tDir .'header/_socialmenu.scss';
			}

			// Load pageHeader
			if($pageHeader) {
				$aFiles[] = $tDir .'_page-header.scss';
			}

			// Load blog
			if($blog) {
				$aFiles[] = $tDir .'blog/_blog-entries.scss';
				$aFiles[] = $tDir .'blog/_blog-meta.scss';
				$aFiles[] = $tDir .'blog/_gallery-format.scss';
				$aFiles[] = $tDir .'blog/_link-format.scss';
				$aFiles[] = $tDir .'blog/_quote-format.scss';
				$aFiles[] = $tDir .'blog/_video-audio-format.scss';
				$aFiles[] = $tDir .'blog/_single-content.scss';
				$aFiles[] = $tDir .'blog/_single-post.scss';
				$aFiles[] = $tDir .'blog/_single-tags.scss';
			}

			// Load blogLarge
			if($blogLarge) {
				$aFiles[] = $tDir .'blog/_blog-large.scss';
			}

			// Load blogGrid
			if($blogGrid) {
				$aFiles[] = $tDir .'blog/_blog-grid.scss';
			}

			// Load blogThumbnail
			if($blogThumbnail) {
				$aFiles[] = $tDir .'blog/_blog-thumbnail.scss';
			}

			// Load singlePostPrevNext
			if($singlePostPrevNext) {
				$aFiles[] = $tDir .'blog/_single-next-prev.scss';
			}

			// Load singlePostAuthorBio
			if($singlePostAuthorBio) {
				$aFiles[] = $tDir .'blog/_single-author-bio.scss';
			}

			// Load singlePostRelatedPosts
			if($singlePostRelatedPosts) {
				$aFiles[] = $tDir .'blog/_single-related-posts.scss';
			}

			// Load sidebar
			if($sidebar) {
				$aFiles[] = $tDir .'sidebar/_sidebar.scss';
			}

			// Load comment
			if($comment) {
				$aFiles[] = $tDir .'_comments.scss';
			}

			// Load pagination
			if($pagination) {
				$aFiles[] = $tDir .'_pagination.scss';
			}

			// Load footerWidgets
			if($footerWidgets) {
				$aFiles[] = $tDir .'footer/_footer-widgets.scss';
			}

			// Load footerBottom
			if($footerBottom) {
				$aFiles[] = $tDir .'footer/_footer-bottom.scss';
			}

			// Load searchResults
			if($searchResults) {
				$aFiles[] = $tDir .'_search.scss';
			}

			// Load scrollTop
			if($scrollTop) {
				$aFiles[] = $tDir .'footer/_scroll-top.scss';
			}

			// Load errorPage
			if($errorPage) {
				$aFiles[] = $tDir .'_404.scss';
			}

			// Load responsive
			if($responsive) {
				$aFiles[] = $tDir .'_responsive.scss';
			}

			// If WooCommerce exist
			if(WOOVINA_WOOCOMMERCE_ACTIVE) {

		    	// Load wooCommerce
				$aFiles[] = $tSass .'woo/_woocommerce.scss';
				$aFiles[] = $tSass .'woo/_woo-responsive.scss';

		    	// Load wooMenuCart
				if($wooMenuCart) {
					$aFiles[] = $tSass .'woo/_woo-cart.scss';
				}

		    	// Load wooNav
				if($wooNav) {
					$aFiles[] = $tSass .'woo/_woo-nav.scss';
				}

		    	// Load wooOffCanvas
				if($wooOffCanvas) {
					$aFiles[] = $tSass .'woo/_woo-off-canvas.scss';
				}

		    	// Load wooMobileCart
				if($wooMobileCart) {
					$aFiles[] = $tSass .'woo/_woo-mobile-cart.scss';
				}

			    // Load wooCategoriesWidget
				if($wooCategoriesWidget) {
					$aFiles[] = $tSass .'woo/_woo-cat-widget.scss';
				}

			    // Load wooQuantityButtons
				if($wooQuantityButtons) {
					$aFiles[] = $tSass .'woo/_woo-quantity.scss';
				}

			}

		    // Load slick to the end to prevent conflict
			if($slick) {
				$aFiles[] = $tDir .'plugins/_slick.scss';
				$aFiles[] = $tDir .'plugins/_slick-theme.scss';
			}

			// Check WP_Filesystem
			global $wp_filesystem;
			self::init_filesystem();

			$scss = new Compiler();
			$scss->setFormatter('Leafo\ScssPhp\Formatter\Compressed');

	      	// Get files content
			$strCSS = '';
			foreach($aFiles as $file) :
				$strCSS .= $wp_filesystem->get_contents($file);
			endforeach;

			// Compile the SCSS code
			$strCSS = $scss->compile($strCSS);

			// Putting all the styles into one CSS file
			$wp_filesystem->put_contents(self::get_file('css', 'path'), $strCSS);
		    
		} else {

			if(file_exists(self::get_file('css', 'path'))) {
				unlink(self::get_file('css', 'path'));
			}

		}

	}

	/**
	 * Enqueue scripts
	 *
	 * @since 1.2.1
	 */
	public static function enqueue_scripts() {

		// Add filter to altering via child theme
		$enqueue_scripts = apply_filters('woovina_enqueue_generated_files', true);

		// Return if enqueue_scripts is set to false through the filter
		if(! $enqueue_scripts) {
			return;
		}

		// Get current theme version
		$theme_version = wp_get_theme()->get('Version');

		// If script exist
		if(file_exists(self::get_file('js', 'path'))) {

			// Unregister default scripts
			wp_deregister_script('woovina-main');
			wp_deregister_script('infinitescroll');
			if(WOOVINA_WOOCOMMERCE_ACTIVE) {
				wp_deregister_script('woovina-woocommerce');
			}

			// If the lightbox script is disabled
			if(! self::get_setting('we_lightbox_script')) {
				wp_deregister_script('magnific-popup');
				wp_deregister_script('woovina-lightbox');
			}

			// Enqueue the JS
			wp_enqueue_script('woovina-main', self::get_file('js', 'uri'), array('jquery'), $theme_version, true);

			// Localize array
			if(class_exists('WOOVINA_Theme_Class')) {
				wp_localize_script('woovina-main', 'woovinaLocalize', WOOVINA_Theme_Class::localize_array());
			}

		}

		// If style exist
		if(file_exists(self::get_file('css', 'path'))) {

			// Unregister default styles
			wp_deregister_style('woovina-style');
			if(! self::get_setting('we_fontAwesome_style')) {
				wp_deregister_style('fontawesome');
			}
			if(! self::get_setting('we_font_awesome_style')) {
				wp_deregister_style('font-awesome');
			}
			if(! self::get_setting('we_font_awesome_shims_style')) {
				wp_deregister_style('font-awesome-shims');
			}
			if(! self::get_setting('we_animate_style')) {
				wp_deregister_style('animate');
			}
			if(! self::get_setting('we_simpleLineIcons_style')) {
				wp_deregister_style('simple-line-icons');
			}
			if(! self::get_setting('we_material_style')) {
				wp_deregister_style('material');
			}
			if(! self::get_setting('we_material_ionicons_style')) {
				wp_deregister_style('ionicons');
			}
			if(! self::get_setting('we_lightbox_script')) {
				wp_deregister_style('magnific-popup');
			}
			if(WOOVINA_WOOCOMMERCE_ACTIVE) {
				wp_deregister_style('woovina-woocommerce');
			}

			// Enqueue the CSS
			wp_enqueue_style('woovina-style', self::get_file('css', 'uri'), false, $theme_version);

		}

	}

	/**
	 * Add body classes
	 *
	 * @since 1.2.1
	 */
	public static function body_classes($classes) {

		// If the isotope script is disabled
		if(! self::get_setting('we_isotope_script')) {
			$classes[] = 'no-isotope';
		}

		// If the lightbox script is disabled
		if(! self::get_setting('we_lightbox_script')) {
			$classes[] = 'no-lightbox';
		}

		// If the scroll up script is disabled
		if(! self::get_setting('we_scrollTop_style')) {
			$classes[] = 'no-scroll-top';
		}

		// If the sidr script is disabled
		if(! self::get_setting('we_sidr_script')) {
			$classes[] = 'no-sidr';
		}

		// If the carousel script is disabled
		if(! self::get_setting('we_slick_script')) {
			$classes[] = 'no-carousel';
		}

		// If the match height script is disabled
		if(! self::get_setting('we_matchHeight_script')) {
			$classes[] = 'no-matchheight';
		}

		// Return classes
		return $classes;
	}

	/**
	 * Instantiates the WordPress filesystem
	 *
	 * @since 1.2.1
	 */
	public static function init_filesystem() {

		// The Wordpress filesystem.
		global $wp_filesystem;

		if(empty($wp_filesystem)) {
			require_once(ABSPATH . '/wp-admin/includes/file.php');
			WP_Filesystem();
		}

		return $wp_filesystem;

	}

	/**
	 * Gets file path or url
	 *
	 * @since 1.2.1
	 * @link http://aristath.github.io/blog/avoid-dynamic-css-in-head
	 */
	private static function get_file($return = 'js', $target = 'path') {

		// Get the upload directory
		$upload_dir 	= wp_upload_dir();

		$js_file   		= 'main-scripts.js';
		$css_file   	= 'main-style.css';
		$folder_path 	= $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'woovina';

		// The complete path to the files
		$js_path 		= $folder_path . DIRECTORY_SEPARATOR . $js_file;
		$css_path 		= $folder_path . DIRECTORY_SEPARATOR . $css_file;

		// Get the URL directory
		$uri_folder 	= $upload_dir['baseurl'];

		// Build the URL of the files
		$js_uri 		= trailingslashit($uri_folder) . 'woovina/' . $js_file;
		$css_uri 		= trailingslashit($uri_folder) . 'woovina/' . $css_file;

		// Return the JS path
		if('js' == $return
			&& 'path' == $target) {
			return $js_path;
		}

		// Return the CSS path
		elseif('css' == $return
			&& 'path' == $target) {
			return $css_path;
		}

		// Return the JS URL
		elseif('js' == $return
			&& 'uri' == $target) {
			return $js_uri;
		}

		// Return the CSS URL
		elseif('css' == $return
			&& 'uri' == $target) {
			return $css_uri;
		}

	}

	/**
	 * Check if the file is writable
	 *
	 * @since 1.2.1
	 * @link http://aristath.github.io/blog/avoid-dynamic-css-in-head
	 */
	public static function is_writable($return = 'js') {

		// Get the upload directory
		$upload_dir 	= wp_upload_dir();

		$js_file   		= '/main-scripts.js';
		$css_file   	= '/main-style.css';
		$folder_path 	= $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'woovina';

		// Check if the folder exist
		if(file_exists($folder_path)) {

			// If JS file
			if('js' == $return) {

				// Check if the folder is writable
				if(! is_writable($folder_path)) {

					// If the folder is not writable, check if the file is
					if(! file_exists($folder_path . $js_file)) {
						return false;
					} else {
						// Check if the file writable
						if(! is_writable($folder_path . $js_file)) {
							return false;
						}
					}

				} else {

					// If the folder is writable, check if the file is
					if(file_exists($folder_path . $js_file)) {
						// Check if the file writable
						if(! is_writable($folder_path . $js_file)) {
							return false;
						}
					}

				}

			}

			// If CSS file
			elseif('css' == $return) {

				// Check if the folder is writable
				if(! is_writable($folder_path)) {

					// If the folder is not writable, check if the file is
					if(! file_exists($folder_path . $css_file)) {
						return false;
					} else {
						// Check if the file writable
						if(! is_writable($folder_path . $css_file)) {
							return false;
						}
					}

				} else {

					// If the folder is writable, check if the file is
					if(file_exists($folder_path . $css_file)) {
						// Check if the file writable
						if(! is_writable($folder_path . $css_file)) {
							return false;
						}
					}

				}

			}

		} else {
			// Returns true or false
			return wp_mkdir_p($folder_path);
		}

		// If we passed all of the above tests, the file is writable.
		return true;

	}

}
new WooVina_Extra_Scripts_Panel();