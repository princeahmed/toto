<?php
$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );
?>

<div class="wrap">
    <h1 class="wp-heading-inline">Notification Data</h1>

    <form action="" method="POST" class="toto-mt-20">
        <div class="toto-input-group">
            <div class="toto-form-group">
                <label for="notification_id">Select Notification</label>
                <select name="notification_id" id="notification_id">
                    <option value="">Select Notification</option>
                </select>
            </div>

            <div class="toto-form-group">
                <label for="start_date">Start Date</label>
                <input type="text" id="start_date" name="start_date" value="<?php echo date( 'Y-m-d', strtotime( 'yesterday' ) ); ?>">
            </div>

            <div class="toto-form-group">
                <label for="end_date">End Date</label>
                <input type="text" id="end_date" name="end_date" value="<?php echo date( 'Y-m-d', strtotime( 'today' ) ); ?>">
            </div>

            <div class="toto-form-group">
                <button class="toto-btn toto-btn-primary" type="submit" id="data-select">Submit</button>
            </div>

        </div>
    </form>

    <div class="toto-notification-data">
		<?php
		global $wpdb;

		$table = $wpdb->prefix . 'toto_notification_data';

		$sql     = "SELECT data, created_at FROM {$table} WHERE notification_id=%d ORDER BY id DESC";
		$results = $wpdb->get_results( $wpdb->prepare( $sql, 373 ) );

		foreach ( $results as $data ) {
			$date = $data->created_at;
			$data = unserialize( $data->data );

			$date = date( "{$date_format} - {$time_format}", strtotime( $date ) );
			?>

            <div class="toto-panel toto-data-panel">
                <div class="toto-panel-header">
                    <div class="panel-title"><?php echo $date; ?></div>
                    <div class="panel-tools">
                        <a href="#" class="button button-link-delete"><i class="dashicons dashicons-trash"></i>
                            Delete</a>
                        <a href="#" class="button button-primary"><i class="dashicons dashicons-plus-alt"></i> Show
                            Details</a>
                    </div>
                </div>
                <div class="toto-panel-body">
					<?php
					foreach ( $data as $key => $val ) {

						if ( 'location' == $key ) {
							$location_parts = json_decode( $val );
							$val            = sprintf( '<img src="https://www.countryflags.io/%1$s/flat/16.png" /> %2$s', $location_parts->country_code, $location_parts->country );
						}

						?>
                        <div class="data-group">
                            <div class="data-label"><?php echo strtoupper( $key ); ?> : </div>
                            <div class="data-value"><?php echo $val; ?></div>
                        </div>
					<?php } ?>
                </div>
            </div>
			<?php
		}

		?>
    </div>

</div>