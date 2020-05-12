<?php

defined( 'ABSPATH' ) || exit();

class Trust_Plus_Shortcodes {

	/**
	 * Trust_Plus_Shortcodes constructor.
	 */
	public function __construct() {
		add_shortcode( 'social-proof-fomo-notification', [ $this, 'render_notification' ] );
	}

	/**
	 * @param $atts
	 *
	 * @return false|string|void
	 * @throws Exception
	 */
	public function render_notification( $atts ) {

		$id = intval( $atts['id'] );

		if ( ! $id ) {
			return;
		}

		ob_start();
		Trust_Plus_Notifications::get_view( $id, false, true );

		return ob_get_clean();

	}

}

new Trust_Plus_Shortcodes();