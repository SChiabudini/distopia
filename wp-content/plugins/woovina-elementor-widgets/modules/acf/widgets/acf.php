<?php
namespace wvnElementor\Modules\ACF\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class ACF extends Widget_Base {

	public function get_name() {
		return 'wew-acf';
	}

	public function get_title() {
		return __('ACF', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-post';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_acf',
			[
				'label' 		=> __('ACF', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'field_name',
			[
				'label' 		=> __('Field Name', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'field_type',
			[
				'label' 		=> __('Field Type', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'text',
				'options' 		=> [
					'text' => __('Text', 'woovina-elementor-widgets'),
					'link' => __('Link', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'link_text',
			[
				'label' 		=> __('Link Text', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'condition' 	=> [
					'field_type' => 'link',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'link_target',
			[
				'label' 		=> __('Link Target', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'self',
				'options' 		=> [
					'self' => __('Self', 'woovina-elementor-widgets'),
					'blank' => __('Blank', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'field_type' => 'link',
				],
			]
		);

		$this->add_control(
			'link_nofollow',
			[
				'label' 		=> __('Add Nofollow', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'condition' 	=> [
					'field_type' => 'link',
				],
			]
		);

		$this->add_control(
			'field_label',
			[
				'label' 		=> __('Label', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __('Icon', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::ICON,
				'default' 		=> '',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' 		=> __('Icon Position', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'left',
				'options' 		=> [
					'left' => __('Before', 'woovina-elementor-widgets'),
					'right' => __('After', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' 		=> __('Icon Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-acf .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-acf .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
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
				],
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-acf' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Field', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'field_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-acf .wew-acf-field',
			]
		);

		$this->add_control(
			'field_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-acf .wew-acf-field' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_style',
			[
				'label' 		=> __('Label', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'field_label!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'label_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-acf .wew-acf-label',
				'condition' 	=> [
					'field_label!' => '',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-acf .wew-acf-label' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'field_label!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' 		=> __('Icon', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-acf .wew-acf-icon' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'icon!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' 		=> __('Size', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' 	=> 5,
						'max' 	=> 200,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-acf .wew-acf-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'icon!' => '',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$type = $settings['field_type'];

		$this->add_render_attribute('wrap', 'class', 'wew-acf');

		if(! empty($settings['icon'])) {
			$this->add_render_attribute('icon', 'class', [
				'wew-acf-icon',
				'elementor-align-icon-' . $settings['icon_align'],
			]);
		}

		$this->add_render_attribute('label', 'class', 'wew-acf-label');
		$this->add_render_attribute('field', 'class', 'wew-acf-field');

		$this->add_render_attribute('link', 'class', 'wew-acf-field');
		$this->add_render_attribute('link', 'href', esc_url(get_field($settings['field_name'])));
		$this->add_render_attribute('link', 'target', '_' . $settings['link_target']);

		if(true == $settings['link_nofollow']) {
			$this->add_render_attribute('link', 'rel', 'nofollow');
		} ?>

		<div <?php echo $this->get_render_attribute_string('wrap'); ?>>
			<?php
			if(! empty($settings['icon']) && 'left' == $settings['icon_align']) { ?>
				<span <?php echo $this->get_render_attribute_string('icon'); ?>>
					<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
				</span>
			<?php
			} ?>
			
			<?php
			if(! empty($settings['field_label'])) { ?>
				<span <?php echo $this->get_render_attribute_string('label'); ?>>
					<?php echo esc_attr($settings['field_label']); ?>
				</span>
			<?php } ?>
			
			<?php
			if('text' == $type) { ?>
				<span <?php echo $this->get_render_attribute_string('field'); ?>>
					<?php echo do_shortcode(get_field($settings['field_name'])); ?>
				</span>
			<?php
			} else if('link' == $type) { ?>
				<a <?php echo $this->get_render_attribute_string('link'); ?>>
					<?php
					if(! empty($settings['link_text'])) {
						echo esc_attr($settings['link_text']);
					} else {
						echo do_shortcode(get_field($settings['field_name']));
					} ?>
				</a>
			<?php
			} ?>

			<?php
			if(! empty($settings['icon']) && 'right' == $settings['icon_align']) { ?>
				<span <?php echo $this->get_render_attribute_string('icon'); ?>>
					<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
				</span>
			<?php
			} ?>
		</div>

	<?php
	}
}