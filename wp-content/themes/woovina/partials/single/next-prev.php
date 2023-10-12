<?php
/**
 * The next/previous links to go to another post.
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
    exit;
}

// Only display for standard posts
if('post' != get_post_type()) {
	return;
}

// Term
$term_tax = get_theme_mod('woovina_single_post_next_prev_taxonomy', 'post_tag');
$term_tax = $term_tax ? $term_tax : 'post_tag';

// Args
$args = array(
	'prev_text'             => '<span class="title"><i class="fa fa-long-arrow-left"></i>'. esc_html__('Previous Post', 'woovina') .'</span><span class="post-title">%title</span>',
    'next_text'             => '<span class="title"><i class="fa fa-long-arrow-right"></i>'. esc_html__('Next Post', 'woovina') .'</span><span class="post-title">%title</span>',
    'in_same_term'          => true,
    'taxonomy'              => $term_tax,
    'screen_reader_text'    => esc_html__('Continue Reading', 'woovina'),
);

// Args
$args = apply_filters('woovina_single_post_next_prev_args', $args); ?>

<?php do_action('woovina_before_single_post_next_prev'); ?>

<?php the_post_navigation($args); ?>

<?php do_action('woovina_after_single_post_next_prev'); ?>