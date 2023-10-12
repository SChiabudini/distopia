<?php
namespace wvnElementor\Modules\CalderaForms\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Caldera_Forms extends Widget_Base {

	public function get_name() {
		return 'wew-caldera-forms';
	}

	public function get_title() {
		return __('Caldera Forms', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_caldera_forms',
			[
				'label' 		=> __('Form', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'form',
			[
				'label' 		=> __('Select Form', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '0',
				'options' 		=> $this->get_available_forms(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Labels', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'labels_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'labels_typo',
				'selector' 		=> '{{WRAPPER}} .caldera-grid label',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'labels_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label' 		=> __('Description', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .help-block' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typo',
				'selector' 		=> '{{WRAPPER}} .caldera-grid .help-block',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .help-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_inputs_style',
			[
				'label' 		=> __('Inputs & Textarea', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_inputs_style');

		$this->start_controls_tab(
			'tab_inputs_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'inputs_background',
				'selector' 		=> '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
			]
		);

		$this->add_control(
			'inputs_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_inputs_hover',
			[
				'label' => __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'inputs_hover_background',
				'selector' 		=> '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):hover',
			]
		);

		$this->add_control(
			'inputs_hover_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_inputs_focus',
			[
				'label' => __('Focus', 'woovina-elementor-widgets'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'inputs_focus_background',
				'selector' 		=> '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):focus',
			]
		);

		$this->add_control(
			'inputs_focus_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_focus_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'inputs_typo',
				'selector' 		=> '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'inputs_placeholder_color',
			[
				'label' 		=> __('Placeholder Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .caldera-grid .form-control::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .caldera-grid .form-control:-ms-input-placeholder'      => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'inputs_border',
				'selector' 		=> '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
			]
		);

		$this->add_control(
			'inputs_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'inputs_box_shadow',
				'selector' 		=> '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
			]
		);

		$this->add_responsive_control(
			'inputs_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'inputs_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' 		=> __('Submit Button', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'button_background',
				'selector' 		=> '{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]',
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'button_hover_background',
				'selector' 		=> '{{WRAPPER}} .caldera-grid input[type=reset]:hover, .caldera-grid input[type=submit]:hover',
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid input[type=reset]:hover, .caldera-grid input[type=submit]:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid input[type=reset]:hover, .caldera-grid input[type=submit]:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_focus',
			[
				'label' => __('Focus', 'woovina-elementor-widgets'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'button_focus_background',
				'selector' 		=> '{{WRAPPER}} .caldera-grid input[type=reset]:focus, .caldera-grid input[type=submit]:focus',
			]
		);

		$this->add_control(
			'button_focus_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid input[type=reset]:focus, .caldera-grid input[type=submit]:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_focus_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid input[type=reset]:focus, .caldera-grid input[type=submit]:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typo',
				'selector' 		=> '{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border',
				'selector' 		=> '{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_fullwidth',
			[
				'label' 		=> __('Fullwidth Button', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> '',
				'return_value' 	=> 'block',
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]' => 'display: {{VALUE}}; width: 100%;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_alerts_style',
			[
				'label' 		=> __('Alerts', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'alerts_typo',
				'selector' 		=> '{{WRAPPER}} .caldera-grid .alert-success, {{WRAPPER}} .has-error .help-block',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'sent_heading',
			[
				'label' 		=> __('Success Message', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'sent_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .alert-success' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sent_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .alert-success' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'sent_border',
				'selector' 		=> '{{WRAPPER}} .caldera-grid .alert-success',
			]
		);

		$this->add_control(
			'sent_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .alert-success' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sent_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .caldera-grid .alert-success' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'error_alert_heading',
			[
				'label' 		=> __('Error Messages', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'error_alert_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .has-error .help-block' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function get_available_forms() {

		if(! is_caldera_forms_active()) {
			return array();
		}

		$forms = \Caldera_Forms_Forms::get_forms(true, true);

        $result = array(__('-- Select --', 'woovina-elementor-widgets'));

        if(! empty($forms) && ! is_wp_error($forms)) {
            foreach($forms as $form) {	
                $result[ $form['ID'] ] = $form['name'];
            }
        }

        return $result;
	}

	protected function render() {
        $settings = $this->get_settings();
       	$form = $settings['form'];
        
        if('0' != $form && ! empty($form)) {
			echo do_shortcode('[caldera_form id="' . $form . '"]');
		}
    }

}