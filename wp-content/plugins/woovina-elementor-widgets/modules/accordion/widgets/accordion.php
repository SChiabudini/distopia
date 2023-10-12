<?php
namespace wvnElementor\Modules\Accordion\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Accordion extends Widget_Base {

	public function get_name() {
		return 'wew-accordion';
	}

	public function get_title() {
		return __('Accordion', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-accordion';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-accordion' ];
	}

	public function get_style_depends() {
		return [ 'wew-accordion' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_accordion',
			[
				'label' 		=> __('Accordion', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' 		=> __('Items', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   	=> __('Accordion #1', 'woovina-elementor-widgets'),
						'tab_content' 	=> __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
					],
					[
						'tab_title'   	=> __('Accordion #2', 'woovina-elementor-widgets'),
						'tab_content' 	=> __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
					],
					[
						'tab_title'   	=> __('Accordion #3', 'woovina-elementor-widgets'),
						'tab_content' 	=> __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
					],
				],
				'fields' => [
					[
						'name'        	=> 'tab_title',
						'label'       	=> __('Title & Content', 'woovina-elementor-widgets'),
						'type'        	=> Controls_Manager::TEXT,
						'default'     	=> __('Accordion Title' , 'woovina-elementor-widgets'),
						'label_block' 	=> true,
						'dynamic' 		=> [ 'active' => true ],
					],
					[
						'name'    		=> 'source',
						'label'   		=> __('Select Source', 'woovina-elementor-widgets'),
						'type'    		=> Controls_Manager::SELECT,
						'default' 		=> 'custom',
						'options' 		=> [
							'custom'    => __('Custom', 'woovina-elementor-widgets'),
							'template' 	=> __('Template', 'woovina-elementor-widgets'),
						],
					],
					[
						'name'       	=> 'tab_content',
						'label'      	=> __('Content', 'woovina-elementor-widgets'),
						'type'       	=> Controls_Manager::WYSIWYG,
						'default' 		=> __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
						'show_label' 	=> false,
						'condition' 	=> [
							'source' => 'custom',
						],
						'dynamic' 		=> [ 'active' => true ],
					],
					[
						'name'        	=> 'templates',
						'label'       	=> __('Content', 'woovina-elementor-widgets'),
						'type'        	=> Controls_Manager::SELECT,
						'default' 		=> '0',
						'options' 		=> wew_get_available_templates(),
						'condition' 	=> [
							'source' => 'template',
						],
					],
				],
				'title_field' 	=> '{{{ tab_title }}}',
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __('Icon', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> 'fa fa-plus',
			]
		);

		$this->add_control(
			'active_icon',
			[
				'label' 		=> __('Active Icon', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> 'fa fa-minus',
				'condition'   	=> [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' 		=> __('HTML Tag', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'div',
				'options' 		=> wew_get_available_tags(),
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
			'multiple',
			[
				'label' 		=> __('Open Multiple Items', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'active_item',
			[
				'label' 		=> __('Active Item No', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::NUMBER,
				'min'   		=> 1,
				'max'   		=> 20,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __('Item', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .wew-accordion .wew-accordion-title'   => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .wew-accordion .wew-accordion-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_spacing',
			[
				'label' 		=> __('Item Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-item + .wew-accordion-item' => 'margin-top: {{SIZE}}{{UNIT}};',
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
				'name' 			=> 'title_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-accordion .wew-accordion-title',
			]
		);

		$this->start_controls_tabs('tabs_title_style');

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'title_background_color',
				'selector' 		=> '{{WRAPPER}} .wew-accordion .wew-accordion-title',
			)
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'title_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-accordion .wew-accordion-item .wew-accordion-title',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'title_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .wew-accordion .wew-accordion-item .wew-accordion-title',
			]
		);

		$this->add_control(
			'title_border_radius',
			[
				'label'      	=> __('Border Radius', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-item .wew-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      	=> __('Padding', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' 		=> __('Active', 'woovina-elementor-widgets'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'title_active_background_color',
				'selector' 		=> '{{WRAPPER}} .wew-accordion .wew-accordion-item.wew-active .wew-accordion-title',
			)
		);

		$this->add_control(
			'title_active_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-item.wew-active .wew-accordion-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'title_active_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-accordion .wew-accordion-item.wew-active .wew-accordion-title',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'title_active_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .wew-accordion .wew-accordion-item.wew-active .wew-accordion-title',
			]
		);

		$this->add_control(
			'title_active_border_radius',
			[
				'label'      	=> __('Border Radius', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-item.wew-active .wew-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
			'icon_align',
			[
				'label'   		=> __('Alignment', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' => [
						'title' => __('Start', 'woovina-elementor-widgets'),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __('End', 'woovina-elementor-widgets'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'     	=> is_rtl() ? 'left' : 'right',
				'toggle'      	=> false,
				'label_block' 	=> false,
				'condition'   	=> [
					'icon!' => '',
				],
			]
		);

		$this->start_controls_tabs('tabs_icon_style');

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-title .wew-accordion-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_active',
			[
				'label' 		=> __('Active', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-item.wew-active .wew-accordion-title .wew-accordion-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' 		=> __('Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-icon.wew-accordion-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-accordion .wew-accordion-icon.wew-accordion-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' 		=> __('Content', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-accordion .wew-accordion-content',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'content_background_color',
				'selector' 		=> '{{WRAPPER}} .wew-accordion .wew-accordion-content',
			)
		);

		$this->add_control(
			'content_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label' 		=> __('Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-content'  => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'content_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-accordion .wew-accordion-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'content_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .wew-accordion .wew-accordion-content',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label'      	=> __('Border Radius', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      	=> __('Padding', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-accordion .wew-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$id 		= $this->get_id();
		$title_tag 	= $settings['title_html_tag'];
		$data 		= [
            'multiple' => ('yes' == $settings['multiple']) ? 'true' : 'false',
        ];

        if(! empty($settings['active_item'])) {
        	$data['active_item'] = $settings['active_item'];
			$this->add_render_attribute('wrap', 'class', 'wew-has-active-item');
		}

		$this->add_render_attribute('wrap', 'id', 'wew-accordion-' . esc_attr($id));
		$this->add_render_attribute('wrap', 'class', 'wew-accordion');
    	$this->add_render_attribute('wrap', 'data-settings', wp_json_encode($data)); ?>

		<div <?php echo $this->get_render_attribute_string('wrap'); ?>>

			<?php
			foreach($settings['tabs'] as $index => $item) :
				$tab_count 			= $index + 1;
				$tab_title_key 		= $this->get_repeater_setting_key('tab_title', 'tabs', $index);
				$tab_content_key 	= $this->get_repeater_setting_key('tab_content', 'tabs', $index);

				$this->add_render_attribute($tab_title_key, 'class', 'wew-accordion-title');
				$this->add_render_attribute($tab_content_key, 'class', 'wew-accordion-content');
				$this->add_inline_editing_attributes($tab_content_key, 'advanced'); ?>

				<div class="wew-accordion-item<?php echo ($tab_count === $settings['active_item']) ? ' wew-active' : ''; ?>">
					<<?php echo $title_tag; ?> <?php echo $this->get_render_attribute_string($tab_title_key); ?>>
						<?php
						if($settings['icon']) { ?>
							<span class="wew-accordion-icon wew-accordion-icon-<?php echo esc_attr($settings['icon_align']); ?>" aria-hidden="true">
								<i class="wew-accordion-icon-closed <?php echo esc_attr($settings['icon']); ?>"></i>
								<i class="wew-accordion-icon-opened <?php echo esc_attr($settings['active_icon']); ?>"></i>
							</span>
						<?php
						} ?>

						<?php echo $item['tab_title']; ?>
					</<?php echo $title_tag; ?>>

					<div <?php echo $this->get_render_attribute_string($tab_content_key); ?>>
						<?php
		            	if('custom' == $item['source']
		            		&& ! empty($item['tab_content'])) {
		            		echo wp_kses_post($item['tab_content']);
		            	} else if('template' == $item['source']
		            		&& ('0' != $item['templates'] && ! empty($item['templates']))) {
		            		echo Plugin::instance()->frontend->get_builder_content_for_display($item['templates']);
		            	} ?>
					</div>
				</div>
			<?php
			endforeach; ?>

		</div>

	<?php
	}
}