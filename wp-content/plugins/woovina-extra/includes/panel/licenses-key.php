<?php
/**
 * Allows theme, child theme to use their licenses.
 * 
 */
if(! class_exists('WooVina_Theme_Licenses')) {
	class WooVina_Theme_Licenses {

		private $api_data		= array();
	    private $type			= '';
	    private $slug			= '';
	    private $file			= '';
	    
	    private $item_name		= '';
		private $item_shortname	= '';
		private $license_key	= '';
		private $api_url		= 'https://woovina.com/';
		private $bundle_error 	= '';
	    
		/**
		 * Class constructor.
		 * 
		 * @uses plugin_basename()
		 * @uses hook()
		 *
		 * @param string  $_api_url     The URL pointing to the custom API endpoint.
		 * @param string  $_plugin_file Path to the plugin file.
		 * @param array   $_api_data    Optional data to send with API calls.
		 * @return void
		 */
		function __construct($_type, $_item_name) {
			
			global $woovina_options;
			
			$this->type				= $_type;
			$this->item_name		= $_item_name;
			$this->item_shortname	= 'woovina_' . preg_replace('/[^a-zA-Z0-9_\s]/', '', str_replace(' ', '_', strtolower($this->item_name)));
			
			//Get license options
			$woovina_options	= get_option('woovina_options');
		
			// Get Licence key
			$this->license_key  = isset($woovina_options['licenses'][$this->item_shortname.'_license_key']) ? $woovina_options['licenses'][$this->item_shortname.'_license_key'] : '';

			// Set up hooks.
			$this->init();
		}
		

	    /**
	     * Set up WordPress filters to hook into WP's update process.
	     *
	     * @uses add_filter()
	     *
	     * @return void
	     */
		public function init() {

			// Add filter to enable license tab
			add_filter('woovina_licence_tab_enable', '__return_true');

			// Register settings
			add_action('woovina_licenses_tab_fields', array($this, 'woovina_add_settings_fields'));

			// Activate license key on settings save
			add_action('admin_init', array($this, 'woovina_activate_license'));

			// Deactivate license key
			add_action('admin_init', array($this, 'woovina_deactivate_license'));
			
			// Verify domain
			add_action('admin_init', array($this, 'woovina_verify_domain'));
		}
		
		
		/**
         * @author rf@objects
         * update options in all sites
         * @return void
         */
        public function update_woovina_option($option, $value) {
            if(is_multisite()) {
                $sites = wp_get_sites();
                foreach($sites as $site) {
                    $site_id = $site["blog_id"];
                    switch_to_blog($site_id);
                    update_option($option, $value);
                    restore_current_blog();
                }
            } else {
                update_option($option, $value);
            }
        }
		
		/**
         * delete options in all sites
         * @return void
         */
        public function delete_woovina_option($option) {
            if(is_multisite()) {
                $sites = wp_get_sites();
                foreach($sites as $site) {
                    $site_id = $site["blog_id"];
                    switch_to_blog($site_id);
                    delete_option($option);
                    restore_current_blog();
                }
            } else {
                delete_option($option);
            }
        }
		
		/**
		 * Sanitize HTML Class Names
		 *
		 * @param  string|array $class HTML Class Name(s)
		 * @return string $class
		 */
		public function sanitize_html_class($class = '') {

			if(is_string($class)) {
				$class = sanitize_html_class($class);
			} 
			else if(is_array($class)) {
				$class = array_values(array_map('sanitize_html_class', $class));
				$class = implode(' ', array_unique($class));
			}

			return $class;

		}
		
		
		/**
		 * Hide license key
		 */
		private function get_hidden_license_key($input_string = "") {
			$start 			= 5;
			$length 		= mb_strlen($input_string) - $start - 5;

			$mask_string 	= preg_replace('/\S/', 'X', $input_string);
			$mask_string 	= mb_substr($mask_string, $start, $length);
			$input_string 	= substr_replace($input_string, $mask_string, $start, $length);

			return $input_string;
		}
		
		
        /**
		 * Add license field to settings
		 *
		 * @access  public
		 * @param array   $settings
		 * @return  array
		 */
		public function woovina_add_settings_fields() {
			
			$license_key 		= $this->license_key;
			$messages 			= array();
			$license_details  	= get_option('edd_license_details');
			$expire_date		= isset($license_details[$this->item_shortname]->expires) && trim($license_details[$this->item_shortname]->expires) != '' ? $license_details[$this->item_shortname]->expires : '';

			if(! empty($license_details[$this->item_shortname]) && is_object($license_details[$this->item_shortname])) {

				// activate_license 'invalid' on anything other than valid, so if there was an error capture it
				if(false === $license_details[$this->item_shortname]->success) {

					switch($license_details[$this->item_shortname]->error) {

						case 'expired' :

							$class = 'expired-msg';
							$messages[] = sprintf(
								__('Your license key expires on %1$s%3$s%2$s. Please renew your subscription!', 'woovina-extra'),
								'<strong>', '</strong>',
								date_i18n(get_option('date_format'), strtotime($expire_date, current_time('timestamp')))
							);

							$license_status = 'license-' . $class . '-notice';

							break;

						case 'revoked' :

							$class = 'error-msg';
							$messages[] = sprintf(
								__('Your license key has been disabled. Please <a href="%1$s" target="_blank">contact support</a> for more information.', 'woovina-extra'),
								'https://woovina.com/my-account/my-tickets'
							);

							$license_status = 'license-' . $class . '-notice';

							break;

						case 'missing' :

							$class = 'error-msg';
							$messages[] = sprintf(
								__('Invalid license. Please <a href="%1$s" target="_blank">visit your account page</a> and verify it.', 'woovina-extra'),
								'https://woovina.com/my-account/my-subscriptions'
							);

							$license_status = 'license-' . $class . '-notice';

							break;
						
						case 'item_name_mismatch' :
							$class = 'error-msg';
							$messages[] = sprintf(__('This appears to be an invalid license key for <strong>%1$s</strong>.', 'woovina-extra'), $this->item_name);
							
							$license_status = 'license-' . $class . '-notice';
							break;
						
						case 'no_activations_left':

							$class = 'error-msg';
							$messages[] = sprintf(__('Your license key has reached its activation limit. <a href="%1$s">View possible upgrades</a> now.', 'woovina-extra'), 'https://woovina.com/my-account/upgrade-account?ref=dashboard');

							$license_status = 'license-' . $class . '-notice';

							break;

						default :

							$class = 'error-msg';
							$error = ! empty($license_details[$this->item_shortname]->error) ?  $license_details[$this->item_shortname]->error : __('unknown_error', 'woovina-extra');
							$messages[] = sprintf(__('There was an error with this license key: %1$s. Please <a href="%2$s">contact our support team</a>.', 'woovina-extra'), $error, 'https://woovina.com/my-account/my-tickets?ref=dashboard');

							$license_status = 'license-' . $class . '-notice';
							break;
					}

				} else {

					switch($license_details[$this->item_shortname]->license) {

						case 'valid' :
						default:

							$class = 'valid-msg';

							$now        = current_time('timestamp');
							$expiration = strtotime($expire_date, current_time('timestamp'));

							if('lifetime' === $expire_date || !strtotime($expire_date)) {

								$messages[] = __('License key never expires.', 'woovina-extra');

								$license_status = 'license-lifetime-notice';

							} elseif($expiration > $now && $expiration - $now <(DAY_IN_SECONDS * 30)) {

								$messages[] = sprintf(
									__('Your license key expires soon! It expires on %1$s%3$s%2$s. Renew your license key for auto updates.', 'woovina-extra'),
									'<strong>', '</strong>',
									date_i18n(get_option('date_format'), strtotime($expire_date, current_time('timestamp')))
								);

								$license_status = 'license-expires-soon-notice';

							} else {

								$messages[] = sprintf(
									__('Your license key expires on %1$s%3$s%2$s.', 'woovina-extra'),
									'<strong>', '</strong>',
									date_i18n(get_option('date_format'), strtotime($expire_date, current_time('timestamp')))
								);

								$license_status = 'license-expiration-date-notice';

							}

							break;

					}

				}

			} else {
				$class = 'empty-msg';

				$messages[] = sprintf(
					__('Please enter your valid license key for %1$s%3$s%2$s!', 'woovina-extra'),
					'<strong>', '</strong>',
					$this->item_name					
				);

				$license_status = null;
			}

			$class .= ' ' . $this->sanitize_html_class($class);

			$html = '<tr class="'. $this->item_shortname .'">';
				$html .= '<th>';
					$html .= '<label for="'. $this->item_shortname .'_license_key">';
						$html .= ''. sprintf(__('%1$s License Key', 'woovina-extra'), $this->item_name) .'';
					$html .= '</label>';
				$html .= '</th>';

				$html .= '<td>';
					if(! empty($license_key) && 'valid' == get_option($this->item_shortname . '_license_active')) {
						$html .= '<input type="text" class="regular-text" id="' . $this->item_shortname . '_license_key" name="woovina_options[licenses][' . $this->item_shortname . '_license_key]" value="'. esc_attr(self::get_hidden_license_key($license_key)) .'" readonly />';
					} else {
						$html .= '<input type="text" class="regular-text" id="' . $this->item_shortname . '_license_key" name="woovina_options[licenses][' . $this->item_shortname . '_license_key]" value="" />';
					}

					if('valid' == get_option($this->item_shortname . '_license_active')) {
						$html .= '<input type="submit" class="button-secondary" name="woovina_' . $this->item_shortname . '_license_key_deactivate" value="' . __('Deactivate License',  'woovina-extra') . '">';
					}

					if(! empty($messages)) {
						foreach($messages as $message) {

							$html .= '<div class="woovina-license-data woovina-license-' . $class . ' ' . $license_status . '">';
								$html .= '<p>' . $message . '</p>';
							$html .= '</div>';

						}
					}

				$html .= '</td>';
			$html .= '</tr>';

			echo $html;
	    }
		
		
		/**
		 * Activate the license key
		 *
		 * @access  public
		 * @return  void
		 */
	    public function woovina_activate_license() {
	    	
	    	if(!isset($_POST['woovina_options']) || !isset($_POST['woovina_licensekey_activateall'])) {
				return;
			}
			
			if(!isset($_POST['woovina_options']['licenses'][$this->item_shortname . '_license_key'])) {
				return;
			}

			if(strpos($_POST['woovina_options']['licenses'][$this->item_shortname . '_license_key'], "XXX") !== FALSE && $this->license_key) {
            	$_POST['woovina_options']['licenses'][$this->item_shortname . '_license_key'] = $this->license_key;
            }
			
			$license = sanitize_text_field(wp_unslash($_POST['woovina_options']['licenses'][$this->item_shortname . '_license_key']));

			if(trim($license) == '') {

				//Remove license data and update it
				$this->woovina_delete_response($this->item_shortname);
				return;
			}
			
			// Data to send to the API
			$api_params = array(
				'edd_action' => 'activate_license',
				'license'    => $license,
				'type'  	 => isset($this->type) ? $this->type : false,
	            'item_name'  => isset($this->item_name) ? $this->item_name : false,
				'url'        => home_url()
			);
			
			// Call the API
			$response = wp_remote_post(
				$this->api_url,
				array(
					'timeout'   => 15,
					'sslverify' => false,
					'body'      => $api_params
				)
			);

			// Make sure there are no errors
			if(is_wp_error($response)) {
				return;
			}

			// Tell WordPress to look for updates
			set_site_transient('update_plugins', null);
		
			// Decode license data
			$license_data = json_decode(wp_remote_retrieve_body($response));

			$this->update_woovina_option($this->item_shortname . '_license_active', $license_data->license);
			
			// Activate License for current Domain
			$home_url	 = parse_url(home_url());
			$domain_name = $home_url['host'];
			$infos = array(
				'name' 			=> $domain_name,
				'activate_date'	=> date("Y-m-d"),
				'license'		=> $license_data->success,
				'license_key'	=> $license,
				'license_type'	=> $license_data->license_type,
				'license_name'	=> $license_data->item_name,
				'pro_demos'		=> $license_data->pro_demos,
				'pro_plugins'	=> $license_data->pro_plugins,
				'show_credit'	=> $license_data->show_credit,
			);
			$this->update_woovina_option('edd_domain_infos', $infos);
		
			//Check license response data exists and update
			if(!empty($license_data)) {
				$this->woovina_update_response($this->item_shortname, $license_data);
			}

			if(!(bool) $license_data->success) {
				set_transient('edd_license_error', $license_data, 1000);
			} else {
				delete_transient('edd_license_error');
			}
	    }
		
		
		/**
		 * Deactivate the license key
		 *
		 * @access  public
		 * @return  void
		 */
	    public function woovina_deactivate_license() {
	    	
	    	if(!isset($_POST['woovina_options'])) {
				return;
			}
			
			if(!isset($_POST['woovina_options']['licenses'][$this->item_shortname . '_license_key'])) {
				return;
			}
			
			// Run on deactivate button press
			if(isset($_POST['woovina_'.$this->item_shortname.'_license_key_deactivate'])) {
				
				// Data to send to the API
				$api_params = array(
					'edd_action' => 'deactivate_license',
					'license'    => $this->license_key,
					'type'  	 => isset($this->type) ? $this->type : false,
					'item_name'  => isset($this->item_name) ? $this->item_name : false,
					'url'        => home_url()
				);

				// Call the API
				$response = wp_remote_post(
					$this->api_url,
					array(
						'timeout'   => 15,
						'sslverify' => false,
						'body'      => $api_params
					)
				);

				// Make sure there are no errors
				if(is_wp_error($response)) {
					return;
				}

				// Decode the license data
				$license_data = json_decode(wp_remote_retrieve_body($response));

				$this->delete_woovina_option($this->item_shortname . '_license_active');
				$this->delete_woovina_option('edd_domain_infos');
				
				if(!(bool) $license_data->success) {
					set_transient('edd_license_error', $license_data, 1000);
				} else {
					delete_transient('edd_license_error');

					//Remove license data and update it
					$this->woovina_delete_response($this->item_shortname);
				}
			}
	    }
		
		
		/**
		 * Update response
		 *
		 * @access  public
		 * @return  void
		 */
	    public function woovina_update_response($item_shortname, $license_data) {

			//Build license data and update it
			$license_details	= get_option('edd_license_details');
			$license_details	= !empty($license_details) ? $license_details : array();
			$license_details[$item_shortname]	= $license_data;
			$this->update_woovina_option('edd_license_details', $license_details);
	    }

		
	    /**
		 * Delete response
		 *
		 * @access  public
		 * @return  void
		 */
	    public function woovina_delete_response($item_shortname) {

			//Remove license data and update it
			$license_details	= get_option('edd_license_details');
			$license_details	= !empty($license_details) ? $license_details : array();
			if(!empty($license_details[$item_shortname])) {
				unset($license_details[$item_shortname]);
				$this->update_woovina_option('edd_license_details', $license_details);
			}
	    }
	    
		
		/**
		 * Verify domain
		 *
		 * @access  public
		 * @return  void
		 */
	    public function woovina_verify_domain() {
			
			$item_shortname 	= $this->item_shortname;
			$woovina_options	= get_option('woovina_options');
			$domain_infos		= get_option('edd_domain_infos');
			$license_details	= get_option('edd_license_details');
			$license_details	= !empty($license_details) ? $license_details : array();
			$home_url		  	= parse_url(home_url());
			$domain_name  	    = $home_url['host'];
			
			// Return if not activate yet
			if(empty($license_details[$item_shortname])) {
				return;
			}
			
			// For activated license
			if(empty($domain_infos) && !empty($license_details[$item_shortname])) {
				$infos = array(
					'name' 			=> $domain_name,
					'activate_date'	=> date("Y-m-d"),
				);
				
				$this->update_woovina_option('edd_domain_infos', $infos);
			}
			
			// Validate domain foreach 7 days
			$domain_infos 	 = get_option('edd_domain_infos');
			$activate_domain = $domain_infos['name'];
			$activate_date	 = new DateTime($domain_infos['activate_date']);
			$after_seven_day = $activate_date->modify('+7 day');
			$expiration 	 = $after_seven_day->format('Y-m-d');
			$expiration 	 = strtotime($expiration, time());
			
			if($expiration < time() && $activate_domain != $domain_name) {
				unset($woovina_options['licenses']);
				$this->update_woovina_option('woovina_options', $woovina_options);				
				
				$this->delete_woovina_option($item_shortname . '_license_active');
				$this->delete_woovina_option('edd_license_details');
				$this->delete_woovina_option('edd_domain_infos');
			}
	    }	    
	}
}