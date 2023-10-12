<?php
/**
 * Adds custom metabox
 *
 * @package WooVina_Extra
 * @category Core
 * @author WooVina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// The Metabox class
if ( ! class_exists( 'WooVina_Post_Metabox' ) ) {

	/**
	 * Main ButterBean class.  Runs the show.
	 *
	 * @since  1.1.2
	 * @access public
	 */
	final class WooVina_Post_Metabox {

		private $post_types;
		private $default_control;
		private $custom_control;

		/**
		 * Register this class with the WordPress API
		 *
		 * @since 1.1.2
		 */
		private function setup_actions() {

			// Capabilities
			$capabilities = apply_filters( 'woovina_main_metaboxes_capabilities', 'manage_options' );

			// Post types to add the metabox to
			$this->post_types = apply_filters( 'woovina_main_metaboxes_post_types', array(
				'post',
				'page',
				'product',
				'elementor_library',
				'ae_global_templates',

			) );

			// Default butterbean controls
			$this->default_control = array(
				'select',
				'color',
				'image',
				'text',
				'number',
				'textarea',
			);

			// Custom butterbean controls
			$this->custom_control = array(
				'buttonset' 		=> 'WooVina_ButterBean_Control_Buttonset',
				'range' 			=> 'WooVina_ButterBean_Control_Range',
				'media' 			=> 'WooVina_ButterBean_Control_Media',
				'rgba-color' 		=> 'WooVina_ButterBean_Control_RGBA_Color',
				'multiple-select' 	=> 'WooVina_ButterBean_Control_Multiple_Select',
				'editor' 			=> 'WooVina_ButterBean_Control_Editor',
				'typography' 		=> 'WooVina_ButterBean_Control_Typography',
			);

			// Overwrite default controls
			add_filter( 'butterbean_pre_control_template', array( $this, 'default_control_templates' ), 10, 2 );

			// Register custom controls
			add_filter( 'butterbean_control_template', array( $this, 'custom_control_templates' ), 10, 2 );

			// Register new controls types
			add_action( 'butterbean_register', array( $this, 'register_control_types' ), 10, 2 );

			if ( current_user_can( $capabilities ) ) {

				// Register fields
				add_action( 'butterbean_register', array( $this, 'register' ), 10, 2 );

				// Register fields for the posts
				add_action( 'butterbean_register', array( $this, 'posts_register' ), 10, 2 );




				// Load scripts and styles.
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			}

			// Body classes
			add_filter( 'body_class', array( $this, 'body_class' ) );

			// Left sidebar
			add_filter( 'woovina_get_second_sidebar', array( $this, 'get_second_sidebar' ) );

			// Sidebar
			add_filter( 'woovina_get_sidebar', array( $this, 'get_sidebar' ) );

			// Display top bar
			add_filter( 'woovina_display_top_bar', array( $this, 'display_top_bar' ) );

			// Display header
			add_filter( 'woovina_display_header', array( $this, 'display_header' ) );

			// Custom menu
			add_filter( 'woovina_custom_menu', array( $this, 'custom_menu' ) );

			// Header style
			add_filter( 'woovina_header_style', array( $this, 'header_style' ) );

			// Left custom menu for center geader style
			add_filter( 'woovina_center_header_left_menu', array( $this, 'left_custom_menu' ) );

			// Custom header template
			add_filter( 'woovina_custom_header_template', array( $this, 'custom_header_template' ) );

			// Custom logo
			add_filter( 'get_custom_logo', array( $this, 'custom_logo' ) );

			// getustom logo ID for the retina function
			add_filter( 'woovina_custom_logo', array( $this, 'custom_logo_id' ) );

			// Custom retina logo
			add_filter( 'woovina_retina_logo', array( $this, 'custom_retina_logo' ) );

			// Custom logo max width
			add_filter( 'woovina_logo_max_width', array( $this, 'custom_logo_max_width' ) );

			// Custom logo max width tablet
			add_filter( 'woovina_logo_max_width_tablet', array( $this, 'custom_logo_max_width_tablet' ) );

			// Custom logo max width mobile
			add_filter( 'woovina_logo_max_width_mobile', array( $this, 'custom_logo_max_width_mobile' ) );

			// Custom logo max height
			add_filter( 'woovina_logo_max_height', array( $this, 'custom_logo_max_height' ) );

			// Custom logo max height tablet
			add_filter( 'woovina_logo_max_height_tablet', array( $this, 'custom_logo_max_height_tablet' ) );

			// Custom logo max height mobile
			add_filter( 'woovina_logo_max_height_mobile', array( $this, 'custom_logo_max_height_mobile' ) );

			// Menu colors
			add_filter( 'woovina_menu_link_color', array( $this, 'menu_link_color' ) );
			add_filter( 'woovina_menu_link_color_hover', array( $this, 'menu_link_color_hover' ) );
			add_filter( 'woovina_menu_link_color_active', array( $this, 'menu_link_color_active' ) );
			add_filter( 'woovina_menu_link_background', array( $this, 'menu_link_background' ) );
			add_filter( 'woovina_menu_link_hover_background', array( $this, 'menu_link_hover_background' ) );
			add_filter( 'woovina_menu_link_active_background', array( $this, 'menu_link_active_background' ) );
			add_filter( 'woovina_menu_social_links_bg', array( $this, 'menu_social_links_bg' ) );
			add_filter( 'woovina_menu_social_hover_links_bg', array( $this, 'menu_social_hover_links_bg' ) );
			add_filter( 'woovina_menu_social_links_color', array( $this, 'menu_social_links_color' ) );
			add_filter( 'woovina_menu_social_hover_links_color', array( $this, 'menu_social_hover_links_color' ) );

			// Display page header
			add_filter( 'woovina_display_page_header', array( $this, 'display_page_header' ) );

			// Display page header heading
			add_filter( 'woovina_display_page_header_heading', array( $this, 'display_page_header_heading' ) );

			// Page header style
			add_filter( 'woovina_page_header_style', array( $this, 'page_header_style' ) );

			// Page header title
			add_filter( 'woovina_title', array( $this, 'page_header_title' ) );

			// Page header subheading
			add_filter( 'woovina_post_subheading', array( $this, 'page_header_subheading' ) );

			// Display breadcrumbs
			add_filter( 'woovina_display_breadcrumbs', array( $this, 'display_breadcrumbs' ) );

			// Page header background image
			add_filter( 'woovina_page_header_background_image', array( $this, 'page_header_bg_image' ) );

			// Page header background color
			add_filter( 'woovina_post_title_background_color', array( $this, 'page_header_bg_color' ) );

			// Page header background image position
			add_filter( 'woovina_post_title_bg_image_position', array( $this, 'page_header_bg_image_position' ) );
			add_filter( 'woovina_post_title_bg_image_attachment', array( $this, 'page_header_bg_image_attachment' ) );
			add_filter( 'woovina_post_title_bg_image_repeat', array( $this, 'page_header_bg_image_repeat' ) );
			add_filter( 'woovina_post_title_bg_image_size', array( $this, 'page_header_bg_image_size' ) );

			// Page header height
			add_filter( 'woovina_post_title_height', array( $this, 'page_header_height' ) );

			// Page header background opacity
			add_filter( 'woovina_post_title_bg_overlay', array( $this, 'page_header_bg_opacity' ) );

			// Page header background overlay color
			add_filter( 'woovina_post_title_bg_overlay_color', array( $this, 'page_header_bg_overlay_color' ) );

			// Display footer widgets
			add_filter( 'woovina_display_footer_widgets', array( $this, 'display_footer_widgets' ) );

			// Display footer bottom
			add_filter( 'woovina_display_footer_bottom', array( $this, 'display_footer_bottom' ) );

























			// Custom footer template
			add_filter( 'woovina_custom_footer_template', array( $this, 'custom_footer_template' ) );



			// Custom CSS
			add_filter( 'woovina_head_css', array( $this, 'head_css' ) );

		}

		/**
		 * Load scripts and styles
		 *
		 * @since 1.1.2
		 */
		public function enqueue_scripts( $hook ) {

			// Only needed on these admin screens
			if ( $hook != 'post.php' && $hook != 'post-new.php' ) {
				return;
			}

			// Get global post
			global $post;

			// Return if post is not object
			if ( ! is_object( $post ) ) {
				return;
			}

			// Post types scripts
			$post_types_scripts = apply_filters( 'woovina_metaboxes_post_types_scripts', $this->post_types );

			// Return if wrong post type
			if ( ! in_array( $post->post_type, $post_types_scripts ) ) {
				return;
			}


			$min = ( SCRIPT_DEBUG ) ? '' : '.min';

			// Default style
			wp_enqueue_style( 'woovina-butterbean', plugins_url( '/controls/assets/css/butterbean'. $min .'.css', __FILE__ ) );






			// Default script.
			wp_enqueue_script( 'woovina-butterbean', plugins_url( '/controls/assets/js/butterbean'. $min .'.js', __FILE__ ), array( 'butterbean' ), '', true );

			// Metabox script
			wp_enqueue_script( 'woovina-metabox-script', plugins_url( '/assets/js/metabox.min.js', __FILE__ ), array( 'jquery' ), WE_VERSION, true );

			// Enqueue the select2 script, I use "woovina-select2" to avoid plugins conflicts
			wp_enqueue_script( 'woovina-select2', plugins_url( '/controls/assets/js/select2.full.min.js', __FILE__ ), array( 'jquery' ), false, true );

			// Enqueue the select2 style
			wp_enqueue_style( 'select2', plugins_url( '/controls/assets/css/select2.min.css', __FILE__ ) );

			// Enqueue color picker alpha
			wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( '/controls/assets/js/wp-color-picker-alpha.js', __FILE__ ), array( 'wp-color-picker' ), false, true );

		}

		/**
		 * Registers control types
		 *
		 * @since  1.2.4
		 */
		public function register_control_types( $butterbean ) {
			$controls = $this->custom_control;

			foreach ( $controls as $control => $class ) {

				require_once( WE_PATH . '/includes/metabox/controls/'. $control .'/class-control-'. $control .'.php' );
				$butterbean->register_control_type( $control, $class );

			}
		}

		/**
		 * Get custom control templates
		 *
		 * @since  1.2.4
		 */
		public function default_control_templates( $located, $slug ) {
			$controls = $this->default_control;

			foreach ( $controls as $control ) {

				if ( $slug === $control ) {
					return WE_PATH . '/includes/metabox/controls/'. $control .'/template.php';
				}

			}

			return $located;
		}

		/**
		 * Get custom control templates
		 *
		 * @since  1.2.4
		 */
		public function custom_control_templates( $located, $slug ) {
			$controls = $this->custom_control;

			foreach ( $controls as $control => $class ) {

				if ( $slug === $control ) {
					return WE_PATH . '/includes/metabox/controls/'. $control .'/template.php';
				}

			}

			return $located;
		}

		/**
		 * Registration callback
		 *
		 * @since 1.1.2
		 */
		public function register( $butterbean, $post_type ) {

			// Post types to add the metabox to
			$post_types = $this->post_types;

			// Theme branding
			if ( function_exists( 'woovina_theme_branding' ) ) {
				$brand = woovina_theme_branding();
			} else {
				$brand = 'WooVina';
			}

			// Register managers, sections, controls, and settings here.
			$butterbean->register_manager(
		        'woovina_mb_settings',
		        array(
		            'label'     => $brand . ' ' . esc_html__( 'Settings', 'woovina-extra' ),
		            'post_type' => $post_types,
		            'context'   => 'normal',
		            'priority'  => 'high'


		        )
		    );
			
			$manager = $butterbean->get_manager( 'woovina_mb_settings' );
			
			$manager->register_section(
		        'woovina_mb_main',
		        array(
		            'label' => esc_html__( 'Main', 'woovina-extra' ),
		            'icon'  => 'dashicons-admin-generic'


		        )
		    );

		    $manager->register_control(
		        'woovina_post_layout', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_main',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Content Layout', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select your custom layout.', 'woovina-extra' ),
					'choices' 		=> array(
						'' 				=> esc_html__( 'Default', 'woovina-extra' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'woovina-extra' ),
						'left-sidebar' 	=> esc_html__( 'Left Sidebar', 'woovina-extra' ),
						'full-width' 	=> esc_html__( 'Full Width', 'woovina-extra' ),
						'full-screen' 	=> esc_html__( '100% Full Width', 'woovina-extra' ),
						'both-sidebars' => esc_html__( 'Both Sidebars', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_layout', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );

		    $manager->register_control(
		        'woovina_both_sidebars_style', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_main',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Both Sidebars: Style', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select your both sidebars style.', 'woovina-extra' ),
					'choices' 		=> array(
						'' 				=> esc_html__( 'Default', 'woovina-extra' ),
						'ssc-style' 	=> esc_html__( 'Sidebar / Sidebar / Content', 'woovina-extra' ),
						'scs-style' 	=> esc_html__( 'Sidebar / Content / Sidebar', 'woovina-extra' ),
						'css-style' 	=> esc_html__( 'Content / Sidebar / Sidebar', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_both_sidebars_style', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );

		    $manager->register_control(
		        'woovina_both_sidebars_content_width', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_main',
		            'type'    		=> 'number',
		            'label'   		=> esc_html__( 'Both Sidebars: Content Width (%)', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter for custom content width.', 'woovina-extra' ),
		            'attr'    		=> array(
						'min' 	=> '0',
						'step' 	=> '1',
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_both_sidebars_content_width', // Same as control name.
		        array(
		            'sanitize_callback' => array( $this, 'sanitize_absint' ),


		        )
		    );

		    $manager->register_control(
		        'woovina_both_sidebars_sidebars_width', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_main',
		            'type'    		=> 'number',
		            'label'   		=> esc_html__( 'Both Sidebars: Sidebars Width (%)', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter for custom sidebars width.', 'woovina-extra' ),
		            'attr'    		=> array(
						'min' 	=> '0',
						'step' 	=> '1',
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_both_sidebars_sidebars_width', // Same as control name.
		        array(
		            'sanitize_callback' => array( $this, 'sanitize_absint' ),


		        )
		    );
			
			$manager->register_control(
		        'woovina_sidebar', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_main',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Sidebar', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select your custom sidebar.', 'woovina-extra' ),
					'choices' 		=> $this->helpers( 'widget_areas' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_sidebar', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );
			
			$manager->register_control(
		        'woovina_second_sidebar', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_main',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Second Sidebar', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select your custom second sidebar.', 'woovina-extra' ),
					'choices' 		=> $this->helpers( 'widget_areas' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_second_sidebar', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );
			
			$manager->register_control(
		        'woovina_disable_margins', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_main',
		            'type'    		=> 'buttonset',
		            'label'   		=> esc_html__( 'Paddings', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enable or disable the padding top and bottom.', 'woovina-extra' ),
					'choices' 		=> array(
						'enable' 	=> esc_html__( 'Enable', 'woovina-extra' ),
						'on' 		=> esc_html__( 'Disable', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_disable_margins', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',
		            'default' 			=> 'enable',


		        )
		    );
			
			$manager->register_section(
		        'woovina_mb_shortcodes',
		        array(
		            'label' => esc_html__( 'Shortcodes', 'woovina-extra' ),
		            'icon'  => 'dashicons-editor-code'


		        )
		    );
		
			$manager->register_control(
		        'woovina_shortcode_before_top_bar', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_shortcodes',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Shortcode Before Top Bar', 'woovina-extra' ),
		            'description'   => esc_html__( 'Add your shortcode to be displayed before the top bar.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_shortcode_before_top_bar', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
		
			$manager->register_control(
		        'woovina_shortcode_after_top_bar', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_shortcodes',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Shortcode After Top Bar', 'woovina-extra' ),
		            'description'   => esc_html__( 'Add your shortcode to be displayed after the top bar.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_shortcode_after_top_bar', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
		
			$manager->register_control(
		        'woovina_shortcode_before_header', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_shortcodes',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Shortcode Before Header', 'woovina-extra' ),
		            'description'   => esc_html__( 'Add your shortcode to be displayed before the header.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_shortcode_before_header', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
		
			$manager->register_control(
		        'woovina_shortcode_after_header', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_shortcodes',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Shortcode After Header', 'woovina-extra' ),
		            'description'   => esc_html__( 'Add your shortcode to be displayed after the header.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_shortcode_after_header', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
		
			$manager->register_control(
		        'woovina_has_shortcode', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_shortcodes',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Shortcode Before Title', 'woovina-extra' ),
		            'description'   => esc_html__( 'Add your shortcode to be displayed before the page title.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_has_shortcode', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
		
			$manager->register_control(
		        'woovina_shortcode_after_title', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_shortcodes',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Shortcode After Title', 'woovina-extra' ),
		            'description'   => esc_html__( 'Add your shortcode to be displayed after the page title.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_shortcode_after_title', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
		
			$manager->register_control(
		        'woovina_shortcode_before_footer_widgets', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_shortcodes',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Shortcode Before Footer Widgets', 'woovina-extra' ),
		            'description'   => esc_html__( 'Add your shortcode to be displayed before the footer widgets.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_shortcode_before_footer_widgets', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
		
			$manager->register_control(
		        'woovina_shortcode_after_footer_widgets', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_shortcodes',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Shortcode After Footer Widgets', 'woovina-extra' ),
		            'description'   => esc_html__( 'Add your shortcode to be displayed after the footer widgets.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_shortcode_after_footer_widgets', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
		
			$manager->register_control(
		        'woovina_shortcode_before_footer_bottom', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_shortcodes',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Shortcode Before Footer Bottom', 'woovina-extra' ),
		            'description'   => esc_html__( 'Add your shortcode to be displayed before the footer bottom.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_shortcode_before_footer_bottom', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
		
			$manager->register_control(
		        'woovina_shortcode_after_footer_bottom', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_shortcodes',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Shortcode After Footer Bottom', 'woovina-extra' ),
		            'description'   => esc_html__( 'Add your shortcode to be displayed after the footer bottom.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_shortcode_after_footer_bottom', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
			
			$manager->register_section(
		        'woovina_mb_header',
		        array(
		            'label' => esc_html__( 'Header', 'woovina-extra' ),
		            'icon'  => 'dashicons-sticky'


		        )
		    );
			
			$manager->register_control(
		        'woovina_display_top_bar', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_header',
		            'type'    		=> 'buttonset',
		            'label'   		=> esc_html__( 'Display Top Bar', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enable or disable the top bar.', 'woovina-extra' ),
					'choices' 		=> array(
						'default' 	=> esc_html__( 'Default', 'woovina-extra' ),
						'on' 		=> esc_html__( 'Enable', 'woovina-extra' ),
						'off' 		=> esc_html__( 'Disable', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_display_top_bar', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',
		            'default' 			=> 'default',


		        )
		    );
			
			$manager->register_control(
		        'woovina_display_header', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_header',
		            'type'    		=> 'buttonset',
		            'label'   		=> esc_html__( 'Display Header', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enable or disable the header.', 'woovina-extra' ),
					'choices' 		=> array(
						'default' 	=> esc_html__( 'Default', 'woovina-extra' ),
						'on' 		=> esc_html__( 'Enable', 'woovina-extra' ),
						'off' 		=> esc_html__( 'Disable', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_display_header', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',
		            'default' 			=> 'default',


		        )
		    );
			
			$manager->register_control(
		        'woovina_header_style', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_header',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Header Style', 'woovina-extra' ),
		            'description'   => esc_html__( 'Choose which header style to display on this page.', 'woovina-extra' ),
					'choices' 		=> array(
						'' 				=> esc_html__( 'Default', 'woovina-extra' ),
						'minimal' 		=> esc_html__( 'Minimal', 'woovina-extra' ),
						'transparent' 	=> esc_html__( 'Transparent', 'woovina-extra' ),
						'top'			=> esc_html__( 'Top Menu', 'woovina-extra' ),
						'full_screen'	=> esc_html__( 'Full Screen', 'woovina-extra' ),
						'center'		=> esc_html__( 'Center', 'woovina-extra' ),
						'medium'		=> esc_html__( 'Medium', 'woovina-extra' ),
						'vertical'		=> esc_html__( 'Vertical', 'woovina-extra' ),
						'custom'		=> esc_html__( 'Custom Header', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_header_style', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );
			
			$manager->register_control(
		        'woovina_center_header_left_menu', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_header',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Left Menu', 'woovina-extra' ),
		            'description'   => esc_html__( 'Choose which left menu to display on this page/post.', 'woovina-extra' ),
					'choices' 		=> $this->helpers( 'menus' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_center_header_left_menu', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );
			
			$manager->register_control(
		        'woovina_custom_header_template', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_header',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Select Template', 'woovina-extra' ),
		            'description'   => esc_html__( 'Choose a template created in Theme Panel > My Library.', 'woovina-extra' ),
					'choices' 		=> $this->helpers( 'library' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_custom_header_template', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );
			
			$manager->register_section(
		        'woovina_mb_logo',
		        array(
		            'label' => esc_html__( 'Logo', 'woovina-extra' ),
		            'icon'  => 'dashicons-format-image'


		        )
		    );
			
			$manager->register_control(
		        'woovina_custom_logo', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_logo',
		            'type'    		=> 'image',
		            'label'   		=> esc_html__( 'Logo', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a custom logo on this page/post.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_custom_logo', // Same as control name.
		        array(
		        	'sanitize_callback' => 'sanitize_key',


		        )
		    );
			
			$manager->register_control(
		        'woovina_custom_retina_logo', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_logo',
		            'type'    		=> 'image',
		            'label'   		=> esc_html__( 'Retina Logo', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a custom retina logo on this page/post.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_custom_retina_logo', // Same as control name.
		        array(
		        	'sanitize_callback' => 'sanitize_key',


		        )
		    );

		    $manager->register_control(
		        'woovina_custom_logo_max_width', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_logo',
		            'type'    		=> 'number',
		            'label'   		=> esc_html__( 'Max Width (px)', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter a custom max width for this page/post.', 'woovina-extra' ),
		            'attr'    		=> array(
						'min' 	=> '10',
						'step' 	=> '1',
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_custom_logo_max_width', // Same as control name.
		        array(
		            'sanitize_callback' => array( $this, 'sanitize_absint' ),


		        )
		    );

		    $manager->register_control(
		        'woovina_custom_logo_tablet_max_width', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_logo',
		            'type'    		=> 'number',
		            'label'   		=> esc_html__( 'Tablet: Max Width (px)', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter a custom max width for tablet view on this page/post.', 'woovina-extra' ),
		            'attr'    		=> array(
						'min' 	=> '10',
						'step' 	=> '1',
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_custom_logo_tablet_max_width', // Same as control name.
		        array(
		            'sanitize_callback' => array( $this, 'sanitize_absint' ),


		        )
		    );

		    $manager->register_control(
		        'woovina_custom_logo_mobile_max_width', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_logo',
		            'type'    		=> 'number',
		            'label'   		=> esc_html__( 'Mobile: Max Width (px)', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter a custom max width for mobile view on this page/post.', 'woovina-extra' ),
		            'attr'    		=> array(
						'min' 	=> '10',
						'step' 	=> '1',
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_custom_logo_mobile_max_width', // Same as control name.
		        array(
		            'sanitize_callback' => array( $this, 'sanitize_absint' ),


		        )
		    );

		    $manager->register_control(
		        'woovina_custom_logo_max_height', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_logo',
		            'type'    		=> 'number',
		            'label'   		=> esc_html__( 'Max Height (px)', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter a custom max height for this page/post.', 'woovina-extra' ),
		            'attr'    		=> array(
						'min' 	=> '10',
						'step' 	=> '1',
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_custom_logo_max_height', // Same as control name.
		        array(
		            'sanitize_callback' => array( $this, 'sanitize_absint' ),


		        )
		    );

		    $manager->register_control(
		        'woovina_custom_logo_tablet_max_height', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_logo',
		            'type'    		=> 'number',
		            'label'   		=> esc_html__( 'Tablet: Max Height (px)', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter a custom max height for tablet view on this page/post.', 'woovina-extra' ),
		            'attr'    		=> array(
						'min' 	=> '10',
						'step' 	=> '1',
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_custom_logo_tablet_max_height', // Same as control name.
		        array(
		            'sanitize_callback' => array( $this, 'sanitize_absint' ),


		        )
		    );

		    $manager->register_control(
		        'woovina_custom_logo_mobile_max_height', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_logo',
		            'type'    		=> 'number',
		            'label'   		=> esc_html__( 'Mobile: Max Height (px)', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter a custom max height for mobile view on this page/post.', 'woovina-extra' ),
		            'attr'    		=> array(
						'min' 	=> '10',
						'step' 	=> '1',
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_custom_logo_mobile_max_height', // Same as control name.
		        array(
		            'sanitize_callback' => array( $this, 'sanitize_absint' ),


		        )
		    );
			
			$manager->register_section(
		        'woovina_mb_menu',
		        array(
		            'label' => esc_html__( 'Menu', 'woovina-extra' ),
		            'icon'  => 'dashicons-menu'


		        )
		    );
			
			$manager->register_control(
		        'woovina_header_custom_menu', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Main Navigation Menu', 'woovina-extra' ),
		            'description'   => esc_html__( 'Choose which menu to display on this page/post.', 'woovina-extra' ),
					'choices' 		=> $this->helpers( 'menus' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_header_custom_menu', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );

		    $manager->register_control(
		        'woovina_menu_typo', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'typography',
		            'label'   		=> esc_html__( 'Typography', 'woovina-extra' ),
		            'description'   => esc_html__( 'Typography for the menu.', 'woovina-extra' ),
		            'settings'    	=> array(
						'family'      	=> 'woovina_menu_typo_font_family',
						'size'        	=> 'woovina_menu_typo_font_size',
						'weight'      	=> 'woovina_menu_typo_font_weight',
						'style'       	=> 'woovina_menu_typo_font_style',
						'transform' 	=> 'woovina_menu_typo_transform',
						'line_height' 	=> 'woovina_menu_typo_line_height',
						'spacing' 		=> 'woovina_menu_typo_spacing'
					),
					'l10n'        	=> array(),
		        )
		    );
				
			$manager->register_setting( 'woovina_menu_typo_font_family', 	array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$manager->register_setting( 'woovina_menu_typo_font_size',   	array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$manager->register_setting( 'woovina_menu_typo_font_weight', 	array( 'sanitize_callback' => 'sanitize_key', ) );
			$manager->register_setting( 'woovina_menu_typo_font_style',  	array( 'sanitize_callback' => 'sanitize_key', ) );
			$manager->register_setting( 'woovina_menu_typo_transform', 	array( 'sanitize_callback' => 'sanitize_key', ) );
			$manager->register_setting( 'woovina_menu_typo_line_height', 	array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$manager->register_setting( 'woovina_menu_typo_spacing', 		array( 'sanitize_callback' => 'sanitize_text_field', ) );
			
			$manager->register_control(
		        'woovina_menu_link_color', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'rgba-color',
		            'label'   		=> esc_html__( 'Link Color', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #555', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_menu_link_color', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_menu_link_color_hover', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'rgba-color',
		            'label'   		=> esc_html__( 'Link Color: Hover', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #13aff0', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_menu_link_color_hover', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_menu_link_color_active', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'rgba-color',
		            'label'   		=> esc_html__( 'Link Color: Current Menu Item', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #555', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_menu_link_color_active', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_menu_link_background', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'rgba-color',
		            'label'   		=> esc_html__( 'Link Background', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #fff', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_menu_link_background', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_menu_link_hover_background', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'rgba-color',
		            'label'   		=> esc_html__( 'Link Background: Hover', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #333', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_menu_link_hover_background', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_menu_link_active_background', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'rgba-color',
		            'label'   		=> esc_html__( 'Link Background: Current Menu Item', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #13aff0', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_menu_link_active_background', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_menu_social_links_bg', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'rgba-color',
		            'label'   		=> esc_html__( 'Simple Social: Background Color', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a background color for the simple social style. Hex code, ex: #fff', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_menu_social_links_bg', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_menu_social_hover_links_bg', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'rgba-color',
		            'label'   		=> esc_html__( 'Simple Social: Hover Background Color', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a background color for the simple social style. Hex code, ex: #333', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_menu_social_hover_links_bg', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_menu_social_links_color', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'rgba-color',
		            'label'   		=> esc_html__( 'Simple Social: Color', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color for the simple social style. Hex code, ex: #fff', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_menu_social_links_color', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_menu_social_hover_links_color', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_menu',
		            'type'    		=> 'rgba-color',
		            'label'   		=> esc_html__( 'Simple Social: Hover Color', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color for the simple social style. Hex code, ex: #13aff0', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_menu_social_hover_links_color', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_section(
		        'woovina_mb_title',
		        array(
		            'label' => esc_html__( 'Title', 'woovina-extra' ),
		            'icon'  => 'dashicons-admin-tools'


		        )
		    );
			
			$manager->register_control(
		        'woovina_disable_title', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'buttonset',
		            'label'   		=> esc_html__( 'Display Page Title', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enable or disable the page title.', 'woovina-extra' ),
					'choices' 		=> array(
						'default' 	=> esc_html__( 'Default', 'woovina-extra' ),
						'enable' 	=> esc_html__( 'Enable', 'woovina-extra' ),
						'on' 		=> esc_html__( 'Disable', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_disable_title', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',
		            'default' 			=> 'default',


		        )
		    );
			
			$manager->register_control(
		        'woovina_disable_heading', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'buttonset',
		            'label'   		=> esc_html__( 'Display Heading', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enable or disable the page title heading.', 'woovina-extra' ),
					'choices' 		=> array(
						'default' 	=> esc_html__( 'Default', 'woovina-extra' ),
						'enable' 	=> esc_html__( 'Enable', 'woovina-extra' ),
						'on' 		=> esc_html__( 'Disable', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_disable_heading', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',
		            'default' 			=> 'default',


		        )
		    );
		
			$manager->register_control(
		        'woovina_post_title', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Custom Title', 'woovina-extra' ),
		            'description'   => esc_html__( 'Alter the main title display.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title', // Same as control name.
		        array(
		            'sanitize_callback' => 'wp_kses_post',


		        )
		    );
		
			$manager->register_control(
		        'woovina_post_subheading', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Subheading', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter your page subheading. Shortcodes & HTML is allowed.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_subheading', // Same as control name.
		        array(
		            'sanitize_callback' => 'wp_kses_post',


		        )
		    );
			
			$manager->register_control(
		        'woovina_post_title_style', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Title Style', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a custom title style.', 'woovina-extra' ),
					'choices' 		=> $this->helpers( 'title_styles' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title_style', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );
			
			$manager->register_control(
		        'woovina_post_title_background_color', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'color',
		            'label'   		=> esc_html__( 'Title: Background Color', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a hex color code, ex: #333', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title_background_color', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_post_title_background', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'image',
		            'label'   		=> esc_html__( 'Title: Background Image', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a custom image for your main title.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title_background', // Same as control name.
		        array(
		        	'sanitize_callback' => 'sanitize_key',


		        )
		    );

		    $manager->register_control(
		        'woovina_post_title_bg_image_position', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Position', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select your background image position.', 'woovina-extra' ),
					'choices' 		=> array(
						'' 					=> esc_html__( 'Default', 'woovina-extra' ),
						'top left' 			=> esc_html__( 'Top Left', 'woovina-extra' ),
						'top center' 		=> esc_html__( 'Top Center', 'woovina-extra' ),
						'top right'  		=> esc_html__( 'Top Right', 'woovina-extra' ),
						'center left' 		=> esc_html__( 'Center Left', 'woovina-extra' ),
						'center center' 	=> esc_html__( 'Center Center', 'woovina-extra' ),
						'center right' 		=> esc_html__( 'Center Right', 'woovina-extra' ),
						'bottom left' 		=> esc_html__( 'Bottom Left', 'woovina-extra' ),
						'bottom center' 	=> esc_html__( 'Bottom Center', 'woovina-extra' ),
						'bottom right' 		=> esc_html__( 'Bottom Right', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title_bg_image_position', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );

		    $manager->register_control(
		        'woovina_post_title_bg_image_attachment', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Attachment', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select your background image attachment.', 'woovina-extra' ),
					'choices' 		=> array(
						'' 			=> esc_html__( 'Default', 'woovina-extra' ),
						'scroll' 	=> esc_html__( 'Scroll', 'woovina-extra' ),
						'fixed' 	=> esc_html__( 'Fixed', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title_bg_image_attachment', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );

		    $manager->register_control(
		        'woovina_post_title_bg_image_repeat', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Repeat', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select your background image repeat.', 'woovina-extra' ),
					'choices' 		=> array(
						'' 			=> esc_html__( 'Default', 'woovina-extra' ),
						'no-repeat' => esc_html__( 'No-repeat', 'woovina-extra' ),
						'repeat' 	=> esc_html__( 'Repeat', 'woovina-extra' ),
						'repeat-x' 	=> esc_html__( 'Repeat-x', 'woovina-extra' ),
						'repeat-y' 	=> esc_html__( 'Repeat-y', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title_bg_image_repeat', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );

		    $manager->register_control(
		        'woovina_post_title_bg_image_size', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Size', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select your background image size.', 'woovina-extra' ),
					'choices' 		=> array(
						'' 			=> esc_html__( 'Default', 'woovina-extra' ),
						'auto' 		=> esc_html__( 'Auto', 'woovina-extra' ),
						'cover' 	=> esc_html__( 'Cover', 'woovina-extra' ),
						'contain' 	=> esc_html__( 'Contain', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title_bg_image_size', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',


		        )
		    );

		    $manager->register_control(
		        'woovina_post_title_height', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'number',
		            'label'   		=> esc_html__( 'Title: Background Height', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select your custom height for your title background. Default is 400px.', 'woovina-extra' ),
		            'attr'    		=> array(
						'min' 	=> '0',
						'step' 	=> '1',
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title_height', // Same as control name.
		        array(
		            'sanitize_callback' => array( $this, 'sanitize_absint' ),


		        )
		    );

		    $manager->register_control(
		        'woovina_post_title_bg_overlay', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'number',
		            'label'   		=> esc_html__( 'Title: Background Overlay Opacity', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter a number between 0.1 to 1. Default is 0.5.', 'woovina-extra' ),
		            'attr'    		=> array(
						'min' 	=> '0.1',
						'max' 	=> '1',
						'step' 	=> '0.1',
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title_bg_overlay', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
			
			$manager->register_control(
		        'woovina_post_title_bg_overlay_color', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_title',
		            'type'    		=> 'color',
		            'label'   		=> esc_html__( 'Title: Background Overlay Color', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #333', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_title_bg_overlay_color', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_section(
		        'woovina_mb_breadcrumbs',
		        array(
		            'label' => esc_html__( 'Breadcrumbs', 'woovina-extra' ),
		            'icon'  => 'dashicons-admin-home'


		        )
		    );
			
			$manager->register_control(
		        'woovina_disable_breadcrumbs', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_breadcrumbs',
		            'type'    		=> 'buttonset',
		            'label'   		=> esc_html__( 'Display Breadcrumbs', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enable or disable the page title breadcrumbs.', 'woovina-extra' ),
					'choices' 		=> array(
						'default' 	=> esc_html__( 'Default', 'woovina-extra' ),
						'on' 		=> esc_html__( 'Enable', 'woovina-extra' ),
						'off' 		=> esc_html__( 'Disable', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_disable_breadcrumbs', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',
		            'default' 			=> 'default',


		        )
		    );
			
			$manager->register_control(
		        'woovina_breadcrumbs_color', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_breadcrumbs',
		            'type'    		=> 'color',
		            'label'   		=> esc_html__( 'Color', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #fff', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_breadcrumbs_color', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_breadcrumbs_separator_color', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_breadcrumbs',
		            'type'    		=> 'color',
		            'label'   		=> esc_html__( 'Separator Color', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #fff', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_breadcrumbs_separator_color', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_breadcrumbs_links_color', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_breadcrumbs',
		            'type'    		=> 'color',
		            'label'   		=> esc_html__( 'Links Color', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #fff', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_breadcrumbs_links_color', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_control(
		        'woovina_breadcrumbs_links_hover_color', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_breadcrumbs',
		            'type'    		=> 'color',
		            'label'   		=> esc_html__( 'Links Color: Hover', 'woovina-extra' ),
		            'description'   => esc_html__( 'Select a color. Hex code, ex: #ddd', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_breadcrumbs_links_hover_color', // Same as control name.
		        array(
		            'sanitize_callback' => 'butterbean_maybe_hash_hex_color',


		        )
		    );
			
			$manager->register_section(
		        'woovina_mb_footer',
		        array(
		            'label' => esc_html__( 'Footer', 'woovina-extra' ),
		            'icon'  => 'dashicons-hammer'


		        )
		    );
			
			$manager->register_control(
		        'woovina_display_footer_widgets', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_footer',
		            'type'    		=> 'buttonset',
		            'label'   		=> esc_html__( 'Display Footer Widgets Area', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enable or disable the footer widgets area.', 'woovina-extra' ),
					'choices' 		=> array(
						'default' 	=> esc_html__( 'Default', 'woovina-extra' ),
						'on' 		=> esc_html__( 'Enable', 'woovina-extra' ),
						'off' 		=> esc_html__( 'Disable', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_display_footer_widgets', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',
		            'default' 			=> 'default',


		        )
		    );
			
			$manager->register_control(
		        'woovina_display_footer_bottom', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_footer',
		            'type'    		=> 'buttonset',
		            'label'   		=> esc_html__( 'Display Copyright Area', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enable or disable the copyright area.', 'woovina-extra' ),
					'choices' 		=> array(
						'default' 	=> esc_html__( 'Default', 'woovina-extra' ),
						'on' 		=> esc_html__( 'Enable', 'woovina-extra' ),
						'off' 		=> esc_html__( 'Disable', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_display_footer_bottom', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',
		            'default' 			=> 'default',


		        )
		    );
			
			$manager->register_control(
		        'woovina_custom_footer_template', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_footer',
		            'type'    		=> 'select',
		            'label'   		=> esc_html__( 'Select Template', 'woovina-extra' ),
		            'description'   => esc_html__( 'Choose a template created in Theme Panel > My Library.', 'woovina-extra' ),
					'choices' 		=> $this->helpers( 'library' ),
		        )
		    );
			
			$manager->register_setting(
		        'woovina_custom_footer_template', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_key',
		        )
		    );

		}

		/**
		 * Registration callback
		 *
		 * @since 1.1.2
		 */
		public function posts_register( $butterbean, $post_type ) {

			// Return if it is not Post post type
			if ( 'post' != $post_type ) {
				return;
			}

			// Gets the manager object we want to add sections to.
			$manager = $butterbean->get_manager( 'woovina_mb_settings' );
						
			$manager->register_section(
		        'woovina_mb_post',
		        array(
		            'label' => esc_html__( 'Post', 'woovina-extra' ),
		            'icon'  => 'dashicons-admin-page',


		        )
		    );

		    $manager->register_control(
		        'woovina_post_oembed', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_post',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'oEmbed URL', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter a URL that is compatible with WP\'s built-in oEmbed feature. This setting is used for your video and audio post formats.', 'woovina-extra' ) .'<br /><a href="http://codex.wordpress.org/Embeds" target="_blank">'. esc_html__( 'Learn More', 'woovina-extra' ) .' &rarr;</a>',


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_oembed', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
			
			$manager->register_control(
		        'woovina_post_self_hosted_media', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_post',
		            'type'    		=> 'media',
		            'label'   		=> esc_html__( 'Self Hosted', 'woovina-extra' ),
		            'description'   => esc_html__( 'Insert your self hosted video or audio url here.', 'woovina-extra' ) .'<br /><a href="http://make.wordpress.org/core/2013/04/08/audio-video-support-in-core/" target="_blank">'. esc_html__( 'Learn More', 'woovina-extra' ) .' &rarr;</a>',


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_self_hosted_media', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );
			
			$manager->register_control(
		        'woovina_post_video_embed', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_post',
		            'type'    		=> 'textarea',
		            'label'   		=> esc_html__( 'Embed Code', 'woovina-extra' ),
		            'description'   => esc_html__( 'Insert your embed/iframe code. This setting is used for your video and audio post formats.', 'woovina-extra' ),
					'attr'    		=> array( 'row' => '2', 'cols' => '1' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_post_video_embed' // Same as control name.

		    );

		    $manager->register_control(
		        'woovina_link_format', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_post',
		            'type'    		=> 'text',
		            'label'   		=> esc_html__( 'Link', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter your external url. This setting is used for your link post formats.', 'woovina-extra' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_link_format', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',


		        )
		    );

		    $manager->register_control(
		        'woovina_link_format_target', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_post',
		            'type'    		=> 'buttonset',
		            'label'   		=> esc_html__( 'Link Target', 'woovina-extra' ),
		            'description'   => esc_html__( 'Choose your target for the url. This setting is used for your link post formats.', 'woovina-extra' ),
					'choices' 		=> array(
						'self' 		=> esc_html__( 'Self', 'woovina-extra' ),
						'blank' 	=> esc_html__( 'Blank', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_link_format_target', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',
		            'default' 			=> 'self',


		        )
		    );
			
			$manager->register_control(
		        'woovina_quote_format', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_post',
		            'type'    		=> 'textarea',
		            'label'   		=> esc_html__( 'Quote', 'woovina-extra' ),
		            'description'   => esc_html__( 'Enter your quote. This setting is used for your quote post formats.', 'woovina-extra' ),
					'attr'    		=> array( 'row' => '2', 'cols' => '1' ),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_quote_format', // Same as control name.
		        array(
		            'sanitize_callback' => 'wp_kses_post',


		        )
		    );

		    $manager->register_control(
		        'woovina_quote_format_link', // Same as setting name.
		        array(
		            'section' 		=> 'woovina_mb_post',
		            'type'    		=> 'buttonset',
		            'label'   		=> esc_html__( 'Quote Link', 'woovina-extra' ),
		            'description'   => esc_html__( 'Choose your quote link. This setting is used for your quote post formats.', 'woovina-extra' ),
					'choices' 		=> array(
						'post' 		=> esc_html__( 'Post', 'woovina-extra' ),
						'none' 		=> esc_html__( 'None', 'woovina-extra' ),
					),


		        )
		    );
			
			$manager->register_setting(
		        'woovina_quote_format_link', // Same as control name.
		        array(
		            'sanitize_callback' => 'sanitize_text_field',
		            'default' 			=> 'post',


		        )
		    );

		}

		/**
		 * Sanitize function for integers
		 *
		 * @since  1.0.0
		 */
		public function sanitize_absint( $value ) {
			return $value && is_numeric( $value ) ? absint( $value ) : '';
		}

		/**
		 * Helpers
		 *
		 * @since 1.0.0
		 */
		public static function helpers( $return = NULL ) {

			// Return array of WP menus
			if ( 'menus' == $return ) {
				$menus 		= array( esc_html__( 'Default', 'woovina-extra' ) );
				$get_menus 	= get_terms( 'nav_menu', array( 'hide_empty' => true ) );
				foreach ( $get_menus as $menu) {
					$menus[$menu->term_id] = $menu->name;
				}
				return $menus;
			}

			// Header template
			elseif ( 'library' == $return ) {
				$templates 		= array( esc_html__( 'Select a Template', 'woovina-extra' ) );
				$get_templates 	= get_posts( array( 'post_type' => 'woovina_library', 'numberposts' => -1, 'post_status' => 'publish' ) );

			    if ( ! empty ( $get_templates ) ) {
			    	foreach ( $get_templates as $template ) {
						$templates[ $template->ID ] = $template->post_title;
				    }
				}

				return $templates;
			}

			// Title styles
			elseif ( 'title_styles' == $return ) {
				return apply_filters( 'woovina_title_styles', array(
					''                 => esc_html__( 'Default', 'woovina-extra' ),
					'default'          => esc_html__( 'Default Style', 'woovina-extra' ),
					'centered'         => esc_html__( 'Centered', 'woovina-extra' ),
					'centered'         => esc_html__( 'Centered', 'woovina-extra' ),
					'centered-minimal' => esc_html__( 'Centered Minimal', 'woovina-extra' ),
					'background-image' => esc_html__( 'Background Image', 'woovina-extra' ),
					'solid-color'      => esc_html__( 'Solid Color and White Text', 'woovina-extra' ),

				) );
			}

			// Widgets
			elseif ( 'widget_areas' == $return ) {
				global $wp_registered_sidebars;
				$widgets_areas = array( esc_html__( 'Default', 'woovina-extra' ) );
				$get_widget_areas = $wp_registered_sidebars;
				if ( ! empty( $get_widget_areas ) ) {
					foreach ( $get_widget_areas as $widget_area ) {
						$name = isset ( $widget_area['name'] ) ? $widget_area['name'] : '';
						$id = isset ( $widget_area['id'] ) ? $widget_area['id'] : '';
						if ( $name && $id ) {
							$widgets_areas[$id] = $name;
						}
					}
				}
				return $widgets_areas;
			}

		}

		/**
		 * Body classes
		 *
		 * @since  1.2.10
		 */
		public function body_class( $classes ) {
			
			// Disabled margins
			if ( 'on' == get_post_meta( woovina_post_id(), 'woovina_disable_margins', true )
				&& ! is_search() ) {
				$classes[] = 'no-margins';
			}

			return $classes;

		}

		/**
		 * Returns the correct second sidebar ID
		 *
		 * @since  1.3.3
		 */
		public function get_second_sidebar( $sidebar ) {
			
			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_second_sidebar', true ) ) {
				$sidebar = $meta;
			}

			return $sidebar;

		}

		/**
		 * Returns the correct sidebar ID
		 *
		 * @since  1.2.10
		 */
		public function get_sidebar( $sidebar ) {
			
			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_sidebar', true ) ) {
				$sidebar = $meta;
			}

			return $sidebar;

		}

		/**
		 * Display top bar
		 *
		 * @since  1.2.10
		 */
		public function display_top_bar( $return ) {
			
			// Check meta
			$meta = woovina_post_id() ? get_post_meta( woovina_post_id(), 'woovina_display_top_bar', true ) : '';

			// Check if disabled
			if ( 'on' == $meta ) {
				$return = true;
			} elseif ( 'off' == $meta ) {
				$return = false;
			}

			return $return;

		}

		/**
		 * Display header
		 *
		 * @since  1.2.10
		 */
		public function display_header( $return ) {
			
			// Check meta
			$meta = woovina_post_id() ? get_post_meta( woovina_post_id(), 'woovina_display_header', true ) : '';

			// Check if disabled
			if ( 'on' == $meta ) {
				$return = true;
			} elseif ( 'off' == $meta ) {
				$return = false;
			}

			return $return;

		}

		/**
		 * Custom menu
		 *
		 * @since  1.2.10
		 */
		public function custom_menu( $menu ) {
			
			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_header_custom_menu', true ) ) {
				$menu = $meta;
			}

			return $menu;

		}

		/**
		 * Header style
		 *
		 * @since  1.3.3
		 */
		public function header_style( $style ) {
			
			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_header_style', true ) ) {
				$style = $meta;
			}

			return $style;

		}

		/**
		 * Left custom menu for center geader style
		 *
		 * @since  1.3.3
		 */
		public function left_custom_menu( $menu ) {
			
			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_center_header_left_menu', true ) ) {
				$menu = $meta;
			}
			
			return $menu;

		}

		/**
		 * Custom header template
		 *
		 * @since  1.3.3
		 */
		public function custom_header_template( $template ) {
			
			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_header_template', true ) ) {
				$template = $meta;
			}

			return $template;

		}

		/**
		 * Custom logo
		 *
		 * @since  1.3.3
		 */
		public function custom_logo( $html ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_logo', true ) ) {

				$html = '';

				// We have a logo. Logo is go.
				if ( $meta ) {

					$custom_logo_attr = array(
						'class'    => 'custom-logo',
						'itemprop' => 'logo',
					);

					/*
					 * If the logo alt attribute is empty, get the site title and explicitly
					 * pass it to the attributes used by wp_get_attachment_image().
					 */
					$image_alt = get_post_meta( $meta, '_wp_attachment_image_alt', true );
					if ( empty( $image_alt ) ) {
						$custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
					}

					/*
					 * If the alt attribute is not empty, there's no need to explicitly pass
					 * it because wp_get_attachment_image() already adds the alt attribute.
					 */
					$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
						esc_url( home_url( '/' ) ),
						wp_get_attachment_image( $meta, 'full', false, $custom_logo_attr )
					);

				}

			}

			return $html;

		}

		/**
		 * Custom logo ID
		 *
		 * @since  1.3.3
		 */
		public function custom_logo_id( $logo_url ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_logo', true ) ) {
				$logo_url = $meta;
			}

			return $logo_url;

		}

		/**
		 * Custom retina logo
		 *
		 * @since  1.3.3
		 */
		public function custom_retina_logo( $logo_url ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_retina_logo', true ) ) {
				$logo_url = $meta;

				// Generate image URL if using ID
				if ( is_numeric( $logo_url ) ) {
					$logo_url = wp_get_attachment_image_src( $logo_url, 'full' );
					$logo_url = $logo_url[0];
				}
			}

			return $logo_url;

		}

		/**
		 * Custom logo max width
		 *
		 * @since  1.3.3
		 */
		public function custom_logo_max_width( $width ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_logo_max_width', true ) ) {
				$width = $meta;
			}

			return $width;

		}

		/**
		 * Custom logo max width tablet
		 *
		 * @since  1.3.3
		 */
		public function custom_logo_max_width_tablet( $width ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_logo_tablet_max_width', true ) ) {
				$width = $meta;
			}

			return $width;

		}

		/**
		 * Custom logo max width mobile
		 *
		 * @since  1.3.3
		 */
		public function custom_logo_max_width_mobile( $width ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_logo_mobile_max_width', true ) ) {
				$width = $meta;
			}

			return $width;

		}

		/**
		 * Custom logo max height
		 *
		 * @since  1.3.3
		 */
		public function custom_logo_max_height( $height ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_logo_max_height', true ) ) {
				$height = $meta;
			}

			return $height;

		}

		/**
		 * Custom logo max height tablet
		 *
		 * @since  1.3.3
		 */
		public function custom_logo_max_height_tablet( $height ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_logo_tablet_max_height', true ) ) {
				$height = $meta;
			}

			return $height;

		}

		/**
		 * Custom logo max height mobile
		 *
		 * @since  1.3.3
		 */
		public function custom_logo_max_height_mobile( $height ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_logo_mobile_max_height', true ) ) {
				$height = $meta;
			}

			return $height;

		}

		/**
		 * Menu links color
		 *
		 * @since  1.3.3
		 */
		public function menu_link_color( $color ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_menu_link_color', true ) ) {
				$color = $meta;
			}

			return $color;

		}

		/**
		 * Menu links color: hover
		 *
		 * @since  1.3.3
		 */
		public function menu_link_color_hover( $color ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_menu_link_color_hover', true ) ) {
				$color = $meta;
			}

			return $color;

		}

		/**
		 * Menu links color: current menu item
		 *
		 * @since  1.3.3
		 */
		public function menu_link_color_active( $color ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_menu_link_color_active', true ) ) {
				$color = $meta;
			}

			return $color;

		}

		/**
		 * Menu links background
		 *
		 * @since  1.3.3
		 */
		public function menu_link_background( $color ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_menu_link_background', true ) ) {
				$color = $meta;
			}

			return $color;

		}

		/**
		 * Menu links background: hover
		 *
		 * @since  1.3.3
		 */
		public function menu_link_hover_background( $color ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_menu_link_hover_background', true ) ) {
				$color = $meta;
			}

			return $color;

		}

		/**
		 * Menu links background: current menu item
		 *
		 * @since  1.3.3
		 */
		public function menu_link_active_background( $color ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_menu_link_active_background', true ) ) {
				$color = $meta;
			}

			return $color;

		}

		/**
		 * Social menu links background color
		 *
		 * @since  1.3.3
		 */
		public function menu_social_links_bg( $color ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_menu_social_links_bg', true ) ) {
				$color = $meta;
			}

			return $color;

		}

		/**
		 * Social menu hover links background color
		 *
		 * @since  1.3.3
		 */
		public function menu_social_hover_links_bg( $color ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_menu_social_hover_links_bg', true ) ) {
				$color = $meta;
			}

			return $color;

		}

		/**
		 * Social menu links color
		 *
		 * @since  1.3.3
		 */
		public function menu_social_links_color( $color ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_menu_social_links_color', true ) ) {
				$color = $meta;
			}

			return $color;

		}

		/**
		 * Social menu hover links color
		 *
		 * @since  1.3.3
		 */
		public function menu_social_hover_links_color( $color ) {

			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_menu_social_hover_links_color', true ) ) {
				$color = $meta;
			}

			return $color;

		}

		/**
		 * Display page header
		 *
		 * @since  1.2.10
		 */
		public function display_page_header( $return ) {
			
			// Check meta
			$meta = woovina_post_id() ? get_post_meta( woovina_post_id(), 'woovina_disable_title', true ) : '';

			// Check if enabled or disabled
			if ( 'enable' == $meta ) {
				$return = true;
			} elseif ( 'on' == $meta ) {
				$return = false;
			}

			return $return;

		}

		/**
		 * Display page header heading
		 *
		 * @since  1.3.3
		 */
		public function display_page_header_heading( $return ) {
			
			// Check meta
			$meta = woovina_post_id() ? get_post_meta( woovina_post_id(), 'woovina_disable_heading', true ) : '';

			// Check if enabled or disabled
			if ( 'enable' == $meta ) {
				$return = true;
			} elseif ( 'on' == $meta ) {
				$return = false;
			}

			return $return;

		}

		/**
		 * Page header style
		 *
		 * @since  1.2.10
		 */
		public function page_header_style( $style ) {
			
			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title_style', true ) ) {
				$style = $meta;
			}

			return $style;

		}

		/**
		 * Page header title
		 *
		 * @since  1.2.10
		 */
		public function page_header_title( $title ) {
			
			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title', true ) ) {
				$title = $meta;
			}

			return $title;

		}

		/**
		 * Page header subheading
		 *
		 * @since  1.2.10
		 */
		public function page_header_subheading( $subheading ) {
			
			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_subheading', true ) ) {
				$subheading = $meta;
			}

			return $subheading;

		}

		/**
		 * Display breadcrumbs
		 *
		 * @since  1.2.10
		 */
		public function display_breadcrumbs( $return ) {
			
			// Check meta
			$meta = woovina_post_id() ? get_post_meta( woovina_post_id(), 'woovina_disable_breadcrumbs', true ) : '';

			// Check if enabled or disabled
			if ( 'on' == $meta ) {
				$return = true;
			} elseif ( 'off' == $meta ) {
				$return = false;
			}

			return $return;

		}

		/**
		 * Title background color
		 *
		 * @since  1.2.10
		 */
		public function page_header_bg_color( $bg_color ) {

			if ( 'solid-color' == get_post_meta( woovina_post_id(), 'woovina_post_title_style', true ) ) {
				if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title_background_color', true ) ) {
					$bg_color = $meta;
				}
			}

			return $bg_color;

		}

		/**
		 * Title background image
		 *
		 * @since  1.2.10
		 */
		public function page_header_bg_image( $bg_img ) {

			if ( 'background-image' == get_post_meta( woovina_post_id(), 'woovina_post_title_style', true ) ) {
				if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title_background', true ) ) {
					$bg_img = $meta;
				}
			}

			return $bg_img;

		}

		/**
		 * Title background image position
		 *
		 * @since  1.2.10
		 */
		public function page_header_bg_image_position( $bg_img_position ) {

			if ( 'background-image' == get_post_meta( woovina_post_id(), 'woovina_post_title_style', true ) ) {
				if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title_bg_image_position', true ) ) {
					$bg_img_position = $meta;
				}
			}

			return $bg_img_position;

		}

		/**
		 * Title background image attachment
		 *
		 * @since  1.2.10
		 */
		public function page_header_bg_image_attachment( $bg_img_attachment ) {

			if ( 'background-image' == get_post_meta( woovina_post_id(), 'woovina_post_title_style', true ) ) {
				if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title_bg_image_attachment', true ) ) {
					$bg_img_attachment = $meta;
				}
			}

			return $bg_img_attachment;

		}

		/**
		 * Title background image repeat
		 *
		 * @since  1.2.10
		 */
		public function page_header_bg_image_repeat( $bg_img_repeat ) {

			if ( 'background-image' == get_post_meta( woovina_post_id(), 'woovina_post_title_style', true ) ) {
				if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title_bg_image_repeat', true ) ) {
					$bg_img_repeat = $meta;
				}
			}

			return $bg_img_repeat;

		}

		/**
		 * Title background image size
		 *
		 * @since  1.2.10
		 */
		public function page_header_bg_image_size( $bg_img_size ) {

			if ( 'background-image' == get_post_meta( woovina_post_id(), 'woovina_post_title_style', true ) ) {
				if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title_bg_image_size', true ) ) {
					$bg_img_size = $meta;
				}
			}

			return $bg_img_size;

		}

		/**
		 * Title height
		 *
		 * @since  1.2.10
		 */
		public function page_header_height( $title_height ) {

			if ( 'background-image' == get_post_meta( woovina_post_id(), 'woovina_post_title_style', true ) ) {
				if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title_height', true ) ) {
					$title_height = $meta;
				}
			}

			return $title_height;

		}

		/**
		 * Title background opacity
		 *
		 * @since  1.2.10
		 */
		public function page_header_bg_opacity( $opacity ) {

			if ( 'background-image' == get_post_meta( woovina_post_id(), 'woovina_post_title_style', true ) ) {
				if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title_bg_overlay', true ) ) {
					$opacity = $meta;
				}
			}

			return $opacity;

		}

		/**
		 * Title background overlay color
		 *
		 * @since  1.2.10
		 */
		public function page_header_bg_overlay_color( $overlay_color ) {

			if ( 'background-image' == get_post_meta( woovina_post_id(), 'woovina_post_title_style', true ) ) {
				if ( $meta = get_post_meta( woovina_post_id(), 'woovina_post_title_bg_overlay_color', true ) ) {
					$overlay_color = $meta;
				}
			}

			return $overlay_color;

		}

		/**
		 * Display footer widgets
		 *
		 * @since  1.2.10
		 */
		public function display_footer_widgets( $return ) {
			
			// Check meta
			$meta = woovina_post_id() ? get_post_meta( woovina_post_id(), 'woovina_display_footer_widgets', true ) : '';

			// Check if disabled
			if ( 'on' == $meta ) {
				$return = true;
			} elseif ( 'off' == $meta ) {
				$return = false;
			}

			return $return;

		}

		/**
		 * Display footer bottom
		 *
		 * @since  1.2.10
		 */
		public function display_footer_bottom( $return ) {
			
			// Check meta
			$meta = woovina_post_id() ? get_post_meta( woovina_post_id(), 'woovina_display_footer_bottom', true ) : '';

			// Check if disabled
			if ( 'on' == $meta ) {
				$return = true;
			} elseif ( 'off' == $meta ) {
				$return = false;
			}

			return $return;

		}

		/**
		 * Custom footer template
		 *
		 * @since  1.3.3
		 */
		public function custom_footer_template( $template ) {
			
			if ( $meta = get_post_meta( woovina_post_id(), 'woovina_custom_footer_template', true ) ) {
				$template = $meta;
			}

			return $template;

		}

		/**
		 * Get CSS
		 *
		 * @since 1.0.0
		 */
		public static function head_css( $output ) {
			$id = woovina_post_id();

			// Layout
			$layout 				= get_post_meta( $id, 'woovina_post_layout', true );

			// Global vars
			$content_width 			= get_post_meta( $id, 'woovina_both_sidebars_content_width', true );
			$sidebars_width 		= get_post_meta( $id, 'woovina_both_sidebars_sidebars_width', true );

			// Typography
			$menu_font_family 		= get_post_meta( $id, 'woovina_menu_typo_font_family', true );
			$menu_font_size 		= get_post_meta( $id, 'woovina_menu_typo_font_size', true );
			$menu_font_weight 		= get_post_meta( $id, 'woovina_menu_typo_font_weight', true );
			$menu_font_style 		= get_post_meta( $id, 'woovina_menu_typo_font_style', true );
			$menu_text_transform 	= get_post_meta( $id, 'woovina_menu_typo_transform', true );
			$menu_line_height 		= get_post_meta( $id, 'woovina_menu_typo_line_height', true );
			$menu_letter_spacing 	= get_post_meta( $id, 'woovina_menu_typo_spacing', true );

			// Define css var
			$css = '';
			$menu_typo_css = '';

			// If Both Sidebars layout
			if ( 'both-sidebars' == $layout ) {

				// Both Sidebars layout content width
				if ( ! empty( $content_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							.content-both-sidebars .content-area {width: '. $content_width .'%;}
							.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							.content-both-sidebars.ssc-style .widget-area {left: -'. $content_width .'%;}
						}';
				}

				// Both Sidebars layout sidebars width
				if ( ! empty( $sidebars_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							.content-both-sidebars .widget-area{width:'. $sidebars_width .'%;}
							.content-both-sidebars.scs-style .content-area{left:'. $sidebars_width .'%;}
							.content-both-sidebars.ssc-style .content-area{left:'. $sidebars_width * 2 .'%;}
						}';
				}

			}

			// Add menu font size
			if ( ! empty( $menu_font_size ) ) {
				$menu_typo_css .= 'font-size:'. $menu_font_size .';';
			}

			// Add menu font weight
			if ( ! empty( $menu_font_weight ) ) {
				$menu_typo_css .= 'font-weight:'. $menu_font_weight .';';
			}

			// Add menu font style
			if ( ! empty( $menu_font_style ) ) {
				$menu_typo_css .= 'font-style:'. $menu_font_style .';';
			}

			// Add menu text transform
			if ( ! empty( $menu_text_transform ) ) {
				$menu_typo_css .= 'text-transform:'. $menu_text_transform .';';
			}

			// Add menu line height
			if ( ! empty( $menu_line_height ) ) {
				$menu_typo_css .= 'line-height:'. $menu_line_height .';';
			}

			// Add menu letter spacing
			if ( ! empty( $menu_letter_spacing ) ) {
				$menu_typo_css .= 'letter-spacing:'. $menu_letter_spacing .';';
			}

			// Menu typography css
			if ( ! empty( $menu_typo_css ) ) {
				$css .= '#site-navigation-wrap .dropdown-menu > li > a, .woovina-mobile-menu-icon a {'. $menu_typo_css .'}';
			}
				
			// Return CSS
			if ( ! empty( $css ) ) {
				$output .= $css;
			}

			// Return output css
			return $output;

		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.1.2
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			static $instance = null;
			if ( is_null( $instance ) ) {
				$instance = new self;
				$instance->setup_actions();
			}
			return $instance;
		}

		/**
		 * Constructor method.
		 *
		 * @since  1.1.2
		 * @access private
		 * @return void
		 */
		private function __construct() {}

	}

	WooVina_Post_Metabox::get_instance();

}