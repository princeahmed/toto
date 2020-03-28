<?php

defined( 'ABSPATH' ) || exit();

class Toto_Admin {

	public function __construct() {
		$this->includes();
	}

	public function includes() {
		include_once TOTO_INCLUDES . '/admin/class-install.php';
		include_once TOTO_INCLUDES . '/admin/class-metabox.php';
		include_once TOTO_INCLUDES . '/admin/class-ajax.php';
		include_once TOTO_INCLUDES . '/admin/class-notifications.php';
	}

}

new Toto_Admin();