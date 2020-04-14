<div class="wrap">
    <h1 class="wp-heading-inline">Notification Statistics</h1>

	<?php
	include TOTO_INCLUDES . '/admin/views/pages/filter-bar.php';

	$notification_id   = 373;
	$notification_type = 'EMAIL_COLLECTOR';
	$is_data_supports  = Toto_Notifications::is_data_supports( $notification_type );

	$log_args = [
		'nid' => $notification_id
	];

	$logs_chart = toto_get_chart_data( $log_args );

	$labels = $logs_chart['labels'];

	//statistics type and title
	$type_title = [
		'impression'  => 'Impressions',
		'hover'       => 'Mouse Hovers',
		//'click'       => 'Clicks',
		'submissions' => 'Submissions',
	];

	?>

    <div class="statistics-summary-wrap">

		<?php
		foreach ( $type_title as $key => $title ) { ?>
            <div class="statistics-summary">
                <div class="summary-icon">
                    <img src="http://localhost/toto/wp-content/plugins/notificationx/admin/assets/img/views-icon.png" alt="">
                </div>
                <div class="summary-info">
                    <div class="summary-number"><?php echo $logs_chart[ $key . '_total' ]; ?></div>
                    <div class="summary-title"><?php echo $title; ?></div>
                </div>
            </div>

		<?php } ?>
    </div>

    <!--  Statistics Charts  -->
    <div class="toto-notification-statistics">

		<?php

		foreach ( $type_title as $key => $title ) { ?>
            <div class="chart-container">
                <canvas id="<?php echo $key; ?>_chart" data-title="<?php echo $title; ?>" data-labels='<?php echo $labels; ?>' data-value='<?php echo $logs_chart[ $key ]; ?>'></canvas>
            </div>
		<?php } ?>

        <div class="statistics-top-pages">

            <div class="top_pages_header">
                <h3 class="top-pages-title">Top Pages</h3>
                <p class="top-pages-description description">Most active pages on which notifications had most
                    activity.</p>
            </div>

            <table class="widefat" id="top-pages-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>URL</th>
                    <th>Type</th>
                    <th>Uniques</th>
                    <th>Sessions</th>
                </tr>
                </thead>

                <tbody>
				<?php

				$top_pages = toto_get_top_pages( $log_args );

				if ( ! empty( $top_pages ) ) {
					$i = 1;
					foreach ( $top_pages as $item ) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><a href="<?php echo $item->url; ?>" target="_blank"><?php echo $item->url; ?></a></td>
                            <td><?php echo $type_title[ $item->type ]; ?></td>
                            <td><?php echo $item->total_uniques; ?></td>
                            <td><?php echo $item->total_sessions; ?></td>
                        </tr>
						<?php
						$i ++;
					}
				}
				?>
                </tbody>

            </table>

            <button id="toto_show_more_pages" type="submit" class="toto-btn toto-btn-primary">Show More Pages</button>

        </div>

    </div>