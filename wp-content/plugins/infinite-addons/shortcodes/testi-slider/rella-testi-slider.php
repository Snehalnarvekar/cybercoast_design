<?php
/**
* Shortcode Testimonial Slider
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Testi_Slider extends RA_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ra_testi_slider';
		$this->title         = esc_html__( 'Testimonial Slider', 'infinite-addons' );
		$this->icon          = 'fa fa-comments-o';
		$this->description   = esc_html__( 'Create Testimonial Slide.', 'infinite-addons' );
		$this->is_container  = true;
		$this->show_settings_on_create = false;
		$this->styles        = array( 'rella-sc-testimonial-slider' );
		$this->scripts       = array( 'TweenMax', 'animation-gsap', 'jquery-ui' );
		$this->as_parent     = array ( 'only' => 'ra_testi' );

		parent::__construct();
	}

	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$this->params = array(
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'bg_type',
				'heading'     => esc_html__( 'Background Type', 'infinite-addons' ),
				'description' => esc_html__( 'Select a type of the background for the testimonial item', 'infinite-addosn' ),
				'value'       => array(
					esc_html__( 'Default', 'infinite-addons' )  => 'default',
					esc_html__( 'Gradient', 'infinite-addons' ) => 'gradient',
				),
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			),
			array(
				'type'        => 'colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Background Color', 'infinite-addons' ),
				'description' => esc_html__( 'Pick backround color for the background of the testimonial item', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value'   => 'default'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'gradient',
				'param_name'  => 'bg_gradient',
				'heading'     => esc_html__( 'Background Gradient', 'infinite-addons' ),
				'description' => esc_html__( 'Background gradient for the background of the testimonial item', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value' => 'gradient'
				),
			),
			
		);
		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		global $rella_testi;

		$rella_testi = array();

		//parse vc_accordion_tab shortcode
		do_shortcode( $content );

		$atts['items'] = $rella_testi;

		return $atts;
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		if( ! empty( $bg_color ) ) {
			$elements[ rella_implode( '%1$s.testimonial-slider .testimonial-slider-item' ) ]['background-color'] = $bg_color;
		}
		if( ! empty( $bg_gradient ) && 'gradient' === $bg_type ) {
			$bg = rella_parse_gradient( $bg_gradient );
			$elements[ rella_implode( '%1$s.testimonial-slider .testimonial-slider-item' ) ]['background'] = $bg['background-image'];
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new RA_Testi_Slider;
class WPBakeryShortCode_RA_Testi_Slider extends RA_ShortcodeContainer {}
// Testimonial Item
include_once 'rella-testi.php';