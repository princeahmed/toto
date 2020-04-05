<?php

defined( 'ABSPATH' ) || exit;

class Toto_Form_Handler {
	public function __construct() {
		add_action( 'save_post_toto_notification', [ $this, 'save_toto_meta' ] );
	}

	public function save_toto_meta( $post_id ) {

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		if ( defined( 'DOING_CRON' ) && DOING_CRON ) {
			return;
		}

		update_post_meta( $post_id, '_notification_type', wp_unslash( $_REQUEST['notification_type'] ) );

		$settings = wp_unslash( $_REQUEST['settings'] );

		$switch_fields = [
			'display_close_button',
			'display_branding',
			'trigger_all_pages',
			'display_once_per_session',
			'display_mobile',
			'show_agreement',
			'data_send_is_enabled',
		];

		foreach ( $switch_fields as $key ) {
			$settings[ $key ] = isset( $settings[ $key ] ) ? true : false;
		}

		update_post_meta( $post_id, '_settings',  $settings);

	}

}

new Toto_Form_Handler();