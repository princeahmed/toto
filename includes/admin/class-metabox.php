<?php

/* block direct access */
defined( 'ABSPATH' ) || exit;

class Toto_Metabox {

	public function __construct() {
		add_action( 'add_meta_boxes', [ $this, 'register_meta_boxes' ] );
	}

	public function register_meta_boxes() {
		add_meta_box( 'toto_type', __( 'Notification Settings', 'wp-plugin-boilerplate' ), [
			$this,
			'render_type_metabox'
		], 'toto_notification', 'normal', 'high' );
	}


	public function render_type_metabox() {
		include TOTO_INCLUDES . '/admin/views/metabox/index.php';
	}


}

new Toto_Metabox();