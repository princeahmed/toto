<?php

defined( 'ABSPATH' ) || exit;

/**
 * Class WP_Plugin_Boilerplate_Install
 * Do the activate stuffs
 */
class Toto_Install {

	public static function init() {
		register_activation_hook( TOTO_FILE, [ __CLASS__, 'activate' ] );
		//register_deactivation_hook( TOTO_FILE, [ __CLASS__, 'deactivate' ] );
	}

	public static function activate() {
		$key = sanitize_key( toto()->name );
		update_option( $key . '_version', toto()->version );
		update_option( 'toto_flush_rewrite_rules', true );
		update_option( 'toto_install_date', current_time( 'timestamp' ) );
	}

}