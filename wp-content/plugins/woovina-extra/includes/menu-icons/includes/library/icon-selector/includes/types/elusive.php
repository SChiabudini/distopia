<?php
/**
 * Elusive Icons
 *
 */
class WE_Icon_Picker_Type_Elusive extends WE_Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 */
	protected $id = 'elusive';

	/**
	 * Icon type name
	 *
	 */
	protected $name = 'Elusive';

	/**
	 * Icon type version
	 *
	 */
	protected $version = '2.0';

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
				'id'   => 'currency',
				'name' => __('Currency', 'woovina-extra'),
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
				'id'   => 'places',
				'name' => __('Places', 'woovina-extra'),
			),
			array(
				'id'   => 'social',
				'name' => __('Social', 'woovina-extra'),
			),
		);

		/**
		 * Filter genericon groups
		 *
		 */
		$groups = apply_filters('we_icon_picker_genericon_groups', $groups);

		return $groups;
	}


	/**
	 * Get icon names
	 *
	 */
	public function get_items() {
		$items = array(
			array(
				'group' => 'actions',
				'id'    => 'el-icon-adjust',
				'name'  => __('Adjust', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-adjust-alt',
				'name'  => __('Adjust', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-left',
				'name'  => __('Align Left', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-center',
				'name'  => __('Align Center', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-right',
				'name'  => __('Align Right', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-justify',
				'name'  => __('Justify', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-up',
				'name'  => __('Arrow Up', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-down',
				'name'  => __('Arrow Down', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-left',
				'name'  => __('Arrow Left', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-right',
				'name'  => __('Arrow Right', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fast-backward',
				'name'  => __('Fast Backward', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-step-backward',
				'name'  => __('Step Backward', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-backward',
				'name'  => __('Backward', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-forward',
				'name'  => __('Forward', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-forward-alt',
				'name'  => __('Forward', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-step-forward',
				'name'  => __('Step Forward', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fast-forward',
				'name'  => __('Fast Forward', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-bold',
				'name'  => __('Bold', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-italic',
				'name'  => __('Italic', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-link',
				'name'  => __('Link', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-up',
				'name'  => __('Caret Up', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-down',
				'name'  => __('Caret Down', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-left',
				'name'  => __('Caret Left', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-right',
				'name'  => __('Caret Right', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-check',
				'name'  => __('Check', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-check-empty',
				'name'  => __('Check Empty', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-up',
				'name'  => __('Chevron Up', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-down',
				'name'  => __('Chevron Down', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-left',
				'name'  => __('Chevron Left', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-right',
				'name'  => __('Chevron Right', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-up',
				'name'  => __('Circle Arrow Up', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-down',
				'name'  => __('Circle Arrow Down', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-left',
				'name'  => __('Circle Arrow Left', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-right',
				'name'  => __('Circle Arrow Right', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-download',
				'name'  => __('Download', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-download-alt',
				'name'  => __('Download', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-edit',
				'name'  => __('Edit', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-eject',
				'name'  => __('Eject', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-new',
				'name'  => __('File New', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-new-alt',
				'name'  => __('File New', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-edit',
				'name'  => __('File Edit', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-edit-alt',
				'name'  => __('File Edit', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fork',
				'name'  => __('Fork', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fullscreen',
				'name'  => __('Fullscreen', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-indent-left',
				'name'  => __('Indent Left', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-indent-right',
				'name'  => __('Indent Right', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-list',
				'name'  => __('List', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-list-alt',
				'name'  => __('List', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-lock',
				'name'  => __('Lock', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-lock-alt',
				'name'  => __('Lock', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-unlock',
				'name'  => __('Unlock', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-unlock-alt',
				'name'  => __('Unlock', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-map-marker',
				'name'  => __('Map Marker', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-map-marker-alt',
				'name'  => __('Map Marker', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-minus',
				'name'  => __('Minus', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-minus-sign',
				'name'  => __('Minus Sign', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-move',
				'name'  => __('Move', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-off',
				'name'  => __('Off', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-ok',
				'name'  => __('OK', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-ok-circle',
				'name'  => __('OK Circle', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-ok-sign',
				'name'  => __('OK Sign', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-play',
				'name'  => __('Play', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-play-alt',
				'name'  => __('Play', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-pause',
				'name'  => __('Pause', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-pause-alt',
				'name'  => __('Pause', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-stop',
				'name'  => __('Stop', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-stop-alt',
				'name'  => __('Stop', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-plus',
				'name'  => __('Plus', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-plus-sign',
				'name'  => __('Plus Sign', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-print',
				'name'  => __('Print', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-question',
				'name'  => __('Question', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-question-sign',
				'name'  => __('Question Sign', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-record',
				'name'  => __('Record', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-refresh',
				'name'  => __('Refresh', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-remove',
				'name'  => __('Remove', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-repeat',
				'name'  => __('Repeat', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-repeat-alt',
				'name'  => __('Repeat', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-vertical',
				'name'  => __('Resize Vertical', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-horizontal',
				'name'  => __('Resize Horizontal', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-full',
				'name'  => __('Resize Full', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-small',
				'name'  => __('Resize Small', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-return-key',
				'name'  => __('Return', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-retweet',
				'name'  => __('Retweet', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-reverse-alt',
				'name'  => __('Reverse', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-search',
				'name'  => __('Search', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-search-alt',
				'name'  => __('Search', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-share',
				'name'  => __('Share', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-share-alt',
				'name'  => __('Share', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-tag',
				'name'  => __('Tag', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-tasks',
				'name'  => __('Tasks', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-text-height',
				'name'  => __('Text Height', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-text-width',
				'name'  => __('Text Width', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-thumbs-up',
				'name'  => __('Thumbs Up', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-thumbs-down',
				'name'  => __('Thumbs Down', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-tint',
				'name'  => __('Tint', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-trash',
				'name'  => __('Trash', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-trash-alt',
				'name'  => __('Trash', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-upload',
				'name'  => __('Upload', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-view-mode',
				'name'  => __('View Mode', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-volume-up',
				'name'  => __('Volume Up', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-volume-down',
				'name'  => __('Volume Down', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-volume-off',
				'name'  => __('Mute', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-warning-sign',
				'name'  => __('Warning Sign', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-zoom-in',
				'name'  => __('Zoom In', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-zoom-out',
				'name'  => __('Zoom Out', 'woovina-extra'),
			),
			array(
				'group' => 'currency',
				'id'    => 'el-icon-eur',
				'name'  => 'EUR',
			),
			array(
				'group' => 'currency',
				'id'    => 'el-icon-gbp',
				'name'  => 'GBP',
			),
			array(
				'group' => 'currency',
				'id'    => 'el-icon-usd',
				'name'  => 'USD',
			),
			array(
				'group' => 'media',
				'id'    => 'el-icon-video',
				'name'  => __('Video', 'woovina-extra'),
			),
			array(
				'group' => 'media',
				'id'    => 'el-icon-video-alt',
				'name'  => __('Video', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-adult',
				'name'  => __('Adult', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-address-book',
				'name'  => __('Address Book', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-address-book-alt',
				'name'  => __('Address Book', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-asl',
				'name'  => __('ASL', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-asterisk',
				'name'  => __('Asterisk', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-ban-circle',
				'name'  => __('Ban Circle', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-barcode',
				'name'  => __('Barcode', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-bell',
				'name'  => __('Bell', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-blind',
				'name'  => __('Blind', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-book',
				'name'  => __('Book', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-braille',
				'name'  => __('Braille', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-briefcase',
				'name'  => __('Briefcase', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-broom',
				'name'  => __('Broom', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-brush',
				'name'  => __('Brush', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-bulb',
				'name'  => __('Bulb', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-bullhorn',
				'name'  => __('Bullhorn', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-calendar',
				'name'  => __('Calendar', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-calendar-sign',
				'name'  => __('Calendar Sign', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-camera',
				'name'  => __('Camera', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-car',
				'name'  => __('Car', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cc',
				'name'  => __('CC', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-certificate',
				'name'  => __('Certificate', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-child',
				'name'  => __('Child', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cog',
				'name'  => __('Cog', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cog-alt',
				'name'  => __('Cog', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cogs',
				'name'  => __('Cogs', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-comment',
				'name'  => __('Comment', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-comment-alt',
				'name'  => __('Comment', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-compass',
				'name'  => __('Compass', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-compass-alt',
				'name'  => __('Compass', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-credit-card',
				'name'  => __('Credit Card', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-css',
				'name'  => 'CSS',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-envelope',
				'name'  => __('Envelope', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-envelope-alt',
				'name'  => __('Envelope', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-error',
				'name'  => __('Error', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-error-alt',
				'name'  => __('Error', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-exclamation-sign',
				'name'  => __('Exclamation Sign', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-eye-close',
				'name'  => __('Eye Close', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-eye-open',
				'name'  => __('Eye Open', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-male',
				'name'  => __('Male', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-female',
				'name'  => __('Female', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-file',
				'name'  => __('File', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-file-alt',
				'name'  => __('File', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-film',
				'name'  => __('Film', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-filter',
				'name'  => __('Filter', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-fire',
				'name'  => __('Fire', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-flag',
				'name'  => __('Flag', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-flag-alt',
				'name'  => __('Flag', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder',
				'name'  => __('Folder', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder-open',
				'name'  => __('Folder Open', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder-close',
				'name'  => __('Folder Close', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder-sign',
				'name'  => __('Folder Sign', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-font',
				'name'  => __('Font', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-fontsize',
				'name'  => __('Font Size', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-gift',
				'name'  => __('Gift', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-glass',
				'name'  => __('Glass', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-glasses',
				'name'  => __('Glasses', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-globe',
				'name'  => __('Globe', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-globe-alt',
				'name'  => __('Globe', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-graph',
				'name'  => __('Graph', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-graph-alt',
				'name'  => __('Graph', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-group',
				'name'  => __('Group', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-group-alt',
				'name'  => __('Group', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-guidedog',
				'name'  => __('Guide Dog', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-up',
				'name'  => __('Hand Up', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-down',
				'name'  => __('Hand Down', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-left',
				'name'  => __('Hand Left', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-right',
				'name'  => __('Hand Right', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hdd',
				'name'  => __('HDD', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-headphones',
				'name'  => __('Headphones', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hearing-impaired',
				'name'  => __('Hearing Impaired', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-heart',
				'name'  => __('Heart', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-heart-alt',
				'name'  => __('Heart', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-heart-empty',
				'name'  => __('Heart Empty', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hourglass',
				'name'  => __('Hourglass', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-idea',
				'name'  => __('Idea', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-idea-alt',
				'name'  => __('Idea', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-inbox',
				'name'  => __('Inbox', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-inbox-alt',
				'name'  => __('Inbox', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-inbox-box',
				'name'  => __('Inbox', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-info-sign',
				'name'  => __('Info', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-key',
				'name'  => __('Key', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-laptop',
				'name'  => __('Laptop', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-laptop-alt',
				'name'  => __('Laptop', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-leaf',
				'name'  => __('Leaf', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-lines',
				'name'  => __('Lines', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-magic',
				'name'  => __('Magic', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-magnet',
				'name'  => __('Magnet', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-mic',
				'name'  => __('Mic', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-music',
				'name'  => __('Music', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-paper-clip',
				'name'  => __('Paper Clip', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-paper-clip-alt',
				'name'  => __('Paper Clip', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-pencil',
				'name'  => __('Pencil', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-pencil-alt',
				'name'  => __('Pencil', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-person',
				'name'  => __('Person', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-phone',
				'name'  => __('Phone', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-phone-alt',
				'name'  => __('Phone', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-photo',
				'name'  => __('Photo', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-photo-alt',
				'name'  => __('Photo', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-picture',
				'name'  => __('Picture', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-plane',
				'name'  => __('Plane', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-podcast',
				'name'  => __('Podcast', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-puzzle',
				'name'  => __('Puzzle', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-qrcode',
				'name'  => __('QR Code', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-quotes',
				'name'  => __('Quotes', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-quotes-alt',
				'name'  => __('Quotes', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-random',
				'name'  => __('Random', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-scissors',
				'name'  => __('Scissors', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-screen',
				'name'  => __('Screen', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-screen-alt',
				'name'  => __('Screen', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-screenshot',
				'name'  => __('Screenshot', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-shopping-cart',
				'name'  => __('Shopping Cart', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-shopping-cart-sign',
				'name'  => __('Shopping Cart Sign', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-signal',
				'name'  => __('Signal', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-smiley',
				'name'  => __('Smiley', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-smiley-alt',
				'name'  => __('Smiley', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-speaker',
				'name'  => __('Speaker', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-user',
				'name'  => __('User', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-th',
				'name'  => __('Thumbnails', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-th-large',
				'name'  => __('Thumbnails (Large)', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-th-list',
				'name'  => __('Thumbnails (List)', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-time',
				'name'  => __('Time', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-time-alt',
				'name'  => __('Time', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-torso',
				'name'  => __('Torso', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-wheelchair',
				'name'  => __('Wheelchair', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-wrench',
				'name'  => __('Wrench', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-wrench-alt',
				'name'  => __('Wrench', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-universal-access',
				'name'  => __('Universal Access', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-bookmark',
				'name'  => __('Bookmark', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-bookmark-empty',
				'name'  => __('Bookmark Empty', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-dashboard',
				'name'  => __('Dashboard', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-home',
				'name'  => __('Home', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-home-alt',
				'name'  => __('Home', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-iphone-home',
				'name'  => __('Home (iPhone)', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-network',
				'name'  => __('Network', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-tags',
				'name'  => __('Tags', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-website',
				'name'  => __('Website', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-website-alt',
				'name'  => __('Website', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-behance',
				'name'  => 'Behance',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-blogger',
				'name'  => 'Blogger',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-cloud',
				'name'  => __('Cloud', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-cloud-alt',
				'name'  => __('Cloud', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-delicious',
				'name'  => 'Delicious',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-deviantart',
				'name'  => 'DeviantArt',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-digg',
				'name'  => 'Digg',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-dribbble',
				'name'  => 'Dribbble',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-facebook',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-facetime-video',
				'name'  => 'Facetime Video',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-flickr',
				'name'  => 'Flickr',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-foursquare',
				'name'  => 'Foursquare',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-friendfeed',
				'name'  => 'FriendFeed',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-friendfeed-rect',
				'name'  => 'FriendFeed',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-github',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-github-text',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-googleplus',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-instagram',
				'name'  => 'Instagram',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-lastfm',
				'name'  => 'Last.fm',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-linkedin',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-livejournal',
				'name'  => 'LiveJournal',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-myspace',
				'name'  => 'MySpace',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-opensource',
				'name'  => __('Open Source', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-path',
				'name'  => 'path',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-picasa',
				'name'  => 'Picasa',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-pinterest',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-rss',
				'name'  => 'RSS',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-reddit',
				'name'  => 'Reddit',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-skype',
				'name'  => 'Skype',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-slideshare',
				'name'  => 'Slideshare',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-soundcloud',
				'name'  => 'SoundCloud',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-spotify',
				'name'  => 'Spotify',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-stackoverflow',
				'name'  => 'Stack Overflow',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-stumbleupon',
				'name'  => 'StumbleUpon',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-twitter',
				'name'  => 'Twitter',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-tumblr',
				'name'  => 'Tumblr',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-viadeo',
				'name'  => 'Viadeo',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-vimeo',
				'name'  => 'Vimeo',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-vkontakte',
				'name'  => 'VKontakte',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-w3c',
				'name'  => 'W3C',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-wordpress',
				'name'  => 'WordPress',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-youtube',
				'name'  => 'YouTube',
			),
		);

		/**
		 * Filter genericon items
		 *
		 */
		$items = apply_filters('we_icon_picker_genericon_items', $items);

		return $items;
	}
}
