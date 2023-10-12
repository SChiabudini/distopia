<?php
namespace wvnElementor\Modules\LoggedInOut\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Logged_In_Out extends Widget_Base {

	public function get_name() {
		return 'wew-logged-in-out';
	}

	public function get_title() {
		return __('Logged In/Out', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-lock-user';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-logged-in-out' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_logged_in',
			[
				'label' 		=> __('Logged In', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'logged_in_nav',
			[
				'label' 		=> __('Select Menu', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'no',
				'options' 		=> $this->menus(),
			]
		);

		$this->add_control(
			'logged_in_content',
			[
				'label' 		=> __('Content', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'placeholder' 	=> __('Enter your content', 'woovina-elementor-widgets'),
				'default' 		=> '',
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'logged_in_position',
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
					'{{WRAPPER}} .wew-login-link.in' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_logged_out',
			[
				'label' 		=> __('Logged Out', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'logged_out_nav',
			[
				'label' 		=> __('Select Menu', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'no',
				'options' 		=> $this->menus(),
			]
		);

		$this->add_control(
			'logged_out_content',
			[
				'label' 		=> __('Content', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'placeholder' 	=> __('Enter your content', 'woovina-elementor-widgets'),
				'default' 		=> '',
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'logged_out_position',
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
					'{{WRAPPER}} .wew-login-link.out' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_logged_in_out',
			[
				'label' 		=> __('Styling', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_logged_in_links_style');

		$this->start_controls_tab(
			'tab_logged_in_out_links_normal',
			[
				'label' => __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'logged_in_out_links_color',
			[
				'label' 		=> __('Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-login-link a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'logged_in_out_links_hover',
			[
				'label' => __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'logged_in_out_links_hover_color',
			[
				'label' 		=> __('Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-login-link a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'logged_in_out_text_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-login-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'logged_in_out_typo',
				'selector' 		=> '{{WRAPPER}} .wew-login-link',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

	}

	public static function menus() {
		$get_menus 	 = get_terms('nav_menu', array('hide_empty' => true));
		$menus['no'] = esc_html__('No Menu', 'woovina-elementor-widgets');
		foreach($get_menus as $menu) {
			$menus[$menu->term_id] = $menu->name;
		}
		return $menus;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if(is_user_logged_in()) {
			$class 	 = 'in';
			$menu 	 = $settings['logged_in_nav'];
			$content = $settings['logged_in_content'];
		} else {
			$class 	 = 'out';
			$menu 	 = $settings['logged_out_nav'];
			$content = $settings['logged_out_content'];
		}

		$menu_args = array(
			'menu' 			 => $menu,
			'container'      => false,
			'fallback_cb'    => false,
			'menu_class'     => 'wew-login-ul navigation dropdown-menu sf-menu clr',
			'link_before'    => '<span class="text-wrap">',
			'link_after'     => '</span>',
			'walker'         => new \WooVina_Custom_Nav_Walker(),
		); ?>

		<div class="wew-login-link <?php echo esc_attr($class); ?>">
			<?php
			// If content
			if(! empty($content)) { ?>
				 <span class="wew-login-content"><?php echo do_shortcode($content); ?></span>
			<?php }

			// If menu
			if(! empty($menu) && 'no' != $menu) {
				wp_nav_menu($menu_args);
			} ?>
		</div>

	<?php
	}

}