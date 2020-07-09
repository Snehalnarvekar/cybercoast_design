<?php
/**
 * Themerella Theme Framework
 * The Rella_Edd_License initiate the theme engine
 */

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

class Rella_Edd_License extends Rella_Base {
	
	/**
	 * [$store_url description]
	 * @var string
	 */
	public $store_url = 'http://themerella.com';
	
	/**
	 * [$purchase_url description]
	 * @var string
	 */
	public $purchase_url = 'http://themerella.com/join';
	
	/**
	 * [$item_name description]
	 * @var string
	 */
	public $item_name = 'Boo Single License';
	
	/**
	 * [$license_key description]
	 * @var string
	 */
	public $license_key = null;
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	function __construct() {

		$this->add_action( 'after_setup_theme', 'init_hooks' );
		$this->add_action( 'admin_enqueue_scripts', 'enqueue', 99 );

		$this->add_action( 'wp_ajax_add_license_key', 'add_license_key' );
		$this->add_action( 'wp_ajax_nopriv_add_license_key', 'add_license_key' );
		
		$this->add_action( 'wp_ajax_activate_license_key', 'activate_license_key' );
		$this->add_action( 'wp_ajax_nopriv_activate_license_key', 'activate_license_key' );
		
		$this->add_action( 'wp_ajax_deactivate_license_key', 'deactivate_license_key' );
		$this->add_action( 'wp_ajax_nopriv_deactivate_license_key', 'deactivate_license_key' );

	}

	/**
	 * [init_hooks description]
	 * @method init_hooks
	 * @return [type]     [description]
	 */
	public function init_hooks() {

        if ( 'valid' !== get_option( 'rella-license-status' ) ) {

            if ( ( ! isset( $_GET['page'] ) || 'rella' != $_GET['page'] ) ) {
                add_action( 'admin_notices', function() {
                    echo '<div class="error"><p>' .
                         sprintf( __( 'The %s license needs to be activated. %sActivate Now%s', 'boo' ), 'Boo', '<a href="' . admin_url( 'admin.php?page=rella') . '">' , '</a>' ) . '</p></div>';
                } );
            } else {

                add_action( 'admin_notices', function() {
                    echo '<div class="notice"><p>' .
                         sprintf( __( 'License key invalid. Need a license? %sPurchase Now%s', 'boo' ), '<a target="_blank" href="' . esc_url( $this->purchase_url ) . '">', '</a>' ) .
                         '</p></div>';
                } );

            }
        }
	}

	public function enqueue() {

		wp_enqueue_script( 'rella-license-key-form', rella()->load_assets( 'js/rella-edd-license.js' ), array( 'jquery' ), false, true );
		wp_localize_script( 'rella-license-key-form', 'ajax_rella_license_key_form_object', array(
			'ajaxurl'        => esc_url( admin_url( 'admin-ajax.php' ) ),
		) );
	}

    function sanitize_license( $new ) {

		$old = get_option( 'rella-license-key' );

		if ( $old && $old != $new ) {
			delete_option( 'rella-license-status' ); // new license has been entered, so must reactivate
		}

		return $new;
    }


	/**
	 * [add_license_key description]
	 * @method add_license_key
	 * @return [type]     [description]
	 */
	 public function add_license_key() {

		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'rella-license-key', 'security' );
		
		$license_key = sanitize_text_field( $_POST['rella_license_key'] );

		$store_url = $this->store_url;
		$license_data = '';
			
		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license_key,
			'item_name'  => $this->item_name,
			'url' => home_url()
		);

		$response = wp_remote_post( $store_url, array( 'body' => $api_params, 'timeout' => 15, 'sslverify' => false ) );
		if ( is_wp_error( $response ) ) {
			return false;
		}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		if( 'invalid' === $license_data->license ) {
			echo '<h2>'.esc_html__( 'The license key is not valid', 'boo' ) . '</h2>';
			wp_die();
		}
		elseif( 'inactive' === $license_data->license ) {
			echo '<h2>'.esc_html__( 'The license key is not active, please activate it', 'boo' ) . '</h2>';
		}

		update_option( 'rella-license-key', $license_key );
		echo '<h2>' . esc_html__( 'License key is saved', 'boo' )  . '</h2>';
		wp_die();

	}
	
	/**
	 * [activate_license_key description]
	 * @method activate_license_key
	 * @return [type]     [description]
	 */
	public function activate_license_key() {
		 
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'rella-active-license-key', 'security' );
		
		$license_key = trim( get_option( 'rella-license-key' ) );
		
		$store_url = $this->store_url;
		$license_data = '';

        // data to send in our API request
        $api_params = array(
            'edd_action'=> 'activate_license',
            'license' 	=> $license_key,
            'item_name' => $this->item_name,
            'url'       => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post( $store_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );	 

        // make sure the response came back okay
        if ( is_wp_error( $response ) ) {
			echo '<h2>' . esc_html__( 'There was an error activating the license, please verify your license is correct and try again or contact support.', 'boo' ) . '</h2>';
            wp_die();
        }
        
        // decode the license data
        $license_data = json_decode( wp_remote_retrieve_body( $response ) );

        // $license_data->license will be either "valid" or "invalid"
        update_option( 'rella-license-status', $license_data->license );
        
        if ( 'valid' != $license_data->license ) {
			echo '<h2>' . esc_html__( 'There was an error activating the license, please verify your license is correct and try again or contact support.', 'boo' ) . '</h2>';
            wp_die();
        }
 
	}
	
	/**
	 * [activate_license_key description]
	 * @method activate_license_key
	 * @return [type]     [description]
	 */
	public function deactivate_license_key() {
		 
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'rella-deactive-license-key', 'security' );
		
		$license_key = trim( get_option( 'rella-license-key' ) );
		
		$store_url = $this->store_url;
		$license_data = '';

        // data to send in our API request
        $api_params = array(
            'edd_action'=> 'deactivate_license',
            'license' 	=> $license_key,
            'item_name' => $this->item_name,
            'url'       => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post( $store_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );	 

        // make sure the response came back okay
        if ( is_wp_error( $response ) ) {
			echo '<h2>' . esc_html__( 'There was an error deactivating the license, please verify your license is correct and try again or contact support.', 'boo' ) . '</h2>';
            wp_die();
        }
        
        // decode the license data
        $license_data = json_decode( wp_remote_retrieve_body( $response ) );

        // $license_data->license will be either "deactivated" or "failed"
        if ( 'deactivated' == $license_data->license ) {
			echo '<h2>' . esc_html__( 'License deactivated', 'boo' ) . '</h2>';
	        delete_option( 'rella-license-status' );
	        wp_die();
        } else {
			echo '<h2>' . esc_html__( 'Unable to deactivate license, please try again or contact support.', 'edd-sample' ) . '</h2>';
	        wp_die();
        }
 
	}	
	
	
	/**
	 * [get_license_key description]
	 * @method get_license_key
	 * @return [type]     [description]
	 */
	private function get_license_key() {

		$this->license_key = rella_helper()->get_option( 'rella-license-key' );

	}
	
    function check_license() {
        if ( get_transient( 'rella_license_status_checking' ) )
            return;

        $license = trim( get_option( 'rella-license-key' ) );

        $api_params = array(
            'edd_action' => 'check_license',
            'license' => $license,
            'item_name' => urlencode( $this->get_var( 'item_name' ) ),
            'url'       => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post(
            $this->store_url,
            array(
                'timeout' => 15,
                'sslverify' => false,
                'body' => $api_params
            )
        );

        if ( is_wp_error( $response ) )
            return false;

        $license_data = json_decode(
            wp_remote_retrieve_body( $response )
        );

        if ( $license_data->license != 'valid' ) {
            delete_option( 'rella-license-status' );
        }

        // Set to check again in 12 hours
        set_transient(
			'rella_license_status_checking',
            $license_data,
            ( 60 * 60 * 12 )
        );
    }	

}
new Rella_Edd_License;