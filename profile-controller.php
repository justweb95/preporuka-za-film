<?php

// Only load this if WordPress is loaded
if (!defined('ABSPATH')) exit;

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

    // 🧩 Define default meta values
    $default_meta = [
        'profile_image' => 'images/avatars/Profile1.svg',
        'favorite_movies' => json_encode([]),
        'recommendations_history' => json_encode([]),
        'tier' => 'bronze',
        'notifications_enabled' => '1',
        'notifications_list' => json_encode(['Profile successfully verified']),
        'already_watched' => json_encode([]),
        'advanced_search_counter' => '0',
    ];

    // 🧠 Ensure all meta keys exist — create them if missing
    foreach ($default_meta as $key => $default_value) {
        $existing = get_user_meta($user_id, $key, true);
        if ($existing === '' || $existing === null) {
            update_user_meta($user_id, $key, $default_value);
        }
    }

    // 🧾 Gather all meta data
    $profile_data = [
        'name'   => $user->display_name ?: $user->user_login,
        'email'  => $user->user_email,
        'avatar' => get_avatar_url($user_id, ['size' => 96]),
        'role'   => implode(', ', $user->roles),
        'profile_image' => get_user_meta($user_id, 'profile_image', true),
        'favorite_movies' => json_decode(get_user_meta($user_id, 'favorite_movies', true), true),
        'recommendations_history' => json_decode(get_user_meta($user_id, 'recommendations_history', true), true),
        'tier' => get_user_meta($user_id, 'tier', true),
        'notifications_enabled' => (bool) get_user_meta($user_id, 'notifications_enabled', true),
        'notifications_list' => json_decode(get_user_meta($user_id, 'notifications_list', true), true),
        'already_watched' => json_decode(get_user_meta($user_id, 'already_watched', true), true),
        'advanced_search_counter' => intval(get_user_meta($user_id, 'advanced_search_counter', true)),
    ];

    wp_send_json_success(['data' => $profile_data]);
}

/**
 * Add custom fields to the admin user profile page
 */
add_action('show_user_profile', 'pzfilm_show_extra_profile_fields');
add_action('edit_user_profile', 'pzfilm_show_extra_profile_fields');

function pzfilm_show_extra_profile_fields($user) {
    ?>
    <h2>Preporuka za Film – Profil Detalji</h2>
    <table class="form-table">
        <tr>
            <th><label for="profile_image">Profile Image Path</label></th>
            <td>
                <input type="text" name="profile_image" id="profile_image" 
                       value="<?php echo esc_attr(get_user_meta($user->ID, 'profile_image', true)); ?>" 
                       class="regular-text" />
                <p class="description">Putanja do slike avatara.</p>
            </td>
        </tr>

        <tr>
            <th><label for="tier">User Tier</label></th>
            <td>
                <select name="tier" id="tier">
                    <?php
                    $current_tier = get_user_meta($user->ID, 'tier', true);
                    $tiers = ['bronze', 'silver', 'gold'];
                    foreach ($tiers as $t) {
                        printf('<option value="%1$s" %2$s>%1$s</option>', esc_attr($t), selected($current_tier, $t, false));
                    }
                    ?>
                </select>
                <p class="description">Nivo korisnika (bronze, silver, gold).</p>
            </td>
        </tr>

        <tr>
            <th><label for="notifications_enabled">Notifications Enabled</label></th>
            <td>
                <input type="checkbox" name="notifications_enabled" id="notifications_enabled" value="1"
                       <?php checked(get_user_meta($user->ID, 'notifications_enabled', true), '1'); ?> />
                <span>Aktiviraj notifikacije</span>
            </td>
        </tr>

        <tr>
            <th><label for="advanced_search_counter">Advanced Search Counter</label></th>
            <td>
                <input type="number" name="advanced_search_counter" id="advanced_search_counter"
                       value="<?php echo esc_attr(get_user_meta($user->ID, 'advanced_search_counter', true)); ?>" 
                       min="0" />
            </td>
        </tr>

        <tr>
            <th><label for="favorite_movies">Favorite Movies (IDs)</label></th>
            <td>
                <textarea name="favorite_movies" id="favorite_movies" rows="3" cols="50"><?php
                    echo esc_textarea(get_user_meta($user->ID, 'favorite_movies', true));
                ?></textarea>
                <p class="description">Unesi JSON niz ID-jeva filmova, npr. ["12","43","78"]</p>
            </td>
        </tr>

        <tr>
            <th><label for="already_watched">Already Watched (IDs)</label></th>
            <td>
                <textarea name="already_watched" id="already_watched" rows="3" cols="50"><?php
                    echo esc_textarea(get_user_meta($user->ID, 'already_watched', true));
                ?></textarea>
                <p class="description">JSON lista ID-jeva filmova koje ste već gledali, npr. ["12","43","78"]</p>
            </td>
        </tr>

        <tr>
            <th><label for="notifications_list">Notifications List</label></th>
            <td>
                <textarea name="notifications_list" id="notifications_list" rows="3" cols="50"><?php
                    echo esc_textarea(get_user_meta($user->ID, 'notifications_list', true));
                ?></textarea>
                <p class="description">JSON lista notifikacija, npr. ["Welcome", "Verified"].</p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save custom profile fields
 */
add_action('personal_options_update', 'pzfilm_save_extra_profile_fields');
add_action('edit_user_profile_update', 'pzfilm_save_extra_profile_fields');

function pzfilm_save_extra_profile_fields($user_id) {
    // Permission check
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    $fields = [
        'profile_image',
        'tier',
        'notifications_enabled',
        'advanced_search_counter',
        'favorite_movies',
        'already_watched',
        'notifications_list',
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_user_meta($user_id, $field, sanitize_text_field($_POST[$field]));
        } else if ($field === 'notifications_enabled') {
            // Checkbox unchecked
            update_user_meta($user_id, $field, '0');
        }
    }
}

add_action('wp_ajax_get_loggedin_username', 'get_loggedin_username_handler');
add_action('wp_ajax_nopriv_get_loggedin_username', 'get_loggedin_username_handler');

function get_loggedin_username_handler() {
    // Check environment
    $is_production = env('PUBLIC_PRODUCTION', false); // default to false if not set

    if (!$is_production) {
        wp_send_json_success(['username' => 'paki']);
    }

    // Normal WordPress login check
    $user = wp_get_current_user();

    if (!$user || $user->ID === 0) {
        wp_send_json_success(['username' => 'guest']);
    }

    wp_send_json_success(['username' => $user->user_login]);
}


// Toggle a movie in favorite_movies meta via username
add_action('wp_ajax_toggle_favorite_movie', 'toggle_favorite_movie_by_username_handler');
add_action('wp_ajax_nopriv_toggle_favorite_movie', 'toggle_favorite_movie_by_username_handler');

function toggle_favorite_movie_by_username_handler() {
    if (!isset($_POST['movie_id'], $_POST['username'])) {
        wp_send_json_error(['message' => 'Movie ID or username missing'], 400);
    }

    $movie_id = sanitize_text_field($_POST['movie_id']);
    $username = sanitize_user($_POST['username']);

    $user = get_user_by('login', $username);
    if (!$user) {
        wp_send_json_error(['message' => 'User not found'], 404);
    }

    $user_id = $user->ID;

    // Get current favorites
    $favorites = json_decode(get_user_meta($user_id, 'favorite_movies', true) ?: '[]', true);

    if (!in_array($movie_id, $favorites)) {
        $favorites[] = $movie_id; // Add
    } else {
        $favorites = array_diff($favorites, [$movie_id]); // Remove
    }

    update_user_meta($user_id, 'favorite_movies', wp_json_encode(array_values($favorites)));

    wp_send_json_success(['favorites' => array_values($favorites)]);
}


// Get favorite movies by username
add_action('wp_ajax_get_favorite_movies_by_username', 'get_favorite_movies_by_username_handler');
add_action('wp_ajax_nopriv_get_favorite_movies_by_username', 'get_favorite_movies_by_username_handler');

function get_favorite_movies_by_username_handler() {
    if (!isset($_POST['username'])) {
        wp_send_json_error(['message' => 'Username missing'], 400);
    }

    $username = sanitize_user($_POST['username']);
    $user = get_user_by('login', $username);

    if (!$user) {
        wp_send_json_error(['message' => 'User not found'], 404);
    }

    $user_id = $user->ID;

    // Get current favorites
    $favorites = json_decode(get_user_meta($user_id, 'favorite_movies', true) ?: '[]', true);

    wp_send_json_success(['favorites' => $favorites]);
}


// Toggle a movie in already_watched meta via username
add_action('wp_ajax_toggle_watched_movie', 'toggle_watched_movie_by_username_handler');
add_action('wp_ajax_nopriv_toggle_watched_movie', 'toggle_watched_movie_by_username_handler');

function toggle_watched_movie_by_username_handler() {
    if (!isset($_POST['movie_id'], $_POST['username'])) {
        wp_send_json_error(['message' => 'Movie ID or username missing'], 400);
    }

    $movie_id = sanitize_text_field($_POST['movie_id']);
    $username = sanitize_user($_POST['username']);

    $user = get_user_by('login', $username);
    if (!$user) {
        wp_send_json_error(['message' => 'User not found'], 404);
    }

    $user_id = $user->ID;

    // Get current already watched movies
    $watched = json_decode(get_user_meta($user_id, 'already_watched', true) ?: '[]', true);

    if (!in_array($movie_id, $watched)) {
        $watched[] = $movie_id; // Add
    } else {
        $watched = array_diff($watched, [$movie_id]); // Remove
    }

    update_user_meta($user_id, 'already_watched', wp_json_encode(array_values($watched)));

    wp_send_json_success(['already_watched' => array_values($watched)]);
}


// Get already watched movies by username
add_action('wp_ajax_get_watched_movies_by_username', 'get_watched_movies_by_username_handler');
add_action('wp_ajax_nopriv_get_watched_movies_by_username', 'get_watched_movies_by_username_handler');

function get_watched_movies_by_username_handler() {
    if (!isset($_POST['username'])) {
        wp_send_json_error(['message' => 'Username missing'], 400);
    }

    $username = sanitize_user($_POST['username']);
    $user = get_user_by('login', $username);

    if (!$user || $user->ID === 0) {
        wp_send_json_error(['message' => 'User not found or not logged in'], 404);
    }

    $user_id = $user->ID;

    // Get current already watched movies
    $watched = json_decode(get_user_meta($user_id, 'already_watched', true) ?: '[]', true);

    wp_send_json_success(['already_watched' => $watched]);
}

// Toggle a movie in already_watched meta via username
add_action('wp_ajax_save_movie_recommendation', 'save_movie_recommendation_handler');
add_action('wp_ajax_nopriv_save_movie_recommendation', 'save_movie_recommendation_handler');

function save_movie_recommendation_handler() {
    if (!isset($_POST['movie_id'], $_POST['username'])) {
        wp_send_json_error(['message' => 'Movie ID or username missing'], 400);
    }

    $movie_id = sanitize_text_field($_POST['movie_id']);
    $username = sanitize_user($_POST['username']);

    $user = get_user_by('login', $username);
    if (!$user) {
        wp_send_json_error(['message' => 'User not found'], 404);
    }

    $user_id = $user->ID;

    // Get current already watched movies
    $recommendations_history = json_decode(get_user_meta($user_id, 'recommendations_history', true) ?: '[]', true);

    if (!in_array($movie_id, $recommendations_history)) {
        $recommendations_history[] = $movie_id; // Add
    } else {
        $recommendations_history = array_diff($recommendations_history, [$movie_id]); // Remove
    }

    update_user_meta($user_id, 'recommendations_history', wp_json_encode(array_values($recommendations_history)));

    wp_send_json_success(['recommendations_history' => array_values($recommendations_history)]);
}


// Toggle a movie in already_watched meta via username
add_action('wp_ajax_get_profile_metadata', 'get_profile_metadata_handler');
add_action('wp_ajax_nopriv_get_profile_metadata', 'get_profile_metadata_handler');

function get_profile_metadata_handler() {
    if (!isset($_POST['username'])) {
        wp_send_json_error(['message' => 'Username missing'], 400);
    }

    $username = sanitize_user($_POST['username']);
    $user = get_user_by('login', $username);

    if (!$user) {
        wp_send_json_error(['message' => 'User not found'], 404);
    }

    $user_id = $user->ID;

    // 🧾 Gather all metadata
    $profile_data = [
        'id' => $user_id,
        'name'   => $user->display_name ?: $user->user_login,
        'email'  => $user->user_email,
        'avatar' => get_avatar_url($user_id, ['size' => 96]),
        'role'   => implode(', ', $user->roles),
        'profile_image' => get_user_meta($user_id, 'profile_image', true),
        'favorite_movies' => json_decode(get_user_meta($user_id, 'favorite_movies', true), true),
        'recommendations_history' => json_decode(get_user_meta($user_id, 'recommendations_history', true), true),
        'tier' => get_user_meta($user_id, 'tier', true),
        'notifications_enabled' => (bool) get_user_meta($user_id, 'notifications_enabled', true),
        'notifications_list' => json_decode(get_user_meta($user_id, 'notifications_list', true), true),
        'already_watched' => json_decode(get_user_meta($user_id, 'already_watched', true), true),
        'advanced_search_counter' => intval(get_user_meta($user_id, 'advanced_search_counter', true)),
    ];

    // Return all metadata
    wp_send_json_success(['message' => 'Profile retrieved successfully', 'user_data' => $profile_data]);
}


add_action('wp_ajax_logout_user', 'logout_user_handler');
add_action('wp_ajax_nopriv_logout_user', 'logout_user_handler'); // add this!

function logout_user_handler() {
    wp_logout();
    wp_send_json_success(['redirect_url' => home_url()]);
}
