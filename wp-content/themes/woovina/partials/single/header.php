<?php
/**
 * Displays the post header
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
    exit;
}

// Return if quote format
if('quote' == get_post_format()) {
	return;
}

// Heading tag
$heading = get_theme_mod('woovina_single_post_heading_tag', 'h2');
$heading = $heading ? $heading : 'h2';
$heading = apply_filters('woovina_single_post_heading', $heading); ?>

<?php do_action('woovina_before_single_post_title'); ?>

<header class="entry-header clr">
	<<?php echo esc_attr($heading); ?> class="single-post-title entry-title"<?php woovina_schema_markup('headline'); ?>><?php the_title(); ?></<?php echo esc_attr($heading); ?>><!-- .single-post-title -->
</header><!-- .entry-header -->

<?php do_action('woovina_after_single_post_title'); ?>