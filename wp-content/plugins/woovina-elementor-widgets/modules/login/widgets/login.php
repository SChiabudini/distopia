<?php
namespace wvnElementor\Modules\Login\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Login extends Widget_Base {

	public function get_name() {
		return 'wew-login';
	}

	public function get_title() {
		return __('Login Form', 'woovina-elementor-widgets');
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
			'section_login',
			[
				'label' 		=> __('Form', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label' 		=> __('Show Labels', 'woovina-elementor-widgets'),
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
					'show_labels' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'pass_label',
			[
				'label' 		=> __('Password', 'woovina-elementor-widgets'),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __('Password', 'woovina-elementor-widgets'),
				'condition'		=> [
					'show_labels' => 'yes'
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
			'pass_placeholder',
			[
				'label' 		=> __('Password', 'woovina-elementor-widgets'),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __('Password', 'woovina-elementor-widgets'),
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
				'default'		=> __('Log In', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'register_heading',
			[
				'label' 		=> __('Register Button', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		if(get_option('users_can_register')) {

			$this->add_control(
				'show_register',
				[
					'label' 	=> __('Show Button', 'woovina-elementor-widgets'),
					'type' 		=> Controls_Manager::SWITCHER,
					'default' 	=> 'yes',
				]
			);

			$this->add_control(
				'register_text',
				[
					'label' 		=> __('Text', 'woovina-elementor-widgets'),
					'type'			=> Controls_Manager::TEXT,
					'default'		=> __('Register', 'woovina-elementor-widgets'),
					'condition'		=> [
						'show_register' => 'yes'
					],
					'dynamic' 		=> [ 'active' => true ],
				]
			);

			$this->add_control(
				'register_link',
				[
					'label'   		=> __('Link', 'woovina-elementor-widgets'),
					'type'    		=> Controls_Manager::URL,
					'placeholder' 	=> __('https://your-link.com', 'woovina-elementor-widgets'),
					'condition'		=> [
						'show_register' => 'yes'
					]
				]
			);

		} else {

			$this->add_control(
			'register_disabled',
				[
					'type' 		=> Controls_Manager::RAW_HTML,
					'raw'  		=> sprintf(
						__('To display the Register button, you need to enable registration on your site via Settings > General, check the %1$sAnyone can register%2$s field.', 'woovina-elementor-widgets'),
						'<strong>',
						'</strong>'
					),
				]
			);
			
		}

		$this->add_control(
			'lost_password_heading',
			[
				'label' 		=> __('Lost Password Link', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'show_lost_password',
			[
				'label' 		=> __('Show Link', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'lost_password_text',
			[
				'label' 		=> __('Text', 'woovina-elementor-widgets'),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __('Forgot your password?', 'woovina-elementor-widgets'),
				'condition'		=> [
					'show_lost_password' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'lost_password_link',
			[
				'label'   		=> __('Link', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::URL,
				'placeholder' 	=> __('https://your-link.com', 'woovina-elementor-widgets'),
				'condition'		=> [
					'show_lost_password' => 'yes'
				]
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
			'redirect_after_login',
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
					'redirect_after_login' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_remember_me',
			[
				'label' 		=> __('Remember Me', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_off' 	=> __('Hide', 'woovina-elementor-widgets'),
				'label_on' 		=> __('Show', 'woovina-elementor-widgets'),
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
			'section_labels_style',
			[
				'label' 		=> __('Labels', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'labels_typo',
				'selector' 		=> '{{WRAPPER}} .wew-form label',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'labels_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'labels_spacing',
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
				'name' 			=> 'labels_text_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-form label',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_fields_style',
			[
				'label' 		=> __('Fields', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_fields_style');

		$this->start_controls_tab(
			'tab_fields_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'fields_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_color',
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
			'tab_fields_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'fields_hover_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_hover_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_hover_border_color',
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
			'tab_fields_focus',
			[
				'label' 		=> __('Focus', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'fields_focus_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_focus_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-input:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_focus_border_color',
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
			'fields_placeholder_color',
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
				'name' 			=> 'fields_typo',
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-input',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'fields_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-input',
			]
		);

		$this->add_responsive_control(
			'fields_border_radius',
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
			'fields_padding',
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
				'name' 			=> 'fields_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-input',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons_style',
			[
				'label' 		=> __('Buttons', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'buttons_typo',
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-buttons .wew-button',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'buttons_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-buttons .wew-button',
			]
		);

		$this->add_responsive_control(
			'buttons_border_radius',
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
			'buttons_padding',
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
				'name' 			=> 'buttons_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-form .wew-buttons .wew-button',
			]
		);

		$this->add_control(
			'login_button_heading',
			[
				'label' 		=> __('Login Button', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->start_controls_tabs('tabs_login_button_style');

		$this->start_controls_tab(
			'tab_login_button_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'login_button_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-submit .wew-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'login_button_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-submit .wew-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'login_button_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-submit .wew-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_login_button_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'login_button_hover_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-submit .wew-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'login_button_hover_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-submit .wew-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'login_button_hover_border_color',
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

		$this->add_control(
			'register_button_heading',
			[
				'label' 		=> __('Register Button', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->start_controls_tabs('tabs_register_button_style');

		$this->start_controls_tab(
			'tab_register_button_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'register_button_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-register .wew-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'register_button_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-register .wew-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'register_button_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-register .wew-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_register_button_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'register_button_hover_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-register .wew-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'register_button_hover_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-register .wew-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'register_button_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-form .wew-buttons .wew-register .wew-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_link_style',
			[
				'label' 		=> __('Forgot password', 'woovina-elementor-widgets'),
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
		$show_lost_password 	= 'yes' === $settings['show_lost_password'];
		$show_privacy_policy 	= 'yes' === $settings['show_privacy_policy'];
		$show_register 			= get_option('users_can_register') && 'yes' === $settings['show_register'];

		if('yes' === $settings['redirect_after_login'] && ! empty($settings['redirect_url']['url'])) {
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

		// Fields
		$this->add_render_attribute('user_label', 'for', 'wew_user_login');
		$this->add_render_attribute('user_input', [
			'type'	=> 'text',
			'name'	=> 'log',
			'id'	=> 'wew_user_login',
			'class' => [
				'wew-username',
				'wew-input',
			],
		]);

		$this->add_render_attribute('pass_label', 'for', 'wew_user_pass');
		$this->add_render_attribute('pass_input', [
			'type'	=> 'password',
			'name'	=> 'pwd',
			'id'	=> 'wew_user_pass',
			'class' => [
				'wew-password',
				'wew-input',
			],
		]);

		// Placeholders
		if($settings['show_placeholders']) {
			$this->add_render_attribute('user_input', 'placeholder', $settings['user_placeholder']);
			$this->add_render_attribute('pass_input', 'placeholder', $settings['pass_placeholder']);
		}

		// Lost password link
		if(! empty($settings['lost_password_link']['url'])) {
			$this->add_render_attribute('lost_password_link', 'href', $settings['lost_password_link']['url']);

			if($settings['lost_password_link']['is_external']) {
				$this->add_render_attribute('lost_password_link', 'target', '_blank');
			}

			if($settings['lost_password_link']['nofollow']) {
				$this->add_render_attribute('lost_password_link', 'rel', 'nofollow');
			}
		} else {
			$this->add_render_attribute('lost_password_link', 'href', wp_lostpassword_url($redirect_url));
		}

		// Register link
		$this->add_render_attribute('register_link', 'class', 'wew-button');

		if(! empty($settings['register_link']['url'])) {
			$this->add_render_attribute('register_link', 'href', $settings['register_link']['url']);

			if($settings['register_link']['is_external']) {
				$this->add_render_attribute('register_link', 'target', '_blank');
			}

			if($settings['register_link']['nofollow']) {
				$this->add_render_attribute('register_link', 'rel', 'nofollow');
			}
		} else {
			$this->add_render_attribute('register_link', 'href', wp_registration_url());
		}

		// Register/login
		$this->add_render_attribute('buttons', [
			'class' => [
				'wew-buttons',
				'clr',
			],
		]);
		
		if($show_register) {
			$this->add_render_attribute('buttons', 'class', 'wew-has-register');
		}

		$this->add_render_attribute('submit', 'class', 'wew-submit');
		$this->add_render_attribute('register', 'class', 'wew-register');

		if($show_register) {
			$this->add_render_attribute('submit', 'class', 'wew-left');
			$this->add_render_attribute('register', 'class', 'wew-right');
		} ?>

		<form class="wew-form" method="post" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>">
			<p class="wew-username">
				<?php
				if($settings['show_labels']) {
					echo '<label ' . $this->get_render_attribute_string('user_label') . '>' . $settings['user_label'] . '</label>';
				}

				echo '<input ' . $this->get_render_attribute_string('user_input') . ' size="1">'; ?>
			</p>

			<p class="wew-password">
				<?php
				if($settings['show_labels']) {
					echo '<label ' . $this->get_render_attribute_string('pass_label') . '>' . $settings['pass_label'] . '</label>';
				}

				echo '<input ' . $this->get_render_attribute_string('pass_input') . ' size="1">'; ?>
			</p>

			<?php
			if($settings['show_remember_me']) { ?>
				<p class="wew-remember">
					<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e('Remember Me', 'woovina-elementor-widgets'); ?></label>
				</p>
			<?php
			} ?>

			<div <?php echo $this->get_render_attribute_string('buttons'); ?>>
				<div <?php echo $this->get_render_attribute_string('submit'); ?>>
					<input type="submit" class="wew-button" value="<?php echo esc_attr($settings['submit_text']); ?>"/>
				</div>

				<?php
				if($show_register) {
					echo '<div ' . $this->get_render_attribute_string('register') . '>';
						echo '<a ' . $this->get_render_attribute_string('register_link') . '>'. $settings['register_text'] .'</a>';
					echo '</div>';
				} ?>
			</div>

			<?php do_action('login_form'); ?>

			<?php
			if($show_lost_password) {
				echo '<div class="wew-link">';
					echo '<a ' . $this->get_render_attribute_string('lost_password_link') . '>'. $settings['lost_password_text'] .'</a>';
				echo '</div>';
			} ?>

			<?php
			if($show_privacy_policy && function_exists('the_privacy_policy_link')) {
				the_privacy_policy_link('<div class="wew-privacy">', '</div>');
			} ?>

			<input type="hidden" name="redirect_to" value="<?php echo esc_url($redirect_url); ?>" />
			<input type="hidden" name="action" value="login" />
		</form>

	<?php
	}

	protected function _content_template() { ?>
		<#
		view.addRenderAttribute('user_input', {
			'type'	: 'text',
			'name'	: 'log',
			'id'	: 'wew_user_login',
			'class'	: [ 'wew-username', 'wew-input' ]
		});

		view.addRenderAttribute('pass_input', {
			'type'	: 'password',
			'name'	: 'pwd',
			'id'	: 'wew_user_pass',
			'class'	: [ 'wew-password', 'wew-input' ]
		});

		// Placeholders
		if(settings.show_placeholders) {
			view.addRenderAttribute('user_input', 'placeholder', settings.user_placeholder);
			view.addRenderAttribute('pass_input', 'placeholder', settings.pass_placeholder);
		}

		view.addRenderAttribute('buttons', 'class', [ 'wew-buttons', 'clr' ]);

		if(settings.show_register) {
			view.addRenderAttribute('buttons', 'class', 'wew-has-register');
		}

		view.addRenderAttribute('submit', 'class', 'wew-submit');
		view.addRenderAttribute('register', 'class', 'wew-register');

		if(settings.show_register) {
			view.addRenderAttribute('submit', 'class', 'wew-left');
			view.addRenderAttribute('register', 'class', 'wew-right');
		} #>

		<form class="wew-form" method="post" action="">
			<p class="wew-username">
				<# if(settings.show_labels) { #>
					<label for="wew_user_login" >{{{ settings.user_label }}}</label>
				<# } #>
				<input {{{ view.getRenderAttributeString('user_input') }}} size="1">
			</p>

			<p class="wew-password">
				<# if(settings.show_labels) { #>
					<label for="wew_user_pass" >{{{ settings.pass_label }}}</label>
				<# } #>
				<input {{{ view.getRenderAttributeString('pass_input') }}} size="1">
			</p>

			<# if(settings.show_remember_me) { #>
				<p class="wew-remember">
					<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e('Remember Me', 'woovina-elementor-widgets'); ?></label>
				</p>
			<# } #>

			<?php do_action('login_form'); ?>

			<div {{{ view.getRenderAttributeString('buttons') }}}>
				<div {{{ view.getRenderAttributeString('submit') }}}>
					<input type="submit" class="wew-button" value="{{{ settings.submit_text }}}"/>
				</div>

				<# if(settings.show_register) { #>
					<div {{{ view.getRenderAttributeString('register') }}}>
						<a class="wew-button" href="<?php echo wp_registration_url(); ?>">{{{ settings.register_text }}}</a>
					</div>
				<# } #>
			</div>

			<# if(settings.show_lost_password) { #>
				<div class="wew-link">
					<a href="<?php echo wp_lostpassword_url(); ?>">{{{ settings.lost_password_text }}}</a>
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