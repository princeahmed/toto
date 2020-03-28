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
		wp_enqueue_style( 'toto', TOTO_ASSETS . '/css/admin.css', [], TOTO_VERSION );

		wp_enqueue_script( 'toto', TOTO_ASSETS . '/js/admin.js', [ 'jquery' ], TOTO_VERSION, true );

		/* Create localized JS array */
		$localized_array = [
			'nonce' => wp_create_nonce( 'wp_plugin_boilerplate' ),
			'i18n'  => [
				'' => '',
			]
		];

		wp_localize_script( 'toto', 'toto', $localized_array );

	}

}

new Toto_Enqueue();