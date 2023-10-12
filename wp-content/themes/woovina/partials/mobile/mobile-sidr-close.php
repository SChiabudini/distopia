<?php
/**
 * Mobile Menu sidr close
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Get icon
$icon = get_theme_mod('woovina_mobile_menu_close_btn_icon', 'icon-close');
$icon = apply_filters('woovina_mobile_menu_close_btn_icon', $icon);

// Text
$text = get_theme_mod('woovina_mobile_menu_close_btn_text');
$text = woovina_tm_translation('woovina_mobile_menu_close_btn_text', $text);
$text = $text ? $text: esc_html__('Close Menu', 'woovina'); ?>

<div id="sidr-close">
	<a href="javascript:void(0)" class="toggle-sidr-close">
		<i class="icon <?php echo esc_attr($icon); ?>"></i><span class="close-text"><?php echo woovina_shortcode($text); ?></span>
	</a>
</div>