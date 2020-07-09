<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package Boo Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

$theme = wp_get_theme( get_template() );

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(
	
	// Config settings
	$config = array(
		'remote_api_url' => 'https://themerella.com', // Site where EDD is hosted
		'item_name'      => 'Boo Single License', // Name of theme
		'item_id'        => 8995, // ID of theme, do not change it or the heaven will fall
		'theme_slug'     => get_template(), // Theme slug
		'version'        => $theme->get( 'Version' ), // The current version of this theme
		'author'         => 'ThemeRella Team', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license'             => esc_html__( 'Theme License', 'boo' ),
		'enter-key'                 => esc_html__( 'Enter your theme license key.', 'boo' ),
		'license-key'               => esc_html__( 'License Key', 'boo' ),
		'license-action'            => esc_html__( 'License Action', 'boo' ),
		'deactivate-license'        => esc_html__( 'Deactivate License', 'boo' ),
		'activate-license'          => esc_html__( 'Activate License', 'boo' ),
		'status-unknown'            => esc_html__( 'License status is unknown.', 'boo' ),
		'renew'                     => esc_html__( 'Renew?', 'boo' ),
		'unlimited'                 => esc_html__( 'unlimited', 'boo' ),
		'license-key-is-active'     => esc_html__( 'License key is active.', 'boo' ),
		'expires%s'                 => esc_html__( 'Expires %s.', 'boo' ),
		'%1$s/%2$-sites'            => esc_html__( 'You have %1$s / %2$s sites activated.', 'boo' ),
		'license-key-expired-%s'    => esc_html__( 'License key expired %s.', 'boo' ),
		'license-key-expired'       => esc_html__( 'License key has expired.', 'boo' ),
		'license-keys-do-not-match' => esc_html__( 'License keys do not match.', 'boo' ),
		'license-is-inactive'       => esc_html__( 'License is inactive.', 'boo' ),
		'license-key-is-disabled'   => esc_html__( 'License key is disabled.', 'boo' ),
		'site-is-inactive'          => esc_html__( 'Site is inactive.', 'boo' ),
		'license-status-unknown'    => esc_html__( 'License status is unknown.', 'boo' ),
		'update-notice'             => esc_html__( 'Updating this theme will lose any customizations you have made. \'Cancel\' to stop, \'OK\' to update.', 'boo' ),
		'update-available'          => wp_kses_post( __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'boo' ) )
	)

);