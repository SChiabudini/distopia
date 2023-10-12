<?php
namespace wvnElementor\Modules\Woocommerce\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use wvnElementor\Modules\QueryPost\Module;

class Woo_Add_To_Cart extends Widget_Base {

	public function get_name() {
		return 'wew-woo-add-to-cart';
	}

	public function get_title() {
		return __('Woo - Add To Cart', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-woocommerce';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-woo-addtocart' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_woo_product',
			[
				'label' 		=> __('Product', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'product_id',
			[
				'label' 		=> __('Select Product', 'woovina-elementor-widgets'),
				'type' 			=> 'wew-query-posts',
				'post_type' 	=> 'product',
			]
		);

		$this->add_control(
			'quantity',
			[
				'label' 		=> __('Quantity', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> 1,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' 		=> __('Button', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'text',
			[
				'label' 		=> __('Text', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __('Add To Cart', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' 		=> __('Alignment', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    => [
						'title' => __('Left', 'woovina-elementor-widgets'),
						'icon' 	=> 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'woovina-elementor-widgets'),
						'icon' 	=> 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'woovina-elementor-widgets'),
						'icon' 	=> 'fa fa-align-right',
					],
					'justify' => [
						'title' => __('Justified', 'woovina-elementor-widgets'),
						'icon' 	=> 'fa fa-align-justify',
					],
				],
				'default' 		=> '',
				'prefix_class' => 'wew%s-align-',
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __('Icon', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> 'fa fa-shopping-basket',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' 		=> __('Icon Position', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'left',
				'options' 		=> [
					'left' => __('Before', 'woovina-elementor-widgets'),
					'right' => __('After', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' 		=> __('Icon Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 4,
				],
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-addtocart .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' 		=> __('Button', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-addtocart',
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .wew-addtocart',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-addtocart',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_view_cart_style',
			[
				'label' 		=> __('View Cart Text', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'view_cart_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-addtocart-wrap .added_to_cart',
			]
		);

		$this->start_controls_tabs('tabs_view_cart_style');

		$this->start_controls_tab(
			'tab_view_cart_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'view_cart_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart-wrap .added_to_cart' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view_cart_text_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart-wrap .added_to_cart' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_view_cart_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'view_cart_hover_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart-wrap .added_to_cart:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view_cart_hover_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart-wrap .added_to_cart:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view_cart_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart-wrap .added_to_cart:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'view_cart_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .wew-addtocart-wrap .added_to_cart',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'view_cart_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart-wrap .added_to_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'view_cart_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-addtocart-wrap .added_to_cart',
			]
		);

		$this->add_responsive_control(
			'view_cart_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart-wrap .added_to_cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'view_cart_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-addtocart-wrap .added_to_cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$html 		= '';
		$product 	= false;

		if(! empty($settings['product_id'])) {
			$product_data = get_post($settings['product_id']);
		}

		$product = ! empty($product_data) && in_array($product_data->post_type, [ 'product', 'product_variation' ]) ? wc_setup_product_data($product_data) : false;

		$this->add_render_attribute('button-wrap', 'class', 'wew-addtocart-wrap');
		$this->add_render_attribute('button-text', 'class', 'wew-addtocart-text');

		if($product) {

			$product_id   = $product->get_id();
			$product_type = $product->get_type();

			$class = [
				'wew-addtocart',
				'button',
				'product_type_' . $product_type,
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				$product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
			];

			$this->add_render_attribute(
				'button', [
					'href'            => $product->add_to_cart_url(),
					'class'           => $class,
					'data-quantity'   => (isset($settings['quantity']) ? $settings['quantity'] : 1),
					'data-product_id' => $product_id,
					'rel'             => 'nofollow',
				]
			);
		
			$this->add_render_attribute('icon-align', 'class', [
				'wew-button-icon',
				'elementor-align-icon-' . $settings['icon_align'],
			]); ?>

			<div <?php echo $this->get_render_attribute_string('button-wrap'); ?>>
				<a <?php echo $this->get_render_attribute_string('button'); ?>>
					<?php
					if(! empty($settings['icon']) && 'left' == $settings['icon_align']) { ?>
						<span <?php echo $this->get_render_attribute_string('icon-align'); ?>>
							<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
						</span>
					<?php
					} ?>

					<span <?php echo $this->get_render_attribute_string('button-text'); ?>><?php echo esc_attr($settings['text']); ?></span>

					<?php
					if(! empty($settings['icon']) && 'right' == $settings['icon_align']) { ?>
						<span <?php echo $this->get_render_attribute_string('icon-align'); ?>>
							<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
						</span>
					<?php
					} ?>
				</a>
			</div>

		<?php
		} elseif(current_user_can('manage_options')) {

			$this->add_render_attribute('button', 'href', '#');
			$this->add_render_attribute('button', 'class', [
				'wew-addtocart',
				'button',
			]); ?>

			<div <?php echo $this->get_render_attribute_string('button-wrap'); ?>>
				<a <?php echo $this->get_render_attribute_string('button'); ?>>
					<span <?php echo $this->get_render_attribute_string('button-text'); ?>><?php echo __('Please select a product', 'woovina-elementor-widgets'); ?></span>
				</a>
			</div>

		<?php
		}
	}

}