<?php
/**
 * Dashicons
 *
 */

require_once dirname(__FILE__) . '/font.php';

/**
 * Icon type: Dashicons
 *
 */
class WE_Icon_Picker_Type_Dashicons extends WE_Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 */
	protected $id = 'dashicons';

	/**
	 * Icon type name
	 *
	 */
	protected $name = 'Dashicons';

	/**
	 * Icon type version
	 *
	 */
	protected $version = '4.3.1';

	/**
	 * Stylesheet URI
	 *
	 */
	protected $stylesheet_uri = '';

	/**
	 * Register assets
	 *
	 */
	public function register_assets(WE_Icon_Picker_Loader $loader) {
		$loader->add_style($this->stylesheet_id);
	}

	/**
	 * Get icon groups
	 *
	 */
	public function get_groups() {
		$groups = array(
			array(
				'id'   => 'admin',
				'name' => __('Admin', 'woovina-extra'),
			),
			array(
				'id'   => 'post-formats',
				'name' => __('Post Formats', 'woovina-extra'),
			),
			array(
				'id'   => 'welcome-screen',
				'name' => __('Welcome Screen', 'woovina-extra'),
			),
			array(
				'id'   => 'image-editor',
				'name' => __('Image Editor', 'woovina-extra'),
			),
			array(
				'id'   => 'text-editor',
				'name' => __('Text Editor', 'woovina-extra'),
			),
			array(
				'id'   => 'post',
				'name' => __('Post', 'woovina-extra'),
			),
			array(
				'id'   => 'sorting',
				'name' => __('Sorting', 'woovina-extra'),
			),
			array(
				'id'   => 'social',
				'name' => __('Social', 'woovina-extra'),
			),
			array(
				'id'   => 'jobs',
				'name' => __('Jobs', 'woovina-extra'),
			),
			array(
				'id'   => 'products',
				'name' => __('Internal/Products', 'woovina-extra'),
			),
			array(
				'id'   => 'taxonomies',
				'name' => __('Taxonomies', 'woovina-extra'),
			),
			array(
				'id'   => 'alerts',
				'name' => __('Alerts/Notifications', 'woovina-extra'),
			),
			array(
				'id'   => 'media',
				'name' => __('Media', 'woovina-extra'),
			),
			array(
				'id'   => 'misc',
				'name' => __('Misc./Post Types', 'woovina-extra'),
			),
		);

		/**
		 * Filter dashicon groups
		 *
		 */
		$groups = apply_filters('we_icon_picker_dashicons_groups', $groups);

		return $groups;
	}

	/**
	 * Get icon names
	 *
	 */
	public function get_items() {
		$items = array(
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-appearance',
				'name'  => __('Appearance', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-collapse',
				'name'  => __('Collapse', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-comments',
				'name'  => __('Comments', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-customizer',
				'name'  => __('Customizer', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-dashboard',
				'name'  => __('Dashboard', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-generic',
				'name'  => __('Generic', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-filter',
				'name'  => __('Filter', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-home',
				'name'  => __('Home', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-media',
				'name'  => __('Media', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-menu',
				'name'  => __('Menu', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-multisite',
				'name'  => __('Multisite', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-network',
				'name'  => __('Network', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-page',
				'name'  => __('Page', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-plugins',
				'name'  => __('Plugins', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-settings',
				'name'  => __('Settings', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-site',
				'name'  => __('Site', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-tools',
				'name'  => __('Tools', 'woovina-extra'),
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-users',
				'name'  => __('Users', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-standard',
				'name'  => __('Standard', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-aside',
				'name'  => __('Aside', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-image',
				'name'  => __('Image', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-video',
				'name'  => __('Video', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-audio',
				'name'  => __('Audio', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-quote',
				'name'  => __('Quote', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-gallery',
				'name'  => __('Gallery', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-links',
				'name'  => __('Links', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-status',
				'name'  => __('Status', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-chat',
				'name'  => __('Chat', 'woovina-extra'),
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-add-page',
				'name'  => __('Add page', 'woovina-extra'),
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-comments',
				'name'  => __('Comments', 'woovina-extra'),
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-edit-page',
				'name'  => __('Edit page', 'woovina-extra'),
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-learn-more',
				'name'  => __('Learn More', 'woovina-extra'),
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-view-site',
				'name'  => __('View Site', 'woovina-extra'),
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-widgets-menus',
				'name'  => __('Widgets', 'woovina-extra'),
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-write-blog',
				'name'  => __('Write Blog', 'woovina-extra'),
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-crop',
				'name'  => __('Crop', 'woovina-extra'),
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-filter',
				'name'  => __('Filter', 'woovina-extra'),
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-rotate',
				'name'  => __('Rotate', 'woovina-extra'),
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-rotate-left',
				'name'  => __('Rotate Left', 'woovina-extra'),
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-rotate-right',
				'name'  => __('Rotate Right', 'woovina-extra'),
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-flip-vertical',
				'name'  => __('Flip Vertical', 'woovina-extra'),
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-flip-horizontal',
				'name'  => __('Flip Horizontal', 'woovina-extra'),
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-undo',
				'name'  => __('Undo', 'woovina-extra'),
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-redo',
				'name'  => __('Redo', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-bold',
				'name'  => __('Bold', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-italic',
				'name'  => __('Italic', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-ul',
				'name'  => __('Unordered List', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-ol',
				'name'  => __('Ordered List', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-quote',
				'name'  => __('Quote', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-alignleft',
				'name'  => __('Align Left', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-aligncenter',
				'name'  => __('Align Center', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-alignright',
				'name'  => __('Align Right', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-insertmore',
				'name'  => __('Insert More', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-spellcheck',
				'name'  => __('Spell Check', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-distractionfree',
				'name'  => __('Distraction-free', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-kitchensink',
				'name'  => __('Kitchensink', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-underline',
				'name'  => __('Underline', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-justify',
				'name'  => __('Justify', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-textcolor',
				'name'  => __('Text Color', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-paste-word',
				'name'  => __('Paste Word', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-paste-text',
				'name'  => __('Paste Text', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-removeformatting',
				'name'  => __('Clear Formatting', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-video',
				'name'  => __('Video', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-customchar',
				'name'  => __('Custom Characters', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-indent',
				'name'  => __('Indent', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-outdent',
				'name'  => __('Outdent', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-help',
				'name'  => __('Help', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-strikethrough',
				'name'  => __('Strikethrough', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-unlink',
				'name'  => __('Unlink', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-rtl',
				'name'  => __('RTL', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-align-left',
				'name'  => __('Align Left', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-align-right',
				'name'  => __('Align Right', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-align-center',
				'name'  => __('Align Center', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-align-none',
				'name'  => __('Align None', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-lock',
				'name'  => __('Lock', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-calendar',
				'name'  => __('Calendar', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-calendar-alt',
				'name'  => __('Calendar', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-hidden',
				'name'  => __('Hidden', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-visibility',
				'name'  => __('Visibility', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-post-status',
				'name'  => __('Post Status', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-post-trash',
				'name'  => __('Post Trash', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-edit',
				'name'  => __('Edit', 'woovina-extra'),
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-trash',
				'name'  => __('Trash', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-up',
				'name'  => __('Arrow: Up', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-down',
				'name'  => __('Arrow: Down', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-left',
				'name'  => __('Arrow: Left', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-right',
				'name'  => __('Arrow: Right', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-up-alt',
				'name'  => __('Arrow: Up', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-down-alt',
				'name'  => __('Arrow: Down', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-left-alt',
				'name'  => __('Arrow: Left', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-right-alt',
				'name'  => __('Arrow: Right', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-up-alt2',
				'name'  => __('Arrow: Up', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-down-alt2',
				'name'  => __('Arrow: Down', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-left-alt2',
				'name'  => __('Arrow: Left', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-right-alt2',
				'name'  => __('Arrow: Right', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-leftright',
				'name'  => __('Left-Right', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-sort',
				'name'  => __('Sort', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-list-view',
				'name'  => __('List View', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-exerpt-view',
				'name'  => __('Excerpt View', 'woovina-extra'),
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-grid-view',
				'name'  => __('Grid View', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-share',
				'name'  => __('Share', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-share-alt',
				'name'  => __('Share', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-share-alt2',
				'name'  => __('Share', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-twitter',
				'name'  => __('Twitter', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-rss',
				'name'  => __('RSS', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-email',
				'name'  => __('Email', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-email-alt',
				'name'  => __('Email', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-facebook',
				'name'  => __('Facebook', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-facebook-alt',
				'name'  => __('Facebook', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-googleplus',
				'name'  => __('Google+', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-networking',
				'name'  => __('Networking', 'woovina-extra'),
			),
			array(
				'group' => 'jobs',
				'id'    => 'dashicons-art',
				'name'  => __('Art', 'woovina-extra'),
			),
			array(
				'group' => 'jobs',
				'id'    => 'dashicons-hammer',
				'name'  => __('Hammer', 'woovina-extra'),
			),
			array(
				'group' => 'jobs',
				'id'    => 'dashicons-migrate',
				'name'  => __('Migrate', 'woovina-extra'),
			),
			array(
				'group' => 'jobs',
				'id'    => 'dashicons-performance',
				'name'  => __('Performance', 'woovina-extra'),
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-wordpress',
				'name'  => __('WordPress', 'woovina-extra'),
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-wordpress-alt',
				'name'  => __('WordPress', 'woovina-extra'),
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-pressthis',
				'name'  => __('PressThis', 'woovina-extra'),
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-update',
				'name'  => __('Update', 'woovina-extra'),
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-screenoptions',
				'name'  => __('Screen Options', 'woovina-extra'),
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-info',
				'name'  => __('Info', 'woovina-extra'),
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-cart',
				'name'  => __('Cart', 'woovina-extra'),
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-feedback',
				'name'  => __('Feedback', 'woovina-extra'),
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-cloud',
				'name'  => __('Cloud', 'woovina-extra'),
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-translation',
				'name'  => __('Translation', 'woovina-extra'),
			),
			array(
				'group' => 'taxonomies',
				'id'    => 'dashicons-tag',
				'name'  => __('Tag', 'woovina-extra'),
			),
			array(
				'group' => 'taxonomies',
				'id'    => 'dashicons-category',
				'name'  => __('Category', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-yes',
				'name'  => __('Yes', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-no',
				'name'  => __('No', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-no-alt',
				'name'  => __('No', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-plus',
				'name'  => __('Plus', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-minus',
				'name'  => __('Minus', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-dismiss',
				'name'  => __('Dismiss', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-marker',
				'name'  => __('Marker', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-star-filled',
				'name'  => __('Star: Filled', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-star-half',
				'name'  => __('Star: Half', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-star-empty',
				'name'  => __('Star: Empty', 'woovina-extra'),
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-flag',
				'name'  => __('Flag', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-skipback',
				'name'  => __('Skip Back', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-back',
				'name'  => __('Back', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-play',
				'name'  => __('Play', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-pause',
				'name'  => __('Pause', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-forward',
				'name'  => __('Forward', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-skipforward',
				'name'  => __('Skip Forward', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-repeat',
				'name'  => __('Repeat', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-volumeon',
				'name'  => __('Volume: On', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-volumeoff',
				'name'  => __('Volume: Off', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-archive',
				'name'  => __('Archive', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-audio',
				'name'  => __('Audio', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-code',
				'name'  => __('Code', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-default',
				'name'  => __('Default', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-document',
				'name'  => __('Document', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-interactive',
				'name'  => __('Interactive', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-spreadsheet',
				'name'  => __('Spreadsheet', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-text',
				'name'  => __('Text', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-video',
				'name'  => __('Video', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-playlist-audio',
				'name'  => __('Audio Playlist', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-playlist-video',
				'name'  => __('Video Playlist', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-album',
				'name'  => __('Album', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-analytics',
				'name'  => __('Analytics', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-awards',
				'name'  => __('Awards', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-backup',
				'name'  => __('Backup', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-building',
				'name'  => __('Building', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-businessman',
				'name'  => __('Businessman', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-camera',
				'name'  => __('Camera', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-carrot',
				'name'  => __('Carrot', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-chart-pie',
				'name'  => __('Chart: Pie', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-chart-bar',
				'name'  => __('Chart: Bar', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-chart-line',
				'name'  => __('Chart: Line', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-chart-area',
				'name'  => __('Chart: Area', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-desktop',
				'name'  => __('Desktop', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-forms',
				'name'  => __('Forms', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-groups',
				'name'  => __('Groups', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-id',
				'name'  => __('ID', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-id-alt',
				'name'  => __('ID', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-images-alt',
				'name'  => __('Images', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-images-alt2',
				'name'  => __('Images', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-index-card',
				'name'  => __('Index Card', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-layout',
				'name'  => __('Layout', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-location',
				'name'  => __('Location', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-location-alt',
				'name'  => __('Location', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-products',
				'name'  => __('Products', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-portfolio',
				'name'  => __('Portfolio', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-book',
				'name'  => __('Book', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-book-alt',
				'name'  => __('Book', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-download',
				'name'  => __('Download', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-upload',
				'name'  => __('Upload', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-clock',
				'name'  => __('Clock', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-lightbulb',
				'name'  => __('Lightbulb', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-money',
				'name'  => __('Money', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-palmtree',
				'name'  => __('Palm Tree', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-phone',
				'name'  => __('Phone', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-search',
				'name'  => __('Search', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-shield',
				'name'  => __('Shield', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-shield-alt',
				'name'  => __('Shield', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-slides',
				'name'  => __('Slides', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-smartphone',
				'name'  => __('Smartphone', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-smiley',
				'name'  => __('Smiley', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-sos',
				'name'  => __('S.O.S.', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-sticky',
				'name'  => __('Sticky', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-store',
				'name'  => __('Store', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-tablet',
				'name'  => __('Tablet', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-testimonial',
				'name'  => __('Testimonial', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-tickets-alt',
				'name'  => __('Tickets', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-thumbs-up',
				'name'  => __('Thumbs Up', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-thumbs-down',
				'name'  => __('Thumbs Down', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-unlock',
				'name'  => __('Unlock', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-vault',
				'name'  => __('Vault', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-video-alt',
				'name'  => __('Video', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-video-alt2',
				'name'  => __('Video', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-video-alt3',
				'name'  => __('Video', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-warning',
				'name'  => __('Warning', 'woovina-extra'),
			),
		);

		/**
		 * Filter dashicon items
		 *
		 */
		$items = apply_filters('we_icon_picker_dashicons_items', $items);

		return $items;
	}
}
