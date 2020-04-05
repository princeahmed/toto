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

		//Create Tables
		self::create_tables();
	}

	/**
	 * Creat tables
	 * @since 1.0.0
	 */
	public static function create_tables() {
		global $wpdb;
		$wpdb->hide_errors();
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$tables = [
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}toto_notification_data(
         	id bigint(20) NOT NULL AUTO_INCREMENT,
			notification_id bigint(20) NOT NULL,
			data longtext DEFAULT NULL,
			PRIMARY KEY  (id),
			key notification_id (notification_id),
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;",
		];

		foreach ( $tables as $table ) {
			dbDelta( $table );
		}
	}

}