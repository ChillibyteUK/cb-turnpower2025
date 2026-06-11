<?php
/**
 * Custom taxonomies for the Turnpower theme.
 *
 * This file defines and registers custom taxonomies such as 'Teams' and 'Offices'.
 *
 * @package cb-turnpower2025
 */

/**
 * Register custom taxonomies for the theme.
 *
 * This function registers two custom taxonomies: 'Teams' and 'Offices'.
 * Both taxonomies are hierarchical and associated with the 'people' post type.
 * The taxonomies are set to be publicly queryable, have a UI in the admin,
 * and support REST API.
 *
 * @return void
 */
function cb_register_taxes() {

    $args = array(
        'labels'             => array(
            'name'          => 'Sectors',
            'singular_name' => 'Sector',
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'hierarchical'       => true,
        'show_ui'            => true,
        'show_in_nav_menus'  => true,
        'show_tagcloud'      => false,
        'show_in_quick_edit' => true,
        'show_admin_column'  => true,
        'show_in_rest'       => true,
        'rewrite'            => false,
    );
    register_taxonomy( 'sectors', array( 'clients', 'testimonials' ), $args );


    $args = [
        "label" => __( "CS Services", "cb-synecore2023" ),
        "labels" => [
            "name" => __( "CS Services", "cb-synecore2023" ),
            "singular_name" => __( "CS Service", "cb-synecore2023" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "service", [ "projects" ], $args );
}
add_action( 'init', 'cb_register_taxes' );
