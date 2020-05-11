<?php

defined( 'ABSPATH' ) || exit();

class Toto_Admin {

	public function __construct() {
		$this->includes();

		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		add_action( 'save_post_toto_notification', [ $this, 'save_toto_meta' ] );

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

		add_submenu_page( 'edit.php?post_type=toto_notification', __( 'Notification Statistics', 'toto' ), __( 'Statistics', 'toto' ), 'manage_options', 'notification-statistics', [
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
	 * Add extra columns to the notification table
	 *
	 * @param $columns
	 *
	 * @return mixed
	 */
	public function post_columns( $columns ) {
		unset( $columns['date'] );
		$columns['preview']   = __( 'Preview', 'toto' );
		$columns['type']      = __( 'Type', 'toto' );
		$columns['status']    = __( 'Status', 'toto' );
		$columns['shortcode'] = __( 'Shortcode', 'toto' );

		$columns['date'] = __( 'Date', 'toto' );

		return $columns;
	}

	/**
	 * Notification table column data
	 *
	 * @param $column
	 * @param $post_id
	 */
	public function columns_data( $column, $post_id ) {

		if ( 'preview' == $column ) { ?>
            <a href="#" class="toto-n-preview" data-post_id="<?php echo $post_id; ?>">
                <i class="dashicons dashicons-visibility toto-mr-5"></i> <?php __( 'Preview', 'toto' ) ?> </a>

		<?php } elseif ( 'type' == $column ) {
			$type   = get_post_meta( $post_id, '_notification_type', true );
			$config = ! empty( $type ) ? Toto_Notifications::get_config( $type ) : '';
			?>
            <span class="toto-n-type"><i class="<?php echo $config['icon']; ?>"></i> <?php echo $config['name']; ?></span>

		<?php } elseif ( 'status' == $column ) { ?>
            <div class="toto-switcher">
                <input type="checkbox" class="toto_n_status" id="notification-<?php echo $post_id; ?>" value="<?php echo $post_id; ?>"
					<?php checked( 'publish', get_post_status( $post_id ) ); ?> />

                <div>
                    <label for="notification-<?php echo $post_id; ?>"></label>
                </div>
            </div>

		<?php } elseif ( 'shortcode' == $column ) { ?>
            <span class="toto-n-shortcode" title="<?php _e( 'Copy Shortcode', 'toto' ) ?>"><i class="fa fa-copy"></i> <code>[toto id=<?php echo $post_id; ?>]</code></span>
		<?php }
	}

	public function save_toto_meta( $post_id ) {

		if ( wp_doing_ajax() || wp_doing_cron() ) {
			return;
		}

		if ( empty( $_REQUEST['notification_type'] ) ) {
			return;
		}

		update_post_meta( $post_id, '_notification_type', wp_unslash( $_REQUEST['notification_type'] ) );

		$settings = wp_unslash( $_REQUEST['settings'] );

		$switch_fields = [
			'display_close_button',
			'display_branding',
			'trigger_all_pages',
			'display_once_per_session',
			'display_mobile',
			'show_agreement',
			'enable_sound',
			'show_angry',
			'show_sad',
			'show_neutral',
			'show_happy',
			'enable_sound',
			'show_excited',
			'share_facebook',
			'share_twitter',
			'share_linkedin',
		];

		foreach ( $switch_fields as $key ) {
			$settings[ $key ] = ! isset( $settings[ $key ] ) || ! $settings[ $key ] ? false : true;
		}

		update_post_meta( $post_id, '_settings', $settings );

	}

}

new Toto_Admin();