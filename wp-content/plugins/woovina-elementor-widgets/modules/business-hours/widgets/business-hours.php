<?php
namespace wvnElementor\Modules\BusinessHours\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;

class BusinessHours extends Widget_Base {

	public function get_name() {
		return 'wew-business-hours';
	}

	public function get_title() {
		return __('Business Hours', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-tel-field';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-business-hours' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_business_hours_settings',
			[
				'label' 		=> __('Business Hours', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'business_hours',
			[
				'label' 		=> '',
				'type' 			=> Controls_Manager::REPEATER,
				'default' 		=> [
					[
						'day' => 'Monday',
					],
					[
						'day' => 'Tuesday',
					],
					[
						'day' => 'Wednesday',
					],
				],
				'fields' 		=> [
                    [
                        'name' => 'day',
                        'label' => __('Day', 'woovina-elementor-widgets'),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'Monday',
                        'options' => [
                            'Monday'    => __('Monday', 'woovina-elementor-widgets'),
                            'Tuesday'   => __('Tuesday', 'woovina-elementor-widgets'),
                            'Wednesday' => __('Wednesday', 'woovina-elementor-widgets'),
                            'Thursday'  => __('Thursday', 'woovina-elementor-widgets'),
                            'Friday'    => __('Friday', 'woovina-elementor-widgets'),
                            'Saturday'  => __('Saturday', 'woovina-elementor-widgets'),
                            'Sunday'    => __('Sunday', 'woovina-elementor-widgets'),
                        ],
                    ],
                    [
                        'name' => 'closed',
                        'label' => __('Closed?', 'woovina-elementor-widgets'),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => 'no',
                        'label_on' => __('No', 'woovina-elementor-widgets'),
                        'label_off' => __('Yes', 'woovina-elementor-widgets'),
                        'return_value' => 'no',
                    ],
                    [
                        'name' => 'opening_hours',
                        'label' => __('Opening Hours', 'woovina-elementor-widgets'),
                        'type' => Controls_Manager::SELECT,
                        'default' => '08:00',
                        'options' => [
                            '00:00'    => '12:00 AM',
                            '00:30'    => '12:30 AM',
                            '01:00'    => '1:00 AM',
                            '01:30'    => '1:30 AM',
                            '02:00'    => '2:00 AM',
                            '02:30'    => '2:30 AM',
                            '03:00'    => '3:00 AM',
                            '03:30'    => '3:30 AM',
                            '04:00'    => '4:00 AM',
                            '04:30'    => '4:30 AM',
                            '05:00'    => '5:00 AM',
                            '05:30'    => '5:30 AM',
                            '06:00'    => '6:00 AM',
                            '06:30'    => '6:30 AM',
                            '07:00'    => '7:00 AM',
                            '07:30'    => '7:30 AM',
                            '08:00'    => '8:00 AM',
                            '08:30'    => '8:30 AM',
                            '09:00'    => '9:00 AM',
                            '09:30'    => '9:30 AM',
                            '10:00'    => '10:00 AM',
                            '10:30'    => '10:30 AM',
                            '11:00'    => '11:00 AM',
                            '11:30'    => '11:30 AM',
                            '12:00'    => '12:00 PM',
                            '12:30'    => '12:30 PM',
                            '13:00'    => '1:00 PM',
                            '13:30'    => '1:30 PM',
                            '14:00'    => '2:00 PM',
                            '14:30'    => '2:30 PM',
                            '15:00'    => '3:00 PM',
                            '15:30'    => '3:30 PM',
                            '16:00'    => '4:00 PM',
                            '16:30'    => '4:30 PM',
                            '17:00'    => '5:00 PM',
                            '17:30'    => '5:30 PM',
                            '18:00'    => '6:00 PM',
                            '18:30'    => '6:30 PM',
                            '19:00'    => '7:00 PM',
                            '19:30'    => '7:30 PM',
                            '20:00'    => '8:00 PM',
                            '20:30'    => '8:30 PM',
                            '21:00'    => '9:00 PM',
                            '21:30'    => '9:30 PM',
                            '22:00'    => '10:00 PM',
                            '22:30'    => '10:30 PM',
                            '23:00'    => '11:00 PM',
                            '23:30'    => '11:30 PM',
                            '24:00'    => '12:00 PM',
                            '24:30'    => '12:30 PM',
                        ],
                        'condition' => [
                            'closed' => 'no',
                        ],
                    ],
                    [
                        'name' => 'closing_hours',
                        'label' => __('Closing Hours', 'woovina-elementor-widgets'),
                        'type' => Controls_Manager::SELECT,
                        'default' => '19:00',
                        'options' => [
                            '00:00'    => '12:00 AM',
                            '00:30'    => '12:30 AM',
                            '01:00'    => '1:00 AM',
                            '01:30'    => '1:30 AM',
                            '02:00'    => '2:00 AM',
                            '02:30'    => '2:30 AM',
                            '03:00'    => '3:00 AM',
                            '03:30'    => '3:30 AM',
                            '04:00'    => '4:00 AM',
                            '04:30'    => '4:30 AM',
                            '05:00'    => '5:00 AM',
                            '05:30'    => '5:30 AM',
                            '06:00'    => '6:00 AM',
                            '06:30'    => '6:30 AM',
                            '07:00'    => '7:00 AM',
                            '07:30'    => '7:30 AM',
                            '08:00'    => '8:00 AM',
                            '08:30'    => '8:30 AM',
                            '09:00'    => '9:00 AM',
                            '09:30'    => '9:30 AM',
                            '10:00'    => '10:00 AM',
                            '10:30'    => '10:30 AM',
                            '11:00'    => '11:00 AM',
                            '11:30'    => '11:30 AM',
                            '12:00'    => '12:00 PM',
                            '12:30'    => '12:30 PM',
                            '13:00'    => '1:00 PM',
                            '13:30'    => '1:30 PM',
                            '14:00'    => '2:00 PM',
                            '14:30'    => '2:30 PM',
                            '15:00'    => '3:00 PM',
                            '15:30'    => '3:30 PM',
                            '16:00'    => '4:00 PM',
                            '16:30'    => '4:30 PM',
                            '17:00'    => '5:00 PM',
                            '17:30'    => '5:30 PM',
                            '18:00'    => '6:00 PM',
                            '18:30'    => '6:30 PM',
                            '19:00'    => '7:00 PM',
                            '19:30'    => '7:30 PM',
                            '20:00'    => '8:00 PM',
                            '20:30'    => '8:30 PM',
                            '21:00'    => '9:00 PM',
                            '21:30'    => '9:30 PM',
                            '22:00'    => '10:00 PM',
                            '22:30'    => '10:30 PM',
                            '23:00'    => '11:00 PM',
                            '23:30'    => '11:30 PM',
                            '24:00'    => '12:00 PM',
                            '24:30'    => '12:30 PM',
                        ],
                        'condition' => [
                            'closed' => 'no',
                        ],
                    ],
                    [
                        'name' => 'closed_text',
                        'label' => __('Closed Text', 'woovina-elementor-widgets'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'placeholder' => __('Closed', 'woovina-elementor-widgets'),
                        'default' => __('Closed', 'woovina-elementor-widgets'),
                        'condition' => [
                            'closed' => 'yes',
                        ],
                        'dynamic' => [ 'active' => true ],
                    ],
                    [
                        'name' => 'highlight',
                        'label' => __('Highlight', 'woovina-elementor-widgets'),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => 'no',
                        'return_value' => 'yes',
                    ],
                    [
                        'name' => 'highlight_bg',
                        'label' => __('Background Color', 'woovina-elementor-widgets'),
                        'type' => Controls_Manager::COLOR,
                        'condition' => [
                            'highlight' => 'yes',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .wew-business-hours .wew-business-hours-row{{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                        ],
                    ],
                    [
                        'name' => 'highlight_color',
                        'label' => __('Text Color', 'woovina-elementor-widgets'),
                        'type' => Controls_Manager::COLOR,
                        'condition' => [
                            'highlight' => 'yes',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .wew-business-hours .wew-business-hours-row{{CURRENT_ITEM}} .wew-business-day, {{WRAPPER}} .wew-business-hours .wew-business-hours-row{{CURRENT_ITEM}} .wew-business-timing' => 'color: {{VALUE}}',
                        ],
                    ]
				],
				'title_field' => '{{{ day }}}',
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

        $this->end_controls_section();

		$this->start_controls_section(
			'section_business_hours',
			[
				'label' 		=> __('Business Hours', 'woovina-elementor-widgets'),
			]
		);
        
        $this->add_control(
          'hours_format',
            [
                'label' 		=> __('24 Hours Format?', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SWITCHER,
                'default' 		=> 'no',
                'return_value' 	=> 'yes',
            ]
       );
        
        $this->add_control(
            'days_format',
            [
                'label' 		=> __('Days Format', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'long',
                'options' 		=> [
                    'long' 	=> __('Long', 'woovina-elementor-widgets'),
                    'short' => __('Short', 'woovina-elementor-widgets'),
                ],
            ]
       );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_rows_style',
            [
                'label' 		=> __('Rows', 'woovina-elementor-widgets'),
                'tab' 			=> Controls_Manager::TAB_STYLE,
            ]
       );
        
        $this->add_control(
          'stripes',
            [
                'label' 		=> __('Striped Rows', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SWITCHER,
                'default' 		=> 'no',
                'return_value' 	=> 'yes',
            ]
       );

        $this->start_controls_tabs('tabs_alternate_style');

        $this->start_controls_tab(
            'tab_even',
            [
                'label' 		=> __('Even Row', 'woovina-elementor-widgets'),
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
            ]
       );

        $this->add_control(
            'row_even_bg_color',
            [
                'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'default' 		=> '#fbfbfb',
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:nth-child(even)' => 'background-color: {{VALUE}}',
                ],
            ]
       );

        $this->add_control(
            'row_even_text_color',
            [
                'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:nth-child(even)' => 'color: {{VALUE}}',
                ],
            ]
       );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_odd',
            [
                'label' 		=> __('Odd Row', 'woovina-elementor-widgets'),
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
            ]
       );

        $this->add_control(
            'row_odd_bg_color',
            [
                'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'default' 		=> '#ffffff',
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:nth-child(odd)' => 'background-color: {{VALUE}}',
                ],
            ]
       );

        $this->add_control(
            'row_odd_text_color',
            [
                'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:nth-child(odd)' => 'color: {{VALUE}}',
                ],
            ]
       );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->start_controls_tabs('tabs_rows_style');

        $this->start_controls_tab(
            'tab_row_normal',
            [
                'label' 		=> __('Normal', 'woovina-elementor-widgets'),
                'condition' 	=> [
                    'stripes!' => 'yes',
                ],
            ]
       );

        $this->add_control(
            'row_bg_color_normal',
            [
                'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'stripes!' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row' => 'background-color: {{VALUE}}',
                ],
            ]
       );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_row_hover',
            [
                'label' 		=> __('Hover', 'woovina-elementor-widgets'),
                'condition' 	=> [
                    'stripes!' => 'yes',
                ],
            ]
       );

        $this->add_control(
            'row_bg_color_hover',
            [
                'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'stripes!' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:hover' => 'background-color: {{VALUE}}',
                ],
            ]
       );

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->add_responsive_control(
			'rows_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
                'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-business-hours .wew-business-hours-row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'rows_margin',
            [
                'label' 		=> __('Margin Bottom', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 80,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
       );
        
        $this->add_control(
            'closed_row_heading',
            [
                'label' 		=> __('Closed Row', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
       );

        $this->add_control(
            'closed_row_bg_color',
            [
                'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row.row-closed' => 'background-color: {{VALUE}}',
                ],
            ]
       );

        $this->add_control(
            'closed_row_day_color',
            [
                'label' 		=> __('Day Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row.row-closed .wew-business-day' => 'color: {{VALUE}}',
                ],
            ]
       );

        $this->add_control(
            'closed_row_tex_color',
            [
                'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row.row-closed .wew-business-timing' => 'color: {{VALUE}}',
                ],
            ]
       );
        
        $this->add_control(
            'divider_heading',
            [
                'label' 		=> __('Rows Divider', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
       );
        
        $this->add_control(
            'rows_divider_style',
            [
                'label' 		=> __('Divider Style', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'none',
                'options' 		=> [
                    'none'      => __('None', 'woovina-elementor-widgets'),
                    'solid'     => __('Solid', 'woovina-elementor-widgets'),
                    'dashed'    => __('Dashed', 'woovina-elementor-widgets'),
                    'dotted'    => __('Dotted', 'woovina-elementor-widgets'),
                    'groove'    => __('Groove', 'woovina-elementor-widgets'),
                    'ridge'     => __('Ridge', 'woovina-elementor-widgets'),
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:not(:last-child)' => 'border-bottom-style: {{VALUE}}',
                ],
            ]
       );

        $this->add_control(
            'rows_divider_color',
            [
                'label' 		=> __('Divider Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'rows_divider_style!' => 'none',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:not(:last-child)' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
       );
        
        $this->add_responsive_control(
            'rows_divider_weight',
            [
                'label' 		=> __('Divider Weight', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [ 'size' => 1 ],
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px' ],
                'condition' 	=> [
                    'rows_divider_style!' => 'none',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
            ]
       );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_table_style',
            [
                'label' 		=> __('Business Hours', 'woovina-elementor-widgets'),
                'tab' 			=> Controls_Manager::TAB_STYLE,
            ]
       );

        $this->start_controls_tabs('tabs_hours_style');

        $this->start_controls_tab(
            'tab_hours_normal',
            [
                'label' 		=> __('Normal', 'woovina-elementor-widgets'),
            ]
       );
        
        $this->add_control(
            'title_heading',
            [
                'label' 		=> __('Day', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
       );

        $this->add_control(
            'day_color',
            [
                'label' 		=> __('Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-day' => 'color: {{VALUE}}',
                ],
            ]
       );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'title_typography',
                'label' 		=> __('Typography', 'woovina-elementor-widgets'),
                'scheme' 		=> Typography::TYPOGRAPHY_4,
                'selector' 		=> '{{WRAPPER}} .wew-business-hours .wew-business-day',
            ]
       );
        
        $this->add_control(
            'hours_heading',
            [
                'label' 		=> __('Hours', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
       );

        $this->add_control(
            'hours_color',
            [
                'label' 		=> __('Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-timing' => 'color: {{VALUE}}',
                ],
            ]
       );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'hours_typography',
                'label' 		=> __('Typography', 'woovina-elementor-widgets'),
                'scheme' 		=> Typography::TYPOGRAPHY_4,
                'selector' 		=> '{{WRAPPER}} .wew-business-hours .wew-business-timing',
            ]
       );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_hours_hover',
            [
                'label' 		=> __('Hover', 'woovina-elementor-widgets'),
            ]
       );

        $this->add_control(
            'day_color_hover',
            [
                'label' 		=> __('Day Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:hover .wew-business-day' => 'color: {{VALUE}}',
                ],
            ]
       );

        $this->add_control(
            'hours_color_hover',
            [
                'label' 		=> __('Hours Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours .wew-business-hours-row:hover .wew-business-timing' => 'color: {{VALUE}}',
                ],
            ]
       );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_control(
            'icon_heading',
            [
                'label' 		=> __('Icon', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
                'condition' 	=> [
                    'icon!' => '',
                ],
            ]
       );

        $this->add_control(
            'icon_color',
            [
                'label' 		=> __('Icon Color', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'icon!' => '',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-business-hours i' => 'color: {{VALUE}}',
                ],
            ]
       );

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('business-hours', 'class', 'wew-business-hours');
        $i = 1; ?>

        <div <?php echo $this->get_render_attribute_string('business-hours'); ?>>
            <?php
            foreach($settings['business_hours'] as $index => $item) :

				$this->add_render_attribute('row' . $i, 'class', [
					'wew-business-hours-row',
					'clr',
					'elementor-repeater-item-' . esc_attr($item['_id']),
				]);

            	if('no' != $item['closed']) {
            		$this->add_render_attribute('row' . $i, 'class', 'row-closed');
                } ?>

                <div <?php echo $this->get_render_attribute_string('row' . $i); ?>>
                    <span class="wew-business-day">
                    	<?php
						if('' != $settings['icon']) { ?>
							<i class="<?php echo $settings['icon']; ?>"></i>
						<?php
						} ?>

                        <?php
                        if('long' == $settings['days_format']) {
                        	echo ucwords(esc_attr($item['day']));
                        } else {
                        	echo ucwords(esc_attr(substr($item['day'], 0, 3)));
                        } ?>
                    </span>

                    <span class="wew-business-timing">
                        <?php
                        if('no' == $item['closed']) { ?>
                            <span class="wew-opening-hours">
                                <?php
                                if('yes' == $settings['hours_format']) {
                                	echo esc_attr($item['opening_hours']);
                                } else {
                                	echo esc_attr(date("g:i A", strtotime($item['opening_hours'])));
                                } ?>
                            </span>
                            -
                            <span class="wew-closing-hours">
                                <?php
                                if('yes' == $settings['hours_format']) {
                                	echo esc_attr($item['closing_hours']);
                                } else {
                                	echo esc_attr(date("g:i A", strtotime($item['closing_hours'])));
                                } ?>
                            </span>
                        <?php
                    	} else {
                    		esc_attr_e('Closed', 'woovina-elementor-widgets');
                    	} ?>
                    </span>
                </div>

            <?php
            $i++;
        	endforeach; ?>
        </div>

	<?php
	}

	protected function _content_template() { ?>
		<#
        function wew_timeTo12HrFormat(time) {
            // Take a time in 24 hour format and format it in 12 hour format
            var time_part_array = time.split(":");
            var ampm = 'AM';

            if(time_part_array[0] >= 12) {
                ampm = 'PM';
            }

            if(time_part_array[0] > 12) {
                time_part_array[0] = time_part_array[0] - 12;
            }

            formatted_time = time_part_array[0] + ':' + time_part_array[1] + ' ' + ampm;

            return formatted_time;
        } #>

        <div class="wew-business-hours">
            <# _.each(settings.business_hours, function(item) {
            	var closed = (item.closed != 'no') ? 'row-closed' : ''; #>

                <div class="wew-business-hours-row clr elementor-repeater-item-{{ item._id }} {{ closed }}">
                    <span class="wew-business-day">
                        <# if('' != settings.icon) { #>
                            <i class="{{ settings.icon }}"></i>
                        <# } #>

                        <# if('long' == settings.days_format) { #>
                            {{ item.day }}
                        <# } else { #>
                            {{ item.day.substring(0,3) }}
                        <# } #>
                    </span>

                    <span class="wew-business-timing">
                        <# if('no' == item.closed) { #>
                            <span class="wew-opening-hours">
                                <# if('yes' == settings.hours_format) { #>
                                    {{ item.opening_hours }}
                                <# } else { #>
                                    {{ wew_timeTo12HrFormat(item.opening_hours) }}
                                <# } #>
                            </span>
                            -
                            <span class="wew-closing-hours">
                                <# if('yes' == settings.hours_format) { #>
                                    {{ item.closing_hours }}
                                <# } else { #>
                                    {{ wew_timeTo12HrFormat(item.closing_hours) }}
                                <# } #>
                            </span>
                        <# } else { #>
                            <?php esc_attr_e('Closed', 'woovina-elementor-widgets'); ?>
                        <# } #>
                    </span>
                </div>

            <# }); #>
        </div>
	<?php
	}

}