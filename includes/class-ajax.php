<?php

defined( 'ABSPATH' ) || exit();

class Toto_Ajax {

	public function __construct() {
		add_action( 'wp_ajax_toto_save_data', [ $this, 'save_data' ] );
		add_action( 'wp_ajax_nopriv_toto_save_data', [ $this, 'save_data' ] );
	}

	public function save_data() {

		$data = $_REQUEST['data'];

		if ( empty( $data['type'] ) || 'collector' != $data['type'] ) {
			return;
		}

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
		unset( $data['type'] );
		unset( $data['agent'] );
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

}

new Toto_Ajax();