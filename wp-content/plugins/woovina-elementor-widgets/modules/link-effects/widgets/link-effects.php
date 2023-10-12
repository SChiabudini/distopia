<?php
namespace wvnElementor\Modules\LinkEffects\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Link_Effects extends Widget_Base {

	public function get_name() {
		return 'wew-link-effects';
	}

	public function get_title() {
		return __('Link Effects', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-anchor';
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
        return [ 'wew-link-effects', $styles ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_link_effects',
			[
				'label' 		=> __('Link Effects', 'woovina-elementor-widgets'),
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
			'second_text',
			[
				'label' 		=> __('Secondary Text', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __('Click me', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Click me', 'woovina-elementor-widgets'),
                'condition' 	=> [
                    'effect' => 'effect-9',
                ],
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
                   'effect-1'  => __('Brackets', 'woovina-elementor-widgets'),
                   'effect-2'  => __('3D rolling links', 'woovina-elementor-widgets'),
                   'effect-3'  => __('Bottom line slides/fades in', 'woovina-elementor-widgets'),
                   'effect-4'  => __('Bottom border enlarge', 'woovina-elementor-widgets'),
                   'effect-5'  => __('Same word slide in', 'woovina-elementor-widgets'),
                   'effect-6'  => __('Same word slide in and border bottom', 'woovina-elementor-widgets'),
                   'effect-7'  => __('Second border slides up', 'woovina-elementor-widgets'),
                   'effect-8'  => __('Border slight translate', 'woovina-elementor-widgets'),
                   'effect-9'  => __('Second text and borders', 'woovina-elementor-widgets'),
                   'effect-10' => __('Reveal, push out', 'woovina-elementor-widgets'),
                   'effect-11' => __('Text Fill', 'woovina-elementor-widgets'),
                   'effect-12' => __('Circle', 'woovina-elementor-widgets'),
                   'effect-13' => __('Three circles', 'woovina-elementor-widgets'),
                   'effect-14' => __('Border switch', 'woovina-elementor-widgets'),
                   'effect-15' => __('Scale down, reveal', 'woovina-elementor-widgets'),
                   'effect-16' => __('Fall down', 'woovina-elementor-widgets'),
                   'effect-17' => __('Move up fade out, push border', 'woovina-elementor-widgets'),
                   'effect-18' => __('Cross', 'woovina-elementor-widgets'),
                   'effect-19' => __('3D side', 'woovina-elementor-widgets'),
                   'effect-20' => __('3D panel', 'woovina-elementor-widgets'),
                   'effect-21' => __('Borders slight translate', 'woovina-elementor-widgets'),
                ],
                'default' 		=> 'effect-1',
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
				'selectors' 	=> [
					'{{WRAPPER}} .wew-link-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Link Effects', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-link-wrap a',
			]
		);

		$this->add_control(
			'width',
			[
				'label' 		=> __('Icon Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [
                    'size' => 200,
                ],
				'range' 		=> [
					'px' => [
						'step'  => 1,
					],
				],
                'size_units'	=> [ 'px', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .wew-effect-19 a' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .wew-effect-19 a span' => 'transform-origin: 50% 50% calc(-{{SIZE}}{{UNIT}}/2); -webkit-transform-origin: 50% 50% calc(-{{SIZE}}{{UNIT}}/2); -moz-transform-origin: 50% 50% calc(-{{SIZE}}{{UNIT}}/2);',
                ],
				'condition' 	=> [
					'effect' => 'effect-19',
				],
			]
		);

		$this->start_controls_tabs('tabs_link_style');

		$this->start_controls_tab(
			'tab_link_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'link_text_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-link-wrap a, {{WRAPPER}} .wew-effect-15 a::before, {{WRAPPER}} .wew-effect-17 a::before, body {{WRAPPER}} .wew-effect-20 a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_second_text_color',
			[
				'label' 		=> __('Second Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-effect-9 a span:last-child' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'effect' => 'effect-9',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-effect-2 a span, {{WRAPPER}} .wew-effect-10 a span, {{WRAPPER}} .wew-effect-19 a span, {{WRAPPER}} .wew-effect-20 a span' => 'background: {{VALUE}};',
					'{{WRAPPER}} .wew-effect-2 a span::before, {{WRAPPER}} .wew-effect-19 a span::before, {{WRAPPER}} .wew-effect-20 a:hover span, {{WRAPPER}} .wew-effect-20 a:focus span' => 'background: #616161;',
				],
				'condition' 	=> [
					'effect' => [ 'effect-2', 'effect-10', 'effect-19', 'effect-20' ],
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-effect-6 a::before, {{WRAPPER}} .wew-effect-6 a::after, {{WRAPPER}} .wew-effect-7 a::before, {{WRAPPER}} .wew-effect-7 a::after, {{WRAPPER}} .wew-effect-9 a::before, {{WRAPPER}} .wew-effect-9 a::after, {{WRAPPER}} .wew-effect-14 a::before, {{WRAPPER}} .wew-effect-14 a::after, {{WRAPPER}} .wew-effect-17 a::after, {{WRAPPER}} .wew-effect-18 a::before, {{WRAPPER}} .wew-effect-18 a::after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .wew-effect-8 a::before, {{WRAPPER}} .wew-effect-8 a::after, {{WRAPPER}} .wew-effect-11 a' => 'border-color: {{VALUE}};',
				],
				'condition' 	=> [
					'effect' => [ 'effect-6', 'effect-7', 'effect-8', 'effect-9', 'effect-11', 'effect-14', 'effect-17', 'effect-18' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_link_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'link_hover_text_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-link-wrap a:hover, {{WRAPPER}} .wew-effect-10 a::before, {{WRAPPER}} .wew-effect-11 a::before, {{WRAPPER}} .wew-effect-16 a::before, {{WRAPPER}} .wew-effect-20 a span::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_hover_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-effect-2 a:hover span::before, {{WRAPPER}} .wew-effect-2 a:focus span::before, {{WRAPPER}} .wew-effect-10 a::before, {{WRAPPER}} .wew-effect-19 a:hover span::before, {{WRAPPER}} .wew-effect-19 a:focus span::before, {{WRAPPER}} .wew-effect-20 a span::before' => 'background: {{VALUE}};',
				],
				'condition' 	=> [
					'effect' => [ 'effect-2', 'effect-10', 'effect-19', 'effect-20' ],
				],
			]
		);

		$this->add_control(
			'link_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-effect-3 a::after, {{WRAPPER}} .wew-effect-4 a::after, {{WRAPPER}} .wew-effect-21 a::before, {{WRAPPER}} .wew-effect-21 a::after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .wew-effect-8 a::after, {{WRAPPER}} .wew-effect-11 a::before, {{WRAPPER}} .wew-effect-12 a::before, {{WRAPPER}} .wew-effect-12 a::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-effect-13 a:hover::before, {{WRAPPER}} .wew-effect-13 a:focus::before' => 'color: {{VALUE}}; text-shadow: 10px 0 {{VALUE}}, -10px 0 {{VALUE}};',
				],
				'condition' 	=> [
					'effect' => [ 'effect-3', 'effect-4', 'effect-8', 'effect-11', 'effect-12', 'effect-13', 'effect-21' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_section();

	}

	protected function render() {
		$settings 		= $this->get_settings_for_display();
		$text 			= $settings['text'];
        $second_text 	= $settings['second_text'];
        $link 			= $settings['link'];
        $effect 		= $settings['effect'];

		$this->add_render_attribute('link-wrap', 'class', 'wew-link-wrap');
        
		if(! empty($effect)) {
            $this->add_render_attribute('link-wrap', 'class', 'wew-'. $effect);
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

		$this->add_render_attribute('link', 'class', 'wew-link');
        
        if('effect-10' == $effect
        	|| 'effect-11' == $effect
        	|| 'effect-15' == $effect
        	|| 'effect-16' == $effect
        	|| 'effect-17' == $effect
        	|| 'effect-18' == $effect) {
            $this->add_render_attribute('hover-text', 'data-hover', $text);
        }
        
        if('effect-2' == $effect
        	|| 'effect-4' == $effect
        	|| 'effect-5' == $effect
        	|| 'effect-19' == $effect
        	|| 'effect-20' == $effect) {
            $this->add_render_attribute('text', 'data-hover', $text);
        } ?>

		
		<div <?php echo $this->get_render_attribute_string('link-wrap'); ?>>
			<a <?php echo $this->get_render_attribute_string('link'); ?><?php echo $this->get_render_attribute_string('hover-text'); ?>>
				<span <?php echo $this->get_render_attribute_string('text'); ?>>
	                <?php echo esc_attr($text); ?>
	            </span>
	            <?php
	            if('effect-9' == $effect
	            	&& ! empty($second_text)) { ?>
	                <span><?php echo esc_attr($second_text); ?></span>
	            <?php
	        	} ?>
			</a>
		</div>

	<?php
	}

}