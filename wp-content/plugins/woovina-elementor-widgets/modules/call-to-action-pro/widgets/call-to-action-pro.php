<?php
namespace wvnElementor\Modules\CallToActionPro\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use wvnElementor\Base\Base_Widget;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Call_To_Action_Pro extends Base_Widget {

	public function get_name() {
		return 'wew-call-to-action-pro';
	}

	public function get_title() {
		return __( 'Call to Action Pro', 'woovina-elementor-widgets' );
	}

	public function get_icon() {
		return 'wew-icon eicon-image-rollover';
	}
	
	public function get_style_depends() {
		return [ 'wew-call-to-action-pro' ];
	}
	
	public function get_keywords() {
		return [ 'call to action', 'cta', 'button' ];
	}
	
	public function get_categories() {
		return [ 'woovina-elements' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'section_main_image',
			[
				'label' => __( 'Image', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => __( 'Skin', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'classic' => __( 'Classic', 'woovina-elementor-widgets' ),
					'cover' => __( 'Cover', 'woovina-elementor-widgets' ),
				],
				'render_type' => 'template',
				'prefix_class' => 'woovina-cta--skin-',
				'default' => 'classic',
			]
		);

		$this->add_responsive_control(
			'layout',
			[
				'label' => __( 'Position', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-h-align-left',
					],
					'above' => [
						'title' => __( 'Above', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'woovina-cta-%s-layout-image-',
				'condition' => [
					'skin!' => 'cover',
				],
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label' => __( 'Choose Image', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'bg_image', // Actually its `image_size`
				'label' => __( 'Image Resolution', 'woovina-elementor-widgets' ),
				'default' => 'large',
				'condition' => [
					'bg_image[id]!' => '',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'graphic_element',
			[
				'label' => __( 'Graphic Element', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'none' => [
						'title' => __( 'None', 'woovina-elementor-widgets' ),
						'icon' => 'fa fa-ban',
					],
					'image' => [
						'title' => __( 'Image', 'woovina-elementor-widgets' ),
						'icon' => 'fa fa-picture-o',
					],
					'icon' => [
						'title' => __( 'Icon', 'woovina-elementor-widgets' ),
						'icon' => 'fa fa-star',
					],
				],
				'separator' => 'before',
				'default' => 'none',
			]
		);

		$this->add_control(
			'graphic_image',
			[
				'label' => __( 'Choose Image', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'graphic_element' => 'image',
				],
				'show_label' => false,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'graphic_image', // Actually its `image_size`
				'default' => 'thumbnail',
				'condition' => [
					'graphic_element' => 'image',
					'graphic_image[id]!' => '',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-star',
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label' => __( 'View', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'woovina-elementor-widgets' ),
					'stacked' => __( 'Stacked', 'woovina-elementor-widgets' ),
					'framed' => __( 'Framed', 'woovina-elementor-widgets' ),
				],
				'default' => 'default',
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_shape',
			[
				'label' => __( 'Shape', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'woovina-elementor-widgets' ),
					'square' => __( 'Square', 'woovina-elementor-widgets' ),
				],
				'default' => 'circle',
				'condition' => [
					'icon_view!' => 'default',
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title & Description', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the heading', 'woovina-elementor-widgets' ),
				'placeholder' => __( 'Enter your title', 'woovina-elementor-widgets' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'woovina-elementor-widgets' ),
				'placeholder' => __( 'Enter your description', 'woovina-elementor-widgets' ),
				'separator' => 'none',
				'rows' => 5,
				'show_label' => false,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
				],
				'default' => 'h2',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'button',
			[
				'label' => __( 'Button Text', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click Here', 'woovina-elementor-widgets' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'woovina-elementor-widgets' ),

			]
		);

		$this->add_control(
			'link_click',
			[
				'label' => __( 'Apply Link On', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'box' => __( 'Whole Box', 'woovina-elementor-widgets' ),
					'button' => __( 'Button Only', 'woovina-elementor-widgets' ),
				],
				'default' => 'button',
				'separator' => 'none',
				'condition' => [
					'link[url]!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon',
			[
				'label' => __( 'Ribbon', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'ribbon_title',
			[
				'label' => __( 'Title', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'ribbon_horizontal_position',
			[
				'label' => __( 'Position', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'woovina-elementor-widgets' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'ribbon_title!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'min-height',
			[
				'label' => __( 'Min. Height', 'woovina-elementor-widgets' ),
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
				'size_units' => [ 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__content' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__content' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
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
				'prefix_class' => 'woovina-cta--valign-',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => __( 'Padding', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_bg_image_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Image', 'woovina-elementor-widgets' ),
				'condition' => [
					'bg_image[url]!' => '',
					'skin' => 'classic',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_min_width',
			[
				'label' => __( 'Min. Width', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__bg-wrapper' => 'min-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->add_responsive_control(
			'image_min_height',
			[
				'label' => __( 'Min. Height', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vh' ],

				'selectors' => [
					'{{WRAPPER}} .woovina-cta__bg-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'graphic_element_style',
			[
				'label' => __( 'Graphic Element', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'graphic_element!' => 'none',
				],
			]
		);

		$this->add_control(
			'graphic_image_spacing',
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
					'{{WRAPPER}} .woovina-cta__image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'graphic_image_width',
			[
				'label' => __( 'Size', 'woovina-elementor-widgets' ) . ' (%)',
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__image img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'graphic_image_border',
				'selector' => '{{WRAPPER}} .woovina-cta__image img',
				'condition' => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'graphic_image_border_radius',
			[
				'label' => __( 'Border Radius', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'icon_spacing',
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
					'{{WRAPPER}} .elementor-icon-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label' => __( 'Primary Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label' => __( 'Secondary Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'Icon Padding', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'condition' => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'icon_border_width',
			[
				'label' => __( 'Border Width', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'graphic_element' => 'icon',
					'icon_view' => 'framed',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'title',
							'operator' => '!==',
							'value' => '',
						],
						[
							'name' => 'description',
							'operator' => '!==',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'heading_style_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Title', 'woovina-elementor-widgets' ),
				'separator' => 'before',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .woovina-cta__title',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Spacing', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__title:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_style_description',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Description', 'woovina-elementor-widgets' ),
				'separator' => 'before',
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'scheme' => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .woovina-cta__description',
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label' => __( 'Spacing', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_control(
			'heading_content_colors',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Colors', 'woovina-elementor-widgets' ),
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'color_tabs' );

		$this->start_controls_tab( 'colors_normal',
			[
				'label' => __( 'Normal', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__content' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__description' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Button Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'button!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'colors_hover',
			[
				'label' => __( 'Hover', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'content_bg_color_hover',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta:hover .woovina-cta__content' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta:hover .woovina-cta__title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'description_color_hover',
			[
				'label' => __( 'Description Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta:hover .woovina-cta__description' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label' => __( 'Button Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta:hover .woovina-cta__button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'button!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			[
				'label' => __( 'Button', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button!' => '',
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __( 'Size', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
					'xs' => __( 'Extra Small', 'woovina-elementor-widgets' ),
					'sm' => __( 'Small', 'woovina-elementor-widgets' ),
					'md' => __( 'Medium', 'woovina-elementor-widgets' ),
					'lg' => __( 'Large', 'woovina-elementor-widgets' ),
					'xl' => __( 'Extra Large', 'woovina-elementor-widgets' ),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Typography', 'woovina-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .woovina-cta__button',
				'scheme' => Typography::TYPOGRAPHY_4,
			]
		);

		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab( 'button_normal',
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
					'{{WRAPPER}} .woovina-cta__button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Border Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button-hover',
			[
				'label' => __( 'Hover', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
					'{{WRAPPER}} .woovina-cta__button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .woovina-cta__button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon_style',
			[
				'label' => __( 'Ribbon', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'ribbon_title!' => '',
				],
			]
		);

		$this->add_control(
			'ribbon_bg_color',
			[
				'label' => __( 'Background Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-ribbon-inner' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ribbon_text_color',
			[
				'label' => __( 'Text Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-ribbon-inner' => 'color: {{VALUE}}',
				],
			]
		);

		$ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

		$this->add_responsive_control(
			'ribbon_distance',
			[
				'label' => __( 'Distance', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-ribbon-inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .woovina-ribbon-inner',
				'scheme' => Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .woovina-ribbon-inner',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hover_effects',
			[
				'label' => __( 'Hover Effects', 'woovina-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_hover_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Content', 'woovina-elementor-widgets' ),
				'separator' => 'before',
				'condition' => [
					'skin' => 'cover',
				],
			]
		);

		$this->add_control(
			'content_animation',
			[
				'label' => __( 'Hover Animation', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'groups' => [
					[
						'label' => __( 'None', 'woovina-elementor-widgets' ),
						'options' => [
							'' => __( 'None', 'woovina-elementor-widgets' ),
						],
					],
					[
						'label' => __( 'Entrance', 'woovina-elementor-widgets' ),
						'options' => [
							'enter-from-right' => 'Slide In Right',
							'enter-from-left' => 'Slide In Left',
							'enter-from-top' => 'Slide In Up',
							'enter-from-bottom' => 'Slide In Down',
							'enter-zoom-in' => 'Zoom In',
							'enter-zoom-out' => 'Zoom Out',
							'fade-in' => 'Fade In',
						],
					],
					[
						'label' => __( 'Reaction', 'woovina-elementor-widgets' ),
						'options' => [
							'grow' => 'Grow',
							'shrink' => 'Shrink',
							'move-right' => 'Move Right',
							'move-left' => 'Move Left',
							'move-up' => 'Move Up',
							'move-down' => 'Move Down',
						],
					],
					[
						'label' => __( 'Exit', 'woovina-elementor-widgets' ),
						'options' => [
							'exit-to-right' => 'Slide Out Right',
							'exit-to-left' => 'Slide Out Left',
							'exit-to-top' => 'Slide Out Up',
							'exit-to-bottom' => 'Slide Out Down',
							'exit-zoom-in' => 'Zoom In',
							'exit-zoom-out' => 'Zoom Out',
							'fade-out' => 'Fade Out',
						],
					],
				],
				'default' => 'grow',
				'condition' => [
					'skin' => 'cover',
				],
			]
		);

		/*
		 *
		 * Add class 'elementor-animated-content' to widget when assigned content animation
		 *
		 */
		$this->add_control(
			'animation_class',
			[
				'label' => 'Animation',
				'type' => Controls_Manager::HIDDEN,
				'default' => 'animated-content',
				'prefix_class' => 'elementor-',
				'condition' => [
					'content_animation!' => '',
				],
			]
		);

		$this->add_control(
			'content_animation_duration',
			[
				'label' => __( 'Animation Duration', 'woovina-elementor-widgets' ) . ' (ms)',
				'type' => Controls_Manager::SLIDER,
				'render_type' => 'template',
				'default' => [
					'size' => 1000,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__content-item' => 'transition-duration: {{SIZE}}ms',
					'{{WRAPPER}}.woovina-cta--sequenced-animation .woovina-cta__content-item:nth-child(2)' => 'transition-delay: calc( {{SIZE}}ms / 3 )',
					'{{WRAPPER}}.woovina-cta--sequenced-animation .woovina-cta__content-item:nth-child(3)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 2 )',
					'{{WRAPPER}}.woovina-cta--sequenced-animation .woovina-cta__content-item:nth-child(4)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 3 )',
				],
				'condition' => [
					'content_animation!' => '',
					'skin' => 'cover',
				],
			]
		);

		$this->add_control(
			'sequenced_animation',
			[
				'label' => __( 'Sequenced Animation', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'woovina-elementor-widgets' ),
				'label_off' => __( 'Off', 'woovina-elementor-widgets' ),
				'return_value' => 'woovina-cta--sequenced-animation',
				'prefix_class' => '',
				'condition' => [
					'content_animation!' => '',

				],
			]
		);

		$this->add_control(
			'background_hover_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Background', 'woovina-elementor-widgets' ),
				'separator' => 'before',
				'condition' => [
					'skin' => 'cover',
				],
			]
		);

		$this->add_control(
			'transformation',
			[
				'label' => __( 'Hover Animation', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => 'None',
					'zoom-in' => 'Zoom In',
					'zoom-out' => 'Zoom Out',
					'move-left' => 'Move Left',
					'move-right' => 'Move Right',
					'move-up' => 'Move Up',
					'move-down' => 'Move Down',
				],
				'default' => 'zoom-in',
				'prefix_class' => 'elementor-bg-transform elementor-bg-transform-',
			]
		);

		$this->start_controls_tabs( 'bg_effects_tabs' );

		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Normal', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label' => __( 'Overlay Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta:not(:hover) .woovina-cta__bg-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'bg_filters',
				'selector' => '{{WRAPPER}} .woovina-cta__bg',
			]
		);

		$this->add_control(
			'overlay_blend_mode',
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
				'selectors' => [
					'{{WRAPPER}} .woovina-cta__bg-overlay' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'woovina-elementor-widgets' ),
			]
		);

		$this->add_control(
			'overlay_color_hover',
			[
				'label' => __( 'Overlay Color', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woovina-cta:hover .woovina-cta__bg-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'bg_filters_hover',
				'selector' => '{{WRAPPER}} .woovina-cta:hover .woovina-cta__bg',
			]
		);

		$this->add_control(
			'effect_duration',
			[
				'label' => __( 'Transition Duration', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'render_type' => 'template',
				'default' => [
					'size' => 1500,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-cta .woovina-cta__bg, {{WRAPPER}} .woovina-cta .woovina-cta__bg-overlay' => 'transition-duration: {{SIZE}}ms',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$title_tag = $settings['title_tag'];
		$wrapper_tag = 'div';
		$button_tag = 'a';
		$bg_image = '';
		$content_animation = $settings['content_animation'];
		$animation_class = '';
		$print_bg = true;
		$print_content = true;

		if ( ! empty( $settings['bg_image']['id'] ) ) {
			$bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['bg_image']['id'], 'bg_image', $settings );
		} elseif ( ! empty( $settings['bg_image']['url'] ) ) {
			$bg_image = $settings['bg_image']['url'];
		}

		if ( empty( $bg_image ) && 'classic' == $settings['skin'] ) {
			$print_bg = false;
		}

		if ( empty( $settings['title'] ) && empty( $settings['description'] ) && empty( $settings['button'] ) && 'none' == $settings['graphic_element'] ) {
			$print_content = false;
		}

		$this->add_render_attribute( 'background_image', 'style', [
			'background-image: url(' . $bg_image . ');',
		] );

		$this->add_render_attribute( 'title', 'class', [
			'woovina-cta__title',
			'woovina-cta__content-item',
			'elementor-content-item',
		] );

		$this->add_render_attribute( 'description', 'class', [
			'woovina-cta__description',
			'woovina-cta__content-item',
			'elementor-content-item',
		] );

		$this->add_render_attribute( 'button', 'class', [
			'woovina-cta__button',
			'elementor-button',
			'elementor-size-' . $settings['button_size'],
		] );

		$this->add_render_attribute( 'graphic_element', 'class',
			[
				'elementor-content-item',
				'woovina-cta__content-item',
			]
		);

		if ( 'icon' === $settings['graphic_element'] ) {
			$this->add_render_attribute( 'graphic_element', 'class',
				[
					'elementor-icon-wrapper',
					'woovina-cta__icon',
				]
			);
			$this->add_render_attribute( 'graphic_element', 'class', 'elementor-view-' . $settings['icon_view'] );
			if ( 'default' != $settings['icon_view'] ) {
				$this->add_render_attribute( 'graphic_element', 'class', 'elementor-shape-' . $settings['icon_shape'] );
			}
			if ( ! empty( $settings['icon'] ) ) {
				$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			}
		} elseif ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) {
			$this->add_render_attribute( 'graphic_element', 'class', 'woovina-cta__image' );
		}

		if ( ! empty( $content_animation ) && 'cover' == $settings['skin'] ) {

			$animation_class = 'elementor-animated-item--' . $content_animation;

			$this->add_render_attribute( 'title', 'class', $animation_class );

			$this->add_render_attribute( 'graphic_element', 'class', $animation_class );

			$this->add_render_attribute( 'description', 'class', $animation_class );

		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$link_element = 'button';

			if ( 'box' === $settings['link_click'] ) {
				$wrapper_tag = 'a';
				$button_tag = 'button';
				$link_element = 'wrapper';
			}

			$this->add_render_attribute( $link_element, 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( $link_element, 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( $link_element, 'rel', 'nofollow' );
			}
		}

		$this->add_inline_editing_attributes( 'title' );
		$this->add_inline_editing_attributes( 'description' );
		$this->add_inline_editing_attributes( 'button' );

		?>
		<<?php echo $wrapper_tag . ' ' . $this->get_render_attribute_string( 'wrapper' ); ?> class="woovina-cta">
		<?php if ( $print_bg ) : ?>
			<div class="woovina-cta__bg-wrapper">
				<div class="woovina-cta__bg elementor-bg" <?php echo $this->get_render_attribute_string( 'background_image' ); ?>></div>
				<div class="woovina-cta__bg-overlay"></div>
			</div>
		<?php endif; ?>
		<?php if ( $print_content ) : ?>
			<div class="woovina-cta__content">
				<?php if ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'graphic_element' ); ?>>
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'graphic_image' ); ?>
					</div>
				<?php elseif ( 'icon' === $settings['graphic_element'] && ! empty( $settings['icon'] ) ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'graphic_element' ); ?>>
						<div class="elementor-icon">
							<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<<?php echo $title_tag . ' ' . $this->get_render_attribute_string( 'title' ); ?>>
						<?php echo $settings['title']; ?>
					</<?php echo $title_tag; ?>>
				<?php endif; ?>

				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
						<?php echo $settings['description']; ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $settings['button'] ) ) : ?>
					<div class="woovina-cta__button-wrapper woovina-cta__content-item elementor-content-item <?php echo $animation_class; ?>">
					<<?php echo $button_tag . ' ' . $this->get_render_attribute_string( 'button' ); ?>>
						<?php echo $settings['button']; ?>
					</<?php echo $button_tag; ?>>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php
		if ( ! empty( $settings['ribbon_title'] ) ) :
			$this->add_render_attribute( 'ribbon-wrapper', 'class', 'woovina-ribbon' );

			if ( ! empty( $settings['ribbon_horizontal_position'] ) ) {
				$this->add_render_attribute( 'ribbon-wrapper', 'class', 'woovina-ribbon-' . $settings['ribbon_horizontal_position'] );
			}
			?>
			<div <?php echo $this->get_render_attribute_string( 'ribbon-wrapper' ); ?>>
				<div class="woovina-ribbon-inner"><?php echo $settings['ribbon_title']; ?></div>
			</div>
		<?php endif; ?>
		</<?php echo $wrapper_tag; ?>>
		<?php
	}

	protected function _content_template() {
		?>
		<#
			var wrapperTag = 'div',
				buttonTag = 'a',
				contentAnimation = settings.content_animation,
				animationClass,
				btnSizeClass = 'elementor-size-' + settings.button_size,
				printBg = true,
				printContent = true;

			if ( 'box' === settings.link_click ) {
				wrapperTag = 'a';
				buttonTag = 'button';
				view.addRenderAttribute( 'wrapper', 'href', '#' );
			}

			if ( '' !== settings.bg_image.url ) {
				var bg_image = {
					id: settings.bg_image.id,
					url: settings.bg_image.url,
					size: settings.bg_image_size,
					dimension: settings.bg_image_custom_dimension,
					model: view.getEditModel()
				};

				var bgImageUrl = elementor.imagesManager.getImageUrl( bg_image );
			}

			if ( ! bg_image && 'classic' == settings.skin ) {
				printBg = false;
			}

			if ( ! settings.title && ! settings.description && ! settings.button && 'none' == settings.graphic_element ) {
				printContent = false;
			}

			if ( 'icon' === settings.graphic_element ) {
				var iconWrapperClasses = 'elementor-icon-wrapper';
					iconWrapperClasses += ' woovina-cta__image';
					iconWrapperClasses += ' elementor-view-' + settings.icon_view;
				if ( 'default' !== settings.icon_view ) {
					iconWrapperClasses += ' elementor-shape-' + settings.icon_shape;
				}
				view.addRenderAttribute( 'graphic_element', 'class', iconWrapperClasses );

			} else if ( 'image' === settings.graphic_element && '' !== settings.graphic_image.url ) {
				var image = {
					id: settings.graphic_image.id,
					url: settings.graphic_image.url,
					size: settings.graphic_image_size,
					dimension: settings.graphic_image_custom_dimension,
					model: view.getEditModel()
				};

				var imageUrl = elementor.imagesManager.getImageUrl( image );
				view.addRenderAttribute( 'graphic_element', 'class', 'woovina-cta__image' );
			}

			if ( contentAnimation && 'cover' === settings.skin ) {

				var animationClass = 'elementor-animated-item--' + contentAnimation;

				view.addRenderAttribute( 'title', 'class', animationClass );

				view.addRenderAttribute( 'description', 'class', animationClass );

				view.addRenderAttribute( 'graphic_element', 'class', animationClass );
			}

			view.addRenderAttribute( 'background_image', 'style', 'background-image: url(' + bgImageUrl + ');' );
			view.addRenderAttribute( 'title', 'class', [ 'woovina-cta__title', 'woovina-cta__content-item', 'elementor-content-item' ] );
			view.addRenderAttribute( 'description', 'class', [ 'woovina-cta__description', 'woovina-cta__content-item', 'elementor-content-item' ] );
			view.addRenderAttribute( 'button', 'class', [ 'woovina-cta__button', 'elementor-button', btnSizeClass ] );
			view.addRenderAttribute( 'graphic_element', 'class', [ 'woovina-cta__content-item', 'elementor-content-item' ] );


			view.addInlineEditingAttributes( 'title' );
			view.addInlineEditingAttributes( 'description' );
			view.addInlineEditingAttributes( 'button' );
		#>

		<{{ wrapperTag }} class="woovina-cta" {{{ view.getRenderAttributeString( 'wrapper' ) }}}>

		<# if ( printBg ) { #>
			<div class="woovina-cta__bg-wrapper">
				<div class="woovina-cta__bg elementor-bg" {{{ view.getRenderAttributeString( 'background_image' ) }}}></div>
				<div class="woovina-cta__bg-overlay"></div>
			</div>
		<# } #>
		<# if ( printContent ) { #>
			<div class="woovina-cta__content">
				<# if ( 'image' === settings.graphic_element && '' !== settings.graphic_image.url ) { #>
					<div {{{ view.getRenderAttributeString( 'graphic_element' ) }}}>
						<img src="{{ imageUrl }}">
					</div>
				<#  } else if ( 'icon' === settings.graphic_element && settings.icon ) { #>
					<div {{{ view.getRenderAttributeString( 'graphic_element' ) }}}>
						<div class="elementor-icon">
							<i class="{{ settings.icon }}"></i>
						</div>
					</div>
				<# } #>
				<# if ( settings.title ) { #>
					<{{ settings.title_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{ settings.title_tag }}>
				<# } #>

				<# if ( settings.description ) { #>
					<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
				<# } #>

				<# if ( settings.button ) { #>
					<div class="woovina-cta__button-wrapper woovina-cta__content-item elementor-content-item {{ animationClass }}">
						<{{ buttonTag }} href="#" {{{ view.getRenderAttributeString( 'button' ) }}}>{{{ settings.button }}}</{{ buttonTag }}>
					</div>
				<# } #>
			</div>
		<# } #>
		<# if ( settings.ribbon_title ) {
			var ribbonClasses = 'woovina-ribbon';

			if ( settings.ribbon_horizontal_position ) {
				ribbonClasses += ' woovina-ribbon-' + settings.ribbon_horizontal_position;
			} #>
			<div class="{{ ribbonClasses }}">
				<div class="woovina-ribbon-inner">{{{ settings.ribbon_title }}}</div>
			</div>
		<# } #>
		</{{ wrapperTag }}>
		<?php
	}
}
