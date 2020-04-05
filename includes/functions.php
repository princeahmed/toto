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

function toto_should_show( $post_id ) {

	$trigger_on = get_post_meta( $post_id, '_settings', true );

	if ( empty( $trigger_on['trigger_on'] ) ) {
		return true;
	}

	$trigger_on = $trigger_on['trigger_on'];

	if ( $trigger_on == 'all' ) {
		return true;
	}

	$locations = get_post_meta( $post_id, '_settings', true );

	if ( empty( $locations['trigger_locations'] ) ) {
		return true;
	}

	$locations = $locations['trigger_locations'];

	if ( in_array( 'is_custom', $locations ) ) {
		$ids = get_post_meta( $post_id, '_settings', true )['custom_post_page_ids'];

		$ids = explode( ',', $ids );

		foreach ( $ids as $id ) {
			$id = trim( $id );

			if ( ! is_numeric( $id ) ) {
				continue;
			}

			if ( is_page( $id ) || is_single( $id ) ) {
				return true;
			}

		}

	}

	$fields = array(
		'is_front_page' => is_front_page(),
		'is_home'       => is_home(),
		'is_singular'   => is_singular(),
		'is_single'     => is_single(),
		'is_page'       => is_page(),
		'is_attachment' => is_attachment(),
		'is_search'     => is_search(),
		'is_404'        => is_404(),
		'is_archive'    => is_archive(),
		'is_category'   => is_category(),
	);

	foreach ( $locations as $location ) {
		if ( empty( $fields[ $location ] ) || ! $fields[ $location ] ) {
			continue;
		}

		return true;

	}

	return false;
}
