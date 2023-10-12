<?php
/**
 * Genericons
 *
 */
class WE_Icon_Picker_Type_Genericons extends WE_Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 */
	protected $id = 'genericon';

	/**
	 * Icon type name
	 *
	 */
	protected $name = 'Genericons';

	/**
	 * Icon type version
	 *
	 */
	protected $version = '3.4';

	/**
	 * Stylesheet ID
	 *
	 */
	protected $stylesheet_id = 'genericons';


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
				'id'   => 'media-player',
				'name' => __('Media Player', 'woovina-extra'),
			),
			array(
				'id'   => 'meta',
				'name' => __('Meta', 'woovina-extra'),
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
				'id'   => 'post-formats',
				'name' => __('Post Formats', 'woovina-extra'),
			),
			array(
				'id'   => 'text-editor',
				'name' => __('Text Editor', 'woovina-extra'),
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
				'id'    => 'genericon-checkmark',
				'name'  => __('Checkmark', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-close',
				'name'  => __('Close', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-close-alt',
				'name'  => __('Close', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-dropdown',
				'name'  => __('Dropdown', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-dropdown-left',
				'name'  => __('Dropdown left', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-collapse',
				'name'  => __('Collapse', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-expand',
				'name'  => __('Expand', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-help',
				'name'  => __('Help', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-info',
				'name'  => __('Info', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-lock',
				'name'  => __('Lock', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-maximize',
				'name'  => __('Maximize', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-minimize',
				'name'  => __('Minimize', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-plus',
				'name'  => __('Plus', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-minus',
				'name'  => __('Minus', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-previous',
				'name'  => __('Previous', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-next',
				'name'  => __('Next', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-move',
				'name'  => __('Move', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-hide',
				'name'  => __('Hide', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-show',
				'name'  => __('Show', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-print',
				'name'  => __('Print', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-empty',
				'name'  => __('Rating: Empty', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-half',
				'name'  => __('Rating: Half', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-full',
				'name'  => __('Rating: Full', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-refresh',
				'name'  => __('Refresh', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply',
				'name'  => __('Reply', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply-alt',
				'name'  => __('Reply alt', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply-single',
				'name'  => __('Reply single', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-search',
				'name'  => __('Search', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-send-to-phone',
				'name'  => __('Send to', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-send-to-tablet',
				'name'  => __('Send to', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-share',
				'name'  => __('Share', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-shuffle',
				'name'  => __('Shuffle', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-spam',
				'name'  => __('Spam', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-subscribe',
				'name'  => __('Subscribe', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-subscribed',
				'name'  => __('Subscribed', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unsubscribe',
				'name'  => __('Unsubscribe', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-top',
				'name'  => __('Top', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unapprove',
				'name'  => __('Unapprove', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-zoom',
				'name'  => __('Zoom', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unzoom',
				'name'  => __('Unzoom', 'woovina-extra'),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-xpost',
				'name'  => __('X-Post', 'woovina-extra'),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-skip-back',
				'name'  => __('Skip back', 'woovina-extra'),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-rewind',
				'name'  => __('Rewind', 'woovina-extra'),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-play',
				'name'  => __('Play', 'woovina-extra'),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-pause',
				'name'  => __('Pause', 'woovina-extra'),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-stop',
				'name'  => __('Stop', 'woovina-extra'),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-fastforward',
				'name'  => __('Fast Forward', 'woovina-extra'),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-skip-ahead',
				'name'  => __('Skip ahead', 'woovina-extra'),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-comment',
				'name'  => __('Comment', 'woovina-extra'),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-category',
				'name'  => __('Category', 'woovina-extra'),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-hierarchy',
				'name'  => __('Hierarchy', 'woovina-extra'),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-tag',
				'name'  => __('Tag', 'woovina-extra'),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-time',
				'name'  => __('Time', 'woovina-extra'),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-user',
				'name'  => __('User', 'woovina-extra'),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-day',
				'name'  => __('Day', 'woovina-extra'),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-week',
				'name'  => __('Week', 'woovina-extra'),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-month',
				'name'  => __('Month', 'woovina-extra'),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-pinned',
				'name'  => __('Pinned', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-uparrow',
				'name'  => __('Arrow Up', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-downarrow',
				'name'  => __('Arrow Down', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-leftarrow',
				'name'  => __('Arrow Left', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-rightarrow',
				'name'  => __('Arrow Right', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-activity',
				'name'  => __('Activity', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-bug',
				'name'  => __('Bug', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-book',
				'name'  => __('Book', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cart',
				'name'  => __('Cart', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cloud-download',
				'name'  => __('Cloud Download', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cloud-upload',
				'name'  => __('Cloud Upload', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cog',
				'name'  => __('Cog', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-document',
				'name'  => __('Document', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-dot',
				'name'  => __('Dot', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-download',
				'name'  => __('Download', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-draggable',
				'name'  => __('Draggable', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-ellipsis',
				'name'  => __('Ellipsis', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-external',
				'name'  => __('External', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-feed',
				'name'  => __('Feed', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-flag',
				'name'  => __('Flag', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-fullscreen',
				'name'  => __('Fullscreen', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-handset',
				'name'  => __('Handset', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-heart',
				'name'  => __('Heart', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-key',
				'name'  => __('Key', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-mail',
				'name'  => __('Mail', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-menu',
				'name'  => __('Menu', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-microphone',
				'name'  => __('Microphone', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-notice',
				'name'  => __('Notice', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-paintbrush',
				'name'  => __('Paint Brush', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-phone',
				'name'  => __('Phone', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-picture',
				'name'  => __('Picture', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-plugin',
				'name'  => __('Plugin', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-portfolio',
				'name'  => __('Portfolio', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-star',
				'name'  => __('Star', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-summary',
				'name'  => __('Summary', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-tablet',
				'name'  => __('Tablet', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-videocamera',
				'name'  => __('Video Camera', 'woovina-extra'),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-warning',
				'name'  => __('Warning', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-404',
				'name'  => __('404', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-trash',
				'name'  => __('Trash', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-cloud',
				'name'  => __('Cloud', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-home',
				'name'  => __('Home', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-location',
				'name'  => __('Location', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-sitemap',
				'name'  => __('Sitemap', 'woovina-extra'),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-website',
				'name'  => __('Website', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-standard',
				'name'  => __('Standard', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-aside',
				'name'  => __('Aside', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-image',
				'name'  => __('Image', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-gallery',
				'name'  => __('Gallery', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-video',
				'name'  => __('Video', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-status',
				'name'  => __('Status', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-quote',
				'name'  => __('Quote', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-link',
				'name'  => __('Link', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-chat',
				'name'  => __('Chat', 'woovina-extra'),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-audio',
				'name'  => __('Audio', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-anchor',
				'name'  => __('Anchor', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-attachment',
				'name'  => __('Attachment', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-edit',
				'name'  => __('Edit', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-code',
				'name'  => __('Code', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-bold',
				'name'  => __('Bold', 'woovina-extra'),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-italic',
				'name'  => __('Italic', 'woovina-extra'),
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-codepen',
				'name'  => 'CodePen',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-digg',
				'name'  => 'Digg',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-dribbble',
				'name'  => 'Dribbble',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-dropbox',
				'name'  => 'DropBox',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-facebook',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-facebook-alt',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-flickr',
				'name'  => 'Flickr',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-foursquare',
				'name'  => 'Foursquare',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-github',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-googleplus',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-googleplus-alt',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-instagram',
				'name'  => 'Instagram',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-linkedin',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-linkedin-alt',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-path',
				'name'  => 'Path',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pinterest',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pinterest-alt',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pocket',
				'name'  => 'Pocket',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-polldaddy',
				'name'  => 'PollDaddy',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-reddit',
				'name'  => 'Reddit',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-skype',
				'name'  => 'Skype',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-spotify',
				'name'  => 'Spotify',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-stumbleupon',
				'name'  => 'StumbleUpon',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-tumblr',
				'name'  => 'Tumblr',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-twitch',
				'name'  => 'Twitch',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-twitter',
				'name'  => 'Twitter',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-vimeo',
				'name'  => 'Vimeo',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-wordpress',
				'name'  => 'WordPress',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-youtube',
				'name'  => 'Youtube',
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
