<?php
namespace wvnElementor\Modules\Alert\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Alert extends Widget_Base {

	public function get_name() {
		return 'wew-alert';
	}

	public function get_title() {
		return __('Alert', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-alert';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-alert' ];
	}

	public function get_style_depends() {
		return [ 'wew-alert' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_alert',
			[
				'label' 		=> __('Alert', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'type',
			[
				'label' 		=> __('Type', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'notice',
				'options' 		=> [
					'notice' 	=> __('Notice', 'woovina-elementor-widgets'),
					'error' 	=> __('Error', 'woovina-elementor-widgets'),
					'warning' 	=> __('Warning', 'woovina-elementor-widgets'),
					'success' 	=> __('Success', 'woovina-elementor-widgets'),
					'info' 		=> __('Info', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' 		=> __('Title & Description', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder' 	=> __('Your Title', 'woovina-elementor-widgets'),
				'default' 		=> __('This is Alert Message', 'woovina-elementor-widgets'),
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'content',
			[
				'label' 		=> __('Content', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'placeholder' 	=> __('Your Description', 'woovina-elementor-widgets'),
				'default' 		=> __('Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel.', 'woovina-elementor-widgets'),
				'separator' 	=> 'none',
				'show_label' 	=> false,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'show_dismiss',
			[
				'label' 		=> __('Dismiss Button', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'show',
				'options' 		=> [
					'show' 		=> __('Show', 'woovina-elementor-widgets'),
					'hide' 		=> __('Hide', 'woovina-elementor-widgets'),
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
			'section_type',
			[
				'label' 		=> __('Alert Type', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> __('Style', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'small',
				'options' 		=> [
					'small' 	=> __('Small', 'woovina-elementor-widgets'),
					'big' 		=> __('Big', 'woovina-elementor-widgets'),
					'minimal' 	=> __('Minimal', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-alert' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'		 	=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-alert' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' 		=> __('Title', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-alert-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'alert_title',
				'selector' 		=> '{{WRAPPER}} .wew-alert-heading',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description',
			[
				'label' 		=> __('Description', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-alert-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'alert_content',
				'selector' 		=> '{{WRAPPER}} .wew-alert-content',
				'scheme' 		=> Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper classes
		$wrap_classes = array('wew-alert', 'clr');
		if(! empty($settings['type'])) {
			$wrap_classes[] = 'wew-alert-' . $settings['type'];
		}
		if(! empty($settings['style'])) {
			$wrap_classes[] = 'wew-alert-' . $settings['style'];
		}

		// Turn wrap classes into a string
		$wrap_classes = implode(' ', $wrap_classes);

		// Alert icon
		if('notice' == $settings['type']) {
			if('minimal' == $settings['style']) {
				$alert_icon = 'fa fa-bell';
			} else {
				$alert_icon = 'icon-bell';
			}
		} else if('error' == $settings['type']) {
			if('minimal' == $settings['style']) {
				$alert_icon = 'fa fa-times';
			} else {
				$alert_icon = 'icon-close';
			}
		} else if('warning' == $settings['type']) {
			$alert_icon = 'fa fa-exclamation';
		} else if('success' == $settings['type']) {
			if('minimal' == $settings['style']) {
				$alert_icon = 'fa fa-check';
			} else {
				$alert_icon = 'icon-check';
			}
		} else if('info' == $settings['type']) {
			$alert_icon = 'fa fa-info';
		} ?>

		<div class="<?php echo esc_attr($wrap_classes); ?>" role="alert">

			<div class="wew-alert-content-wrap clr">

				<div class="wew-alert-icon"><i class="<?php echo esc_attr($alert_icon); ?>"></i></div>
				
				<?php
				// Display heading if defined
				if(! empty($settings['title']) && 'small' != $settings['style']) { ?>

					<h2 class="wew-alert-heading">
						<?php echo esc_attr($settings['title']); ?>
					</h2>

				<?php } ?>

				<?php
				// Display content if defined
				if(! empty($settings['content'])) { ?>

					<div class="wew-alert-content clr">
						<?php echo do_shortcode($settings['content']); ?>
					</div><!-- .wew-alert-content -->

				<?php } ?>

				<?php
				// Display close button if defined
				if(! empty($settings['show_dismiss']) && 'show' === $settings['show_dismiss']) { ?>

					<div class="wew-alert-close-btn"><i class="icon-close"></i></div>

				<?php } ?>

			</div><!-- .wew-alert-content -->

		</div><!-- .wew-alert -->

	<?php
	}

	protected function _content_template() { ?>
		<#
			var wrap_classes = 'wew-alert clr',
				alert_icon = '';

			if('' !== settings.type) {
				wrap_classes += ' wew-alert-' + settings.type;
			}
			if('' !== settings.style) {
				wrap_classes += ' wew-alert-' + settings.style;
			}

			if('notice' === settings.type) {
				if('minimal' === settings.style) {
					alert_icon = 'fa fa-bell';
				} else {
					alert_icon = 'icon-bell';
				}
			} else if('error' === settings.type) {
				if('minimal' === settings.style) {
					alert_icon = 'fa fa-times';
				} else {
					alert_icon = 'icon-close';
				}
			} else if('warning' === settings.type) {
				alert_icon = 'fa fa-exclamation';
			} else if('success' === settings.type) {
				if('minimal' === settings.style) {
					alert_icon = 'fa fa-check';
				} else {
					alert_icon = 'icon-check';
				}
			} else if('info' === settings.type) {
				alert_icon = 'fa fa-info';
			}
		#>

		<div class="{{ wrap_classes }}" role="alert">

			<div class="wew-alert-content-wrap clr">

				<div class="wew-alert-icon"><i class="{{ alert_icon }}"></i></div>

				<# if(settings.title && 'small' !== settings.style) { #>
					<h2 class="wew-alert-heading">{{{ settings.title }}}</h2>
				<# } #>

				<# if(settings.content) { #>
					<div class="wew-alert-content clr">{{{ settings.content }}}</div>
				<# } #>

				<# if(settings.show_dismiss && 'show' === settings.show_dismiss) { #>
					<div class="wew-alert-close-btn"><i class="icon-close"></i></div>
				<# } #>

			</div>

		</div>
	<?php
	}
}