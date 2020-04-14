<div class="wrap">
    <h1 class="wp-heading-inline">Notification Statistics</h1>

	<?php
	include TOTO_INCLUDES . '/admin/views/pages/filter-bar.php';

	//declared in filter-bar.php
	$nid = ! empty( $posts ) ? array_key_first( $posts ) : '';
	//$nid = 373;

	$notification_type = get_post_meta( $nid, '_notification_type', true );
	$statistics_types  = Toto_Notifications::statistics_types( $notification_type );

	$log_args = [
		'nid' => $nid
	];

	$logs_chart = toto_get_chart_data( $log_args );

	$labels = $logs_chart['labels'];

	//statistics type and title
	$type_title = [
		'impression'  => 'Impressions',
		'hover'       => 'Mouse Hovers',
		'click'       => 'Clicks',
		'submissions' => 'Submissions',
	];

	?>

    <div class="statistics-summary-wrap">

        <div class="summary-ph-wrap  toto-hidden">
            <div class="summary-ph">
                <div class="ph-item">
                    <div class="ph-col-4">
                        <div class="ph-picture"></div>
                    </div>
                    <div>
                        <div class="ph-row">
                            <div class="ph-col-10 big"></div>
                            <div class="ph-col-10 empty"></div>
                            <div class="ph-col-12"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="summary-ph">
                <div class="ph-item">
                    <div class="ph-col-4">
                        <div class="ph-picture"></div>
                    </div>
                    <div>
                        <div class="ph-row">
                            <div class="ph-col-10 big"></div>
                            <div class="ph-col-10 empty"></div>
                            <div class="ph-col-12"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="summary-ph">
                <div class="ph-item">
                    <div class="ph-col-4">
                        <div class="ph-picture"></div>
                    </div>
                    <div>
                        <div class="ph-row">
                            <div class="ph-col-10 big"></div>
                            <div class="ph-col-10 empty"></div>
                            <div class="ph-col-12"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="summary-content">
			<?php

            include TOTO_INCLUDES . '/admin/views/pages/summary-loop.php'; ?>
        </div>
    </div>

    <!--  Statistics Charts  -->
    <div class="toto-notification-statistics">

        <div class="chart-ph toto-hidden">
            <div class="ph-item">

                <div class="ph-col-12">
                    <div class="ph-row">
                        <div class="ph-col-6 big"></div>
                        <div class="ph-col-4 empty big"></div>
                        <div class="ph-col-2 big"></div>
                        <div class="ph-col-4"></div>
                        <div class="ph-col-4"></div>
                        <div class="ph-col-4 empty"></div>
                        <div class="ph-col-6"></div>
                        <div class="ph-col-6 empty"></div>
                        <div class="ph-col-12"></div>
                    </div>
                </div>

            </div>
            <div class="ph-item">

                <div class="ph-col-12">
                    <div class="ph-row">
                        <div class="ph-col-6 big"></div>
                        <div class="ph-col-4 empty big"></div>
                        <div class="ph-col-2 big"></div>
                        <div class="ph-col-4"></div>
                        <div class="ph-col-4"></div>
                        <div class="ph-col-4 empty"></div>
                        <div class="ph-col-6"></div>
                        <div class="ph-col-6 empty"></div>
                        <div class="ph-col-12"></div>
                    </div>
                </div>

            </div>
            <div class="ph-item">

                <div class="ph-col-12">
                    <div class="ph-row">
                        <div class="ph-col-6 big"></div>
                        <div class="ph-col-4 empty big"></div>
                        <div class="ph-col-2 big"></div>
                        <div class="ph-col-4"></div>
                        <div class="ph-col-4"></div>
                        <div class="ph-col-4 empty"></div>
                        <div class="ph-col-6"></div>
                        <div class="ph-col-6 empty"></div>
                        <div class="ph-col-12"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="chart-content">
			<?php include TOTO_INCLUDES . '/admin/views/pages/chart-loop.php'; ?>
        </div>

        <div class="statistics-top-pages">

            <div class="top_pages_header">
                <h3 class="top-pages-title">Top Pages</h3>
                <p class="top-pages-description description">
                    Most active pages on which notifications had most activity. </p>
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
				include TOTO_INCLUDES . '/admin/views/pages/top-page-loop.php';

				?>

                </tbody>

                <tfoot class="toto-hidden">
                <tr>
                    <td colspan="5">
                        <div class="ph-item">

                            <div class="ph-col-12">
                                <div class="ph-row toto-mb-50">
                                    <div class="ph-col-6 big"></div>
                                    <div class="ph-col-4 empty big"></div>
                                    <div class="ph-col-2 big"></div>
                                    <div class="ph-col-4"></div>
                                    <div class="ph-col-8 empty"></div>
                                    <div class="ph-col-6"></div>
                                    <div class="ph-col-6 empty"></div>
                                    <div class="ph-col-12"></div>
                                </div>

                                <div class="ph-row toto-mb-50">
                                    <div class="ph-col-6 big"></div>
                                    <div class="ph-col-4 empty big"></div>
                                    <div class="ph-col-2 big"></div>
                                    <div class="ph-col-4"></div>
                                    <div class="ph-col-8 empty"></div>
                                    <div class="ph-col-6"></div>
                                    <div class="ph-col-6 empty"></div>
                                    <div class="ph-col-12"></div>
                                </div>


                                <div class="ph-row toto-mb-50">
                                    <div class="ph-col-6 big"></div>
                                    <div class="ph-col-4 empty big"></div>
                                    <div class="ph-col-2 big"></div>
                                    <div class="ph-col-4"></div>
                                    <div class="ph-col-8 empty"></div>
                                    <div class="ph-col-6"></div>
                                    <div class="ph-col-6 empty"></div>
                                    <div class="ph-col-12"></div>
                                </div>


                                <div class="ph-row toto-mb-50">
                                    <div class="ph-col-6 big"></div>
                                    <div class="ph-col-4 empty big"></div>
                                    <div class="ph-col-2 big"></div>
                                    <div class="ph-col-4"></div>
                                    <div class="ph-col-8 empty"></div>
                                    <div class="ph-col-6"></div>
                                    <div class="ph-col-6 empty"></div>
                                    <div class="ph-col-12"></div>
                                </div>

                            </div>

                        </div>
                    </td>
                </tr>
                </tfoot>

            </table>

            <button id="toto_show_more_pages" type="submit" class="toto-btn toto-btn-primary">Show More Pages</button>

        </div>

    </div>