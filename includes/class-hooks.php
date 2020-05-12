<?php

defined( 'ABSPATH' ) || exit();

class Trust_Plus_Hooks {

	/**
	 * Trust_Plus_Hooks constructor.
	 */
	public function __construct() {
		add_action( 'wp_print_footer_scripts', [ $this, 'render_notifications' ] );

		add_filter( 'display_post_states', [ $this, 'notification_state' ] );
		add_filter( 'views_edit-trust_plus', [ $this, 'edit_quick_links' ] );

	}

	/**
	 * Notification Table Quick links
	 *
	 * @param $views
	 *
	 * @return mixed
	 */
	public function edit_quick_links( $views ) {

		if ( ! empty( $views['draft'] ) ) {
			$views['draft'] = str_replace( 'Drafts', __( 'Disabled', 'social-proof-fomo-notification' ), $views['draft'] );
		}

		if ( ! empty( $views['publish'] ) ) {
			$views['publish'] = str_replace( 'Published', __( 'Enabled', 'social-proof-fomo-notification' ), $views['publish'] );
		}

		return $views;
	}

	/**
	 * Change notification state
	 *
	 * @param $states
	 *
	 * @return mixed
	 */
	public function notification_state( $states ) {

		if ( 'trust_plus' == get_post_type() && ! empty( $states['draft'] ) ) {
			$states['draft'] = '<span style="color: #a00;">Disabled</span>';
		}

		return $states;
	}

	/**
	 * Display frontend notification
	 */
	public function render_notifications() {
		Trust_Plus_Notifications::display_notifications();
	}

}

new Trust_Plus_Hooks();