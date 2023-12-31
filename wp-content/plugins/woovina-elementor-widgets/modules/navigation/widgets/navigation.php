<?php
namespace wvnElementor\Modules\Navigation\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Navigation extends Widget_Base {

	public function get_name() {
		return 'wew-nav';
	}

	public function get_title() {
		return __('Navigation', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-navigation-horizontal';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_nav',
			[
				'label' 		=> __('Navigation', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'menu',
			[
				'type' 		=> Controls_Manager::RAW_HTML,
				'raw' 		=> __('This widget is the main menu for your custom header style.', 'woovina-elementor-widgets'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_responsive_control(
			'navigation_position',
			[
				'label' 		=> __('Alignment', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::CHOOSE,
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
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .custom-header-nav #site-navigation-wrap, {{WRAPPER}} .custom-header-nav .fs-dropdown-menu, {{WRAPPER}} .custom-header-nav .woovina-mobile-menu-icon' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_navigation',
			[
				'label' 		=> __('Menu Items', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'navigation_typo',
				'selector' 		=> '{{WRAPPER}} #site-navigation-wrap .dropdown-menu > li > a,{{WRAPPER}} #site-navigation-wrap .fs-dropdown-menu > li > a,{{WRAPPER}} .woovina-mobile-menu-icon a',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->start_controls_tabs('tabs_navigation_style');

		$this->start_controls_tab(
			'tab_navigation_normal',
			[
				'label' => __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'navigation_links_color',
			[
				'label' 		=> __('Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > li > a,{{WRAPPER}} #site-navigation-wrap .fs-dropdown-menu > li > a,{{WRAPPER}} .woovina-mobile-menu-icon a,{{WRAPPER}} #searchform-header-replace-close' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_links_bg_color',
			[
				'label' 		=> __('Links Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > li > a,{{WRAPPER}} #site-navigation-wrap .fs-dropdown-menu > li > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_active_links_color',
			[
				'label' 		=> __('Active Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-item > a,{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-ancestor > a,{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-item > a:hover,{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-ancestor > a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_active_links_bg_color',
			[
				'label' 		=> __('Active Links Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-item > a,{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-ancestor > a,{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-item > a:hover,{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-ancestor > a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'navigation_links_hover',
			[
				'label' => __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'navigation_links_hover_color',
			[
				'label' 		=> __('Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > li > a:hover,{{WRAPPER}} #site-navigation-wrap .fs-dropdown-menu > li > a:hover,{{WRAPPER}} .woovina-mobile-menu-icon a:hover,{{WRAPPER}} #searchform-header-replace-close:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_links_hover_bg_color',
			[
				'label' 		=> __('Links Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > li > a:hover,{{WRAPPER}} #site-navigation-wrap .dropdown-menu > li.sfHover > a,{{WRAPPER}} #site-navigation-wrap .fs-dropdown-menu > li > a:hover,{{WRAPPER}} #site-navigation-wrap .fs-dropdown-menu > li.sfHover > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_active_links_hover_color',
			[
				'label' 		=> __('Active Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-item > a:hover,{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-ancestor > a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_active_links_hover_bg_color',
			[
				'label' 		=> __('Active Links Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-item > a:hover,{{WRAPPER}} #site-navigation-wrap .dropdown-menu > .current-menu-ancestor > a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_active_links_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > li > a:hover,{{WRAPPER}} .woovina-mobile-menu-icon a.mobile-menu:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'buttons_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} #site-navigation-wrap .dropdown-menu > li > a,{{WRAPPER}} .woovina-mobile-menu-icon a.mobile-menu',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'buttons_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > li > a,{{WRAPPER}} .woovina-mobile-menu-icon a.mobile-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'navigation_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} #site-navigation-wrap .dropdown-menu > li > a,{{WRAPPER}} .woovina-mobile-menu-icon a.mobile-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_dropdowns',
			[
				'label' 		=> __('Dropdowns', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'dropdowns_typo',
				'selector' 		=> '{{WRAPPER}} .dropdown-menu .sub-menu,{{WRAPPER}} #searchform-dropdown,{{WRAPPER}} #current-shop-items-dropdown',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'dropdowns_width',
			[
				'label' 		=> __('Width (px)', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dropdown-menu .sub-menu' => 'min-width: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'dropdowns_bg_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .dropdown-menu .sub-menu,{{WRAPPER}} #searchform-dropdown,{{WRAPPER}} #current-shop-items-dropdown' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdowns_top_border_color',
			[
				'label' 		=> __('Top Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .dropdown-menu .sub-menu,{{WRAPPER}} #searchform-dropdown,{{WRAPPER}} #current-shop-items-dropdown' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_dropdowns_style');

		$this->start_controls_tab(
			'tab_dropdowns_normal',
			[
				'label' => __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'dropdowns_links_color',
			[
				'label' 		=> __('Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .dropdown-menu ul li a.menu-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdowns_links_border_color',
			[
				'label' 		=> __('Links Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .dropdown-menu ul li.menu-item,{{WRAPPER}} .navigation > ul > li > ul.megamenu.sub-menu > li,{{WRAPPER}} .navigation .megamenu li ul.sub-menu' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdowns_active_links_color',
			[
				'label' 		=> __('Active Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .dropdown-menu ul > .current-menu-item > a.menu-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdowns_active_links_bg_color',
			[
				'label' 		=> __('Active Links Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .dropdown-menu ul > .current-menu-item > a.menu-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dropdowns_links_hover',
			[
				'label' => __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'dropdowns_links_hover_color',
			[
				'label' 		=> __('Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .dropdown-menu ul li a.menu-link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdowns_links_hover_bg_color',
			[
				'label' 		=> __('Links Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .dropdown-menu ul li a.menu-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdowns_active_links_hover_color',
			[
				'label' 		=> __('Active Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .dropdown-menu ul > .current-menu-item > a.menu-link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdowns_active_links_hover_bg_color',
			[
				'label' 		=> __('Active Links Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .dropdown-menu ul > .current-menu-item > a.menu-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = [ __('-- Select --', 'woovina-elementor-widgets') ];

		foreach($menus as $menu) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	protected function render() {
		$settings = $this->get_settings(); ?>

		<div class="custom-header-nav clr">
			<?php
			// Navigation
			get_template_part('partials/header/nav');

			// Mobile nav
			get_template_part('partials/mobile/mobile-icon');

			// Drop down mobile menu style
			get_template_part('partials/mobile/mobile-dropdown'); ?>
		</div>

	<?php
	}

}