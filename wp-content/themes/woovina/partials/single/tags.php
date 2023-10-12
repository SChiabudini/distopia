<?php
/**
 * Blog single tags
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
    exit;
}

// Display tags ?>
<div class="post-tags clr">
	<?php the_tags(); ?>
</div>