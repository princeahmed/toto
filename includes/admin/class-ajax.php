<?php

defined( 'ABSPATH' ) || exit();

class Toto_Admin_Ajax {

	public function __construct() {
		add_action( 'wp_ajax_update_menu', [ $this, 'update_menu' ] );
	}

	public function update_menu() {

		if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'] ) ) {
			wp_send_json_error( [ 'msg' => 'No Cheating!' ] );
		}

		if ( empty( $current_type = wp_unslash( $_REQUEST['type'] ) ) ) {
			wp_send_json_error( [ 'msg' => 'type is not set.' ] );
		}

		ob_start();
		include TOTO_INCLUDES . '/admin/views/metabox/menu.php';
		$menu_html = ob_get_clean();

		ob_start();
		$tabs = Toto_Notifications::notification_setting_tabs( $current_type );

		foreach ( $tabs as $key => $fields ) { ?>
            <div class="toto-tab-content-item flex-column" id="<?php echo $key; ?>">
				<?php

				foreach ( $fields as $field ) {
					echo Toto_Notifications::settings_fields( $current_type, $field );
				}

				?>
            </div>
		<?php }
		$content_html = ob_get_clean();

		wp_send_json_success( [
			'html' => [
				'menu'    => $menu_html,
				'content' => $content_html,
			]
		] );
	}

}

new Toto_Admin_Ajax();