<?php

class Toto_Hooks {
	public function __construct() {
		add_action( 'wp_print_footer_scripts', [ $this, 'render_notifications' ] );
	}

	public function render_notifications() {
		Toto_Notifications::active_notifications();
	}

}

new Toto_Hooks();