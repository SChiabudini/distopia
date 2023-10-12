<?php
/**
 * Displays post entry content
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
} ?>

<?php do_action('woovina_before_blog_entry_content'); ?>

<div class="blog-entry-summary clr"<?php woovina_schema_markup('entry_content'); ?>>

    <?php
    // Display excerpt
    if('500' != get_theme_mod('woovina_blog_entry_excerpt_length', '30')) : ?>

        <p>
            <?php
            // Display custom excerpt
            echo woovina_excerpt(get_theme_mod('woovina_blog_entry_excerpt_length', '30')); ?>
        </p>

    <?php
    // If excerpts are disabled, display full content
    else :

        the_content('', '&hellip;');

    endif; ?>

</div><!-- .blog-entry-summary -->

<?php do_action('woovina_after_blog_entry_content'); ?>