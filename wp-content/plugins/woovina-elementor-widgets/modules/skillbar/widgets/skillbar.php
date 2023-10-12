<?php
namespace wvnElementor\Modules\Skillbar\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Skillbar extends Widget_Base {

	public function get_name() {
		return 'wew-skillbar';
	}

	public function get_title() {
		return __('Skillbar', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-skill-bar';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-skillbar', 'appear' ];
	}

	public function get_style_depends() {
		return [ 'wew-skillbar' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_alert',
			[
				'label' 		=> __('Skillbar', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'title',
			[
				'label' 		=> __('Title', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __('Web Design', 'woovina-elementor-widgets'),
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'percent',
			[
				'label' 		=> __('Percentage', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' 		=> 85,
					'unit' 		=> '%',
				],
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'display_percent',
			[
				'label' 		=> __('Display % Number', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Show', 'woovina-elementor-widgets'),
					'false' 	=> __('Hide', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> __('Style', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'inner',
				'options' 		=> [
					'inner' 	=> __('Inner', 'woovina-elementor-widgets'),
					'outside' 	=> __('Outside', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'display_stripe',
			[
				'label' 		=> __('Display Stripe', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Show', 'woovina-elementor-widgets'),
					'false' 	=> __('Hide', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' 		=> __('View', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HIDDEN,
				'default' 		=> 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Skill Bar', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background',
			[
				'label' 		=> __('Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-skillbar-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color',
			[
				'label' 		=> __('Bar Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-skillbar-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'box_shadow',
			[
				'label' 		=> __('Inset Shadow', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> __('Yes', 'woovina-elementor-widgets'),
					'false' 	=> __('No', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'skillbar_title',
				'selector' 		=> '{{WRAPPER}} .wew-skillbar',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 		= $this->get_settings_for_display();

		// Vars
		$elements_style = $settings['style'];
		$percent 		= $settings['percent']['size'];
		$title 			= $settings['title'];
		$show_percent 	= $settings['display_percent'];
		$show_stripe 	= $settings['display_stripe'];

		// Wrapper classes
		$wrap_classes = array('wew-skillbar', 'clr');
		if('false' == $settings['box_shadow']) {
			$wrap_classes[] = 'disable-box-shadow';
		}
		if($elements_style) {
			$wrap_classes[] = 'style-' . $elements_style;
		}
		if('inner' == $elements_style) {
		   $wrap_classes[] = 'wew-skillbar-container';
		}

		// Turn wrap classes into a string
		$wrap_classes = implode(' ', $wrap_classes); ?>

		<div class="<?php echo esc_attr($wrap_classes); ?>" data-percent="<?php echo esc_attr($percent); ?>&#37;">

			<?php if('inner' == $elements_style) { ?>

				<div class="wew-skillbar-title">

					<div class="wew-skillbar-title-inner">
						<?php echo esc_attr($title); ?>
					</div><!-- .wew-skillbar-title-inner -->

				</div><!-- .wew-skillbar-title -->

			<?php } else if('outside' == $elements_style) { ?>

				<div class="wew-skillbar-title">
					<?php echo esc_attr($title); ?>
				</div><!-- .wew-skillbar-title-inner -->

				<?php if('true' == $show_percent) { ?>
					<div class="wew-skill-bar-percent"><?php echo esc_attr($percent); ?>&#37;</div>
				<?php } ?>

				<div style="clear:both"></div>

			<?php } ?>

			<?php if($settings['percent']) { ?>

				<?php if('outside' == $elements_style) { ?>
					<div class="wew-skillbar-container clr">
				<?php } ?>

					<div class="wew-skillbar-bar">
						<?php if('true' == $show_percent && 'inner' == $elements_style) { ?>
							<div class="wew-skill-bar-percent"><?php echo esc_attr($percent); ?>&#37;</div>
						<?php } ?>
						<?php if('true' == $show_stripe) { ?>
							<div class="wew-skill-bar-stripe"></div>
						<?php } ?>
					</div><!-- .wew-skillbar -->

				<?php if('outside' == $elements_style) { ?>
					</div>
				<?php } ?>

			<?php } ?>

		</div><!-- .wew-skillbar -->

	<?php
	}

	protected function _content_template() { ?>
		<#
			var wrap_classes = 'wew-skillbar clr';

			if('false' == settings.box_shadow) {
				wrap_classes += ' disable-box-shadow';
			}
			if('' !== settings.style) {
				wrap_classes += ' style-' + settings.style;
			}
			if('inner' == settings.style) {
				wrap_classes += ' wew-skillbar-container';
			}
		#>

		<div class="{{ wrap_classes }}" data-percent="{{ settings.percent.size }}&#37;">

			<# if('inner' == settings.style) { #>

				<div class="wew-skillbar-title">

					<div class="wew-skillbar-title-inner">
						{{{ settings.title }}}
					</div><!-- .wew-skillbar-title-inner -->

				</div><!-- .wew-skillbar-title -->

			<# } else if('outside' == settings.style) { #>

				<div class="wew-skillbar-title">
					{{{ settings.title }}}
				</div><!-- .wew-skillbar-title-inner -->

				<# if('true' == settings.display_percent) { #>
					<div class="wew-skill-bar-percent">{{ settings.percent.size }}&#37;</div>
				<# } #>

				<div style="clear:both"></div>

			<# } #>

			<# if(settings.percent) { #>

				<# if('outside' == settings.style) { #>
					<div class="wew-skillbar-container clr">
				<# } #>

					<div class="wew-skillbar-bar">
						<# if('true' == settings.display_percent && 'inner' == settings.style) { #>
							<div class="wew-skill-bar-percent">{{ settings.percent.size }}&#37;</div>
						<# } #>
						<# if('true' == settings.display_stripe) { #>
							<div class="wew-skill-bar-stripe"></div>
						<# } #>
					</div><!-- .wew-skillbar -->

				<# if('outside' == settings.style) { #>
					</div>
				<# } #>

			<# } #>

		</div><!-- .wew-skillbar -->
	<?php
	}

}