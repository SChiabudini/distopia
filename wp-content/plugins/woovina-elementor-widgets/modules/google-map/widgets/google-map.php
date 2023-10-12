<?php
namespace wvnElementor\Modules\GoogleMap\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Google_Map extends Widget_Base {

	public $geo_api_url = 'https://maps.googleapis.com/maps/api/geocode/json';

	public function get_name() {
		return 'wew-google-map';
	}

	public function get_title() {
		return __('Google Map', 'woovina-elementor-widgets');
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'wew-icon eicon-google-maps';
	}

	public function get_categories() {
		return [ 'woovina-elements' ];
	}

	public function get_script_depends() {
		return [ 'wew-google-map-api', 'wew-google-map' ];
	}

	public function get_style_depends() {
		return [ 'wew-google-map' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_google_map',
			[
				'label' 		=> __('Map Settings', 'woovina-elementor-widgets'),
			]
		);

		$key = get_option('wvn_google_map_api');

		if(! $key) {
			$this->add_control(
			'set_key',
				[
					'type' 		=> Controls_Manager::RAW_HTML,
					'raw'  		=> sprintf(
						__('Please set your Google maps API key on the %1$ssettings page%2$s', 'woovina-elementor-widgets'),
						'<a href="' . add_query_arg(array('page' => 'woovina-panel&tab=integrations#google',), esc_url(admin_url('admin.php'))) . '" target="_blank">',
						'</a>'
					),
				]
			);
		}

		$address = __('London Eye, London, United Kingdom', 'woovina-elementor-widgets');

		$this->add_control(
			'map_center',
			[
				'label'       	=> __('Map Center', 'woovina-elementor-widgets'),
				'type'        	=> Controls_Manager::TEXT,
				'placeholder' 	=> $address,
				'default' 		=> $address,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'zoom',
			[
				'label'      	=> esc_html__('Zoom Level', 'woovina-elementor-widgets'),
				'type'       	=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'default'    	=> [
					'unit' => 'zoom',
					'size' => 10,
				],
				'range'      	=> [
					'zoom' => [
						'min' => 1,
						'max' => 20,
					],
				],
			]
		);

		$this->add_control(
			'scrollwheel',
			[
				'label' 		=> __('Prevent Scroll', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
			]
		);

		$this->add_control(
			'zoom_controls',
			[
				'label' 		=> __('Zoom Controls', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'fullscreen_control',
			[
				'label' 		=> __('Fullscreen Control', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'street_view',
			[
				'label' 		=> __('Street View Controls', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'map_type',
			[
				'label' 		=> __('Map Type Controls', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'draggable_map',
			[
				'label' 		=> __('Draggable Map', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_google_map_style',
			[
				'label' 		=> __('Map Style', 'woovina-elementor-widgets'),
			]
		);

		$this->add_responsive_control(
			'map_height',
			[
				'label' 		=> __('Height', 'woovina-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 300,
				],
				'range' 		=> [
					'px' => [
						'min' => 40,
						'max' => 1440,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wew-map' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'map_style',
			[
				'label' 		=> __('Style', 'woovina-elementor-widgets'),
				'description' 	=> sprintf(
						__('You can add your own map styles in your child theme, %1$slearn more%2$s.', 'woovina-elementor-widgets'),
						'<a href="https://woovina.com/docs/extensions/woovina-elementor-widgets-add-my-own-google-maps-style" target="_blank">',
						'</a>'
					),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'default',
				'options'     	=> apply_filters('wew_map_styles',
					[
						'default' 			=> __('Default', 'woovina-elementor-widgets'),
						'apple-maps-esque' 	=> __('Apple Maps Esque', 'woovina-elementor-widgets'),
						'assassins-creed' 	=> __('Assassin&rsquo;s Creed', 'woovina-elementor-widgets'),
						'black-and-white' 	=> __('Black and White', 'woovina-elementor-widgets'),
						'blue-essence' 		=> __('Blue Essence', 'woovina-elementor-widgets'),
						'blue-water' 		=> __('Blue Water', 'woovina-elementor-widgets'),
						'bright-colors' 	=> __('Bright Colors', 'woovina-elementor-widgets'),
						'light-dream' 		=> __('Light Dream', 'woovina-elementor-widgets'),
						'shades-of-grey' 	=> __('Shades of Grey', 'woovina-elementor-widgets'),
						'subtle-grayscale' 	=> __('Subtle Grayscale', 'woovina-elementor-widgets'),
						'ultra-light' 		=> __('Ultra Light', 'woovina-elementor-widgets'),
						'wy' 				=> __('WY', 'woovina-elementor-widgets'),
					]
				),
				'label_block' 	=> true,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_google_map_pins',
			[
				'label' 		=> __('Pins', 'woovina-elementor-widgets'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'pin_address',
			[
				'label'   		=> esc_html__('Address', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXT,
				'default' 		=> $address,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'pin_description',
			[
				'label'   		=> esc_html__('Description', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::TEXTAREA,
				'default' 		=> $address,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'pin_icon',
			[
				'label'   		=> esc_html__('Custom Icon', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'pin_state',
			[
				'label'   		=> esc_html__('State', 'woovina-elementor-widgets'),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'visible',
				'options' 		=> [
					'visible' => __('Vsible', 'woovina-elementor-widgets'),
					'hidden'  => __('Hidden', 'woovina-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'pins',
			[
				'type' 			=> Controls_Manager::REPEATER,
				'default' 		=> [
					[
						'pin_address' 		=> $address,
						'pin_description' 	=> $address,
						'pin_icon' 			=> '',
						'pin_state' 		=> 'visible',
					],
				],
				'fields' 		=> array_values($repeater->get_controls()),
				'title_field' 	=> '{{{ pin_address }}}',
			]
		);

        $this->end_controls_section();

	}

	public function get_map_style($style) {
		if(! $style) {
			return;
		}

		$file = WEW_ELEMENTOR_PATH . 'assets/js/google-map-styles/' . $style .'.json';
		$child_file = get_stylesheet_directory() . '/assets/js/google-map-styles/' . $style .'.json';

		ob_start();

		if(file_exists($file)) {
			include $file;
		}

		if(file_exists($child_file)) {
			include $child_file;
		}

		return preg_replace('/\/\/?\s*\*[\s\S]*?\*\s*\/\/?/m', '', ob_get_clean());
	}

	public function get_location($location) {

		$key = md5($location);

		$coord = get_transient($key);

		if(! empty($coord)) {
			return $coord;
		}

		$api_key = get_option('wvn_google_map_api');

		// Do nothing if api key not provided
		if(! $api_key) {
			return;
		}

		// Prepare request data
		$location = esc_attr($location);
		$api_key  = esc_attr($api_key);

		$reques_url = esc_url(add_query_arg(
			array(
				'address' => urlencode($location),
				'key'     => urlencode($api_key)
			),
			$this->geo_api_url
		));

		$response = wp_remote_get($reques_url);
		$json     = wp_remote_retrieve_body($response);
		$data     = json_decode($json, true);

		$coord = isset($data['results'][0]['geometry']['location'])
			? $data['results'][0]['geometry']['location']
			: false;

		if(! $coord) {
			return;
		}

		set_transient($key, $coord, WEEK_IN_SECONDS);

		return $coord;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if(empty($settings['map_center'])) {
			return;
		}

		$coordinates = $this->get_location($settings['map_center']);

		if(! $coordinates) {
			return;
		}

		$scroll_ctrl     = isset($settings['scrollwheel']) ? $settings['scrollwheel'] : '';
		$zoom_ctrl       = isset($settings['zoom_controls']) ? $settings['zoom_controls'] : '';
		$fullscreen_ctrl = isset($settings['fullscreen_control']) ? $settings['fullscreen_control'] : '';
		$streetview_ctrl = isset($settings['street_view']) ? $settings['street_view'] : '';

		$init = apply_filters('wew_map_data_args', array(
			'center'            => $coordinates,
			'zoom'              => isset($settings['zoom']['size']) ? intval($settings['zoom']['size']) : 11,
			'scrollwheel'       => filter_var($scroll_ctrl, FILTER_VALIDATE_BOOLEAN),
			'zoomControl'       => filter_var($zoom_ctrl, FILTER_VALIDATE_BOOLEAN),
			'fullscreenControl' => filter_var($fullscreen_ctrl, FILTER_VALIDATE_BOOLEAN),
			'streetViewControl' => filter_var($streetview_ctrl, FILTER_VALIDATE_BOOLEAN),
			'mapTypeControl'    => filter_var($settings['map_type'], FILTER_VALIDATE_BOOLEAN),
		));

		if('no' === $settings['draggable_map']) {
			$init['gestureHandling'] = 'none';
		}

		if('default' !== $settings['map_style']) {
			$init['styles'] = json_decode($this->get_map_style($settings['map_style']));
		}

		$this->add_render_attribute('map-data', 'data-init', json_encode($init));

		$pins = array();

		if(! empty($settings['pins'])) {

			foreach($settings['pins'] as $pin) {

				if(empty($pin['pin_address'])) {
					continue;
				}

				$current = array(
					'position' => $this->get_location($pin['pin_address']),
					'desc'     => $pin['pin_description'],
					'state'    => $pin['pin_state'],
				);

				if(! empty($pin['pin_icon']['url'])) {
					$current['image'] = esc_url($pin['pin_icon']['url']);
				}

				$pins[] = $current;
			}

		}

		$this->add_render_attribute('map-pins', 'data-pins', json_encode($pins)); ?>

		<div class="wew-map" <?php echo $this->get_render_attribute_string('map-data'); ?> <?php echo $this->get_render_attribute_string('map-pins'); ?>></div>

	<?php
	}

}