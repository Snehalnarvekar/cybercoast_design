<?php
/**
* Shortcode Countdown
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Countdown extends RA_Shortcode {

	/**
	 * [$days description]
	 * @var array
	 */
	private $days = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_countdown';
		$this->title       = esc_html__( 'Countdown', 'infinite-addons' );
		$this->icon        = 'fa fa-clock-o';
		$this->description = esc_html__( 'Add countdown timer', 'infinite-addons' );
		$this->scripts     = array( 'jquery-countdown' );
		$this->styles      = array( 'rella-sc-countdown' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'month',
				'heading'    => esc_html__( 'Month', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'January', 'infinite-addons' )   => '1',
					esc_html__( 'February', 'infinite-addons' )  => '2',
					esc_html__( 'March', 'infinite-addons' )     => '3',
					esc_html__( 'April', 'infinite-addons' )     => '4',
					esc_html__( 'May', 'infinite-addons' )       => '5',
					esc_html__( 'June', 'infinite-addons' )      => '6',
					esc_html__( 'July', 'infinite-addons' )      => '7',
					esc_html__( 'August', 'infinite-addons' )    => '8',
					esc_html__( 'September', 'infinite-addons' ) => '9',
					esc_html__( 'Octomber', 'infinite-addons' )  => '10',
					esc_html__( 'November', 'infinite-addons' )  => '11',
					esc_html__( 'December', 'infinite-addons' )  => '12',
				),
				'admin_label' => true,
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'day',
				'heading'     => esc_html__( 'Day', 'infinite-addons' ),
				'value'       => $this->days,
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'year',
				'heading'     => esc_html__( 'Year', 'infinite-addons' ),
				'std' 		  => '2017',
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4'
			),
			
			//Labels
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_label',
				'heading'    => esc_html__( 'Labels', 'infinite-addons' ),
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'day_label',
				'heading'     => esc_html__( 'Days', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-3'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'hours_label',
				'heading'     => esc_html__( 'Hours', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-3'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'min_label',
				'heading'     => esc_html__( 'Minutes', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-3'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'sec_label',
				'heading'     => esc_html__( 'Seconds', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-3'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'timezone',
				'heading'     => esc_html__( 'Set Timezone', 'infinite-addons' ),
				'admin_label' => true,
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'infinite-addons' ),
				'description' => esc_html__( 'Check to use custom font for title', 'infinite-addons' ),
			),
			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'infinite-addons' ),
				'description' => esc_html__( 'Example: 20px', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'infinite-addons' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'infinite-addons' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'infinite-addons' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'infinite-addons' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'infinite-addons' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'infinite-addons' ),
				'group' => esc_html__( 'Typo', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'text_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'infinite-addons' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'infinite-addons' ),
					),
				),
				'group' => esc_html__( 'Typo', 'infinite-addons' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'primary_color',
				'heading'    => esc_html__( 'Primary Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			)

		);

		$this->add_extras();
	}

	protected function get_plugin_opts() {

		$y = ! empty( $this->atts['year'] ) ? $this->atts['year'] : '2017';
		$m = $this->atts['month'];
		$d = $this->atts['day'];

		$opts = array(
			'until' => "$y-$m-$d"
		);
		
		if( ! empty( $this->atts['day_label'] ) ) {
			$opts['daysLabel'] = esc_attr( $this->atts['day_label'] );
		}
		
		if( ! empty( $this->atts['hours_label'] ) ) {
			$opts['hoursLabel'] = esc_attr( $this->atts['hours_label'] );
		}
		
		if( ! empty( $this->atts['min_label'] ) ) {
			$opts['minutesLabel'] = esc_attr( $this->atts['min_label'] );
		}
		
		if( ! empty( $this->atts['sec_label'] ) ) {
			$opts['secondsLabel'] = esc_attr( $this->atts['sec_label'] );
		}
		
		if( ! empty( $this->atts['timezone'] ) ) {
			$opts['timezone'] = esc_attr( $this->atts['timezone'] );
		}

		echo " data-plugin-options='" . wp_json_encode( $opts ) ."'";
	}

	protected function generate_css() {

		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}


		extract( $this->atts );
		$elements = array();
		$id = '.' .$this->get_id();
		$text_font_inline_style = '';
		
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}

		$elements[ rella_implode( '%1$s' ) ] = array( $text_font_inline_style );
		$elements[ rella_implode( '%1$s' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ rella_implode( '%1$s' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ rella_implode( '%1$s' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ rella_implode( '%1$s' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ rella_implode( '%1$s .countdown-amount' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';

		if( !empty( $this->atts['primary_color'] ) ) {
			$elements[ rella_implode( '%1$s' ) ]['color'] = $primary_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new RA_Countdown;