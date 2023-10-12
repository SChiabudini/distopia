<?php
/**
 * Admin notice
 *
 * @package WooVina_Extra
 * @category Core
 * @author WooVina
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
    exit;
}

// The Notice class
if(! class_exists('WooVina_Extra_Admin_Notice')) {

    class WooVina_Extra_Admin_Notice {

        /**
         * Admin constructor
         */
        public function __construct() {
            add_action('admin_notices', array($this, 'admin_notice'));
            add_action('admin_init', array($this, 'dismiss_notice'));
            add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
        }

        /**
         * Display admin notice
         *
         * @since   1.2.6
         */
        public static function admin_notice() {
            // Show notice after 24 hours from installed time.
            if(self::get_installed_time() > strtotime('-24 hours')
                || '1' === get_option('woovina_extra_dismiss_notice')
                || !current_user_can('manage_options')
                || apply_filters('woovina_show_hooks_notice', false)) {
                return;
            }

            $no_thanks  = wp_nonce_url(add_query_arg('woovina_extra_notice', 'no_thanks_btn'), 'no_thanks_btn');
            $dismiss    = wp_nonce_url(add_query_arg('woovina_extra_notice', 'dismiss_btn'), 'dismiss_btn'); ?>
            
            <div class="notice notice-success woovina-extra-notice">
                <div class="notice-inner">
                    <span class="dashicons dashicons-heart"></span>
                    <div class="notice-content">
                        <h3 style="margin: 5px 0 0 0;"><?php esc_html_e('The Easiest Way To Create Your E-Commerce Website', 'woovina-extra'); ?></h3>
						<p><?php esc_html_e('Do you want an online store for your business? Let us build you a perfect custom store that will work with full e-commerce features, beautiful design, optimized for SEO and the cheapest cost!', 'woovina-extra'); ?></p>
                        <p><a href="https://woovina.com/services/ecommerce-web-design?ref=dashboard" class="btn button-primary" target="_blank"><?php _e('Get Free Consultation', 'woovina-extra'); ?></a><a href="<?php echo $no_thanks; ?>" class="btn button-secondary"><?php _e('No thanks', 'woovina-extra'); ?></a></p>
                    </div>
                    <a href="<?php echo $dismiss; ?>" class="dismiss"><span class="dashicons dashicons-dismiss"></span></a>
                </div>
            </div>
        <?php
        }
		
		/**
		 * Function check user license
		 * @access  public
		 * @since   1.2
		 * @return  void
		 */
		public static function is_valid_license() {
			$theme = wp_get_theme();
			$name  = strtolower($theme->name);
			$key   = ($name == 'woovina') ? 'woovina_priority_support' : 'woovina_' . $name . '_theme';

			$home_url			= home_url();
			$license 			= get_option('edd_license_details');
			$license_details 	= @$license[$key];
			$license 			= false;
			
			if((! empty($license_details) && is_object($license_details) && true === $license_details->success 
			&& false === strpos($license_details->item_name, 'Free')) || strpos($home_url, 'woovina.net') !== false) {
				$license = true;
			}
			
			return $license;
		}
		
        /**
         * Dismiss admin notice
         *
         * @since   1.2.6
         */
        public static function dismiss_notice() {
            if(! isset($_GET['woovina_extra_notice'])) {
                return;
            }

            if('dismiss_btn' === $_GET['woovina_extra_notice']) {
                check_admin_referer('dismiss_btn');
                update_option('woovina_extra_dismiss_notice', '1');
            }

            if('no_thanks_btn' === $_GET['woovina_extra_notice']) {
                check_admin_referer('no_thanks_btn');
                update_option('woovina_extra_dismiss_notice', '1');
            }

            wp_redirect(remove_query_arg('woovina_extra_notice'));
            exit;
        }

        /**
         * Installed time
         *
         * @since   1.2.6
         */
        private static function get_installed_time() {
            $installed_time = get_option('woovina_extra_installed_time');
            if(! $installed_time) {
                $installed_time = time();
                update_option('woovina_extra_installed_time', $installed_time);
            }
            return $installed_time;
        }

        /**
         * Style
         *
         * @since 1.2.1
         */
        public static function admin_scripts() {

            if(self::get_installed_time() > strtotime('-24 hours')
                || '1' === get_option('woovina_extra_dismiss_notice')
                || ! current_user_can('manage_options')
                || apply_filters('woovina_show_hooks_notice', false)) {
                return;
            }

            // CSS
            wp_enqueue_style('we-admin-notice', plugins_url('/assets/css/notice.min.css', __FILE__));

        }

    }

    new WooVina_Extra_Admin_Notice();
}