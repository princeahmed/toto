<?php

class Toto_Hooks {
	public function __construct() {
		add_action( 'wp_print_footer_scripts', [ $this, 'render_notifications' ] );
		add_action( 'admin_footer', [ $this, 'admin_footer' ] );
	}

	public function admin_footer() {
		$screen = get_current_screen();

		if ( 'edit-toto_notification' == $screen->id ) {
			include TOTO_INCLUDES . '/admin/views/html-modal.php';
		}
	}

	public function render_notifications() {
		Toto_Notifications::active_notifications();
	}

}

new Toto_Hooks();