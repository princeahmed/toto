<?php

class TOTO_Statistics {

	public $nid;
	public $type;
	public $type_title = [];
	public $statistics_types;
	public $query_args;
	public $active_notifications;

	public function __construct( $nid = false, $args = [] ) {

		$args = [
			'post_type'     => 'toto_notification',
			'post_per_page' => - 1,
			'post_status'   => 'publish',
			'order'         => 'ASC',
			'orderby'       => 'date',
		];

		$this->active_notifications = get_posts( $args );

		$this->nid              = $nid ? $nid : $this->active_notifications[0]->ID;
		$this->type             = get_post_meta( $this->nid, '_notification_type', true );

		$this->statistics_types = Toto_Notifications::statistics_types( $this->type );

		$this->type_title       = [
			'impression'  => __( 'Impressions', 'toto' ),
			'hover'       => __( 'Mouse Hovers', 'toto' ),
			'click'       => __( 'Clicks', 'toto' ),
			'submissions' => __( 'Submissions', 'toto' ),
		];

		$this->query_args = array_merge( [
			'nid'        => $this->nid,
			'start_date' => date( 'Y-m-d', strtotime( '-7 days' ) ),
			'end_date'   => date( 'Y-m-d' ),
		], $args );

	}

	public function log_chart() {

		/**
		 * Get the statistics date from database
		 */ global $wpdb;
		$table = $wpdb->prefix . 'toto_notification_statistics';

		$nid        = intval( $this->query_args['nid'] );
		$start_date = esc_attr( $this->query_args['start_date'] );
		$end_date   = esc_attr( $this->query_args['end_date'] );

		$where = "WHERE notification_id = {$nid} ";

		$where .= "AND (`created_at` BETWEEN '{$start_date}' AND '{$end_date}')";

		$sql = "SELECT
                 `type`,
                 COUNT(`id`) AS `total`,
                 DATE_FORMAT(`created_at`, '%Y-%m-%d') AS `date`
            FROM {$table} {$where}
            GROUP BY
                `date`,
                `type`
            ORDER BY
                `date`
            LIMIT 0, 99999
                ";

		$logs = $wpdb->get_results( $sql, 'ARRAY_A' );

		/**
		 * After getting the data
		 * Format the log result to [date(key) => [type=>count]]
		 */
		$logs_chart = [];
		foreach ( $logs as $log ) {
			/* Handle if the date key is not already set */
			if ( ! array_key_exists( $log['date'], $logs_chart ) ) {
				$logs_chart[ $log['date'] ] = [
					'impression'             => 0,
					'hover'                  => 0,
					'click'                  => 0,
					'submissions'            => 0,
					'feedback_emoji_angry'   => 0,
					'feedback_emoji_sad'     => 0,
					'feedback_emoji_neutral' => 0,
					'feedback_emoji_happy'   => 0,
					'feedback_emoji_excited' => 0,
					'feedback_score_1'       => 0,
					'feedback_score_2'       => 0,
					'feedback_score_3'       => 0,
					'feedback_score_4'       => 0,
					'feedback_score_5'       => 0,
				];
			}

			$logs_chart[ $log['date'] ][ $log['type'] ] = $log['total'];

		}

		/**
		 * Format logs data to chart supported data
		 * Generate chart data for based on the date key and each of keys inside
		 * [chart_labels(date),.....] => [chart_value(count),....]
		 */
		$chart = [];
		foreach ( $logs_chart as $date_label => $data ) {

			foreach ( $data as $label_key => $label_value ) {

				if ( ! isset( $chart[ $label_key ] ) ) {
					$chart[ $label_key ] = [];
				}

				$chart[ $label_key ][] = $label_value;

			}

		}

		foreach ( $chart as $key => $value ) {
			$chart[ $key . '_total' ] = array_sum( $chart[ $key ] );
			$chart[ $key ]            = '["' . implode( '", "', $value ) . '"]';
		}

		$chart['labels'] = '["' . implode( '", "', array_keys( $logs_chart ) ) . '"]';

		//return the chart data
		return $chart;

	}

	public function get_top_pages( $args = [] ) {
		global $wpdb;

		$table = $wpdb->prefix . 'toto_notification_statistics';


		$nid        = intval( $this->query_args['nid'] );
		$page       = ! empty( $this->query_args['page'] ) ? intval( $this->query_args['page'] ) : 1;
		$per_page   = ! empty( $this->query_args['per_page'] ) ? intval( $this->query_args['per_page'] ) : 10;
		$start_date = esc_attr( $this->query_args['start_date'] );
		$end_date   = esc_attr( $this->query_args['end_date'] );

		$offset = $per_page * ( $page - 1 );

		$where = "WHERE notification_id = {$nid} ";

		$where .= "AND (`created_at` BETWEEN '{$start_date}' AND '{$end_date}')";

		$sql = "SELECT 
                DISTINCT `url`, 
                `type`, 
                COUNT(`id`) AS `total_uniques`,
                SUM(`count`) AS `total_sessions` 
            FROM {$table} {$where}
            GROUP BY `url`, `type` 
            ORDER BY 
                `total_sessions` DESC,
                `total_uniques` DESC 
            LIMIT {$offset}, {$per_page}
            ";


		return $wpdb->get_results( $sql );
	}

	public function get_saved_data( $args = [] ) {
		global $wpdb;

		$table = $wpdb->prefix . 'toto_notification_data';

		$args = array_merge( [
			'page'       => 1,
			'per_page'   => 10,
			'start_date' => date( 'Y-m-d', strtotime( '-7 days' ) ),
			'end_date'   => date( 'Y-m-d' ),
		], $args );

		$nid        = esc_attr( $args['nid'] );
		$page       = intval( $args['page'] );
		$per_page   = intval( $args['per_page'] );
		$start_date = esc_attr( $args['start_date'] );
		$end_date   = esc_attr( $args['end_date'] );

		$offset = $per_page * ( $page - 1 );

		$where = "WHERE notification_id = {$nid} ";

		$where .= "AND (`created_at` BETWEEN '{$start_date}' AND '{$end_date}')";

		$sql = "SELECT data, created_at FROM {$table} {$where} ORDER BY id DESC LIMIT {$offset}, {$per_page}";

		return $wpdb->get_results( $sql );
	}

	public function filter_bar() {

		?>
        <div class="toto-mt-20 toto-filter-bar" id="toto_n_statistics_filter">
            <div class="toto-input-group">
                <div class="toto-form-group toto-mr-20">
                    <label for="notification_id">Select Notification</label>
                    <select name="notification_id" id="notification_id">
						<?php

						if ( ! empty( $this->active_notifications ) ) {
							$posts = wp_list_pluck( $this->active_notifications, 'post_title', 'ID' );
							foreach ( $posts as $id => $title ) {
								printf( '<option value="%1$s">%2$s</option>', $id, $title );
							}
						}

						?>

                    </select>
                </div>

                <div class="toto-form-group toto-mr-20">
                    <label for="start_date">Start Date</label>
                    <input type="text" id="start_date" class="toto_date_field" name="start_date" value="<?php echo date( 'Y-m-d', strtotime( '-7 days' ) ); ?>">
                </div>

                <div class="toto-form-group toto-mr-20">
                    <label for="end_date">End Date</label>
                    <input type="text" id="end_date" class="toto_date_field" name="end_date" value="<?php echo date( 'Y-m-d', strtotime( 'today' ) ); ?>">
                </div>

            </div>
        </div>
		<?php
	}

	public function summary() { ?>
        <div class="statistics-summary-wrap">

            <div class="summary-ph-wrap hidden">
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

				foreach ( $this->statistics_types as $statistics_type ) {
					$count = ! empty( $this->log_chart()[ $statistics_type . '_total' ] ) ? $this->log_chart()[ $statistics_type . '_total' ] : 0;
					?>
                    <div class="statistics-summary">
                        <div class="summary-icon">
                            <img src="<?php echo TOTO_ASSETS . '/images/statistics/' . $statistics_type . '.png' ?>" alt="<?php echo $this->type_title[ $statistics_type ]; ?>">
                        </div>
                        <div class="summary-info">
                            <div class="summary-number"><?php echo $count; ?></div>
                            <div class="summary-title"><?php echo $this->type_title[ $statistics_type ]; ?></div>
                        </div>
                    </div>
				<?php } ?>
            </div>
        </div>
		<?php
	}

	public function chart() { ?>
        <div class="toto_n_statistics_chart">
            <div class="chart-ph hidden">
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
				<?php if ( ! empty( $this->log_chart() ) ) {

					foreach ( $this->statistics_types as $statistics_type ) { ?>
                        <div class="chart-container">
                            <canvas id="<?php echo $statistics_type; ?>_chart" data-title="<?php echo $this->type_title[ $statistics_type ]; ?>" data-labels='<?php echo $this->log_chart()['labels']; ?>' data-value='<?php echo $this->log_chart()[ $statistics_type ]; ?>'></canvas>
                        </div>
					<?php }

				} else { ?>
                    <div class="toto_no_results">
                        <h2><i class="fa fa-exclamation-triangle"></i> <?php _e( 'No Data Found!', 'toto' ) ?></h2>
                    </div>
				<?php } ?>
            </div>
        </div>
	<?php }

	public function top_pages() { ?>
        <div class="statistics-top-pages <?php echo ! empty( $this->get_top_pages() ) ? '' : 'hidden'; ?>">

            <div class="top_pages_header">
                <h3 class="top-pages-title"><?php _e( 'Top Pages', 'toto' ) ?></h3>
                <p class="top-pages-description description"><?php _e( 'Most active pages on which notifications had most activity.', 'toto' ) ?></p>
            </div>

            <table class="widefat" id="top-pages-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?php _e( 'URL', 'toto' ) ?></th>
                    <th><?php _e( 'Type', 'toto' ) ?></th>
                    <th><?php _e( 'Uniques', 'toto' ) ?></th>
                    <th><?php _e( 'Sessions', 'toto' ) ?></th>
                </tr>
                </thead>

                <tbody>

				<?php

				if ( ! empty( $this->get_top_pages() ) ) {
					$i = 1;
					foreach ( $this->get_top_pages() as $item ) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><a href="<?php echo $item->url; ?>" target="_blank"><?php echo $item->url; ?></a></td>
                            <td><?php echo $this->type_title[ $item->type ]; ?></td>
                            <td><?php echo $item->total_uniques; ?></td>
                            <td><?php echo $item->total_sessions; ?></td>
                        </tr>
						<?php
						$i ++;
					}
				}
				?>

                </tbody>

                <tfoot class="hidden">
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

        </div>
	<?php }
}