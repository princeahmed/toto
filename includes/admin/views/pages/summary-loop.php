<?php


foreach ( $statistics_types as $statistics_type ) {
	$count = ! empty( $logs_chart[ $statistics_type . '_total' ] ) ? $logs_chart[ $statistics_type . '_total' ] : 0;

	?>
    <div class="statistics-summary">
        <div class="summary-icon">
            <img src="http://localhost/toto/wp-content/plugins/notificationx/admin/assets/img/views-icon.png" alt="">
        </div>
        <div class="summary-info">
            <div class="summary-number"><?php echo $count; ?></div>
            <div class="summary-title"><?php echo $type_title[ $statistics_type ]; ?></div>
        </div>
    </div>
<?php }