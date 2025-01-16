<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });





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
        'rewrite'               => array( 'slug' => 'movies' ),
        'show_in_rest'          => true, // Enable Gutenberg editor
        'rest_base'             => 'movies',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type( 'movie', $args );
}
add_action( 'init', 'create_movie_post_type', 0 );