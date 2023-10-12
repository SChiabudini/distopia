<?php
namespace wvnElementor\Modules\InfoBox\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class InfoBox extends Widget_Base {

	public function get_name() {
		return 'wew-info-box';
	}

	public function get_title() {
		return __('Info Box', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-icon-box';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-info-box' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_info_box',
			[
				'label' 		=> __('General', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'type',
			[
				'label'   		=> __('Type', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'icon',
				'options' 		=> [
					'none'  	=> __('None', 'woovina-elementor-widgets'),
					'icon'  	=> __('Icon', 'woovina-elementor-widgets'),
					'image'  	=> __('Image', 'woovina-elementor-widgets'),
					'text'  	=> __('Text', 'woovina-elementor-widgets'),
				],
			]
		);

        $this->add_control(
            'icon',
            [
                'label' 		=> __('Icon', 'woovina-elementor-widgets'),
                'type'			=> Controls_Manager::ICON,
                'default'       => 'fa fa-500px',
                'condition'     => [
                    'type' => 'icon',
                ],
            ]
       );

		$this->add_control(
			'image',
			[
				'label' 		=> __('Image', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' 	=> [
                    'type' => 'image',
                ],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label' 		=> __('Image Size', 'woovina-elementor-widgets'),
				'default' 		=> 'large',
                'condition' 	=> [
                    'type' => 'image',
                ],
			]
		);

		$this->add_control(
			'image_link',
			[
				'label'   		=> __('Image Link', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::URL,
				'placeholder' 	=> __('https://your-link.com', 'woovina-elementor-widgets'),
                'condition' 	=> [
                    'type' => 'image',
                ],
			]
		);

        $this->add_control(
            'text',
            [
                'label' 		=> __('Text', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> '1',
                'condition' 	=> [
                    'type' => 'text',
                ],
				'dynamic' 		=> [ 'active' => true ],
            ]
       );

		$this->add_responsive_control(
			'position',
			[
				'label' 		=> __('Position', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::CHOOSE,
				'default' 		=> 'top',
				'options' 		=> [
					'left' => [
						'title'   => __('Left', 'woovina-elementor-widgets'),
						'icon'    => 'fa fa-align-left',
					],
					'top' => [
						'title'   => __('Top', 'woovina-elementor-widgets'),
						'icon'    => 'fa fa-align-center',
					],
					'right' => [
						'title'   => __('Right', 'woovina-elementor-widgets'),
						'icon'    => 'fa fa-align-right',
					],
				],
                'prefix_class' 	=> 'wew-info-box%s-',
                'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' 		=> __('Content Alignment', 'woovina-elementor-widgets'),
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
				],
				'default' 		=> 'center',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'vertical_position',
			[
				'label' 		=> __('Vertical Position', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::CHOOSE,
				'default' 		=> 'top',
				'options' 		=> [
					'top' => [
						'title'   => __('Top', 'woovina-elementor-widgets'),
						'icon'    => 'eicon-v-align-top',
					],
					'middle' => [
						'title'   => __('Middle', 'woovina-elementor-widgets'),
						'icon'    => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title'   => __('Bottom', 'woovina-elementor-widgets'),
						'icon'    => 'eicon-v-align-bottom',
					],
				],
                'condition' 	=> [
                    'position'  => [
	                    'left',
	                    'right',
	                ],
                    'type!'  => 'none',
                ],
				'selectors' 	=> [
					'(desktop){{WRAPPER}}.wew-info-box-left .wew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(desktop){{WRAPPER}}.wew-info-box-right .wew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(tablet){{WRAPPER}}.wew-info-box-tablet-left .wew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(tablet){{WRAPPER}}.wew-info-box-tablet-right .wew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(mobile){{WRAPPER}}.wew-info-box-mobile-left .wew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(mobile){{WRAPPER}}.wew-info-box-mobile-right .wew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'top'          => 'flex-start',
					'middle'       => 'center',
					'bottom'       => 'flex-end',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' 		=> __('Content', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'title',
			[
				'label'   		=> __('Title', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXT,
				'default' 		=> __('This is the heading', 'woovina-elementor-widgets'),
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'   		=> __('Description', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXTAREA,
				'default' 		=> __('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Enter your description', 'woovina-elementor-widgets'),
				'rows' 			=> 10,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'title_divider',
			[
				'label' 		=> __('Title Separator', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   		=> __('Title Tag', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'h3',
				'options' 		=> [
                    'h1'     => __('H1', 'woovina-elementor-widgets'),
                    'h2'     => __('H2', 'woovina-elementor-widgets'),
                    'h3'     => __('H3', 'woovina-elementor-widgets'),
                    'h4'     => __('H4', 'woovina-elementor-widgets'),
                    'h5'     => __('H5', 'woovina-elementor-widgets'),
                    'h6'     => __('H6', 'woovina-elementor-widgets'),
                    'div'    => __('div', 'woovina-elementor-widgets'),
                    'span'   => __('span', 'woovina-elementor-widgets'),
                    'p'      => __('p', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'link_heading',
			[
				'label' 		=> __('Link', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'link_type',
			[
				'label'   		=> __('Link Type', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'none',
				'options' 		=> [
                    'none'    => __('None', 'woovina-elementor-widgets'),
                    'box'     => __('Box', 'woovina-elementor-widgets'),
                    'title'   => __('Title', 'woovina-elementor-widgets'),
                    'button'  => __('Button', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' 		=> __('Size', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'md',
				'options' 		=> [
					'xs' => __('Extra Small', 'woovina-elementor-widgets'),
					'sm' => __('Small', 'woovina-elementor-widgets'),
					'md' => __('Medium', 'woovina-elementor-widgets'),
					'lg' => __('Large', 'woovina-elementor-widgets'),
					'xl' => __('Extra Large', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'   		=> __('Link', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::URL,
                'default' 		=> [
                    'url' => '#',
                ],
				'placeholder' 	=> __('https://your-link.com', 'woovina-elementor-widgets'),
                'condition' 	=> [
                    'link_type!'   => 'none',
                ],
			]
		);

        $this->add_control(
            'button_text',
            [
                'label' 		=> __('Button Text', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __('Learn More', 'woovina-elementor-widgets'),
                'condition' 	=> [
                    'link_type' => 'button',
                ],
				'dynamic' 		=> [ 'active' => true ],
            ]
       );

        $this->add_control(
            'button_icon',
            [
                'label' 		=> __('Button Icon', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::ICON,
                'default' 		=> '',
                'condition' 	=> [
                    'link_type'   => 'button',
                ],
            ]
       );
        
        $this->add_control(
            'button_icon_position',
            [
                'label' 		=> __('Icon Position', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'left',
                'options' 		=> [
                    'left'     => __('Before', 'woovina-elementor-widgets'),
                    'right'    => __('After', 'woovina-elementor-widgets'),
                ],
                'condition' 	=> [
                    'link_type'     => 'button',
                    'button_icon!'  => '',
                ],
            ]
       );

		$this->add_control(
			'button_icon_spacing',
			[
				'label' 		=> __('Icon Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
                    'link_type'     => 'button',
                    'button_icon!'  => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box-button.elementor-align-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-info-box-button.elementor-align-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Info Box', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs('tabs_info_box');

        $this->start_controls_tab(
            'tab_info_box_normal',
            [
                'label' 		=> __('Normal', 'woovina-elementor-widgets'),
            ]
       );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'info_box_background',
                'selector' 		=> '{{WRAPPER}} .wew-info-box-wrap',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'info_box_border',
				'selector' 		=> '{{WRAPPER}} .wew-info-box-wrap',
			]
		);

		$this->add_control(
			'info_box_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'info_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-info-box-wrap',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_info_box_hover',
            [
                'label' 		=> __('Hover', 'woovina-elementor-widgets'),
            ]
       );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'info_box_hover_background',
                'selector' 		=> '{{WRAPPER}} .wew-info-box-wrap:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'info_box_hover_border',
				'selector' 		=> '{{WRAPPER}} .wew-info-box-wrap:hover',
			]
		);

		$this->add_control(
			'info_box_border_radius_hover',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'info_box_hover_animation',
			[
				'label' 		=> __('Animation', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'info_box_shadow_hover',
				'selector' 		=> '{{WRAPPER}} .wew-info-box-wrap:hover',
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->add_responsive_control(
			'info_box_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
                'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' 		=> __('Icon Style', 'woovina-elementor-widgets'),
                'tab' 			=> Controls_Manager::TAB_STYLE,
                'condition' 	=> [
                    'type!' => 'none',
                ],
            ]
       );
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' 		=> __('Icon Size', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'range' 		=> [
                    'px' => [
                        'min'   => 5,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px', 'em' ],
                'condition' 	=> [
                    'type' => 'icon',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
       );
        
        $this->add_responsive_control(
            'img_width',
            [
                'label' 		=> __('Width', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 30,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
                'selectors' 	=> [
                    '{{WRAPPER}}.wew-info-box-top .wew-info-box-icon, {{WRAPPER}}.wew-info-box-left .wew-info-box-icon-wrap, {{WRAPPER}}.wew-info-box-right .wew-info-box-icon-wrap' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' 	=> [
                    'type' => 'image',
                ],
            ]
       );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'text_typography',
                'label' 		=> __('Typography', 'woovina-elementor-widgets'),
                'scheme' 		=> Typography::TYPOGRAPHY_4,
                'condition' 	=> [
                    'type' => 'text',
                ],
                'selector' 		=> '{{WRAPPER}} .wew-info-box-icon',
            ]
       );

        $this->start_controls_tabs('tabs_icon_style');

        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' 		=> __('Normal', 'woovina-elementor-widgets'),
            ]
       );
        
        $this->add_control(
            'icon_background',
            [
                'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-icon' => 'background-color: {{VALUE}}',
                ],
            ]
       );

        $this->add_control(
            'icon_color',
            [
                'label' 		=> __('Icon Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-icon' => 'color: {{VALUE}}',
                ],
                'condition' 	=> [
                    'type!' => 'image',
                ],
            ]
       );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' 		=> __('Hover', 'woovina-elementor-widgets'),
            ]
       );
        
        $this->add_control(
            'icon_background_hover',
            [
                'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'condition'  	=> [
                    'type!' => 'none',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-icon:hover' => 'background-color: {{VALUE}}',
                ],
            ]
       );

        $this->add_control(
            'icon_color_hover',
            [
                'label' 		=> __('Icon Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-icon:hover' => 'color: {{VALUE}}',
                ],
                'condition' 	=> [
                    'type!' => 'image',
                ],
            ]
       );

        $this->add_control(
            'icon_border_color_hover',
            [
                'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'type!' => 'none',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-icon:hover' => 'border-color: {{VALUE}}',
                ],
            ]
       );

		$this->add_control(
			'icon_hover_animation',
			[
				'label' 		=> __('Icon Animation', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HOVER_ANIMATION,
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'icon_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
                'condition' 	=> [
                    'type!' => 'none',
                ],
				'selector' 		=> '{{WRAPPER}} .wew-info-box-icon',
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
                'condition' 	=> [
                    'type!' => 'none',
                ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box-icon, {{WRAPPER}} .wew-info-box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'icon_rotation',
            [
                'label' 		=> __('Icon Rotation', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 360,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> '',
                'condition' 	=> [
                    'type!' => 'none',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-icon' => '-webkit-transform: rotate({{SIZE}}deg); -moz-transform: rotate({{SIZE}}deg); -ms-transform: rotate({{SIZE}}deg); -o-transform: rotate({{SIZE}}deg); transform: rotate({{SIZE}}deg);',
                ],
            ]
       );

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'placeholder' 	=> [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box-icon-wrap' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' 		=> __('Title & Description', 'woovina-elementor-widgets'),
                'tab' 			=> Controls_Manager::TAB_STYLE,
            ]
       );

        $this->add_control(
            'title_color',
            [
                'label' 		=> __('Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-title' => 'color: {{VALUE}}',
                ],
            ]
       );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'title_typography',
                'label' 		=> __('Typography', 'woovina-elementor-widgets'),
                'scheme' 		=> Typography::TYPOGRAPHY_4,
                'selector' 		=> '{{WRAPPER}} .wew-info-box-title',
            ]
       );
        
        $this->add_responsive_control(
            'title_margin',
            [
                'label' 		=> __('Margin Bottom', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [
                    'size'  => 15,
                ],
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
       );

		$this->add_control(
			'description_heading',
			[
				'label' 		=> __('Description', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

        $this->add_control(
            'description_color',
            [
                'label' 		=> __('Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-description' => 'color: {{VALUE}}',
                ],
            ]
       );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'description_typography',
                'label' 		=> __('Typography', 'woovina-elementor-widgets'),
                'scheme' 		=> Typography::TYPOGRAPHY_4,
                'selector' 		=> '{{WRAPPER}} .wew-info-box-description',
            ]
       );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_divider_style',
            [
                'label' 		=> __('Title Separator', 'woovina-elementor-widgets'),
                'tab' 			=> Controls_Manager::TAB_STYLE,
                'condition' 	=> [
                    'title_divider' => 'yes',
                ],
            ]
       );
        
        $this->add_control(
            'divider_title_border_type',
            [
                'label' 		=> __('Border Type', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'solid',
                'options' 		=> [
                    'none'      => __('None', 'woovina-elementor-widgets'),
                    'solid'     => __('Solid', 'woovina-elementor-widgets'),
                    'double'    => __('Double', 'woovina-elementor-widgets'),
                    'dotted'    => __('Dotted', 'woovina-elementor-widgets'),
                    'dashed'    => __('Dashed', 'woovina-elementor-widgets'),
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-divider' => 'border-bottom-style: {{VALUE}}',
                ],
                'condition' 	=> [
                    'title_divider' => 'yes',
                ],
            ]
       );
        
        $this->add_responsive_control(
            'divider_title_width',
            [
                'label' 		=> __('Border Width', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [
                    'size'  => 30,
                ],
                'range' 		=> [
                    'px' => [
                        'min'   => 1,
                        'max'   => 1000,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 1,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-divider' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' 	=> [
                    'title_divider' => 'yes',
                ],
            ]
       );
        
        $this->add_responsive_control(
            'divider_title_border_height',
            [
                'label' 		=> __('Border Height', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [
                    'size'  => 2,
                ],
                'range' 		=> [
                    'px' => [
                        'min'   => 1,
                        'max'   => 20,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' 	=> [
                    'title_divider' => 'yes',
                ],
            ]
       );

        $this->add_control(
            'divider_title_border_color',
            [
                'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-divider' => 'border-bottom-color: {{VALUE}}',
                ],
                'condition' 	=> [
                    'title_divider' => 'yes',
                ],
            ]
       );
        
        $this->add_responsive_control(
			'divider_title_align',
			[
				'label' 		=> __('Alignment', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'flex-start' => [
						'title' => __('Left', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-left',
					],
					'center'    => [
						'title' => __('Center', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end' 	=> [
						'title' => __('Right', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box-divider-wrap'   => 'display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex; -webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
				],
                'condition' 	=> [
                    'title_divider' => 'yes',
                ],
			]
		);
        
        $this->add_responsive_control(
            'divider_title_margin',
            [
                'label' 		=> __('Margin Bottom', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [
                    'size'  => 20,
                ],
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-divider-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition' 	=> [
                    'title_divider' => 'yes',
                ],
            ]
       );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label' 		=> __('Button', 'woovina-elementor-widgets'),
                'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
            ]
       );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' 		=> __('Normal', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
            ]
       );

        $this->add_control(
            'button_background',
            [
                'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-button' => 'background-color: {{VALUE}}',
                ],
				'condition'             => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
            ]
       );

        $this->add_control(
            'button_text_color',
            [
                'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-button' => 'color: {{VALUE}}',
                ],
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
            ]
       );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-info-box-button',
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' 		=> __('Hover', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
            ]
       );

        $this->add_control(
            'button_hover_background',
            [
                'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-button:hover' => 'background-color: {{VALUE}}',
                ],
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
            ]
       );

        $this->add_control(
            'button_hover_color',
            [
                'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-button:hover' => 'color: {{VALUE}}',
                ],
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
            ]
       );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-button:hover' => 'border-color: {{VALUE}}',
                ],
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
            ]
       );

		$this->add_control(
			'button_animation',
			[
				'label' 		=> __('Animation', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HOVER_ANIMATION,
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_hover_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-info-box-button:hover',
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border_normal',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
                'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
                ],
				'selector' 		=> '{{WRAPPER}} .wew-info-box-button',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'button_typography',
                'label' 		=> __('Typography', 'woovina-elementor-widgets'),
                'scheme' 		=> Typography::TYPOGRAPHY_4,
                'selector' 		=> '{{WRAPPER}} .wew-info-box-button',
				'condition'		=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
            ]
       );

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-info-box-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);
        
        $this->add_responsive_control(
            'button_margin',
            [
                'label' 		=> __('Margin Top', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [
                    'size'  => 15,
                ],
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-info-box-btn-wrap' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
            ]
       );

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('wrap', 'class', 'wew-info-box-wrap');
        
		if($settings['info_box_hover_animation']) {
			$this->add_render_attribute('wrap', 'class', 'elementor-animation-' . $settings['info_box_hover_animation']);
		}
		
		$this->add_render_attribute('info-box', 'class', 'wew-info-box');
		$this->add_render_attribute('icon-wrap', 'class', 'wew-info-box-icon-wrap');
		$this->add_render_attribute('icon', 'class', 'wew-info-box-icon');
		$this->add_render_attribute('content', 'class', 'wew-info-box-content');
		$this->add_render_attribute('title', 'class', 'wew-info-box-title');
		$this->add_inline_editing_attributes('title', 'basic');
		$this->add_render_attribute('description', 'class', 'wew-info-box-description');
		$this->add_inline_editing_attributes('description', 'basic');

		$wrap_tag = 'div';
		$tag = $settings['title_tag'];
        
        $this->add_render_attribute('info-box-button', 'class', [
				'wew-info-box-button',
				'elementor-button',
				'elementor-size-' . $settings['button_size'],
				'elementor-align-icon-' . $settings['button_icon_position'],
			]
		);

		if($settings['button_animation']) {
			$this->add_render_attribute('info-box-button', 'class', 'elementor-animation-' . $settings['button_animation']);
		}
        
		if($settings['icon_hover_animation']) {
			$this->add_render_attribute('icon', 'class', 'elementor-animation-' . $settings['icon_hover_animation']);
		}

        if('none' != $settings['link_type']) {
            
            if(! empty($settings['link']['url'])) {

                if('box' == $settings['link_type']) {

					$wrap_tag = 'a';
                                        
                    $this->add_render_attribute('wrap', 'href', $settings['link']['url']);

                    if($settings['link']['is_external']) {
                        $this->add_render_attribute('wrap', 'target', '_blank');
                    }

                    if($settings['link']['nofollow']) {
                        $this->add_render_attribute('wrap', 'rel', 'nofollow');
                    }
                    
                } else if('title' == $settings['link_type']) {
                    
                    $tag = 'a';
                    
                    $this->add_render_attribute('title', 'href', $settings['link']['url']);

                    if($settings['link']['is_external']) {
                        $this->add_render_attribute('title', 'target', '_blank');
                    }

                    if($settings['link']['nofollow']) {
                        $this->add_render_attribute('title', 'rel', 'nofollow');
                    }
                    
                } else if('button' == $settings['link_type']) {
                                        
                    $this->add_render_attribute('info-box-button', 'href', $settings['link']['url']);

                    if($settings['link']['is_external']) {
                        $this->add_render_attribute('info-box-button', 'target', '_blank');
                    }

                    if($settings['link']['nofollow']) {
                        $this->add_render_attribute('info-box-button', 'rel', 'nofollow');
                    }
                    
                }

            }

        } ?>

		<<?php echo $wrap_tag; ?> <?php echo $this->get_render_attribute_string('wrap'); ?>>
	        <div <?php echo $this->get_render_attribute_string('info-box'); ?>>

	        	<?php
	        	if('none' != $settings['type']) { ?>
	                <div <?php echo $this->get_render_attribute_string('icon-wrap'); ?>>
	                    <span <?php echo $this->get_render_attribute_string('icon'); ?>>
	                        <?php
	                        if('icon' == $settings['type']) { ?>
	                            <i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
	                        <?php
	                    	} else if('image' == $settings['type']) {
	                            if(! empty($settings['image_link']['url'])) {
	                            	$this->add_render_attribute('image-link', 'href', $settings['image_link']['url']);

									if($settings['image_link']['is_external']) {
										$this->add_render_attribute('image-link', 'target', '_blank');
									}

									if($settings['image_link']['nofollow']) {
										$this->add_render_attribute('image-link', 'rel', 'nofollow');
									}

									echo '<a ' . $this->get_render_attribute_string('image-link') . '>'; ?>
								<?php
								}
	                            	echo Group_Control_Image_Size::get_attachment_image_html($settings);
	                            if(! empty($settings['image_link']['url'])) { ?>
									</a>
								<?php
								}
	                    	} else if('text' == $settings['type']) { ?>
	                            <span class="wew-icon-text">
	                                <?php echo $settings['text']; ?>
	                            </span>
	                        <?php
	                    	} ?>
	                    </span>
	                </div>
	            <?php
	        	} ?>

	        	<div <?php echo $this->get_render_attribute_string('content'); ?>>
	            	<?php
	            	if(! empty($settings['title'])) { ?>
		        		<<?php echo $tag; ?> <?php echo $this->get_render_attribute_string('title'); ?>>
							<?php echo $this->parse_text_editor($settings['title']); ?>
						</<?php echo $tag; ?>>
	                <?php
	            	} ?>

	        		<?php
	        		if('yes' == $settings['title_divider']) { ?>
	                    <div class="wew-info-box-divider-wrap">
	                        <div class="wew-info-box-divider"></div>
	                    </div>
	                <?php
	            	} ?>

	            	<?php
	            	if(! empty($settings['description'])) { ?>
		        		<div <?php echo $this->get_render_attribute_string('description'); ?>>
		        			<?php echo $this->parse_text_editor(nl2br($settings['description'])); ?>
		        		</div>
	                <?php
	            	} ?>

	                <?php
	                if('button' == $settings['link_type']) { ?>
	                    <div class="wew-info-box-btn-wrap">
	                        <a <?php echo $this->get_render_attribute_string('info-box-button'); ?>>
	                            <?php
	                            if(! empty($settings['button_icon']) && 'left' == $settings['button_icon_position']) { ?>
	                                <i class="wew-button-icon <?php echo esc_attr($settings['button_icon']); ?>" aria-hidden="true"></i>
	                            <?php
	                        	} ?>

	                            <?php
	                            if(! empty($settings['button_text'])) { ?>
	                                <span <?php echo $this->get_render_attribute_string('button_text'); ?>>
	                                    <?php echo esc_attr($settings['button_text']); ?>
	                                </span>
	                            <?php
	                        	} ?>

	                            <?php
	                            if(! empty($settings['button_icon']) && 'right' == $settings['button_icon_position']) { ?>
	                                <i class="wew-button-icon <?php echo esc_attr($settings['button_icon']); ?>" aria-hidden="true"></i>
	                            <?php
	                        	} ?>
	                        </a>
	                    </div>
	                <?php
	            	} ?>
	            </div>

	        </div>
        </<?php echo $wrap_tag; ?>>

	<?php
	}

	protected function _content_template() { ?>

		<#
            var wrap_tag = 'div';
            var tag = 'h3';

            if(settings.image.url) {
                if('box' == settings.link_type) {
                    var wrap_tag = 'a';
                } else if('title' == settings.link_type) {
                    var tag = 'a';
                }

                var image = {
					id: settings.image.id,
					url: settings.image.url,
					size: settings.image_size,
					dimension: settings.image_custom_dimension,
					model: view.getEditModel()
				};

				var image_url = elementor.imagesManager.getImageUrl(image);
            }
        #>

        <{{{wrap_tag}}} class="wew-info-box-wrap elementor-animation-{{ settings.info_box_hover_animation }}" href="{{settings.link.url}}">
            <div class="wew-info-box wew-info-box-{{ settings.icon_position }}">

            	<# if('none' != settings.type) { #>
                    <div class="wew-info-box-icon-wrap">
                        <span class="wew-info-box-icon elementor-animation-{{ settings.icon_hover_animation }}">
                            <# if('icon' == settings.type) { #>
                                <i class="{{{ settings.icon }}}" aria-hidden="true"></i>
                            <# } else if('image' == settings.type) { #>
                                <# if('' != settings.image_link.url) { #>
                            		<a href="{{ settings.image_link.url }}">
                            	<# } #>
                                	<img src="{{ image_url }}">
                                <# if('' != settings.image_link.url) { #>
                            		</a>
                            	<# } #>
                            <# } else if('text' == settings.type) { #>
                                <span class="wew-icon-text elementor-inline-editing" data-elementor-setting-key="text" data-elementor-inline-editing-toolbar="none">
                                    {{{ settings.text }}}
                                </span>
                            <# } #>
                        </span>
                    </div>
                <# } #>

                <div class="wew-info-box-content">
                    <# if(settings.title) { #>
		        		<{{tag}} class="wew-info-box-title elementor-inline-editing" data-elementor-setting-key="heading" data-elementor-inline-editing-toolbar="none" href="{{ settings.link.url }}">
		        			{{{ settings.title }}}
						</{{tag}}>
                    <# } #>

                    <# if('yes' == settings.title_divider) { #>
                        <div class="wew-info-box-divider-wrap">
                            <div class="wew-info-box-divider"></div>
                        </div>
                    <# } #>

                    <# if(settings.description) { #>
                        <div class="wew-info-box-description elementor-inline-editing" data-elementor-setting-key="description" data-elementor-inline-editing-toolbar="basic">
                            {{{ settings.description }}}
                        </div>
                    <# } #>

                    <# if('button' == settings.link_type) { #>
                        <div class="wew-info-box-btn-wrap">
                            <a href="{{ settings.link.url }}" class="wew-info-box-button elementor-button elementor-size-{{ settings.button_size }} elementor-align-icon-{{ settings.button_icon_position }} elementor-animation-{{ settings.button_animation }}">
                                <# if(settings.button_icon && 'left' == settings.button_icon_position) { #>
                                    <i class="wew-button-icon {{{ settings.button_icon }}}" aria-hidden="true"></i>
                                <# } #>

                                <# if(settings.button_text) { #>
                                    <span class="wew-button-text elementor-inline-editing" data-elementor-setting-key="button_text" data-elementor-inline-editing-toolbar="none">
                                        {{{ settings.button_text }}}
                                    </span>
                                <# } #>

                                <# if(settings.button_icon && 'right' == settings.button_icon_position) { #>
                                    <i class="wew-button-icon {{{ settings.button_icon }}}" aria-hidden="true"></i>
                                <# } #>
                            </a>
                        </div>
                    <# } #>
	            </div>

	        </div>
        </{{{wrap_tag}}}>
		
	<?php
	}

}