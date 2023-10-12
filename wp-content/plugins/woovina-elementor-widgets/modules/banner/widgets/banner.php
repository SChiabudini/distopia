<?php
namespace wvnElementor\Modules\Banner\Widgets;

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

class Banner extends Widget_Base {

	public function get_name() {
		return 'wew-banner';
	}

	public function get_title() {
		return __('Banner', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-banner' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_banner',
			[
				'label' 		=> __('Banner', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   		=> __('Image', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
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
			]
		);

		$this->add_control(
			'title',
			[
				'label'   		=> __('Title', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'   		=> __('Description', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXTAREA,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'   		=> __('Link', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::URL,
				'placeholder' 	=> __('https://your-link.com', 'woovina-elementor-widgets'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			[
				'label' 		=> __('Settings', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'effect',
			[
				'label'   => __('Animation Effect', 'woovina-elementor-widgets'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'apolo',
				'options' => [
					'apolo'  	=> __('Apolo', 'woovina-elementor-widgets'),
					'bubba'  	=> __('Bubba', 'woovina-elementor-widgets'),
					'chico'  	=> __('Chico', 'woovina-elementor-widgets'),
					'jazz'  	=> __('Jazz', 'woovina-elementor-widgets'),
					'layla'  	=> __('Layla', 'woovina-elementor-widgets'),
					'lily'   	=> __('Lily', 'woovina-elementor-widgets'),
					'ming' 		=> __('Ming', 'woovina-elementor-widgets'),
					'marley' 	=> __('Marley', 'woovina-elementor-widgets'),
					'romeo'  	=> __('Romeo', 'woovina-elementor-widgets'),
					'roxy'   	=> __('Roxy', 'woovina-elementor-widgets'),
					'ruby'   	=> __('Ruby', 'woovina-elementor-widgets'),
					'oscar'  	=> __('Oscar', 'woovina-elementor-widgets'),
					'sadie' 	=> __('Sadie', 'woovina-elementor-widgets'),
					'sarah'  	=> __('Sarah', 'woovina-elementor-widgets'),
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> esc_html__('General', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_banner_style');

		$this->start_controls_tab(
			'tab_banner_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'banner_normal_opacity',
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
					'body {{WRAPPER}} .wew-banner img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_banner_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'banner_hover_opacity',
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
					'body {{WRAPPER}} .wew-banner:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'banner_background',
				'selector' 		=> '{{WRAPPER}} .wew-banner',
				'separator' 	=> 'before',
			)
		);

		$this->add_control(
			'banner_additional_color',
			[
				'label' 		=> __('Additional Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-banner.wew-apolo .wew-banner-text' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-bubba figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-bubba figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-chico figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-jazz figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-layla figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-layla figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-ming figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-marley .wew-banner-title:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-romeo figcaption:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-romeo figcaption:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-roxy figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-ruby .wew-banner-text' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wew-banner.wew-sarah .wew-banner-title:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'banner_border',
				'selector' 		=> '{{WRAPPER}} .wew-banner',
			]
		);

		$this->add_responsive_control(
			'banner_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'banner_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'banner_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'banner_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-banner',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' 		=> esc_html__('Banner Title', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-banner .wew-banner-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typo',
				'selector' 		=> '{{WRAPPER}} .wew-banner .wew-banner-title',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label' 		=> esc_html__('Banner Description', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-banner .wew-banner-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typo',
				'selector' 		=> '{{WRAPPER}} .wew-banner .wew-banner-text',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings 		= $this->get_settings_for_display();
		$title 			= $settings['title'];
		$description 	= $settings['description'];
        $link 			= $settings['link'];
        $effect 		= $settings['effect'];

		$this->add_render_attribute('banner', 'class', 'wew-banner');
        
		if(! empty($effect)) {
            $this->add_render_attribute('banner', 'class', 'wew-'. $effect);
        }

		$this->add_render_attribute('content', 'class', 'wew-banner-content');
		$this->add_render_attribute('title', 'class', 'wew-banner-title');
		$this->add_render_attribute('description', 'class', 'wew-banner-text'); ?>

		<figure <?php echo $this->get_render_attribute_string('banner'); ?>>
			<?php
			if(! empty($link['url'])) {
				$this->add_render_attribute('link', 'class', 'wew-banner-link');
				$this->add_render_attribute('link', 'href', $link['url']);

				if($link['is_external']) {
					$this->add_render_attribute('link', 'target', '_blank');
				}

				if($link['nofollow']) {
					$this->add_render_attribute('link', 'rel', 'nofollow');
				}

				$this->add_render_attribute('link', 'class', 'wew-brands-link');

				echo '<a ' . $this->get_render_attribute_string('link') . '>';
			} ?>
				<?php echo Group_Control_Image_Size::get_attachment_image_html($settings); ?>
				<figcaption>
					<div <?php echo $this->get_render_attribute_string('content'); ?>>
						<h5 <?php echo $this->get_render_attribute_string('title'); ?>><?php echo esc_attr($title); ?></h5>
						<div <?php echo $this->get_render_attribute_string('description'); ?>><?php echo $description; ?></div>
					</div>
				</figcaption>
			<?php if(! empty($link['url'])) : ?>
				</a>
			<?php endif; ?>
		</figure>

	<?php
	}

}