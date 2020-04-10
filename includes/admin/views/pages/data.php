<?php
$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );
?>

<div class="wrap">
    <h1 class="wp-heading-inline">Notification Data</h1>

	<?php
    $per_page_field = true;
    $toto_current_page = 'notification-data';
	include TOTO_INCLUDES . '/admin/views/pages/filter-bar.php';
	?>

    <div class="toto-notification-data">
		<?php
		global $wpdb;

		$table = $wpdb->prefix . 'toto_notification_data';

		$sql     = "SELECT data, created_at FROM {$table} WHERE notification_id=%d ORDER BY id DESC LIMIT 10";
		$results = $wpdb->get_results( $wpdb->prepare( $sql, 373 ) );

		foreach ( $results as $data ) {
			$date = $data->created_at;
			$data = unserialize( $data->data );

			$date = date( "{$date_format} - {$time_format}", strtotime( $date ) );
			?>

            <div class="toto-panel toto-data-panel">
                <div class="toto-panel-header">
                    <a href="#" class="panel-body-collapse"><i class="dashicons dashicons-arrow-down-alt2"></i></a>
                    <div class="panel-title"><?php echo $date; ?></div>
                    <div class="panel-tools">
                        <a href="#" class="button button-link-delete data-delete"><i class="dashicons dashicons-trash"></i>
                            Delete</a>
                        <a href="#" class="button button-primary data-details"><i class="dashicons dashicons-plus-alt"></i>
                            Details</a>
                    </div>
                </div>
                <div class="toto-panel-body toto-hidden">
					<?php
					foreach ( $data as $key => $val ) {

						if ( 'location' == $key ) {
							$location_parts = json_decode( $val );
							$val            = sprintf( '<img asrc="https://www.countryflags.io/%1$s/flat/16.png" /> %2$s', $location_parts->country_code, $location_parts->country );
						}

						?>
                        <div class="data-group">
                            <div class="data-label"><?php echo strtoupper( $key ); ?> :</div>
                            <div class="data-value"><?php echo $val; ?></div>
                        </div>
					<?php } ?>
                </div>
            </div>
			<?php
		}

		?>

        <div class="toto-pagination-wrap">
            <ul class="toto-pagination">
                <li class="page-item"><a class="page-link disabled" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>

    </div>

</div>