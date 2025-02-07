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
        'rewrite'               => array( 'slug' => 'single-movie' ),
        'show_in_rest'          => true, // Enable Gutenberg editor
        'rest_base'             => 'movies',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'taxonomies'            => array( 'category' ), // Enable categories
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
            wp_send_json_success(array( 'message' => 'Movie with this ID already exists'));
            return;
        }
        
        $genres = sanitize_text_field($genres);

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

            $post_url = get_permalink($post_id);

            wp_send_json_success( array( 
                'message' => 'Movie created successfully!', 
                'post_url' => $post_url
            ));
        } else {
            wp_send_json_success( array( 'message' => 'Movie exist!', 'post_id' => $post_id, 'movie_id' => $movie_id ) );
        }
    }

    add_action( 'wp_ajax_save_movie', 'save_movie' );
    add_action( 'wp_ajax_nopriv_save_movie', 'save_movie' );


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
        </div>
        <?php
        return ob_get_clean();
    }



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