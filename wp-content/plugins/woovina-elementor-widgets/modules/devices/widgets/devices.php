<?php
namespace wvnElementor\Modules\Devices\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Widget_Base;

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class Devices extends Widget_Base {

	public function get_name() {
		return 'wew-devices';
	}

	public function get_title() {
		return __('Devices', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-device-tablet';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_style_depends() {
		return [ 'wew-devices' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_device',
			[
				'label' 		=> __('Settings', 'woovina-elementor-widgets'),
			]
		);

		$this->add_control(
			'device',
			[
				'label' 		=> __('Device', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'iphonex',
				'options' 		=> [
					'iphone-x' 			=> __('iPhone X', 'woovina-elementor-widgets'),
					'iphone-8' 			=> __('iPhone 8', 'woovina-elementor-widgets'),
					'google-pixel-2-xl' => __('Google Pixel 2 XL', 'woovina-elementor-widgets'),
					'google-pixel' 		=> __('Google Pixel', 'woovina-elementor-widgets'),
					'samsung-galaxy-s8' => __('Samsung Galaxy S8', 'woovina-elementor-widgets'),
					'ipad-pro' 			=> __('iPad Pro', 'woovina-elementor-widgets'),
					'surface-pro' 		=> __('Surface Pro', 'woovina-elementor-widgets'),
					'surface-book' 		=> __('Surface Book', 'woovina-elementor-widgets'),
					'macbook' 			=> __('MacBook', 'woovina-elementor-widgets'),
					'macbook-pro' 		=> __('MacBook Pro', 'woovina-elementor-widgets'),
					'surface-studio' 	=> __('Surface Studio', 'woovina-elementor-widgets'),
					'imac-pro' 			=> __('iMac Pro', 'woovina-elementor-widgets'),
					'apple-watch' 		=> __('Apple Watch', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'iphone8_color',
			[
				'label' 		=> __('iPhone 8 Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'silver',
				'options' 		=> [
					'silver' 		=> __('Silver', 'woovina-elementor-widgets'),
					'gold' 			=> __('Gold', 'woovina-elementor-widgets'),
					'spacegray' 	=> __('Space Gray', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'device' => 'iphone-8',
				],
			]
		);

		$this->add_control(
			'google_pixel_color',
			[
				'label' 		=> __('Google Pixel Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'verysilver',
				'options' 		=> [
					'verysilver' 	=> __('Very Silver', 'woovina-elementor-widgets'),
					'quiteblack' 	=> __('Quite Black', 'woovina-elementor-widgets'),
					'reallyblue' 	=> __('Really Blue', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'device' => 'google-pixel',
				],
			]
		);

		$this->add_control(
			'samsung_galaxy_s8_color',
			[
				'label' 		=> __('Samsung Galaxy S8 Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'verysilver',
				'options' 		=> [
					'midnightblack' => __('Midnight Black', 'woovina-elementor-widgets'),
					'coralblue' 	=> __('Coral Blue', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'device' => 'samsung-galaxy-s8',
				],
			]
		);

		$this->add_control(
			'ipad_pro_color',
			[
				'label' 		=> __('iPad Pro Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'silver',
				'options' 		=> [
					'silver' 		=> __('Silver', 'woovina-elementor-widgets'),
					'gold' 			=> __('Gold', 'woovina-elementor-widgets'),
					'rosegray' 		=> __('Rose Gold', 'woovina-elementor-widgets'),
					'spacegray' 	=> __('Space Gray', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'device' => 'ipad-pro',
				],
			]
		);

		$this->add_control(
			'macbook_color',
			[
				'label' 		=> __('MacBook Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'silver',
				'options' 		=> [
					'silver' 		=> __('Silver', 'woovina-elementor-widgets'),
					'gold' 			=> __('Gold', 'woovina-elementor-widgets'),
					'rosegray' 		=> __('Rose Gold', 'woovina-elementor-widgets'),
					'spacegray' 	=> __('Space Gray', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'device' => 'macbook',
				],
			]
		);

		$this->add_control(
			'macbook_pro_color',
			[
				'label' 		=> __('MacBook Pro Color', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'silver',
				'options' 		=> [
					'silver' 		=> __('Silver', 'woovina-elementor-widgets'),
					'spacegray' 	=> __('Space Gray', 'woovina-elementor-widgets'),
				],
				'condition' 	=> [
					'device' => 'macbook-pro',
				],
			]
		);

		$this->add_control(
			'device_media_type',
			[
				'label' 		=> __('Media Type', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'image',
				'options' 		=> [
					'image'  	=> __('Image', 'woovina-elementor-widgets'),
					'video'  	=> __('Video', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_responsive_control(
			'device_align',
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
				'prefix_class' 	=> 'wew%s-align-',
			]
		);

		$this->add_responsive_control(
			'device_width',
			[
				'label' 		=> __('Max Width', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' 		=> '',
				],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 1920,
						'step' 	=> 10,
					],
					'%' => [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-device' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_device_media',
			[
				'label' 		=> __('Image', 'woovina-elementor-widgets'),
				'condition' 	=> [
					'device_media_type' => 'image',
				],
			]
		);

		$this->add_control(
			'device_image',
			[
				'label'     	=> __('Choose Image', 'woovina-elementor-widgets'),
				'type'      	=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' 	=> [
					'device_media_type' => 'image',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$device 	= $settings['device'];
		$type 		= $settings['device_media_type'];

		// Device color
		$color = 'default';
		if('iphone-8' == $device) {
			$color = $settings['iphone8_color'];
		} else if('google-pixel' == $device) {
			$color = $settings['google_pixel_color'];
		} else if('samsung-galaxy-s8' == $device) {
			$color = $settings['samsung_galaxy_s8_color'];
		} else if('ipad-pro' == $device) {
			$color = $settings['ipad_pro_color'];
		} else if('macbook' == $device) {
			$color = $settings['macbook_color'];
		} else if('macbook-pro' == $device) {
			$color = $settings['macbook_pro_color'];
		}

		$this->add_render_attribute('device', 'class', [
			'wew-device',
			'wew-device-' . $device,
			'wew-device-' . $color,
		]);

        if(! empty($settings['device_image']['url'])) {
        	$this->add_render_attribute('image-tag', 'class', 'wew-device-content');
	        $this->add_render_attribute('image-tag', 'src', $settings['device_image']['url']);
	        $this->add_render_attribute('image-tag', 'alt', Control_Media::get_image_alt($settings['device_image']));
	    } ?>

		<div <?php echo $this->get_render_attribute_string('device'); ?>>
			<div class="wew-device-frame">
				<?php
				if('image' == $type) { ?>
					<img <?php echo $this->get_render_attribute_string('image-tag'); ?> />
				<?php
				} else if('video' == $type) { ?>
					<video class="wew-device-content" muted="muted" autoplay="" loop="">
	                	<source src="src/video/bg-01.mp4" type="video/mp4">
	              	</video>
				<?php
				} ?>
			</div>
			<div class="wew-device-stripe"></div>
			<div class="wew-device-header"></div>
			<div class="wew-device-sensors"></div>
			<div class="wew-device-btns"></div>
			<div class="wew-device-power"></div>
		</div>

	<?php
	}

	protected function _content_template() { ?>
		<#
		var $color = 'default';
		if('iphone-8' == settings.device) {
			$color = settings.iphone8_color;
		} else if('google-pixel' == settings.device) {
			$color = settings.google_pixel_color;
		} else if('samsung-galaxy-s8' == settings.device) {
			$color = settings.samsung_galaxy_s8_color;
		} else if('ipad-pro' == settings.device) {
			$color = settings.ipad_pro_color;
		} else if('macbook' == settings.device) {
			$color = settings.macbook_color;
		} else if('macbook-pro' == settings.device) {
			$color = settings.macbook_pro_color;
		}

		if('' !== settings.device_image.url) {
			view.addRenderAttribute('image', 'class', 'wew-device-content');
			view.addRenderAttribute('image', 'src', settings.device_image.url);
		} #>

		<div class="wew-device wew-device-{{ settings.device }} wew-device-{{ $color }}">
			<div class="wew-device-frame">
				<#
				if('image' == settings.device_media_type) { #>
					<img {{{ view.getRenderAttributeString('image') }}} />
				<#
				} else if('video' == settings.device_media_type) { #>
					<video class="wew-device-content" muted="muted" autoplay="" loop="">
	                	<source src="src/video/bg-01.mp4" type="video/mp4">
	              	</video>
				<#
				} #>
			</div>
			<div class="wew-device-stripe"></div>
			<div class="wew-device-header"></div>
			<div class="wew-device-sensors"></div>
			<div class="wew-device-btns"></div>
			<div class="wew-device-power"></div>
		</div>
	<?php
	}
}