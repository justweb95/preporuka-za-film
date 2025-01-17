<?php
// Register Custom Post Type for Movies
function create_movie_post_type() {

    $labels = array(
        'name'                  => 'Movies',
        'singular_name'         => 'Movie',
        'menu_name'             => 'Movies',
        'name_admin_bar'        => 'Movie',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Movie',
        'new_item'              => 'New Movie',
        'edit_item'             => 'Edit Movie',
        'view_item'             => 'View Movie',
        'all_items'             => 'All Movies',
        'search_items'          => 'Search Movies',
        'parent_item_colon'     => 'Parent Movies:',
        'not_found'             => 'No movies found.',
        'not_found_in_trash'    => 'No movies found in Trash.',
        'featured_image'        => 'Movie Poster',
        'set_featured_image'    => 'Set movie poster',
        'remove_featured_image' => 'Remove movie poster',
        'use_featured_image'    => 'Use as movie poster',
        'archives'              => 'Movie Archives',
        'insert_into_item'      => 'Insert into movie',
        'uploaded_to_this_item' => 'Uploaded to this movie',
        'filter_items_list'     => 'Filter movies list',
        'items_list_navigation' => 'Movies list navigation',
        'items_list'            => 'Movies list',
    );

    $args = array(
        'label'                 => 'Movie',
        'description'           => 'A custom post type for movies.',
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-video-alt2', // Dashicon for Movies
        'can_export'            => true,
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'single-movie' ),
        'show_in_rest'          => true, // Enable Gutenberg editor
        'rest_base'             => 'movies',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type( 'movie', $args );
}
add_action( 'init', 'create_movie_post_type', 0 );


add_action( 'wp_ajax_save_movie', 'save_movie' );
add_action( 'wp_ajax_nopriv_save_movie', 'save_movie' );

// Enqueue the custom JavaScript for the frontend
function enqueue_movie_frontend_scripts() {
    // Enqueue the anketa.js script located in the specified directory (without jQuery dependency)
    wp_enqueue_script( 'home-js', get_template_directory_uri() . '/resources/scripts/pages/home.js', array(), null, true );
    
    // Localize the script to pass Ajax URL and nonce to JavaScript
    wp_localize_script( 'home-js', 'movieAjax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ), // URL for AJAX requests
        'nonce' => wp_create_nonce( 'movie_nonce' ),  // Security nonce
    ));
}
add_action( 'wp_enqueue_scripts', 'enqueue_movie_frontend_scripts' );

function allow_cross_origin_requests() {
    // Check if it's a local development request from a specific domain
    if ( isset( $_SERVER['HTTP_ORIGIN'] ) ) {
        $allowed_origins = array( 'http://localhost:4000' ); // Add your allowed origin here

        if ( in_array( $_SERVER['HTTP_ORIGIN'], $allowed_origins ) ) {
            header( 'Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN'] );
            header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS' );
            header( 'Access-Control-Allow-Headers: Content-Type, X-Requested-With' );
        }
    }
}
add_action( 'init', 'allow_cross_origin_requests' );

// Handle the fetch request to create a new movie post
function save_movie() {
    // Check nonce for security (optional, remove if not needed)
    if ( !isset( $_POST['nonce'] ) ) {
        error_log('Nonce not set.');
        wp_send_json_error( 'Nonce not set' );
        return;
    }

    // Log received nonce for debugging
    error_log('Nonce received: ' . $_POST['nonce']);  // Check the nonce received

    // Retrieve the data from the frontend
    $movie_id = isset( $_POST['movie_id'] ) ? sanitize_text_field( $_POST['movie_id'] ) : ''; // Custom movie ID
    $title = isset( $_POST['title'] ) ? sanitize_text_field( $_POST['title'] ) : ''; // Movie title
    $content = isset( $_POST['content'] ) ? sanitize_textarea_field( $_POST['content'] ) : 'Pavle'; // Movie content


    // Ensure the necessary data is provided
    if ( empty( $movie_id ) || empty( $title ) || empty( $content ) ) {
        wp_send_json_error( 'Missing required data (movie_id, title, or content).'. $content . 'content' . $title . 'title' . $movie_id );
        return;
    }

    // Prepare the post data to create the new movie post
    $post_data = array(
        'post_id'      => $movie_id,
        'post_title'   => $title . '-' . $movie_id,
        'post_content' => $content,
        'post_status'  => 'publish',  // Ensure the post is published
        'post_type'    => 'movie',    // Custom post type 'movie'
        'post_author'  => get_current_user_id(),  // Set the author (current logged-in user)
    );

    // Insert the new movie post
    $post_id = wp_insert_post( $post_data );

    if ( $post_id ) {
        // Assign the custom movie_id as post meta
        update_post_meta( $post_id, 'movie_id', $movie_id );

        // Return success response with post ID
        wp_send_json_success( array( 'message' => 'Movie created successfully!', 'post_id' => $post_id, 'movie_id' => $movie_id ) );
    } else {
        // Return failure response
        wp_send_json_error( 'Failed to create movie.' );
    }
}



?>