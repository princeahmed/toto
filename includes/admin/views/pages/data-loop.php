<?php
$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );

if ( ! empty( $results ) ) {
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

	<?php }
} else { ?>
    <div class="toto_no_results">
	    <img src="<?php echo TOTO_ASSETS.'/images/no-result.jpg' ?>" alt="No Result Found">
    </div>
<?php
}
