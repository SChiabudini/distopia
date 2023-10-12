<?php
/**
 * Simple Line Icons
 *
 */

require_once dirname(__FILE__) . '/font.php';

/**
 * Icon type: Simple Line Icons
 *
 */

class WE_Icon_Picker_Type_Simple_Line_Icons extends WE_Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 */
	protected $id = 'line-icon';

	/**
	 * Icon type name
	 *
	 */
	protected $name = 'Simple Line Icons';

	/**
	 * Icon type version
	 *
	 */
	protected $version = '2.4.0';

	/**
	 * Stylesheet ID
	 *
	 */
	protected $stylesheet_id = 'simple-line-icons';

	/**
	 * Get icon groups
	 *
	 */
	public function get_groups() {
		$groups = array(
			array(
				'id'   => 'actions',
				'name' => __('Actions', 'woovina-extra'),
			),
			array(
				'id'   => 'media',
				'name' => __('Media', 'woovina-extra'),
			),
			array(
				'id'   => 'misc',
				'name' => __('Misc.', 'woovina-extra'),
			),
			array(
				'id'   => 'social',
				'name' => __('Social', 'woovina-extra'),
			),
		);

		/**
		 * Filter simple line icons groups
		 *
		 */
		$groups = apply_filters('we_icon_picker_simple_line_icons_groups', $groups);

		return $groups;
	}

	/**
	 * Get icon names
	 *
	 */
	public function get_items() {
		$items = array(
			array(
				'group' => 'misc',
				'id'    => 'icon-user',
				'name'  => __('User', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-people',
				'name'  => __('People', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-user-female',
				'name'  => __('User Female', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-user-follow',
				'name'  => __('User Follow', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-user-following',
				'name'  => __('User Following', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-user-unfollow',
				'name'  => __('User Unfollow', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-login',
				'name'  => __('Login', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-logout',
				'name'  => __('Logout', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-emotsmile',
				'name'  => __('Emotsmile', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-phone',
				'name'  => __('Phone', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-call-end',
				'name'  => __('Call End', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-call-in',
				'name'  => __('Call In', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-call-out',
				'name'  => __('Call Out', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-map',
				'name'  => __('Map', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-location-pin',
				'name'  => __('Location Pin', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-direction',
				'name'  => __('Direction', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-directions',
				'name'  => __('Directions', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-compass',
				'name'  => __('Compass', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-layers',
				'name'  => __('Layers', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-menu',
				'name'  => __('Menu', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-list',
				'name'  => __('List', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-options-vertical',
				'name'  => __('Options Vertical', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-options',
				'name'  => __('Options', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-down',
				'name'  => __('Arrow Down', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-left',
				'name'  => __('Arrow Left', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-right',
				'name'  => __('Arrow Right', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-up',
				'name'  => __('Arrow Up', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-up-circle',
				'name'  => __('Arrow Up Circle', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-left-circle',
				'name'  => __('Arrow Left Circle', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-right-circle',
				'name'  => __('Arrow Right Circle', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-arrow-down-circle',
				'name'  => __('Arrow Down Circle', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-check',
				'name'  => __('Check', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-clock',
				'name'  => __('Clock', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-plus',
				'name'  => __('Plus', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-minus',
				'name'  => __('Minus', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-close',
				'name'  => __('Close', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-exclamation',
				'name'  => __('Exclamation', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-organization',
				'name'  => __('Organization', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-trophy',
				'name'  => __('Trophy', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-screen-smartphone',
				'name'  => __('Screen Smartphone', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-screen-desktop',
				'name'  => __('Screen Desktop', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-plane',
				'name'  => __('Plane', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-notebook',
				'name'  => __('Notebook', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-mustache',
				'name'  => __('Mustache', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-mouse',
				'name'  => __('Mouse', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-magnet',
				'name'  => __('Magnet', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-energy',
				'name'  => __('Energy', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-disc',
				'name'  => __('Disc', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-cursor',
				'name'  => __('Cursor', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-cursor-move',
				'name'  => __('Cursor Move', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-crop',
				'name'  => __('Crop', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-chemistry',
				'name'  => __('Chemistry', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-speedometer',
				'name'  => __('Speedometer', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-shield',
				'name'  => __('Shield', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-screen-tablet',
				'name'  => __('Screen Tablet', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-magic-wand',
				'name'  => __('Magic Wand', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-hourglass',
				'name'  => __('Hourglass', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-graduation',
				'name'  => __('Graduation', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-ghost',
				'name'  => __('Ghost', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-game-controller',
				'name'  => __('Game Controller', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-fire',
				'name'  => __('Fire', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-eyeglass',
				'name'  => __('Eyeglass', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-envelope-open',
				'name'  => __('Envelope Open', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-envelope-letter',
				'name'  => __('Envelope Letter', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-bell',
				'name'  => __('Bell', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-badge',
				'name'  => __('Badge', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-anchor',
				'name'  => __('Anchor', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-wallet',
				'name'  => __('Wallet', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-vector',
				'name'  => __('Vector', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-speech',
				'name'  => __('Speech', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-puzzle',
				'name'  => __('Puzzle', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-printer',
				'name'  => __('Printer', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-present',
				'name'  => __('Present', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-playlist',
				'name'  => __('Playlist', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-pin',
				'name'  => __('Pin', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-picture',
				'name'  => __('Picture', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-handbag',
				'name'  => __('Handbag', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-globe-alt',
				'name'  => __('Globe Alt', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-globe',
				'name'  => __('Globe', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-folder-alt',
				'name'  => __('Folder Alt', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-folder',
				'name'  => __('Folder', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-film',
				'name'  => __('Film', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-feed',
				'name'  => __('Feed', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-drop',
				'name'  => __('Drop', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-drawer',
				'name'  => __('Drawer', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-docs',
				'name'  => __('Docs', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-doc',
				'name'  => __('Doc', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-diamond',
				'name'  => __('Diamond', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-cup',
				'name'  => __('Cup', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-calculator',
				'name'  => __('Calculator', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-bubbles',
				'name'  => __('Bubbles', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-briefcase',
				'name'  => __('Briefcase', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-book-open',
				'name'  => __('Book Open', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-basket-loaded',
				'name'  => __('Basket Loaded', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-basket',
				'name'  => __('Basket', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-bag',
				'name'  => __('Bag', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-action-undo',
				'name'  => __('Action Undo', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'icon-action-redo',
				'name'  => __('Action Redo', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-wrench',
				'name'  => __('Wrench', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-umbrella',
				'name'  => __('Umbrella', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-trash',
				'name'  => __('Trash', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-tag',
				'name'  => __('Tag', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-support',
				'name'  => __('Support', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-frame',
				'name'  => __('Frame', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-size-fullscreen',
				'name'  => __('Size Fullscreen', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-size-actual',
				'name'  => __('Size Actual', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-shuffle',
				'name'  => __('Shuffle', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-share-alt',
				'name'  => __('Share Alt', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-share',
				'name'  => __('Share', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-rocket',
				'name'  => __('Rocket', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-question',
				'name'  => __('Question', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-pie-chart',
				'name'  => __('Pie Chart', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-pencil',
				'name'  => __('Pencil', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-note',
				'name'  => __('Note', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-loop',
				'name'  => __('Loop', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-home',
				'name'  => __('Home', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-grid',
				'name'  => __('Grid', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-graph',
				'name'  => __('Graph', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-microphone',
				'name'  => __('Microphone', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-music-tone-alt',
				'name'  => __('Music Tone Alt', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-music-tone',
				'name'  => __('Music Tone', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-earphones-alt',
				'name'  => __('Earphones Alt', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-earphones',
				'name'  => __('Earphones', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-equalizer',
				'name'  => __('Equalizer', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-like',
				'name'  => __('Like', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-dislike',
				'name'  => __('Dislike', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-start',
				'name'  => __('Control Start', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-rewind',
				'name'  => __('Control Rewind', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-play',
				'name'  => __('Control Play', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-pause',
				'name'  => __('Control Pause', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-forward',
				'name'  => __('Control Forward', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-control-end',
				'name'  => __('Control End', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-volume-1',
				'name'  => __('Volume 1', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-volume-2',
				'name'  => __('Volume 2', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'icon-volume-off',
				'name'  => __('Volume Off', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-calendar',
				'name'  => __('Calendar', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-bulb',
				'name'  => __('Bulb', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-chart',
				'name'  => __('Chart', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-ban',
				'name'  => __('Ban', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-bubble',
				'name'  => __('Bubble', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-camrecorder',
				'name'  => __('Camrecorder', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-camera',
				'name'  => __('Camera', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-cloud-download',
				'name'  => __('Cloud Download', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-cloud-upload',
				'name'  => __('Cloud Upload', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-envelope',
				'name'  => __('Envelope', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-eye',
				'name'  => __('Eye', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-flag',
				'name'  => __('Flag', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-heart',
				'name'  => __('Heart', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-info',
				'name'  => __('Info', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-key',
				'name'  => __('Key', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-link',
				'name'  => __('Link', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-lock',
				'name'  => __('Lock', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-lock-open',
				'name'  => __('Lock Open', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-magnifier',
				'name'  => __('Magnifier', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-magnifier-add',
				'name'  => __('Magnifier Add', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-magnifier-remove',
				'name'  => __('Magnifier Remove', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-paper-clip',
				'name'  => __('Paper Clip', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-paper-plane',
				'name'  => __('Paper Plane', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-power',
				'name'  => __('Power', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-refresh',
				'name'  => __('Refresh', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-reload',
				'name'  => __('Reload', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-settings',
				'name'  => __('Settings', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-star',
				'name'  => __('Star', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-symbol-female',
				'name'  => __('Symbol Female', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-symbol-male',
				'name'  => __('Symbol Male', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-target',
				'name'  => __('Target', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-credit-card',
				'name'  => __('Credit Card', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'icon-paypal',
				'name'  => __('Paypal', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-tumblr',
				'name'  => __('Social Tumblr', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-twitter',
				'name'  => __('Social Twitter', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-facebook',
				'name'  => __('Social Facebook', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-instagram',
				'name'  => __('Social Instagram', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-linkedin',
				'name'  => __('Social Linkedin', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-pinterest',
				'name'  => __('Social Pinterest', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-github',
				'name'  => __('Social Github', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-google',
				'name'  => __('Social Google', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-reddit',
				'name'  => __('Social Reddit', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-skype',
				'name'  => __('Social Skype', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-dribbble',
				'name'  => __('Social Dribbble', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-behance',
				'name'  => __('Social Behance', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-foursqare',
				'name'  => __('Social Foursqare', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-soundcloud',
				'name'  => __('Social Soundcloud', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-spotify',
				'name'  => __('Social Spotify', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-stumbleupon',
				'name'  => __('Social Stumbleupon', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-youtube',
				'name'  => __('Social Youtube', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'icon-social-dropbox',
				'name'  => __('Social Dropbox', 'woovina-extra'),
			),
		);

		/**
		 * Filter simple line icons items
		 *
		 */
		$items = apply_filters('we_icon_picker_simple_line_icons_items', $items);

		return $items;
	}
}
