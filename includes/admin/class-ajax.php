<?php

defined( 'ABSPATH' ) || exit();

class Toto_Admin_Ajax {

	public function __construct() {
		add_action( 'wp_ajax_update_menu', [ $this, 'update_menu' ] );
		add_action( 'wp_ajax_toto_n_status', [ $this, 'handle_status_change' ] );
		add_action( 'wp_ajax_toto_notification_preview', [ $this, 'toto_notification_preview' ] );
	}

	public function update_menu() {

		if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'] ) ) {
			wp_send_json_error( [ 'msg' => 'No Cheating!' ] );
		}

		if ( empty( $current_type = wp_unslash( $_REQUEST['type'] ) ) ) {
			wp_send_json_error( [ 'msg' => 'type is not set.' ] );
		}

		$post_id = ! empty( $_REQUEST['post_id'] ) ? intval( $_REQUEST['post_id'] ) : '';

		ob_start();
		include TOTO_INCLUDES . '/admin/views/metabox/menu.php';
		$menu_html = ob_get_clean();

		ob_start();
		$tabs = Toto_Notifications::setting_tabs( $current_type );

		foreach ( $tabs as $key => $fields ) { ?>
            <div class="toto-tab-content-item flex-column" id="<?php echo $key; ?>">
				<?php

				foreach ( $fields as $field ) {
					echo Toto_Notifications::settings_fields( $current_type, $field, $post_id );
				}

				?>
            </div>
		<?php }
		$content_html = ob_get_clean();

		ob_start();
		Toto_Notifications::preview_handler( $current_type );
		$scripts = ob_get_clean();

		wp_send_json_success( [
			'html' => [
				'menu'    => $menu_html,
				'content' => $content_html,
				'scripts' => $scripts,
			]
		] );
	}

	public function handle_status_change() {
		$post_id = ! empty( $_REQUEST['post_id'] ) ? intval( $_REQUEST['post_id'] ) : '';
		$status  = ! empty( $_REQUEST['status'] ) ? wp_unslash( $_REQUEST['status'] ) : 'draft';

		$args = [
			'ID'          => $post_id,
			'post_status' => $status
		];

		wp_update_post( $args );

		wp_send_json_success();

	}

	public function toto_notification_preview() {
		$post_id   = ! empty( $_REQUEST['post_id'] ) ? intval( $_REQUEST['post_id'] ) : '';
		$type      = get_post_meta( $post_id, '_notification_type', true );
		$type_name = Toto_Notifications::get_config( $type )['name'];


		ob_start();
		Toto_Notifications::preview( $type, $post_id );
		$html = ob_get_clean();

		wp_send_json_success( [
			'type' => $type_name,
			'html' => $html
		] );

	}

}

new Toto_Admin_Ajax();