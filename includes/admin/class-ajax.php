<?php

defined( 'ABSPATH' ) || exit();

class Toto_Admin_Ajax {

	/**
	 * Toto_Admin_Ajax constructor.
	 */
	public function __construct() {
		add_action( 'wp_ajax_toto_update_fields', [ $this, 'update_fields' ] );
		add_action( 'wp_ajax_toto_n_status', [ $this, 'handle_status_change' ] );
		add_action( 'wp_ajax_toto_notification_preview', [ $this, 'notification_preview' ] );
		add_action( 'wp_ajax_toto_get_data', [ $this, 'get_data' ] );
		add_action( 'wp_ajax_toto_get_data', [ $this, 'get_data' ] );
		add_action( 'wp_ajax_toto_get_statistics', [ $this, 'get_statistics' ] );
	}

	/**
	 * Update notification content fields based on notification type
	 */
	public function update_fields() {

		if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'] ) ) {
			wp_send_json_error( [ 'msg' => __( 'No Cheating!', 'toto' ) ] );
		}

		if ( empty( $current_type = wp_unslash( $_REQUEST['type'] ) ) ) {
			wp_send_json_error( [ 'msg' => __( 'Type is not set.', 'toto' ) ] );
		}

		$post_id = ! empty( $_REQUEST['post_id'] ) ? intval( $_REQUEST['post_id'] ) : '';

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

		wp_send_json_success( [
			'html' => [
				'content' => $content_html,
			]
		] );

	}

	/**
	 * Handle notification post_status change
	 */
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

	/**
	 * Get notification saved data
	 */
	public function get_data() {
		$nid        = ! empty( $_REQUEST['nid'] ) ? intval( $_REQUEST['nid'] ) : '';
		$start_date = ! empty( $_REQUEST['start_date'] ) ? wp_unslash( $_REQUEST['start_date'] ) : '';
		$end_date   = ! empty( $_REQUEST['end_date'] ) ? wp_unslash( $_REQUEST['end_date'] ) : '';
		$per_page   = ! empty( $_REQUEST['per_page'] ) ? wp_unslash( $_REQUEST['per_page'] ) : '';
		$page       = ! empty( $_REQUEST['page'] ) ? wp_unslash( $_REQUEST['page'] ) : '';


		$args = [
			'nid'        => $nid,
			'start_date' => $start_date,
			'end_date'   => $end_date,
			'per_page'   => $per_page,
			'page'       => $page,
		];


		$results = toto_get_n_data( $args );

		ob_start();

		include TOTO_INCLUDES . '/admin/views/pages/data-loop.php';

		$html = ob_get_clean();

		wp_send_json_success( [
			'html' => $html
		] );

	}

	/**
	 * Get notification saved statistics
	 */
	public function get_statistics() {

		$nid        = ! empty( $_REQUEST['nid'] ) ? intval( $_REQUEST['nid'] ) : '';
		$start_date = ! empty( $_REQUEST['start_date'] ) ? wp_unslash( $_REQUEST['start_date'] ) : '';
		$end_date   = ! empty( $_REQUEST['end_date'] ) ? wp_unslash( $_REQUEST['end_date'] ) : '';

		$notification_type = get_post_meta( $nid, '_notification_type', true );
		$statistics_types  = Toto_Notifications::statistics_types( $notification_type );

		$args = [
			'nid'        => $nid,
			'start_date' => $start_date,
			'end_date'   => $end_date,
		];

		$logs_chart = toto_get_chart_data( $args );

		$labels = $logs_chart['labels'];

		//statistics type and title
		$type_title = [
			'impression'  => __( 'Impressions', 'toto' ),
			'hover'       => __( 'Mouse Hovers', 'toto' ),
			'click'       => __( 'Clicks', 'toto' ),
			'submissions' => __( 'Submissions', 'toto' ),
		];

		ob_start();
		include TOTO_INCLUDES . '/admin/views/pages/summary-loop.php';
		$summary_html = ob_get_clean();

		ob_start();
		include TOTO_INCLUDES . '/admin/views/pages/chart-loop.php';
		$chart_html = ob_get_clean();


		$top_pages = toto_get_top_pages( $args );
		ob_start();
		include TOTO_INCLUDES . '/admin/views/pages/top-page-loop.php';
		$top_pages_html = ob_get_clean();

		wp_send_json_success( [
			'summary_html'   => $summary_html,
			'chart_html'     => $chart_html,
			'top_pages_html' => $top_pages_html,
		] );

	}

	/**
	 * Get notification preview
	 */
	public function notification_preview() {
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