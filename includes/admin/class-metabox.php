<?php

/* block direct access */
defined( 'ABSPATH' ) || exit;

class Trust_Plus_Metabox {

	public function __construct() {
		add_action( 'add_meta_boxes', [ $this, 'register_meta_boxes' ] );
	}

	public function register_meta_boxes() {
		add_meta_box( 'trust_plus_type', __( 'Notification Settings', 'wp-plugin-boilerplate' ), [
			$this,
			'render_type_metabox'
		], 'trust_plus', 'normal', 'high' );
	}


	public function render_type_metabox() {
		include TRUST_PLUS_INCLUDES . '/admin/views/metabox/index.php';
	}


}

new Trust_Plus_Metabox();