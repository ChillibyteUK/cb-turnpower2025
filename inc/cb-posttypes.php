<?php
/**
 * Custom Post Types Registration
 *
 * This file contains the code to register custom post types for the theme.
 *
 * @package cb-turnpower2025
 */

/**
 * Register custom post types for the theme.
 *
 * This function registers a custom post type called 'people'.
 * The post type is set to be publicly queryable, has a UI in the admin,
 * and supports REST API.
 *
 * @return void
 */
function cb_register_post_types() {

	register_post_type(
		'clients',
		array(
			'labels'             => array(
				'name'               => 'Clients',
				'singular_name'      => 'Clients',
				'add_new_item'       => 'Add New Client',
				'edit_item'          => 'Edit Client',
				'new_item'           => 'New Client',
				'view_item'          => 'View Client',
				'search_items'       => 'Search Clients',
				'not_found'          => 'No clients found',
				'not_found_in_trash' => 'No clients in trash',
			),
			'has_archive'        => false,
			'publicly_queryable' => true, // (keeps single pages accessible)
			'public'             => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 25,
			'menu_icon'          => 'dashicons-groups',
			'supports'           => array( 'title', 'thumbnail', 'editor' ),
			'capability_type'    => 'post',
			'map_meta_cap'       => true,
			'rewrite'            => array(
				'slug'       => 'our-clients',
				'with_front' => false,
			),
		),
	);

	register_post_type(
		'careers',
		array(
			'labels'             => array(
				'name'               => 'Careers',
				'singular_name'      => 'Career',
				'add_new_item'       => 'Add New Career',
				'edit_item'          => 'Edit Career',
				'new_item'           => 'New Career',
				'view_item'          => 'View Career',
				'search_items'       => 'Search Careers',
				'not_found'          => 'No careers found',
				'not_found_in_trash' => 'No careers in trash',
			),
			'has_archive'        => false,
			'publicly_queryable' => false, // (keeps single pages accessible)
			'public'             => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 25,
			'menu_icon'          => 'dashicons-nametag',
			'supports'           => array( 'title', 'thumbnail', 'editor' ),
			'capability_type'    => 'post',
			'map_meta_cap'       => true,
			'rewrite'            => false,
		),
	);

	register_post_type(
		'testimonials',
		array(
			'labels'             => array(
				'name'               => 'Testimonials',
				'singular_name'      => 'Testimonial',
				'add_new_item'       => 'Add New Testimonial',
				'edit_item'          => 'Edit Testimonial',
				'new_item'           => 'New Testimonial',
				'view_item'          => 'View Testimonial',
				'search_items'       => 'Search Testimonials',
				'not_found'          => 'No testimonials found',
				'not_found_in_trash' => 'No testimonials in trash',
			),
			'has_archive'        => false,
			'publicly_queryable' => false, // (keeps single pages accessible)
			'public'             => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 25,
			'menu_icon'          => 'dashicons-testimonial',
			'supports'           => array( 'title', 'thumbnail', 'editor' ),
			'capability_type'    => 'post',
			'map_meta_cap'       => true,
			'rewrite'            => false,
		),
	);
}
add_action( 'init', 'cb_register_post_types' );
