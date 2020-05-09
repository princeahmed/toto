<?php

class Toto_Hooks {
	public function __construct() {
		add_action( 'wp_print_footer_scripts', [ $this, 'render_notifications' ] );
		add_filter( 'display_post_states', [ $this, 'notification_state' ] );

		add_filter( 'views_edit-toto_notification', [ $this, 'edit_quick_links' ] );

	}

	public function edit_quick_links( $views ) {

		if ( ! empty( $views['draft'] ) ) {
			$views['draft'] = str_replace( 'Drafts', 'Disabled', $views['draft'] );
		}

		if ( ! empty( $views['publish'] ) ) {
			$views['publish'] = str_replace( 'Published', 'Enabled', $views['publish'] );
		}

		return $views;
	}

	public function notification_state( $states ) {

		if ( 'toto_notification' == get_post_type() && ! empty( $states['draft'] ) ) {
			$states['draft'] = '<span style="color: #a00;">Disabled</span>';
		}

		return $states;
	}

	public function render_notifications() {
		Toto_Notifications::display_notifications();
	}

}

new Toto_Hooks();