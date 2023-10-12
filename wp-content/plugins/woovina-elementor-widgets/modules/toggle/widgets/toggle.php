<?php
namespace wvnElementor\Modules\Toggle\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Toggle extends Widget_Base {

	public function get_name() {
		return 'wew-toggle';
	}

	public function get_title() {
		return __('Switch', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-dual-button';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-toggle' ];
	}

	public function get_style_depends() {
		return [ 'wew-toggle' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_primary',
			[
				'label' 		=> __('Primary', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'primary_label',
			[
				'label'   		=> __('Label', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXT,
				'default' 		=> __('Monthly', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
            'primary_type',
            [
                'label' 		=> __('Content Type', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
                    'content' 	=> __('Content', 'woovina-elementor-widgets'),
                    'template' 	=> __('Template', 'woovina-elementor-widgets'),
                    'image' 	=> __('Image', 'woovina-elementor-widgets'),
                ],
                'default' 		=> 'content',
            ]
       );

        $this->add_control(
            'primary_content',
            [
                'label' 		=> __('Content', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::WYSIWYG,
                'default' 		=> __('Add your content here', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'primary_type' => 'content',
				],
				'dynamic' 		=> [ 'active' => true ],
            ]
       );

        $this->add_control(
            'primary_template',
            [
                'label' 		=> __('Choose Template', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> wew_get_available_templates(),
				'default' 		=> '0',
				'condition' 	=> [
					'primary_type' => 'template',
				],
            ]
       );

        $this->add_control(
			'primary_image',
			[
				'label' 		=> __('Image', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' 	=> [
					'primary_type' => 'image',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'primary_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label' 		=> __('Image Size', 'woovina-elementor-widgets'),
				'default' 		=> 'large',
				'condition' 	=> [
					'primary_type' => 'image',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_secondary',
			[
				'label' 		=> __('Secondary', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'secondary_label',
			[
				'label'   		=> __('Label', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXT,
				'default' 		=> __('Yearly', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
            'secondary_type',
            [
                'label' 		=> __('Content Type', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
                    'content' 	=> __('Content', 'woovina-elementor-widgets'),
                    'template' 	=> __('Template', 'woovina-elementor-widgets'),
                    'image' 	=> __('Image', 'woovina-elementor-widgets'),
                ],
                'default' 		=> 'content',
            ]
       );

        $this->add_control(
            'secondary_content',
            [
                'label' 		=> __('Content', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::WYSIWYG,
                'default' 		=> __('Add your content here', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'secondary_type' => 'content',
				],
				'dynamic' 		=> [ 'active' => true ],
            ]
       );

        $this->add_control(
            'secondary_template',
            [
                'label' 		=> __('Choose Template', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> wew_get_available_templates(),
				'default' 		=> '0',
				'condition' 	=> [
					'secondary_type' => 'template',
				],
            ]
       );

        $this->add_control(
			'secondary_image',
			[
				'label' 		=> __('Image', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' 	=> [
					'secondary_type' => 'image',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'secondary_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label' 		=> __('Image Size', 'woovina-elementor-widgets'),
				'default' 		=> 'large',
				'condition' 	=> [
					'secondary_type' => 'image',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> esc_html__('Switch', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_responsive_control(
			'switch_align',
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
				'default' 		=> 'center',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-container .wew-switch-wrap' => 'display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex; -webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'switch_size',
            [
                'label' 		=> __('Size', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [
                    'size'  => 14,
                    'unit' => 'px',
                ],
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-switch' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
       );
        
        $this->add_responsive_control(
            'switch_labels_spacing',
            [
                'label' 		=> __('Labels Spacing', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [
                    'size'  => 25,
                    'unit' => 'px',
                ],
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-switch-container .wew-switch-wrap .wew-switch' => 'margin: 0 {{SIZE}}{{UNIT}}',
                ],
            ]
       );

		$this->add_responsive_control(
			'switch_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-container .wew-switch-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs('tabs_switch_style');

        $this->start_controls_tab(
            'tab_switch_normal',
            [
                'label' 		=> __('Normal', 'woovina-elementor-widgets'),
            ]
       );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 			=> 'switch_normal_background',
				'types' 		=> [ 'classic', 'gradient' ],
				'selector' 		=> '{{WRAPPER}} .wew-switch-container .wew-switch-wrap .wew-switch span:before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'switch_normal_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-switch-container .wew-switch-wrap .wew-switch span:before',
			]
		);

		$this->add_control(
			'switch_normal_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-container .wew-switch-wrap .wew-switch span:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_switch_active',
            [
                'label' 		=> __('Active', 'woovina-elementor-widgets'),
            ]
       );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 			=> 'switch_activel_background',
				'types' 		=> [ 'classic', 'gradient' ],
				'selector' 		=> '{{WRAPPER}} .wew-switch-container .wew-switch-wrap.wew-switch-on span:before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'switch_active_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-switch-container .wew-switch-wrap.wew-switch-on span:before',
			]
		);

		$this->add_control(
			'switch_active_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-container .wew-switch-wrap.wew-switch-on span:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->add_control(
			'controller_heading',
			[
				'label' 		=> __('Controller', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 			=> 'controller_background',
				'types' 		=> [ 'classic', 'gradient' ],
				'selector' 		=> '{{WRAPPER}} .wew-switch-container .wew-switch-wrap .wew-switch span:after',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'controller_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-switch-container .wew-switch-wrap .wew-switch span:after',
			]
		);

		$this->add_control(
			'controller_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-container .wew-switch-wrap .wew-switch span:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_labels_style',
            [
                'label' 		=> __('Labels', 'woovina-elementor-widgets'),
                'tab' 			=> Controls_Manager::TAB_STYLE,
            ]
       );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'labels_typography',
                'label' 		=> __('Typography', 'woovina-elementor-widgets'),
                'scheme' 		=> Typography::TYPOGRAPHY_4,
                'selector' 		=> '{{WRAPPER}} .wew-switch-container .wew-switch-wrap .wew-text',
            ]
       );

        $this->start_controls_tabs('tabs_labels_style');

        $this->start_controls_tab(
            'tab_primary_label',
            [
                'label' 		=> __('Primary', 'woovina-elementor-widgets'),
            ]
       );

        $this->add_control(
            'primary_label_color',
            [
                'label' 		=> __('Label Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-switch-container .wew-switch-wrap .wew-text.wew-primary' => 'color: {{VALUE}}',
                ],
            ]
       );

        $this->add_control(
            'active_primary_label_color',
            [
                'label' 		=> __('Active Label Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-switch-container .wew-switch-wrap.wew-switch-on .wew-text.wew-primary' => 'color: {{VALUE}}',
                ],
            ]
       );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_secondary_label',
            [
                'label' 		=> __('Secondary', 'woovina-elementor-widgets'),
            ]
       );

        $this->add_control(
            'secondary_label_color',
            [
                'label' 		=> __('Label Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-switch-container .wew-switch-wrap .wew-text.wew-secondary' => 'color: {{VALUE}}',
                ],
            ]
       );

        $this->add_control(
            'active_secondary_label_color',
            [
                'label' 		=> __('Active Label Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-switch-container .wew-switch-wrap.wew-switch-on .wew-text.wew-secondary' => 'color: {{VALUE}}',
                ],
            ]
       );

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' 		=> __('Content', 'woovina-elementor-widgets'),
                'tab' 			=> Controls_Manager::TAB_STYLE,
            ]
       );

		$this->add_control(
			'content_style_text',
			[
				'type' 			=> Controls_Manager::RAW_HTML,
                'raw' 			=> __('If Content type', 'woovina-elementor-widgets'),
			]
		);
        
        $this->add_responsive_control(
			'content_align',
			[
				'label' 		=> __('Alignment', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' => [
						'title' => __('Left', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-left',
					],
					'center'    => [
						'title' => __('Center', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-center',
					],
					'right' 	=> [
						'title' => __('Right', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' 		=> 'center',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-container' => 'text-align: {{VALUE}};',
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'content_typography',
                'label' 		=> __('Typography', 'woovina-elementor-widgets'),
                'scheme' 		=> Typography::TYPOGRAPHY_4,
                'selector' 		=> '{{WRAPPER}} .wew-switch-container .wew-switch-primary-wrap, {{WRAPPER}} .wew-switch-container .wew-switch-secondary-wrap',
            ]
       );

        $this->add_control(
            'content_color',
            [
                'label' 		=> __('Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-switch-container' => 'color: {{VALUE}}',
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
        
		$this->add_control(
			'image_style_text',
			[
				'type' 			=> Controls_Manager::RAW_HTML,
                'raw' 			=> __('If Image type', 'woovina-elementor-widgets'),
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' 		=> __('Width', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' 	=> [ '%', 'px', 'vw' ],
				'range' 		=> [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_space',
			[
				'label' 		=> __('Max Width', 'woovina-elementor-widgets') . ' (%)',
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
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
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-img img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label' 		=> __('Opacity', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'image_border',
				'selector' 		=> '{{WRAPPER}} .wew-switch-img img',
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-switch-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'image_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-switch-img img',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 				= $this->get_settings_for_display();

		// Vars
		$primary_type 			= $settings['primary_type'];
		$secondary_type 		= $settings['secondary_type'];
		$primary_templates 		= $settings['primary_template'];
		$secondary_templates 	= $settings['secondary_template'];

		$this->add_render_attribute('primary', 'class', 'wew-switch-primary-wrap');
		$this->add_render_attribute('secondary', 'class', 'wew-switch-secondary-wrap');

		if('image' == $primary_type) {
            $this->add_render_attribute('primary', 'class', 'wew-switch-img');
        }

		if('image' == $secondary_type) {
			$this->add_render_attribute('secondary', 'class', 'wew-switch-img');
        } ?>

		<div class="wew-switch-container">
			<div class="wew-switch-wrap">
	            <?php if($settings['primary_label']) { ?>
	                <div class="wew-text wew-primary">
	                    <?php echo esc_attr($settings['primary_label']); ?>
	                </div>
	            <?php } ?>
				<div class="wew-switch">
                    <label class="wew-switch-label">
                        <input type="checkbox">
                        <span></span>
                    </label>
                </div>
	            <?php if($settings['secondary_label']) { ?>
	                <div class="wew-text wew-secondary">
	                    <?php echo esc_attr($settings['secondary_label']); ?>
	                </div>
	            <?php } ?>
	        </div>

	        <div <?php echo $this->get_render_attribute_string('primary'); ?>>
	            <?php
	            // If content
                if('content' == $primary_type) {
                    echo $this->parse_text_editor($settings['primary_content']);
                }

                // If template
                elseif('template' == $primary_type) {
                	if('0' != $primary_templates && ! empty($primary_templates)) {
                        echo Plugin::instance()->frontend->get_builder_content_for_display($primary_templates);
                    }
                }

                // If image
                elseif('image' == $primary_type) {
                    echo Group_Control_Image_Size::get_attachment_image_html($settings, 'primary_image');
                } ?>
	        </div>

	        <div <?php echo $this->get_render_attribute_string('secondary'); ?>>
	            <?php
	            // If content
                if('content' == $secondary_type) {
                    echo $this->parse_text_editor($settings['secondary_content']);
                }

                // If template
                elseif('template' == $secondary_type) {
                	if('0' != $secondary_templates && ! empty($secondary_templates)) {
                        echo Plugin::instance()->frontend->get_builder_content_for_display($secondary_templates);
                    }
                }

                // If image
                elseif('image' == $secondary_type) {
                    echo Group_Control_Image_Size::get_attachment_image_html($settings, 'secondary_image');
                } ?>
	        </div>
        </div>

	<?php
	}

}