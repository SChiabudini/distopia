<?php
namespace wvnElementor\Modules\SearchPro\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Search_Pro extends Widget_Base {

	public function get_name() {
		return 'wew-search-pro';
	}

	public function get_title() {
		return __( 'Search Pro', 'woovina-elementor-widgets' );
	}

	public function get_icon() {
		return 'wew-icon eicon-site-search';
	}

	public function get_keywords() {
		return [ 'search', 'form' ];
	}
	
	public function get_style_depends() {
		return [ 'wew-search-pro' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'search_content',
			[
				'label' => __( 'Search Form', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => __( 'Skin', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'classic',
				'options' => [
					'classic' => __( 'Classic', 'woovina-elementor-widgets' ),
					'minimal' => __( 'Minimal', 'woovina-elementor-widgets' ),
					'full_screen' => __( 'Full Screen', 'woovina-elementor-widgets' ),
				],
				'prefix_class' => 'woovina-search-pro--skin-',
				'render_type' => 'template',
				'frontend_available' => true,
			]
		);
		
		$this->add_control(
			'source',
			[
				'label' => __( 'Source', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'product',
				'options' => [
					'any' => __( 'All Post Types', 'woovina-elementor-widgets' ),
					'post' => __( 'Posts', 'woovina-elementor-widgets' ),
					'page' => __( 'Pages', 'woovina-elementor-widgets' ),
					'product' => __( 'Products', 'woovina-elementor-widgets' ),
				],
				'prefix_class' => 'woovina-search-pro--source-',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label' => __( 'Placeholder', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
				'default' => __( 'Search', 'woovina-elementor-widgets' ) . '...',
			]
		);

		$this->add_control(
			'heading_button_content',
			[
				'label' => __( 'Button', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->add_control(
			'button_type',
			[
				'label' => __( 'Type', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => __( 'Icon', 'woovina-elementor-widgets' ),
					'text' => __( 'Text', 'woovina-elementor-widgets' ),
				],
				'prefix_class' => 'woovina-search-pro--button-type-',
				'render_type' => 'template',
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Text', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Search', 'woovina-elementor-widgets' ),
				'separator' => 'after',
				'condition' => [
					'button_type' => 'text',
					'skin' => 'classic',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'search',
				'options' => [
					'search' => [
						'title' => __( 'Search', 'woovina-elementor-widgets' ),
						'icon' => 'fa fa-search',
					],
					'arrow' => [
						'title' => __( 'Arrow', 'woovina-elementor-widgets' ),
						'icon' => 'fa fa-arrow-right',
					],
				],
				'render_type' => 'template',
				'prefix_class' => 'woovina-search-pro--icon-',
				'condition' => [
					'button_type' => 'icon',
					'skin' => 'classic',
				],
			]
		);

		$this->add_control(
			'size',
			[
				'label' => __( 'Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__container' => 'min-height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .woovina-search-pro__submit' => 'min-width: {{SIZE}}{{UNIT}}',
					'body:not(.rtl) {{WRAPPER}} .woovina-search-pro__icon' => 'padding-left: calc({{SIZE}}{{UNIT}} / 3)',
					'body.rtl {{WRAPPER}} .woovina-search-pro__icon' => 'padding-right: calc({{SIZE}}{{UNIT}} / 3)',
					'{{WRAPPER}} .woovina-search-pro__input, {{WRAPPER}}.woovina-search-pro--button-type-text .woovina-search-pro__submit' => 'padding-left: calc({{SIZE}}{{UNIT}} / 3); padding-right: calc({{SIZE}}{{UNIT}} / 3)',
				],
				'condition' => [
					'skin!' => 'full_screen',
				],
			]
		);

		$this->add_control(
			'toggle_button_content',
			[
				'label' => __( 'Toggle', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'skin' => 'full_screen',
				],
			]
		);

		$this->add_control(
			'toggle_align',
			[
				'label' => __( 'Alignment', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro' => 'text-align: {{VALUE}}',
				],
				'condition' => [
					'skin' => 'full_screen',
				],
			]
		);

		$this->add_control(
			'toggle_size',
			[
				'label' => __( 'Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 33,
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__toggle i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'skin' => 'full_screen',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_input_style',
			[
				'label' => __( 'Input', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size_minimal',
			[
				'label' => __( 'Icon Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'skin' => 'minimal',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'overlay_background_color',
			[
				'label' => __( 'Overlay Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.woovina-search-pro--skin-full_screen .woovina-search-pro__container' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin' => 'full_screen',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'selector' => '{{WRAPPER}} input[type="search"].woovina-search-pro__input',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->start_controls_tabs( 'tabs_input_colors' );

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => __( 'Normal', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__input,
					{{WRAPPER}} .woovina-search-pro__icon,
					{{WRAPPER}} .elementor-lightbox .dialog-lightbox-close-button,
					{{WRAPPER}} .elementor-lightbox .dialog-lightbox-close-button:hover,
					{{WRAPPER}}.woovina-search-pro--skin-full_screen input[type="search"].woovina-search-pro__input' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:not(.woovina-search-pro--skin-full_screen) .woovina-search-pro__container' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}.woovina-search-pro--skin-full_screen input[type="search"].woovina-search-pro__input' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin!' => 'full_screen',
				],
			]
		);

		$this->add_control(
			'input_border_color',
			[
				'label' => __( 'Border Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:not(.woovina-search-pro--skin-full_screen) .woovina-search-pro__container' => 'border-color: {{VALUE}}',
					'{{WRAPPER}}.woovina-search-pro--skin-full_screen input[type="search"].woovina-search-pro__input' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_box_shadow',
				'selector' => '{{WRAPPER}} .woovina-search-pro__container',
				'fields_options' => [
					'box_shadow_type' => [
						'separator' => 'default',
					],
				],
				'condition' => [
					'skin!' => 'full_screen',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => __( 'Focus', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'input_text_color_focus',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:not(.woovina-search-pro--skin-full_screen) .woovina-search-pro--focus .woovina-search-pro__input,
					{{WRAPPER}} .woovina-search-pro--focus .woovina-search-pro__icon,
					{{WRAPPER}} .elementor-lightbox .dialog-lightbox-close-button:hover,
					{{WRAPPER}}.woovina-search-pro--skin-full_screen input[type="search"].woovina-search-pro__input:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_background_color_focus',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:not(.woovina-search-pro--skin-full_screen) .woovina-search-pro--focus .woovina-search-pro__container' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}.woovina-search-pro--skin-full_screen input[type="search"].woovina-search-pro__input:focus' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin!' => 'full_screen',
				],
			]
		);

		$this->add_control(
			'input_border_color_focus',
			[
				'label' => __( 'Border Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:not(.woovina-search-pro--skin-full_screen) .woovina-search-pro--focus .woovina-search-pro__container' => 'border-color: {{VALUE}}',
					'{{WRAPPER}}.woovina-search-pro--skin-full_screen input[type="search"].woovina-search-pro__input:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_box_shadow_focus',
				'selector' => '{{WRAPPER}} .woovina-search-pro--focus .woovina-search-pro__container',
				'fields_options' => [
					'box_shadow_type' => [
						'separator' => 'default',
					],
				],
				'condition' => [
					'skin!' => 'full_screen',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_border_width',
			[
				'label' => __( 'Border Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}}:not(.woovina-search-pro--skin-full_screen) .woovina-search-pro__container' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}.woovina-search-pro--skin-full_screen input[type="search"].woovina-search-pro__input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 3,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}:not(.woovina-search-pro--skin-full_screen) .woovina-search-pro__container' => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}}.woovina-search-pro--skin-full_screen input[type="search"].woovina-search-pro__input' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .woovina-search-pro__submit',
				'scheme' => Typography::TYPOGRAPHY_3,
				'condition' => [
					'button_type' => 'text',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_colors' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__submit' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__submit' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__submit:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_background_color_hover',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__submit:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__submit' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'button_type' => 'icon',
					'skin!' => 'full_screen',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label' => __( 'Width', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__submit' => 'min-width: calc( {{SIZE}} * {{size.SIZE}}{{size.UNIT}} )',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style',
			[
				'label' => __( 'Toggle', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin' => 'full_screen',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_color' );

		$this->start_controls_tab(
			'tab_toggle_normal',
			[
				'label' => __( 'Normal', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__toggle' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__toggle i' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_hover',
			[
				'label' => __( 'Hover', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'toggle_color_hover',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__toggle:hover' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_background_color_hover',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__toggle i:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'toggle_icon_size',
			[
				'label' => __( 'Icon Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__toggle i:before' => 'font-size: calc({{SIZE}}em / 100)',
				],
				'condition' => [
					'skin' => 'full_screen',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'toggle_border_width',
			[
				'label' => __( 'Border Width', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__toggle i' => 'border-width: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'toggle_border_radius',
			[
				'label' => __( 'Border Radius', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woovina-search-pro__toggle i' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$this->add_render_attribute(
			'input', [
				'placeholder' => $settings['placeholder'],
				'class' => 'woovina-search-pro__input',
				'type' => 'search',
				'name' => 's',
				'title' => __( 'Search', 'woovina-elementor-widgets' ),
				'value' => get_search_query(),
			]
		);

		// Set the selected icon.
		if ( 'icon' == $settings['button_type'] ) {
			$icon_class = 'search';

			if ( 'arrow' == $settings['icon'] ) {
				$icon_class = is_rtl() ? 'arrow-left' : 'arrow-right';
			}

			$this->add_render_attribute( 'icon', [
				'class' => 'fa fa-' . $icon_class,
			] );
		}

		?>
		<form class="woovina-search-pro" role="search" action="<?php echo home_url(); ?>" method="get">
			<?php if ( 'full_screen' === $settings['skin'] ) : ?>
			<div class="woovina-search-pro__toggle">
				<i class="fa fa-search" aria-hidden="true"></i>
				<span class="elementor-screen-only"><?php esc_html_e( 'Search', 'woovina-elementor-widgets' ); ?></span>
			</div>
			<?php endif; ?>
			<div class="woovina-search-pro__container">
				<?php if ( 'minimal' === $settings['skin'] ) : ?>
					<div class="woovina-search-pro__icon">
						<i class="fa fa-search" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php esc_html_e( 'Search', 'woovina-elementor-widgets' ); ?></span>
					</div>
				<?php endif; ?>
				<input <?php echo $this->get_render_attribute_string( 'input' ); ?>>
				<?php if ( 'classic' === $settings['skin'] ) : ?>
				<button class="woovina-search-pro__submit" type="submit">
					<?php if ( 'icon' === $settings['button_type'] ) : ?>
						<i <?php echo $this->get_render_attribute_string( 'icon' ); ?> aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php esc_html_e( 'Search', 'woovina-elementor-widgets' ); ?></span>
					<?php elseif ( ! empty( $settings['button_text'] ) ) : ?>
						<?php echo $settings['button_text']; ?>
					<?php endif; ?>
				</button>
				<?php endif; ?>
				<?php if ( 'full_screen' === $settings['skin'] ) : ?>
				<div class="dialog-lightbox-close-button dialog-close-button">
					<i class="eicon-close" aria-hidden="true"></i>
					<span class="elementor-screen-only"><?php esc_html_e( 'Close', 'woovina-elementor-widgets' ); ?></span>
				</div>
				<?php endif ?>
			</div>
			
			<?php if(! empty($settings['source']) && 'any' != $settings['source']) { ?>
				<input type="hidden" name="post_type" value="<?php echo esc_attr($settings['source']); ?>">
			<?php } ?>
		</form>
		<?php
	}

	protected function _content_template() {
		
	}
}
