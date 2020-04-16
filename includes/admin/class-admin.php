<?php

defined( 'ABSPATH' ) || exit();

class Toto_Admin {

	public function __construct() {
		$this->includes();

		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		add_filter( 'manage_toto_notification_posts_columns', [ $this, 'post_columns' ] );
		add_filter( 'manage_toto_notification_posts_custom_column', [ $this, 'columns_data' ], 10, 2 );
	}

	/**
	 * Include necessary admin files
	 */
	public function includes() {
		include_once TOTO_INCLUDES . '/admin/class-metabox.php';
		include_once TOTO_INCLUDES . '/admin/class-ajax.php';
		include_once TOTO_INCLUDES . '/admin/toto-settings.php';
	}

	/**
	 * Add admin Pages
	 */
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

	/**
	 * Render the admin statistics page
	 */
	public function render_statistics_page() {
		include TOTO_INCLUDES . '/admin/views/pages/statistics.php';
	}

	/**
	 * Render the admin data page
	 */
	public function render_data_page() {
		include TOTO_INCLUDES . '/admin/views/pages/data.php';
	}

	public function post_columns( $columns ) {
		unset( $columns['date'] );
		$columns['preview']   = __( 'Preview', 'toto' );
		$columns['type']      = __( 'Type', 'toto' );
		$columns['status']    = __( 'Status', 'toto' );
		$columns['shortcode'] = __( 'Shortcode', 'toto' );

		$columns['date'] = __( 'Date', 'toto' );

		return $columns;
	}

	public function columns_data( $column, $post_id ) {
		if ( 'preview' == $column ) { ?>
            <a href="#" class="toto-n-preview" data-post_id="<?php echo $post_id; ?>">
                <i class="dashicons dashicons-visibility toto-mr-5"></i> Preview </a>
		<?php } elseif ( 'type' == $column ) {
			$type      = get_post_meta( $post_id, '_notification_type', true );
			$type_name = ! empty( $type ) ? Toto_Notifications::get_config( $type )['name'] : '';
			?>
            <span class="toto-n-type"><?php echo $type_name; ?></span>
		<?php } elseif ( 'status' == $column ) { ?>
            <div class="toto-switcher">
                <input type="checkbox" class="toto_n_status" id="notification-<?php echo $post_id; ?>" value="<?php echo $post_id; ?>"
					<?php checked( 'publish', get_post_status( $post_id ) ); ?> />

                <div>
                    <label for="notification-<?php echo $post_id; ?>"></label>
                </div>
            </div>
		<?php } elseif ( 'shortcode' == $column ) { ?>
            <span class="toto-n-shortcode">[toto id=<?php echo $post_id; ?>]</span>
		<?php }
	}

}

new Toto_Admin();