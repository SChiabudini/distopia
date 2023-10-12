<?php
/**
 * The Template for displaying all reviews.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

$store_user = get_userdata( get_query_var( 'author' ) );
$store_info = dokan_get_store_info( $store_user->ID );
$map_location = isset( $store_info['location'] ) ? esc_attr( $store_info['location'] ) : '';

get_header( 'shop' );
?>
    <?php do_action('woovina_before_content_wrap'); ?>
	
	<div id="content-wrap" class="container clr">

		<?php do_action('woovina_before_primary'); ?>

		<div id="primary" class="dokan-content-area clr">

			<?php do_action('woovina_before_content'); ?>

			<div id="content" class="clr site-content">

				<?php do_action('woovina_before_content_inner'); ?>

				<article class="entry-content entry clr">

					<?php if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) { ?>
						<div id="dokan-secondary" class="dokan-clearfix dokan-w3 dokan-store-sidebar" role="complementary" style="margin-right:3%;">
							<div class="dokan-widget-area widget-collapse">
								<?php
								if ( ! dynamic_sidebar( 'sidebar-store' ) ) {

									$args = array(
										'before_widget' => '<aside class="widget %s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h3 class="widget-title">',
										'after_title'   => '</h3>',
									);

									if ( class_exists( 'Dokan_Store_Location' ) ) {
										the_widget( 'Dokan_Store_Category_Menu', array( 'title' => __( 'Store Category', 'woovina' ) ), $args );

										if ( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on' ) {
											the_widget( 'Dokan_Store_Location', array( 'title' => __( 'Store Location', 'woovina' ) ), $args );
										}

										if ( dokan_get_option( 'store_open_close', 'dokan_general', 'on' ) == 'on' ) {
											the_widget( 'Dokan_Store_Open_Close', array( 'title' => __( 'Store Time', 'woovina' ) ), $args );
										}

										if( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
											the_widget( 'Dokan_Store_Contact_Form', array( 'title' => __( 'Contact Vendor', 'woovina' ) ), $args );
										}
									}
								}
								?>

								<?php do_action( 'dokan_sidebar_store_after', $store_user, $store_info ); ?>
							</div>
						</div><!-- #secondary .widget-area -->
					<?php
					} else {
						get_sidebar( 'store' );
					}
					?>

					<div id="dokan-primary" class="dokan-single-store dokan-w8">
						<div id="dokan-content" class="store-review-wrap woocommerce" role="main">

							<?php dokan_get_template_part( 'store-header' ); ?>


							<?php
							$dokan_template_reviews = Dokan_Pro_Reviews::init();
							$id                     = $store_user->ID;
							$post_type              = 'product';
							$limit                  = 20;
							$status                 = '1';
							$comments               = $dokan_template_reviews->comment_query( $id, $post_type, $limit, $status );
							?>

							<div id="reviews">
								<div id="comments">

								  <?php do_action( 'dokan_review_tab_before_comments' ); ?>

									<h2 class="headline"><?php _e( 'Vendor Review', 'woovina' ); ?></h2>

									<ol class="commentlist">
										<?php echo esc_html($dokan_template_reviews->render_store_tab_comment_list( $comments , $store_user->ID)); ?>
									</ol>

								</div>
							</div>

							<?php
							echo esc_html($dokan_template_reviews->review_pagination( $id, $post_type, $limit, $status ));
							?>

						</div><!-- #content .site-content -->
					</div><!-- #primary .content-area -->

				</article><!-- #post -->

				<?php do_action('woovina_after_content_inner'); ?>

			</div><!-- #content -->

			<?php do_action('woovina_after_content'); ?>

		</div><!-- #primary -->

		<?php do_action('woovina_after_primary'); ?>	

	</div><!-- #content-wrap -->

	<?php do_action('woovina_after_content_wrap'); ?>

<?php get_footer( 'shop' ); ?>
