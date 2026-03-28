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
        'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-video-alt2', // Dashicon for Movies
        'can_export'            => true,
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'single-movie', 'paged' => true ),
        'rest_base'             => 'movies',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'taxonomies'            => array( 'category', 'tags', 'paged' ), // Enable categories
    );

    register_post_type( 'movie', $args );
}

add_action( 'init', 'create_movie_post_type', 0 );


    // // Enqueue the custom JavaScript for the frontend
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



    function save_movie() {
        // Get the movie data object from the POST request
        $movie_data = isset( $_POST['movie_data'] ) ? json_decode( stripslashes( $_POST['movie_data'] ), true ) : null;

        // Extract values from the movie_data object
        $movie_id = isset($movie_data['movie_data']['id']) ? sanitize_text_field($movie_data['movie_data']['id']) : '';
        $title = isset($movie_data['movie_data']['title']) ? sanitize_text_field($movie_data['movie_data']['title']) : '';
        $content = isset($movie_data['movie_data']['overview']) ? sanitize_textarea_field($movie_data['movie_data']['overview']) : '';
        $adult = isset($movie_data['movie_data']['adult']) ? $movie_data['movie_data']['adult'] : false;
        $backdrop_path = isset($movie_data['movie_data']['backdrop_path']) ? sanitize_text_field($movie_data['movie_data']['backdrop_path']) : '';
        $poster_path = isset($movie_data['movie_data']['poster_path']) ? sanitize_text_field($movie_data['movie_data']['poster_path']) : '';

        $director = isset($movie_data['movie_data']['single_movie_director']) ? 
            array_map(function($item) {
                return isset($item['name']) ? sanitize_text_field($item['name']) : '';
            }, $movie_data['movie_data']['single_movie_director']) : 
            array();

        $writing = isset($movie_data['movie_data']['single_movie_writer']) ? 
            array_map(function($item) {
                return isset($item['name']) ? sanitize_text_field($item['name']) : '';
            }, $movie_data['movie_data']['single_movie_writer']) : 
            array();

        $cast = isset($movie_data['movie_data']['single_movie_cast']) ? 
            array_map(function($item) {
                return isset($item['name']) ? sanitize_text_field($item['name']) : '';
            }, $movie_data['movie_data']['single_movie_cast']) : 
            array();

        $budget = isset($movie_data['movie_data']['budget']) ? intval($movie_data['movie_data']['budget']) : 0;
        $genres = isset($movie_data['movie_data']['genres']) ? sanitize_text_field($movie_data['movie_data']['genres']) : [];
        $homepage = isset($movie_data['movie_data']['homepage']) ? esc_url_raw($movie_data['movie_data']['homepage']) : '';
        $imdb_id = isset($movie_data['movie_data']['imdb_id']) ? sanitize_text_field($movie_data['movie_data']['imdb_id']) : '';
        $watch_link = isset($movie_data['movie_data']['movie_watch_on']['link']) ? esc_url_raw($movie_data['movie_data']['movie_watch_on']['link']) : '';
        $production_companies = isset($movie_data['movie_data']['production_companies']) ? json_encode($movie_data['movie_data']['production_companies']) : [];
        $release_date = isset($movie_data['movie_data']['release_date']) ? sanitize_text_field($movie_data['movie_data']['release_date']) : '';
        $runtime = isset($movie_data['movie_data']['runtime']) ? intval($movie_data['movie_data']['runtime']) : 0;
        $status = isset($movie_data['movie_data']['status']) ? sanitize_text_field($movie_data['movie_data']['status']) : '';
        $tagline = isset($movie_data['movie_data']['tagline']) ? sanitize_text_field($movie_data['movie_data']['tagline']) : '';
        $vote_average = isset($movie_data['movie_data']['vote_average']) ? floatval($movie_data['movie_data']['vote_average']) : 0;
        $vote_count = isset($movie_data['movie_data']['vote_count']) ? intval($movie_data['movie_data']['vote_count']) : 0;
        $video_trailer = isset($movie_data['movie_data']['video_trailer']) ? json_encode($movie_data['movie_data']['video_trailer']) : '';

        // Check if the movie already exists by checking the movie_id in the database
        $existing_movie = get_posts( array(
            'post_type'   => 'movie',
            'meta_key'    => 'movie_id',
            'meta_value'  => $movie_id,
            'post_status' => 'any',
            'numberposts' => 1,
        ) );

        if ( $existing_movie ) {
            $post_url = get_permalink($existing_movie[0]->ID);
            wp_send_json_success(array( 'message' => 'Movie with this ID already exists', 'post_url' => $post_url ));
            return;
        }
        
        $genres = sanitize_text_field($genres);
        $our_recommendations = 'false';

        $category_id = wp_create_category($genres);
        $post_data = array(
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'publish', 
            'post_type'    => 'movie',
            'post_author'  => get_current_user_id(),            
        );
        
        // Insert the new movie post
        $post_id = wp_insert_post( $post_data );
        // Check if the post was created successfully
        if ( $post_id ) {
            wp_update_post(array(
                'ID' => $post_id,
                'comment_status' => 'open' // Set to 'closed' if you want to disable comments
            ));
            // Save category
            wp_set_post_categories($post_id, array($category_id)); 
            // Save additional metadata
            update_post_meta($post_id, 'movie_id', $movie_id);
            update_post_meta($post_id, 'adult', $adult);
            update_post_meta($post_id, 'backdrop_path', $backdrop_path);
            update_post_meta($post_id, 'poster_path', $poster_path);
            update_post_meta($post_id, 'budget', $budget);
            update_post_meta($post_id, 'genres', $genres);
            update_post_meta($post_id, 'homepage', $homepage);
            update_post_meta($post_id, 'imdb_id', $imdb_id);
            update_post_meta($post_id, 'watch_link', $watch_link);
            update_post_meta($post_id, 'production_companies', $production_companies);
            update_post_meta($post_id, 'release_date', $release_date);
            update_post_meta($post_id, 'runtime', $runtime);
            update_post_meta($post_id, 'status', $status);
            update_post_meta($post_id, 'tagline', $tagline);
            update_post_meta($post_id, 'vote_average', $vote_average);
            update_post_meta($post_id, 'vote_count', $vote_count);
            update_post_meta($post_id, 'director', $director);
            update_post_meta($post_id, 'cast', $cast);
            update_post_meta($post_id, 'writing', $writing);
            update_post_meta($post_id, 'video_trailer', $video_trailer);
            update_post_meta($post_id, 'our_recommendations', $our_recommendations);

            $post_url = get_permalink($post_id);

            wp_send_json_success( array( 
                'message' => 'Movie created successfully!', 
                'post_url' => $post_url
            ));
        } else {
            wp_send_json_error( array( 'message' => 'Failed to create movie.' ) );
        }
    }

    add_action( 'wp_ajax_save_movie', 'save_movie' );
    add_action( 'wp_ajax_nopriv_save_movie', 'save_movie' );


    function pzfilm_fetch_tmdb_movie_overview_en( $tmdb_movie_id ) {
        $tmdb_api_key = env( 'PUBLIC_TMDB_API_KEY' );

        if ( empty( $tmdb_api_key ) || empty( $tmdb_movie_id ) ) {
            return new WP_Error( 'missing_tmdb_config', 'TMDB konfiguracija nije dostupna.' );
        }

        $response = wp_remote_get(
            sprintf( 'https://api.themoviedb.org/3/movie/%d?language=en-US', absint( $tmdb_movie_id ) ),
            array(
                'headers' => array(
                    'accept'        => 'application/json',
                    'Authorization' => 'Bearer ' . $tmdb_api_key,
                ),
                'timeout' => 20,
            )
        );

        if ( is_wp_error( $response ) ) {
            return $response;
        }

        $status_code = wp_remote_retrieve_response_code( $response );
        $body = json_decode( wp_remote_retrieve_body( $response ), true );

        if ( 429 === (int) $status_code ) {
            $retry_after = (int) wp_remote_retrieve_header( $response, 'retry-after' );
            return new WP_Error(
                'tmdb_rate_limited',
                'TMDB limit je dostignut.',
                array(
                    'status'      => 429,
                    'retry_after' => $retry_after,
                )
            );
        }

        if ( $status_code >= 400 || empty( $body['overview'] ) ) {
            return new WP_Error( 'tmdb_overview_missing', 'Engleski opis nije dostupan na TMDB-u.' );
        }

        return sanitize_textarea_field( $body['overview'] );
    }

    function pzfilm_clean_translated_movie_overview( $text ) {
        $text = wp_strip_all_tags( $text );
        $text = preg_replace( '/\[\d+(?:\s*,\s*\d+)*\]/', '', $text );
        $text = preg_replace( '/https?:\/\/\S+/i', '', $text );
        $text = preg_replace( '/[`*_#>]/', '', $text );
        $text = preg_replace( '/\s+/', ' ', $text );

        return sanitize_textarea_field( trim( $text ) );
    }

    function pzfilm_is_valid_translated_movie_overview( $translated_text, $source_text ) {
        $translated_length = function_exists( 'mb_strlen' ) ? mb_strlen( $translated_text ) : strlen( $translated_text );
        $source_length = function_exists( 'mb_strlen' ) ? mb_strlen( $source_text ) : strlen( $source_text );

        if ( $translated_length < 20 ) {
            return false;
        }

        if ( $source_length > 0 ) {
            $ratio = $translated_length / $source_length;

            if ( $ratio < 0.45 || $ratio > 1.8 ) {
                return false;
            }
        }

        if ( preg_match( '/\[[0-9,\s]+\]/', $translated_text ) ) {
            return false;
        }

        if ( preg_match( '/https?:\/\//i', $translated_text ) ) {
            return false;
        }

        if ( preg_match( '/\*\*|__|```/', $translated_text ) ) {
            return false;
        }

        if ( preg_match( '/^(evo|naravno|prevod|opis:|translated)/i', $translated_text ) ) {
            return false;
        }

        return true;
    }

    function pzfilm_translate_movie_overview_to_serbian( $text ) {
        $perplexity_api_key = env( 'PUBLIC_PERPLEXITY_API_KEY' );

        if ( empty( $perplexity_api_key ) ) {
            return new WP_Error( 'missing_translation_config', 'Prevod servis nije konfigurisan.' );
        }

        $payload = array(
            'model' => 'sonar',
            'messages' => array(
                array(
                    'role'    => 'system',
                    'content' => 'You are a strict translator. Translate only the exact movie synopsis provided by the user into natural Serbian Latin. Do not use web search, outside knowledge, citations, markdown, notes, introductions, conclusions, or added facts. Return only one clean translated paragraph.',
                ),
                array(
                    'role'    => 'user',
                    'content' => "Translate only the text inside <overview> tags to Serbian Latin and return only the translation. <overview>{$text}</overview>",
                ),
            ),
            'temperature' => 0,
            'max_tokens'  => 500,
        );

        $response = wp_remote_post(
            'https://api.perplexity.ai/chat/completions',
            array(
                'headers' => array(
                    'Authorization' => 'Bearer ' . $perplexity_api_key,
                    'Content-Type'  => 'application/json',
                ),
                'body'    => wp_json_encode( $payload ),
                'timeout' => 30,
            )
        );

        if ( is_wp_error( $response ) ) {
            return $response;
        }

        $status_code = wp_remote_retrieve_response_code( $response );
        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        $translated_text = trim( $body['choices'][0]['message']['content'] ?? '' );
        $translated_text = pzfilm_clean_translated_movie_overview( $translated_text );

        if ( $status_code >= 400 || empty( $translated_text ) ) {
            return new WP_Error( 'translation_failed', 'Prevod opisa nije uspeo.' );
        }

        if ( ! pzfilm_is_valid_translated_movie_overview( $translated_text, $text ) ) {
            return new WP_Error( 'translation_invalid', 'Prevedeni opis nije validan.' );
        }

        return $translated_text;
    }

    function refresh_movie_description() {
        check_ajax_referer( 'pzfilm_global_nonce', 'nonce' );

        $post_id = isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0;
        $tmdb_movie_id = isset( $_POST['tmdb_movie_id'] ) ? absint( $_POST['tmdb_movie_id'] ) : 0;

        if ( ! $post_id || ! $tmdb_movie_id ) {
            wp_send_json_error( array( 'message' => 'Nedostaju podaci za opis filma.' ), 400 );
        }

        $post = get_post( $post_id );

        if ( ! $post || 'movie' !== $post->post_type ) {
            wp_send_json_error( array( 'message' => 'Film nije pronađen.' ), 404 );
        }

        $rate_limited_until = absint( get_post_meta( $post_id, 'tmdb_movie_description_rate_limited_until', true ) );
        if ( $rate_limited_until && time() < $rate_limited_until ) {
            // Avoid hammering TMDB/OpenAI when we already know we are rate-limited.
            wp_send_json_success( array( 'overview' => '', 'source' => 'rate_limited' ) );
        }

        $current_content = trim( wp_strip_all_tags( $post->post_content ) );

        if ( ! empty( $current_content ) && 'Opis filma trenutno nije dostupan' !== $current_content ) {
            wp_send_json_success( array( 'overview' => $current_content, 'source' => 'database' ) );
        }

        $english_overview = pzfilm_fetch_tmdb_movie_overview_en( $tmdb_movie_id );

        if ( is_wp_error( $english_overview ) ) {
            if ( 'tmdb_rate_limited' === $english_overview->get_error_code() ) {
                $retry_after = absint( ( $english_overview->get_error_data()['retry_after'] ?? 0 ) );
                $cooldown = $retry_after ? $retry_after : ( 6 * HOUR_IN_SECONDS );
                update_post_meta( $post_id, 'tmdb_movie_description_rate_limited_until', time() + $cooldown );
                wp_send_json_success( array( 'overview' => '', 'source' => 'rate_limited' ) );
            }

            wp_send_json_error( array( 'message' => $english_overview->get_error_message() ), 500 );
        }

        $translated_overview = pzfilm_translate_movie_overview_to_serbian( $english_overview );

        if ( is_wp_error( $translated_overview ) ) {
            wp_send_json_error( array( 'message' => $translated_overview->get_error_message() ), 500 );
        }

        wp_update_post(
            array(
                'ID'           => $post_id,
                'post_content' => $translated_overview,
            )
        );

        wp_send_json_success( array( 'overview' => $translated_overview, 'source' => 'translated' ) );
    }

    add_action( 'wp_ajax_refresh_movie_description', 'refresh_movie_description' );
    add_action( 'wp_ajax_nopriv_refresh_movie_description', 'refresh_movie_description' );


function pzfilm_tmdb_profile_image_url( $profile_path ) {
    if ( empty( $profile_path ) ) {
        return '';
    }

    $profile_path = trim( (string) $profile_path );
    if ( '' === $profile_path ) {
        return '';
    }

    if ( '/' !== $profile_path[0] ) {
        $profile_path = '/' . $profile_path;
    }

    // Face-optimized size from TMDB.
    return 'https://media.themoviedb.org/t/p/w138_and_h175_face' . $profile_path;
}

function pzfilm_normalize_people_cache( $cache ) {
    if ( ! is_array( $cache ) ) {
        return array();
    }

    foreach ( array( 'directors', 'writers', 'cast' ) as $bucket ) {
        if ( empty( $cache[ $bucket ] ) || ! is_array( $cache[ $bucket ] ) ) {
            continue;
        }

        foreach ( $cache[ $bucket ] as $idx => $person ) {
            if ( ! is_array( $person ) ) {
                continue;
            }

            $profile_path = sanitize_text_field( $person['profile_path'] ?? '' );

            // Recompute the derived URL so old/bad cached values self-heal.
            $person['profile_path'] = $profile_path;
            $person['profile_url']  = $profile_path ? pzfilm_tmdb_profile_image_url( $profile_path ) : '';

            $cache[ $bucket ][ $idx ] = $person;
        }
    }

    return $cache;
}

function pzfilm_fetch_tmdb_movie_credits_en( $tmdb_movie_id ) {
    $tmdb_api_key = env( 'PUBLIC_TMDB_API_KEY' );
    $tmdb_movie_id = absint( $tmdb_movie_id );

    if ( empty( $tmdb_api_key ) || empty( $tmdb_movie_id ) ) {
        return new WP_Error( 'missing_tmdb_config', 'TMDB konfiguracija nije dostupna.' );
    }

    $cache_key = 'pzfilm_tmdb_movie_credits_en_' . $tmdb_movie_id;
    $cached = get_transient( $cache_key );
    if ( is_array( $cached ) ) {
        return $cached;
    }

    $response = wp_remote_get(
        sprintf( 'https://api.themoviedb.org/3/movie/%d/credits', $tmdb_movie_id ),
        array(
            'headers' => array(
                'accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $tmdb_api_key,
            ),
            'timeout' => 20,
        )
    );

    if ( is_wp_error( $response ) ) {
        return $response;
    }

    $status_code = wp_remote_retrieve_response_code( $response );
    $body = json_decode( wp_remote_retrieve_body( $response ), true );

    if ( 429 === (int) $status_code ) {
        $retry_after = (int) wp_remote_retrieve_header( $response, 'retry-after' );
        return new WP_Error( 'tmdb_rate_limited', 'TMDB limit je dostignut.', array( 'status' => 429, 'retry_after' => $retry_after ) );
    }

    if ( $status_code >= 400 || empty( $body ) || ! is_array( $body ) ) {
        return new WP_Error( 'tmdb_credits_failed', 'Ne mogu da povučem credits sa TMDB-a.' );
    }

    set_transient( $cache_key, $body, 12 * HOUR_IN_SECONDS );
    return $body;
}

function pzfilm_tmdb_movie_poster_url( $poster_path ) {
    if ( empty( $poster_path ) ) {
        return '';
    }

    $poster_path = trim( (string) $poster_path );
    if ( '' === $poster_path ) {
        return '';
    }

    if ( '/' !== $poster_path[0] ) {
        $poster_path = '/' . $poster_path;
    }

    return 'https://media.themoviedb.org/t/p/w300_and_h450_bestv2' . $poster_path;
}

function pzfilm_fetch_tmdb_person_details_en( $tmdb_person_id ) {
    $tmdb_api_key = env( 'PUBLIC_TMDB_API_KEY' );
    $tmdb_person_id = absint( $tmdb_person_id );

    if ( empty( $tmdb_api_key ) || empty( $tmdb_person_id ) ) {
        return new WP_Error( 'missing_tmdb_config', 'TMDB konfiguracija nije dostupna.' );
    }

    $cache_key = 'pzfilm_tmdb_person_details_en_' . $tmdb_person_id;
    $cached = get_transient( $cache_key );
    if ( is_array( $cached ) ) {
        return $cached;
    }

    $response = wp_remote_get(
        sprintf( 'https://api.themoviedb.org/3/person/%d?language=en-US', $tmdb_person_id ),
        array(
            'headers' => array(
                'accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $tmdb_api_key,
            ),
            'timeout' => 20,
        )
    );

    if ( is_wp_error( $response ) ) {
        return $response;
    }

    $status_code = wp_remote_retrieve_response_code( $response );
    $body = json_decode( wp_remote_retrieve_body( $response ), true );

    if ( 429 === (int) $status_code ) {
        $retry_after = (int) wp_remote_retrieve_header( $response, 'retry-after' );
        return new WP_Error( 'tmdb_rate_limited', 'TMDB limit je dostignut.', array( 'status' => 429, 'retry_after' => $retry_after ) );
    }

    if ( $status_code >= 400 || empty( $body ) || ! is_array( $body ) ) {
        return new WP_Error( 'tmdb_person_failed', 'Ne mogu da povučem podatke o glumcu sa TMDB-a.' );
    }

    set_transient( $cache_key, $body, 24 * HOUR_IN_SECONDS );
    return $body;
}

function pzfilm_fetch_tmdb_person_combined_credits_en( $tmdb_person_id ) {
    $tmdb_api_key = env( 'PUBLIC_TMDB_API_KEY' );
    $tmdb_person_id = absint( $tmdb_person_id );

    if ( empty( $tmdb_api_key ) || empty( $tmdb_person_id ) ) {
        return new WP_Error( 'missing_tmdb_config', 'TMDB konfiguracija nije dostupna.' );
    }

    $cache_key = 'pzfilm_tmdb_person_combined_credits_en_' . $tmdb_person_id;
    $cached = get_transient( $cache_key );
    if ( is_array( $cached ) ) {
        return $cached;
    }

    $response = wp_remote_get(
        sprintf( 'https://api.themoviedb.org/3/person/%d/combined_credits?language=en-US', $tmdb_person_id ),
        array(
            'headers' => array(
                'accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $tmdb_api_key,
            ),
            'timeout' => 20,
        )
    );

    if ( is_wp_error( $response ) ) {
        return $response;
    }

    $status_code = wp_remote_retrieve_response_code( $response );
    $body = json_decode( wp_remote_retrieve_body( $response ), true );

    if ( 429 === (int) $status_code ) {
        $retry_after = (int) wp_remote_retrieve_header( $response, 'retry-after' );
        return new WP_Error( 'tmdb_rate_limited', 'TMDB limit je dostignut.', array( 'status' => 429, 'retry_after' => $retry_after ) );
    }

    if ( $status_code >= 400 || empty( $body ) || ! is_array( $body ) ) {
        return new WP_Error( 'tmdb_person_credits_failed', 'Ne mogu da povučem filmografiju sa TMDB-a.' );
    }

    set_transient( $cache_key, $body, 24 * HOUR_IN_SECONDS );
    return $body;
}

function pzfilm_find_movie_post_id_by_tmdb_id( $tmdb_movie_id ) {
    $tmdb_movie_id = absint( $tmdb_movie_id );
    if ( ! $tmdb_movie_id ) {
        return 0;
    }

    $existing = get_posts(
        array(
            'post_type'      => 'movie',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'meta_key'       => 'movie_id',
            'meta_value'     => $tmdb_movie_id,
            'fields'         => 'ids',
        )
    );

    return ! empty( $existing ) ? absint( $existing[0] ) : 0;
}

function pzfilm_build_person_cache( $details, $combined_credits ) {
    $cache = array(
        'updated_at' => time(),
        'details'    => array(),
        'movies'     => array(),
    );

    $profile_path = sanitize_text_field( $details['profile_path'] ?? '' );

    $cache['details'] = array(
        'tmdb_id'              => absint( $details['id'] ?? 0 ),
        'name'                 => sanitize_text_field( $details['name'] ?? '' ),
        'known_for_department' => sanitize_text_field( $details['known_for_department'] ?? '' ),
        'biography'            => sanitize_textarea_field( $details['biography'] ?? '' ),
        'birthday'             => sanitize_text_field( $details['birthday'] ?? '' ),
        'deathday'             => sanitize_text_field( $details['deathday'] ?? '' ),
        'place_of_birth'       => sanitize_text_field( $details['place_of_birth'] ?? '' ),
        'gender'               => absint( $details['gender'] ?? 0 ),
        'imdb_id'              => sanitize_text_field( $details['imdb_id'] ?? '' ),
        'homepage'             => esc_url_raw( $details['homepage'] ?? '' ),
        'profile_path'         => $profile_path,
        'profile_url'          => $profile_path ? pzfilm_tmdb_profile_image_url( $profile_path ) : '',
    );

    $seen = array();
    $cast = is_array( $combined_credits['cast'] ?? null ) ? $combined_credits['cast'] : array();

    foreach ( $cast as $credit ) {
        $media_type = sanitize_text_field( $credit['media_type'] ?? '' );
        if ( 'movie' !== $media_type ) {
            continue;
        }

        $id = absint( $credit['id'] ?? 0 );
        if ( ! $id || isset( $seen[ $id ] ) ) {
            continue;
        }
        $seen[ $id ] = true;

        $title = sanitize_text_field( $credit['title'] ?? '' );
        if ( '' === $title ) {
            continue;
        }

        $release_date = sanitize_text_field( $credit['release_date'] ?? '' );
        $poster_path = sanitize_text_field( $credit['poster_path'] ?? '' );
        $character = sanitize_text_field( $credit['character'] ?? '' );

        $movie_post_id = pzfilm_find_movie_post_id_by_tmdb_id( $id );

        $cache['movies'][] = array(
            'tmdb_id'       => $id,
            'title'         => $title,
            'release_date'  => $release_date,
            'character'     => $character,
            'poster_path'   => $poster_path,
            'poster_url'    => $poster_path ? pzfilm_tmdb_movie_poster_url( $poster_path ) : '',
            'permalink'     => $movie_post_id ? get_permalink( $movie_post_id ) : '',
            'tmdb_url'      => sprintf( 'https://www.themoviedb.org/movie/%d', $id ),
            'vote_average'  => isset( $credit['vote_average'] ) ? floatval( $credit['vote_average'] ) : 0,
            'popularity'    => isset( $credit['popularity'] ) ? floatval( $credit['popularity'] ) : 0,
        );
    }

    usort(
        $cache['movies'],
        static function ( $a, $b ) {
            $ad = $a['release_date'] ?? '';
            $bd = $b['release_date'] ?? '';
            if ( $ad === $bd ) {
                return ( $b['popularity'] ?? 0 ) <=> ( $a['popularity'] ?? 0 );
            }
            return strcmp( $bd, $ad );
        }
    );

    $cache['movies'] = array_slice( $cache['movies'], 0, 60 );

    return $cache;
}

function pzfilm_build_person_details_cache( $details ) {
    $profile_path = sanitize_text_field( $details['profile_path'] ?? '' );

    return array(
        'updated_at'         => time(),
        'details_updated_at' => time(),
        'movies_updated_at'  => 0,
        'details'            => array(
            'tmdb_id'              => absint( $details['id'] ?? 0 ),
            'name'                 => sanitize_text_field( $details['name'] ?? '' ),
            'known_for_department' => sanitize_text_field( $details['known_for_department'] ?? '' ),
            'biography'            => sanitize_textarea_field( $details['biography'] ?? '' ),
            'birthday'             => sanitize_text_field( $details['birthday'] ?? '' ),
            'deathday'             => sanitize_text_field( $details['deathday'] ?? '' ),
            'place_of_birth'       => sanitize_text_field( $details['place_of_birth'] ?? '' ),
            'gender'               => absint( $details['gender'] ?? 0 ),
            'imdb_id'              => sanitize_text_field( $details['imdb_id'] ?? '' ),
            'homepage'             => esc_url_raw( $details['homepage'] ?? '' ),
            'profile_path'         => $profile_path,
            'profile_url'          => $profile_path ? pzfilm_tmdb_profile_image_url( $profile_path ) : '',
        ),
        'movies'             => array(),
    );
}

function pzfilm_build_person_movies_cache( $combined_credits ) {
    $movies = array();
    $seen = array();
    $cast = is_array( $combined_credits['cast'] ?? null ) ? $combined_credits['cast'] : array();

    foreach ( $cast as $credit ) {
        $media_type = sanitize_text_field( $credit['media_type'] ?? '' );
        if ( 'movie' !== $media_type ) {
            continue;
        }

        $id = absint( $credit['id'] ?? 0 );
        if ( ! $id || isset( $seen[ $id ] ) ) {
            continue;
        }
        $seen[ $id ] = true;

        $title = sanitize_text_field( $credit['title'] ?? '' );
        if ( '' === $title ) {
            continue;
        }

        $release_date = sanitize_text_field( $credit['release_date'] ?? '' );
        $poster_path = sanitize_text_field( $credit['poster_path'] ?? '' );
        $character = sanitize_text_field( $credit['character'] ?? '' );

        $movie_post_id = pzfilm_find_movie_post_id_by_tmdb_id( $id );

        $movies[] = array(
            'tmdb_id'      => $id,
            'title'        => $title,
            'release_date' => $release_date,
            'character'    => $character,
            'poster_path'  => $poster_path,
            'poster_url'   => $poster_path ? pzfilm_tmdb_movie_poster_url( $poster_path ) : '',
            'permalink'    => $movie_post_id ? get_permalink( $movie_post_id ) : '',
            'vote_average' => isset( $credit['vote_average'] ) ? floatval( $credit['vote_average'] ) : 0,
            'popularity'   => isset( $credit['popularity'] ) ? floatval( $credit['popularity'] ) : 0,
        );
    }

    usort(
        $movies,
        static function ( $a, $b ) {
            $ad = $a['release_date'] ?? '';
            $bd = $b['release_date'] ?? '';
            if ( $ad === $bd ) {
                return ( $b['popularity'] ?? 0 ) <=> ( $a['popularity'] ?? 0 );
            }
            return strcmp( $bd, $ad );
        }
    );

    return array_slice( $movies, 0, 60 );
}

function pzfilm_person_cache_fill_movie_permalinks( $cache ) {
    if ( ! is_array( $cache ) || empty( $cache['movies'] ) || ! is_array( $cache['movies'] ) ) {
        return $cache;
    }

    $missing_ids = array();
    foreach ( $cache['movies'] as $m ) {
        $tmdb_id = absint( $m['tmdb_id'] ?? 0 );
        $permalink = $m['permalink'] ?? '';
        if ( $tmdb_id && empty( $permalink ) ) {
            $missing_ids[ $tmdb_id ] = $tmdb_id;
        }
    }

    if ( empty( $missing_ids ) ) {
        return $cache;
    }

    global $wpdb;

    $ids = array_values( $missing_ids );
    $placeholders = implode( ',', array_fill( 0, count( $ids ), '%d' ) );

    // One query to map TMDB movie ids -> our movie post IDs.
    $sql = $wpdb->prepare(
        "SELECT p.ID AS post_id, pm.meta_value AS tmdb_id
         FROM {$wpdb->posts} p
         INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
         WHERE p.post_type = 'movie'
           AND p.post_status = 'publish'
           AND pm.meta_key = 'movie_id'
           AND pm.meta_value IN ($placeholders)",
        $ids
    );

    $rows = $wpdb->get_results( $sql, ARRAY_A );
    if ( empty( $rows ) ) {
        return $cache;
    }

    $map = array();
    foreach ( $rows as $row ) {
        $map[ absint( $row['tmdb_id'] ?? 0 ) ] = absint( $row['post_id'] ?? 0 );
    }

    foreach ( $cache['movies'] as $idx => $m ) {
        $tmdb_id = absint( $m['tmdb_id'] ?? 0 );
        if ( ! $tmdb_id || ! empty( $m['permalink'] ) ) {
            continue;
        }

        $post_id = absint( $map[ $tmdb_id ] ?? 0 );
        if ( $post_id ) {
            $m['permalink'] = get_permalink( $post_id );
            $cache['movies'][ $idx ] = $m;
        }
    }

    return $cache;
}

function pzfilm_maybe_populate_person_cache() {
    if ( ! is_singular( 'pz_person' ) ) {
        return;
    }

    $person = get_queried_object();
    if ( ! $person || empty( $person->ID ) ) {
        return;
    }

    $post_id = absint( $person->ID );
    $tmdb_person_id = absint( get_post_meta( $post_id, 'tmdb_person_id', true ) );
    if ( ! $tmdb_person_id ) {
        return;
    }

    $rate_limited_until = absint( get_post_meta( $post_id, 'tmdb_person_rate_limited_until', true ) );
    if ( $rate_limited_until && time() < $rate_limited_until ) {
        return;
    }

    $cache = get_post_meta( $post_id, 'tmdb_person_cache', true );
    if ( is_array( $cache ) ) {
        $filled = pzfilm_person_cache_fill_movie_permalinks( $cache );
        if ( $filled !== $cache ) {
            update_post_meta( $post_id, 'tmdb_person_cache', $filled );
            $cache = $filled;
        }
    }

    // Only refresh "details" on page-load. Filmography (combined_credits) is loaded lazily via AJAX.
    $ttl = 30 * DAY_IN_SECONDS;
    if ( is_array( $cache ) && ! empty( $cache['details_updated_at'] ) && ( time() - absint( $cache['details_updated_at'] ) ) < $ttl ) {
        return;
    }

    $details = pzfilm_fetch_tmdb_person_details_en( $tmdb_person_id );
    if ( is_wp_error( $details ) ) {
        if ( 'tmdb_rate_limited' === $details->get_error_code() ) {
            $retry_after = absint( $details->get_error_data()['retry_after'] ?? 0 );
            $cooldown = $retry_after ? $retry_after : ( 6 * HOUR_IN_SECONDS );
            update_post_meta( $post_id, 'tmdb_person_rate_limited_until', time() + $cooldown );
        }
        return;
    }

    $new_cache = is_array( $cache ) ? $cache : array();
    if ( empty( $new_cache ) ) {
        $new_cache = pzfilm_build_person_details_cache( $details );
    } else {
        $new_cache['details'] = pzfilm_build_person_details_cache( $details )['details'];
        $new_cache['details_updated_at'] = time();
        $new_cache['updated_at'] = time();
        if ( empty( $new_cache['movies'] ) ) {
            $new_cache['movies'] = array();
        }
        if ( empty( $new_cache['movies_updated_at'] ) ) {
            $new_cache['movies_updated_at'] = absint( $new_cache['movies_updated_at'] ?? 0 );
        }
    }

    update_post_meta( $post_id, 'tmdb_person_cache', $new_cache );

    $profile_path = sanitize_text_field( $details['profile_path'] ?? '' );
    if ( $profile_path ) {
        update_post_meta( $post_id, 'profile_path', $profile_path );
    }
}

add_action( 'template_redirect', 'pzfilm_maybe_populate_person_cache', 9 );

function pzfilm_person_filmography_ajax() {
    check_ajax_referer( 'pzfilm_global_nonce', 'nonce' );

    $person_id = isset( $_POST['person_id'] ) ? absint( $_POST['person_id'] ) : 0;
    if ( ! $person_id ) {
        wp_send_json_error( array( 'message' => 'Nedostaje person_id.' ), 400 );
    }

    $post = get_post( $person_id );
    if ( ! $post || 'pz_person' !== $post->post_type ) {
        wp_send_json_error( array( 'message' => 'Glumac nije pronađen.' ), 404 );
    }

    $tmdb_person_id = absint( get_post_meta( $person_id, 'tmdb_person_id', true ) );
    if ( ! $tmdb_person_id ) {
        wp_send_json_success( array( 'movies' => array() ) );
    }

    $rate_limited_until = absint( get_post_meta( $person_id, 'tmdb_person_rate_limited_until', true ) );
    if ( $rate_limited_until && time() < $rate_limited_until ) {
        wp_send_json_success( array( 'movies' => array() ) );
    }

    $cache = get_post_meta( $person_id, 'tmdb_person_cache', true );
    $cache = is_array( $cache ) ? $cache : array();

    $ttl = 30 * DAY_IN_SECONDS;
    $needs_movies = empty( $cache['movies'] ) || ( ! empty( $cache['movies_updated_at'] ) && ( time() - absint( $cache['movies_updated_at'] ) ) > $ttl );

    if ( $needs_movies ) {
        $credits = pzfilm_fetch_tmdb_person_combined_credits_en( $tmdb_person_id );
        if ( is_wp_error( $credits ) ) {
            if ( 'tmdb_rate_limited' === $credits->get_error_code() ) {
                $retry_after = absint( $credits->get_error_data()['retry_after'] ?? 0 );
                $cooldown = $retry_after ? $retry_after : ( 6 * HOUR_IN_SECONDS );
                update_post_meta( $person_id, 'tmdb_person_rate_limited_until', time() + $cooldown );
            }
            wp_send_json_success( array( 'movies' => array() ) );
        }

        $cache['movies'] = pzfilm_build_person_movies_cache( $credits );
        $cache['movies_updated_at'] = time();
        $cache['updated_at'] = time();
        $cache = pzfilm_person_cache_fill_movie_permalinks( $cache );
        update_post_meta( $person_id, 'tmdb_person_cache', $cache );
    } else {
        $filled = pzfilm_person_cache_fill_movie_permalinks( $cache );
        if ( $filled !== $cache ) {
            update_post_meta( $person_id, 'tmdb_person_cache', $filled );
            $cache = $filled;
        }
    }

    $movies = array();
    foreach ( (array) ( $cache['movies'] ?? array() ) as $m ) {
        $release_date = sanitize_text_field( $m['release_date'] ?? '' );
        $year = $release_date ? substr( $release_date, 0, 4 ) : '';

        $movies[] = array(
            'title'      => sanitize_text_field( $m['title'] ?? '' ),
            'year'       => $year,
            'role'       => sanitize_text_field( $m['character'] ?? '' ),
            'poster_url' => esc_url_raw( $m['poster_url'] ?? '' ),
            'permalink'  => esc_url_raw( $m['permalink'] ?? '' ),
        );
    }

    wp_send_json_success( array( 'movies' => $movies ) );
}

add_action( 'wp_ajax_pzfilm_person_filmography', 'pzfilm_person_filmography_ajax' );
add_action( 'wp_ajax_nopriv_pzfilm_person_filmography', 'pzfilm_person_filmography_ajax' );

function pzfilm_get_or_create_person_post_id( $tmdb_person_id, $name, $profile_path ) {
    $tmdb_person_id = absint( $tmdb_person_id );
    $name = sanitize_text_field( $name );

    if ( ! $tmdb_person_id || empty( $name ) ) {
        return 0;
    }

    if ( ! post_type_exists( 'pz_person' ) ) {
        return 0;
    }

    $existing = get_posts(
        array(
            'post_type'      => 'pz_person',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'meta_key'       => 'tmdb_person_id',
            'meta_value'     => $tmdb_person_id,
            'fields'         => 'ids',
        )
    );

    if ( ! empty( $existing ) ) {
        $post_id = absint( $existing[0] );
        if ( $profile_path ) {
            update_post_meta( $post_id, 'profile_path', sanitize_text_field( $profile_path ) );
        }
        return $post_id;
    }

    $post_id = wp_insert_post(
        array(
            'post_type'   => 'pz_person',
            'post_status' => 'publish',
            'post_title'  => $name,
            'post_name'   => sanitize_title( $name . '-' . $tmdb_person_id ),
        ),
        true
    );

    if ( is_wp_error( $post_id ) ) {
        return 0;
    }

    update_post_meta( $post_id, 'tmdb_person_id', $tmdb_person_id );
    if ( $profile_path ) {
        update_post_meta( $post_id, 'profile_path', sanitize_text_field( $profile_path ) );
    }

    return absint( $post_id );
}

function pzfilm_build_people_cache_from_credits( $credits ) {
    $cache = array(
        'directors'  => array(),
        'writers'    => array(),
        'cast'       => array(),
        'updated_at' => time(),
    );

    $crew = is_array( $credits['crew'] ?? null ) ? $credits['crew'] : array();
    $cast = is_array( $credits['cast'] ?? null ) ? $credits['cast'] : array();

    $seen = array();

    foreach ( $crew as $member ) {
        $id = absint( $member['id'] ?? 0 );
        $job = sanitize_text_field( $member['job'] ?? '' );
        $department = sanitize_text_field( $member['department'] ?? '' );

        if ( ! $id ) {
            continue;
        }

        $name = sanitize_text_field( $member['name'] ?? '' );
        $profile_path = sanitize_text_field( $member['profile_path'] ?? '' );

        if ( empty( $name ) ) {
            continue;
        }

        if ( 'Director' === $job ) {
            if ( isset( $seen['director'][ $id ] ) ) {
                continue;
            }
            $seen['director'][ $id ] = true;

            $person_post_id = pzfilm_get_or_create_person_post_id( $id, $name, $profile_path );

            $cache['directors'][] = array(
                'tmdb_id'      => $id,
                'name'         => $name,
                'job'          => $job,
                'profile_path' => $profile_path,
                'profile_url'  => $profile_path ? pzfilm_tmdb_profile_image_url( $profile_path ) : '',
                'permalink'    => $person_post_id ? get_permalink( $person_post_id ) : '',
            );
        }

        if ( 'Writing' === $department || in_array( $job, array( 'Writer', 'Screenplay', 'Story' ), true ) ) {
            if ( isset( $seen['writer'][ $id ] ) ) {
                continue;
            }
            $seen['writer'][ $id ] = true;

            $person_post_id = pzfilm_get_or_create_person_post_id( $id, $name, $profile_path );

            $cache['writers'][] = array(
                'tmdb_id'      => $id,
                'name'         => $name,
                'job'          => $job ?: 'Writer',
                'profile_path' => $profile_path,
                'profile_url'  => $profile_path ? pzfilm_tmdb_profile_image_url( $profile_path ) : '',
                'permalink'    => $person_post_id ? get_permalink( $person_post_id ) : '',
            );
        }
    }

    $cast = array_slice( $cast, 0, 20 );
    foreach ( $cast as $member ) {
        $id = absint( $member['id'] ?? 0 );
        if ( ! $id ) {
            continue;
        }

        if ( isset( $seen['cast'][ $id ] ) ) {
            continue;
        }
        $seen['cast'][ $id ] = true;

        $name = sanitize_text_field( $member['name'] ?? '' );
        if ( empty( $name ) ) {
            continue;
        }

        $profile_path = sanitize_text_field( $member['profile_path'] ?? '' );
        $character = sanitize_text_field( $member['character'] ?? '' );

        $person_post_id = pzfilm_get_or_create_person_post_id( $id, $name, $profile_path );

        $cache['cast'][] = array(
            'tmdb_id'      => $id,
            'name'         => $name,
            'character'    => $character,
            'profile_path' => $profile_path,
            'profile_url'  => $profile_path ? pzfilm_tmdb_profile_image_url( $profile_path ) : '',
            'permalink'    => $person_post_id ? get_permalink( $person_post_id ) : '',
        );
    }

    return $cache;
}

function refresh_movie_people() {
    check_ajax_referer( 'pzfilm_global_nonce', 'nonce' );

    $post_id = isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0;
    $tmdb_movie_id = isset( $_POST['tmdb_movie_id'] ) ? absint( $_POST['tmdb_movie_id'] ) : 0;

    if ( ! $post_id || ! $tmdb_movie_id ) {
        wp_send_json_error( array( 'message' => 'Nedostaju podaci za ljude iz filma.' ), 400 );
    }

    $post = get_post( $post_id );

    if ( ! $post || 'movie' !== $post->post_type ) {
        wp_send_json_error( array( 'message' => 'Film nije pronađen.' ), 404 );
    }

    $rate_limited_until = absint( get_post_meta( $post_id, 'tmdb_movie_people_rate_limited_until', true ) );
    if ( $rate_limited_until && time() < $rate_limited_until ) {
        wp_send_json_success(
            array(
                'source'    => 'rate_limited',
                'directors' => array(),
                'writers'   => array(),
                'cast'      => array(),
            )
        );
    }

    $existing_cache = get_post_meta( $post_id, 'tmdb_people_cache', true );

    if ( is_array( $existing_cache ) && ( ! empty( $existing_cache['cast'] ) || ! empty( $existing_cache['directors'] ) || ! empty( $existing_cache['writers'] ) ) ) {
        $existing_cache = pzfilm_normalize_people_cache( $existing_cache );
        update_post_meta( $post_id, 'tmdb_people_cache', $existing_cache );

        wp_send_json_success(
            array(
                'source'    => 'database',
                'directors' => $existing_cache['directors'] ?? array(),
                'writers'   => $existing_cache['writers'] ?? array(),
                'cast'      => $existing_cache['cast'] ?? array(),
            )
        );
    }

    $credits = pzfilm_fetch_tmdb_movie_credits_en( $tmdb_movie_id );

    if ( is_wp_error( $credits ) ) {
        if ( 'tmdb_rate_limited' === $credits->get_error_code() ) {
            $retry_after = absint( ( $credits->get_error_data()['retry_after'] ?? 0 ) );
            $cooldown = $retry_after ? $retry_after : ( 6 * HOUR_IN_SECONDS );
            update_post_meta( $post_id, 'tmdb_movie_people_rate_limited_until', time() + $cooldown );

            wp_send_json_success(
                array(
                    'source'    => 'rate_limited',
                    'directors' => array(),
                    'writers'   => array(),
                    'cast'      => array(),
                )
            );
        }

        wp_send_json_error( array( 'message' => $credits->get_error_message() ), 500 );
    }

    $cache = pzfilm_build_people_cache_from_credits( $credits );

    update_post_meta( $post_id, 'tmdb_people_cache', $cache );

    // Also keep legacy string meta in sync (names only).
    if ( ! empty( $cache['directors'] ) ) {
        update_post_meta( $post_id, 'director', array_map( static fn( $p ) => $p['name'] ?? '', $cache['directors'] ) );
    }

    if ( ! empty( $cache['writers'] ) ) {
        update_post_meta( $post_id, 'writing', array_map( static fn( $p ) => $p['name'] ?? '', $cache['writers'] ) );
    }

    if ( ! empty( $cache['cast'] ) ) {
        update_post_meta( $post_id, 'cast', array_map( static fn( $p ) => $p['name'] ?? '', $cache['cast'] ) );
    }

    wp_send_json_success(
        array(
            'source'    => 'tmdb',
            'directors' => $cache['directors'],
            'writers'   => $cache['writers'],
            'cast'      => $cache['cast'],
        )
    );
}

add_action( 'wp_ajax_refresh_movie_people', 'refresh_movie_people' );
add_action( 'wp_ajax_nopriv_refresh_movie_people', 'refresh_movie_people' );







    function display_movie_data($post_id) {
        // Get the post object
        $post = get_post($post_id);

        // Check if the post exists and is of type 'movie'
        if (!$post || $post->post_type !== 'movie') {
            return 'Movie not found.';
        }

        // Get the movie metadata
        $movie_id = get_post_meta($post_id, 'movie_id', true);
        $adult = get_post_meta($post_id, 'adult', true);
        $backdrop_path = get_post_meta($post_id, 'backdrop_path', true);
        $budget = get_post_meta($post_id, 'budget', true);
        $genres = json_decode(get_post_meta($post_id, 'genres', true), true);
        $homepage = get_post_meta($post_id, 'homepage', true);
        $imdb_id = get_post_meta($post_id, 'imdb_id', true);
        $watch_link = get_post_meta($post_id, 'watch_link', true);
        $production_companies = json_decode(get_post_meta($post_id, 'production_companies', true), true);
        $release_date = get_post_meta($post_id, 'release_date', true);
        $runtime = get_post_meta($post_id, 'runtime', true);
        $status = get_post_meta($post_id, 'status', true);
        $tagline = get_post_meta($post_id, 'tagline', true);
        $vote_average = get_post_meta($post_id, 'vote_average', true);
        $vote_count = get_post_meta($post_id, 'vote_count', true);
        $our_recommendations = get_post_meta($post_id, 'our_recommendations', true);

        // Display the movie data
        ob_start();
        ?>
        <div class="movie-data">
            <h2><?php echo esc_html($post->post_title); ?></h2>
            <p><strong>ID:</strong> <?php echo esc_html($movie_id); ?></p>
            <p><strong>Adult:</strong> <?php echo esc_html($adult ? 'Yes' : 'No'); ?></p>
            <p><strong>Backdrop Path:</strong> <?php echo esc_html($backdrop_path); ?></p>
            <p><strong>Budget:</strong> <?php echo esc_html($budget); ?></p>
            <p><strong>Genres:</strong> <?php echo esc_html(implode(', ', $genres)); ?></p>
            <p><strong>Homepage:</strong> <a href="<?php echo esc_url($homepage); ?>"><?php echo esc_html($homepage); ?></a></p>
            <p><strong>IMDB ID:</strong> <?php echo esc_html($imdb_id); ?></p>
            <p><strong>Watch Link:</strong> <a href="<?php echo esc_url($watch_link); ?>"><?php echo esc_html($watch_link); ?></a></p>
            <p><strong>Production Companies:</strong> <?php echo esc_html(implode(', ', $production_companies)); ?></p>
            <p><strong>Release Date:</strong> <?php echo esc_html($release_date); ?></p>
            <p><strong>Runtime:</strong> <?php echo esc_html($runtime); ?> minutes</p>
            <p><strong>Status:</strong> <?php echo esc_html($status); ?></p>
            <p><strong>Tagline:</strong> <?php echo esc_html($tagline); ?></p>
            <p><strong>Vote Average:</strong> <?php echo esc_html($vote_average); ?></p>
            <p><strong>Vote Count:</strong> <?php echo esc_html($vote_count); ?></p>
            <p><strong>Our Recommendations</strong> <?php echo esc_html($our_recommendations); ?></p>
        </div>
        <?php
        return ob_get_clean();
    }



    add_action('add_meta_boxes', function () {
    add_meta_box(
        'movie_recommendation_box',
        'Naša preporuka',
        'render_movie_recommendation_box',
        'movie',
        'side',
        'high'
    );
});

function render_movie_recommendation_box($post) {
    $value = get_post_meta($post->ID, 'our_recommendations', true);
    wp_nonce_field('save_movie_recommendation', 'movie_recommendation_nonce');
    ?>
    <label>
        <input type="checkbox" name="our_recommendations" value="1" <?php checked($value, 'true'); ?> />
        Prikaži u “Našim preporukama”
    </label>
    <?php
}


add_action('save_post_movie', function ($post_id) {

    if (!isset($_POST['movie_recommendation_nonce']) ||
        !wp_verify_nonce($_POST['movie_recommendation_nonce'], 'save_movie_recommendation')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['our_recommendations'])) {
        update_post_meta($post_id, 'our_recommendations', 'true');
    } else {
        update_post_meta($post_id, 'our_recommendations', 'false');
    }
});





    function get_serbian_post_date($post_id) {
        // Try setting the locale to Serbian
        setlocale(LC_TIME, 'sr_RS.UTF-8'); // Make sure this is available on your server
    
        // If the locale is not working, try other variants:
        if (!setlocale(LC_TIME, 'sr_RS.UTF-8')) {
            setlocale(LC_TIME, 'sr_RS'); // Fallback
        }
    
        // If setlocale still doesn't work, manually map English months to Serbian months
        $months = [
            'January' => 'Januar',
            'February' => 'Februar',
            'March' => 'Mart',
            'April' => 'April',
            'May' => 'Maj',
            'June' => 'Jun',
            'July' => 'Jul',
            'August' => 'Avgust',
            'September' => 'Septembar',
            'October' => 'Oktobar',
            'November' => 'Novembar',
            'December' => 'Decembar',
        ];
    
        // Get the month name in English
        $english_month = strftime('%B', strtotime(get_the_date('', $post_id)));  // Get month in English
    
        // Check if month is valid and map to Serbian
        if (isset($months[$english_month])) {
            $serbian_month = $months[$english_month];  // Map to Serbian
        } else {
            $serbian_month = $english_month;  // Fallback to English month name
        }
    
        // Format the full date, replacing the English month name with the Serbian one
        $post_date = str_replace($english_month, $serbian_month, strftime('%B %d, %Y', strtotime(get_the_date('', $post_id))));
    
        return $post_date;
    }    
?>
