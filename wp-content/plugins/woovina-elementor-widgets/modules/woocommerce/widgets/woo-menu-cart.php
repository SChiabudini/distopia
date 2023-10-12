<?php
namespace wvnElementor\Modules\Woocommerce\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use wvnElementor\Modules\Woocommerce\Module;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Woo_MenuCart extends Widget_Base {

	public function get_name() {
		return 'wew-woo-menucart';
	}

	public function get_title() {
		return __( 'Woo - Menu Cart', 'woovina-elementor-widgets' );
	}

	public function get_icon() {
		return 'wew-icon eicon-cart';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}
	
	public function get_style_depends() {
		return [ 'wew-eicons-bc', 'wew-woo-menucart' ];
	}
	
	protected function _register_controls() {

		$this->start_controls_section(
			'section_menu_icon_content',
			[
				'label' => __( 'Menu Icon', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'cart-light' => __( 'Cart', 'woovina-elementor-widgets' ) . ' ' . __( 'Light', 'woovina-elementor-widgets' ),
					'cart-medium' => __( 'Cart', 'woovina-elementor-widgets' ) . ' ' . __( 'Medium', 'woovina-elementor-widgets' ),
					'cart-solid' => __( 'Cart', 'woovina-elementor-widgets' ) . ' ' . __( 'Solid', 'woovina-elementor-widgets' ),
					'basket-light' => __( 'Basket', 'woovina-elementor-widgets' ) . ' ' . __( 'Light', 'woovina-elementor-widgets' ),
					'basket-medium' => __( 'Basket', 'woovina-elementor-widgets' ) . ' ' . __( 'Medium', 'woovina-elementor-widgets' ),
					'basket-solid' => __( 'Basket', 'woovina-elementor-widgets' ) . ' ' . __( 'Solid', 'woovina-elementor-widgets' ),
					'bag-light' => __( 'Bag', 'woovina-elementor-widgets' ) . ' ' . __( 'Light', 'woovina-elementor-widgets' ),
					'bag-medium' => __( 'Bag', 'woovina-elementor-widgets' ) . ' ' . __( 'Medium', 'woovina-elementor-widgets' ),
					'bag-solid' => __( 'Bag', 'woovina-elementor-widgets' ) . ' ' . __( 'Solid', 'woovina-elementor-widgets' ),
				],
				'default' => 'cart-medium',
				'prefix_class' => 'toggle-icon--',
			]
		);

		$this->add_control(
			'items_indicator',
			[
				'label' => __( 'Items Indicator', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'woovina-elementor-widgets' ),
					'bubble' => __( 'Bubble', 'woovina-elementor-widgets' ),
					'plain' => __( 'Plain', 'woovina-elementor-widgets' ),
				],
				'prefix_class' => 'woovina-menucart--items-indicator-',
				'default' => 'bubble',
			]
		);

		$this->add_control(
			'hide_empty_indicator',
			[
				'label' => __( 'Hide Empty', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'woovina-elementor-widgets' ),
				'label_off' => __( 'No', 'woovina-elementor-widgets' ),
				'return_value' => 'hide',
				'prefix_class' => 'woovina-menucart--empty-indicator-',
				'condition' => [
					'items_indicator!' => 'none',
				],
			]
		);

		$this->add_control(
			'show_subtotal',
			[
				'label' => __( 'Subtotal', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'woovina-elementor-widgets' ),
				'label_off' => __( 'Hide', 'woovina-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'woovina-menucart--show-subtotal-',
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'woovina-elementor-widgets' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'woovina-elementor-widgets' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'woovina-elementor-widgets' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style',
			[
				'label' => __( 'Menu Icon', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'toggle_button_colors' );

		$this->start_controls_tab( 'toggle_button_normal_colors', [ 'label' => __( 'Normal', 'woovina-elementor-widgets' ) ] );

		$this->add_control(
			'toggle_button_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_button_icon_color',
			[
				'label' => __( 'Icon Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_button_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_button_border_color',
			[
				'label' => __( 'Border Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'toggle_button_hover_colors', [ 'label' => __( 'Hover', 'woovina-elementor-widgets' ) ] );

		$this->add_control(
			'toggle_button_hover_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_button_hover_icon_color',
			[
				'label' => __( 'Icon Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button:hover .elementor-button-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_button_hover_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_button_hover_border_color',
			[
				'label' => __( 'Border Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'toggle_button_border_width',
			[
				'label' => __( 'Border Width', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'toggle_button_border_radius',
			[
				'label' => __( 'Border Radius', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button' => 'border-radius: {{SIZE}}{{UNIT}}',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'toggle_button_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .woovina-menucart__toggle .elementor-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'heading_icon_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Icon', 'woovina-elementor-widgets' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'toggle_icon_size',
			[
				'label' => __( 'Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'toggle_icon_spacing',
			[
				'label' => __( 'Spacing', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'size-units' => [ 'px', 'em' ],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .woovina-menucart__toggle .elementor-button-text' => 'margin-right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .woovina-menucart__toggle .elementor-button-text' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'toggle_button_padding',
			[
				'label' => __( 'Padding', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'items_indicator_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Items Indicator', 'woovina-elementor-widgets' ),
				'separator' => 'before',
				'condition' => [
					'items_indicator!' => 'none',
				],
			]
		);
		$this->add_control(
			'items_indicator_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button-icon[data-counter]:before' => 'color: {{VALUE}}',
				],
				'condition' => [
					'items_indicator!' => 'none',
				],
			]
		);

		$this->add_control(
			'items_indicator_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button-icon[data-counter]:before' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'items_indicator' => 'bubble',
				],
			]
		);

		$this->add_control(
			'items_indicator_distance',
			[
				'label' => __( 'Distance', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 4,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__toggle .elementor-button-icon[data-counter]:before' => 'right: -{{SIZE}}{{UNIT}}; top: -{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'items_indicator' => 'bubble',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cart_style',
			[
				'label' => __( 'Cart', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'show_divider',
			[
				'label' => __( 'Divider', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'woovina-elementor-widgets' ),
				'label_off' => __( 'Hide', 'woovina-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'woovina-menucart--show-divider-',
			]
		);

		$this->add_control(
			'show_remove_icon',
			[
				'label' => __( 'Remove Item Icon', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'woovina-elementor-widgets' ),
				'label_off' => __( 'Hide', 'woovina-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'woovina-menucart--show-remove-button-',
			]
		);

		$this->add_control(
			'heading_subtotal_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Subtotal', 'woovina-elementor-widgets' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'subtotal_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__subtotal' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtotal_typography',
				'selector' => '{{WRAPPER}} .woovina-menucart__subtotal',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_product_tabs_style',
			[
				'label' => __( 'Products', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_product_title_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Product Title', 'woovina-elementor-widgets' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'product_title_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__product-name, {{WRAPPER}} .woovina-menucart__product-name a' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'product_title_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .woovina-menucart__product-name, {{WRAPPER}} .woovina-menucart__product-name a',
			]
		);

		$this->add_control(
			'heading_product_price_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Product Price', 'woovina-elementor-widgets' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'product_price_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__product-price' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'product_price_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .woovina-menucart__product-price',
			]
		);

		$this->add_control(
			'heading_product_divider_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Divider', 'woovina-elementor-widgets' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => __( 'Style', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'woovina-elementor-widgets' ),
					'solid' => __( 'Solid', 'woovina-elementor-widgets' ),
					'double' => __( 'Double', 'woovina-elementor-widgets' ),
					'dotted' => __( 'Dotted', 'woovina-elementor-widgets' ),
					'dashed' => __( 'Dashed', 'woovina-elementor-widgets' ),
					'groove' => __( 'Groove', 'woovina-elementor-widgets' ),
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__product, {{WRAPPER}} .woovina-menucart__subtotal' => 'border-bottom-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__product, {{WRAPPER}} .woovina-menucart__subtotal' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' => __( 'Weight', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__product, {{WRAPPER}} .woovina-menucart__products, {{WRAPPER}} .woovina-menucart__subtotal' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'divider_gap',
			[
				'label' => __( 'Spacing', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__product, {{WRAPPER}} .woovina-menucart__subtotal' => 'padding-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .woovina-menucart__product:not(:first-of-type), {{WRAPPER}} .woovina-menucart__footer-buttons, {{WRAPPER}} .woovina-menucart__subtotal' => 'padding-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_buttons',
			[
				'label' => __( 'Buttons', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'buttons_layout',
			[
				'label' => __( 'Layout', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT2,
				'options' => [
					'inline' => __( 'Inline', 'woovina-elementor-widgets' ),
					'stacked' => __( 'Stacked', 'woovina-elementor-widgets' ),
				],
				'default' => 'inline',
				'prefix_class' => 'woovina-menucart--buttons-',
			]
		);

		$this->add_control(
			'space_between_buttons',
			[
				'label' => __( 'Space Between', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__footer-buttons' => 'grid-column-gap: {{SIZE}}{{UNIT}}; grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'product_buttons_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .woovina-menucart__footer-buttons .elementor-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-menucart__footer-buttons .elementor-button' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_view_cart_button_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'View Cart', 'woovina-elementor-widgets' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'view_cart_button_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button--view-cart' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view_cart_button_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button--view-cart' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'view_cart_border',
				'selector' => '{{WRAPPER}} .elementor-button--view-cart',
			]
		);

		$this->add_control(
			'heading_checkout_button_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Checkout', 'woovina-elementor-widgets' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'checkout_button_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button--checkout' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'checkout_button_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button--checkout' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'checkout_border',
				'selector' => '{{WRAPPER}} .elementor-button--checkout',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		Module::render_menu_cart();
	}

	public function render_plain_content() {}
}
