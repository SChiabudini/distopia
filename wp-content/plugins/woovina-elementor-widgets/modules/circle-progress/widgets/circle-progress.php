<?php
namespace wvnElementor\Modules\CircleProgress\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Circle_Progress extends Widget_Base {

	public function get_name() {
		return 'wew-circle-progress';
	}

	public function get_title() {
		return __('Circle Progress', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-counter-circle';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-circle-progress', 'appear', 'asPieProgress' ];
	}

	public function get_style_depends() {
		return [ 'wew-circle-progress' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_circle_progress',
			[
				'label' 		=> __('Circle Progress', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'goal',
			[
				'label' 		=> __('Percent', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '60',
			]
		);

		$this->add_control(
			'speed',
			[
				'label' 		=> __('Speed (s)', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '1',
			]
		);

		$this->add_control(
			'step',
			[
				'label' 		=> __('Steps', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '1',
			]
		);

		$this->add_control(
			'delay',
			[
				'label' 		=> __('Delay', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '1',
			]
		);

		$this->add_control(
			'text_before',
			[
				'label' 		=> __('Text Before', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'text_middle',
			[
				'label' 		=> __('Text Middle', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'text_after',
			[
				'label' 		=> __('Text After', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
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
            'content',
            [
                'label' 		=> __('Content', 'woovina-elementor-widgets'),
                'type' 			=> Controls_Manager::WYSIWYG,
                'default' 		=> __('Add your content here', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
            ]
       );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Circle Progress', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'barsize',
			[
				'label' 		=> __('Bar Size', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '4',
			]
		);

		$this->add_control(
			'barcap',
			[
				'label'   		=> __('Bar Cap', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'round',
				'options' 		=> [
					'round'   => __('Rounded', 'woovina-elementor-widgets'),
					'square'  => __('Square', 'woovina-elementor-widgets'),
					'butt'    => __('Butt', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'circle_outside_color',
			[
				'label'     	=> esc_html__('Circle Outside Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress svg ellipse' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'circle_inside_color',
			[
				'label'     	=> esc_html__('Circle Inside Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress svg path' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'circle_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_before_heading',
			[
				'label' 		=> __('Text Before', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'text_before_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress .wew-circle-progress-label .wew-circle-progress-before',
			]
		);

		$this->add_control(
			'text_before_color',
			[
				'label'     	=> esc_html__('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress .wew-circle-progress-label .wew-circle-progress-before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_before_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress .wew-circle-progress-label .wew-circle-progress-before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_middle_heading',
			[
				'label' 		=> __('Number/Text Middle', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'text_middle_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress .wew-circle-progress-label .wew-circle-progress-middle',
			]
		);

		$this->add_control(
			'text_middle_color',
			[
				'label'     	=> esc_html__('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress .wew-circle-progress-label .wew-circle-progress-middle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_middle_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress .wew-circle-progress-label .wew-circle-progress-middle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_after_heading',
			[
				'label' 		=> __('Text After', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'text_after_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress .wew-circle-progress-label .wew-circle-progress-after',
			]
		);

		$this->add_control(
			'text_after_color',
			[
				'label'     	=> esc_html__('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress .wew-circle-progress-label .wew-circle-progress-after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_after_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress .wew-circle-progress-label .wew-circle-progress-after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' 		=> __('Content', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress-content',
			]
		);

		$this->add_control(
			'content_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     	=> esc_html__('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'content_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress-content',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'content_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress-content',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-circle-progress-wrap .wew-circle-progress-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute('wrap', 'class', 'wew-circle-progress-wrap');
		
		$this->add_render_attribute('inner', 'class', [
			'wew-circle-progress',
			'pieProgress',
			'wew-cp-' . $settings['barcap'],
		]);

		$this->add_render_attribute('inner', 'role', 'progressbar');

		if(! empty($settings['goal'])) {
		    $this->add_render_attribute('inner', 'data-goal', $settings['goal']);
		}

		$this->add_render_attribute('inner', 'data-valuemin', '0');

		if(! empty($settings['speed'])) {
		    $this->add_render_attribute('inner', 'data-speed', $settings['speed'] * 15);
		}

		if(! empty($settings['step'])) {
		    $this->add_render_attribute('inner', 'data-step', $settings['step']);
		}

		if(! empty($settings['delay'])) {
		    $this->add_render_attribute('inner', 'data-delay', $settings['delay'] * 1000);
		}

		if(! empty($settings['barsize'])) {
		    $this->add_render_attribute('inner', 'data-barsize', intval($settings['barsize']));
		}

		$this->add_render_attribute('inner', 'data-valuemax', '100');

		$this->add_render_attribute('label', 'class', 'wew-circle-progress-label');
		$this->add_render_attribute('before', 'class', 'wew-circle-progress-before');
		$this->add_render_attribute('text', 'class', 'wew-circle-progress-middle');		
		$this->add_render_attribute('number', 'class', [
			'wew-circle-progress-number',
			'wew-circle-progress-middle',
		]);
		$this->add_render_attribute('after', 'class', 'wew-circle-progress-after');
		$this->add_render_attribute('content', 'class', 'wew-circle-progress-content'); ?>

		<div <?php echo $this->get_render_attribute_string('wrap'); ?>>
			<div <?php echo $this->get_render_attribute_string('inner'); ?>>
		    	<div <?php echo $this->get_render_attribute_string('label'); ?>>
					<?php
					if($settings['text_before']) { ?>
						<div <?php echo $this->get_render_attribute_string('before'); ?>><?php echo esc_html($settings['text_before']); ?></div>
					<?php
					}

					if($settings['text_middle']) { ?>
						<div <?php echo $this->get_render_attribute_string('text'); ?>><?php echo esc_html($settings['text_middle']); ?></div>
					<?php
					} else { ?>
						<div <?php echo $this->get_render_attribute_string('number'); ?>></div>
					<?php
					}

					if($settings['text_after']) { ?>
						<div <?php echo $this->get_render_attribute_string('after'); ?>><?php echo esc_html($settings['text_after']); ?></div>
					<?php
					} ?>
			    </div>
			</div>

			<?php
			if($settings['content']) { ?>
			    <div <?php echo $this->get_render_attribute_string('content'); ?>><?php echo esc_html($settings['content']); ?></div>
			<?php
			} ?>
					
		</div>

	<?php
	}

}