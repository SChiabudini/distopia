<?php
/**
 * Misc. helper functions
 *
 */

if(! function_exists('we_get_array_value_deep')) {
	/**
	 * Get value of a multidimensional array
	 * 
	 */
	function we_get_array_value_deep(array $array, array $keys) {
		if(empty($array) || empty($keys)) {
			return $array;
		}

		foreach ($keys as $idx => $key) {
			unset($keys[ $idx ]);

			if(! isset($array[ $key ])) {
				return null;
			}

			if(! empty($keys)) {
				$array = $array[ $key ];
			}
		}

		if(! isset($array[ $key ])) {
			return null;
		}

		return $array[ $key ];
	}
}


if(! function_exists('we_validate')) {
	/**
	 * Validate settings values
	 * 
	 */
	function we_validate($values, $sanitize_cb = 'wp_kses_data') {
		foreach ($values as $key => $value) {
			if(is_array($value)) {
				$values[ $key ] = we_validate($value);
			} else {
				$values[ $key ] = call_user_func_array(
					$sanitize_cb,
					array($value)
				);
			}
		}

		return $values;
	}
}

if(! function_exists('we_get_image_sizes')) {
	/**
	 * Get image sizes
	 * 
	 */
	function we_get_image_sizes() {
		$_sizes = array(
			'thumbnail' => __('Thumbnail', 'woovina-extra'),
			'medium'    => __('Medium', 'woovina-extra'),
			'large'     => __('Large', 'woovina-extra'),
			'full'      => __('Full Size', 'woovina-extra'),
		);

		$_sizes = apply_filters('image_size_names_choose', $_sizes);

		$sizes = array();
		foreach ($_sizes as $value => $label) {
			$sizes[] = array(
				'value' => $value,
				'label' => $label,
			);
		}

		return $sizes;
	}
}

if(! function_exists('we_get_script_suffix')) {
	/**
	 * Get script & style suffix
	 * 
	 */
	function we_get_script_suffix() {
		return (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
	}
}