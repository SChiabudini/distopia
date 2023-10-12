<?php
/**
 * Topbar content
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
    exit;
}

// Get the template
$template = get_theme_mod('woovina_top_bar_template');

// Check if page is Elementor page
$elementor = get_post_meta($template, '_elementor_edit_mode', true);

// Get content
$get_content = woovina_topbar_template_content();

// Get topbar content
$content = get_theme_mod('woovina_top_bar_content');
$content = woovina_tm_translation('woovina_top_bar_content', $content);

// Display topbar content
if(! empty($template)
    || $content
    || has_nav_menu('topbar_menu')
    || is_customize_preview()) : ?>

    <div id="top-bar-content" class="<?php echo esc_attr(woovina_topbar_content_classes()); ?>">

        <?php
        // Get topbar menu
        if(has_nav_menu('topbar_menu'))  {
            get_template_part('partials/topbar/nav');
        } ?>

        <?php
        // If template
        if(! empty($template)) { ?>

            <div id="topbar-template">

               <?php
               // If Elementor
                if(WOOVINA_ELEMENTOR_ACTIVE && $elementor) {

                    WooVina_Elementor::get_topbar_content();

                }

                // If Beaver Builder
                else if(WOOVINA_BEAVER_BUILDER_ACTIVE && ! empty($template)) {

                    echo woovina_shortcode('[fl_builder_insert_layout id="' . $template . '"]');

                }

                // Else
                else {

                    // Display template content
                    echo woovina_shortcode($get_content);

                } ?>

            </div>

        <?php
        } else { ?>

            <?php
            // Check if there is content for the topbar
            if($content
                || is_customize_preview()) : ?>

                <span class="topbar-content">

                    <?php
                    // Display top bar content
                    echo woovina_shortcode($content); ?>

                </span>

            <?php endif;

        } ?>

    </div><!-- #top-bar-content -->

<?php endif; ?>