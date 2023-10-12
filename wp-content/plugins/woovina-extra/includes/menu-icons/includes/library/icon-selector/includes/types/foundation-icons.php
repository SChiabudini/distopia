<?php
/**
 * Foundation Icons
 *
 */
class WE_Icon_Picker_Type_Foundation extends WE_Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 */
	protected $id = 'foundation-icons';

	/**
	 * Icon type name
	 *
	 */
	protected $name = 'Foundation';

	/**
	 * Icon type version
	 *
	 */
	protected $version = '3.0';

	/**
	 * Get icon groups
	 *
	 */
	public function get_groups() {
		$groups = array(
			array(
				'id'   => 'accessibility',
				'name' => __('Accessibility', 'woovina-extra'),
			),
			array(
				'id'   => 'arrows',
				'name' => __('Arrows', 'woovina-extra'),
			),
			array(
				'id'   => 'devices',
				'name' => __('Devices', 'woovina-extra'),
			),
			array(
				'id'   => 'ecommerce',
				'name' => __('Ecommerce', 'woovina-extra'),
			),
			array(
				'id'   => 'editor',
				'name' => __('Editor', 'woovina-extra'),
			),
			array(
				'id'   => 'file-types',
				'name' => __('File Types', 'woovina-extra'),
			),
			array(
				'id'   => 'general',
				'name' => __('General', 'woovina-extra'),
			),
			array(
				'id'   => 'media-control',
				'name' => __('Media Controls', 'woovina-extra'),
			),
			array(
				'id'   => 'misc',
				'name' => __('Miscellaneous', 'woovina-extra'),
			),
			array(
				'id'   => 'people',
				'name' => __('People', 'woovina-extra'),
			),
			array(
				'id'   => 'social',
				'name' => __('Social/Brand', 'woovina-extra'),
			),
		);
		/**
		 * Filter genericon groups
		 *
		 */
		$groups = apply_filters('we_icon_picker_foundations_groups', $groups);

		return $groups;
	}

	/**
	 * Get icon names
	 *
	 */
	public function get_items() {
		$items = array(
			array(
				'group' => 'accessibility',
				'id'    => 'fi-asl',
				'name'  => __('ASL', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-blind',
				'name'  => __('Blind', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-braille',
				'name'  => __('Braille', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-closed-caption',
				'name'  => __('Closed Caption', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-elevator',
				'name'  => __('Elevator', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-guide-dog',
				'name'  => __('Guide Dog', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-hearing-aid',
				'name'  => __('Hearing Aid', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-universal-access',
				'name'  => __('Universal Access', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-male',
				'name'  => __('Male', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-female',
				'name'  => __('Female', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-male-female',
				'name'  => __('Male & Female', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-male-symbol',
				'name'  => __('Male Symbol', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-female-symbol',
				'name'  => __('Female Symbol', 'woovina-extra'),
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-wheelchair',
				'name'  => __('Wheelchair', 'woovina-extra'),
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrow-up',
				'name'  => __('Arrow: Up', 'woovina-extra'),
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrow-down',
				'name'  => __('Arrow: Down', 'woovina-extra'),
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrow-left',
				'name'  => __('Arrow: Left', 'woovina-extra'),
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrow-right',
				'name'  => __('Arrow: Right', 'woovina-extra'),
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrows-out',
				'name'  => __('Arrows: Out', 'woovina-extra'),
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrows-in',
				'name'  => __('Arrows: In', 'woovina-extra'),
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrows-expand',
				'name'  => __('Arrows: Expand', 'woovina-extra'),
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrows-compress',
				'name'  => __('Arrows: Compress', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-bluetooth',
				'name'  => __('Bluetooth', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-camera',
				'name'  => __('Camera', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-compass',
				'name'  => __('Compass', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-laptop',
				'name'  => __('Laptop', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-megaphone',
				'name'  => __('Megaphone', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-microphone',
				'name'  => __('Microphone', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-mobile',
				'name'  => __('Mobile', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-mobile-signal',
				'name'  => __('Mobile Signal', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-monitor',
				'name'  => __('Monitor', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-tablet-portrait',
				'name'  => __('Tablet: Portrait', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-tablet-landscape',
				'name'  => __('Tablet: Landscape', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-telephone',
				'name'  => __('Telephone', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-usb',
				'name'  => __('USB', 'woovina-extra'),
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-video',
				'name'  => __('Video', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-bitcoin',
				'name'  => __('Bitcoin', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-bitcoin-circle',
				'name'  => __('Bitcoin', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-dollar',
				'name'  => __('Dollar', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-euro',
				'name'  => __('EURO', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-pound',
				'name'  => __('Pound', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-yen',
				'name'  => __('Yen', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-burst',
				'name'  => __('Burst', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-burst-new',
				'name'  => __('Burst: New', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-burst-sale',
				'name'  => __('Burst: Sale', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-credit-card',
				'name'  => __('Credit Card', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-dollar-bill',
				'name'  => __('Dollar Bill', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-paypal',
				'name'  => 'PayPal',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-price-tag',
				'name'  => __('Price Tag', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-pricetag-multiple',
				'name'  => __('Price Tag: Multiple', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-shopping-bag',
				'name'  => __('Shopping Bag', 'woovina-extra'),
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-shopping-cart',
				'name'  => __('Shopping Cart', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-bold',
				'name'  => __('Bold', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-italic',
				'name'  => __('Italic', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-underline',
				'name'  => __('Underline', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-strikethrough',
				'name'  => __('Strikethrough', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-text-color',
				'name'  => __('Text Color', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-background-color',
				'name'  => __('Background Color', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-superscript',
				'name'  => __('Superscript', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-subscript',
				'name'  => __('Subscript', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-align-left',
				'name'  => __('Align Left', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-align-center',
				'name'  => __('Align Center', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-align-right',
				'name'  => __('Align Right', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-align-justify',
				'name'  => __('Justify', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-list-number',
				'name'  => __('List: Number', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-list-bullet',
				'name'  => __('List: Bullet', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-indent-more',
				'name'  => __('Indent', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-indent-less',
				'name'  => __('Outdent', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-add',
				'name'  => __('Add Page', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-copy',
				'name'  => __('Copy Page', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-multiple',
				'name'  => __('Duplicate Page', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-delete',
				'name'  => __('Delete Page', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-remove',
				'name'  => __('Remove Page', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-edit',
				'name'  => __('Edit Page', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-export',
				'name'  => __('Export', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-export-csv',
				'name'  => __('Export to CSV', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-export-pdf',
				'name'  => __('Export to PDF', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-filled',
				'name'  => __('Fill Page', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-crop',
				'name'  => __('Crop', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-filter',
				'name'  => __('Filter', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-paint-bucket',
				'name'  => __('Paint Bucket', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-photo',
				'name'  => __('Photo', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-print',
				'name'  => __('Print', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-save',
				'name'  => __('Save', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-link',
				'name'  => __('Link', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-unlink',
				'name'  => __('Unlink', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-quote',
				'name'  => __('Quote', 'woovina-extra'),
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-search',
				'name'  => __('Search in Page', 'woovina-extra'),
			),
			array(
				'group' => 'file-types',
				'id'    => 'fi-page',
				'name'  => __('File', 'woovina-extra'),
			),
			array(
				'group' => 'file-types',
				'id'    => 'fi-page-csv',
				'name'  => __('CSV', 'woovina-extra'),
			),
			array(
				'group' => 'file-types',
				'id'    => 'fi-page-doc',
				'name'  => __('Doc', 'woovina-extra'),
			),
			array(
				'group' => 'file-types',
				'id'    => 'fi-page-pdf',
				'name'  => __('PDF', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-address-book',
				'name'  => __('Addressbook', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-alert',
				'name'  => __('Alert', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-annotate',
				'name'  => __('Annotate', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-archive',
				'name'  => __('Archive', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-bookmark',
				'name'  => __('Bookmark', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-calendar',
				'name'  => __('Calendar', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-clock',
				'name'  => __('Clock', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-cloud',
				'name'  => __('Cloud', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-comment',
				'name'  => __('Comment', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-comment-minus',
				'name'  => __('Comment: Minus', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-comment-quotes',
				'name'  => __('Comment: Quotes', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-comment-video',
				'name'  => __('Comment: Video', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-comments',
				'name'  => __('Comments', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-contrast',
				'name'  => __('Contrast', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-database',
				'name'  => __('Database', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-folder',
				'name'  => __('Folder', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-folder-add',
				'name'  => __('Folder: Add', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-folder-lock',
				'name'  => __('Folder: Lock', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-eye',
				'name'  => __('Eye', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-heart',
				'name'  => __('Heart', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-plus',
				'name'  => __('Plus', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-minus',
				'name'  => __('Minus', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-minus-circle',
				'name'  => __('Minus', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-x',
				'name'  => __('X', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-x-circle',
				'name'  => __('X', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-check',
				'name'  => __('Check', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-checkbox',
				'name'  => __('Check', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-download',
				'name'  => __('Download', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-upload',
				'name'  => __('Upload', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-upload-cloud',
				'name'  => __('Upload to Cloud', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-flag',
				'name'  => __('Flag', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-foundation',
				'name'  => __('Foundation', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-graph-bar',
				'name'  => __('Graph: Bar', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-graph-horizontal',
				'name'  => __('Graph: Horizontal', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-graph-pie',
				'name'  => __('Graph: Pie', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-graph-trend',
				'name'  => __('Graph: Trend', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-home',
				'name'  => __('Home', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-layout',
				'name'  => __('Layout', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-like',
				'name'  => __('Like', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-dislike',
				'name'  => __('Dislike', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-list',
				'name'  => __('List', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-list-thumbnails',
				'name'  => __('List: Thumbnails', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-lock',
				'name'  => __('Lock', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-unlock',
				'name'  => __('Unlock', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-marker',
				'name'  => __('Marker', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-magnifying-glass',
				'name'  => __('Magnifying Glass', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-refresh',
				'name'  => __('Refresh', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-paperclip',
				'name'  => __('Paperclip', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-pencil',
				'name'  => __('Pencil', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-play-video',
				'name'  => __('Play Video', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-results',
				'name'  => __('Results', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-results-demographics',
				'name'  => __('Results: Demographics', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-rss',
				'name'  => __('RSS', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-share',
				'name'  => __('Share', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-sound',
				'name'  => __('Sound', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-star',
				'name'  => __('Star', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-thumbnails',
				'name'  => __('Thumbnails', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-trash',
				'name'  => __('Trash', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-web',
				'name'  => __('Web', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-widget',
				'name'  => __('Widget', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-wrench',
				'name'  => __('Wrench', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-zoom-out',
				'name'  => __('Zoom Out', 'woovina-extra'),
			),
			array(
				'group' => 'general',
				'id'    => 'fi-zoom-in',
				'name'  => __('Zoom In', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-record',
				'name'  => __('Record', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-play-circle',
				'name'  => __('Play', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-play',
				'name'  => __('Play', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-pause',
				'name'  => __('Pause', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-stop',
				'name'  => __('Stop', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-previous',
				'name'  => __('Previous', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-rewind',
				'name'  => __('Rewind', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-fast-forward',
				'name'  => __('Fast Forward', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-next',
				'name'  => __('Next', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-volume',
				'name'  => __('Volume', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-volume-none',
				'name'  => __('Volume: Low', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-volume-strike',
				'name'  => __('Volume: Mute', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-loop',
				'name'  => __('Loop', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-shuffle',
				'name'  => __('Shuffle', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-eject',
				'name'  => __('Eject', 'woovina-extra'),
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-rewind-ten',
				'name'  => __('Rewind 10', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-anchor',
				'name'  => __('Anchor', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-asterisk',
				'name'  => __('Asterisk', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-at-sign',
				'name'  => __('@', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-battery-full',
				'name'  => __('Battery: Full', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-battery-half',
				'name'  => __('Battery: Half', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-battery-empty',
				'name'  => __('Battery: Empty', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-book',
				'name'  => __('Book', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-book-bookmark',
				'name'  => __('Bookmark', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-clipboard',
				'name'  => __('Clipboard', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-clipboard-pencil',
				'name'  => __('Clipboard: Pencil', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-clipboard-notes',
				'name'  => __('Clipboard: Notes', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-crown',
				'name'  => __('Crown', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-one',
				'name'  => __('Dice: 1', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-two',
				'name'  => __('Dice: 2', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-three',
				'name'  => __('Dice: 3', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-four',
				'name'  => __('Dice: 4', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-five',
				'name'  => __('Dice: 5', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-six',
				'name'  => __('Dice: 6', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-safety-cone',
				'name'  => __('Cone', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-first-aid',
				'name'  => __('Firs Aid', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-foot',
				'name'  => __('Foot', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-info',
				'name'  => __('Info', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-key',
				'name'  => __('Key', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-lightbulb',
				'name'  => __('Lightbulb', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-map',
				'name'  => __('Map', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-mountains',
				'name'  => __('Mountains', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-music',
				'name'  => __('Music', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-no-dogs',
				'name'  => __('No Dogs', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-no-smoking',
				'name'  => __('No Smoking', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-paw',
				'name'  => __('Paw', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-power',
				'name'  => __('Power', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-prohibited',
				'name'  => __('Prohibited', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-projection-screen',
				'name'  => __('Projection Screen', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-puzzle',
				'name'  => __('Puzzle', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-sheriff-badge',
				'name'  => __('Sheriff Badge', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-shield',
				'name'  => __('Shield', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-skull',
				'name'  => __('Skull', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-target',
				'name'  => __('Target', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-target-two',
				'name'  => __('Target', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-ticket',
				'name'  => __('Ticket', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-trees',
				'name'  => __('Trees', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-trophy',
				'name'  => __('Trophy', 'woovina-extra'),
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torso',
				'name'  => __('Torso', 'woovina-extra'),
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torso-business',
				'name'  => __('Torso: Business', 'woovina-extra'),
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torso-female',
				'name'  => __('Torso: Female', 'woovina-extra'),
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torsos',
				'name'  => __('Torsos', 'woovina-extra'),
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torsos-all',
				'name'  => __('Torsos: All', 'woovina-extra'),
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torsos-all-female',
				'name'  => __('Torsos: All Female', 'woovina-extra'),
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torsos-male-female',
				'name'  => __('Torsos: Male & Female', 'woovina-extra'),
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torsos-female-male',
				'name'  => __('Torsos: Female & Male', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-500px',
				'name'  => '500px',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-adobe',
				'name'  => 'Adobe',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-amazon',
				'name'  => 'Amazon',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-android',
				'name'  => 'Android',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-apple',
				'name'  => 'Apple',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-behance',
				'name'  => 'Behance',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-bing',
				'name'  => 'bing',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-blogger',
				'name'  => 'Blogger',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-css3',
				'name'  => 'CSS3',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-delicious',
				'name'  => 'Delicious',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-designer-news',
				'name'  => 'Designer News',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-deviant-art',
				'name'  => 'deviantArt',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-digg',
				'name'  => 'Digg',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-dribbble',
				'name'  => 'dribbble',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-drive',
				'name'  => 'Drive',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-dropbox',
				'name'  => 'DropBox',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-evernote',
				'name'  => 'Evernote',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-facebook',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-flickr',
				'name'  => 'flickr',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-forrst',
				'name'  => 'forrst',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-foursquare',
				'name'  => 'Foursquare',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-game-center',
				'name'  => 'Game Center',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-github',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-google-plus',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-hacker-news',
				'name'  => 'Hacker News',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-hi5',
				'name'  => 'hi5',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-html5',
				'name'  => 'HTML5',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-instagram',
				'name'  => 'Instagram',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-joomla',
				'name'  => 'Joomla!',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-lastfm',
				'name'  => 'last.fm',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-linkedin',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-medium',
				'name'  => 'Medium',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-myspace',
				'name'  => 'My Space',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-orkut',
				'name'  => 'Orkut',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-path',
				'name'  => 'path',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-picasa',
				'name'  => 'Picasa',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-pinterest',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-rdio',
				'name'  => 'rdio',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-reddit',
				'name'  => 'reddit',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-skype',
				'name'  => 'Skype',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-skillshare',
				'name'  => 'SkillShare',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-smashing-mag',
				'name'  => 'Smashing Mag.',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-snapchat',
				'name'  => 'Snapchat',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-spotify',
				'name'  => 'Spotify',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-squidoo',
				'name'  => 'Squidoo',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-stack-overflow',
				'name'  => 'StackOverflow',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-steam',
				'name'  => 'Steam',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-stumbleupon',
				'name'  => 'StumbleUpon',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-treehouse',
				'name'  => 'TreeHouse',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-tumblr',
				'name'  => 'Tumblr',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-twitter',
				'name'  => 'Twitter',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-windows',
				'name'  => 'Windows',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-xbox',
				'name'  => 'XBox',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-yahoo',
				'name'  => 'Yahoo!',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-yelp',
				'name'  => 'Yelp',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-youtube',
				'name'  => 'YouTube',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-zerply',
				'name'  => 'Zerply',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-zurb',
				'name'  => 'Zurb',
			),
		);

		/**
		 * Filter genericon items
		 *
		 */
		$items = apply_filters('we_icon_picker_foundations_items', $items);

		return $items;
	}
}
