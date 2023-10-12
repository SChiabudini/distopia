<?php
/**
 * Plugin Name:			WooVina Custom Sidebar
 * Plugin URI:			https://woovina.com/extension/woovina-custom-sidebar
 * Description:			Generates an unlimited number of sidebars and place them on any page you wish.
 * Version:				1.1.1
 * Author:				WooVina
 * Author URI:			https://woovina.com/
 * Requires at least:	4.5.0
 * Tested up to:		5.2.3
 *
 * Text Domain: woovina-custom-sidebar
 * Domain Path: /languages/
 *
 * @package WooVina_Custom_Sidebar
 * @category Core
 * @author WooVina
 * @see https://github.com/pojome/pojo-sidebars/
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

/**
 * Returns the main instance of WooVina_Custom_Sidebar to prevent the need to use globals.
 *
 * @since  1.0
 * @return object WooVina_Custom_Sidebar
 */
function WooVina_Custom_Sidebar() {
	return WooVina_Custom_Sidebar::instance();
} // End WooVina_Custom_Sidebar()

WooVina_Custom_Sidebar();

/**
 * Main WooVina_Custom_Sidebar Class
 *
 * @class WooVina_Custom_Sidebar
 * @version	1.0
 * @since 1.1
 * @package	WooVina_Custom_Sidebar
 */
final class WooVina_Custom_Sidebar {
	/**
	 * WooVina_Custom_Sidebar The single instance of WooVina_Custom_Sidebar.
	 * @var 	object
	 * @access  private
	 * @since 	1.0
	 */
	private static $_instance = null;

	protected $_menu_parent = '';
	protected $_sidebars = null;

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
		$this->token 			= 'woovina-custom-sidebar';
		$this->plugin_url 		= plugin_dir_url(__FILE__);
		$this->plugin_path 		= plugin_dir_path(__FILE__);
		$this->version 			= '1.1.1';

		register_activation_hook(__FILE__, array($this, 'install'));

		add_action('init', array($this, 'wcs_load_plugin_textdomain'));
		add_action('init', array( $this, 'updater' ), 1);
		add_action('init', array($this, 'wcs_setup'));
	}

	/**
	 * Main WooVina_Custom_Sidebar Instance
	 *
	 * Ensures only one instance of WooVina_Custom_Sidebar is loaded or can be loaded.
	 *
	 * @since 1.1
	 * @static
	 * @see WooVina_Custom_Sidebar()
	 * @return Main WooVina_Custom_Sidebar instance
	 */
	public static function instance() {
		if(is_null(self::$_instance))
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 * @access  public
	 * @since   1.0
	 * @return  void
	 */
	public function wcs_load_plugin_textdomain() {
		load_plugin_textdomain('woovina-custom-sidebar', false, dirname(plugin_basename(__FILE__)) . '/languages/');
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.1
	 */
	public function __clone() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), '1.0');
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.1
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
	 * Initialize License Updater.
	 * Load Updater initialize.
	 * @return void
	 */
	public function updater() {
		// Plugin Updater Code
		if(class_exists('WooVina_Plugin_Updater')) {
			$license = new WooVina_Plugin_Updater(__FILE__, 'WooVina Custom Sidebar', $this->version, 'WooVina Team');
		}
	}
	
	/**
	 * Setup all the things.
	 * Only executes if WooVina or a child theme using WooVina as a parent is active and the extension specific filter returns true.
	 * @return void
	 */
	public function wcs_setup() {
		$theme = wp_get_theme();

		if('WooVina' == $theme->name || 'woovina' == $theme->template) {
			if(class_exists('WooVina_Extra')) {
				$this->_menu_parent = 'woovina-panel';
			} else {
				$this->_menu_parent = 'themes.php';
			}
			$this->register_taxonomy();
			$this->register_sidebars();
			add_action('admin_menu', array($this, 'register_menu'), 11);
			add_action('admin_head', array($this, 'menu_highlight'));
			add_filter('manage_edit-woovina_sidebars_columns', array($this, 'manage_columns'));
			add_filter('manage_woovina_sidebars_custom_column', array($this, 'manage_custom_columns'), 10, 3);
			add_filter('manage_edit-woovina_sidebars_sortable_columns', array($this, 'sortable_columns'));
			add_action('admin_head', array($this, 'admin_head'));
			add_action('admin_footer', array($this, 'admin_footer'));
		}
	}

	/**
	 * Register Sidebars taxonomy.
	 */
	protected function register_taxonomy() {

		$labels = array(
			'name' 					=> esc_html__('Sidebars', 'woovina-custom-sidebar'),
			'singular_name' 		=> esc_html__('Sidebar', 'woovina-custom-sidebar'),
			'menu_name' 			=> esc_html_x('Sidebars', 'Admin menu name', 'woovina-custom-sidebar'),
			'search_items' 			=> esc_html__('Search Sidebars', 'woovina-custom-sidebar'),
			'all_items' 			=> esc_html__('All Sidebars', 'woovina-custom-sidebar'),
			'parent_item' 			=> esc_html__('Parent Sidebar', 'woovina-custom-sidebar'),
			'parent_item_colon' 	=> esc_html__('Parent Sidebar:', 'woovina-custom-sidebar'),
			'edit_item' 			=> esc_html__('Edit Sidebar', 'woovina-custom-sidebar'),
			'update_item' 			=> esc_html__('Update Sidebar', 'woovina-custom-sidebar'),
			'add_new_item' 			=> esc_html__('Add New Sidebar', 'woovina-custom-sidebar'),
			'new_item_name' 		=> esc_html__('New Sidebar Name', 'woovina-custom-sidebar'),
		);

		$args = array(
			'hierarchical' 			=> false,
			'labels' 				=> $labels,
			'public' 				=> false,
			'show_in_nav_menus' 	=> false,
			'show_ui' 				=> true,
			'capabilities' 			=> array('manage_options'),
			'query_var' 			=> false,
			'rewrite' 				=> false,
		);

		register_taxonomy(
			'woovina_sidebars',
			apply_filters('woovina_taxonomy_objects_sidebars', array()),
			apply_filters('woovina_taxonomy_args_sidebars', $args)
		);

	}

	/**
	 * Return the sidebar.
	 */
	public function get_sidebars() {

		if(is_null($this->_sidebars)) {
			$this->_sidebars = get_terms(
				'woovina_sidebars',
				array(
					'hide_empty' => false,
				)
			);
		}

		return $this->_sidebars;

	}

	/**
	 * If has sidebar.
	 */
	public function has_sidebars() {

		$sidebars = $this->get_sidebars();
		return ! empty($sidebars);

	}

	/**
	 * Register the sidebar.
	 */
	public function register_sidebars() {

		if(! self::has_sidebars()) {
			return;
		}
		
		$sidebars = self::get_sidebars();
		
		foreach ($sidebars as $sidebar) {
			$sidebar_classes = array('woovina-sidebar');
			
			register_sidebar(
				array(
					'id'            => 'wcs-' . sanitize_title($sidebar->name),
					'name'          => $sidebar->name,
					'description'   => $sidebar->description,
					'before_widget' => '<div class="sidebar-box %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				)
			);

		}

	}

	/**
	 * Register the Sidebars menu.
	 */
	public function register_menu() {

		add_submenu_page(
			$this->_menu_parent,
			esc_html__('Sidebars', 'woovina-custom-sidebar'),
			esc_html__('Sidebars', 'woovina-custom-sidebar'),
			'manage_options',
			'edit-tags.php?taxonomy=woovina_sidebars'
		);

	}

	/**
	 * If has sidebar.
	 */
	public function menu_highlight() {

		global $parent_file, $submenu_file;
		
		if('edit-tags.php?taxonomy=woovina_sidebars' === $submenu_file) {
			$parent_file = $this->_menu_parent;
		}

	}

	/**
	 * Columns name.
	 */
	public function manage_columns($columns) {

		$col 		= $columns;
		$columns 	= array(
			'cb' 			=> $col['cb'],
			'name' 			=> $col['name'],
			'ID' 			=> esc_html__('ID', 'woovina-custom-sidebar'),
			'description' 	=> $col['description'],
		);
		
		return $columns;

	}

	/**
	 * Sortable columns.
	 */
	public function sortable_columns($sortable_columns) {

		$sortable_columns['ID'] = 'ID';
		return $sortable_columns;

	}

	/**
	 * Add prefix to the ID column.
	 */
	public function manage_custom_columns($value, $column_name, $term_id) {

		$term = get_term($term_id, 'woovina_sidebars');

		switch ($column_name) {
			case 'ID' :
				$value = 'wcs-' . sanitize_title($term->name);
				break;
		}
		
		return $value;

	}

	/**
	 * Hide the slug input.
	 */
	public function admin_head() {

		if('edit-woovina_sidebars' !== get_current_screen()->id) {
			return;
		} ?>

		<style>#addtag div.form-field.term-name-wrap > p, #edittag tr.form-field.term-name-wrap p, #addtag div.form-field.term-description-wrap > p, #edittag tr.form-field.term-description-wrap p { opacity: 0; }#the-list tr.inline-editor .inline-edit-col label:last-child, #addtag div.form-field.term-slug-wrap, #edittag tr.form-field.term-slug-wrap { display: none; }</style>

	<?php
	}

	/**
	 * Change the description of the inputs.
	 */
	public function admin_footer() {

		if('edit-woovina_sidebars' !== get_current_screen()->id) {
			return;
		} ?>

		<script>jQuery(document).ready(function($) {
				var $wrapper = $('#addtag, #edittag');
				$wrapper.find('tr.form-field.term-name-wrap p, div.form-field.term-name-wrap > p').text('<?php _e('The name of the widgets area', 'woovina-custom-sidebar'); ?>').css('opacity', '1');
				$wrapper.find('tr.form-field.term-description-wrap p, div.form-field.term-description-wrap > p').text('<?php _e('The description of the widgets area (optional)', 'woovina-custom-sidebar'); ?>').css('opacity', '1');
			});</script>

	<?php
	}

} // End Class
