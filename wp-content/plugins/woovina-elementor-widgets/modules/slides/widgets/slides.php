<?php
namespace wvnElementor\Modules\Slides\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use wvnElementor\Base\Base_Widget;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Slides extends Base_Widget {

	public function get_name() {
		return 'wew-slides';
	}

	public function get_title() {
		return __( 'Slides', 'woovina-elementor-widgets' );
	}

	public function get_icon() {
		return 'wew-icon eicon-slideshow';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_keywords() {
		return [ 'slides', 'carousel', 'image', 'title', 'slider' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded', 'slick' ];
	}
	
	public function get_style_depends() {
		return [ 'wew-slides' ];
	}
	
	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'woovina-elementor-widgets' ),
			'sm' => __( 'Small', 'woovina-elementor-widgets' ),
			'md' => __( 'Medium', 'woovina-elementor-widgets' ),
			'lg' => __( 'Large', 'woovina-elementor-widgets' ),
			'xl' => __( 'Extra Large', 'woovina-elementor-widgets' ),
		];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_slides',
			[
				'label' => __( 'Slides', 'woovina-elementor-widgets' ),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'slides_repeater' );

		$repeater->start_controls_tab( 'background', [ 'label' => __( 'Background', 'woovina-elementor-widgets' ) ] );

		$repeater->add_control(
			'background_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'background_image',
			[
				'label' => _x( 'Image', 'Background Control', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-image: url({{URL}})',
				],
			]
		);

		$repeater->add_control(
			'background_size',
			[
				'label' => _x( 'Size', 'Background Control', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => _x( 'Cover', 'Background Control', 'woovina-elementor-widgets' ),
					'contain' => _x( 'Contain', 'Background Control', 'woovina-elementor-widgets' ),
					'auto' => _x( 'Auto', 'Background Control', 'woovina-elementor-widgets' ),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-size: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_ken_burns',
			[
				'label' => __( 'Ken Burns Effect', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'zoom_direction',
			[
				'label' => __( 'Zoom Direction', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'in',
				'options' => [
					'in' => __( 'In', 'woovina-elementor-widgets' ),
					'out' => __( 'Out', 'woovina-elementor-widgets' ),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_ken_burns',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_overlay',
			[
				'label' => __( 'Background Overlay', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_overlay_color',
			[
				'label' => __( 'Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .woovina-background-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'background_overlay_blend_mode',
			[
				'label' => __( 'Blend Mode', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'woovina-elementor-widgets' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn' => 'Color Burn',
					'hue' => 'Hue',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'exclusion' => 'Exclusion',
					'luminosity' => 'Luminosity',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .woovina-background-overlay' => 'mix-blend-mode: {{VALUE}}',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'content', [ 'label' => __( 'Content', 'woovina-elementor-widgets' ) ] );

		$repeater->add_control(
			'heading',
			[
				'label' => __( 'Title & Description', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Slide Heading', 'woovina-elementor-widgets' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'woovina-elementor-widgets' ),
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'woovina-elementor-widgets' ),
			]
		);

		$repeater->add_control(
			'link_click',
			[
				'label' => __( 'Apply Link On', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'slide' => __( 'Whole Slide', 'woovina-elementor-widgets' ),
					'button' => __( 'Button Only', 'woovina-elementor-widgets' ),
				],
				'default' => 'slide',
				'conditions' => [
					'terms' => [
						[
							'name' => 'link[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'style', [ 'label' => __( 'Style', 'woovina-elementor-widgets' ) ] );

		$repeater->add_control(
			'custom_style',
			[
				'label' => __( 'Custom', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => __( 'Set custom style that will only affect this specific slide.', 'woovina-elementor-widgets' ),
			]
		);

		$repeater->add_control(
			'horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .woovina-slide-content' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right' => 'margin-left: auto',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'vertical_position',
			[
				'label' => __( 'Vertical Position', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'align-items: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'text_align',
			[
				'label' => __( 'Text Align', 'woovina-elementor-widgets' ),
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
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'text-align: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'content_color',
			[
				'label' => __( 'Content Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .woovina-slide-heading' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .woovina-slide-description' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .woovina-slide-button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label' => __( 'Slides', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'heading' => __( 'Slide 1 Heading', 'woovina-elementor-widgets' ),
						'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'woovina-elementor-widgets' ),
						'button_text' => __( 'Click Here', 'woovina-elementor-widgets' ),
						'background_color' => '#833ca3',
					],
					[
						'heading' => __( 'Slide 2 Heading', 'woovina-elementor-widgets' ),
						'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'woovina-elementor-widgets' ),
						'button_text' => __( 'Click Here', 'woovina-elementor-widgets' ),
						'background_color' => '#4054b2',
					],
					[
						'heading' => __( 'Slide 3 Heading', 'woovina-elementor-widgets' ),
						'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'woovina-elementor-widgets' ),
						'button_text' => __( 'Click Here', 'woovina-elementor-widgets' ),
						'background_color' => '#1abc9c',
					],
				],
				'title_field' => '{{{ heading }}}',
			]
		);

		$this->add_responsive_control(
			'slides_height',
			[
				'label' => __( 'Height', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 400,
				],
				'size_units' => [ 'px', 'vh', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .slick-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __( 'Slider Options', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __( 'Arrows and Dots', 'woovina-elementor-widgets' ),
					'arrows' => __( 'Arrows', 'woovina-elementor-widgets' ),
					'dots' => __( 'Dots', 'woovina-elementor-widgets' ),
					'none' => __( 'None', 'woovina-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause on Hover', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __( 'Infinite Loop', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'transition',
			[
				'label' => __( 'Transition', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'woovina-elementor-widgets' ),
					'fade' => __( 'Fade', 'woovina-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'transition_speed',
			[
				'label' => __( 'Transition Speed', 'woovina-elementor-widgets' ) . ' (ms)',
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'content_animation',
			[
				'label' => __( 'Content Animation', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => [
					'' => __( 'None', 'woovina-elementor-widgets' ),
					'fadeInDown' => __( 'Down', 'woovina-elementor-widgets' ),
					'fadeInUp' => __( 'Up', 'woovina-elementor-widgets' ),
					'fadeInRight' => __( 'Right', 'woovina-elementor-widgets' ),
					'fadeInLeft' => __( 'Left', 'woovina-elementor-widgets' ),
					'zoomIn' => __( 'Zoom', 'woovina-elementor-widgets' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slides',
			[
				'label' => __( 'Slides', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => __( 'Content Width', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'default' => [
					'size' => '66',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_padding',
			[
				'label' => __( 'Padding', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'slides_horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'woovina-elementor-widgets' ),
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
				'prefix_class' => 'elementor--h-position-',
			]
		);

		$this->add_control(
			'slides_vertical_position',
			[
				'label' => __( 'Vertical Position', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'middle',
				'options' => [
					'top' => [
						'title' => __( 'Top', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'elementor--v-position-',
			]
		);

		$this->add_control(
			'slides_text_align',
			[
				'label' => __( 'Text Align', 'woovina-elementor-widgets' ),
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .slick-slide-inner' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_spacing',
			[
				'label' => __( 'Spacing', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-inner .woovina-slide-heading:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-heading' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .woovina-slide-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_description',
			[
				'label' => __( 'Description', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_spacing',
			[
				'label' => __( 'Spacing', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-inner .woovina-slide-description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-description' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'scheme' => Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .woovina-slide-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Button', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __( 'Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
			]
		);

		$this->add_control( 'button_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-button' => 'color: {{VALUE}}; border-color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .woovina-slide-button',
				'scheme' => Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_control(
			'button_border_width',
			[
				'label' => __( 'Border Width', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .woovina-slide-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => __( 'Normal', 'woovina-elementor-widgets' ) ] );

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Border Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover', [ 'label' => __( 'Hover', 'woovina-elementor-widgets' ) ] );

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-slide-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => __( 'Navigation', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label' => __( 'Arrows', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label' => __( 'Arrows Position', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __( 'Inside', 'woovina-elementor-widgets' ),
					'outside' => __( 'Outside', 'woovina-elementor-widgets' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => __( 'Arrows Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wew-slides-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .wew-slides-wrapper .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' => __( 'Arrows Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wew-slides-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .wew-slides-wrapper .slick-slider .slick-next:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label' => __( 'Dots', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label' => __( 'Dots Position', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'outside' => __( 'Outside', 'woovina-elementor-widgets' ),
					'inside' => __( 'Inside', 'woovina-elementor-widgets' ),
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __( 'Dots Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 15,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wew-slides-wrapper .wew-slides .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label' => __( 'Dots Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wew-slides-wrapper .wew-slides .slick-dots li button:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['slides'] ) ) {
			return;
		}

		$this->add_render_attribute( 'button', 'class', [ 'elementor-button', 'woovina-slide-button' ] );

		if ( ! empty( $settings['button_size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['button_size'] );
		}

		$slides = [];
		$slide_count = 0;

		foreach ( $settings['slides'] as $slide ) {
			$slide_html = '';
			$btn_attributes = '';
			$slide_attributes = '';
			$slide_element = 'div';
			$btn_element = 'div';
			$slide_url = $slide['link']['url'];

			if ( ! empty( $slide_url ) ) {
				$this->add_render_attribute( 'slide_link' . $slide_count, 'href', $slide_url );

				if ( $slide['link']['is_external'] ) {
					$this->add_render_attribute( 'slide_link' . $slide_count, 'target', '_blank' );
				}

				if ( 'button' === $slide['link_click'] ) {
					$btn_element = 'a';
					$btn_attributes = $this->get_render_attribute_string( 'slide_link' . $slide_count );
				} else {
					$slide_element = 'a';
					$slide_attributes = $this->get_render_attribute_string( 'slide_link' . $slide_count );
				}
			}

			if ( 'yes' === $slide['background_overlay'] ) {
				$slide_html .= '<div class="woovina-background-overlay"></div>';
			}

			$slide_html .= '<div class="woovina-slide-content">';

			if ( $slide['heading'] ) {
				$slide_html .= '<div class="woovina-slide-heading">' . $slide['heading'] . '</div>';
			}

			if ( $slide['description'] ) {
				$slide_html .= '<div class="woovina-slide-description">' . $slide['description'] . '</div>';
			}

			if ( $slide['button_text'] ) {
				$slide_html .= '<' . $btn_element . ' ' . $btn_attributes . ' ' . $this->get_render_attribute_string( 'button' ) . '>' . $slide['button_text'] . '</' . $btn_element . '>';
			}

			$ken_class = '';

			if ( '' != $slide['background_ken_burns'] ) {
				$ken_class = ' elementor-ken-' . $slide['zoom_direction'];
			}

			$slide_html .= '</div>';
			$slide_html = '<div class="slick-slide-bg' . $ken_class . '"></div><' . $slide_element . ' ' . $slide_attributes . ' class="slick-slide-inner">' . $slide_html . '</' . $slide_element . '>';
			$slides[] = '<div class="elementor-repeater-item-' . $slide['_id'] . ' slick-slide">' . $slide_html . '</div>';
			$slide_count++;
		}

		$is_rtl = is_rtl();
		$direction = $is_rtl ? 'rtl' : 'ltr';
		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		$slick_options = [
			'slidesToShow' => absint( 1 ),
			'autoplaySpeed' => absint( $settings['autoplay_speed'] ),
			'autoplay' => ( 'yes' === $settings['autoplay'] ),
			'infinite' => ( 'yes' === $settings['infinite'] ),
			'pauseOnHover' => ( 'yes' === $settings['pause_on_hover'] ),
			'speed' => absint( $settings['transition_speed'] ),
			'arrows' => $show_arrows,
			'dots' => $show_dots,
			'rtl' => $is_rtl,
		];

		if ( 'fade' === $settings['transition'] ) {
			$slick_options['fade'] = true;
		}

		$carousel_classes = [ 'wew-slides' ];

		if ( $show_arrows ) {
			$carousel_classes[] = 'slick-arrows-' . $settings['arrows_position'];
		}

		if ( $show_dots ) {
			$carousel_classes[] = 'slick-dots-' . $settings['dots_position'];
		}

		$this->add_render_attribute( 'slides', [
			'class' => $carousel_classes,
			'data-slider_options' => wp_json_encode( $slick_options ),
			'data-animation' => $settings['content_animation'],
		] );

		?>
		<div class="wew-slides-wrapper woovina-slick-slider" dir="<?php echo esc_attr( $direction ); ?>">
			<div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
				<?php echo implode( '', $slides ); ?>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<#
			var isRtl           = <?php echo is_rtl() ? 'true' : 'false'; ?>,
				direction       = isRtl ? 'rtl' : 'ltr',
				navi            = settings.navigation,
				showDots        = ( 'dots' === navi || 'both' === navi ),
				showArrows      = ( 'arrows' === navi || 'both' === navi ),
				autoplay        = ( 'yes' === settings.autoplay ),
				infinite        = ( 'yes' === settings.infinite ),
				speed           = Math.abs( settings.transition_speed ),
				autoplaySpeed   = Math.abs( settings.autoplay_speed ),
				fade            = ( 'fade' === settings.transition ),
				buttonSize      = settings.button_size,
				sliderOptions = {
					"initialSlide": Math.max( 0, editSettings.activeItemIndex-1 ),
					"slidesToShow": 1,
					"autoplaySpeed": autoplaySpeed,
					"autoplay": false,
					"infinite": infinite,
					"pauseOnHover":true,
					"pauseOnFocus":true,
					"speed": speed,
					"arrows": showArrows,
					"dots": showDots,
					"rtl": isRtl,
					"fade": fade
				}
				sliderOptionsStr = JSON.stringify( sliderOptions );
			if ( showArrows ) {
				var arrowsClass = 'slick-arrows-' + settings.arrows_position;
			}

			if ( showDots ) {
				var dotsClass = 'slick-dots-' + settings.dots_position;
			}

		#>
		<div class="wew-slides-wrapper woovina-slick-slider" dir="{{ direction }}">
			<div data-slider_options="{{ sliderOptionsStr }}" class="wew-slides {{ dotsClass }} {{ arrowsClass }}" data-animation="{{ settings.content_animation }}">
				<# _.each( settings.slides, function( slide ) { #>
					<div class="elementor-repeater-item-{{ slide._id }} slick-slide">
						<#
						var kenClass = '';

						if ( '' != slide.background_ken_burns ) {
							kenClass = ' elementor-ken-' + slide.zoom_direction;
						}
						#>
						<div class="slick-slide-bg{{ kenClass }}"></div>
						<div class="slick-slide-inner">
								<# if ( 'yes' === slide.background_overlay ) { #>
							<div class="woovina-background-overlay"></div>
								<# } #>
							<div class="woovina-slide-content">
								<# if ( slide.heading ) { #>
									<div class="woovina-slide-heading">{{{ slide.heading }}}</div>
								<# }
								if ( slide.description ) { #>
									<div class="woovina-slide-description">{{{ slide.description }}}</div>
								<# }
								if ( slide.button_text ) { #>
									<div class="elementor-button woovina-slide-button elementor-size-{{ buttonSize }}">{{{ slide.button_text }}}</div>
								<# } #>
							</div>
						</div>
					</div>
				<# } ); #>
			</div>
		</div>
		<?php
	}
}
