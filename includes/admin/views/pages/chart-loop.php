<?php

if ( ! empty( $logs_chart[$statistics_type] ) ) {

	foreach ( $statistics_types as $statistics_type ) { ?>
        <div class="chart-container">
            <canvas id="<?php echo $statistics_type; ?>_chart" data-title="<?php echo $type_title[ $statistics_type ]; ?>" data-labels='<?php echo $labels; ?>' data-value='<?php echo $logs_chart[ $statistics_type ]; ?>'></canvas>
        </div>
	<?php }

} else { ?>
    <div class="toto_no_results">
        <img src="<?php echo TOTO_ASSETS . '/images/no-result.jpg' ?>" alt="No Result Found">
    </div>
<?php }