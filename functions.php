<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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



// Code for handle movie register custom post and saving
require_once get_template_directory() . '/movie_controler.php';





// Star Reviews
// Add star rating field to comment form
function add_star_rating_field() {
    echo '<p class="comment-form-rating">
    <span class="stars-container">
        <input required type="radio" name="rating" id="rating-5" value="5">
        <label for="rating-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
            <circle cx="10.2998" cy="10" r="9.3" stroke="white" stroke-width="1.4"/>
            <mask id="path-2-inside-1_342_1697" fill="white">
                <path d="M5.2998 11C5.2998 11.6566 5.42913 12.3068 5.68041 12.9134C5.93168 13.52 6.29998 14.0712 6.76427 14.5355C7.22856 14.9998 7.77976 15.3681 8.38639 15.6194C8.99301 15.8707 9.6432 16 10.2998 16C10.9564 16 11.6066 15.8707 12.2132 15.6194C12.8198 15.3681 13.371 14.9998 13.8353 14.5355C14.2996 14.0712 14.6679 13.52 14.9192 12.9134C15.1705 12.3068 15.2998 11.6566 15.2998 11L10.2998 11L5.2998 11Z"/>
            </mask>
            <path d="M5.2998 11C5.2998 11.6566 5.42913 12.3068 5.68041 12.9134C5.93168 13.52 6.29998 14.0712 6.76427 14.5355C7.22856 14.9998 7.77976 15.3681 8.38639 15.6194C8.99301 15.8707 9.6432 16 10.2998 16C10.9564 16 11.6066 15.8707 12.2132 15.6194C12.8198 15.3681 13.371 14.9998 13.8353 14.5355C14.2996 14.0712 14.6679 13.52 14.9192 12.9134C15.1705 12.3068 15.2998 11.6566 15.2998 11L10.2998 11L5.2998 11Z" stroke="white" stroke-width="2.8" mask="url(#path-2-inside-1_342_1697)"/>
            <circle cx="7.2998" cy="8" r="1" fill="white"/>
            <circle cx="13.2998" cy="8" r="1" fill="white"/>
            </svg>
            Odličan
        </label>
        
        <input required type="radio" name="rating" id="rating-4" value="4">
        <label for="rating-4">
            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="10.8994" cy="10" r="9.3" stroke="#EDFEEC" stroke-width="1.4"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.3593 12C13.9259 13.5017 12.5412 14.6 10.9 14.6C9.25874 14.6 7.87403 13.5017 7.44069 12H6C6.46327 14.2822 8.48102 16 10.9 16C13.3189 16 15.3367 14.2822 15.8 12H14.3593Z" fill="#EDFEEC"/>
                <circle cx="7.89941" cy="8" r="1" fill="#EDFEEC"/>
                <circle cx="13.8994" cy="8" r="1" fill="#EDFEEC"/>
            </svg>
            Vrlo Dobar
        </label>
        
        <input required type="radio" name="rating" id="rating-3" value="3">
        <label for="rating-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                <circle cx="10.5" cy="10" r="9.3" stroke="#EDFEEC" stroke-width="1.4"/>
                <circle cx="7.5" cy="8" r="1" fill="#EDFEEC"/>
                <circle cx="13.5" cy="8" r="1" fill="#EDFEEC"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5 13.6998H6.5V12.2998H14.5V13.6998Z" fill="#EDFEEC"/>
            </svg>
            Prosek
        </label>
        
        <input required type="radio" name="rating" id="rating-2" value="2">
        <label for="rating-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                <circle cx="10.5996" cy="10" r="9.3" stroke="#EDFEEC" stroke-width="1.4"/>
                <circle cx="7.59961" cy="8" r="1" fill="#EDFEEC"/>
                <circle cx="13.5996" cy="8" r="1" fill="#EDFEEC"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0508 13.0503C8.91342 13.3916 7.98952 13.9625 7.0197 14.6899L6.17969 13.5699C7.20986 12.7972 8.28596 12.1182 9.64855 11.7094C11.0122 11.3003 12.6135 11.1761 14.6865 11.4353L14.5129 12.8245C12.5859 12.5836 11.1872 12.7094 10.0508 13.0503Z" fill="#EDFEEC"/>
            </svg>
            Loš
        </label>
        
        <input required type="radio" name="rating" id="rating-1" value="1">
        <label for="rating-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                <circle cx="10.7012" cy="10" r="9.3" stroke="#EDFEEC" stroke-width="1.4"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0604 15C13.6271 13.4983 12.2424 12.4 10.6012 12.4C8.95992 12.4 7.5752 13.4983 7.14186 15H5.70117C6.16444 12.7178 8.1822 11 10.6012 11C13.0201 11 15.0379 12.7178 15.5011 15H14.0604Z" fill="#EDFEEC"/>
                <circle cx="7.70117" cy="8" r="1" fill="#EDFEEC"/>
                <circle cx="13.7012" cy="8" r="1" fill="#EDFEEC"/>
            </svg>
            Užasan
        </label>
    </span>
    </p>';
}
add_action( 'comment_form_logged_in_after', 'add_star_rating_field' );
add_action( 'comment_form_after_fields', 'add_star_rating_field' );


// Save star rating value with comment
function save_star_rating( $comment_id ) {
    if ( isset( $_POST['rating'] ) ) {
        $rating = intval( $_POST['rating'] );
        add_comment_meta( $comment_id, 'rating', $rating );
    }
}
add_action( 'comment_post', 'save_star_rating' );

// Display star rating in comments
function display_star_rating( $comment_text, $comment ) {
    $rating = get_comment_meta( $comment->comment_ID, 'rating', true );
    if ( $rating ) {
        $stars = '';
        for ( $i = 1; $i <= 5; $i++ ) {
            $stars .= ( $i <= $rating ) ? '★' : '☆';
        }
        $comment_text .= '<div class="star-rating">' . $stars . '</div>';
    }
    return $comment_text;
}
add_filter( 'comment_text', 'display_star_rating', 10, 2 );



// Custom pagination rewrite rule
// function custom_movie_pagination_rewrite() {
//     // Rewrite rule for category-based pagination for movie post type
//     add_rewrite_rule(
//         '^category/([^/]+)/page/([0-9]+)/?$',
//         'index.php?category_name=$matches[1]&paged=$matches[2]&post_type=movie',
//         'top'
//     );
// }
// add_action('init', 'custom_movie_pagination_rewrite');

// // Flush rewrite rules on theme activation
// function custom_flush_rewrite_rules() {
//     custom_movie_pagination_rewrite();
//     flush_rewrite_rules();
// }
// add_action('after_switch_theme', 'custom_flush_rewrite_rules');
// add_action('init', 'custom_flush_rewrite_rules');


<<<<<<< HEAD
// function myprefix_modify_movie_category_archive( $query ) {
//     // Only modify the main query on the front end on category archives
//     if ( ! is_admin() && $query->is_main_query() && $query->is_category() ) {
//       // Set the query to pull the 'movie' post type posts
//       $query->set( 'post_type', 'movie' );
//       $query->set( 'posts_per_page', 20 );
//     }
//   }
//   add_action( 'pre_get_posts', 'myprefix_modify_movie_category_archive' );





function modify_category_and_blog_archive( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        // Check if it's the 'vesti' category and has a parent category 'blog'
        if ( $query->is_category('vesti') ) {
            // Get the current category object
            $current_cat = get_queried_object();
            // Check if the parent category is 'blog' (by slug)
            if ( $current_cat && $current_cat->parent ) {
                $parent_cat = get_term( $current_cat->parent, 'category' );
                if ( $parent_cat->slug === 'blog' ) {
                    // Show ONLY 'post' type for this specific category
                    $query->set( 'post_type', 'post' );
                    $query->set( 'posts_per_page', 20 );
                    return; // Exit early to avoid conflicting rules
                }
            }
        }
        
        // Default behavior for other categories and the blog posts index
        if ( $query->is_category() || $query->is_home() ) {
            // Include both 'movie' and 'post'
            $query->set( 'post_type', array( 'movie', 'post' ) );
            $query->set( 'posts_per_page', 20 );
        }
    }
}
add_action( 'pre_get_posts', 'modify_category_and_blog_archive' );
=======

add_action( 'phpmailer_init', 'configure_smtp' );
    function configure_smtp( $phpmailer ) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = 'mail.preporukazafilm.com'; // SMTP server
        $phpmailer->SMTPAuth   = true;
        $phpmailer->Port       = 465; // SMTP port
        $phpmailer->Username   = 'info@preporukazafilm.com'; // SMTP username
        $phpmailer->Password   = 'OZ=O&q%T#&Ov'; // SMTP password
        $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL/TLS
        $phpmailer->From       = 'info@preporukazafilm.com'; // From email address
        $phpmailer->FromName   = 'Preporuka Za Film'; // From name
    }
>>>>>>> a0f3cfc (Mail sending is working)
