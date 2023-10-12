<?php
namespace wvnElementor\Modules\PriceList\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Price_List extends Widget_Base {

	public function get_name() {
		return 'wew-price-list';
	}

	public function get_title() {
		return __('Price List', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-bullet-list';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-price-list' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_price_list',
			[
				'label' 		=> __('List', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'price_list',
			[
				'label' 		=> __('List Items', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
					[
						'name' => 'price',
						'label' => __('Price', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'dynamic' => [ 'active' => true ],
					],
					[
						'name' => 'title',
						'label' => __('Title', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'label_block' => 'true',
						'dynamic' => [ 'active' => true ],
					],
					[
						'name' => 'description',
						'label' => __('Description', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
						'dynamic' => [ 'active' => true ],
					],
					[
						'name' => 'image',
						'label' => __('Image', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::MEDIA,
						'default' => [],
						'dynamic' => [ 'active' => true ],
					],
					[
						'name' => 'link',
						'label' => __('Link', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::URL,
						'default' => [ 'url' => '#' ],
					],
				],
				'default' 		=> [
					[
						'title' => __('Menu item #1', 'woovina-elementor-widgets'),
						'price' => '$49',
						'link' => [ 'url' => '#' ],
					],
					[
						'title' => __('Menu item #2', 'woovina-elementor-widgets'),
						'price' => '$24',
						'link' => [ 'url' => '#' ],
					],
					[
						'title' => __('Menu item #3', 'woovina-elementor-widgets'),
						'price' => '$99',
						'link' => [ 'url' => '#' ],
					],
				],
				'title_field' 	=> '{{{ title }}}',
			]
		);

		$this->add_control(
			'style',
			[
				'label'   		=> __('Style', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'side',
				'options' 		=> [
					'side'  	=> __('Side', 'woovina-elementor-widgets'),
					'inline'  	=> __('Inline', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'separator',
			[
				'label' 		=> __('Separator', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Price List', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'items_bg',
			[
				'label'     	=> esc_html__('Background Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-item' => 'background-color: {{VALUE}};',

				],
			]
		);

		$this->add_responsive_control(
			'items_spacing',
			[
				'label' 		=> __('Items Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'%' => [
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'items_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .wew-price-list-item',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'items_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'items_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-price-list-item',
			]
		);

		$this->add_responsive_control(
			'items_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' 		=> __('Title', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     	=> esc_html__('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-title' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-price-list-title',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_separator_style',
			[
				'label' 		=> __('Separator', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'separator' => 'yes',
				],
			]
		);

		$this->add_control(
			'separator_style',
			[
				'label' 		=> __('Style', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'' => __('Default', 'woovina-elementor-widgets'),
					'solid' => __('Solid', 'woovina-elementor-widgets'),
					'dotted' => __('Dotted', 'woovina-elementor-widgets'),
					'dashed' => __('Dashed', 'woovina-elementor-widgets'),
					'double' => __('Double', 'woovina-elementor-widgets'),
				],
				'default' 		=> '',
				'condition' 	=> [
					'separator' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-separator' => 'border-bottom-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_weight',
			[
				'label' 		=> __('Weight', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 10,
					],
				],
				'default' 		=> [
					'size' => 1,
				],
				'condition' 	=> [
					'separator' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-separator' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'condition' 	=> [
					'separator' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-separator' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_spacing',
			[
				'label' 		=> __('Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 40,
					],
				],
				'condition' 	=> [
					'separator' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-separator' => 'margin-left: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .wew-price-list-separator' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: 0;',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			[
				'label' 		=> __('Price', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_width',
			[
				'label' 		=> __('Width', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 400,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-price' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'price_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-price-list-price',
			]
		);

		$this->start_controls_tabs('tabs_price_style');

		$this->start_controls_tab(
			'tab_price_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'price_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-price' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_text_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_price_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'price_hover_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-item:hover .wew-price-list-price' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_hover_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-item:hover .wew-price-list-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-item:hover .wew-price-list-price' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'price_border',
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .wew-price-list-price',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'price_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'price_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-price-list-price',
			]
		);

		$this->add_responsive_control(
			'price_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'price_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-price-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label' 		=> __('Description', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     	=> esc_html__('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-description' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-price-list-description',
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' 		=> __('Image', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' 		=> __('Image Size', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 300,
					],
					'%' => [
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-image' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'image_border',
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .wew-price-list-image img',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'price_image_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-image, {{WRAPPER}} .wew-price-list-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'image_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-price-list-image img',
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-price-list-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$style 		= $settings['style'];

		$this->add_render_attribute('wrap', 'class', [
			'wew-price-list',
			'wew-price-list-' . $style
		]); ?>

		<ul <?php echo $this->get_render_attribute_string('wrap'); ?>>

			<?php
			foreach($settings['price_list'] as $index => $item) :
				$item_id 	= 'item-' . $index;

				$url 		= $item['link']['url'];
				$has_image 	= ($item['image']['url']) ? 'has-image ' : '';
				$image_id  	= $item['image']['id'];
				$image_src 	= wp_get_attachment_image_src($image_id, 'full');
				$image_src 	= $image_src[0];

				$this->add_render_attribute($item_id, 'class', 'wew-price-list-item');

				if($url) {
					$this->add_render_attribute($item_id, 'href', $url);

					if($item['link']['is_external']) {
						$this->add_render_attribute($item_id, 'target', '_blank');
					} ?>

					<li><a <?php echo $this->get_render_attribute_string($item_id); ?>>

				<?php
				} else { ?>
					<li <?php echo $this->get_render_attribute_string($item_id); ?>>
				<?php
				} ?>

					<div class="wew-price-list-text">
						<?php
						if(! empty($item['image']['url'])) { ?>
							<div class="wew-price-list-image">
								<?php echo sprintf('<img src="%s" alt="%s" />', $image_src, $item['title']); ?>
							</div>
						<?php
						} ?>

						<span class="wew-price-list-title"><?php echo esc_html($item['title']); ?></span>

						<?php
						if('yes' == $settings['separator']) { ?>
							<span class="wew-price-list-separator"></span>
						<?php
						}

						if('side' == $style) { ?>
							<div class="wew-price-list-price-wrap">
								<span class="wew-price-list-price"><?php echo esc_html($item['price']); ?></span>
							</div>
						<?php
						} ?>
					</div>

					<?php
					if($item['description']) { ?>
						<p class="wew-price-list-description"><?php echo wp_kses_post($item['description']); ?></p>
					<?php
					}

					if('inline' == $style) { ?>
						<div class="wew-price-list-price-wrap">
							<span class="wew-price-list-price"><?php echo esc_html($item['price']); ?></span>
						</div>
					<?php
					} ?>

				<?php
				if($item['link']['url']) { ?>
					</a></li>
				<?php
				} else { ?>
					</li>
				<?php
				} ?>

			<?php
			endforeach; ?>

		</ul>

	<?php
	}

	protected function _content_template() { ?>
		<ul class="wew-price-list wew-price-list-{{ settings.style }}">
			<# _.each(settings.price_list, function(item, index) {
				if(item.link.url) { #>
					<li><a class="wew-price-list-item" href="{{ item.link.url }}">
				<# } else { #>
					<li>
				<# } #>

					<div class="wew-price-list-text">
						<# if(item.image && item.image.id) {

							var image = {
								id: item.image.id,
								url: item.image.url,
								size: settings.image_size,
								dimension: settings.image_custom_dimension,
								model: editModel
							};

							var image_url = elementor.imagesManager.getImageUrl(image);

							if(image_url) { #>
								<div class="wew-price-list-image"><img src="{{ image_url }}" alt="{{ item.title }}"></div>
							<# } #>

						<# } #>

						<span class="wew-price-list-title">{{{ item.title }}}</span>

						<# if('yes' == settings.separator) { #>
							<span class="wew-price-list-separator"></span>
						<# } #>

						<# if('side' == settings.style) { #>
							<div class="wew-price-list-price-wrap">
								<span class="wew-price-list-price">{{{ item.price }}}</span>
							</div>
						<# } #>

					</div>

					<# if(item.description) { #>
						<p class="wew-price-list-description">{{{ item.description }}}</p>
					<# } #>

					<# if('inline' == settings.style) { #>
						<div class="wew-price-list-price-wrap">
							<span class="wew-price-list-price">{{{ item.price }}}</span>
						</div>
					<# } #>

				<# if(item.link.url) { #>
					</a></li>
				<# } else { #>
					</li>
				<# } #>

			<# }); #>
		</ul>
	<?php
	}

}