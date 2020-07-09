<?php
/**
* Shortcode Accordion
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Accordion_Tab extends RA_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'vc_accordion_tab';
		$this->title        = esc_html__( 'Accordion Section', 'infinite-addons' );
		$this->icon         = 'icon-wpb-ui-tta-section';
		$this->styles        = array( 'rella-sc-accordion' );
		$this->description  = esc_html__( 'Create an accordion.', 'infinite-addons' );
		$this->is_container = true;
		$this->js_view      = 'VcAccordionTabView';
		$this->allowed_container_element = 'vc_row';
		$this->deprecated   = '';
		$this->as_child     = array( 'only' => 'vc_accordion' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array( 'id' => 'title' ),
			
			array(
				'type' => 'el_id',
				'param_name' => 'tab_id',
				'settings' => array(
					'auto_generate' => true,
				),
				'heading' => esc_html__( 'Section ID', 'infinite-addons' ),
				'description' => esc_html__( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'infinite-addons' ),
			),
			// CSS
			array(
				'type'        => 'textfield',
				'param_name'  => 'el_class',
				'heading'     => esc_html__( 'Extra class name', 'infinite-addons' ),
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'infinite-addons' ),
				'group'       => esc_html__( 'Extras', 'infinite-addons' )
			),
			
			array(
				'type'       => 'param_group',
				'param_name' => 'additional',
				'heading'    => esc_html__( 'Additional Info', 'infinite-addons' ),
				'description' => esc_html__( 'Additional info, works only with Events Accordion style', 'infinite-addons' ),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'add_title',
						'heading'     => esc_html__( 'Title', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'add_info',
						'heading'     => esc_html__( 'Info', 'infinite-addons' ),
						'description' => esc_html__(  'Add info', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					)
				)
			),

		);

		$this->add_extras();
	}

	public function render( $atts, $content = '' ) {

		global $rella_accordion_tabs;

		$atts = vc_map_get_attributes( $this->slug, $atts );
		$atts = $this->before_output( $atts, $content );
		$atts['_id'] = $atts['tab_id'];
		$atts['content'] = ra_helper()->do_the_content( $content );

		$rella_accordion_tabs[]  = $atts;
	}
}
new RA_Accordion_Tab;