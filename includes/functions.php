<?php

defined( 'ABSPATH' ) || exit;

function toto_locations() {

	return array(
		'is_front_page' => __( 'Front Page', 'toto' ),
		'is_home'       => __( 'Blog Page', 'toto' ),
		'is_singular'   => __( 'All Posts, Pages and Custom Post Types', 'toto' ),
		'is_single'     => __( 'All Posts', 'toto' ),
		'is_page'       => __( 'All Pages', 'toto' ),
		'is_attachment' => __( 'All Attachments', 'toto' ),
		'is_search'     => __( 'Search Results', 'toto' ),
		'is_404'        => __( '404 Error Page', 'toto' ),
		'is_archive'    => __( 'All Archives', 'toto' ),
		'is_category'   => __( 'All Category Archives', 'toto' ),
		'is_tag'        => __( 'All Tag Archives', 'toto' ),
		'is_custom'     => __( 'Custom Post or Page IDs', 'toto' ),
	);
}

function toto_get_user_ip() {
	if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		return $_SERVER['HTTP_CLIENT_IP'];
	} else if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else if ( isset( $_SERVER['HTTP_X_FORWARDED'] ) ) {
		return $_SERVER['HTTP_X_FORWARDED'];
	} else if ( isset( $_SERVER['HTTP_FORWARDED_FOR'] ) ) {
		return $_SERVER['HTTP_FORWARDED_FOR'];
	} else if ( isset( $_SERVER['HTTP_FORWARDED'] ) ) {
		return $_SERVER['HTTP_FORWARDED'];
	} else if ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
		return $_SERVER['REMOTE_ADDR'];
	} else {
		return 'UNKNOWN';
	}
}

function toto_get_options( $key, $default = null ) {
	$settings = get_option( 'toto_options' );

	return ! empty( $settings[ $key ] ) ? $settings[ $key ] : $default;
}

function toto_get_n_data( $args = [] ) {
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

function toto_get_chart_data( $args = [] ) {

	/**
	 * Get the statistics date from database
	 */ global $wpdb;
	$table = $wpdb->prefix . 'toto_notification_statistics';

	$args = array_merge( [
		//'page'       => 1,
		'per_page'   => 10,
		'start_date' => date( 'Y-m-d', strtotime( '-7 days' ) ),
		'end_date'   => date( 'Y-m-d' ),
	], $args );

	$nid = esc_attr( $args['nid'] );
	//$page       = intval( $args['page'] );
	$per_page   = intval( $args['per_page'] );
	$start_date = esc_attr( $args['start_date'] );
	$end_date   = esc_attr( $args['end_date'] );

	//$offset = $per_page * ( $page - 1 );

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
            LIMIT {$per_page}
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

function toto_get_top_pages( $args = [] ) {
	global $wpdb;

	$table = $wpdb->prefix . 'toto_notification_statistics';

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

function toto_get_timeago( $date ) {

	$estimate_time = time() - ( new \DateTime( $date ) )->getTimestamp();

	if ( $estimate_time < 1 ) {
		return 'now';
	}

	$condition = [
		12 * 30 * 24 * 60 * 60 => 'year',
		30 * 24 * 60 * 60      => 'month',
		24 * 60 * 60           => 'day',
		60 * 60                => 'hour',
		60                     => 'minute',
		1                      => 'second'
	];

	foreach ( $condition as $secs => $str ) {
		$d = $estimate_time / $secs;

		if ( $d >= 1 ) {
			$r = round( $d );

			/* Determine the language string needed */
			$language_string_time = $r > 1 ? $str . 's' : $str;

			return $r . ' ' . $language_string_time . ' ago';
		}
	}
}

function toto_branding( $notification ) {
	if ( $notification->display_branding ) {
		if ( isset( $notification->branding ) && ! empty( $notification->branding->name ) && ! empty( $notification->branding->url ) ) {
			printf( '<a href="%s" class="toto-site">%s</a>', $notification->branding->url, $notification->branding->name );
		} else {
			echo '<a href="#" class="toto-site">🔥 by Toto</a>';
		}
	}
}

