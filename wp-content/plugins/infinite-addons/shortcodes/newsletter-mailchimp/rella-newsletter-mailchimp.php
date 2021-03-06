<?php
/**
* Shortcode Newsletter
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Newsletter_Mailchimp extends RA_Shortcode {

	/**
	 * [$post_type description]
	 * @var string
	 */
	public $list_id = '';

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_newsletter_mailchimp';
		$this->title       = esc_html__( 'Mailchimp Newsletter', 'infinite-addons' );
		$this->description = esc_html__( 'Create a mailchimp newsletter.', 'infinite-addons' );
		$this->icon        = 'fa fa-envelope';
		$this->scripts     = 'rella-mailchimp-form';

		add_action( 'wp_ajax_add_mailchimp_user', array( $this, 'add_user_to_the_list' ) );
		add_action( 'wp_ajax_nopriv_add_mailchimp_user', array( $this, 'add_user_to_the_list' ) );

		parent::__construct();

	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/newsletter/';

		$general = array(

			array(
				'type'        => 'dropdown',
				'param_name'  => 'list_id',
				'heading'     => esc_html__( 'List ID', 'infinite-addons' ),
				'description' => esc_html__( 'Select the list from mailchimp to add emails. The API Key of the Mailchimp should be added in Theme Options', 'infinite-addons' ),
				'value'       => array_merge_recursive( array( 'Select' => '' ) , array_flip( $this->get_mailchimp_lists() ) ),
				'admin_label' => true,
			),

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Input Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'bordered',
						'label' => esc_html__( 'Bordered', 'infinite-addons' ),
						'image' => $url . 'input-bordered.png'
					),

					array(
						'label' => esc_html__( 'Solid', 'infinite-addons' ),
						'value' => 'solid',
						'image' => $url . 'input-solid.png'
					),

					array(
						'label' => esc_html__( 'Underlined', 'infinite-addons' ),
						'value' => 'underlined',
						'image' => $url . 'input-underlined.png'
					),
				),
				'save_always' => true,
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'placeholder_text',
				'heading'     => esc_html__( 'Placehoder', 'infinite-addons' ),
				'description' => esc_html__( 'Add placeholder text', 'infinite-addons' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_size',
				'heading'    => esc_html__( 'Size', 'infinite-addons' ),
				'description' => esc_html__( 'Select input border size', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' ) => 'subscribe-form--size-md',
					esc_html__( 'xSmall', 'infinite-addons' )  => 'subscribe-form--size-xs',
					esc_html__( 'Small', 'infinite-addons' )  => 'subscribe-form--size-sm',
					esc_html__( 'Medium', 'infinite-addons' )  => 'subscribe-form--size-md',
					esc_html__( 'Large', 'infinite-addons' )   => 'subscribe-form--size-lg',
					esc_html__( 'xLarge', 'infinite-addons' )   => 'subscribe-form--size-xl',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_radius',
				'heading'    => esc_html__( 'Border radius', 'infinite-addons' ),
				'description' => esc_html__( 'Select input border radius', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Sharp', 'infinite-addons' )    => 'subscribe-form--sharp',
					esc_html__( 'Semi Round', 'infinite-addons' ) => 'subscribe-form--semi-round',
					esc_html__( 'Round', 'infinite-addons' )      => 'subscribe-form--round',
					esc_html__( 'Circle', 'infinite-addons' )     => 'subscribe-form--circle',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_border',
				'heading'    => esc_html__( 'Border thickness', 'infinite-addons' ),
				'description' => esc_html__( 'Select input border thickness', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Thin', 'infinite-addons' ) => 'subscribe-form--border-thin',
					esc_html__( 'Thick', 'infinite-addons' )   => 'subscribe-form--border-thick',
					esc_html__( 'Thicker', 'infinite-addons' ) => 'subscribe-form--border-thicker',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_shadow',
				'heading'    => esc_html__( 'Other', 'infinite-addons' ),
				'description' => esc_html__( 'Select input other styling', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )      => '',
					esc_html__( 'Shadow', 'infinite-addons' )       => 'subscribe-form--input-shadow',
					esc_html__( 'Inner Shadow', 'infinite-addons' ) => 'subscribe-form--input-inner-shadow',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

		);

		$button = array(

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_buttons',
				'heading'    => esc_html__( 'Submit Button', 'infinite-addons' ),
			),

			array(
				'type'       => 'select_preview',
				'param_name' => 'btn_style',
				'heading'    => esc_html__( 'Submit Button Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'solid',
						'label' => esc_html__( 'Solid', 'infinite-addons' ),
						'image' => $url . 'btn-solid.png'
					),

					array(
						'label' => esc_html__( 'Bordered', 'infinite-addons' ),
						'value' => 'bordered',
						'image' => $url . 'btn-bordered.png'
					),

					array(
						'label' => esc_html__( 'Underlined', 'infinite-addons' ),
						'value' => 'underlined',
						'image' => $url . 'btn-underlined.png'
					),

					array(
						'label' => esc_html__( 'Naked', 'infinite-addons' ),
						'value' => 'naked',
						'image' => $url . 'btn-naked.png'
					),	
				),
				'save_always' => true,
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_state',
				'heading'    => esc_html( 'Button state', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Display', 'infinite-addons' ) => 'subscribe-form--button-show',
					esc_html__( 'Hidden', 'infinite-addons' )  => 'subscribe-form--button-hidden',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_display',
				'heading'    => esc_html__( 'Button display', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Button label', 'infinite-addons' )          => 'label',
					esc_html__( 'Icon', 'infinite-addons' )                  => 'icon',
					esc_html__( 'Button label and icon', 'infinite-addons' ) => 'label_icon',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'btn_label',
				'heading'     => esc_html__( 'Button label', 'infinite-addons' ),
				'description' => esc_html__( 'Add button label', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'btn_display',
					'value' => array( 'label', 'label_icon' )
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_position',
				'heading'    => esc_html__( 'Button Position', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )  => '',
					esc_html__( 'In input', 'infinite-addons' ) => 'subscribe-form--button-inside button-shrinked',
					esc_html__( 'Near input' )             => 'subscribe-form--button-inline',
					esc_html__( 'Under input' )            => 'subscribe-form--button-block',
				),
				'dependency' => array(
					'element' => 'btn_state',
					'value_not_equal_to' => 'subscribe-minimal',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

		);

		$icon = rella_get_icon_params( $add_icon = false, $group = '', $fonts = 'all',  $remove = array( 'color' ), $prefix = 'i_', array( 'element' => 'btn_display', 'value_not_equal_to' => 'label' ) );

		$design = array(

			//design options
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_inputs',
				'heading'    => esc_html__( 'Inputs', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'only_solid' => true,
				'param_name' => 'txt_color',
				'heading'    => esc_html__( 'Text Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'bg_color',
				'heading'    => esc_html__( 'Background Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'brd_color',
				'only_solid' => true,
				'heading'    => esc_html__( 'Border Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_inputs_f',
				'heading'    => esc_html__( 'Inputs Focus', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'only_solid' => true,
				'param_name' => 'txt_f_color',
				'heading'    => esc_html__( 'Text Color', '_s' ),
				'group'      => esc_html__( 'Design Options', '_s' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'bg_f_color',
				'heading'    => esc_html__( 'Background Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'only_solid' => true,
				'param_name' => 'brd_f_color',
				'heading'    => esc_html__( 'Border Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_buttons',
				'heading'    => esc_html__( 'Submit Button', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'only_solid' => true, 
				'param_name' => 'btn_txt_color',
				'heading'    => esc_html__( 'Label color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'btn_bg_color',
				'heading'    => esc_html__( 'Background color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'only_solid' => true,
				'param_name' => 'btn_brd_color',
				'heading'    => esc_html__( 'Border color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_buttons_hover',
				'heading'    => esc_html__( 'Hover Submit Button', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'only_solid' => true,
				'param_name' => 'hover_btn_txt_color',
				'heading'    => esc_html__( 'Label color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'hover_btn_bg_color',
				'heading'    => esc_html__( 'Background color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'only_solid' => true,
				'param_name' => 'hover_btn_brd_color',
				'heading'    => esc_html__( 'Border color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

		);

		$this->params = array_merge( $general, $button, $icon, $design );

		$this->add_extras();

	}
	
	public function get_list_id() {
		
		if( !empty( $this->atts['list_id'] ) ) {
			return;
		}
		
		$this->list_id = $this->atts['list_id'];
		
		return $this->list_id;
		
	}
	
	/**
	 * Get MailChimp Lists IDs
	 * @return array
	 */
	public function get_mailchimp_lists() {
		
		if( !class_exists( 'Rella_MailChimp' ) ) {
			return array();
		}
		$api_key = rella_helper()->get_theme_option( 'mailchimp-api-key' );
		if( empty( $api_key ) ) {
			return array();
		}

		$MailChimp = new Rella_MailChimp( $api_key );
		$lists = $MailChimp->get( 'lists' );
		$items = array();
		if ( is_array( $lists ) && !is_wp_error( $lists ) ) {
			foreach ( $lists as $list ) {
				if( is_array( $list ) ) {
					foreach( $list as $l ) {
						if( isset( $l['id'] ) && isset( $l['name'] ) ) {
							$items[ $l['id'] ] = $l['name'];	
						}
					}
				}
			}
		}

		return $items;
	}
	
	protected function get_class( $style ) {

		$hash = array(
			'underlined' => 'subscribe-form--input-underlined',
			'solid'      => 'subscribe-form--input-solid',
			'bordered'   => 'subscribe-form--input-bordered',
		);

		return $hash[ $style ];
	}

	protected function get_btn_class( $style ) {

		$hash = array(
			'solid'      => 'subscribe-form--button-solid',
			'bordered'   => 'subscribe-form--button-bordered',
			'underlined' => 'subscribe-form--button-underlined',
			'naked'   => 'subscribe-form--button-naked',
		);

		return $hash[ $style ];
	}
	
	protected function get_submit_button(){
		
		$label = !empty( $this->atts['btn_label'] ) ? '<span class="submit-text">' . esc_html( $this->atts['btn_label'] ) . '<span>' : '';
		$icon  = ' <span class="submit-icon"><i class="fa fa-long-arrow-right"></i></span>';
		
		$btn_display = $this->atts['btn_display'];
		if( 'label' === $btn_display ) {
			$icon = '';	
		}
		elseif( 'icon' === $btn_display ) {
			$label = '';	
			$icon  = '<span class="submit-icon"><i class="fa fa-long-arrow-right"></i></span>';
		}

		$label_html = $label . $icon;

		printf( '<button type="submit" class="ra_sf_submit">%s <span class="spiner" style="display:none;">Spiner</span></button>', $label_html );
		
	}
	
	function add_user_to_the_list() {
		
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ra-mailchimp-form', 'security', false );

		if( !class_exists( 'Rella_MailChimp' ) ) {
			return;
		}
		
		$api_key = rella_helper()->get_theme_option( 'mailchimp-api-key' );
		if( empty( $api_key ) ) {
			return;
		}
		$MailChimp = new Rella_MailChimp( $api_key );
		
		$list_id = $_POST['list_id'];
		$email  = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
		$fname  = isset( $_POST['fname'] ) ? sanitize_text_field( $_POST['fname'] ) : '';
		$lname  = isset( $_POST['lname'] ) ? sanitize_text_field( $_POST['lname'] ) : '';

		$result = $MailChimp->post( "lists/$list_id/members", [
						'email_address' => $email,
						'merge_fields'  => [ 'FNAME'=> $fname, 'LNAME' => $lname ],
						'status'        => 'subscribed',
					] );
		if ( $MailChimp->success() ) {
			// Success message
			echo '<h4>' . esc_html__( 'Thank you, you have been added to our mailing list.', 'infinite-addons' ) . '</h4>';
		}
		else {
			// Display error
			echo $MailChimp->getLastError();
		}
		wp_die(); // Important
	}
	
	protected function generate_css() {

		extract( $this->atts );
		$elements = array();
		$id = '.' .$this->get_id();

		$elements[rella_implode( '%1$s.subscribe-form input[type="email"]' )] = array(
			'background'   => $bg_color,
			'color'        => $txt_color,
			'border-color' => $brd_color
		);
		$elements[rella_implode( '%1$s.subscribe-form input[type="email"]:focus' )] = array(
			'background'   => $bg_f_color,
			'color'        => $txt_f_color,
			'border-color' => $brd_f_color
		);
		$elements[rella_implode( '%1$s.subscribe-form button.ra_sf_submit' )] = array(
			'background'   => $btn_bg_color,
			'color'        => $btn_txt_color,
			'border-color' => $btn_brd_color
		);
		$elements[rella_implode( '%1$s.subscribe-form buttont.ra_sf_submit:hover' )] = array(
			'background'   => $hover_btn_bg_color,
			'color'        => $hover_btn_txt_color,
			'border-color' => $hover_btn_brd_color
		);

		$this->dynamic_css_parser( $id, $elements );
	}
	

}

new RA_Newsletter_Mailchimp;