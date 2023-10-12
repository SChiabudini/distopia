<?php
namespace wvnElementor\Modules\Timeline\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Timeline extends Widget_Base {

	public function get_name() {
		return 'wew-timeline';
	}

	public function get_title() {
		return __('Timeline', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-time-line';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-timeline' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_timeline_layout',
			[
				'label' 		=> __('Layout', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'source',
			[
				'label'   		=> __('Source', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'post',
				'options' 		=> [
					'post'  	=> __('Post', 'woovina-elementor-widgets'),
					'custom'  	=> __('Custom Content', 'woovina-elementor-widgets'),
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
				'default' 		=> 'center',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_query',
			[
				'label' 		=> __('Query', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'source' => 'post',
				],
			]
		);

		$this->add_control(
			'query_source',
			[
				'label'   		=> __('Source', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					''  		=> __('Show All', 'woovina-elementor-widgets'),
					'manual'  	=> __('Manual Selection', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'categories',
			[
				'label'   		=> __('Categories', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT2,
				'default' 		=> '0',
				'multiple'    	=> true,
				'options' 		=> $this->get_available_categories(),
				'condition' 	=> [
					'query_source' => 'manual',
				],
			]
		);

		$this->add_control(
			'number_posts',
			[
				'label' 		=> __('Number of Posts', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '4',
			]
		);

		$this->add_control(
			'order',
			[
				'label' 		=> __('Order', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					'' 			=> __('Default', 'woovina-elementor-widgets'),
					'DESC' 		=> __('DESC', 'woovina-elementor-widgets'),
					'ASC' 		=> __('ASC', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' 		=> __('Order By', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'date',
				'options' 		=> [
					'date' 			=> __('Date', 'woovina-elementor-widgets'),
					'title' 		=> __('Title', 'woovina-elementor-widgets'),
					'category' 		=> __('Category', 'woovina-elementor-widgets'),
					'rand' 			=> __('Random', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_custom',
			[
				'label' 		=> __('Custom Content', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'source' => 'custom',
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label' 		=> __('List Items', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
					[
						'name' => 'timeline_title',
						'label' => __('Title', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::TEXT,
						'default' => __('Your timeline title here', 'woovina-elementor-widgets'),
						'label_block' => 'true',
						'dynamic' => [ 'active' => true ],
					],
					[
						'name' => 'timeline_date',
						'label' => __('Date', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::TEXT,
						'default' => __('13 October 2018', 'woovina-elementor-widgets'),
						'dynamic' => [ 'active' => true ],
					],
					[
						'name' => 'timeline_image',
						'label' => __('Image', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'dynamic' => [ 'active' => true ],
					],
					[
						'name' => 'timeline_text',
						'label' => __('Content', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::WYSIWYG,
						'default' => __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
						'dynamic' => [ 'active' => true ],
					],
					[
						'name' => 'timeline_link',
						'label' => __('Item Link', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::TEXT,
						'placeholder' => __('https://your-link.com', 'woovina-elementor-widgets'),
						'default' => '#',
						'dynamic' => [ 'active' => true ],
					],
					[
						'name' => 'timeline_icon',
						'label' => __('Timeline Icon', 'woovina-elementor-widgets'),
						'type' => Controls_Manager::ICON,
						'default' => 'fa fa-file-text',
					],
				],
				'default' 		=> [
					[
						'timeline_title' => __('Your timeline title here #1', 'woovina-elementor-widgets'),
						'timeline_text' => __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
						'timeline_icon'  => 'fa fa-file-text',
					],
					[
						'timeline_title' => __('Your timeline title here #2', 'woovina-elementor-widgets'),
						'timeline_text' => __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
						'timeline_icon'  => 'fa fa-file-text',
					],
					[
						'timeline_title' => __('Your timeline title here #3', 'woovina-elementor-widgets'),
						'timeline_text' => __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
						'timeline_icon'  => 'fa fa-file-text',
					],
					[
						'timeline_title' => __('Your timeline title here #4', 'woovina-elementor-widgets'),
						'timeline_text' => __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
						'timeline_icon'  => 'fa fa-file-text',
					],
				],
				'title_field' 	=> '{{{ timeline_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			[
				'label' 		=> __('Additional Options', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'show_image',
			[
				'label' 		=> __('Image', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' 		=> __('Title', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label' 		=> __('Meta', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' 		=> __('Excerpt', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' 		=> __('Excerpt Length', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '20',
				'condition' 	=> [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_readmore',
			[
				'label' 		=> __('Read More', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label' 		=> __('Read More Text', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __('Read More', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'show_readmore' => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __('Icon', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> 'fa fa-long-arrow-right',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' 		=> __('Icon Position', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'right',
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
				'default' 		=> [
					'size' => 4,
				],
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-readmore .wew-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-timeline .wew-timeline-readmore .wew-align-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_item_style',
			[
				'label' 		=> __('Item', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'timeline_item_bg',
			[
				'label'     	=> esc_html__('Background Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-item-main' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'timeline_item_border',
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-item-main',
			]
		);

		$this->add_control(
			'timeline_item_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-item-main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'timeline_item_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-item-main',
			]
		);

		$this->add_responsive_control(
			'timeline_item_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-item-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' 		=> __('Image', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'timeline_image_max_width',
			[
				'label' 		=> __('Max Width', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 1200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-thumbnail' => 'width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'timeline_image_border',
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-thumbnail',
			]
		);

		$this->add_control(
			'timeline_image_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'timeline_image_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-thumbnail',
			]
		);

		$this->add_responsive_control(
			'timeline_image_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' 		=> __('Title', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_title_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-title',
			]
		);

		$this->start_controls_tabs('tabs_timeline_title_style');

		$this->start_controls_tab(
			'tab_timeline_title_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'timeline_title_color',
			[
				'label'     	=> esc_html__('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_timeline_title_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'timeline_title_hover_color',
			[
				'label'     	=> esc_html__('Hover Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'timeline_title_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_meta_style',
			[
				'label' 		=> __('Meta', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_meta_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-meta',
			]
		);

		$this->start_controls_tabs('tabs_timeline_meta_style');

		$this->start_controls_tab(
			'tab_timeline_meta_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'timeline_meta_color',
			[
				'label'     	=> esc_html__('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-meta, {{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-meta a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_timeline_meta_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'timeline_meta_hover_color',
			[
				'label'     	=> esc_html__('Hover Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'timeline_meta_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_excerpt_style',
			[
				'label' 		=> __('Excerpt', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_excerpt_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-excerpt',
			]
		);

		$this->add_control(
			'timeline_excerpt_color',
			[
				'label'     	=> esc_html__('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'timeline_excerpt_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_button_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore',
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_timeline_button_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'timeline_button_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_button_text_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_timeline_button_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'timeline_button_hover_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_button_hover_color',
			[
				'label' 		=> __('Text Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_button_hover_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'timeline_button_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'timeline_button_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'timeline_button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore',
			]
		);

		$this->add_responsive_control(
			'timeline_button_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'timeline_button_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_timeline_icon_style',
			[
				'label' 		=> __('Icon', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'timeline_icon_size',
			[
				'label' 		=> __('Icon Size', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 35,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-icon span:after, {{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-custom-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'timeline_icon_background_color',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '#ffffff',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-icon span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_icon_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-icon span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'timeline_icon_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-icon span',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'timeline_icon_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-icon span',
			]
		);

		$this->add_responsive_control(
			'timeline_icon_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'%' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'default' 		=> [
					'size' 	=> 50,
					'unit' 	=> '%',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-icon span' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'timeline_icon_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 35,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-icon span' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_timeline_line_style',
			[
				'label' 		=> __('Line', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'timeline_line_width',
			[
				'label' 		=> __('Width', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'default' 		=> [
					'size' => 3,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-line span' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'timeline_line_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-item-wrap .wew-timeline-line span' => 'background-color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_timeline_date_style',
			[
				'label' 		=> __('Date', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_date_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-date span',
			]
		);

		$this->add_control(
			'timeline_date_bg',
			[
				'label'     	=> esc_html__('Background Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-date span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_date_color',
			[
				'label'     	=> esc_html__('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-date span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'timeline_date_border',
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-date span',
			]
		);

		$this->add_control(
			'timeline_date_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-date span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'timeline_date_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-timeline .wew-timeline-date span',
			]
		);

		$this->add_responsive_control(
			'timeline_date_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-timeline .wew-timeline-date span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function get_available_categories() {

		$categories = get_terms('category');

		$result = array(__('-- Select --', 'woovina-elementor-widgets'));

		foreach($categories as $category) {
			$result[ $category->slug ] = $category->name;
		}

		return $result;
	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$source 	= $settings['source'];
		$align 		= $settings['align'];
		$items 		= $settings['items'];

		$this->add_render_attribute('wrap', 'class', [
			'wew-timeline',
			'wew-timeline-' . $align,
		]);

		$this->add_render_attribute('inner', 'class', 'wew-timeline-inner');

		// If posts
		if('post' == $source) {
			global $post;

			$args = array(
				'posts_per_page' => $settings['number_posts'],
				'order'          => $settings['order'],
				'orderby'        => $settings['orderby'],
				'post_status'    => 'publish'
			);
			
			if('manual' == $settings['query_source']) {
				$args['tax_query'][] = array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $settings['categories'],
				);
			}

			$query = new \WP_Query($args);

			if($query->have_posts()) : ?> 

				<div <?php echo $this->get_render_attribute_string('wrap'); ?>>
					<div <?php echo $this->get_render_attribute_string('inner'); ?>>

						<?php
						$count = 0;

						while($query->have_posts()) : $query->the_post();
							$count++;

							$thumbnail 		= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
							$post_format 	= get_post_format() ? : 'standard';
							$category 		= '';
							$position 		= ($count%2 == 0) ? 'right' : 'left';
							$date_class 	= ('center' == $align) ? 'hidden' : 'normal';
					  		
							if($count%2 == 0
								&& 'center' == $align) { ?>
					  			<div class="wew-timeline-item">
							  		<div class="wew-timeline-date wew-timeline-date-right"><span><?php echo esc_attr(get_the_date('d F Y')); ?></span></div>
								</div>
							<?php
							} ?>

				  			<div class="wew-timeline-item wew-timeline-item-<?php echo esc_attr($position); ?>">
					  			<div class="wew-timeline-item-wrap">

					  				<div class="wew-timeline-line<?php echo $query->current_post + 1 === $query->post_count ? ' wew-last-line' : '' ?>"><span></span></div>

						  			<div class="wew-timeline-item-container">
						  				<div class="wew-timeline-icon wew-timeline-post-icon wew-post-format-<?php echo esc_attr($post_format); ?>"><span></span></div>

							  			<div class="wew-timeline-item-main">
							  				<span class="wew-timeline-arrow"></span>

							  				<?php
							  				if('yes' == $settings['show_image']
							  					&& isset($thumbnail[0])) { ?>
										  		<div class="wew-timeline-thumbnail">
													<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
										  				<img src="<?php echo esc_url($thumbnail[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
										  			</a>
										  		</div>
									  		<?php
									  		} ?>

									  		<div class="wew-timeline-desc">
												<?php
												if('yes' == $settings['show_title']) { ?>
													<h4 class="wew-timeline-title">
														<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php echo esc_html(get_the_title()); ?></a>
													</h4>
												<?php
									  			}

												if('yes' == $settings['show_meta']) { ?>
													<ul class="wew-timeline-meta">
														<li class="wew-timeline-meta-date wew-timeline-<?php echo esc_attr($date_class); ?>"><?php echo esc_attr(get_the_date('d F Y')); ?></li>
														<li><?php echo get_the_category_list(', '); ?></li>															
													</ul>
												<?php
												}

												if('yes' == $settings['show_excerpt']) { ?>
													<div class="wew-timeline-excerpt"><?php do_shortcode(the_excerpt()); ?></div>
												<?php
												}

												if('yes' == $settings['show_readmore']) { ?>
													<a href="<?php echo esc_url(get_permalink()); ?>" class="wew-timeline-readmore button">
														<?php
														if($settings['icon'] && 'left' == $settings['icon_align']) { ?>
															<span class="wew-button-icon wew-align-<?php echo esc_attr($settings['icon_align']); ?>">
																<i class="<?php echo esc_attr($settings['icon']); ?>"></i>
															</span>
														<?php
														} ?>

														<?php echo esc_html($settings['readmore_text']); ?>

														<?php
														if($settings['icon'] && 'right' == $settings['icon_align']) { ?>
															<span class="wew-button-icon wew-align-<?php echo esc_attr($settings['icon_align']); ?>">
																<i class="<?php echo esc_attr($settings['icon']); ?>"></i>
															</span>
														<?php
														} ?>
													</a>
												<?php
												} ?>
									  		</div>
										</div>
									</div>
								</div>
							</div>

						  	<?php
						  	if($count%2 == 1
						  		&& ('center' == $align)) { ?>
						  		<?php 
						  		$position = ($count%2 == 1) ? 'right' : 'left'; ?>
					  			<div class="wew-timeline-item">
							  		<div class="wew-timeline-date"><span><?php echo esc_attr(get_the_date('d F Y')); ?></span></div>
								</div>
							<?php
							} ?>

						<?php
						endwhile; ?>

					</div>
				</div>
			
			 	<?php 
			 	wp_reset_postdata();

	 		endif;

		}

		// If custom content
		else if('custom' == $source) { ?>

			<div <?php echo $this->get_render_attribute_string('wrap'); ?>>
				<div <?php echo $this->get_render_attribute_string('inner'); ?>>

					<?php
					$count = 0;
					$i = 1;

					foreach($items as $item) :
						$count++;

						$position 		= ($count%2 == 0) ? 'right' : 'left';
						$date_class 	= ('center' == $align) ? 'hidden' : '';
						$image_url 		= wp_get_attachment_image_src($item['timeline_image']['id'], 'full');
						$image_url 		= ('' != $image_url) ? $image_url[0] : $item['timeline_image']['url'];

						if($count%2 == 0
							&& 'center' == $align) { ?>
							<div class="wew-timeline-item">
						  		<div class="wew-timeline-date wew-timeline-date-right"><span><?php echo esc_attr($item['timeline_date']); ?></span></div>
							</div>
						<?php
						} ?>

				  		<div class="wew-timeline-item wew-timeline-item-<?php echo esc_attr($position); ?>">
				  			<div class="wew-timeline-item-wrap">

				  				<div class="wew-timeline-line"><span></span></div>

					  			<div class="wew-timeline-item-container">
					  				<div class="wew-timeline-icon wew-timeline-custom-icon"><span><i class="<?php echo esc_attr($item['timeline_icon']); ?>"></i></span></div>

						  			<div class="wew-timeline-item-main">
						  				<span class="wew-timeline-arrow"></span>

						  				<?php
						  				if('yes' == $settings['show_image']) { ?>
									  		<div class="wew-timeline-thumbnail">
												<a href="<?php echo esc_url($item['timeline_link']); ?>" title="<?php echo esc_attr($item['timeline_title']); ?>">
									  				<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($item['timeline_title']); ?>">
									  			</a>
									  		</div>
								  		<?php
								  		} ?>

								  		<div class="wew-timeline-desc">
											<?php
											if('yes' == $settings['show_title']) { ?>
												<h4 class="wew-timeline-title">
													<a href="<?php echo esc_url($item['timeline_link']); ?>" title="<?php echo esc_attr($item['timeline_title']); ?>"><?php echo esc_html($item['timeline_title']); ?></a>
												</h4>
											<?php
								  			}

											if('yes' == $settings['show_meta']) { ?>
												<ul class="wew-timeline-meta wew-timeline-<?php echo esc_attr($date_class); ?>">
													<li><?php echo esc_attr($item['timeline_date']); ?></li>
												</ul>
											<?php
											}

											if('yes' == $settings['show_excerpt']) { ?>
												<div class="wew-timeline-excerpt"><?php echo do_shortcode($item['timeline_text']); ?></div>
											<?php
											}

											if('yes' == $settings['show_readmore']) { ?>
												<a href="<?php echo esc_url($item['timeline_link']); ?>" class="wew-timeline-readmore button">
													<?php
													if($settings['icon'] && 'left' == $settings['icon_align']) { ?>
														<span class="wew-button-icon wew-align-<?php echo esc_attr($settings['icon_align']); ?>">
															<i class="<?php echo esc_attr($settings['icon']); ?>"></i>
														</span>
													<?php
													} ?>

													<?php echo esc_html($settings['readmore_text']); ?>

													<?php
													if($settings['icon'] && 'right' == $settings['icon_align']) { ?>
														<span class="wew-button-icon wew-align-<?php echo esc_attr($settings['icon_align']); ?>">
															<i class="<?php echo esc_attr($settings['icon']); ?>"></i>
														</span>
													<?php
													} ?>
												</a>
											<?php
											} ?>
								  		</div>
									</div>
								</div>

							</div>
						</div>

					  	<?php
					  	if($count%2 == 1
					  		&& ('center' == $align)) { ?>
					  		<?php 
					  		$position = ($count%2 == 1) ? 'right' : 'left'; ?>
				  			<div class="wew-timeline-item">
						  		<div class="wew-timeline-date"><span><?php echo esc_attr($item['timeline_date']); ?></span></div>
							</div>
						<?php
						}

					endforeach; ?>

				</div>
			</div>

		<?php
		}

	}

}