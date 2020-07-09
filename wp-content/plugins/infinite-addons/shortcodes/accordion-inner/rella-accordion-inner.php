<?php
/**
* Shortcode Accordion
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Inner_Accordions extends RA_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ra_inner_accordion';
		$this->title         = esc_html__( 'Inner Accordion', 'infinite-addons' );
		$this->icon          = 'fa fa-plus-circle';
		$this->description   = esc_html__( 'Create an inner accordion.', 'infinite-addons' );
		$this->styles        = array( 'rella-sc-accordion' );

		parent::__construct();
	}

	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$this->params = array(
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'active_tab',
				'heading'     => esc_html__( 'Active tab', 'infinite-addons' ),
			),			
			array(
				'type'       => 'param_group',
				'param_name' => 'identities',
				'heading'    => esc_html__( 'Sections', 'infinite-addons' ),
				'params'     => array(

					array(
						'type'        => 'textfield',
						'param_name'  => 'title',
						'heading'     => esc_html__( 'Title', 'infinite-addons' ),
						'admin_label' => true,
					),
					array(
						'type'        => 'textarea',
						'param_name'  => 'text',
						'heading'     => esc_html__( 'Content', 'infinite-addons' ),
						'description' => esc_html__(  'Add accordion content', 'infinite-addons' ),
					),
					array(
						'type' => 'el_id',
						'param_name' => 'tab_id',
						'settings' => array(
							'auto_generate' => true,
						),
						'heading' => esc_html__( 'Section ID', 'infinite-addons' ),
						'description' => esc_html__( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'infinite-addons' ),
					),
				)
			),
		);
		$this->add_extras();
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Inner_Accordions;