<?php

defined( 'ABSPATH' ) || exit();

class Toto_Enqueue {

	function __construct() {
		//add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
	}

	function frontend_scripts() {

	}

	function admin_scripts() {
		wp_enqueue_style( 'toto-admin-css', TOTO_ASSETS . '/css/admin.css', [], TOTO_VERSION );

		wp_enqueue_script( 'fontawesome', TOTO_ASSETS . '/vendor/fontawesome.min.js', false, '5.10.0', true );
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