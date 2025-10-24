<?php

namespace App\Controllers;

class RecentRecommendationsController
{

public static function getRecentRecommendations($limit = 10)
{
    $user_id = get_current_user_id();
    if (!$user_id) {
        return [];
    }

    $recommended_ids = json_decode(get_user_meta($user_id, 'recommendations_history', true), true);

    if (empty($recommended_ids) || !is_array($recommended_ids)) {
        return [];
    }

    $recommended_ids = array_map('intval', $recommended_ids);
    $recommended_ids = array_slice($recommended_ids, 0, $limit);

    // Query posts by meta_value 'movie_id'
    $posts = get_posts([
        'post_type' => 'movie',
        'meta_query' => [
            [
                'key' => 'movie_id',
                'value' => $recommended_ids,
                'compare' => 'IN',
            ]
        ],
        'posts_per_page' => $limit,
        'orderby' => 'post__in', // order might not strictly match meta_query
        'suppress_filters' => false,
    ]);

    $recent_movies = [];

    foreach ($posts as $movie) {
        $poster = get_post_meta($movie->ID, 'poster_path', true);
        $poster_url = $poster
            ? 'https://image.tmdb.org/t/p/w500' . $poster
            : get_template_directory_uri() . '/assets/images/no-poster.webp';

        $release_date = get_post_meta($movie->ID, 'release_date', true);
        $year = $release_date ? date('Y', strtotime($release_date)) : '';

        $recent_movies[] = [
            'ID' => $movie->ID,
            'title' => $movie->post_title,
            'poster_url' => $poster_url,
            'year' => $year,
        ];
    }

    return $recent_movies;
}

public static function getMyFavoritesMovies($limit = 10)
{
    $user_id = get_current_user_id();

    if (!$user_id) {
        return [];
    }

    // Get favorite post IDs (must be WordPress post IDs)
    $favorite_ids = json_decode(get_user_meta($user_id, 'favorite_movies', true), true);

    if (empty($favorite_ids) || !is_array($favorite_ids)) {
        return [];
    }

    $favorite_ids = array_map('intval', $favorite_ids);
    $favorite_ids = array_slice($favorite_ids, 0, $limit);

    // Get posts by ID
    $posts = get_posts([
        'post_type' => 'movie',
        'post__in' => $favorite_ids,
        'posts_per_page' => $limit,
        'orderby' => 'post__in', // preserves order of IDs
    ]);

    $favorite_movies = [];

    foreach ($posts as $movie) {
        $poster = get_post_meta($movie->ID, 'poster_path', true);
        $poster_url = $poster
            ? 'https://image.tmdb.org/t/p/w500' . $poster
            : get_template_directory_uri() . '/assets/images/no-poster.webp';

        $release_date = get_post_meta($movie->ID, 'release_date', true);
        $year = $release_date ? date('Y', strtotime($release_date)) : '';

        $favorite_movies[] = [
            'ID' => $movie->ID,
            'title' => $movie->post_title,
            'poster_url' => $poster_url,
            'year' => $year,
        ];
    }

    return $favorite_movies;
}

public static function getAlreadyWatchedMovies($limit = 10) {
    $user_id = get_current_user_id();
    if (!$user_id) {
        return [];
    }

    $watched_ids = json_decode(get_user_meta($user_id, 'already_watched', true), true);

    if (empty($watched_ids) || !is_array($watched_ids)) {
        return [];
    }

    $watched_ids = array_map('intval', $watched_ids);
    $watched_ids = array_slice($watched_ids, 0, $limit);

    // Query posts by meta_value 'movie_id'
    $posts = get_posts([
        'post_type' => 'movie',
        'post__in' => $watched_ids,
        'posts_per_page' => $limit,
        'orderby' => 'post__in', // preserves order of IDs
    ]);

    $watched_movies = [];

    foreach ($posts as $movie) {
        $poster = get_post_meta($movie->ID, 'poster_path', true);
        $poster_url = $poster
            ? 'https://image.tmdb.org/t/p/w500' . $poster
            : get_template_directory_uri() . '/assets/images/no-poster.webp';

        $release_date = get_post_meta($movie->ID, 'release_date', true);
        $year = $release_date ? date('Y', strtotime($release_date)) : '';

        $watched_movies[] = [
            'ID' => $movie->ID,
            'title' => $movie->post_title,
            'poster_url' => $poster_url,
            'year' => $year,
        ];
    }

    return $watched_movies;
}


}
