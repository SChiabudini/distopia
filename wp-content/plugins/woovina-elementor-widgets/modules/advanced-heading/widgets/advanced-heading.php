<?php
namespace wvnElementor\Modules\AdvancedHeading\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class AdvancedHeading extends Widget_Base {

	public function get_name() {
		return 'wew-advanced-heading';
	}

	public function get_title() {
		return __('Advanced Heading', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-type-tool';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-advanced-heading' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_advanced_heading',
			[
				'label' 		=> __('Heading', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'main_heading',
			[
				'label'       	=> __('Heading', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXTAREA,
				'default'     	=> __('Advanced Heading', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'sub_heading',
			[
				'label'       	=> __('Sub Heading', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __('Your Sub Heading Here', 'woovina-elementor-widgets'),
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       	=> __('Link', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::URL,
				'placeholder' 	=> 'http://your-link.com',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'   		=> __('HTML Tag', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'h2',
				'options' 		=> wew_get_available_tags(),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'   		=> __('Alignment', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::CHOOSE,
				'options' 		=> [
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
				'default' 		=> 'center',
				'prefix_class' 	=> 'elementor-align%s-',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_background_heading',
			[
				'label' 		=> __('Background Heading', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'background_heading',
			[
				'label'       	=> __('Background Heading', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXTAREA,
				'default'     	=> __('Background Heading', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'background_heading_hide',
			[
				'label'       	=> __('Hide On', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::SELECT,
				'default'     	=> 'tm',
				'options'     	=> [
					'never' => __('Never', 'woovina-elementor-widgets'),
					'tm' 	=> __('Tablet and Mobile ', 'woovina-elementor-widgets'),
					'm' 	=> __('Mobile', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_responsive_control(
			'background_heading_align',
			[
				'label'   		=> __('Alignment', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::CHOOSE,
				'options' 		=> [
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
				'prefix_class' => 'wew%s-background-heading-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_heading',
			[
				'label'     	=> __('Heading', 'woovina-elementor-widgets'),
				'tab'       	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'main_heading!' => '',
				]
			]
		);

		$this->add_control(
			'main_heading_advanced_color',
			[
				'label'        	=> __('Advanced Style', 'woovina-elementor-widgets'),
				'type'         	=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'main_heading_color',
			[
				'label'     	=> __('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-advanced-heading .wew-main-heading' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'main_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      	=> 'main_heading_advanced_color',
				'types'     	=> [ 'classic', 'gradient' ],
				'selector'  	=> '{{WRAPPER}} .wew-advanced-heading .wew-main-heading > div',
				'condition' 	=> [
					'main_heading_advanced_color' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'main_heading_typography',
				'scheme'   		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-advanced-heading .wew-main-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     		=> 'main_heading_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-advanced-heading .wew-main-heading',
			]
		);

		$this->add_control(
			'main_heading_margin',
			[
				'label'      => __('Margin', 'woovina-elementor-widgets'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wew-advanced-heading .wew-main-heading > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'main_heading_line',
			[
				'label'        	=> __('Add Line', 'woovina-elementor-widgets'),
				'type'         	=> Controls_Manager::SWITCHER,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'main_heading_line_color',
			[
				'label'     	=> __('Line Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-advanced-heading .wew-main-line:after' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_line_width',
			[
				'label' 		=> __('Width', 'woovina-elementor-widgets'),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min'  => 1,
						'max'  => 200,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-advanced-heading .wew-main-line:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_line_height',
			[
				'label' 		=> __('Height', 'woovina-elementor-widgets'),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min'  => 1,
						'max'  => 48,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-advanced-heading .wew-main-line:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_control(
			'main_heading_line_align',
			[
				'label'   		=> __('Line Position', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'bottom',
				'options' 		=> [
					'left'       => __('Before', 'woovina-elementor-widgets'),
					'right'      => __('After', 'woovina-elementor-widgets'),
					'left-right' => __('Before and After', 'woovina-elementor-widgets'),
					'bottom'     => __('Bottom', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_line_indent',
			[
				'label'   		=> __('Line Spacing', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 8,
				],
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
					'main_heading_line' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-advanced-heading .wew-main-line.wew-line-align-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-advanced-heading .wew-main-line.wew-line-align-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-advanced-heading .wew-main-line.wew-line-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sub_heading',
			[
				'label'     	=> __('Sub Heading', 'woovina-elementor-widgets'),
				'tab'       	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'sub_heading!' => '',
				]
			]
		);

		$this->add_control(
			'sub_heading_advanced_color',
			[
				'label' 		=> __('Advanced Style', 'woovina-elementor-widgets'),
				'type'         	=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label'     	=> __('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-advanced-heading .wew-sub-heading' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'sub_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      	=> 'sub_heading_advanced_color',
				'types'     	=> [ 'classic', 'gradient' ],
				'selector'  	=> '{{WRAPPER}} .wew-advanced-heading .wew-sub-heading > div',
				'condition' 	=> [
					'sub_heading_advanced_color' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'sub_heading_typography',
				'scheme'   		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-advanced-heading .wew-sub-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     		=> 'sub_heading_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-advanced-heading .wew-sub-heading',
			]
		);

		$this->add_control(
			'sub_heading_margin',
			[
				'label'      => __('Margin', 'woovina-elementor-widgets'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wew-advanced-heading .wew-sub-heading > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'sub_heading_line',
			[
				'label'        	=> __('Add Line', 'woovina-elementor-widgets'),
				'type'         	=> Controls_Manager::SWITCHER,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'sub_heading_line_color',
			[
				'label'     	=> __('Line Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-advanced-heading .wew-sub-line:after' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_line_width',
			[
				'label' 		=> __('Width', 'woovina-elementor-widgets'),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min'  => 1,
						'max'  => 200,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-advanced-heading .wew-sub-line:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_line_height',
			[
				'label' 		=> __('Height', 'woovina-elementor-widgets'),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min'  => 1,
						'max'  => 48,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-advanced-heading .wew-sub-line:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_control(
			'sub_heading_line_align',
			[
				'label'   		=> __('Line Position', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'bottom',
				'options' 		=> [
					'left'       => __('Before', 'woovina-elementor-widgets'),
					'right'      => __('After', 'woovina-elementor-widgets'),
					'left-right' => __('Before and After', 'woovina-elementor-widgets'),
					'bottom'     => __('Bottom', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_line_indent',
			[
				'label'   		=> __('Line Spacing', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 8,
				],
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
					'sub_heading_line' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-advanced-heading .wew-sub-line.wew-line-align-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-advanced-heading .wew-sub-line.wew-line-align-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-advanced-heading .wew-sub-line.wew-line-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_background_heading',
			[
				'label'     	=> __('Background Heading', 'woovina-elementor-widgets'),
				'tab'       	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'background_heading!' => '',
				]
			]
		);

		$this->add_control(
			'background_heading_advanced_color',
			[
				'label'        	=> __('Advanced Style', 'woovina-elementor-widgets'),
				'type'         	=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background_heading_advanced_color',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .wew-advanced-heading .wew-background-heading > div',
				'condition' => [
					'background_heading_advanced_color' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_heading_color',
			[
				'label'     => __('Color', 'woovina-elementor-widgets'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wew-advanced-heading .wew-background-heading > div' => 'color: {{VALUE}};',
				],
				'condition' => [
					'background_heading_advanced_color!' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'background_heading_background_color',
			[
				'label'     => __('Background Color', 'woovina-elementor-widgets'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wew-advanced-heading .wew-background-heading > div' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'background_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_heading_padding',
			[
				'label'      => __('Padding', 'woovina-elementor-widgets'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wew-advanced-heading .wew-background-heading > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'background_heading_typography',
				'scheme'    => Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .wew-advanced-heading .wew-background-heading > div',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'background_heading_shadow',
				'selector' => '{{WRAPPER}} .wew-advanced-heading .wew-background-heading > div',
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'background_heading_border',
				'label'       => __('Border', 'woovina-elementor-widgets'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .wew-advanced-heading .wew-background-heading > div',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'background_heading_border_radius',
			[
				'label'      => __('Border Radius', 'woovina-elementor-widgets'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wew-advanced-heading .wew-background-heading > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'background_heading_box_shadow',
				'selector' => '{{WRAPPER}} .wew-advanced-heading .wew-background-heading > div',
			]
		);

		$this->add_control(
			'background_heading_opacity',
			[
				'label' => __('Opacity', 'woovina-elementor-widgets'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0.05,
						'max'  => 1,
						'step' => 0.05,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wew-advanced-heading .wew-background-heading > div' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$title_tag  = $settings['title_html_tag'];
		$hide  		= $settings['background_heading_hide'];
		$main_line  = $settings['main_heading_line_align'];
		$sub_line  	= $settings['sub_heading_line_align'];

		$this->add_render_attribute('wrap', 'class', 'wew-advanced-heading');

		$this->add_render_attribute('background-heading', 'class', 'wew-background-heading');

		if('never' != $hide) {
			$this->add_render_attribute('background-heading', 'class', 'wew-hide-' . $hide);
		}

		if('yes' == $settings['background_heading_advanced_color']) {
			$this->add_render_attribute('background-heading', 'class', 'wew-has-bg');
		}

		$this->add_render_attribute('main-heading', 'class', 'wew-main-heading');

		if('yes' == $settings['main_heading_advanced_color']) {
			$this->add_render_attribute('main-heading', 'class', 'wew-has-bg');
		}

		$this->add_render_attribute('sub-heading', 'class', 'wew-sub-heading');

		if('yes' == $settings['sub_heading_advanced_color']) {
			$this->add_render_attribute('sub-heading', 'class', 'wew-has-bg');
		}

		if(! empty($settings['link']['url'])) {
			$this->add_render_attribute('heading', 'href', $settings['link']['url']);

			if($settings['link']['is_external']) {
				$this->add_render_attribute('heading', 'target', '_blank');
			}

			if(! empty($settings['link']['nofollow'])) {
				$this->add_render_attribute('heading', 'rel', 'nofollow');
			}

			$title_tag = 'a';
		} ?>

		<div <?php echo $this->get_render_attribute_string('wrap'); ?>>

			<?php
			if(! empty($settings['background_heading'])) { ?>
				<div <?php echo $this->get_render_attribute_string('background-heading'); ?>>
					<div><?php echo $settings['background_heading']; ?></div>
				</div>
			<?php
			}

			if(! empty($settings['main_heading'])) { ?>
				<<?php echo $title_tag; ?> <?php echo $this->get_render_attribute_string('main-heading'); ?>>
					<div>
						<?php echo $settings['main_heading']; ?>

						<?php
						if('yes' == $settings['main_heading_line']) {
							if('left-right' == $main_line) { ?>
								<div class="wew-line wew-main-line wew-line-align-left"></div><div class="wew-line wew-main-line wew-line-align-right"></div>
							<?php
							} else { ?>
								<div class="wew-line wew-main-line wew-line-align-<?php echo esc_attr($main_line); ?>"></div>
							<?php
							}
						} ?>
					</div>
				</<?php echo $title_tag; ?>>
			<?php
			}

			if(! empty($settings['sub_heading'])) { ?>
				<div <?php echo $this->get_render_attribute_string('sub-heading'); ?>>
					<div>
						<?php echo $settings['sub_heading']; ?>

						<?php
						if('yes' == $settings['sub_heading_line']) {
							if('left-right' == $sub_line) { ?>
								<div class="wew-line wew-sub-line wew-line-align-left"></div><div class="wew-line wew-sub-line wew-line-align-right"></div>
							<?php
							} else { ?>
								<div class="wew-line wew-sub-line wew-line-align-<?php echo esc_attr($sub_line); ?>"></div>
							<?php
							}
						} ?>
					</div>
				</div>
			<?php
			} ?>

		</div>

	<?php
	}

	protected function _content_template() { ?>
		<#
		view.addRenderAttribute('background-heading', 'class', 'wew-background-heading');

		if('never' != settings.background_heading_hide) {
			view.addRenderAttribute('background-heading', 'class', 'wew-hide-' + settings.background_heading_hide);
		}

		if('yes' == settings.background_heading_advanced_color) {
			view.addRenderAttribute('background-heading', 'class', 'wew-has-bg');
		}

		var tag = settings.title_html_tag;
		view.addRenderAttribute('main-heading', 'class', 'wew-main-heading');

		if('yes' == settings.main_heading_advanced_color) {
			view.addRenderAttribute('main-heading', 'class', 'wew-has-bg');
		}

		if('' !== settings.link.url) {
			tag = 'a';
			view.addRenderAttribute('main-heading', 'href', settings.link.url);
		}
		
		view.addRenderAttribute('sub-heading', 'class', 'wew-sub-heading');

		if('yes' == settings.sub_heading_advanced_color) {
			view.addRenderAttribute('sub-heading', 'class', 'wew-has-bg');
		} #>

		<div class="wew-advanced-heading">

			<# if(settings.background_heading) { #>
				<div {{{ view.getRenderAttributeString('background-heading') }}}>
					<div>{{{ settings.background_heading }}}</div>
				</div>
			<# }

			if(settings.main_heading) { #>
				<{{ tag }} {{{ view.getRenderAttributeString('main-heading') }}}>
					<div>
						{{{ settings.main_heading }}}

						<# if('yes' == settings.main_heading_line) {
							if('left-right' == settings.main_heading_line_align) { #>
								<div class="wew-line wew-main-line wew-line-align-left"></div><div class="wew-line wew-main-line wew-line-align-right"></div>
							<# } else { #>
								<div class="wew-line wew-main-line wew-line-align-{{ settings.main_heading_line_align }}"></div>
							<# }
						} #>
					</div>
				</{{ tag }}>
			<# }

			if(settings.sub_heading) { #>
				<div {{{ view.getRenderAttributeString('sub-heading') }}}>
					<div>
						{{{ settings.sub_heading }}}

						<# if('yes' == settings.sub_heading_line) {
							if('left-right' == settings.sub_heading_line_align) { #>
								<div class="wew-line wew-sub-line wew-line-align-left"></div><div class="wew-line wew-sub-line wew-line-align-right"></div>
							<# } else { #>
								<div class="wew-line wew-sub-line wew-line-align-{{ settings.sub_heading_line_align }}"></div>
							<# }
						} #>
					</div>
				</div>

			<# } #>

		</div>

	<?php
	}
}