<?php
/**
 * Blog Customizer Options
 *
 * @package WooVina WordPress theme
 */

if(! defined('ABSPATH')) {
	exit;
}

if(! class_exists('WooVina_Blog_Customizer')) :

	class WooVina_Blog_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {

			add_action('customize_register', 	array($this, 'customizer_options'));
			add_filter('woovina_head_css', 		array($this, 'head_css'));

		}

		/**
		 * Customizer options
		 *
		 * @since 1.0.0
		 */
		public function customizer_options($wp_customize) {

			/**
			 * Panel
			 */
			$panel = 'woovina_blog';
			$wp_customize->add_panel($panel , array(
				'title' 			=> esc_html__('Blog', 'woovina'),
				'priority' 			=> 210,
			));

			/**
			 * Section
			 */
			$wp_customize->add_section('woovina_blog_entries', array(
				'title' 			=> esc_html__('Blog Entries', 'woovina'),
				'priority' 			=> 10,
				'panel' 			=> $panel,
			));

			/**
			 * Archives & Entries Layout
			 */
			$wp_customize->add_setting('woovina_blog_archives_layout', array(
				'default'           	=> 'right-sidebar',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WooVina_Customizer_Radio_Image_Control($wp_customize, 'woovina_blog_archives_layout', array(
				'label'	   				=> esc_html__('Archives & Entries Layout', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_archives_layout',
				'priority' 				=> 10,
				'choices' 				=> woovina_customizer_layout(),
			)));

			/**
			 * Both Sidebars Style
			 */
			$wp_customize->add_setting('woovina_blog_archives_both_sidebars_style', array(
				'default'           	=> 'scs-style',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_archives_both_sidebars_style', array(
				'label'	   				=> esc_html__('Both Sidebars: Style', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_archives_both_sidebars_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'ssc-style' 		=> esc_html__('Sidebar / Sidebar / Content', 'woovina'),
					'scs-style' 		=> esc_html__('Sidebar / Content / Sidebar', 'woovina'),
					'css-style' 		=> esc_html__('Content / Sidebar / Sidebar', 'woovina'),
				),
				'active_callback' 		=> 'woovina_cac_has_blog_entries_bs_layout',
			)));

			/**
			 * Both Sidebars Content Width
			 */
			$wp_customize->add_setting('woovina_blog_archives_both_sidebars_content_width', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'woovina_sanitize_number_blank',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_archives_both_sidebars_content_width', array(
				'label'	   				=> esc_html__('Both Sidebars: Content Width (%)', 'woovina'),
				'type' 					=> 'number',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_archives_both_sidebars_content_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			   ),
				'active_callback' 		=> 'woovina_cac_has_blog_entries_bs_layout',
			)));

			/**
			 * Both Sidebars Sidebars Width
			 */
			$wp_customize->add_setting('woovina_blog_archives_both_sidebars_sidebars_width', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'woovina_sanitize_number_blank',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_archives_both_sidebars_sidebars_width', array(
				'label'	   				=> esc_html__('Both Sidebars: Sidebars Width (%)', 'woovina'),
				'type' 					=> 'number',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_archives_both_sidebars_sidebars_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			   ),
				'active_callback' 		=> 'woovina_cac_has_blog_entries_bs_layout',
			)));

			/**
			 * Blog Title Heading Tag
			 */
			$wp_customize->add_setting('woovina_blog_entries_heading_tag', array(
				'default'           	=> 'h2',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_entries_heading_tag', array(
				'label'	   				=> esc_html__('Heading Tag', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_entries_heading_tag',
				'priority' 				=> 10,
				'choices' 				=> array(
					'h1' 	=> esc_html__('H1', 'woovina'),
					'h2' 	=> esc_html__('H2', 'woovina'),
					'h3' 	=> esc_html__('H3', 'woovina'),
					'h4' 	=> esc_html__('H4', 'woovina'),
					'h5' 	=> esc_html__('H5', 'woovina'),
					'h6' 	=> esc_html__('H6', 'woovina'),
					'div' 	=> esc_html__('div', 'woovina'),
					'span' 	=> esc_html__('span', 'woovina'),
					'p' 	=> esc_html__('p', 'woovina'),
				),
			)));

			/**
			 * Blog Image Overlay
			 */
			$wp_customize->add_setting('woovina_blog_image_overlay', array(
				'transport' 			=> 'postMessage',
				'default'           	=> true,
				'sanitize_callback' 	=> 'woovina_sanitize_checkbox',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_image_overlay', array(
				'label'	   				=> esc_html__('Add Overlay On image Hover', 'woovina'),
				'type' 					=> 'checkbox',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_image_overlay',
				'priority' 				=> 10,
			)));

			/**
			 * Blog Style
			 */
			$wp_customize->add_setting('woovina_blog_style', array(
				'default'           	=> 'large-entry',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_style', array(
				'label'	   				=> esc_html__('Blog Style', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'large-entry'  		=> esc_html__('Large Image', 'woovina'),
					'grid-entry' 		=> esc_html__('Grid', 'woovina'),
					'thumbnail-entry' 	=> esc_html__('Thumbnail', 'woovina'),
				),
			)));

			/**
			 * Blog Grid Images Size
			 */
			$wp_customize->add_setting('woovina_blog_grid_images_size', array(
				'default'           	=> 'medium',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_grid_images_size', array(
				'label'	   				=> esc_html__('Images Size', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_grid_images_size',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_grid_blog_style',
				'choices' 				=> array(
					'thumbnail' 		=> esc_html__('Thumbnail', 'woovina'),
					'medium' 			=> esc_html__('Medium', 'woovina'),
					'medium_large' 		=> esc_html__('Medium Large', 'woovina'),
					'large' 			=> esc_html__('Large', 'woovina'),
				),
			)));

			/**
			 * Blog Grid Columns
			 */
			$wp_customize->add_setting('woovina_blog_grid_columns', array(
				'default'           	=> '2',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_grid_columns', array(
				'label'	   				=> esc_html__('Grid Columns', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_grid_columns',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_grid_blog_style',
				'choices' 				=> array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
			)));

			/**
			 * Blog Grid Style
			 */
			$wp_customize->add_setting('woovina_blog_grid_style', array(
				'default'           	=> 'fit-rows',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_grid_style', array(
				'label'	   				=> esc_html__('Grid Style', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_grid_style',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_grid_blog_style',
				'choices' 				=> array(
					'fit-rows' 			=> esc_html__('Fit Rows', 'woovina'),
					'masonry' 			=> esc_html__('Masonry', 'woovina'),
				),
			)));

			/**
			 * Blog Grid Equal Heights
			 */
			$wp_customize->add_setting('woovina_blog_grid_equal_heights', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'woovina_sanitize_checkbox',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_grid_equal_heights', array(
				'label'	   				=> esc_html__('Equal Heights', 'woovina'),
				'type' 					=> 'checkbox',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_grid_equal_heights',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_blog_supports_equal_heights',
			)));

			/**
			 * Blog Thumbnail Image Position
			 */
			$wp_customize->add_setting('woovina_blog_thumbnail_image_position', array(
				'default'           	=> 'left',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WooVina_Customizer_Buttonset_Control($wp_customize, 'woovina_blog_thumbnail_image_position', array(
				'label'	   				=> esc_html__('Image Position', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_thumbnail_image_position',
				'priority' 				=> 10,
				'choices' 				=> array(
					'left'  			=> esc_html__('Left', 'woovina'),
					'right' 			=> esc_html__('Right', 'woovina'),
				),
				'active_callback' 		=> 'woovina_cac_has_thumbnail_blog_style',
			)));

			/**
			 * Blog Thumbnail Vertical Position
			 */
			$wp_customize->add_setting('woovina_blog_thumbnail_vertical_position', array(
				'transport' 			=> 'postMessage',
				'default'           	=> 'center',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WooVina_Customizer_Buttonset_Control($wp_customize, 'woovina_blog_thumbnail_vertical_position', array(
				'label'	   				=> esc_html__('Vertical Position', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_thumbnail_vertical_position',
				'priority' 				=> 10,
				'choices' 				=> array(
					'top'  				=> esc_html__('Top', 'woovina'),
					'center' 			=> esc_html__('Center', 'woovina'),
					'bottom' 			=> esc_html__('Bottom', 'woovina'),
				),
				'active_callback' 		=> 'woovina_cac_has_thumbnail_blog_style',
			)));

			/**
			 * Image Width
			 */
			$wp_customize->add_setting('woovina_blog_entry_image_width', array(
				'sanitize_callback' 	=> 'woovina_sanitize_number_blank',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_entry_image_width', array(
				'label'	   				=> esc_html__('Custom Image Width (px)', 'woovina'),
				'type' 					=> 'number',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_entry_image_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min' => 0,
			   ),
			)));

			/**
			 * Image Height
			 */
			$wp_customize->add_setting('woovina_blog_entry_image_height', array(
				'sanitize_callback' 	=> 'woovina_sanitize_number_blank',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_entry_image_height', array(
				'label'	   				=> esc_html__('Custom Image Height (px)', 'woovina'),
				'type' 					=> 'number',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_entry_image_height',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min' => 0,
			   ),
			)));

			/**
			 * Blog Thumbnail Category Color
			 */
			$wp_customize->add_setting('woovina_blog_thumbnail_category_color', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '#f68e13',
				'sanitize_callback' 	=> 'woovina_sanitize_color',
			));

			$wp_customize->add_control(new WooVina_Customizer_Color_Control($wp_customize, 'woovina_blog_thumbnail_category_color', array(
				'label'	   				=> esc_html__('Category Color', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_thumbnail_category_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_thumbnail_blog_style',
			)));

			/**
			 * Blog Thumbnail Category Hover Color
			 */
			$wp_customize->add_setting('woovina_blog_thumbnail_category_hover_color', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '#333333',
				'sanitize_callback' 	=> 'woovina_sanitize_color',
			));

			$wp_customize->add_control(new WooVina_Customizer_Color_Control($wp_customize, 'woovina_blog_thumbnail_category_hover_color', array(
				'label'	   				=> esc_html__('Category Hover Color', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_thumbnail_category_hover_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_thumbnail_blog_style',
			)));

			/**
			 * Blog Thumbnail Comments Color
			 */
			$wp_customize->add_setting('woovina_blog_thumbnail_comments_color', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '#ababab',
				'sanitize_callback' 	=> 'woovina_sanitize_color',
			));

			$wp_customize->add_control(new WooVina_Customizer_Color_Control($wp_customize, 'woovina_blog_thumbnail_comments_color', array(
				'label'	   				=> esc_html__('Comments Color', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_thumbnail_comments_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_thumbnail_blog_style',
			)));

			/**
			 * Blog Thumbnail Comments Hover Color
			 */
			$wp_customize->add_setting('woovina_blog_thumbnail_comments_hover_color', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '#f68e13',
				'sanitize_callback' 	=> 'woovina_sanitize_color',
			));

			$wp_customize->add_control(new WooVina_Customizer_Color_Control($wp_customize, 'woovina_blog_thumbnail_comments_hover_color', array(
				'label'	   				=> esc_html__('Comments Hover Color', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_thumbnail_comments_hover_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_thumbnail_blog_style',
			)));

			/**
			 * Blog Thumbnail Date Color
			 */
			$wp_customize->add_setting('woovina_blog_thumbnail_date_color', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '#ababab',
				'sanitize_callback' 	=> 'woovina_sanitize_color',
			));

			$wp_customize->add_control(new WooVina_Customizer_Color_Control($wp_customize, 'woovina_blog_thumbnail_date_color', array(
				'label'	   				=> esc_html__('Category Hover Color', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_thumbnail_date_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_thumbnail_blog_style',
			)));

			/**
			 * Blog Excerpt Length
			 */
			$wp_customize->add_setting('woovina_blog_entry_excerpt_length', array(
				'default'           	=> '30',
				'sanitize_callback' 	=> false,
			));

			$wp_customize->add_control(new WooVina_Customizer_Range_Control($wp_customize, 'woovina_blog_entry_excerpt_length', array(
				'label'	   				=> esc_html__('Excerpt Length', 'woovina'),
				'description'	   		=> esc_html__('Add 500 to display full content', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_entry_excerpt_length',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 500,
			        'step'  => 1,
			   ),
			)));

			/**
			 * Blog Pagination Style
			 */
			$wp_customize->add_setting('woovina_blog_pagination_style', array(
				'default'           	=> 'standard',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_pagination_style', array(
				'label'	   				=> esc_html__('Blog Pagination Style', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_pagination_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'standard' 			=> esc_html__('Standard', 'woovina'),
					'infinite_scroll' 	=> esc_html__('Infinite Scroll', 'woovina'),
					'next_prev' 		=> esc_html__('Next/Prev', 'woovina'),
				),
			)));

			/**
			 * Infinite Scroll: Spinners Color
			 */
			$wp_customize->add_setting('woovina_blog_infinite_scroll_spinners_color', array(
				'default'           	=> '#333333',
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'woovina_sanitize_color',
			));

			$wp_customize->add_control(new WooVina_Customizer_Color_Control($wp_customize, 'woovina_blog_infinite_scroll_spinners_color', array(
				'label'	   				=> esc_html__('Infinite Scroll: Spinners Color', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_infinite_scroll_spinners_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_blog_infinite_scroll',
			)));

			/**
			 * Infinite Scroll: Last Text
			 */
			$wp_customize->add_setting('woovina_blog_infinite_scroll_last_text', array(
				'default'           	=> esc_html__('End of content', 'woovina'),
				'transport'           	=> 'postMessage',
				'sanitize_callback' 	=> 'wp_kses_post',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_infinite_scroll_last_text', array(
				'label'	   				=> esc_html__('Infinite Scroll: Last Text', 'woovina'),
				'type' 					=> 'text',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_infinite_scroll_last_text',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_blog_infinite_scroll',
			)));

			/**
			 * Infinite Scroll: Error Text
			 */
			$wp_customize->add_setting('woovina_blog_infinite_scroll_error_text', array(
				'default'           	=> esc_html__('No more pages to load', 'woovina'),
				'transport'           	=> 'postMessage',
				'sanitize_callback' 	=> 'wp_kses_post',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_infinite_scroll_error_text', array(
				'label'	   				=> esc_html__('Infinite Scroll: Error Text', 'woovina'),
				'type' 					=> 'text',
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_infinite_scroll_error_text',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_blog_infinite_scroll',
			)));

			/**
			 * Blog Entries Elements Positioning
			 */
			$wp_customize->add_setting('woovina_blog_entry_elements_positioning', array(
				'default'           	=> array('featured_image', 'title', 'meta', 'content', 'read_more'),
				'sanitize_callback' 	=> 'woovina_sanitize_multi_choices',
			));

			$wp_customize->add_control(new WooVina_Customizer_Sortable_Control($wp_customize, 'woovina_blog_entry_elements_positioning', array(
				'label'	   				=> esc_html__('Elements Positioning', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_entry_elements_positioning',
				'priority' 				=> 10,
				'choices' 				=> woovina_blog_entry_elements(),
				'active_callback' 		=> 'woovina_cac_hasnt_thumbnail_blog_style',
			)));

			/**
			 * Blog Entries Meta
			 */
			$wp_customize->add_setting('woovina_blog_entry_meta', array(
				'default'           	=> apply_filters('woovina_blog_meta_default', array('author', 'date', 'categories', 'comments')),
				'sanitize_callback' 	=> 'woovina_sanitize_multi_choices',
			));

			$wp_customize->add_control(new WooVina_Customizer_Sortable_Control($wp_customize, 'woovina_blog_entry_meta', array(
				'label'	   				=> esc_html__('Meta', 'woovina'),
				'section'  				=> 'woovina_blog_entries',
				'settings' 				=> 'woovina_blog_entry_meta',
				'priority' 				=> 10,
				'choices' 				=> apply_filters('woovina_blog_meta_choices', array(
					'author'     		=> esc_html__('Author', 'woovina'),
					'date'       		=> esc_html__('Date', 'woovina'),
					'categories' 		=> esc_html__('Categories', 'woovina'),
					'comments'   		=> esc_html__('Comments', 'woovina'),
				)),
				'active_callback' 		=> 'woovina_cac_hasnt_thumbnail_blog_style',
			)));

			/**
			 * Section
			 */
			$wp_customize->add_section('woovina_single_post', array(
				'title' 			=> esc_html__('Single Post', 'woovina'),
				'priority' 			=> 10,
				'panel' 			=> $panel,
			));

			/**
			 * Single Layout
			 */
			$wp_customize->add_setting('woovina_blog_single_layout', array(
				'default'           	=> 'right-sidebar',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WooVina_Customizer_Radio_Image_Control($wp_customize, 'woovina_blog_single_layout', array(
				'label'	   				=> esc_html__('Layout', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_layout',
				'priority' 				=> 10,
				'choices' 				=> woovina_customizer_layout(),
			)));

			/**
			 * Both Sidebars Style
			 */
			$wp_customize->add_setting('woovina_blog_single_both_sidebars_style', array(
				'default'           	=> 'scs-style',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_single_both_sidebars_style', array(
				'label'	   				=> esc_html__('Both Sidebars: Style', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_both_sidebars_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'ssc-style' 		=> esc_html__('Sidebar / Sidebar / Content', 'woovina'),
					'scs-style' 		=> esc_html__('Sidebar / Content / Sidebar', 'woovina'),
					'css-style' 		=> esc_html__('Content / Sidebar / Sidebar', 'woovina'),
				),
				'active_callback' 		=> 'woovina_cac_has_single_post_bs_layout',
			)));

			/**
			 * Both Sidebars Content Width
			 */
			$wp_customize->add_setting('woovina_blog_single_both_sidebars_content_width', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'woovina_sanitize_number_blank',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_single_both_sidebars_content_width', array(
				'label'	   				=> esc_html__('Both Sidebars: Content Width (%)', 'woovina'),
				'type' 					=> 'number',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_both_sidebars_content_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			   ),
				'active_callback' 		=> 'woovina_cac_has_single_post_bs_layout',
			)));

			/**
			 * Both Sidebars Sidebars Width
			 */
			$wp_customize->add_setting('woovina_blog_single_both_sidebars_sidebars_width', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'woovina_sanitize_number_blank',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_single_both_sidebars_sidebars_width', array(
				'label'	   				=> esc_html__('Both Sidebars: Sidebars Width (%)', 'woovina'),
				'type' 					=> 'number',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_both_sidebars_sidebars_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			   ),
				'active_callback' 		=> 'woovina_cac_has_single_post_bs_layout',
			)));

			/**
			 * Blog Single Title Heading Tag
			 */
			$wp_customize->add_setting('woovina_single_post_heading_tag', array(
				'default'           	=> 'h2',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_single_post_heading_tag', array(
				'label'	   				=> esc_html__('Heading Tag', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_single_post_heading_tag',
				'priority' 				=> 10,
				'choices' 				=> array(
					'h1' 	=> esc_html__('H1', 'woovina'),
					'h2' 	=> esc_html__('H2', 'woovina'),
					'h3' 	=> esc_html__('H3', 'woovina'),
					'h4' 	=> esc_html__('H4', 'woovina'),
					'h5' 	=> esc_html__('H5', 'woovina'),
					'h6' 	=> esc_html__('H6', 'woovina'),
					'div' 	=> esc_html__('div', 'woovina'),
					'span' 	=> esc_html__('span', 'woovina'),
					'p' 	=> esc_html__('p', 'woovina'),
				),
			)));

			/**
			 * Page Header Title
			 */
			$wp_customize->add_setting('woovina_blog_single_page_header_title', array(
				'default'           	=> 'blog',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_single_page_header_title', array(
				'label'	   				=> esc_html__('Page Header Title', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_page_header_title',
				'priority' 				=> 10,
				'choices' 				=> array(
					'blog' 				=> esc_html__('Blog', 'woovina'),
					'post-title' 		=> esc_html__('Post Title', 'woovina'),
				),
			)));

			/**
			 * Add Featured Image In Page Header
			 */
			$wp_customize->add_setting('woovina_blog_single_featured_image_title', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'woovina_sanitize_checkbox',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_single_featured_image_title', array(
				'label'	   				=> esc_html__('Featured Image In Page Header', 'woovina'),
				'type' 					=> 'checkbox',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_featured_image_title',
				'priority' 				=> 10,
			)));

			/**
			 * Blog Single Title/Breadcrumb Position
			 */
			$wp_customize->add_setting('woovina_blog_single_title_breadcrumb_position', array(
				'transport' 			=> 'postMessage',
				'default'           	=> 'center',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WooVina_Customizer_Buttonset_Control($wp_customize, 'woovina_blog_single_title_breadcrumb_position', array(
				'label'	   				=> esc_html__('Title/Breadcrumb Position', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_title_breadcrumb_position',
				'priority' 				=> 10,
				'choices' 				=> array(
					'left' 		=> esc_html__('Left', 'woovina'),
					'center' 	=> esc_html__('Center', 'woovina'),
					'right' 	=> esc_html__('Right', 'woovina'),
				),
				'active_callback' 		=> 'woovina_cac_has_blog_single_title_bg_image',
			)));

			/**
			 * Blog Single Page Header Background Image Position
			 */
			$wp_customize->add_setting('woovina_blog_single_title_bg_image_position', array(
				'transport' 			=> 'postMessage',
				'default' 				=> 'top center',
				'sanitize_callback' 	=> 'sanitize_text_field',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_single_title_bg_image_position', array(
				'label'	   				=> esc_html__('Position', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_title_bg_image_position',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_blog_single_title_bg_image',
				'choices' 				=> array(
					'initial' 			=> esc_html__('Default', 'woovina'),
					'top left' 			=> esc_html__('Top Left', 'woovina'),
					'top center' 		=> esc_html__('Top Center', 'woovina'),
					'top right'  		=> esc_html__('Top Right', 'woovina'),
					'center left' 		=> esc_html__('Center Left', 'woovina'),
					'center center' 	=> esc_html__('Center Center', 'woovina'),
					'center right' 		=> esc_html__('Center Right', 'woovina'),
					'bottom left' 		=> esc_html__('Bottom Left', 'woovina'),
					'bottom center' 	=> esc_html__('Bottom Center', 'woovina'),
					'bottom right' 		=> esc_html__('Bottom Right', 'woovina'),
				),
			)));

			/**
			 * Blog Single Page Header Background Image Attachment
			 */
			$wp_customize->add_setting('woovina_blog_single_title_bg_image_attachment', array(
				'transport' 			=> 'postMessage',
				'default' 				=> 'initial',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_single_title_bg_image_attachment', array(
				'label'	   				=> esc_html__('Attachment', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_title_bg_image_attachment',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_blog_single_title_bg_image',
				'choices' 				=> array(
					'initial' 	=> esc_html__('Default', 'woovina'),
					'scroll' 	=> esc_html__('Scroll', 'woovina'),
					'fixed' 	=> esc_html__('Fixed', 'woovina'),
				),
			)));

			/**
			 * Blog Single Page Header Background Image Repeat
			 */
			$wp_customize->add_setting('woovina_blog_single_title_bg_image_repeat', array(
				'transport' 			=> 'postMessage',
				'default' 				=> 'no-repeat',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_single_title_bg_image_repeat', array(
				'label'	   				=> esc_html__('Repeat', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_title_bg_image_repeat',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_blog_single_title_bg_image',
				'choices' 				=> array(
					'initial' 	=> esc_html__('Default', 'woovina'),
					'no-repeat' => esc_html__('No-repeat', 'woovina'),
					'repeat' 	=> esc_html__('Repeat', 'woovina'),
					'repeat-x' 	=> esc_html__('Repeat-x', 'woovina'),
					'repeat-y' 	=> esc_html__('Repeat-y', 'woovina'),
				),
			)));

			/**
			 * Blog Single Page Header Background Image Size
			 */
			$wp_customize->add_setting('woovina_blog_single_title_bg_image_size', array(
				'transport' 			=> 'postMessage',
				'default' 				=> 'cover',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_single_title_bg_image_size', array(
				'label'	   				=> esc_html__('Size', 'woovina'),
				'type' 					=> 'select',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_title_bg_image_size',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_blog_single_title_bg_image',
				'choices' 				=> array(
					'initial' 	=> esc_html__('Default', 'woovina'),
					'auto' 		=> esc_html__('Auto', 'woovina'),
					'cover' 	=> esc_html__('Cover', 'woovina'),
					'contain' 	=> esc_html__('Contain', 'woovina'),
				),
			)));

			/**
			 * Blog Single Page Header Background Image Height
			 */
			$wp_customize->add_setting('woovina_blog_single_title_bg_image_height', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '400',
				'sanitize_callback' 	=> 'woovina_sanitize_number',
			));

			$wp_customize->add_control(new WooVina_Customizer_Range_Control($wp_customize, 'woovina_blog_single_title_bg_image_height', array(
				'label'	   				=> esc_html__('Page Header Height (px)', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_title_bg_image_height',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 800,
			        'step'  => 1,
			   ),
				'active_callback' 		=> 'woovina_cac_has_blog_single_title_bg_image',
			)));

			/**
			 * Blog Single Page Header Background Image Overlay Opacity
			 */
			$wp_customize->add_setting('woovina_blog_single_title_bg_image_overlay_opacity', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '0.5',
				'sanitize_callback' 	=> 'woovina_sanitize_number',
			));

			$wp_customize->add_control(new WooVina_Customizer_Range_Control($wp_customize, 'woovina_blog_single_title_bg_image_overlay_opacity', array(
				'label'	   				=> esc_html__('Overlay Opacity', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_title_bg_image_overlay_opacity',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 1,
			        'step'  => 0.1,
			   ),
				'active_callback' 		=> 'woovina_cac_has_blog_single_title_bg_image',
			)));

			/**
			 * Blog Single Page Header Background Image Overlay Color
			 */
			$wp_customize->add_setting('woovina_blog_single_title_bg_image_overlay_color', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '#000000',
				'sanitize_callback' 	=> 'woovina_sanitize_color',
			));

			$wp_customize->add_control(new WooVina_Customizer_Color_Control($wp_customize, 'woovina_blog_single_title_bg_image_overlay_color', array(
				'label'	   				=> esc_html__('Overlay Color', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_title_bg_image_overlay_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'woovina_cac_has_blog_single_title_bg_image',
			)));

			/**
			 * Full Width Content Max Width
			 */
			$wp_customize->add_setting('woovina_blog_single_content_width', array(
				'transport' 			=> 'postMessage',
				'default' 				=> '700',
				'sanitize_callback' 	=> 'woovina_sanitize_number_blank',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_single_content_width', array(
				'label'	   				=> esc_html__('Full Width Content', 'woovina'),
				'description'	   		=> esc_html__('Enter the max width your the content with the full width layout. Add 0 to disable the max width.', 'woovina'),
				'type' 					=> 'number',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_content_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'step'  => 1,
			   ),
			)));

			/**
			 * Blog Single Elements Positioning
			 */
			$wp_customize->add_setting('woovina_blog_single_elements_positioning', array(
				'default' 				=> array('featured_image', 'title', 'meta', 'content', 'tags', 'social_share', 'next_prev', 'author_box', 'related_posts', 'single_comments'),
				'sanitize_callback' 	=> 'woovina_sanitize_multi_choices',
			));

			$wp_customize->add_control(new WooVina_Customizer_Sortable_Control($wp_customize, 'woovina_blog_single_elements_positioning', array(
				'label'	   				=> esc_html__('Elements Positioning', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_elements_positioning',
				'priority' 				=> 10,
				'choices' 				=> woovina_blog_single_elements(),
			)));

			/**
			 * Blog Single Meta
			 */
			$wp_customize->add_setting('woovina_blog_single_meta', array(
				'default'           	=> array('author', 'date', 'categories', 'comments'),
				'sanitize_callback' 	=> 'woovina_sanitize_multi_choices',
			));

			$wp_customize->add_control(new WooVina_Customizer_Sortable_Control($wp_customize, 'woovina_blog_single_meta', array(
				'label'	   				=> esc_html__('Meta', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_single_meta',
				'priority' 				=> 10,
				'choices' 				=> apply_filters('woovina_blog_meta_choices', array(
					'author'     		=> esc_html__('Author', 'woovina'),
					'date'       		=> esc_html__('Date', 'woovina'),
					'categories' 		=> esc_html__('Categories', 'woovina'),
					'comments'   		=> esc_html__('Comments', 'woovina'),
				)),
			)));

			/**
			 * Next/Prev Taxonomy
			 */
			$wp_customize->add_setting('woovina_single_post_next_prev_taxonomy', array(
				'default' 				=> 'post_tag',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WooVina_Customizer_Buttonset_Control($wp_customize, 'woovina_single_post_next_prev_taxonomy', array(
				'label'	   				=> esc_html__('Next/Prev Taxonomy', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_single_post_next_prev_taxonomy',
				'priority' 				=> 10,
				'choices' 				=> array(
					'category' 	=> esc_html__('Category', 'woovina'),
					'post_tag' 	=> esc_html__('Tag', 'woovina'),
				),
			)));

			/**
			 * Related Posts Count
			 */
			$wp_customize->add_setting('woovina_blog_related_count', array(
				'default' 				=> '3',
				'sanitize_callback' 	=> 'woovina_sanitize_number',
			));

			$wp_customize->add_control(new WooVina_Customizer_Range_Control($wp_customize, 'woovina_blog_related_count', array(
				'label'	   				=> esc_html__('Related Posts Count', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_related_count',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 2,
			        'max'   => 50,
			        'step'  => 1,
			   ),
			)));

			/**
			 * Related Posts Columns
			 */
			$wp_customize->add_setting('woovina_blog_related_columns', array(
				'default' 				=> '3',
				'sanitize_callback' 	=> 'woovina_sanitize_number',
			));

			$wp_customize->add_control(new WooVina_Customizer_Range_Control($wp_customize, 'woovina_blog_related_columns', array(
				'label'	   				=> esc_html__('Related Posts Columns', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_related_columns',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 1,
			        'max'   => 6,
			        'step'  => 1,
			   ),
			)));

			/**
			 * Related Posts Taxonomy
			 */
			$wp_customize->add_setting('woovina_blog_related_taxonomy', array(
				'default' 				=> 'category',
				'sanitize_callback' 	=> 'woovina_sanitize_select',
			));

			$wp_customize->add_control(new WooVina_Customizer_Buttonset_Control($wp_customize, 'woovina_blog_related_taxonomy', array(
				'label'	   				=> esc_html__('Related Posts Taxonomy', 'woovina'),
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_related_taxonomy',
				'priority' 				=> 10,
				'choices' 				=> array(
					'category' 	=> esc_html__('Category', 'woovina'),
					'post_tag' 	=> esc_html__('Tag', 'woovina'),
				),
			)));

			/**
			 * Related Posts Image Width
			 */
			$wp_customize->add_setting('woovina_blog_related_img_width', array(
				'sanitize_callback' 	=> 'woovina_sanitize_number_blank',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_related_img_width', array(
				'label'	   				=> esc_html__('Related Posts Image Width (px)', 'woovina'),
				'type' 					=> 'number',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_related_img_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 800,
			   ),
			)));

			/**
			 * Related Posts Image Height
			 */
			$wp_customize->add_setting('woovina_blog_related_img_height', array(
				'sanitize_callback' 	=> 'woovina_sanitize_number_blank',
			));

			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'woovina_blog_related_img_height', array(
				'label'	   				=> esc_html__('Related Posts Image Height (px)', 'woovina'),
				'type' 					=> 'number',
				'section'  				=> 'woovina_single_post',
				'settings' 				=> 'woovina_blog_related_img_height',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 800,
			   ),
			)));

		}

		/**
		 * Get CSS
		 *
		 * @since 1.0.0
		 */
		public static function head_css($output) {

			// Layout
			$entries_layout 					= get_theme_mod('woovina_blog_archives_layout', 'right-sidebar');
			$single_layout 						= get_theme_mod('woovina_blog_single_layout', 'right-sidebar');

			// Global vars
			$bs_archives_content_width 			= get_theme_mod('woovina_blog_archives_both_sidebars_content_width');
			$bs_archives_sidebars_width 		= get_theme_mod('woovina_blog_archives_both_sidebars_sidebars_width');
			$bs_single_content_width 			= get_theme_mod('woovina_blog_single_both_sidebars_content_width');
			$bs_single_sidebars_width 			= get_theme_mod('woovina_blog_single_both_sidebars_sidebars_width');
			$thumbnail_category_color 			= get_theme_mod('woovina_blog_thumbnail_category_color', '#f68e13');
			$thumbnail_category_hover_color 	= get_theme_mod('woovina_blog_thumbnail_category_hover_color', '#333333');
			$thumbnail_comments_color 			= get_theme_mod('woovina_blog_thumbnail_comments_color', '#ababab');
			$thumbnail_comments_hover_color 	= get_theme_mod('woovina_blog_thumbnail_comments_hover_color', '#f68e13');
			$thumbnail_date_color 				= get_theme_mod('woovina_blog_thumbnail_date_color', '#ababab');
			$infinite_scroll_spinners_color 	= get_theme_mod('woovina_blog_infinite_scroll_spinners_color', '#333333');
			$title_breadcrumb_position 			= get_theme_mod('woovina_blog_single_title_breadcrumb_position', 'center');
			$single_content_width 				= get_theme_mod('woovina_blog_single_content_width', '700');

			// Define css var
			$css = '';

			// If blog archives Both Sidebars layout
			if('both-sidebars' == $entries_layout) {

				// Both Sidebars layout blog archives content width
				if(! empty($bs_archives_content_width)) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.blog.content-both-sidebars .content-area,
							body.archive.category.content-both-sidebars .content-area {width: '. $bs_archives_content_width .'%;}
							body.blog.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.blog.content-both-sidebars.ssc-style .widget-area,
							body.archive.category.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.archive.category.content-both-sidebars.ssc-style .widget-area {left: -'. $bs_archives_content_width .'%;}
						}';
				}

				// Both Sidebars layout blog archives sidebars width
				if(! empty($bs_archives_sidebars_width)) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.blog.content-both-sidebars .widget-area,
							body.archive.category.content-both-sidebars .widget-area{width:'. $bs_archives_sidebars_width .'%;}
							body.blog.content-both-sidebars.scs-style .content-area,
							body.archive.category.content-both-sidebars.scs-style .content-area{left:'. $bs_archives_sidebars_width .'%;}
							body.blog.content-both-sidebars.ssc-style .content-area,
							body.archive.category.content-both-sidebars.ssc-style .content-area{left:'. $bs_archives_sidebars_width * 2 .'%;}
						}';
				}

			}

			// If single post Both Sidebars layout
			if('both-sidebars' == $single_layout) {

				// Both Sidebars layout single post content width
				if(! empty($bs_single_content_width)) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.single-post.content-both-sidebars .content-area {width: '. $bs_single_content_width .'%;}
							body.single-post.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.single-post.content-both-sidebars.ssc-style .widget-area {left: -'. $bs_single_content_width .'%;}
						}';
				}

				// Both Sidebars layout blog archives sidebars width
				if(! empty($bs_single_sidebars_width)) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.single-post.content-both-sidebars .widget-area{width:'. $bs_single_sidebars_width .'%;}
							body.single-post.content-both-sidebars.scs-style .content-area{left:'. $bs_single_sidebars_width .'%;}
							body.single-post.content-both-sidebars.ssc-style .content-area{left:'. $bs_single_sidebars_width * 2 .'%;}
						}';
				}

			}

			// Blog thumbnail category color
			if(! empty($thumbnail_category_color) && '#f68e13' != $thumbnail_category_color) {
				$css .= '.blog-entry.thumbnail-entry .blog-entry-category a{color:'. $thumbnail_category_color .';}';
			}

			// Blog thumbnail category hover color
			if(! empty($thumbnail_category_hover_color) && '#333333' != $thumbnail_category_hover_color) {
				$css .= '.blog-entry.thumbnail-entry .blog-entry-category a:hover{color:'. $thumbnail_category_hover_color .';}';
			}

			// Blog thumbnail comments color
			if(! empty($thumbnail_comments_color) && '#ababab' != $thumbnail_comments_color) {
				$css .= '.blog-entry.thumbnail-entry .blog-entry-comments, .blog-entry.thumbnail-entry .blog-entry-comments a{color:'. $thumbnail_comments_color .';}';
			}

			// Blog thumbnail comments hover color
			if(! empty($thumbnail_comments_hover_color) && '#f68e13' != $thumbnail_comments_hover_color) {
				$css .= '.blog-entry.thumbnail-entry .blog-entry-comments a:hover{color:'. $thumbnail_comments_hover_color .';}';
			}

			// Blog thumbnail date color
			if(! empty($thumbnail_date_color) && '#ababab' != $thumbnail_date_color) {
				$css .= '.blog-entry.thumbnail-entry .blog-entry-date{color:'. $thumbnail_date_color .';}';
			}

			// Blog infinite scroll spinners color
			if(! empty($infinite_scroll_spinners_color) && '#333333' != $infinite_scroll_spinners_color) {
				$css .= '.loader-ellips__dot{background-color:'. $infinite_scroll_spinners_color .';}';
			}

			// Title/breadcrumb position
			if(! empty($title_breadcrumb_position) && 'center' != $title_breadcrumb_position) {
				$css .= '.single-post .background-image-page-header .page-header-inner, .single-post .background-image-page-header .site-breadcrumbs{text-align:'. $title_breadcrumb_position .';}';
			}

			// Single content width
			if(! empty($single_content_width) && '700' != $single_content_width) {
				$css .= '.single-post.content-max-width .thumbnail, .single-post.content-max-width .entry-header, .single-post.content-max-width ul.meta, .single-post.content-max-width .entry-content p, .single-post.content-max-width .entry-content h1, .single-post.content-max-width .entry-content h2, .single-post.content-max-width .entry-content h3, .single-post.content-max-width .entry-content h4, .single-post.content-max-width .entry-content h5, .single-post.content-max-width .entry-content h6, .single-post.content-max-width .wp-block-image, .single-post.content-max-width .wp-block-gallery, .single-post.content-max-width .wp-block-video, .single-post.content-max-width .wp-block-quote, .single-post.content-max-width .wp-block-text-columns, .single-post.content-max-width .entry-content ul, .single-post.content-max-width .entry-content ol, .single-post.content-max-width .wp-block-cover-text, .single-post.content-max-width .post-tags, .single-post.content-max-width .comments-area{max-width:' . $single_content_width . 'px;} .single-post.content-max-width .wp-block-image.alignleft, .single-post.content-max-width .wp-block-image.alignright{max-width:'. $single_content_width / 2 .'px;} .single-post.content-max-width .wp-block-image.alignleft{margin-left: calc(50% - '. $single_content_width / 2 .'px);} .single-post.content-max-width .wp-block-image.alignright{margin-right: calc(50% - '. $single_content_width / 2 .'px);}';

			}
				
			// Return CSS
			if(! empty($css)) {
				$output .= '/* Blog CSS */'. $css;
			}

			// Return output css
			return $output;

		}

	}

endif;

return new WooVina_Blog_Customizer();