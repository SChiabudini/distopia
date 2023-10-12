<?php
namespace wvnElementor\Modules\ButtonEffects\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class ButtonEffects extends Widget_Base {

	public function get_name() {
		return 'wew-button-effects';
	}

	public function get_title() {
		return __('Button Effects', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-button';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {		
		$styles = array();
		if(! \Elementor\Plugin::$instance->editor->is_edit_mode() && ! \Elementor\Plugin::$instance->preview->is_preview_mode()) {
            $settings = $this->get_settings();
            $styles[] = 'wew-'. $settings['effect'];
        }
        return [ 'wew-button-effects', $styles ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_button_effects',
			[
				'label' 		=> __('Button Effects', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'text',
			[
				'label' 		=> __('Text', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __('Click me', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Click me', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label' 		=> __('Link', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __('https://your-link.com', 'woovina-elementor-widgets'),
				'default' 		=> [
					'url' => '#',
				],
			]
		);

        $this->add_control(
            'effect',
            [
                'label' 		=> __('Effect', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
                   'btn-effect-1'  => __('Radius Effect', 'woovina-elementor-widgets'),
                   'btn-effect-2'  => __('Text Reveal Bottom', 'woovina-elementor-widgets'),
                   'btn-effect-3'  => __('Text Reveal Left', 'woovina-elementor-widgets'),
                   'btn-effect-4'  => __('Text Reveal Corner', 'woovina-elementor-widgets'),
                   'btn-effect-5'  => __('Jello', 'woovina-elementor-widgets'),
                   'btn-effect-6'  => __('Vertical Background Slide', 'woovina-elementor-widgets'),
                   'btn-effect-7'  => __('Horizontal Background Slide', 'woovina-elementor-widgets'),
                   'btn-effect-8'  => __('Left Background Slide', 'woovina-elementor-widgets'),
                   'btn-effect-9'  => __('Rectangle Effect', 'woovina-elementor-widgets'),
                   'btn-effect-10' => __('Cross Effect', 'woovina-elementor-widgets'),
                   'btn-effect-11' => __('Panel Background', 'woovina-elementor-widgets'),
                   'btn-effect-12' => __('Pyramid Background', 'woovina-elementor-widgets'),
                   'btn-effect-13' => __('Scale In Background', 'woovina-elementor-widgets'),
                   'btn-effect-14' => __('Scale Out Background', 'woovina-elementor-widgets'),
                   'btn-effect-15' => __('Slide Up Background', 'woovina-elementor-widgets'),
                   'btn-effect-16' => __('Slide Left Background', 'woovina-elementor-widgets'),
                   'btn-effect-17' => __('Slide Top/Left Corner Background', 'woovina-elementor-widgets'),
                   'btn-effect-18' => __('Slide Bottom/Right Corner Background', 'woovina-elementor-widgets'),
                   'btn-effect-19' => __('Slide Top/Bottom Corner Background', 'woovina-elementor-widgets'),
                   'btn-effect-20' => __('Slide Top Left/Right Corner Background', 'woovina-elementor-widgets'),
                   'btn-effect-21' => __('Lighting Up Background', 'woovina-elementor-widgets'),
                   'btn-effect-22' => __('Lighting Left Background', 'woovina-elementor-widgets'),
                   'btn-effect-23' => __('Lighting Corner Background', 'woovina-elementor-widgets'),
                   'btn-effect-24' => __('Double Lighting Up Background', 'woovina-elementor-widgets'),
                   'btn-effect-25' => __('Double Lighting Left Background', 'woovina-elementor-widgets'),
                   'btn-effect-26' => __('Double Lighting Corner Background', 'woovina-elementor-widgets'),
                   'btn-effect-27' => __('Border Bottom Effect', 'woovina-elementor-widgets'),
                   'btn-effect-28' => __('Border Top/Bottom Effect', 'woovina-elementor-widgets'),
                   'btn-effect-29' => __('Borders Cross Effect', 'woovina-elementor-widgets'),
                   'btn-effect-30' => __('Borders Center Effect', 'woovina-elementor-widgets'),
                ],
                'default' 		=> 'btn-effect-1',
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
				'default' 		=> '',
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
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Button', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-button a',
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
			'background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
					'type' => Color::get_type(),
					'value' => Color::COLOR_4,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-button a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-10 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-10 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-11 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-11 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-13 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-14 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-28 a::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-btn-effect-29 a' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-29 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-29 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-30 a' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-30 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-30 a::after' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'effect' => [ 'btn-effect-29', 'btn-effect-30' ],
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-6 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-7 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-8 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-10 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-10 a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-11 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-11 a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-13 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-14 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-28 a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [
					'effect!' => [ 'btn-effect-29', 'btn-effect-30' ],
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
			'button_background_hover_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-btn-effect-1 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-2 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-3 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-4 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-5 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-6 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-7 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-8 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-9 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-10 a:hover::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-10 a:hover::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-11 a:hover::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-11 a:hover::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-12 a::before' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-12 a::after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-13 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-14 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-15 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-15 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-16 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-16 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-17 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-17 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-18 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-18 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-19 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-19 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-20 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-20 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-21 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-22 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-23 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-24 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-24 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-25 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-25 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-26 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-26 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-27 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-28 a::before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-button a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-button a:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-10 a:hover::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-10 a:hover::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-11 a:hover::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-11 a:hover::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-13 a:hover::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-14 a:hover::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-27 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-28 a::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-29 a:hover::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-29 a:hover::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-30 a:hover::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-btn-effect-30 a:hover::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-button a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-6 a:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-7 a:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-8 a:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-10 a:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-10 a:hover::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-11 a:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-11 a:hover::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-13 a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-14 a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-27 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-28 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [
					'effect!' => [ 'btn-effect-29', 'btn-effect-30' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .wew-button a, {{WRAPPER}} .wew-btn-effect-10 a::before, {{WRAPPER}} .wew-btn-effect-10 a::after, {{WRAPPER}} .wew-btn-effect-11 a::before, {{WRAPPER}} .wew-btn-effect-11 a::after, {{WRAPPER}} .wew-btn-effect-13 a::before, {{WRAPPER}} .wew-btn-effect-13 a::after, {{WRAPPER}} .wew-btn-effect-14 a::before, {{WRAPPER}} .wew-btn-effect-14 a::after',
				'condition' 	=> [
					'effect!' => [ 'btn-effect-28', 'btn-effect-29', 'btn-effect-30' ],
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'hover_border_size',
			[
				'label' 		=> __('Hover Border Size', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 1,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-btn-effect-27 a::before' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-28 a::before' => 'border-top-width: {{SIZE}}{{UNIT}}; border-bottom-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-29 a' => 'border-right-width: {{SIZE}}{{UNIT}}; border-left-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-29 a::before' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-29 a::after' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-30 a' => 'border-top-width: {{SIZE}}{{UNIT}}; border-bottom-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-30 a::before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-btn-effect-30 a::after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'effect' => [ 'btn-effect-27', 'btn-effect-28', 'btn-effect-29', 'btn-effect-30' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-button a',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->end_controls_section();

		$this->end_controls_section();

	}

	protected function render() {
		$settings 		= $this->get_settings_for_display();
		$text 			= $settings['text'];
        $link 			= $settings['link'];
        $effect 		= $settings['effect'];

		$this->add_render_attribute('button-wrap', 'class', 'wew-button');
        
		if(! empty($effect)) {
            $this->add_render_attribute('button-wrap', 'class', 'wew-'. $effect);
        }

		if(! empty($link['url'])) {
			$this->add_render_attribute('link', 'href', $link['url']);

			if($link['is_external']) {
				$this->add_render_attribute('link', 'target', '_blank');
			}

			if($link['nofollow']) {
				$this->add_render_attribute('link', 'rel', 'nofollow');
			}
		}
        
		$this->add_render_attribute('icon-align', 'class', [
			'wew-button-icon',
			'elementor-align-icon-' . $settings['icon_align'],
		]);

		$this->add_render_attribute('link', 'class', 'wew-link');
        
        if('btn-effect-2' == $effect
        	|| 'btn-effect-3' == $effect
        	|| 'btn-effect-4' == $effect) {
            $this->add_render_attribute('link', 'data-text', $text);
        } ?>

		
		<div <?php echo $this->get_render_attribute_string('button-wrap'); ?>>
			<a <?php echo $this->get_render_attribute_string('link'); ?>>
				<?php
				if(! empty($settings['icon']) && 'left' == $settings['icon_align']) { ?>
					<span <?php echo $this->get_render_attribute_string('icon-align'); ?>>
						<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
					</span>
				<?php
				} ?>

				<span><?php echo esc_attr($text); ?></span>

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
	}

}