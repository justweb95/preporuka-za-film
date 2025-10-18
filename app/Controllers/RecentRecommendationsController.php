<?php

namespace App\Controllers;

class RecentRecommendationsController
{
    public static function getRecentRecommendations($limit = 10)
    {
        $posts = get_posts([
            'post_type'      => 'movie',
            'posts_per_page' => $limit,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        $recent_movies = [];

        foreach ($posts as $movie) {
            $poster = get_post_meta($movie->ID, 'poster_path', true);
            $poster_url = $poster
                ? 'https://image.tmdb.org/t/p/w500' . $poster
                : get_template_directory_uri() . '/assets/images/no-poster.webp';

            $release_date = get_post_meta($movie->ID, 'release_date', true);
            $year = $release_date ? date('Y', strtotime($release_date)) : '';

            $our_recommendations = get_post_meta($movie->ID, 'our_recommendations', true);
            $my_favorites = get_post_meta($movie->ID, 'my_favorites', true);

            $recent_movies[] = [
                'ID' => $movie->ID,
                'title' => $movie->post_title,
                'poster_url' => $poster_url,
                'year' => $year,
                'our_recommendations' => $our_recommendations,
                'my_favorites' => $my_favorites,
            ];
        }

        return $recent_movies;
    }
}
