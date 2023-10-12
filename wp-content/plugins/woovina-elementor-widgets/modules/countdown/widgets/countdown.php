<?php
namespace wvnElementor\Modules\Countdown\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Utils;

class Countdown extends Widget_Base {

	public function get_name() {
		return 'wew-countdown';
	}

	public function get_title() {
		return __('Countdown', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-countdown';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-countdown' ];
	}

	public function get_style_depends() {
		return [ 'wew-countdown' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_countdown',
			[
				'label' 		=> __('Countdown', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'due_date',
			[
				'label'       	=> __('Due Date', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::DATE_TIME,
				'default'     	=> date('Y-m-d H:i', strtotime('+1 month') + (get_option('gmt_offset') * HOUR_IN_SECONDS)),
				'description' 	=> sprintf(__('Date set according to your timezone: %s.', 'woovina-elementor-widgets'), Utils::get_timezone_string()),
			]
		);

		$this->add_control(
			'label_display',
			[
				'label'   		=> __('View', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'options' 		=> [
					'block'  => __('Block', 'woovina-elementor-widgets'),
					'inline' => __('Inline', 'woovina-elementor-widgets'),
				],
				'default'      	=> 'block',
				'prefix_class' 	=> 'wew-countdown-label-',
			]
		);

		$this->add_control(
			'show_days',
			[
				'label'   		=> __('Days', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_hours',
			[
				'label'   		=> __('Hours', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_minutes',
			[
				'label'   		=> __('Minutes', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				]
		);

		$this->add_control(
			'show_seconds',
			[
				'label'   		=> __('Seconds', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label'   		=> __('Show Label', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'custom_labels',
			[
				'label'        	=> __('Custom Label', 'woovina-elementor-widgets'),
				'type'         	=> Controls_Manager::SWITCHER,
				'return_value' 	=> 'yes',
				'condition'    	=> [
					'show_labels!' => '',
				],
			]
		);

		$this->add_control(
			'label_days',
			[
				'label'       	=> __('Days', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __('Days', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Days', 'woovina-elementor-widgets'),
				'condition'   	=> [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_days'      => 'yes',
				],
				'dynamic' 	  	=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'label_hours',
			[
				'label'       	=> __('Hours', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __('Hours', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Hours', 'woovina-elementor-widgets'),
				'condition'   	=> [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_hours'     => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'label_minutes',
			[
				'label'       	=> __('Minutes', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __('Minutes', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Minutes', 'woovina-elementor-widgets'),
				'condition'   	=> [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_minutes'   => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'label_seconds',
			[
				'label'       	=> __('Seconds', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __('Seconds', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Seconds', 'woovina-elementor-widgets'),
				'condition'   	=> [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_seconds'   => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			[
				'label' 		=> __('Additional Options', 'woovina-elementor-widgets'),
			]
		);

		$this->add_responsive_control(
			'container_width',
			[
				'label'   		=> __('Container Width', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SLIDER,
				'default' 		=> [
					'unit' => '%',
					'size' => 80,
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' 	=> [ '%', 'px' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-countdown-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' 		=> __('Alignment', 'woovina-elementor-widgets'),
				'type'         	=> Controls_Manager::CHOOSE,
				'default'      	=> 'center',
				'options'      	=> [
					'left' => [
						'title' => __('Left', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-right',
					],
				],
				'prefix_class'	=> 'wew-countdown-align-'
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' 		=> __('Columns', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '4',
				'tablet_default' => '2',
				'mobile_default' => '2',
				'options' 		=> [
					'1' => __('1', 'woovina-elementor-widgets'),
					'2' => __('2', 'woovina-elementor-widgets'),
					'3' => __('3', 'woovina-elementor-widgets'),
					'4' => __('4', 'woovina-elementor-widgets'),
				],
				'prefix_class'	=> 'wew%s-countdown-column-'
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Boxes', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'boxes_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'boxes_spacing',
			[
				'label' 		=> __('Space Between', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-item-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'boxes_border',
				'selector' 		=> '{{WRAPPER}} .wew-countdown-wrap .wew-countdown-item',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'boxes_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'boxes_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-countdown-wrap .wew-countdown-item',
			]
		);

		$this->add_responsive_control(
			'boxes_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_numbers_style',
			[
				'label' 		=> __('Numbers', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'numbers_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-countdown-wrap .wew-countdown-number',
			]
		);

		$this->add_control(
			'numbers_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-number' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'numbers_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'numbers_border',
				'selector' 		=> '{{WRAPPER}} .wew-countdown-wrap .wew-countdown-number',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'numbers_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'numbers_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-countdown-wrap .wew-countdown-number',
			]
		);

		$this->add_responsive_control(
			'numbers_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-countdown-wrap .wew-countdown-label',
			]
		);

		$this->add_control(
			'labels_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-label' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'labels_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'labels_border',
				'selector' 		=> '{{WRAPPER}} .wew-countdown-wrap .wew-countdown-label',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'labels_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'labels_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-countdown-wrap .wew-countdown-label',
			]
		);

		$this->add_responsive_control(
			'labels_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'labels_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-countdown-wrap .wew-countdown-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

	}

	private function get_strftime($instance) {
		$string = '';
		if($instance['show_days']) {
			$string .= $this->render_countdown_item($instance, 'label_days', 'wew-countdown-days');
		}
		if($instance['show_hours']) {
			$string .= $this->render_countdown_item($instance, 'label_hours', 'wew-countdown-hours');
		}
		if($instance['show_minutes']) {
			$string .= $this->render_countdown_item($instance, 'label_minutes', 'wew-countdown-minutes');
		}
		if($instance['show_seconds']) {
			$string .= $this->render_countdown_item($instance, 'label_seconds', 'wew-countdown-seconds');
		}

		return $string;
	}

	private $_default_countdown_labels;

	private function _init_default_countdown_labels() {
		$this->_default_countdown_labels = [
			'label_months' => __('Months', 'woovina-elementor-widgets'),
			'label_weeks' => __('Weeks', 'woovina-elementor-widgets'),
			'label_days' => __('Days', 'woovina-elementor-widgets'),
			'label_hours' => __('Hours', 'woovina-elementor-widgets'),
			'label_minutes' => __('Minutes', 'woovina-elementor-widgets'),
			'label_seconds' => __('Seconds', 'woovina-elementor-widgets'),
		];
	}

	public function get_default_countdown_labels() {
		if(! $this->_default_countdown_labels) {
			$this->_init_default_countdown_labels();
		}

		return $this->_default_countdown_labels;
	}

	private function render_countdown_item($instance, $label, $part_class) {
		$string = '<div class="wew-countdown-item-wrap"><div class="wew-countdown-item"><span class="wew-countdown-number ' . $part_class . '"></span>';

		if($instance['show_labels']) {
			$default_labels = $this->get_default_countdown_labels();
			$label = ($instance['custom_labels']) ? $instance[ $label ] : $default_labels[ $label ];
			$string .= ' <span class="wew-countdown-label">' . $label . '</span>';
		}

		$string .= '</div></div>';

		return $string;
	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$due_date  	= $settings['due_date'];
		$string    	= $this->get_strftime($settings);

		// Handle timezone (we need to set GMT time)
		$gmt 		= get_gmt_from_date($due_date . ':00');
		$due_date 	= strtotime($gmt);
		
		$this->add_render_attribute('wrap', 'class', 'wew-countdown-wrap');
		$this->add_render_attribute('wrap', 'data-date', $due_date); ?>

		<div <?php echo $this->get_render_attribute_string('wrap'); ?>>
			<?php echo $string; ?>
		</div>

	<?php
	}

}