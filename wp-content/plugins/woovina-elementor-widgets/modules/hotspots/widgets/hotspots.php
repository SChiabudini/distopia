<?php
namespace wvnElementor\Modules\Hotspots\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Hotspots extends Widget_Base {

	public function get_name() {
		return 'wew-hotspots';
	}

	public function get_title() {
		return __('Hotspots', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-hotspots', 'wew-tooltip' ];
	}

	public function get_style_depends() {
		return [ 'wew-hotspots', 'wew-tooltip' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_hotspots_image',
			[
				'label' 		=> __('Image', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   		=> __('Choose Image', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label' 		=> __('Image Size', 'woovina-elementor-widgets'),
				'default' 		=> 'large',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots',
			[
				'label' 		=> __('Hotspots', 'woovina-elementor-widgets'),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs('hotspots_tabs');

		$repeater->start_controls_tab('tab_content', [ 'label' => __('Content', 'woovina-elementor-widgets') ]);

		$repeater->add_control(
			'hotspot_type',
			[
				'label'			=> __('Type', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'text',
				'options' 		=> [
					'text'  => __('Text', 'woovina-elementor-widgets'),
					'icon'  => __('Icon', 'woovina-elementor-widgets'),
					'blank' => __('Blank', 'woovina-elementor-widgets'),
				],
			]
		);

		$repeater->add_control(
			'hotspot_text',
			[
				'label' 		=> __('Text', 'woovina-elementor-widgets'),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __('1', 'woovina-elementor-widgets'),
				'condition'		=> [
					'hotspot_type' => 'text'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'hotspot_icon',
			[
				'label' 		=> __('Icon', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::ICON,
				'default' 		=> '',
				'condition'		=> [
					'hotspot_type' => 'icon'
				],
			]
		);

		$repeater->add_control(
			'hotspot_link',
			[
				'label' 		=> __('Link', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' => '',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab('tab_position', [ 'label' => __('Position', 'woovina-elementor-widgets') ]);

		$repeater->add_control(
			'hotspot_top_position',
			[
				'label' 	=> __('Top position', 'woovina-elementor-widgets'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
						'step'	=> 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
				],
			]
		);

		$repeater->add_control(
			'hotspot_left_position',
			[
				'label' 	=> __('Left position', 'woovina-elementor-widgets'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
						'step'	=> 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab('tab_tooltip', [ 'label' => __('Tooltip', 'woovina-elementor-widgets') ]);

		$repeater->add_control(
			'tooltip',
			[
				'label' 		=> __('Tooltip', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$repeater->add_control(
			'tooltip_position',
			[
				'label'			=> __('Tooltip Position', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 's',
				'options' 		=> [
					'n' 		=> __('Top', 'woovina-elementor-widgets'),
					'e' 		=> __('Right', 'woovina-elementor-widgets'),
					's' 		=> __('Bottom', 'woovina-elementor-widgets'),
					'w' 		=> __('Left', 'woovina-elementor-widgets'),
					'ne' 		=> __('Top Right', 'woovina-elementor-widgets'),
					'ne-alt' 	=> __('Top Right Alt', 'woovina-elementor-widgets'),
					'nw' 		=> __('Top Left', 'woovina-elementor-widgets'),
					'nw-alt' 	=> __('Top Left Alt', 'woovina-elementor-widgets'),
					'se' 		=> __('Bottom Right', 'woovina-elementor-widgets'),
					'se-alt' 	=> __('Bottom Right Alt', 'woovina-elementor-widgets'),
					'sw' 		=> __('Bottom Left', 'woovina-elementor-widgets'),
					'sw-alt' 	=> __('Bottom Left Alt', 'woovina-elementor-widgets'),
				],
				'condition'		=> [
					'tooltip' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'tooltip_content',
			[
				'label' 		=> __('Tooltip Content', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::WYSIWYG,
				'default' 		=> __('Add your tooltip content here', 'woovina-elementor-widgets'),
				'condition'		=> [
					'tooltip' => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tab();

		$this->add_control(
			'hotspots',
			[
				'label' 		=> __('Hotspots', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::REPEATER,
				'default' 		=> [
					[
						'hotspot_text' => '1',
					],
				],
				'fields' 		=> array_values($repeater->get_controls()),
				'title_field' 	=> '{{{ hotspot_text }}}',
			]
		);

		$this->add_control(
			'disable_pulse',
			[
				'label' 		=> __('Disable Pulse Effect', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
				'return_value' 	=> 'none',
				'selectors'		=> [
					'{{WRAPPER}} .wew-hotspot-inner:before' => 'display: {{VALUE}};'
				]
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots_tooltip',
			[
				'label' 		=> __('Tooltip', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'fade_in_time',
			[
				'label' 		=> __('Fade In Time (ms)', 'woovina-elementor-widgets'),
				'description' 	=> __('Time until tooltips appear.', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 200,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 1000,
					],
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'fade_out_time',
			[
				'label' 		=> __('Fade Out Time (ms)', 'woovina-elementor-widgets'),
				'description' 	=> __('Time until tooltips dissapear.', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 100,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 1000,
					],
				],
				'frontend_available' => true,
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

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'image_border',
				'label' 		=> __('Image Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-hotspots-wrap img',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-hotspots-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'image_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-hotspots-wrap img',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots_style',
			[
				'label' 		=> __('Hotspots', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'hotspots_typo',
				'selector' 		=> '{{WRAPPER}} .wew-hotspot-inner',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->start_controls_tabs('tabs_hotspots_style');

		$this->start_controls_tab(
			'tab_hotspots_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'hotspots_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-hotspot-inner, {{WRAPPER}} .wew-hotspot-inner:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hotspots_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-hotspot-inner, {{WRAPPER}} .wew-hotspot-inner:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hotspots_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'hotspots_hover_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-hotspot-inner:hover, {{WRAPPER}} .wew-hotspot-inner:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hotspots_hover_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-hotspot-inner:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'hotspots_size',
			[
				'label' 		=> __('Size', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 40,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-hotspot-inner, {{WRAPPER}} .wew-hotspot-inner:before' => 'min-width: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-hotspot-inner' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'hotspots_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .wew-hotspot-inner',
			]
		);

		$this->add_responsive_control(
			'hotspots_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-hotspot-inner, {{WRAPPER}} .wew-hotspot-inner:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'hotspots_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wew-hotspot-inner',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips_style',
			[
				'label' 		=> __('Tooltips', 'woovina-elementor-widgets'),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'tooltips_typo',
				'selector' 		=> '#powerTip.wew-hotspot-powertip',
				'scheme' 		=> Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'tooltips_background',
			[
				'label' 		=> __('Background Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#powerTip.wew-hotspot-powertip' => 'background-color: {{VALUE}};',
					'#powerTip.wew-hotspot-powertip.n:before' => 'border-top-color: {{VALUE}};',
					'#powerTip.wew-hotspot-powertip.e:before' => 'border-right-color: {{VALUE}};',
					'#powerTip.wew-hotspot-powertip.s:before' => 'border-bottom-color: {{VALUE}};',
					'#powerTip.wew-hotspot-powertip.w:before' => 'border-left-color: {{VALUE}};',
					'#powerTip.wew-hotspot-powertip.ne:before, #powerTip.wew-hotspot-powertip.nw:before' => 'border-top-color: {{VALUE}};',
					'#powerTip.wew-hotspot-powertip.se:before, #powerTip.wew-hotspot-powertip.sw:before' => 'border-bottom-color: {{VALUE}};',
					'#powerTip.wew-hotspot-powertip.nw-alt:before, #powerTip.wew-hotspot-powertip.ne-alt:before, #powerTip.wew-hotspot-powertip.sw-alt:before, #powerTip.wew-hotspot-powertip.se-alt:before' => 'border-top-color: {{VALUE}};',
					'#powerTip.wew-hotspot-powertip.sw-alt:before, #powerTip.wew-hotspot-powertip.se-alt:before' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tooltips_color',
			[
				'label' 		=> __('Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#powerTip.wew-hotspot-powertip' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'tooltips_border',
				'label' 		=> __('Border', 'woovina-elementor-widgets'),
				'selector' 		=> '#powerTip.wew-hotspot-powertip',
			]
		);

		$this->add_responsive_control(
			'tooltips_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'#powerTip.wew-hotspot-powertip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'tooltips_box_shadow',
				'selector' 		=> '#powerTip.wew-hotspot-powertip',
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if(empty($settings['image']['url'])) {
			return;
		} ?>

		<div class="wew-hotspots-wrap">
			<?php echo Group_Control_Image_Size::get_attachment_image_html($settings); ?>

			<?php
			if($settings['hotspots']) { ?>
				<div class="wew-hotspot-wrap">
					<?php
					foreach($settings['hotspots'] as $index => $item) :
						$hotspot_tag 	= 'div';
						$hotspot 		= $this->get_repeater_setting_key('hotspot', 'hotspots', $index);
						$text 			= $this->get_repeater_setting_key('hotspot_text', 'hotspots', $index);
						$icon 			= $this->get_repeater_setting_key('hotspot_icon', 'hotspots', $index);

						$this->add_render_attribute($hotspot, [
							'class' => [
								'wew-hotspot-inner',
								'elementor-repeater-item-' . $item['_id'],
							]
						]);

						if('yes' == $item['tooltip']) {
							$this->add_render_attribute($hotspot, [
								'class' => [
									'wew-hotspot-tooltip',
									'wew-tooltip-' . $item['tooltip_position'],
								],
								'title'	=> $this->parse_text_editor($item['tooltip_content']),
							]);
						}

						$this->add_render_attribute($text, 'class', 'wew-hotspot-text');

						if(! empty($item['hotspot_link']['url'])) {
							$hotspot_tag = 'a';

							$this->add_render_attribute($hotspot, 'href', $item['hotspot_link']['url']);

							if($item['hotspot_link']['is_external']) {
								$this->add_render_attribute($hotspot, 'target', '_blank');
							}

							if(! empty($item['hotspot_link']['nofollow'])) {
								$this->add_render_attribute($hotspot, 'rel', 'nofollow');
							}
						} ?>

						<<?php echo $hotspot_tag; ?> <?php echo $this->get_render_attribute_string($hotspot); ?>>
							<?php
							if('blank' != $item['hotspot_type']) { ?>
								<span <?php echo $this->get_render_attribute_string($text); ?>>
									<?php
									if('icon' == $item['hotspot_type'] && ! empty($item['hotspot_icon'])) { ?>
										<i class="<?php echo esc_attr($item['hotspot_icon']); ?>""></i>
									<?php
									} else {
										echo $item['hotspot_text'];
									} ?>
								</span>
							<?php
							} ?>
						</<?php echo $hotspot_tag; ?>>

					<?php
					endforeach; ?>
				</div>
			<?php
			} ?>
		</div>

	<?php
	}

	protected function _content_template() { ?>
		<# if(settings.image.url) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl(image);

			if(! image_url) {
				return;
			} #>

			<div class="wew-hotspots-wrap">
				<img src="{{ image_url }}" />

				<# if(settings.hotspots) { #>
					<div class="wew-hotspot-wrap">
						<# _.each(settings.hotspots, function(item, index) {

							var hotspot_tag 	= 'div',
								hotspot 		= view.getRepeaterSettingKey('hotspot', 'hotspots', index),
								text 			= view.getRepeaterSettingKey('hotspot_text', 'hotspots', index),
								icon 			= view.getRepeaterSettingKey('hotspot_icon', 'hotspots', index);

							view.addRenderAttribute(hotspot, 'class', [
								'wew-hotspot-inner',
								'elementor-repeater-item-' + item._id,
							]);

							if('yes' == item.tooltip) {
								view.addRenderAttribute(hotspot, 'class', 'wew-hotspot-tooltip');
								view.addRenderAttribute(hotspot, 'class', 'wew-tooltip-' + item.tooltip_position);
								view.addRenderAttribute(hotspot, 'title', item.tooltip_content);
							}

							view.addRenderAttribute(text, 'class', 'wew-hotspot-text');

							if('' != item.hotspot_link.url) {
								hotspot_tag = 'a';
								view.addRenderAttribute(hotspot, 'href', item.hotspot_link.url);
							} #>

							<{{ hotspot_tag }} {{{ view.getRenderAttributeString(hotspot) }}}>
								<# if('blank' != item.hotspot_type) { #>
									<span {{{ view.getRenderAttributeString(text) }}}>
										<# if('icon' == item.hotspot_type && '' !== item.hotspot_icon) { #>
											<i class="{{{ item.hotspot_icon }}}"></i>
										<# } else { #>
											{{ item.hotspot_text }}
										<# } #>
									</span>
								<# } #>
							</{{ hotspot_tag }}>
						<# }); #>
					</div>
				<# } #>
			</div>

		<# } #>
	<?php
	}

}