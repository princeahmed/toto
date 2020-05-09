<?php

defined( 'ABSPATH' ) || exit;

/**
 * Class WP_Plugin_Boilerplate_Install
 * Do the activate stuffs
 */
class Toto_Install {

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
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}toto_notification_statistics(
         	id bigint(20) NOT NULL AUTO_INCREMENT,
         	unique_id varchar (32) NOT NULL DEFAULT '',
			notification_id bigint(20) NOT NULL,
			`count` bigint(20) NOT NULL DEFAULT '1',
			ip varchar(128)  NOT NULL DEFAULT '',
			`type` varchar(32)  NOT NULL DEFAULT '',
			url text  NOT NULL,
			`data` text NULL,
			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at DATETIME NOT NULL,
			PRIMARY KEY  (id),
			UNIQUE KEY `unique_id` (`unique_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;",
		];

		foreach ( $tables as $table ) {
			dbDelta( $table );
		}
	}

}