<?php
// Only load this if WordPress is loaded
if (!defined('ABSPATH')) exit;

// Endpoint to fetch logged-in user profile info
add_action('wp_ajax_get_profile_info', 'get_profile_info_handler');

function get_profile_info_handler() {
    // Check if user is logged in
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'Neautorizovan pristup.'], 403);
    }

    $user_id = get_current_user_id();
    $user = wp_get_current_user();

    if (!$user) {
        wp_send_json_error(['message' => 'Korisnik ne postoji.'], 404);
    }

    // Prepare profile data
    $profile_data = [
        'name'   => $user->display_name ?: $user->user_login,
        'email'  => $user->user_email,
        'avatar' => get_avatar_url($user_id, ['size' => 96]),
        'role'   => implode(', ', $user->roles),
    ];

    wp_send_json_success(['data' => $profile_data]);
}

