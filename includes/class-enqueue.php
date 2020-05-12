<?php

defined( 'ABSPATH' ) || exit();

class Trust_Plus_Enqueue {

	public $trust_plus_admin_screens = [
		'trust_plus_page_notification-statistics',
		'trust_plus_page_prince-options',
		'edit-trust_plus',
		'trust_plus',
	];

	/**
	 * Trust_Plus_Enqueue constructor.
	 */
	function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'load_prince_scripts' ] );
	}

	/**
	 * Frontend scripts
	 */
	public function frontend_scripts() {
		wp_enqueue_style( 'trust-plus-frontend-css', TRUST_PLUS_ASSETS . '/css/frontend.css', [], TRUST_PLUS_VERSION );

		wp_enqueue_script( 'trust-plus-frontend-js', TRUST_PLUS_ASSETS . '/js/frontend.js', [
			'jquery',
			'wp-util'
		], TRUST_PLUS_VERSION, true );

	}

	/**
	 * Admin Scripts
	 *
	 * @param $hooks
	 */
	public function admin_scripts( $hooks ) {

		//don't load any script if is not trust_plus admin screen
		if ( ! in_array( get_current_screen()->id, $this->trust_plus_admin_screens ) ) {
			return;
		}

		wp_enqueue_style( 'select2-css', TRUST_PLUS_ASSETS . '/vendor/select2/select2.min.css', [], '4.0.6' );
		wp_enqueue_style( 'trust-plus-admin-css', TRUST_PLUS_ASSETS . '/css/admin.css', [], TRUST_PLUS_VERSION );
		wp_enqueue_script( 'fontawesome', TRUST_PLUS_ASSETS . '/vendor/fontawesome.min.js', false, '5.10.0', true );
		wp_enqueue_script( 'sweetalert', TRUST_PLUS_ASSETS . '/vendor/sweetalert.min.js', false, '', true );
		wp_enqueue_script( 'select2', TRUST_PLUS_ASSETS . '/vendor/select2/select2.min.js', false, '4.0.6', true );
		wp_enqueue_script( 'trust-plus-admin-js', TRUST_PLUS_ASSETS . '/js/admin.js', [
			'jquery',
			'wp-util',
		], TRUST_PLUS_VERSION, true );

		//load chart.js only on the statistics page
		if ( 'trust_plus_page_notification-statistics' == $hooks ) {
			wp_enqueue_script( 'chart', TRUST_PLUS_ASSETS . '/vendor/Chart.bundle.min.js', false, '2.8.0', false );
		}

		//load notifications styles on edit notification screen
		if ( in_array( get_current_screen()->id, [ 'trust_plus', 'edit-trust_plus' ] ) ) {

			wp_enqueue_style( 'trust-plus-notification-css', TRUST_PLUS_ASSETS . '/css/frontend.css', false, TRUST_PLUS_VERSION );
		}

		/* Create localized JS array */
		$localized_array = [
			'_wpnonce'       => wp_create_nonce(),
			'site_url'       => site_url(),
			'trust_plus_url' => plugins_url( '', TRUST_PLUS_FILE ),
			'i18n'           => [
				'disabled'         => __( 'Disabled', 'social-proof-fomo-notification' ),
				'enabled'          => __( 'Enabled', 'social-proof-fomo-notification' ),
				'notification'     => __( 'Notification', 'social-proof-fomo-notification' ),
				'copied'           => __( 'Copied to Clipboard.', 'social-proof-fomo-notification' ),
				'select_locations' => __( 'Select Locations', 'social-proof-fomo-notification' ),
				'choose_image'     => __( 'Choose Image', 'social-proof-fomo-notification' ),
			]
		];

		wp_localize_script( 'trust-plus-admin-js', 'trustPlus', $localized_array );

	}

	/**
	 * load prince-settings scripts on the trust_plus screens
	 */
	public function load_prince_scripts() {

		if ( ! in_array( get_current_screen()->id, $this->trust_plus_admin_screens ) ) {
			return;
		}

		if ( function_exists( 'prince_admin_styles' ) ) {
			prince_admin_styles();
			prince_admin_scripts();
		}
	}

}

new Trust_Plus_Enqueue();