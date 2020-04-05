<?php

defined( 'ABSPATH' ) || exit();

class Toto_Admin {

	public function __construct() {
		$this->includes();

		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
	}

	public function includes() {
		include_once TOTO_INCLUDES . '/admin/class-install.php';
		include_once TOTO_INCLUDES . '/admin/class-metabox.php';
		include_once TOTO_INCLUDES . '/admin/class-ajax.php';
	}

	public function admin_menu() {
		add_submenu_page( 'edit.php?post_type=toto_notification', 'Notification Data', 'Data', 'manage_options', 'notification-data', [
			$this,
			'render_data_page'
		] );

		add_submenu_page( 'edit.php?post_type=toto_notification', 'Notification Statistics', 'Statistics', 'manage_options', 'notification-statistics', [
			$this,
			'render_statistics_page'
		] );
	}

	public function render_statistics_page() {
		include TOTO_INCLUDES.'/admin/views/pages/statistics.php';
	}

	public function render_data_page() {
		include TOTO_INCLUDES.'/admin/views/pages/data.php';
	}

}

new Toto_Admin();