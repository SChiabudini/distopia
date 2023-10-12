<?php
/**
 * Settings
 * 
 */

/**
 * Menu Icons Settings module
 */
final class WE_Menu_Icons_Settings {

	const UPDATE_KEY = 'we-icons-settings-update';

	const RESET_KEY = 'we-icons-settings-reset';

	const TRANSIENT_KEY = 'we_menu_icons_message';

	/**
	 * Default setting values
	 * 
	 */
	protected static $defaults = array(
		'global' => array(
			'icon_types' => array('dashicons', 'fa', 'line-icon', 'foundation-icons', 'genericon', 'image', 'svg'),
		),
	);

	/**
	 * Setting values
	 * 
	 */
	protected static $settings = array();

	/**
	 * Script dependencies
	 * 
	 */
	protected static $script_deps = array('jquery');

	/**
	 * Get setting value
	 * 
	 */
	public static function get() {
		$args = func_get_args();

		return we_get_array_value_deep(self::$settings, $args);
	}

	/**
	 * Get menu settings
	 * 
	 */
	public static function get_menu_settings($menu_id) {
		$menu_settings = self::get(sprintf('menu_%d', $menu_id));
		$menu_settings = apply_filters('we_menu_icons_menu_settings', $menu_settings, $menu_id);

		if(! is_array($menu_settings)) {
			$menu_settings = array();
		}

		return $menu_settings;
	}

	/**
	 * Check if menu icons is disabled for a menu
	 * 
	 */
	public static function is_menu_icons_disabled_for_menu($menu_id = 0) {
		if(empty($menu_id)) {
			$menu_id = self::get_current_menu_id();
		}

		// When we're creating a new menu or the recently edited menu
		// could not be found.
		if(empty($menu_id)) {
			return true;
		}

		$menu_settings = self::get_menu_settings($menu_id);
		$is_disabled   = ! empty($menu_settings['disabled']);

		return $is_disabled;
	}

	/**
	 * Settings init
	 * 
	 */
	public static function init() {
		/**
		 * Allow themes/plugins to override the default settings
		 * 
		 */
		self::$defaults = apply_filters('we_menu_icons_settings_defaults', self::$defaults);

		self::$settings = get_option('we-icons', self::$defaults);

		foreach (self::$settings as $key => &$value) {
			if('global' === $key) {
				// Remove unregistered icon types.
				$value['icon_types'] = array_values(array_intersect(
					array_keys(WE_Menu_Icons::get('types')),
					array_filter((array) $value['icon_types'])
				));
			} else {
				// Backward-compatibility.
				if(isset($value['width']) && ! isset($value['svg_width'])) {
					$value['svg_width'] = $value['width'];
				}

				unset($value['width']);
			}
		}

		unset($value);

		/**
		 * Allow themes/plugins to override the settings
		 * 
		 */
		self::$settings = apply_filters('we_menu_icons_settings', self::$settings);

		if(self::is_menu_icons_disabled_for_menu()) {
			return;
		}

		if(! empty(self::$settings['global']['icon_types'])) {
			require_once WE_Menu_Icons::get('dir') . 'includes/picker.php';
			WE_Menu_Icons_Picker::init();
			self::$script_deps[] = 'icon-picker';
		}

		add_action('load-nav-menus.php', array(__CLASS__, '_load_nav_menus'), 1);
		add_action('wp_ajax_we_menu_icons_update_settings', array(__CLASS__, '_ajax_we_menu_icons_update_settings'));
	}

	/**
	 * Prepare wp-admin/nav-menus.php page
	 * 
	 */
	public static function _load_nav_menus() {
		add_action('admin_enqueue_scripts', array(__CLASS__, '_enqueue_assets'), 99);

		/**
		 * Allow settings meta box to be disabled.
		 * 
		 */
		$settings_disabled = apply_filters('we_menu_icons_disable_settings', false);
		if(true === $settings_disabled) {
			return;
		}

		self::_maybe_update_settings();
		self::_add_settings_meta_box();

		add_action('admin_notices', array(__CLASS__, '_admin_notices'));
	}

	/**
	 * Update settings
	 * 
	 */
	public static function _maybe_update_settings() {
		if(! empty($_POST['we-icons']['settings'])) {
			check_admin_referer(self::UPDATE_KEY, self::UPDATE_KEY);

			$redirect_url = self::_update_settings($_POST['we-icons']['settings']); // Input var okay.
			wp_redirect($redirect_url);
		} elseif(! empty($_REQUEST[ self::RESET_KEY ])) {
			check_admin_referer(self::RESET_KEY, self::RESET_KEY);
			wp_redirect(self::_reset_settings());
		}
	}

	/**
	 * Update settings
	 * 
	 */
	protected static function _update_settings($values) {
		update_option(
			'we-icons',
			wp_parse_args(
				we_validate($values),
				self::$settings
			)
		);
		set_transient(self::TRANSIENT_KEY, 'updated', 30);

		$redirect_url = remove_query_arg(
			array('we-icons-reset'),
			wp_get_referer()
		);

		return $redirect_url;
	}

	/**
	 * Reset settings
	 * 
	 */
	protected static function _reset_settings() {
		delete_option('we-icons');
		set_transient(self::TRANSIENT_KEY, 'reset', 30);

		$redirect_url = remove_query_arg(
			array(self::RESET_KEY, 'we-icons-updated'),
			wp_get_referer()
		);

		return $redirect_url;
	}

	/**
	 * Update settings via ajax
	 * 
	 */
	public static function _ajax_we_menu_icons_update_settings() {
		check_ajax_referer(self::UPDATE_KEY, self::UPDATE_KEY);

		if(empty($_POST['we-icons']['settings'])) {
			wp_send_json_error();
		}

		$redirect_url = self::_update_settings($_POST['we-icons']['settings']); // Input var okay.
		wp_send_json_success(array('redirectUrl' => $redirect_url));
	}

	/**
	 * Print admin notices
	 * 
	 */
	public static function _admin_notices() {
		$messages = array(
			'updated' => __('<strong>Menu Icons Settings</strong> have been successfully updated.', 'woovina-extra'),
			'reset'   => __('<strong>Menu Icons Settings</strong> have been successfully reset.', 'woovina-extra'),
		);

		$message_type = get_transient(self::TRANSIENT_KEY);

		if(! empty($message_type) && ! empty($messages[ $message_type ])) {
			printf(
				'<div class="updated notice is-dismissible"><p>%s</p></div>',
				wp_kses($messages[ $message_type ], array('strong' => true))
			);
		}

		delete_transient(self::TRANSIENT_KEY);
	}

	/**
	 * Settings meta box
	 * 
	 */
	private static function _add_settings_meta_box() {
		add_meta_box(
			'we-icons-settings',
			__('Menu Icons Settings', 'woovina-extra'),
			array(__CLASS__, '_meta_box'),
			'nav-menus',
			'side',
			'low',
			array()
		);
	}

	/**
	 * Get ID of menu being edited
	 * 
	 */
	public static function get_current_menu_id() {
		global $nav_menu_selected_id;

		if(! empty($nav_menu_selected_id)) {
			return $nav_menu_selected_id;
		}

		if(is_admin() && isset($_REQUEST['menu'])) {
			$menu_id = absint($_REQUEST['menu']);
		} else {
			$menu_id = absint(get_user_option('nav_menu_recently_edited'));
		}

		return $menu_id;
	}

	/**
	 * Get settings fields
	 * 
	 */
	public static function get_settings_fields(array $values = array()) {
		$fields = array(
			'hide_label' => array(
				'id'      => 'hide_label',
				'type'    => 'select',
				'label'   => __('Hide Text', 'woovina-extra'),
				'default' => '',
				'choices' => array(
					array(
						'value' => '',
						'label' => __('No', 'woovina-extra'),
					),
					array(
						'value' => '1',
						'label' => __('Yes', 'woovina-extra'),
					),
				),
			),
			'position' => array(
				'id'      => 'position',
				'type'    => 'select',
				'label'   => __('Position', 'woovina-extra'),
				'default' => 'before',
				'choices' => array(
					array(
						'value' => 'before',
						'label' => __('Before', 'woovina-extra'),
					),
					array(
						'value' => 'after',
						'label' => __('After', 'woovina-extra'),
					),
					array(
						'value' => 'below',
						'label' => __('Below', 'woovina-extra'),
					),
				),
			),
			'vertical_align' => array(
				'id'      => 'vertical_align',
				'type'    => 'select',
				'label'   => __('Vertical Align', 'woovina-extra'),
				'default' => 'middle',
				'choices' => array(
					array(
						'value' => 'super',
						'label' => __('Super', 'woovina-extra'),
					),
					array(
						'value' => 'top',
						'label' => __('Top', 'woovina-extra'),
					),
					array(
						'value' => 'text-top',
						'label' => __('Text Top', 'woovina-extra'),
					),
					array(
						'value' => 'middle',
						'label' => __('Middle', 'woovina-extra'),
					),
					array(
						'value' => 'baseline',
						'label' => __('Baseline', 'woovina-extra'),
					),
					array(
						'value' => 'text-bottom',
						'label' => __('Text Bottom', 'woovina-extra'),
					),
					array(
						'value' => 'bottom',
						'label' => __('Bottom', 'woovina-extra'),
					),
					array(
						'value' => 'sub',
						'label' => __('Sub', 'woovina-extra'),
					),
				),
			),
			'font_size' => array(
				'id'          => 'font_size',
				'type'        => 'number',
				'label'       => __('Font Size', 'woovina-extra'),
				'default'     => '1.2',
				'description' => 'em',
				'attributes'  => array(
					'min'  => '0.1',
					'step' => '0.1',
				),
			),
			'svg_width' => array(
				'id'          => 'svg_width',
				'type'        => 'number',
				'label'       => __('SVG Width', 'woovina-extra'),
				'default'     => '1',
				'description' => 'em',
				'attributes'  => array(
					'min'  => '.5',
					'step' => '.1',
				),
			),
			'image_size' => array(
				'id'      => 'image_size',
				'type'    => 'select',
				'label'   => __('Image Size', 'woovina-extra'),
				'default' => 'thumbnail',
				'choices' => we_get_image_sizes(),
			),
		);

		$fields = apply_filters('we_menu_icons_settings_fields', $fields);

		foreach ($fields as &$field) {
			if(isset($values[ $field['id'] ])) {
				$field['value'] = $values[ $field['id'] ];
			}

			if(! isset($field['value']) && isset($field['default'])) {
				$field['value'] = $field['default'];
			}
		}

		unset($field);

		return $fields;
	}

	/**
	 * Get settings sections
	 * 
	 */
	public static function get_fields() {
		$menu_id    = self::get_current_menu_id();
		$icon_types = wp_list_pluck(WE_Menu_Icons::get('types'), 'name');

		asort($icon_types);

		$sections = array(
			'global' => array(
				'id'          => 'global',
				'title'       => __('Global', 'woovina-extra'),
				'description' => __('Global settings', 'woovina-extra'),
				'fields'      => array(
					array(
						'id'      => 'icon_types',
						'type'    => 'checkbox',
						'label'   => __('Icon Types', 'woovina-extra'),
						'choices' => $icon_types,
						'value'   => self::get('global', 'icon_types'),
					),
				),
				'args'  => array(),
			),
		);

		if(! empty($menu_id)) {
			$menu_term      = get_term($menu_id, 'nav_menu');
			$menu_key       = sprintf('menu_%d', $menu_id);
			$menu_settings  = self::get_menu_settings($menu_id);

			$sections['menu'] = array(
				'id'          => $menu_key,
				'title'       => __('Current Menu', 'woovina-extra'),
				'description' => sprintf(
					__('"%s" menu settings', 'woovina-extra'),
					apply_filters('single_term_title', $menu_term->name)
				),
				'fields'      => self::get_settings_fields($menu_settings),
				'args'        => array('inline_description' => true),
			);
		}

		return apply_filters('we_menu_icons_settings_sections', $sections, $menu_id);
	}

	/**
	 * Get processed settings fields
	 * 
	 */
	private static function _get_fields() {
		if(! class_exists('WE_Form_Field')) {
			require_once WE_Menu_Icons::get('dir') . 'includes/library/form-fields.php';
		}

		$keys     = array('we-icons', 'settings');
		$sections = self::get_fields();

		foreach ($sections as &$section) {
			$_keys = array_merge($keys, array($section['id']));
			$_args = array_merge(array('keys' => $_keys), $section['args']);

			foreach ($section['fields'] as &$field) {
				$field = WE_Form_Field::create($field, $_args);
			}

			unset($field);
		}

		unset($section);

		return $sections;
	}

	/**
	 * Settings meta box
	 * 
	 */
	public static function _meta_box() {
		?>
			<div class="taxonomydiv">
				<ul id="we-icons-settings-tabs" class="taxonomy-tabs add-menu-item-tabs hide-if-no-js">
					<?php foreach (self::get_fields() as $section) : ?>
						<?php
							printf(
								'<li><a href="#" title="%s" class="we-settings-nav-tab" data-type="we-icons-settings-%s">%s</a></li>',
								esc_attr($section['description']),
								esc_attr($section['id']),
								esc_html($section['title'])
							);
						?>
					<?php endforeach; ?>
				</ul>
				<?php foreach (self::_get_fields() as $section_index => $section) : ?>
					<div id="we-icons-settings-<?php echo esc_attr($section['id']) ?>" class="tabs-panel _<?php echo esc_attr($section_index) ?>">
						<h4 class="hide-if-js"><?php echo esc_html($section['title']) ?></h4>
						<?php foreach ($section['fields'] as $field) : ?>
							<div class="_field">
								<?php
									printf(
										'<label for="%s" class="_main">%s</label>',
										esc_attr($field->id),
										esc_html($field->label)
									);
								?>
								<?php $field->render() ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
			<p class="submitbox button-controls">
				<?php wp_nonce_field(self::UPDATE_KEY, self::UPDATE_KEY) ?>
				<span class="list-controls">
					<?php
						printf(
							'<a href="%s" title="%s" class="select-all submitdelete">%s</a>',
							esc_url(
								wp_nonce_url(
									admin_url('/nav-menus.php'),
									self::RESET_KEY,
									self::RESET_KEY
								)
							),
							esc_attr__('Discard all changes and reset to default state', 'woovina-extra'),
							esc_html__('Reset', 'woovina-extra')
						);
					?>
				</span>

				<span class="add-to-menu">
					<span class="spinner"></span>
					<?php
						submit_button(
							__('Save Settings', 'woovina-extra'),
							'secondary',
							'we-icons-settings-save',
							false
						);
					?>
				</span>
			</p>
		<?php
	}

	/**
	 * Enqueue scripts & styles for Appearance > Menus page
	 * 
	 */
	public static function _enqueue_assets() {
		$url    = WE_Menu_Icons::get('url');
		$suffix = we_get_script_suffix();

		wp_enqueue_style(
			'we-icons',
			"{$url}css/admin{$suffix}.css",
			false,
			WE_Menu_Icons::VERSION
		);
		wp_enqueue_script(
			'we-icons',
			"{$url}js/admin{$suffix}.js",
			self::$script_deps,
			WE_Menu_Icons::VERSION,
			true
		);

		/**
		 * Add filter to allow to filter the settings JS data
		 */
		$js_data = apply_filters(
			'we_menu_icons_settings_js_data',
			array(
				'text'           => array(
					'title'        => __('Select Icon', 'woovina-extra'),
					'select'       => __('Select', 'woovina-extra'),
					'remove'       => __('Remove', 'woovina-extra'),
					'change'       => __('Change', 'woovina-extra'),
					'all'          => __('All', 'woovina-extra'),
					'preview'      => __('Preview', 'woovina-extra'),
				),
				'settingsFields' => self::get_settings_fields(),
				'activeTypes'    => self::get('global', 'icon_types'),
				'ajaxUrls'       => array(
					'update' => add_query_arg('action', 'we_menu_icons_update_settings', admin_url('/admin-ajax.php')),
				),
				'menuSettings'   => self::get_menu_settings(self::get_current_menu_id()),
			)
		);

		wp_localize_script('we-icons', 'menuIcons', $js_data);
	}
}