<?php

 
add_action( 'init', 'wpdocs_codex_Gallerie_init' );
add_action( 'init', 'create_book_taxonomies', 0 );
/**
 * Register a custom post type called "Gallerie".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_Gallerie_init() {
    $labels = array(
        'name'                  => _x( 'Mes Galleries', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Gallerie', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Mes Galleries', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Gallerie', 'Ajouter une Gallerie', 'textdomain' ),
        'add_new'               => __( 'Ajouter une Gallerie', 'textdomain' ),
        'add_new_item'          => __( 'Ajouter une Gallerie', 'textdomain' ),
        'new_item'              => __( 'Nouvelle Gallerie', 'textdomain' ),
        'edit_item'             => __( 'Editer Gallerie', 'textdomain' ),
        'view_item'             => __( 'Voir mes Gallerie', 'textdomain' ),
        'all_items'             => __( 'Toutes Mes Galleries', 'textdomain' ),
        'search_items'          => __( 'Rechercher des Galleries', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Mes Galleries:', 'textdomain' ),
        'not_found'             => __( 'Pas de Galleries trouvé.', 'textdomain' ),
        'not_found_in_trash'    => __( 'Pas de Galleries trouvé dans la corbeille.', 'textdomain' ),
        'featured_image'        => _x( 'Gallerie Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Gallerie archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into Gallerie', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Gallerie', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter Mes Galleries list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Mes Galleries list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Mes Galleries list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'Gallerie' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
 
    register_post_type( 'Gallerie', $args );
}

// create two taxonomies, genres and writers for the post type "book"
function create_book_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Genres', 'textdomain' ),
		'all_items'         => __( 'All Genres', 'textdomain' ),
		'parent_item'       => __( 'Parent Genre', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
		'edit_item'         => __( 'Edit Genre', 'textdomain' ),
		'update_item'       => __( 'Update Genre', 'textdomain' ),
		'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
		'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
		'menu_name'         => __( 'Genre', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	register_taxonomy( 'genre', array( 'Galleie' ), $args );
}