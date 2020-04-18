<?php

defined( 'ABSPATH' ) || exit();

class TOTO_Shortcodes {

	public function __construct() {
		add_shortcode( 'toto', [ $this, 'render_notification' ] );
	}

	public function render_notification( $atts ) {

		$id = intval( $atts['id'] );

		if ( ! $id ) {
			return;
		}



		ob_start();
		Toto_Notifications::get_view( $id, false, true );

		return ob_get_clean();

	}

}

new TOTO_Shortcodes();