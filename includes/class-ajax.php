<?php

defined( 'ABSPATH' ) || exit();

class Toto_Ajax {

	public function __construct() {
		add_action( 'wp_ajax_toto_save_data', [ $this, 'save_data' ] );
		add_action( 'wp_ajax_nopriv_toto_save_data', [ $this, 'save_data' ] );

		add_action( 'wp_ajax_toto_save_statistics', [ $this, 'save_statistics' ] );
		add_action( 'wp_ajax_nopriv_toto_save_statistics', [ $this, 'save_statistics' ] );
	}

	/**
	 * Save notification collection data to prefix_toto_notification_data table
	 */
	public function save_data() {

		$data = $_REQUEST['data'];

		$id       = ! empty( $data['notification_id'] ) ? intval( $data['notification_id'] ) : '';
		$ip       = ! empty( $data['ip'] ) ? wp_unslash( $data['ip'] ) : '';
		$location = ! empty( $data['location'] ) ? wp_unslash( $data['location'] ) : '';
		$url      = ! empty( $data['current_page'] ) ? esc_url( urldecode( $data['current_page'] ) ) : '';

		$new_data = [
			'ip'       => $ip,
			'location' => $location,
			'url'      => $url,
		];

		unset( $data['ip'] );
		unset( $data['location'] );
		unset( $data['current_page'] );
		unset( $data['notification_id'] );

		$merged_data = array_merge( $data, $new_data );

		global $wpdb;
		$table = $wpdb->prefix . 'toto_notification_data';

		$wpdb->insert( $table, [
			'notification_id' => $id,
			'data'            => serialize( $merged_data ),
		] );

		exit;
	}

	public function save_statistics() {
		$data = $_REQUEST['data'];

		$notification_id = ! empty( $data['notification_id'] ) ? intval( $data['notification_id'] ) : '';
		$ip              = ! empty( $data['ip'] ) ? wp_unslash( $data['ip'] ) : '';
		$type            = ! empty( $data['type'] ) ? wp_unslash( $data['type'] ) : '';
		$url             = ! empty( $data['current_page'] ) ? esc_url( urldecode( $data['current_page'] ) ) : '';
		$date            = date( 'Y-m-d H:i:s' );

		$unique_id = md5( $notification_id . $ip . $type . $url . date( 'Y-m-d' ) );


		global $wpdb;
		$table = $wpdb->prefix . 'toto_notification_statistics';

		$sql = "INSERT INTO 
                        {$table} (`notification_id`,`unique_id`, `type`, `ip`, `url`, `created_at`, `updated_at`) 
                    VALUES 
                        (%d, %s, %s, %s, %s, %s, %s)
                    ON DUPLICATE KEY UPDATE
                        `count` = `count` + 1,
                        `updated_at` = VALUES (updated_at)  
                ";

		$wpdb->query( $wpdb->prepare( $sql, [ $notification_id, $unique_id, $type, $ip, $url, $date, $date ] ) );

		exit;

	}

}

new Toto_Ajax();