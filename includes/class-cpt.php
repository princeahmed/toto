<?php

defined( 'ABSPATH' ) || exit();

class Trust_Plus_CPT {

	/**
	 * Post_Types constructor.
	 */
	function __construct() {
		add_action( 'init', [ $this, 'register_post_types' ] );
		add_action( 'init', [ $this, 'flush_rewrite_rules' ], 99 );
	}

	/**
	 * register custom post types
	 *
	 * @since 1.0.0
	 */
	function register_post_types() {
		register_post_type( 'trust_plus', array(
			'labels'        => $this::get_posts_labels( __( 'Notifications', 'wp-plugin-boilerplate' ), __( 'Notification', 'wp-plugin-boilerplate' ), __( 'Notifications', 'wp-plugin-boilerplate' ) ),
			'supports'      => [ 'title' ],
			'show_ui'      => true,
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-megaphone',
		) );
	}


	/**
	 * Get all labels from post types
	 *
	 * @param $menu_name
	 * @param $singular
	 * @param $plural
	 *
	 * @return array
	 * @since 1.0.0
	 */
	protected static function get_posts_labels( $menu_name, $singular, $plural, $type = 'plural' ) {
		$labels = array(
			'name'               => 'plural' == $type ? $plural : $singular,
			'all_items'          => sprintf( __( "All %s", 'wp-plugin-boilerplate' ), $plural ),
			'singular_name'      => $singular,
			'add_new'            => sprintf( __( 'Add New', 'wp-plugin-boilerplate' ), $singular ),
			'add_new_item'       => sprintf( __( 'Add New %s', 'wp-plugin-boilerplate' ), $singular ),
			'edit_item'          => sprintf( __( 'Edit %s', 'wp-plugin-boilerplate' ), $singular ),
			'new_item'           => sprintf( __( 'New %s', 'wp-plugin-boilerplate' ), $singular ),
			'view_item'          => sprintf( __( 'View %s', 'wp-plugin-boilerplate' ), $singular ),
			'search_items'       => sprintf( __( 'Search %s', 'wp-plugin-boilerplate' ), $plural ),
			'not_found'          => sprintf( __( 'No %s found', 'wp-plugin-boilerplate' ), $plural ),
			'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'wp-plugin-boilerplate' ), $plural ),
			'parent_item_colon'  => sprintf( __( 'Parent %s:', 'wp-plugin-boilerplate' ), $singular ),
			'menu_name'          => $menu_name,
		);

		return $labels;
	}

	/**
	 * Flash The Rewrite Rules
	 *
	 * @since 2.0.2
	 */
	function flush_rewrite_rules() {
		if ( get_option( 'trust_plus_flush_rewrite_rules' ) ) {
			flush_rewrite_rules();
			delete_option( 'trust_plus_flush_rewrite_rules' );
		}
	}
}

new Trust_Plus_CPT();