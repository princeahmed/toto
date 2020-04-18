<?php

defined( 'ABSPATH' ) || exit();

class Toto_Enqueue {

	public $toto_admin_screens = [
		'toto_notification_page_notification-data',
		'toto_notification_page_notification-statistics',
		'toto_notification_page_prince-options',
		'edit-toto_notification',
		'toto_notification',

	];

	function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );

		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'load_prince_scripts' ] );
	}

	public function frontend_scripts() {
		wp_enqueue_style( 'toto-frontend-css', TOTO_ASSETS . '/css/frontend.css', [], TOTO_VERSION );

		wp_enqueue_script( 'toto-frontend-js', TOTO_ASSETS . '/js/frontend.js', [
			'jquery',
			'wp-util'
		], TOTO_VERSION, true );

		/* Create localized JS array */
		$localized_array = [
			'_wpnonce' => wp_create_nonce(),
			'userIp'   => toto_get_user_ip(),
			'i18n'     => [
				'' => '',
			]
		];

		wp_localize_script( 'toto-frontend-js', 'toto', $localized_array );
	}

	public function admin_scripts( $hooks ) {


		if ( ! in_array( get_current_screen()->id, $this->toto_admin_screens ) ) {
			return;
		}

		wp_enqueue_style( 'select2-css', TOTO_ASSETS . '/vendor/select2/select2.min.css', [], '4.0.6' );
		wp_enqueue_style( 'toto-admin-css', TOTO_ASSETS . '/css/admin.css', [], TOTO_VERSION );


		wp_enqueue_script( 'fontawesome', TOTO_ASSETS . '/vendor/fontawesome.min.js', false, '5.10.0', true );
		wp_enqueue_script( 'sweetalert', TOTO_ASSETS . '/vendor/sweetalert.min.js', false, '', true );
		wp_enqueue_script( 'select2', TOTO_ASSETS . '/vendor/select2/select2.min.js', false, '4.0.6', true );
		wp_enqueue_script( 'toto-admin-js', TOTO_ASSETS . '/js/admin.js', [
			'jquery',
			'wp-util',
		], TOTO_VERSION, true );

		//load chart.js only on the statistics page
		if ( 'toto_notification_page_notification-statistics' == $hooks ) {
			wp_enqueue_script( 'chart', TOTO_ASSETS . '/vendor/Chart.bundle.min.js', false, '2.8.0', false );
		}

		//load notifications styles on edit notification screen
		if ( in_array( get_current_screen()->id, [ 'toto_notification', 'edit-toto_notification' ] ) ) {

			wp_enqueue_style( 'toto-notification-css', TOTO_ASSETS . '/css/frontend.css', false, TOTO_VERSION );
		}

		/* Create localized JS array */
		$localized_array = [
			'_wpnonce' => wp_create_nonce(),
			'userIp'   => toto_get_user_ip(),
			'siteURL'  => site_url(),
			'totoURL'  => plugins_url( '', TOTO_FILE ),
			'i18n'     => [
				'' => '',
			]
		];

		wp_localize_script( 'toto-admin-js', 'toto', $localized_array );

	}

	public function load_prince_scripts() {

		if ( ! in_array( get_current_screen()->id, $this->toto_admin_screens ) ) {
			return;
		}

		if ( function_exists( 'prince_admin_styles' ) ) {
			prince_admin_styles();
			prince_admin_scripts();
		}
	}

}

new Toto_Enqueue();