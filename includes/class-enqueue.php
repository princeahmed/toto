<?php

defined( 'ABSPATH' ) || exit();

class Toto_Enqueue {

	function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
	}

	function frontend_scripts() {
		wp_enqueue_style( 'toto-frontend-css', TOTO_ASSETS . '/css/frontend.css', [], TOTO_VERSION );

		wp_enqueue_script( 'toto-frontend-js', TOTO_ASSETS . '/js/frontend.js', [ 'jquery', 'wp-util' ], TOTO_VERSION, true );
	}

	function admin_scripts() {
		wp_enqueue_style( 'select2-css', TOTO_ASSETS . '/vendor/select2/select2.min.css', [], '4.0.6' );
		wp_enqueue_style( 'toto-admin-css', TOTO_ASSETS . '/css/admin.css', [], TOTO_VERSION );

		wp_enqueue_script( 'fontawesome', TOTO_ASSETS . '/vendor/fontawesome.min.js', false, '5.10.0', true );
		wp_enqueue_script( 'select2', TOTO_ASSETS . '/vendor/select2/select2.min.js', false, '4.0.6', true );
		wp_enqueue_script( 'chart', TOTO_ASSETS . '/vendor/Chart.bundle.min.js', false, '2.8.0', false );
		wp_enqueue_script( 'toto-admin-js', TOTO_ASSETS . '/js/admin.js', [ 'jquery', 'wp-util' ], TOTO_VERSION, true );

		/* Create localized JS array */
		$localized_array = [
			'_wpnonce' => wp_create_nonce(),
			'i18n'  => [
				'' => '',
			]
		];

		wp_localize_script( 'toto-admin-js', 'toto', $localized_array );

	}

}

new Toto_Enqueue();