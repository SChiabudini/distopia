<?php
namespace wvnElementor\Modules\Divider\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

class Divider extends Widget_Base {

	public function get_name() {
		return 'wew-divider';
	}

	public function get_title() {
		return __('Divider', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-divider';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-divider' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_divider',
			[
				'label' 		=> __('General', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'divider_middle',
			[
				'label' 		=> __('Text or Icon', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'text',
				'options' 		=> [
					'text' 	=> __('Text', 'woovina-elementor-widgets'),
					'icon' 	=> __('Icon', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'text',
			[
				'label'			=> __('Text', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __('Text Divider', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'divider_middle' => 'text',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'text_html_tag',
			[
				'label' 		=> __('HTML Tag', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'h6',
				'options' 		=> [
					'h1' 	=> __('H1', 'woovina-elementor-widgets'),
					'h2' 	=> __('H2', 'woovina-elementor-widgets'),
					'h3' 	=> __('H3', 'woovina-elementor-widgets'),
					'h4' 	=> __('H4', 'woovina-elementor-widgets'),
					'h5' 	=> __('H5', 'woovina-elementor-widgets'),
					'h6' 	=> __('H6', 'woovina-elementor-widgets'),
					'div' 	=> __('div', 'woovina-elementor-widgets'),
					'span' 	=> __('span', 'woovina-elementor-widgets'),
					'p' 	=> __('p', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'divider_middle' => 'text',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __('Icon', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> 'fa fa-star',
				'condition' 	=> [
					'divider_middle' => 'icon',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' 		=> __('Alignment', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::CHOOSE,
				'default' 		=> 'center',
				'options' 		=> [
					'left'    	=> [
						'title' 	=> __('Left', 'woovina-elementor-widgets'),
						'icon' 		=> 'eicon-h-align-left',
					],
					'center' 	=> [
						'title' 	=> __('Center', 'woovina-elementor-widgets'),
						'icon' 		=> 'eicon-h-align-center',
					],
					'right' 	=> [
						'title' 	=> __('Right', 'woovina-elementor-widgets'),
						'icon' 		=> 'eicon-h-align-right',
					],
				],
				'prefix_class'	=> 'wew-divider-'
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Text / Icon', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'middle_typo',
				'selector' 		=> '{{WRAPPER}} .wew-divider-wrap .wew-divider-text, {{WRAPPER}} .wew-divider-wrap .wew-divider-middle i',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'spacing',
			[
				'label' 		=> __('Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 8,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-divider-wrap .wew-divider-middle' => 'margin: 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.wew-divider-left .wew-divider-middle' => 'margin-left: 0; margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.wew-divider-right .wew-divider-middle' => 'margin-right: 0; margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-divider-wrap .wew-divider-middle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default'		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-divider-wrap .wew-divider-middle' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default'		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-divider-wrap .wew-divider-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wew-divider-wrap .wew-divider-middle i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border',
				'label' 		=> __('Text Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-divider-wrap .wew-divider-middle',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-divider-wrap .wew-divider-middle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-divider-wrap .wew-divider-middle',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'text_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-divider-wrap .wew-divider-middle',
				'condition' 	=> [
					'divider_middle' => 'text',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_divider_style',
			[
				'label'			=> __('Divider', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default'		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-divider-wrap .wew-divider' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' 		=> __('Width', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'default' 		=> [
					'unit' => '%',
					'size' => 100,
				],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-divider-wrap .wew-divider' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' 		=> __('Height', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 1,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 1,
						'max' 	=> 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-divider-wrap .wew-divider' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$tag 		= $settings['text_html_tag'];

		$this->add_render_attribute('wrap', 'class', 'wew-divider-wrap');

		$this->add_render_attribute('before', 'class', [
			'wew-divider',
			'wew-divider-before',
		]);

		$this->add_render_attribute('after', 'class', [
			'wew-divider',
			'wew-divider-after',
		]);

		$this->add_render_attribute('middle', 'class', 'wew-divider-middle');
		$this->add_render_attribute('text', 'class', 'wew-divider-text');
		$this->add_inline_editing_attributes('text', 'basic'); ?>

		<div <?php echo $this->get_render_attribute_string('wrap'); ?>>
			<div <?php echo $this->get_render_attribute_string('before'); ?>></div>
			<div <?php echo $this->get_render_attribute_string('middle'); ?>>
				<?php
				if('text' == $settings['divider_middle']) { ?>
					<<?php echo $tag; ?> <?php echo $this->get_render_attribute_string('text'); ?>>
						<?php echo $this->parse_text_editor($settings['text']); ?>
					</<?php echo $tag; ?>>
				<?php
				} else { ?>
					<i class="<?php echo $settings['icon']; ?>"></i>
				<?php
				} ?>
			</div>
			<div <?php echo $this->get_render_attribute_string('after'); ?>></div>
		</div>

	<?php
	}

	protected function _content_template() { ?>
		<#
		if('text' == settings.divider_middle) {
			view.addRenderAttribute('text', 'class', [
				'wew-divider-text',
				'elementor-inline-editing'
			]);
			view.addRenderAttribute('text', 'data-elementor-inline-editing-toolbar', 'basic');
			view.addRenderAttribute('text', 'data-elementor-setting-key', 'text');
		} #>

		<div class="wew-divider-wrap">
			<div class="wew-divider wew-divider-before"></div>
			<div class="wew-divider-middle">
				<# if('text' == settings.divider_middle) { #>
					<{{ settings.text_html_tag }} {{{ view.getRenderAttributeString('text') }}}>
						{{{ settings.text }}}
					</{{ settings.text_html_tag }}>
				<# } else { #>
					<i class="{{{ settings.icon }}}"></i>
				<# } #>
			</div>
			<div class="wew-divider wew-divider-after"></div>
		</div>
	<?php
	}

}