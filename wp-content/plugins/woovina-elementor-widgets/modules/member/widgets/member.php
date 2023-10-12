<?php
namespace wvnElementor\Modules\Member\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Member extends Widget_Base {

	public function get_name() {
		return 'wew-member';
	}

	public function get_title() {
		return __('Member', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-person';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-member', 'wew-tooltip' ];
	}

	public function get_style_depends() {
		return [ 'wew-member', 'wew-tooltip' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_member',
			[
				'label' 		=> __('General', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   		=> __('Image', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'name',
			[
				'label'       	=> __('Name', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __('John Doe', 'woovina-elementor-widgets'),
				'dynamic'     	=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'role',
			[
				'label'       	=> __('Role', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __('Co-Founder', 'woovina-elementor-widgets'),
				'dynamic'     	=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'       	=> __('Description', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXTAREA,
				'default'     	=> __('Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'woovina-elementor-widgets'),
				'rows'        	=> 10,
				'dynamic'     	=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' 		=> __('Name HTML Tag', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'h3',
				'options' 		=> wew_get_available_tags(),
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_social_links',
			[
				'label' 		=> __('Social Icons', 'woovina-elementor-widgets'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_link_title',
			[
				'label'   		=> __('Title', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXT,
				'default' 		=> 'Facebook',
			]
		);

		$repeater->add_control(
			'social_link',
			[
				'label'   		=> __('Link', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXT,
				'default' 		=> '#',
			]
		);

		$repeater->add_control(
			'social_icon',
			[
				'label'   		=> __('Choose Icon', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::ICON,
				'default' 		=> 'fa fa-facebook',
			]
		);

		$repeater->add_control(
			'icon_background',
			[
				'label'     	=> __('Icon Background', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member .wew-member-icons {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'icon_color',
			[
				'label'     	=> __('Icon Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member .wew-member-icons {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_links',
			[
				'type'    		=> Controls_Manager::REPEATER,
				'fields'  		=> array_values($repeater->get_controls()),
				'default' 		=> [
					[
						'social_link'       => '#',
						'social_icon'       => 'fa fa-facebook',
						'social_link_title' => 'Facebook',
					],
					[
						'social_link'       => '#',
						'social_icon'       => 'fa fa-twitter',
						'social_link_title' => 'Twitter',
					],
					[
						'social_link'       => '#',
						'social_icon'       => 'fa fa-google-plus',
						'social_link_title' => 'Google+',
					],
				],
				'title_field' 	=> '{{{ social_link_title }}}',
			]
		);

		$this->add_control(
			'member_tooltip',
			[
				'label' 		=> __('Tooltip', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'member_tooltip_position',
			[
				'label'			=> __('Tooltip Position', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 's',
				'options' 		=> [
					'n' => __('Top', 'woovina-elementor-widgets'),
					's' => __('Bottom', 'woovina-elementor-widgets'),
				],
				'condition'		=> [
					'member_tooltip' => 'yes',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'     	=> __('Member', 'woovina-elementor-widgets'),
				'tab'       	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'member_bg',
			[
				'label'     	=> __('Background Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'member_border',
				'selector' 		=> '{{WRAPPER}} .wew-member-wrap',
			]
		);

		$this->add_responsive_control(
			'member_border_radius',
			[
				'label' 		=> __('Border Radius', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_responsive_control(
			'member_padding',
			[
				'label' 		=> __('Padding', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'member_margin',
			[
				'label' 		=> __('Margin', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_heading',
			[
				'label' 		=> __('Content', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'   		=> __('Text Alignment', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::CHOOSE,
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
					'justify' => [
						'title' => __('Justified', 'woovina-elementor-widgets'),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_padding',
			[
				'label'      	=> __('Content Padding', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	
		$this->start_controls_section(
			'section_style_image',
			[
				'label' 		=> __('Image', 'woovina-elementor-widgets'),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'image_border',
				'label'       	=> __('Border', 'woovina-elementor-widgets'),
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .wew-member-wrap .wew-member-image',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'      	=> __('Border Radius', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label' 		=> __('Spacing', 'woovina-elementor-widgets'),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-image' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_name',
			[
				'label' 		=> __('Name', 'woovina-elementor-widgets'),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     	=> __('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'name_typography',
				'selector' 		=> '{{WRAPPER}} .wew-member-wrap .wew-member-name',
				'scheme'   		=> Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_responsive_control(
			'name_spacing',
			[
				'label' 		=> __('Spacing', 'woovina-elementor-widgets'),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_role',
			[
				'label' 		=> __('Role', 'woovina-elementor-widgets'),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'role_color',
			[
				'label'     	=> __('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-role' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'role_typography',
				'selector' 		=> '{{WRAPPER}} .wew-member-wrap .wew-member-role',
				'scheme'   		=> Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_responsive_control(
			'role_spacing',
			[
				'label' 		=> __('Spacing', 'woovina-elementor-widgets'),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-role' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			[
				'label' 		=> __('Text', 'woovina-elementor-widgets'),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     	=> __('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'text_typography',
				'selector' 		=> '{{WRAPPER}} .wew-member-wrap .wew-member-description',
				'scheme'   		=> Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_responsive_control(
			'text_spacing',
			[
				'label' 		=> __('Spacing', 'woovina-elementor-widgets'),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_social',
			[
				'label' 		=> __('Social Icon', 'woovina-elementor-widgets'),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icons_bg',
			[
				'label'     	=> __('Icons Background', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icons_wrap_padding',
			[
				'label'      	=> __('Icons Padding', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_icons_style');

		$this->start_controls_tab(
			'tab_icons_normal',
			[
				'label' 		=> __('Normal', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'icons_background',
			[
				'label'     	=> __('Background Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icons_color',
			[
				'label'     	=> __('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icons_hover',
			[
				'label' 		=> __('Hover', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'icons_hover_background',
			[
				'label'     	=> __('Background Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icons_hover_color',
			[
				'label'     	=> __('Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icons_hover_border_color',
			[
				'label'     	=> __('Border Color', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'icons_border',
				'label'       	=> __('Border', 'woovina-elementor-widgets'),
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .wew-member-wrap .wew-member-icons a',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'icons_border_radius',
			[
				'label'      	=> __('Border Radius', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icons_padding',
			[
				'label'      	=> __('Padding', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icons_size',
			[
				'label'     	=> __('Icon Size', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::SLIDER,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icons_indent',
			[
				'label'     	=> __('Icon Spacing', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::SLIDER,
				'selectors' 	=> [
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons a' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wew-member-wrap .wew-member-icons a:first-child' => 'margin-left: 0;',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$title_tag 	= $settings['title_html_tag'];

		$this->add_render_attribute('wrap', 'class', 'wew-member-wrap'); ?>

		<div <?php echo $this->get_render_attribute_string('wrap'); ?>>
			
			<?php
			if(! empty($settings['image']['url'])) { ?>
				<div class="wew-member-image">
					<?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image'); ?>
				</div>
			<?php
			} ?>
			
			<div class="wew-member-content">
				<?php
				if(! empty($settings['name'])) { ?>
					<<?php echo $title_tag; ?> class="wew-member-name">
						<?php echo $settings['name']; ?>
					</<?php echo $title_tag; ?>>
				<?php
				} ?>

				<?php
				if(! empty($settings['role'])) { ?>
					<span class="wew-member-role"><?php echo $settings['role']; ?></span>
				<?php
				} ?>

				<?php
				if(! empty($settings['description'])) { ?>
					<div class="wew-member-description"><?php echo $settings['description']; ?></div>
				<?php
				} ?>
			</div>

			<div class="wew-member-icons">
				<?php 
				foreach($settings['social_links'] as $index => $item) :
					$link = $this->get_repeater_setting_key('links', 'social_links', $index);

					$this->add_render_attribute($link, 'href', esc_url($item['social_link']));

					$this->add_render_attribute($link, [
						'class' => [
							'wew-member-icon',
							'elementor-repeater-item-' . $item['_id'],
						]
					]);

					if('yes' == $settings['member_tooltip']) {
						$this->add_render_attribute($link, [
							'class' => [
								'wew-member-tooltip',
								'wew-tooltip-' . $settings['member_tooltip_position'],
							],
							'title'	=> $item['social_link_title'],
						]);
					}

					$this->add_render_attribute($link, 'target', '_blank'); ?>

					<a <?php echo $this->get_render_attribute_string($link); ?>>
						<i class="<?php echo esc_attr($item['social_icon']); ?>" aria-hidden="true"></i>
					</a>
				<?php
				endforeach; ?>
			</div>
		</div>

	<?php
	}

	protected function _content_template() { ?>
		<div class="wew-member-wrap">
			
			<# if('' != settings.image.url) { #>
				<div class="wew-member-image">
					<img src="{{ settings.image.url }}" />
				</div>
            <# } #>
			
			<div class="wew-member-content">
				<# if(settings.name) { #>
					<{{ settings.title_html_tag }} class="wew-member-name">
						{{ settings.name }}
					</{{ settings.title_html_tag }}>
				<# } #>

				<# if(settings.role) { #>
					<span class="wew-member-role">{{ settings.role }}</span>
				<# } #>

				<# if(settings.description) { #>
					<span class="wew-member-description">{{ settings.description }}</span>
				<# } #>
			</div>

			<div class="wew-member-icons">
				<# _.each(settings.social_links, function(item, index) {

					var link = view.getRepeaterSettingKey('links', 'social_links', index);

					view.addRenderAttribute(link, 'href', item.social_link);

					view.addRenderAttribute(link, 'class', [
						'wew-member-icon',
						'elementor-repeater-item-' + item._id,
					]);

					if('yes' == settings.member_tooltip) {
						view.addRenderAttribute(link, 'class', 'wew-member-tooltip');
						view.addRenderAttribute(link, 'class', 'wew-tooltip-' + item.member_tooltip_position);
						view.addRenderAttribute(link, 'title', item.social_link_title);
					} #>

					<a {{{ view.getRenderAttributeString(link) }}}>
						<i class="{{{ item.social_icon }}}" aria-hidden="true"></i>
					</a>
				<# }); #>
			</div>
		</div>
	<?php
	}

}