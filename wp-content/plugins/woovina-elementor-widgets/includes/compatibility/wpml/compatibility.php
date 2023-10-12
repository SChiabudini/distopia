<?php
namespace wvnElementor\Compatibility;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * WPML Compatibility
 *
 * Registers translatable widgets
 *
 * @since 1.0.16
 */
class WPML {

	/**
	 * @since 1.0.16
	 * @var Object
	 */
	public static $instance = null;

	/**
	 * Returns the class instance
	 * 
	 * @since 1.0.16
	 *
	 * @return Object
	 */
	public static function instance() {
		if(is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor for the class
	 *
	 * @since 1.0.16
	 *
	 * @return void
	 */
	public function __construct() {

		// WPML String Translation plugin exist check
		if(is_wpml_string_translation_active()) {
			add_filter('wpml_elementor_widgets_to_translate', [ $this, 'add_translatable_nodes' ]);
		}
	}

	/**
	 * Adds additional translatable nodes to WPML
	 *
	 * @since 1.0.16
	 *
	 * @param  array   $nodes_to_translate WPML nodes to translate
	 * @return array   $nodes_to_translate Updated nodes
	 */
	public function add_translatable_nodes($nodes_to_translate) {

		$nodes_to_translate[ 'wew-accordion' ] = array(
			'conditions' => array('widgetType' => 'wew-accordion'),
			'fields'     => array(
				array(
					'field'       => 'tab_title',
					'type'        => __('Accordion Title & Content', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'tab_content',
					'type'        => __('Accordion Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-acf' ] = array(
			'conditions' => array('widgetType' => 'wew-acf'),
			'fields'     => array(
				array(
					'field'       => 'field_name',
					'type'        => __('ACF Field Name', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'link_text',
					'type'        => __('ACF Link Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'field_label',
					'type'        => __('ACF Label', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-advanced-heading' ] = array(
			'conditions' => array('widgetType' => 'wew-advanced-heading'),
			'fields'     => array(
				array(
					'field'       => 'main_heading',
					'type'        => __('Advanced Heading Heading', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'sub_heading',
					'type'        => __('Advanced Heading Sub Heading', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'background_heading',
					'type'        => __('Advanced Heading Background Heading', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-alert' ] = array(
			'conditions' => array('widgetType' => 'wew-alert'),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __('Alert Message Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'content',
					'type'        => __('Alert Message Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-animated-heading' ] = array(
			'conditions' => array('widgetType' => 'wew-animated-heading'),
			'fields'     => array(
				array(
					'field'       => 'pre_heading',
					'type'        => __('Animated Heading Pre Heading', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'animated_heading',
					'type'        => __('Animated Heading Heading', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'post_heading',
					'type'        => __('Animated Heading Post Heading', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-banner' ] = array(
			'conditions' => array('widgetType' => 'wew-banner'),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __('Banner Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __('Banner Description', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-brands' ] = array(
			'conditions' => array('widgetType' => 'wew-brands'),
			'fields'     => array(
				array(
					'field'       => 'item_name',
					'type'        => __('Brands Company Name', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'item_description',
					'type'        => __('Brands Company Description', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-business-hours' ] = array(
			'conditions' => array('widgetType' => 'wew-business-hours'),
			'fields'     => array(
				array(
					'field'       => 'closed_text',
					'type'        => __('Business Hours Closed Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-button-effects' ] = array(
			'conditions' => array('widgetType' => 'wew-button-effects'),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __('Button Effects Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-buttons' ] = array(
			'conditions' => array('widgetType' => 'wew-buttons'),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __('Buttons Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-call-to-action' ] = array(
			'conditions' => array('widgetType' => 'wew-call-to-action'),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __('Call To Action Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __('Call To Action Description', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'btn_text',
					'type'        => __('Call To Action Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-circle-progress' ] = array(
			'conditions' => array('widgetType' => 'wew-circle-progress'),
			'fields'     => array(
				array(
					'field'       => 'text_before',
					'type'        => __('Circle Progress Text Before', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'text_middle',
					'type'        => __('Circle Progress Text Middle', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'text_after',
					'type'        => __('Circle Progress Text After', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'content',
					'type'        => __('Circle Progress Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-countdown' ] = array(
			'conditions' => array('widgetType' => 'wew-countdown'),
			'fields'     => array(
				array(
					'field'       => 'label_days',
					'type'        => __('Countdown Days', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'label_hours',
					'type'        => __('Countdown Hours', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'label_minutes',
					'type'        => __('Countdown Minutes', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'label_seconds',
					'type'        => __('Countdown Seconds', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-divider' ] = array(
			'conditions' => array('widgetType' => 'wew-divider'),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __('Divider Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-flip-box' ] = array(
			'conditions' => array('widgetType' => 'wew-flip-box'),
			'fields'     => array(
				array(
					'field'       => 'front_title_text',
					'type'        => __('Flip Box Front Title & Description', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'front_description_text',
					'type'        => __('Flip Box Front Description', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'back_title_text',
					'type'        => __('Flip Box Back Title & Description', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'back_description_text',
					'type'        => __('Flip Box Back Description', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'button_text',
					'type'        => __('Flip Box Back Button Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-hotspots' ] = array(
			'conditions' => array('widgetType' => 'wew-hotspots'),
			'fields'     => array(
				array(
					'field'       => 'hotspot_text',
					'type'        => __('Hotspots Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'tooltip_content',
					'type'        => __('Hotspots Tooltip Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-image-comparison' ] = array(
			'conditions' => array('widgetType' => 'wew-image-comparison'),
			'fields'     => array(
				array(
					'field'       => 'before_label',
					'type'        => __('Image Comparison Before Label', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'after_label',
					'type'        => __('Image Comparison After Label', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-info-box' ] = array(
			'conditions' => array('widgetType' => 'wew-info-box'),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __('Info Box Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'title',
					'type'        => __('Info Box Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __('Info Box Description', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'button_text',
					'type'        => __('Info Box Button Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-link-effects' ] = array(
			'conditions' => array('widgetType' => 'wew-link-effects'),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __('Link Effects Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'second_text',
					'type'        => __('Link Effects Secondary Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-logged-in-out' ] = array(
			'conditions' => array('widgetType' => 'wew-logged-in-out'),
			'fields'     => array(
				array(
					'field'       => 'logged_in_content',
					'type'        => __('Logged In Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'logged_out_content',
					'type'        => __('Logged Out Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-login' ] = array(
			'conditions' => array('widgetType' => 'wew-login'),
			'fields'     => array(
				array(
					'field'       => 'user_label',
					'type'        => __('Login Username', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'pass_label',
					'type'        => __('Login Password', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'user_placeholder',
					'type'        => __('Login Username Placeholder', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'pass_placeholder',
					'type'        => __('Login Password Placeholder', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'submit_text',
					'type'        => __('Login Submit Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'register_text',
					'type'        => __('Login Register Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'lost_password_text',
					'type'        => __('Login Lost Password Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-lost-password' ] = array(
			'conditions' => array('widgetType' => 'wew-lost-password'),
			'fields'     => array(
				array(
					'field'       => 'message',
					'type'        => __('Lost Password Message', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'user_label',
					'type'        => __('Lost Password Username', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'user_placeholder',
					'type'        => __('Lost Password Username Placeholder', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'submit_text',
					'type'        => __('Lost Password Submit Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'login_text',
					'type'        => __('Lost Password Login Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-member' ] = array(
			'conditions' => array('widgetType' => 'wew-member'),
			'fields'     => array(
				array(
					'field'       => 'name',
					'type'        => __('Member Name', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'role',
					'type'        => __('Member Role', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __('Member Description', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'social_link_title',
					'type'        => __('Member Social Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-modal' ] = array(
			'conditions' => array('widgetType' => 'wew-modal'),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __('Modal Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'content',
					'type'        => __('Modal Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-navbar' ] = array(
			'conditions' => array('widgetType' => 'wew-navbar'),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __('Navbar Button Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'off_canvas_title',
					'type'        => __('Navbar Off Canvas Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'mobile_title',
					'type'        => __('Navbar Mobile Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'mobile_close_title',
					'type'        => __('Navbar Close Mobile Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-newsletter' ] = array(
			'conditions' => array('widgetType' => 'wew-newsletter'),
			'fields'     => array(
				array(
					'field'       => 'placeholder_text',
					'type'        => __('Newsletter Placeholder Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'submit_text',
					'type'        => __('Newsletter Submit Button Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-off-canvas' ] = array(
			'conditions' => array('widgetType' => 'wew-off-canvas'),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __('Off Canvas Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-price-list' ] = array(
			'conditions' => array('widgetType' => 'wew-price-list'),
			'fields'     => array(
				array(
					'field'       => 'price',
					'type'        => __('Price List Price', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'title',
					'type'        => __('Price List Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __('Price List Description', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-pricing' ] = array(
			'conditions' => array('widgetType' => 'wew-pricing'),
			'fields'     => array(
				array(
					'field'       => 'plan',
					'type'        => __('Pricing Plan', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'cost',
					'type'        => __('Pricing Cost', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'per',
					'type'        => __('Pricing Per', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'content',
					'type'        => __('Pricing Features', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'button_text',
					'type'        => __('Pricing Button Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				'link' => array(
					'field'       => 'button_url',
					'type'        => __('Pricing Button link', 'woovina-elementor-widgets'),
					'editor_type' => 'LINK'
				),
			),
		);

		$nodes_to_translate[ 'wew-recipe' ] = array(
			'conditions' => array('widgetType' => 'wew-recipe'),
			'fields'     => array(
				array(
					'field'       => 'name',
					'type'        => __('Recipe Name', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __('Recipe Description', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'prep_text',
					'type'        => __('Recipe Prep Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'prep_value',
					'type'        => __('Recipe Prep Value', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'cook_text',
					'type'        => __('Recipe Cook Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'cook_value',
					'type'        => __('Recipe Cook Value', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'total_text',
					'type'        => __('Recipe Total Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'total_value',
					'type'        => __('Recipe Total Value', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'servings_text',
					'type'        => __('Recipe Servings Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'servings_value',
					'type'        => __('Recipe Servings Value', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'calories_text',
					'type'        => __('Recipe Calories Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'calories_value',
					'type'        => __('Recipe Calories Value', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'ingredient',
					'type'        => __('Recipe Ingredient Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'instruction',
					'type'        => __('Recipe Instruction Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'notes',
					'type'        => __('Recipe Notes', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-register' ] = array(
			'conditions' => array('widgetType' => 'wew-register'),
			'fields'     => array(
				array(
					'field'       => 'user_label',
					'type'        => __('Register Username', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'email_label',
					'type'        => __('Register Email', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'user_placeholder',
					'type'        => __('Register Username Placeholder', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'email_placeholder',
					'type'        => __('Register Email Placeholder', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'form_text',
					'type'        => __('Register Form Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'submit_text',
					'type'        => __('Register Submit Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'login_text',
					'type'        => __('Register Login Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-scroll-up' ] = array(
			'conditions' => array('widgetType' => 'wew-scroll-up'),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __('Scroll Up Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-search' ] = array(
			'conditions' => array('widgetType' => 'wew-search'),
			'fields'     => array(
				array(
					'field'       => 'placeholder',
					'type'        => __('Search Placeholder', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-skillbar' ] = array(
			'conditions' => array('widgetType' => 'wew-skillbar'),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __('Skillbar Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-table' ] = array(
			'conditions' => array('widgetType' => 'wew-table'),
			'fields'     => array(
				array(
					'field'       => 'cell_text',
					'type'        => __('Table Cell Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'content_text',
					'type'        => __('Table Content Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-tabs' ] = array(
			'conditions' => array('widgetType' => 'wew-tabs'),
			'fields'     => array(
				array(
					'field'       => 'tab_title',
					'type'        => __('Tabs Title & Content', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'tab_content',
					'type'        => __('Tabs Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-timeline' ] = array(
			'conditions' => array('widgetType' => 'wew-timeline'),
			'fields'     => array(
				array(
					'field'       => 'timeline_title',
					'type'        => __('Timeline Title', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'timeline_date',
					'type'        => __('Timeline Date', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'timeline_text',
					'type'        => __('Timeline Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'timeline_link',
					'type'        => __('Timeline Item Link', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'readmore_text',
					'type'        => __('Timeline Read More Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'wew-toggle' ] = array(
			'conditions' => array('widgetType' => 'wew-toggle'),
			'fields'     => array(
				array(
					'field'       => 'primary_label',
					'type'        => __('Toggle Label', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'primary_content',
					'type'        => __('Toggle Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'secondary_label',
					'type'        => __('Toggle Secondary Label', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'secondary_content',
					'type'        => __('Toggle Secondary Content', 'woovina-elementor-widgets'),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'wew-woo-add-to-cart' ] = array(
			'conditions' => array('widgetType' => 'wew-woo-add-to-cart'),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __('Woo Add To Cart Text', 'woovina-elementor-widgets'),
					'editor_type' => 'LINE'
				),
			),
		);

		return $nodes_to_translate;
	}

	/**
	 * Returns the class instance.
	 *
	 * @since 1.0.16
	 *
	 * @return Object
	 */
	public static function get_instance() {
		
		if(null == self::$instance)
			self::$instance = new self;

		return self::$instance;
	}
}