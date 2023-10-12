<?php
namespace wvnElementor\Modules\AnimatedHeading\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class AnimatedHeading extends Widget_Base {

	public function get_name() {
		return 'wew-animated-heading';
	}

	public function get_title() {
		return __('Animated Heading', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-animated-headline';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'morphext', 'typed' ];
	}

	public function get_style_depends() {
		return [ 'wew-animated-heading' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_animated_heading',
			[
				'label' 		=> __('Heading', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'heading_layout',
			[
				'label'   		=> __('Layout', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'animated',
				'options' 		=> [
					'animated' => __('Animated', 'woovina-elementor-widgets'),
					'typed'    => __('Typed', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'pre_heading',
			[
				'label'       	=> __('Pre Heading', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXTAREA,
				'default'     	=> __('This is an', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Enter your prefix heading', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'animated_heading',
			[
				'label'       	=> __('Heading', 'woovina-elementor-widgets'),
				'description' 	=> __('Write animated heading here with comma separated. Such as Animated, Morphing, Awesome', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXTAREA,
				'default'     	=> __('Animated, Amazing, Awesome', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Enter your animated heading', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'post_heading',
			[
				'label'       	=> __('Post Heading', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXTAREA,
				'default'     	=> __('Heading', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Enter your suffix heading', 'woovina-elementor-widgets'),
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
				'options' 		=> wew_get_available_tags(),
				'default' 		=> 'h2',
				'condition' 	=> [
					'link[url]' => '',
				],
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
				'default'      	=> 'center',
				'prefix_class' 	=> 'elementor-align%s-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation',
			[
				'label'     	=> __('Animation Options', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'heading_animation!' => '',
				],
			]
		);

		$this->add_control(
			'heading_animation',
			[
				'label'       	=> __('Animation', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::ANIMATION,
				'default'     	=> 'fadeIn',
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'animated',
				],
			]
		);

		$this->add_control(
			'heading_animation_duration',
			[
				'label'   		=> __('Duration', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					''     => __('Normal', 'woovina-elementor-widgets'),
					'slow' => __('Slow', 'woovina-elementor-widgets'),
					'fast' => __('Fast', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'animated',
				],
			]
		);

		$this->add_control(
			'heading_animation_delay',
			[
				'label'     	=> __('Delay (ms)', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 2500,
				'min'       	=> 100,
				'max'       	=> 7000,
				'step'      	=> 100,
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'animated',
				],
			]
		);

		$this->add_control(
			'type_speed',
			[
				'label'     	=> __('Type Speed', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 50,
				'min'       	=> 10,
				'max'       	=> 100,
				'step'      	=> 5,
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->add_control(
			'start_delay',
			[
				'label'     	=> __('Start Delay', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 1,
				'min'       	=> 1,
				'max'       	=> 100,
				'step'      	=> 1,
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->add_control(
			'back_speed',
			[
				'label'     	=> __('Back Speed', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 30,
				'min'       	=> 0,
				'max'       	=> 100,
				'step'      	=> 2,
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->add_control(
			'back_delay',
			[
				'label'     	=> __('Back Delay', 'woovina-elementor-widgets') . ' (ms)',
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 500,
				'min'       	=> 0,
				'max'       	=> 3000,
				'step'      	=> 50,
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label'     	=> __('Loop', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::SWITCHER,
				'default'   	=> 'yes',
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->add_control(
			'loop_count',
			[
				'label'     	=> __('Loop Count', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 0,
				'min'       	=> 0,
				'condition' 	=> [
					'loop' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_pre_heading',
			[
				'label'     	=> __('Pre Heading', 'woovina-elementor-widgets'),
				'tab'       	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'pre_heading!' => '',
				]
			]
		);

		$this->add_control(
			'pre_heading_color',
			[
				'label'     	=> __('Pre Heading Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-heading-wrap .wew-pre-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'pre_heading_typography',
				'scheme'   		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-heading-wrap .wew-pre-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     		=> 'pre_heading_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-heading-wrap .wew-pre-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_animated_heading',
			[
				'label' 		=> __('Animated Heading', 'woovina-elementor-widgets'),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'animated_heading_color',
			[
				'label'     	=> __('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-heading-wrap .wew-heading-tag' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'animated_heading_typography',
				'scheme'   		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-heading-wrap .wew-heading-tag',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     		=> 'animated_heading_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-heading-wrap .wew-heading-tag',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_post_heading',
			[
				'label'     	=> __('Post Heading', 'woovina-elementor-widgets'),
				'tab'       	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'post_heading!' => '',
				]
			]
		);

		$this->add_control(
			'post_heading_color',
			[
				'label'     	=> __('Post Heading Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-heading-wrap .wew-post-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'post_heading_typography',
				'scheme'   		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-heading-wrap .wew-post-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     		=> 'post_heading_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-heading-wrap .wew-post-heading',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$id         = $this->get_id();
		$title_tag  = $settings['title_html_tag'];

		$this->add_render_attribute('heading', 'class', 'wew-heading-tag');

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

		<div id="wew-animated-heading-<?php echo esc_attr($id); ?>" class="wew-heading-wrap">
			<<?php echo $title_tag; ?> <?php echo $this->get_render_attribute_string('heading'); ?>>

				<?php
				if($settings['pre_heading']) { ?>
					<div class="wew-pre-heading"><?php echo esc_attr($settings['pre_heading']); ?></div>
				<?php
				}

				if($settings['animated_heading']
					&& 'animated' == $settings['heading_layout']) {
					$animation_duration = ($settings['heading_animation_duration']) ? ' wew-animated-'. $settings['heading_animation_duration'] : ''; ?>
			   		<div class="wew-animated-heading<?php echo esc_attr($animation_duration); ?>">
			   			<?php echo rtrim(esc_attr($settings['animated_heading']), ','); ?>
			   		</div>
				<?php
				} else if($settings['animated_heading']
					&&  'typed' == $settings['heading_layout']) { ?>
					<div class="wew-animated-heading"></div>
				<?php
				}

				if($settings['post_heading']) { ?>
					<div class="wew-post-heading"><?php echo esc_attr($settings['post_heading']); ?></div>
				<?php
				} ?>

			</<?php echo $title_tag; ?>>
		</div>

		<?php
		$type_heading = explode(',', esc_html($settings['animated_heading']));

		if($settings['animated_heading']) { ?>
			<script>
				jQuery(document).ready(function($) {
		    		"use strict";

		    		<?php if('animated' == $settings['heading_layout']) { ?>
						$('#wew-animated-heading-<?php echo esc_attr($id); ?> .wew-animated-heading').Morphext({
						    animation 	: '<?php echo esc_attr($settings['heading_animation']); ?>',
						    speed 		: <?php echo esc_attr($settings['heading_animation_delay']); ?>,
						});
					<?php } else if('typed' == $settings['heading_layout']) { ?>
						var typed 		= new Typed('#wew-animated-heading-<?php echo esc_attr($id); ?> .wew-animated-heading', {
							strings 	: <?php echo json_encode($type_heading); ?>,
							typeSpeed 	: <?php echo esc_attr($settings['type_speed']); ?>,
							startDelay 	: <?php echo esc_attr($settings['start_delay']); ?>,
							backSpeed 	: <?php echo esc_attr($settings['back_speed']); ?>,
							backDelay 	: <?php echo esc_attr($settings['back_delay']); ?>,
							loop 		: <?php echo ('yes' == $settings['loop']) ? 'true' : 'false'; ?>,
							loopCount 	: <?php echo ($settings['loop_count']) ? esc_attr($settings['loop_count']) : 0; ?>,
						});
					<?php } ?>

				});
			</script>
		<?php
		}

	}
}