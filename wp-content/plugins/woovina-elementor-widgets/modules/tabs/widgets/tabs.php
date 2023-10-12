<?php
namespace wvnElementor\Modules\Tabs\Widgets;

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

class Tabs extends Widget_Base {

	public function get_name() {
		return 'wew-tabs';
	}

	public function get_title() {
		return __('Tabs', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-tabs';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-tabs' ];
	}

	public function get_style_depends() {
		return [ 'wew-tabs' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_tabs',
			[
				'label' 		=> __('Tabs', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' 		=> __('Items', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   	=> __('Tab #1', 'woovina-elementor-widgets'),
						'tab_content' 	=> __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
					],
					[
						'tab_title'   	=> __('Tab #2', 'woovina-elementor-widgets'),
						'tab_content' 	=> __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
					],
					[
						'tab_title'   	=> __('Tab #3', 'woovina-elementor-widgets'),
						'tab_content' 	=> __('I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'woovina-elementor-widgets'),
					],
				],
				'fields' => [
					[
						'name'        	=> 'tab_title',
						'label'       	=> __('Title & Content', 'woovina-elementor-widgets'),
						'type'        	=> Controls_Manager::TEXT,
						'default'     	=> __('Tab Title' , 'woovina-elementor-widgets'),
						'label_block' 	=> true,
						'dynamic' 		=> [ 'active' => true ],
					],
					[
						'name'        	=> 'tab_icon',
						'label'       	=> __('Icon', 'woovina-elementor-widgets'),
						'type'        	=> Controls_Manager::ICON,
						'default'     	=> '',
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
			'tab_layout',
			[
				'label'   		=> __('Layout', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'top',
				'options' 		=> [
					'top' 		=> __('Top', 'woovina-elementor-widgets'),
					'bottom'  	=> __('Bottom', 'woovina-elementor-widgets'),
					'left'    	=> __('Left', 'woovina-elementor-widgets'),
					'right'   	=> __('Right', 'woovina-elementor-widgets'),
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'align',
			[
				'label'   		=> __('Alignment', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    => [
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
					'justify' => [
						'title' => __('Justified', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'condition' 	=> [
					'tab_layout' => [ 'top', 'bottom' ]
				],
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
				'label' 		=> __('Tab', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'tab_spacing',
			[
				'label' 		=> __('Tab Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-tabs-wrap' => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-tabs-wrap .wew-tab-title' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-tabs-left .wew-tabs-wrap .wew-tab-title, {{WRAPPER}} .wew-tabs-right .wew-tabs-wrap .wew-tab-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'tab_typography',
				'scheme' 		=> Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .wew-tabs .wew-tab-title',
			]
		);

		$this->start_controls_tabs('tabs_tab_style');

		$this->start_controls_tab(
			'tab_tab_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'tab_background_color',
				'selector' 		=> '{{WRAPPER}} .wew-tabs .wew-tab-title',
			)
		);

		$this->add_control(
			'tab_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'tab_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-tabs .wew-tab-title',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'tab_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .wew-tabs .wew-tab-title',
			]
		);

		$this->add_control(
			'tab_border_radius',
			[
				'label'      	=> __('Border Radius', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label'      	=> __('Padding', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_tab_active',
			[
				'label' 		=> __('Active', 'woovina-elementor-widgets'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'tab_active_background_color',
				'selector' 		=> '{{WRAPPER}} .wew-tabs .wew-tab-title.wew-active',
			)
		);

		$this->add_control(
			'tab_active_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-title.wew-active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'tab_active_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-tabs .wew-tab-title.wew-active',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'tab_active_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .wew-tabs .wew-tab-title.wew-active',
			]
		);

		$this->add_control(
			'tab_active_border_radius',
			[
				'label'      	=> __('Border Radius', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-title.wew-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
				'selector' 		=> '{{WRAPPER}} .wew-tabs .wew-tab-content',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'content_background_color',
				'selector' 		=> '{{WRAPPER}} .wew-tabs .wew-tabs-content-wrap',
			)
		);

		$this->add_control(
			'content_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label' 		=> __('Content Spacing', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-tabs.wew-tabs-top .wew-tab-content' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-tabs.wew-tabs-bottom .wew-tab-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-tabs.wew-tabs-left .wew-tab-content' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-tabs.wew-tabs-right .wew-tab-content' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'content_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-tabs .wew-tabs-content-wrap',
			]
		);

		$this->add_responsive_control(
			'content_border_width',
			[
				'label' 		=> __('Border Width', 'elementor'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 1,
				],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wew-tabs .wew-tab-content, {{WRAPPER}} .wew-tabs .wew-tab-mobile-title' => 'border-width: {{SIZE}}{{UNIT}}; border-top: 0;',
					'{{WRAPPER}} .wew-tabs .wew-tabs-content-wrap' => 'border-top-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_border_style',
			[
				'label'   		=> __('Border Style', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'solid',
				'options' 		=> [
					'none' 		=> __('None', 'woovina-elementor-widgets'),
					'solid'  	=> __('Solid', 'woovina-elementor-widgets'),
					'double'    => __('Double', 'woovina-elementor-widgets'),
					'dotted'   	=> __('Dotted', 'woovina-elementor-widgets'),
					'dashed'   	=> __('Dashed', 'woovina-elementor-widgets'),
					'groove'   	=> __('Groove', 'woovina-elementor-widgets'),
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-content, {{WRAPPER}} .wew-tabs .wew-tab-mobile-title, {{WRAPPER}} .wew-tabs .wew-tabs-content-wrap' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_border_color',
			[
				'label' 		=> __('Border Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-content, {{WRAPPER}} .wew-tabs .wew-tab-mobile-title, {{WRAPPER}} .wew-tabs .wew-tabs-content-wrap' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label'      	=> __('Border Radius', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-tabs .wew-tabs-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wew-tabs .wew-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' 		=> __('Icon', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
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
				'default'     	=> is_rtl() ? 'right' : 'left',
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
				'selectors' 	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-title i' => 'color: {{VALUE}};',
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
				'selectors' 	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-title.wew-active i' => 'color: {{VALUE}};',
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
				'selectors' 	=> [
					'{{WRAPPER}} .wew-tabs .wew-tab-title .wew-icon-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-tabs .wew-tab-title .wew-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$id_int 	= substr($this->get_id_int(), 0, 3);
		$layout 	= $settings['tab_layout'];

		$this->add_render_attribute('wrap', 'class', [
			'wew-tabs',
			'wew-tabs-' . $layout
		]);

        if(! empty($settings['active_item'])) {
			$data = [ $settings['active_item'] ];
			$this->add_render_attribute('wrap', 'class', 'wew-has-active-item');
    		$this->add_render_attribute('wrap', 'data-settings', wp_json_encode($data));
		}

		$this->add_render_attribute('tabs-wrap', 'class', 'wew-tabs-wrap');

        if('top' == $layout
        	|| 'bottom' == $layout) {
			$this->add_render_attribute('tabs-wrap', 'class', [
				'wew-tabs-normal',
				'wew-tabs-' . $settings['align']
			]);
		} ?>

		<div <?php echo $this->get_render_attribute_string('wrap'); ?>>

			<?php
			if('bottom' != $layout) { ?>
				<div <?php echo $this->get_render_attribute_string('tabs-wrap'); ?>>
					<?php
					foreach($settings['tabs'] as $index => $item) :
						$tab_count 		= $index + 1;
						$active_item 	= ($tab_count === $settings['active_item']) ? ' wew-active' : '';
						$tab_title_key 	= $this->get_repeater_setting_key('tab_title', 'tabs', $index);

						$this->add_render_attribute($tab_title_key, [
							'id' 			=> 'wew-tab-title-' . $id_int . $tab_count,
							'class' 		=> [ 'wew-tab-title', $active_item ],
							'data-tab' 		=> $tab_count,
							'tabindex' 		=> $id_int . $tab_count,
							'role' 			=> 'tab',
							'aria-controls' => 'wew-tab-content-' . $id_int . $tab_count,
						]); ?>

						<div <?php echo $this->get_render_attribute_string($tab_title_key); ?>>
							<?php
							if(! empty($item['tab_icon'])
								&& 'left' == $settings['icon_align']) { ?>
								<span class="wew-icon-align-<?php echo esc_html($settings['icon_align']); ?>">
									<i class="<?php echo esc_attr($item['tab_icon']); ?>"></i>
								</span>
							<?php
							}

							if($item['tab_title']) {
								echo $item['tab_title'];
							}

							if(! empty($item['tab_icon'])
								&& 'right' == $settings['icon_align']) { ?>
								<span class="wew-icon-align-<?php echo esc_html($settings['icon_align']); ?>">
									<i class="<?php echo esc_attr($item['tab_icon']); ?>"></i>
								</span>
							<?php
							} ?>
						</div>
					<?php
					endforeach; ?>
				</div>
			<?php
			} ?>

			<div class="wew-tabs-content-wrap">
				<?php
				foreach($settings['tabs'] as $index => $item) :
					$tab_count 				= $index + 1;
					$active_item 			= ($tab_count === $settings['active_item']) ? ' wew-active' : '';
					$tab_content_key 		= $this->get_repeater_setting_key('tab_content', 'tabs', $index);
					$tab_title_mobile_key 	= $this->get_repeater_setting_key('tab_title_mobile', 'tabs', $tab_count);

					$this->add_render_attribute($tab_content_key, [
						'id' 				=> 'wew-tab-content-' . $tab_count,
						'class' 			=> [ 'wew-tab-content', $active_item ],
						'role' 				=> 'tabpanel',
						'aria-labelledby' 	=> 'wew-tab-title-' . $id_int . $tab_count,
					]);

					$this->add_render_attribute($tab_title_mobile_key, [
						'class' 	=> [ 'wew-tab-title', 'wew-tab-mobile-title', $active_item ],
						'tabindex' 	=> $id_int . $tab_count,
						'data-tab' 	=> $tab_count,
						'role' 		=> 'tab',
					]); ?>

					<div <?php echo $this->get_render_attribute_string($tab_title_mobile_key); ?>>
						<?php
						if(! empty($item['tab_icon'])
							&& 'left' == $settings['icon_align']) { ?>
							<span class="wew-icon-align-<?php echo esc_html($settings['icon_align']); ?>">
								<i class="<?php echo esc_attr($item['tab_icon']); ?>"></i>
							</span>
						<?php
						}

						if($item['tab_title']) {
							echo $item['tab_title'];
						}

						if(! empty($item['tab_icon'])
							&& 'right' == $settings['icon_align']) { ?>
							<span class="wew-icon-align-<?php echo esc_html($settings['icon_align']); ?>">
								<i class="<?php echo esc_attr($item['tab_icon']); ?>"></i>
							</span>
						<?php
						} ?>
					</div>

					<div <?php echo $this->get_render_attribute_string($tab_content_key); ?>>
						<?php
		            	if('custom' == $item['source']
		            		&& ! empty($item['tab_content'])) {
		            		echo $item['tab_content'];
		            	} else if('template' == $item['source']
		            		&& ('0' != $item['templates'] && ! empty($item['templates']))) {
		            		echo Plugin::instance()->frontend->get_builder_content_for_display($item['templates']);
		            	} ?>
					</div>
				<?php
				endforeach; ?>
			</div>

			<?php
			if('bottom' == $layout) { ?>
				<div <?php echo $this->get_render_attribute_string('tabs-wrap'); ?>>
					<?php
					foreach($settings['tabs'] as $index => $item) :
						$tab_count 		= $index + 1;
						$active_item 	= ($tab_count === $settings['active_item']) ? ' wew-active' : '';
						$tab_title_key 	= $this->get_repeater_setting_key('tab_title', 'tabs', $index);

						$this->add_render_attribute($tab_title_key, [
							'id' 			=> 'wew-tab-title-' . $id_int . $tab_count,
							'class' 		=> [ 'wew-tab-title', $active_item ],
							'data-tab' 		=> $tab_count,
							'tabindex' 		=> $id_int . $tab_count,
							'role' 			=> 'tab',
							'aria-controls' => 'wew-tab-content-' . $id_int . $tab_count,
						]); ?>

						<div <?php echo $this->get_render_attribute_string($tab_title_key); ?>>
							<?php
							if(! empty($item['tab_icon'])
								&& 'left' == $settings['icon_align']) { ?>
								<span class="wew-icon-align-<?php echo esc_html($settings['icon_align']); ?>">
									<i class="<?php echo esc_attr($item['tab_icon']); ?>"></i>
								</span>
							<?php
							}

							if($item['tab_title']) {
								echo $item['tab_title'];
							}

							if(! empty($item['tab_icon'])
								&& 'right' == $settings['icon_align']) { ?>
								<span class="wew-icon-align-<?php echo esc_html($settings['icon_align']); ?>">
									<i class="<?php echo esc_attr($item['tab_icon']); ?>"></i>
								</span>
							<?php
							} ?>
						</div>
					<?php
					endforeach; ?>
				</div>
			<?php
			} ?>

		</div>

	<?php
	}
}