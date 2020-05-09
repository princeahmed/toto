<?php

class TOTO_Statistics {

	public $nid;
	public $type;
	public $type_title = [];
	public $statistics_types;
	public $query_args;

	public function __construct( $nid = false, $args = [] ) {

		$this->nid  = $nid ? $nid : $this->get_active_notifications()[0]->ID;
		$this->type = get_post_meta( $this->nid, '_notification_type', true );

		$this->statistics_types = Toto_Notifications::statistics_types( $this->type );

		$this->type_title = [
			'impression'             => __( 'Impressions', 'toto' ),
			'hover'                  => __( 'Mouse Hovers', 'toto' ),
			'click'                  => __( 'Clicks', 'toto' ),
			'submissions'            => __( 'Submissions', 'toto' ),
			'feedback_emoji_angry'   => __( 'Feedback Emoji Angry', 'toto' ),
			'feedback_emoji_sad'     => __( 'Feedback Emoji Sad', 'toto' ),
			'feedback_emoji_neutral' => __( 'Feedback Emoji Neutral', 'toto' ),
			'feedback_emoji_happy'   => __( 'Feedback Emoji Happy', 'toto' ),
			'feedback_emoji_excited' => __( 'Feedback Emoji Excited', 'toto' ),
			'feedback_score_1'       => __( 'Feedback Score 1', 'toto' ),
			'feedback_score_2'       => __( 'Feedback Score 2', 'toto' ),
			'feedback_score_3'       => __( 'Feedback Score 3', 'toto' ),
			'feedback_score_4'       => __( 'Feedback Score 4', 'toto' ),
			'feedback_score_5'       => __( 'Feedback Score 5', 'toto' ),
		];

		$this->query_args = array_merge( [
			'nid'        => $this->nid,
			'start_date' => date( 'Y-m-d', strtotime( '-1 month' ) ),
			'end_date'   => date( 'Y-m-d', strtotime( 'tomorrow' ) ),
		], $args );

	}

	public function get_active_notifications() {
		$args = [
			'post_type'     => 'toto_notification',
			'post_per_page' => - 1,
			'post_status'   => 'publish',
			'order'         => 'ASC',
			'orderby'       => 'date',
		];

		return get_posts( $args );
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

		if ( empty( $logs ) ) {
			return false;
		}

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
		include TOTO_INCLUDES . '/admin/views/pages/statistics-filter-bar.php';
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
					include TOTO_INCLUDES . '/admin/views/pages/statistics-summary.php';
				}

				//emoji feedback summary
				if ( 'EMOJI_FEEDBACK' == $this->type ) {
					include TOTO_INCLUDES . '/admin/views/pages/statistics-summary-emoji.php';
				}

				?>
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

					//impression, hover & clicks
					foreach ( $this->statistics_types as $statistics_type ) { ?>
                        <div class="chart-container">
                            <canvas id="<?php echo $statistics_type; ?>_chart" data-title="<?php echo $this->type_title[ $statistics_type ]; ?>" data-labels='<?php echo $this->log_chart()['labels']; ?>' data-value='<?php echo $this->log_chart()[ $statistics_type ]; ?>'></canvas>
                        </div>
					<?php }

					//emoji feedback
					if ( 'EMOJI_FEEDBACK' == $this->type ) {
						$data_sets = [
							(object) [
								'label'       => 'Angry',
								'data'        => $this->log_chart()['feedback_emoji_angry'],
								'borderColor' => '#ED4956',
								'fill'        => false,
							],
							(object) [
								'label'       => 'Sad',
								'data'        => $this->log_chart()['feedback_emoji_sad'],
								'borderColor' => '#ed804c',
								'fill'        => false,
							],
							(object) [
								'label'       => 'Neutral',
								'data'        => $this->log_chart()['feedback_emoji_neutral'],
								'borderColor' => '#8f8f8f',
								'fill'        => false,
							],
							(object) [
								'label'       => 'Happy',
								'data'        => $this->log_chart()['feedback_emoji_happy'],
								'borderColor' => '#6c94ed',
								'fill'        => false,
							],
							(object) [
								'label'       => 'Excited',
								'data'        => $this->log_chart()['feedback_emoji_excited'],
								'borderColor' => '#4aed92',
								'fill'        => false,
							],
						];

						?>
                        <div class="chart-container">
                            <canvas id="emoji_chart" data-title="Feedback Submissions" data-labels='<?php echo $this->log_chart()['labels']; ?>' data-sets='<?php echo json_encode( $data_sets ); ?>'></canvas>
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

	public function render_tables() {

		echo '<div class="statistics-tables">';
		if ( 'EMOJI_FEEDBACK' == $this->type ) {
			include TOTO_INCLUDES . '/admin/views/pages/statistics-top-emoji.php';
		}

		if ( 'EMAIL_COLLECTOR' == $this->type ) {
			include TOTO_INCLUDES . '/admin/views/pages/statistics-submitted-email.php';
		}

		include TOTO_INCLUDES . '/admin/views/pages/statistics-top-pages.php';
		echo '</div>';
	}

	public function get_top_emoji() {
		global $wpdb;

		$table = $wpdb->prefix . 'toto_notification_statistics';

		$nid        = intval( $this->query_args['nid'] );
		$start_date = esc_attr( $this->query_args['start_date'] );
		$end_date   = esc_attr( $this->query_args['end_date'] );

		$per_page = ! empty( $this->query_args['per_page'] ) ? intval( $this->query_args['per_page'] ) : 10;
		$page     = ! empty( $this->query_args['page'] ) ? intval( $this->query_args['page'] ) : 1;
		$offset   = $per_page * ( $page - 1 );

		$where = " WHERE notification_id = {$nid} ";

		$where .= " AND (`created_at` BETWEEN '{$start_date}' AND '{$end_date}')";
		$where .= " AND `type` LIKE 'feedback_emoji_%'";


		$sql = "SELECT
                     `type`,
                     COUNT(`id`) AS `total`
                FROM {$table} {$where}
                GROUP BY
                    `type`
                ORDER BY
                    `total` DESC
                LIMIT {$offset}, {$per_page}
                ";

		return $wpdb->get_results( $sql );
	}

	public function get_submitted_email() {
		global $wpdb;

		$table = $wpdb->prefix . 'toto_notification_statistics';

		$nid        = intval( $this->query_args['nid'] );
		$start_date = esc_attr( $this->query_args['start_date'] );
		$end_date   = esc_attr( $this->query_args['end_date'] );

		$per_page = ! empty( $this->query_args['per_page'] ) ? intval( $this->query_args['per_page'] ) : 10;
		$page     = ! empty( $this->query_args['page'] ) ? intval( $this->query_args['page'] ) : 1;
		$offset   = $per_page * ( $page - 1 );

		$where = " WHERE notification_id = {$nid} ";

		$where .= " AND (`created_at` BETWEEN '{$start_date}' AND '{$end_date}')";
		$where .= " AND `type` = 'submissions' ";


		$sql = "SELECT
                     `data` AS `email`,
                     `ip`,
                     `url`
                FROM {$table} {$where}
                GROUP BY
                    `data`
                ORDER BY
                    `created_at` DESC
                LIMIT {$offset}, {$per_page}
                ";

		return $wpdb->get_results( $sql );
	}


}