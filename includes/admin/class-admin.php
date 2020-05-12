<?php

defined( 'ABSPATH' ) || exit();

class Trust_Plus_Admin {

	public function __construct() {
		$this->includes();

		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		add_action( 'save_post_trust_plus', [ $this, 'save_trust_plus_meta' ] );

		add_filter( 'manage_trust_plus_posts_columns', [ $this, 'post_columns' ] );
		add_filter( 'manage_trust_plus_posts_custom_column', [ $this, 'columns_data' ], 10, 2 );
	}

	/**
	 * Include necessary admin files
	 */
	public function includes() {
		include_once TRUST_PLUS_INCLUDES . '/admin/class-metabox.php';
		include_once TRUST_PLUS_INCLUDES . '/admin/class-ajax.php';
		include_once TRUST_PLUS_INCLUDES . '/admin/settings.php';
	}

	/**
	 * Add admin Pages
	 */
	public function admin_menu() {

		add_submenu_page( 'edit.php?post_type=trust_plus', __( 'Notification Statistics', 'social-proof-fomo-notification' ), __( 'Statistics', 'social-proof-fomo-notification' ), 'manage_options', 'notification-statistics', [
			$this,
			'render_statistics_page'
		] );
	}

	/**
	 * Render the admin statistics page
	 */
	public function render_statistics_page() {
		include TRUST_PLUS_INCLUDES . '/admin/views/pages/statistics.php';
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
		$columns['preview']   = __( 'Preview', 'social-proof-fomo-notification' );
		$columns['type']      = __( 'Type', 'social-proof-fomo-notification' );
		$columns['status']    = __( 'Status', 'social-proof-fomo-notification' );
		$columns['shortcode'] = __( 'Shortcode', 'social-proof-fomo-notification' );

		$columns['date'] = __( 'Date', 'social-proof-fomo-notification' );

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
            <a href="#" class="trust-plus-n-preview" data-post_id="<?php echo $post_id; ?>">
                <i class="dashicons dashicons-visibility trust-plus-mr-5"></i> <?php __( 'Preview', 'social-proof-fomo-notification' ) ?>
            </a>

		<?php } elseif ( 'type' == $column ) {
			$type = get_post_meta( $post_id, '_notification_type', true );

			if ( empty( $type ) ) {
				return;
			}

			$config = Trust_Plus_Notifications::get_config( $type );
			?>
            <span class="trust-plus-n-type"><i class="<?php echo $config['icon']; ?>"></i> <?php echo $config['name']; ?></span>

		<?php } elseif ( 'status' == $column ) { ?>
            <div class="trust-plus-switcher">
                <input type="checkbox" class="trust_plus_n_status" id="notification-<?php echo $post_id; ?>" value="<?php echo $post_id; ?>"
					<?php checked( 'publish', get_post_status( $post_id ) ); ?> />

                <div>
                    <label for="notification-<?php echo $post_id; ?>"></label>
                </div>
            </div>

		<?php } elseif ( 'shortcode' == $column ) { ?>
            <span class="trust-plus-n-shortcode" title="<?php _e( 'Copy Shortcode', 'social-proof-fomo-notification' ) ?>"><i class="fa fa-copy"></i> <code>[trust_plus id=<?php echo $post_id; ?>]</code></span>
		<?php }
	}

	public function save_trust_plus_meta( $post_id ) {

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

new Trust_Plus_Admin();