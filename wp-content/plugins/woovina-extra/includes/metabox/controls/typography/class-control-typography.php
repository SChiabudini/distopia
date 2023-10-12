<?php
/**
 * Typography control class.
 *
 * @package     WooVina WordPress theme
 * @subpackage  Controls
 * @see   		https://github.com/justintadlock/butterbean
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Typography control
 *
 * @since  1.0.0
 * @access public
 */
class WooVina_ButterBean_Control_Typography extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Creates a new control object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $name
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $name, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $name, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'family'      	=> esc_html__( 'Font Family', 'woovina-portfolio' ),
				'size'        	=> esc_html__( 'Font Size',   'woovina-portfolio' ),
				'weight'      	=> esc_html__( 'Font Weight', 'woovina-portfolio' ),
				'style'      	=> esc_html__( 'Font Style',  'woovina-portfolio' ),
				'transform' 	=> esc_html__( 'Text Transform', 'woovina-portfolio' ),
				'line_height' 	=> esc_html__( 'Line Height', 'woovina-portfolio' ),
				'spacing' 		=> esc_html__( 'Letter Spacing', 'woovina-portfolio' ),
			)
		);
	}

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'name'  => $this->get_field_name( $setting_key ),
				'value' => $this->get_value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();

			elseif ( 'transform' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_text_transform_choices();
		}

	}

	/**
	 * Returns the available font families.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		$fonts 	= array( esc_html__( 'Default', 'woovina-portfolio' ) );
		$id 	= '';

		// Add custom fonts from child themes
		if ( function_exists( 'woovina_add_custom_fonts' ) ) {
			$get_fonts = woovina_add_custom_fonts();
			if ( $get_fonts && is_array( $get_fonts ) ) {
				foreach ( $get_fonts as $font ) {
					$fonts[$font] = $font;
				}
			}
		}

		// Get Standard font options
		if ( $std_fonts = woovina_standard_fonts() ) {
			foreach ( $std_fonts as $font ) {
				$fonts[$font] = $font;
			}
		}

		// Google font options
		if ( $google_fonts = woovina_google_fonts_array() ) {
			foreach ( $google_fonts as $font ) {
				$fonts[$font] = $font;
			}
		}

		return $fonts;

	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' 		=> esc_html__( 'Default', 'woovina-portfolio' ),
			'100' 	=> esc_html__( 'Thin: 100', 'woovina-portfolio' ),
			'200' 	=> esc_html__( 'Light: 200', 'woovina-portfolio' ),
			'300' 	=> esc_html__( 'Book: 300', 'woovina-portfolio' ),
			'400' 	=> esc_html__( 'Normal: 400', 'woovina-portfolio' ),
			'500' 	=> esc_html__( 'Medium: 500', 'woovina-portfolio' ),
			'600' 	=> esc_html__( 'Semibold: 600', 'woovina-portfolio' ),
			'700' 	=> esc_html__( 'Bold: 700', 'woovina-portfolio' ),
			'800' 	=> esc_html__( 'Extra Bold: 800', 'woovina-portfolio' ),
			'900' 	=> esc_html__( 'Black: 900', 'woovina-portfolio' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			''  		=> esc_html__( 'Default', 'woovina-portfolio' ),
			'normal'  	=> esc_html__( 'Normal', 'woovina-portfolio' ),
			'italic'  	=> esc_html__( 'Italic', 'woovina-portfolio' ),
		);
	}

	/**
	 * Returns the available text transform.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_text_transform_choices() {

		return array(
			''  			=> esc_html__( 'Default', 'woovina-portfolio' ),
			'capitalize'  	=> esc_html__( 'Capitalize', 'woovina-portfolio' ),
			'lowercase'  	=> esc_html__( 'Lowercase', 'woovina-portfolio' ),
			'uppercase' 	=> esc_html__( 'Uppercase', 'woovina-portfolio' )
		);
	}

}
