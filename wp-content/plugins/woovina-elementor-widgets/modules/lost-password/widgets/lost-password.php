<?php
namespace wvnElementor\Modules\LostPassword\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class LostPassword extends Widget_Base {

	public function get_name() {
		return 'wew-lost-password';
	}

	public function get_title() {
		return __('Lost Password Form', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-lock-user';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-forms' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_lost_password',
			[
				'label' 		=> __('Form', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'show_message',
			[
				'label' 		=> __('Show Message', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'message',
			[
				'label'   		=> __('Message', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXTAREA,
				'default'		=> __('Please enter your username or email address. You will receive a link to create a new password via email.', 'woovina-elementor-widgets'),
				'condition'		=> [
					'show_message' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'label_heading',
			[
				'label' 		=> __('Label', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'show_label',
			[
				'label' 		=> __('Show Label', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'user_label',
			[
				'label' 		=> __('Username', 'woovina-elementor-widgets'),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __('Username or Email', 'woovina-elementor-widgets'),
				'condition'		=> [
					'show_label' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'placeholder_heading',
			[
				'label' 		=> __('Placeholders', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'show_placeholders',
			[
				'label' 		=> __('Show Placeholders', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'user_placeholder',
			[
				'label' 		=> __('Username', 'woovina-elementor-widgets'),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __('Username or Email Address', 'woovina-elementor-widgets'),
				'condition'		=> [
					'show_placeholders' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'submit_heading',
			[
				'label' 		=> __('Submit Button', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'submit_text',
			[
				'label' 		=> __('Text', 'woovina-elementor-widgets'),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __('Get New Password', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'login_heading',
			[
				'label' 		=> __('Login Link', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'show_login',
			[
				'label' 		=> __('Show Link', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'login_text',
			[
				'label' 		=> __('Text', 'woovina-elementor-widgets'),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __('Back to the Login Page', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'login_link',
			[
				'label'   		=> __('Link', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::URL,
				'placeholder' 	=> __('https://your-link.com', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'privacy_policy_heading',
			[
				'label' 		=> __('Privacy Policy Link', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'privacy_policy_text',
			[
				'type' 		=> Controls_Manager::RAW_HTML,
				'raw'  		=> sprintf(
					__('Select your Privacy Policy page in the %1$sPrivacy Settings%2$s', 'woovina-elementor-widgets'),
					'<a href="' . esc_url(admin_url('privacy.php')) . '" target="_blank">',
					'</a>'
				),
			]
		);

		$this->add_control(
			'show_privacy_policy',
			[
				'label' 		=> __('Show Link', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_login_content',
			[
				'label' 		=> __('Additional Options', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'redirect_after_lost_password',
			[
				'label' 		=> __('Redirect After Login', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'off',
			]
		);

		$this->add_control(
			'redirect_url',
			[
				'type' 			=> Controls_Manager::URL,
				'show_label' 	=> false,
				'show_external' => false,
				'separator' 	=> false,
				'placeholder' 	=> 'http://your-link.com/',
				'description' 	=> __('Note: Because of security reasons, you can ONLY use your current domain here.', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'redirect_after_lost_password' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_logged_in_message',
			[
				'label' 		=> __('Logged in Message', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_off' 	=> __('Hide', 'woovina-elementor-widgets'),
				'label_on' 		=> __('Show', 'woovina-elementor-widgets'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_style',
			[
				'label' 		=> __('Label', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'label_typo',
				'selector' 		=> '{{WRAPPER}} .wew-form label',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'label_spacing',
			[
				'label' 		=> __('Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'label_text_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-form label',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_message_style',
			[
				'label' 		=> __('Message Box', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'message_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form-message' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'message_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form-message' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'message_typo',
				'selector' 		=> '{{WRAPPER}} .wew-form-message',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'message_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-form-message',
			]
		);

		$this->add_responsive_control(
			'message_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'message_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'message_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-form-message',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_field_style',
			[
				'label' 		=> __('Field', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_field_style');

		$this->start_controls_tab(
			'tab_field_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'field_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'field_hover_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_hover_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_focus',
			[
				'label' 		=> __('Focus', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'field_focus_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_focus_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_focus_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'field_placeholder_color',
			[
				'label' 		=> __('Placeholder Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wew-form .wew-input::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .wew-form .wew-input:-ms-input-placeholder'      => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'field_typo',
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-input',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'field_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-input',
			]
		);

		$this->add_responsive_control(
			'field_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'field_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-input',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' 		=> __('Button', 'woovina-elementor-widgets'),
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

		$this->add_control(
			'button_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-submit .wew-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-submit .wew-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'button_hover_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-submit .wew-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-submit .wew-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-submit .wew-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typo',
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-buttons .wew-button',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-buttons .wew-button',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-buttons .wew-button',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_link_style',
			[
				'label' 		=> __('Login Link', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
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
			'link_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-link a' => 'color: {{VALUE}};',
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
			'link_hover_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-link a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'link_typo',
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-link a',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_privacy_link_style',
			[
				'label' 		=> __('Privacy Policy', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_privacy_link_style');

		$this->start_controls_tab(
			'tab_privacy_link_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'privacy_link_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-privacy a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_privacy_link_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'privacy_link_hover_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-privacy a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'privacy_link_typo',
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-privacy a',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 				= $this->get_settings_for_display();
		$current_url 			= remove_query_arg('fake_arg');
		$show_login 			= 'yes' === $settings['show_login'];
		$show_privacy_policy 	= 'yes' === $settings['show_privacy_policy'];

		if('yes' === $settings['redirect_after_lost_password'] && ! empty($settings['redirect_url']['url'])) {
			$redirect_url = $settings['redirect_url']['url'];
		} else {
			$redirect_url = $current_url;
		}

		if(is_user_logged_in() && ! \Elementor\Plugin::instance()->editor->is_edit_mode()) {
			if('yes' === $settings['show_logged_in_message']) {
				$current_user = wp_get_current_user();

				echo '<div class="wew-login">' .
					sprintf(__('You are Logged in as %1$s (<a href="%2$s">Logout</a>)', 'woovina-elementor-widgets'), $current_user->display_name, wp_logout_url($current_url)) .
					'</div>';
			}

			return;
		}

		// Field
		$this->add_render_attribute('user_label', 'for', 'wew_user_lost_password');
		$this->add_render_attribute('user_input', [
			'type'	=> 'text',
			'name'	=> 'user_login',
			'id'	=> 'wew_user_lost_password',
			'class' => [
				'wew-username',
				'wew-input',
			],
		]);

		// Placeholders
		if($settings['show_placeholders']) {
			$this->add_render_attribute('user_input', 'placeholder', $settings['user_placeholder']);
		}

		// Login link
		if(! empty($settings['login_link']['url'])) {
			$this->add_render_attribute('login_link', 'href', $settings['login_link']['url']);

			if($settings['login_link']['is_external']) {
				$this->add_render_attribute('login_link', 'target', '_blank');
			}

			if($settings['login_link']['nofollow']) {
				$this->add_render_attribute('login_link', 'rel', 'nofollow');
			}
		} else {
			$this->add_render_attribute('login_link', 'href', wp_login_url($redirect_url));
		}

		// Register/login
		$this->add_render_attribute('buttons', [
			'class' => [
				'wew-buttons',
				'clr',
			],
		]);

		$this->add_render_attribute('submit', 'class', 'wew-submit');

		if($settings['show_message']) {
			echo '<p class="wew-form-message">' . $settings['message'] . '</p>';
		} ?>

		<form class="wew-form" method="post" action="<?php echo wp_lostpassword_url(); ?>">
			<p class="wew-username">
				<?php
				if($settings['show_label']) {
					echo '<label ' . $this->get_render_attribute_string('user_label') . '>' . $settings['user_label'] . '</label>';
				}

				echo '<input ' . $this->get_render_attribute_string('user_input') . ' size="1">'; ?>
			</p>

			<?php do_action('lostpassword_form'); ?>

			<div <?php echo $this->get_render_attribute_string('buttons'); ?>>
				<div <?php echo $this->get_render_attribute_string('submit'); ?>>
					<input type="submit" class="wew-button" value="<?php echo esc_attr($settings['submit_text']); ?>"/>
				</div>
			</div>

			<?php
			if($show_login) {
				echo '<div class="wew-link">';
					echo '<a ' . $this->get_render_attribute_string('login_link') . '>'. $settings['login_text'] .'</a>';
				echo '</div>';
			} ?>

			<?php
			if($show_privacy_policy && function_exists('the_privacy_policy_link')) {
				the_privacy_policy_link('<div class="wew-privacy">', '</div>');
			} ?>

			<input type="hidden" name="redirect_to" value="<?php echo esc_url($redirect_url); ?>" />
			<input type="hidden" name="action" value="lostpassword" />
		</form>

	<?php
	}

	protected function _content_template() { ?>
		<#
		view.addRenderAttribute('user_input', {
			'type'	: 'text',
			'name'	: 'user_login',
			'id'	: 'wew_user_lost_password',
			'class'	: [ 'wew-username', 'wew-input' ]
		});

		// Placeholders
		if(settings.show_placeholders) {
			view.addRenderAttribute('user_input', 'placeholder', settings.user_placeholder);
		}

		if(settings.show_message) { #>
			<p class="wew-form-message">{{{ settings.message }}}</p>
		<# } #>

		<form class="wew-form" method="post" action="">
			<p class="wew-username">
				<# if(settings.show_label) { #>
					<label for="wew_user_lost_password" >{{{ settings.user_label }}}</label>
				<# } #>
				<input {{{ view.getRenderAttributeString('user_input') }}} size="1">
			</p>

			<?php do_action('lostpassword_form'); ?>

			<div class="wew-buttons clr">
				<div class="wew-submit">
					<input type="submit" class="wew-button" value="{{{ settings.submit_text }}}"/>
				</div>
			</div>

			<# if(settings.show_login) { #>
				<div class="wew-link">
					<a href="<?php echo wp_login_url(); ?>">{{{ settings.login_text }}}</a>
				</div>
			<# } #>

			<# if(settings.show_privacy_policy) { #>
				<?php
				if(function_exists('the_privacy_policy_link')) {
					the_privacy_policy_link('<div class="wew-privacy">', '</div>');
				} ?>
			<# } #>
		</form>
	<?php
	}

}