<?php
/**
* Shortcode Header Search
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Header_Login extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_header_login';
		$this->title       = esc_html__( 'Header login', 'infinite-addons' );
		$this->description = esc_html__( 'Header ajax login form', 'infinite-addons' );
		$this->icon        = 'fa fa-user';
		$this->category    = esc_html__( 'Header', 'infinite-addons' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array_merge(
			
			rella_get_icon_params( false, '', 'all', array( 'color', 'align', 'size', 'margin-left', 'margin-right' ) ), 
			
			array(

				array(
					'type'       => 'dropdown',
					'param_name' => 'trigger_size',
					'heading'    => esc_html__( 'Trigger Size', 'infinite-addons' ),
					'value'      => array(
						esc_html__( 'Medium', 'infinite-addons' ) => 'md',
						esc_html__( 'Small', 'infinite-addons' )  => 'sm',
						esc_html__( 'Large', 'infinite-addons' )  => 'lg',
					)
				),

				array(
					'type'        => 'colorpicker',
					'param_name'  => 'primary_color',
					'heading'     => esc_html__( 'Primary Color', 'infinite-addons' )
				)
		) );

		$this->add_extras();
	}

	public function generate_css() {

		extract($this->atts);

		$elements = array();
		$out = '';

		$elements['.header-module.module-search-form .module-trigger']['color'] = $primary_color;
		$this->dynamic_css_parser( '', $elements );
	}
}
new RA_Header_Login;