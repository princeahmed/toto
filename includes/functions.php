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

/* Generate chart data for based on the date key and each of keys inside */
function toto_get_chart_data( $main_array = [] ) {

	$results = [];

	foreach ( $main_array as $date_label => $data ) {

		foreach ( $data as $label_key => $label_value ) {

			if ( ! isset( $results[ $label_key ] ) ) {
				$results[ $label_key ] = [];
			}

			$results[ $label_key ][] = $label_value;

		}

	}

	foreach ( $results as $key => $value ) {
		$results[ $key . '_total' ] = array_sum( $results[ $key ] );
		$results[ $key ]            = '["' . implode( '", "', $value ) . '"]';
	}

	$results['labels'] = '["' . implode( '", "', array_keys( $main_array ) ) . '"]';

	return $results;
}
