<?php
namespace wvnElementor\Modules\Search\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Search extends Widget_Base {

    public function get_name() {
		return 'wew-search';
	}

	public function get_title() {
		return __('Ajax Search', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-search';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-search' ];
	}

	public function get_style_depends() {
		return [ 'wew-search' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_search',
			[
				'label' 		=> __('Search', 'woovina-elementor-widgets'),
			]
		);
		
		$this->add_control(
			'source',
			[
				'label' => __( 'Source', 'woovina-elementor-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'product',
				'options' => [
					'any' => __( 'All Post Types', 'woovina-elementor-widgets' ),
					'post' => __( 'Posts', 'woovina-elementor-widgets' ),
					'page' => __( 'Pages', 'woovina-elementor-widgets' ),
					'product' => __( 'Products', 'woovina-elementor-widgets' ),
				],
				'prefix_class' => 'woovina-search-pro--source-',
				'frontend_available' => true,
			]
		);
		
		$this->add_responsive_control(
			'width',
			[
				'label' 		=> __('Width', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wew-search-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' 		=> __('Height', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-searchform, {{WRAPPER}} .woovina-searchform input.field' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label' 		=> __('Placeholder', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __('Search', 'woovina-elementor-widgets'),
				'placeholder' 	=> __('Search', 'woovina-elementor-widgets'),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		/*$this->add_control(
			'source',
			[
				'label' 		=> _x('Source', 'Posts Type', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> $this->get_post_types(),
				'default' 		=> 'any',
				'label_block' 	=> true,
			]
		);*/

		$this->add_control(
			'enable_ajax',
			[
				'label' 		=> __('Enable Ajax', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __('Show', 'woovina-elementor-widgets'),
				'label_off' 	=> __('Hide', 'woovina-elementor-widgets'),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
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
				'prefix_class' => 'wew%s-align-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_input',
			[
				'label' 		=> __('Input', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_input_style');

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'input_bg',
			[
				'label' 		=> __('Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform input.field' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform input.field' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_hover',
			[
				'label' => __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'input_bg_hover',
			[
				'label' 		=> __('Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform input.field:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_color_hover',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform input.field:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_hover',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform input.field:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => __('Focus', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'input_bg_focus',
			[
				'label' 		=> __('Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform input.field:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_color_focus',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform input.field:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_focus',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform input.field:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'input_focus_box_shadow',
				'selector' 		=> '{{WRAPPER}} .woovina-searchform input.field:focus',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'input_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .woovina-searchform input.field',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'input_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform input.field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'input_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform input.field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'newsletter_input',
				'selector' 		=> '{{WRAPPER}} .woovina-searchform input.field',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' 		=> __('Icon Button', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SECTION,
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' 		=> __('Font Size', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range' => [
					'min' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-searchform button' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'icon_position',
			[
				'label' 		=> __('Position', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'min' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .woovina-searchform button' => is_rtl() ? 'left: {{SIZE}}px;' : 'right: {{SIZE}}px;',
				],
			]
		);

		$this->start_controls_tabs('tabs_icon_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform button' => 'color: {{VALUE}};',
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

		$this->add_control(
			'btn_color_hover',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woovina-searchform button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_results',
			[
				'label' 		=> __('Search Results', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SECTION,
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'results_bg',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'after',
			]
		);

		$this->start_controls_tabs('tabs_results_links_style');

		$this->start_controls_tab(
			'tab_results_links_normal',
			[
				'label' => __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'results_links_bg',
			[
				'label' 		=> __('Links Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a.search-result-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_links_color',
			[
				'label' 		=> __('Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a.search-result-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_links_border_color',
			[
				'label' 		=> __('Links Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_icons_color',
			[
				'label' 		=> __('Icons Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a i.icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_all_links_color',
			[
				'label' 		=> __('All Results Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a.all-results' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'results_links_hover',
			[
				'label' => __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'results_links_hover_bg',
			[
				'label' 		=> __('Links Background', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a.search-result-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_links_hover_color',
			[
				'label' 		=> __('Links Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a.search-result-link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_links_hover_border_color',
			[
				'label' 		=> __('Links Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_icons_hover_color',
			[
				'label' 		=> __('Icons Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a:hover i.icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_all_links_hover_color',
			[
				'label' 		=> __('All Results Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a.all-results:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'results_links_padding',
			[
				'label' => __('Links Padding', 'woovina-elementor-widgets'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'results_search_typo',
				'selector' 		=> '{{WRAPPER}} .wew-search-wrap .wew-search-results ul li a',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_no_search_results',
			[
				'label' 		=> __('No Results Found', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SECTION,
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'no_results_heading_color',
			[
				'label' 		=> __('Heading Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-no-search-results h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'no_results_heading_typo',
				'selector' 		=> '{{WRAPPER}} .wew-search-wrap .wew-no-search-results h6',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'no_results_text_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-search-wrap .wew-no-search-results p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'no_results_text_typo',
				'selector' 		=> '{{WRAPPER}} .wew-search-wrap .wew-no-search-results p',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

	}

	private static function get_post_types($args = []) {
		$post_type_args = [
			'show_in_nav_menus' => true,
		];

		if(! empty($args['post_type'])) {
			$post_type_args['name'] = $args['post_type'];
		}

		$_post_types = get_post_types($post_type_args , 'objects');

		$post_types  = [];
		$post_types[ 'any' ]  = esc_html__('Any', 'woovina-elementor-widgets');

		foreach($_post_types as $post_type => $object) {
			$post_types[ $post_type ] = $object->label;
		}

		return $post_types;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Admin ajax, put it in data so that it works in the edit mode of Elementor
		$ajax = admin_url('admin-ajax.php');

		// If ajax
		$classes = 'woovina-searchform';
		if('yes' == $settings['enable_ajax']) {
			$classes .= ' wew-ajax-search';
		}

		// Placeholder
		$placeholder = '';
		if(! empty($settings['placeholder'])) {
			$placeholder = ' placeholder="'. $settings['placeholder'] .'"';
		} ?>

		<div class="wew-search-wrap" data-ajaxurl="<?php echo esc_url($ajax); ?>">
			<form method="get" class="<?php echo esc_attr($classes); ?>" action="<?php echo esc_url(home_url('/')); ?>">
				<input type="text" class="field" name="s" <?php echo $placeholder; ?>>
				<button type="submit" class="search-submit" value=""><i class="icon-magnifier"></i> <?php esc_html_e( 'Search', 'woovina-elementor-widgets' ); ?></button>
				<input type="hidden" class="post-type" name="post_type" value="<?php echo esc_attr($settings['source']); ?>">
			</form>
			<?php
			if('yes' == $settings['enable_ajax']) { ?>
				<div class="wew-ajax-loading"></div>
				<div class="wew-search-results"></div>
			<?php
			} ?>
		</div>

	<?php
	}

	// No template because it cause a js error in the edit mode
	protected function _content_template() {}

}