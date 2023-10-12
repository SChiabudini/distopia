<?php
/**
 * Footer layout
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
    exit;
} ?>

<footer id="footer" class="<?php echo esc_attr(woovina_footer_classes()); ?>"<?php woovina_schema_markup('footer'); ?>>

    <?php do_action('woovina_before_footer_inner'); ?>

    <div id="footer-inner" class="clr">

        <?php
        // Display the footer widgets if enabled
        if(woovina_display_footer_widgets()) {
        	get_template_part('partials/footer/widgets');
        }

        // Display the footer bottom if enabled
        if(woovina_display_footer_bottom()) {
        	get_template_part('partials/footer/copyright');
        } ?>
        
    </div><!-- #footer-inner -->

    <?php do_action('woovina_after_footer_inner'); ?>

</footer><!-- #footer -->