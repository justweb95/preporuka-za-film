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



// Code for handle movie register custom post and saving
require_once get_template_directory() . '/movie_controler.php';





// Star Reviews
// Add star rating field to comment form
function add_star_rating_field() {
    echo '<p class="comment-form-rating">Vaša ocena:
    <span class="stars-container">
        <input required type="radio" name="rating" id="rating-5" value="5">
        <label for="rating-5">
            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="10.4004" cy="10" r="9.3" fill="white" stroke="#002635" stroke-width="1.4"/>
                <mask id="path-2-inside-1_772_4603" fill="white">
                <path d="M5.40039 11C5.40039 11.6566 5.52972 12.3068 5.78099 12.9134C6.03227 13.52 6.40056 14.0712 6.86486 14.5355C7.32915 14.9998 7.88034 15.3681 8.48697 15.6194C9.0936 15.8707 9.74378 16 10.4004 16C11.057 16 11.7072 15.8707 12.3138 15.6194C12.9204 15.3681 13.4716 14.9998 13.9359 14.5355C14.4002 14.0712 14.7685 13.52 15.0198 12.9134C15.2711 12.3068 15.4004 11.6566 15.4004 11L10.4004 11L5.40039 11Z"/>
                </mask>
                <path d="M5.40039 11C5.40039 11.6566 5.52972 12.3068 5.78099 12.9134C6.03227 13.52 6.40056 14.0712 6.86486 14.5355C7.32915 14.9998 7.88034 15.3681 8.48697 15.6194C9.0936 15.8707 9.74378 16 10.4004 16C11.057 16 11.7072 15.8707 12.3138 15.6194C12.9204 15.3681 13.4716 14.9998 13.9359 14.5355C14.4002 14.0712 14.7685 13.52 15.0198 12.9134C15.2711 12.3068 15.4004 11.6566 15.4004 11L10.4004 11L5.40039 11Z" fill="white" stroke="#002635" stroke-width="2.8" mask="url(#path-2-inside-1_772_4603)"/>
                <circle cx="7.40039" cy="8" r="1" fill="#002635"/>
                <circle cx="13.4004" cy="8" r="1" fill="#002635"/>
            </svg>
            Odličan
        </label>
        
        <input required type="radio" name="rating" id="rating-4" value="4">
        <label for="rating-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                <circle cx="10.2012" cy="10" r="9.3" fill="white" stroke="#002635" stroke-width="1.4"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6601 12C13.2267 13.5017 11.842 14.6 10.2008 14.6C8.55953 14.6 7.17481 13.5017 6.74147 12H5.30078C5.76405 14.2822 7.78181 16 10.2008 16C12.6197 16 14.6375 14.2822 15.1007 12H13.6601Z" fill="#002635"/>
                <circle cx="7.20117" cy="8" r="1" fill="#002635"/>
                <circle cx="13.2012" cy="8" r="1" fill="#002635"/>
            </svg>Vrlo Dobar
        </label>
        
        <input required type="radio" name="rating" id="rating-3" value="3">
        <label for="rating-3">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="10" cy="10" r="9.3" fill="white" stroke="#002635" stroke-width="1.4"/>
                <circle cx="7" cy="8" r="1" fill="#002635"/>
                <circle cx="13" cy="8" r="1" fill="#002635"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14 13.6998H6V12.2998H14V13.6998Z" fill="#002635"/>
            </svg>
            Prosek
        </label>
        
        <input required type="radio" name="rating" id="rating-2" value="2">
        <label for="rating-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                <circle cx="10.8008" cy="10" r="9.3" fill="white" stroke="#002635" stroke-width="1.4"/>
                <circle cx="7.80078" cy="8" r="1" fill="#002635"/>
                <circle cx="13.8008" cy="8" r="1" fill="#002635"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.252 13.0503C9.11459 13.3916 8.19069 13.9625 7.22087 14.6899L6.38086 13.5699C7.41104 12.7972 8.48713 12.1182 9.84972 11.7094C11.2134 11.3003 12.8147 11.1761 14.8877 11.4353L14.714 12.8245C12.7871 12.5836 11.3884 12.7094 10.252 13.0503Z" fill="#002635"/>
            </svg>
            Loš
        </label>
        
        <input required type="radio" name="rating" id="rating-1" value="1">
        <label for="rating-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                <circle cx="10.5996" cy="10" r="9.3" fill="white" stroke="#002635" stroke-width="1.4"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9589 15C13.5255 13.4983 12.1408 12.4 10.4996 12.4C8.85835 12.4 7.47364 13.4983 7.0403 15H5.59961C6.06288 12.7178 8.08063 11 10.4996 11C12.9185 11 14.9363 12.7178 15.3996 15H13.9589Z" fill="#002635"/>
                <circle cx="7.59961" cy="8" r="1" fill="#002635"/>
                <circle cx="13.5996" cy="8" r="1" fill="#002635"/>
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

