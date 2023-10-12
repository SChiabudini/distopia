<?php
/**
 * The default template for displaying post meta.
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Get meta sections
$sections = woovina_blog_entry_meta();

// Return if sections are empty
if(empty($sections)) {
	return;
} ?>

<?php do_action('woovina_before_blog_entry_meta'); ?>

<ul class="meta clr">

	<?php
	// Loop through meta sections
	foreach ($sections as $section) { ?>

		<?php if('author' == $section) { ?>
			<li class="meta-author"<?php woovina_schema_markup('author_name'); ?>><i class="icon-user"></i><?php echo the_author_posts_link(); ?></li>
		<?php } ?>

		<?php if('date' == $section) { ?>
			<li class="meta-date"<?php woovina_schema_markup('publish_date'); ?>><i class="icon-clock"></i><?php echo get_the_date(); ?></li>
		<?php } ?>

		<?php if('categories' == $section) { ?>
			<li class="meta-cat"><i class="icon-folder"></i><?php the_category(' / ', get_the_ID()); ?></li>
		<?php } ?>

		<?php if('comments' == $section && comments_open() && ! post_password_required()) { ?>
			<li class="meta-comments"><i class="icon-bubble"></i><?php comments_popup_link(esc_html__('0 Comments', 'woovina'), esc_html__('1 Comment',  'woovina'), esc_html__('% Comments', 'woovina'), 'comments-link'); ?></li>
		<?php } ?>

	<?php } ?>
	
</ul>

<?php do_action('woovina_after_blog_entry_meta'); ?>