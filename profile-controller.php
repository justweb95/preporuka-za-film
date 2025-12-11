<?php
use App\Controllers\RecentRecommendationsController;
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
        'display_already_watched' => '0',
        'display_already_recommended' => '0',
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
        'display_already_watched' => (bool) get_user_meta($user_id, 'display_already_watched', true),
        'display_already_recommended' => (bool) get_user_meta($user_id, 'display_already_recommended', true),
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
                       min="0" max="100" />
            </td>
        </tr>

        <tr>
            <th><label for="recommendations_history">Recommendations History (IDs)</label></th>
            <td>
                <textarea name="recommendations_history" id="recommendations_history" rows="3" cols="50"><?php
                    echo esc_textarea(get_user_meta($user->ID, 'recommendations_history', true));
                ?></textarea>
                <p class="description">Unesi JSON niz ID-jeva filmova, npr. ["12","43","78"]</p>
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
        'recommendations_history',
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

add_action('wp_ajax_save_movie_recommendation', 'save_movie_recommendation_handler');
add_action('wp_ajax_nopriv_save_movie_recommendation', 'save_movie_recommendation_handler');

function save_movie_recommendation_handler() {
    if (!isset($_POST['movie_ids'], $_POST['username'])) {
        wp_send_json_error(['message' => 'Movie IDs or username missing'], 400);
    }

    $movie_ids = array_map('sanitize_text_field', $_POST['movie_ids']);
    $username = sanitize_user($_POST['username']);

    $user = get_user_by('login', $username);
    if (!$user) {
        wp_send_json_error(['message' => 'User not found'], 404);
    }

    $user_id = $user->ID;

    $existing = json_decode(get_user_meta($user_id, 'recommendations_history', true) ?: '[]', true);

    // Merge new movies on top
    $recommendations = array_values(array_unique(array_merge($movie_ids, $existing)));

    update_user_meta($user_id, 'recommendations_history', wp_json_encode($recommendations));

    wp_send_json_success([
        'message' => 'Movies added to recommendations',
        'recommendations' => $recommendations
    ]);
}

add_action('wp_ajax_get_five_movies', 'get_five_movies_handler');
add_action('wp_ajax_nopriv_get_five_movies', 'get_five_movies_handler');

function get_five_movies_handler() {
    $user = wp_get_current_user();

    if (!$user || 0 === $user->ID) {
        wp_send_json_error(['message' => 'User not logged in'], 401);
    }

    $user_id = $user->ID;

    $favorite_movies = json_decode(get_user_meta($user_id, 'favorite_movies', true), true) ?: [];
    $already_watched = json_decode(get_user_meta($user_id, 'already_watched', true), true) ?: [];

    $movies = [];
    $exclude_ids = [];

    $get_poster = function($post_id) {
        $poster = get_post_meta($post_id, 'poster_path', true);
        return $poster ?: 'https://via.placeholder.com/300x450?text=No+Image';
    };

    $get_year = function($post_id) {
        $release_date = get_post_meta($post_id, 'release_date', true);
        return $release_date ? substr($release_date, 0, 4) : '';
    };

    // --- 1 random favorite movie ---
    if (!empty($favorite_movies)) {
        $fav_id = $favorite_movies[array_rand($favorite_movies)];
        $fav_post = get_post($fav_id);
        if ($fav_post) {
            $movies[] = [
                'id'     => $fav_post->ID,
                'title'  => $fav_post->post_title,
                'link'   => get_permalink($fav_post->ID),
                'poster' => $get_poster($fav_post->ID),
                'release_year'   => $get_year($fav_post->ID),
            ];
            $exclude_ids[] = $fav_post->ID;
        }
    }

    // --- 1 random already watched movie ---
    if (!empty($already_watched)) {
        $watched_id = $already_watched[array_rand($already_watched)];
        if (!in_array($watched_id, $exclude_ids)) {
            $watched_post = get_post($watched_id);
            if ($watched_post) {
                $movies[] = [
                    'id'     => $watched_post->ID,
                    'title'  => $watched_post->post_title,
                    'link'   => get_permalink($watched_post->ID),
                    'poster' => $get_poster($watched_post->ID),
                    'release_year'   => $get_year($watched_post->ID),
                ];
                $exclude_ids[] = $watched_post->ID;
            }
        }
    }

    // --- 3 random movies from DB excluding previous ---
    $args = [
        'post_type'      => 'movie',
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'orderby'        => 'rand',
        'post__not_in'   => $exclude_ids,
        'meta_query'     => [
            [
                'key'     => 'vote_average',
                'value'   => [6.5, 9],
                'type'    => 'NUMERIC',
                'compare' => 'BETWEEN',
            ]
        ]
    ];

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        foreach ($query->posts as $post) {
            $movies[] = [
                'id'     => $post->ID,
                'title'  => $post->post_title,
                'link'   => get_permalink($post->ID),
                'poster' => $get_poster($post->ID),
                'release_year'   => $get_year($post->ID),
            ];
            $exclude_ids[] = $post->ID;
        }
    }

    wp_send_json_success(['movies' => $movies]);
}


add_action('wp_ajax_get_movie_for_result', 'get_movie_for_result_handler');
add_action('wp_ajax_nopriv_get_movie_for_result', 'get_movie_for_result_handler');

function get_movie_for_result_handler() {
    $movie_id = intval($_POST['movie_id'] ?? 0);

    if (!$movie_id) {
        wp_send_json_error(['message' => 'Movie ID not provided'], 400);
    }

    $post = get_post($movie_id);
    if (!$post) {
        wp_send_json_error(['message' => 'Movie not found'], 404);
    }

    // Fetch all meta fields saved in save_movie()
    $movie_data = [
        'title'         => $post->post_title,
        'release_date'  => get_post_meta($movie_id, 'release_date', true),
        'poster_path'   => get_post_meta($movie_id, 'poster_path', true),
        'backdrop_path' => get_post_meta($movie_id, 'backdrop_path', true),
        'vote_average'  => floatval(get_post_meta($movie_id, 'vote_average', true)),
        'vote_count'    => intval(get_post_meta($movie_id, 'vote_count', true)),
        'overview'  => $post->post_content,
        // 'overview'      => get_post_meta($movie_id, 'overview', true),
        'genres'        => get_post_meta($movie_id, 'genres', true),
        'runtime'       => intval(get_post_meta($movie_id, 'runtime', true)),
        'url'           => get_permalink($movie_id),
        'video_trailer' => get_post_meta($movie_id, 'video_trailer', true),
        'movie_watch_on'=> get_post_meta($movie_id, 'movie_watch_on', true),
        'director'      => get_post_meta($movie_id, 'director', true),
        'cast'          => get_post_meta($movie_id, 'cast', true),
        'writing'       => get_post_meta($movie_id, 'writing', true),
        'budget'        => intval(get_post_meta($movie_id, 'budget', true)),
        'homepage'      => get_post_meta($movie_id, 'homepage', true),
        'imdb_id'       => get_post_meta($movie_id, 'imdb_id', true),
        'status'        => get_post_meta($movie_id, 'status', true),
        'tagline'       => get_post_meta($movie_id, 'tagline', true),
    ];

    wp_send_json_success($movie_data);
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
        'display_already_watched' => json_decode(get_user_meta($user_id, 'already_watched', true), true),
        'display_already_recommended' => json_decode(get_user_meta($user_id, 'already_watched', true), true),
        'advanced_search_counter' => intval(get_user_meta($user_id, 'advanced_search_counter', true)),
    ];

    // Return all metadata
    wp_send_json_success(['message' => 'Profile retrieved successfully', 'user_data' => $profile_data]);
}


add_action('wp_ajax_ajax_change_password', 'ajax_change_password_handler');

function ajax_change_password_handler() {
    if (! isset($_POST['change_pass_nonce']) || ! wp_verify_nonce($_POST['change_pass_nonce'], 'change_pass_action')) {
        wp_send_json_error(['message' => 'Neuspešna verifikacija.']);
    }

    $user_id = get_current_user_id();
    $current_user = wp_get_current_user();

    $old_pass = $_POST['old_password'] ?? '';
    $new_pass = $_POST['new_password'] ?? '';
    $repeat_pass = $_POST['repeat_new_password'] ?? '';

    if (empty($old_pass) || empty($new_pass) || empty($repeat_pass)) {
        wp_send_json_error(['message' => 'Sva polja su obavezna.']);
    }

    if (! wp_check_password($old_pass, $current_user->user_pass, $user_id)) {
        wp_send_json_error(['message' => 'Trenutna lozinka nije tačna.']);
    }

    if ($new_pass !== $repeat_pass) {
        wp_send_json_error(['message' => 'Nova lozinka i ponovljena lozinka se ne poklapaju.']);
    }

    wp_set_password($new_pass, $user_id);
    wp_send_json_success(['message' => 'Lozinka uspešno promenjena.']);
}

// Handle user info update via AJAX
add_action('wp_ajax_ajax_update_user_info', 'ajax_update_user_info_handler');

function ajax_update_user_info_handler() {
    // Security check
    if (! isset($_POST['user_update_nonce']) || ! wp_verify_nonce($_POST['user_update_nonce'], 'user_update_action')) {
        wp_send_json_error(['message' => 'Neuspešna verifikacija.']);
    }

    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_send_json_error(['message' => 'Niste prijavljeni.']);
    }

    $updates = [];

    // Sanitize and prepare fields
    if (isset($_POST['name'])) {
        $updates['display_name'] = sanitize_text_field($_POST['name']);
        $updates['user_nicename'] = sanitize_title($_POST['name']);
    }

    if (isset($_POST['email'])) {
        $email = sanitize_email($_POST['email']);
        if (!is_email($email)) {
            wp_send_json_error(['message' => 'Nevažeća email adresa.']);
        }
        $updates['user_email'] = $email;
    }

    if (isset($_POST['bio'])) {
        update_user_meta($user_id, 'description', sanitize_textarea_field($_POST['bio']));
    }

    if (!empty($updates)) {
        $user_update = wp_update_user(array_merge(['ID' => $user_id], $updates));
        if (is_wp_error($user_update)) {
            wp_send_json_error(['message' => 'Došlo je do greške pri ažuriranju korisnika.']);
        }
    }

    wp_send_json_success(['message' => 'Korisnički podaci uspešno ažurirani!']);
}


add_action('wp_ajax_update_user_avatar', 'ajax_update_user_avatar_handler');

function ajax_update_user_avatar_handler() {
    // Use the global nonce for verification
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'pzfilm_global_nonce')) {
        wp_send_json_error(['message' => 'Neuspešna verifikacija.']);
    }

    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_send_json_error(['message' => 'Niste prijavljeni.']);
    }

    if (!isset($_POST['avatarSrc']) || empty($_POST['avatarSrc'])) {
        wp_send_json_error(['message' => 'Avatar izvor nije prosleđen.']);
    }

    $avatar_src = sanitize_text_field($_POST['avatarSrc']);
    update_user_meta($user_id, 'profile_image', $avatar_src);

    wp_send_json_success(['message' => 'Avatar je uspešno ažuriran!', 'avatar' => $avatar_src]);
}


add_action('wp_ajax_update_user_notifications', 'update_user_notifications');
function update_user_notifications() {
    // Optional: verify nonce if used
    // check_ajax_referer('user_settings_nonce', 'nonce');

    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_send_json_error(['message' => 'Neautorizovan pristup.']);
    }

    $enabled = sanitize_text_field($_POST['notifications_enabled'] ?? '0');

    update_user_meta($user_id, 'notifications_enabled', $enabled);

    wp_send_json_success(['message' => 'Podešavanje obaveštenja ažurirano.']);
}

add_action('wp_ajax_update_user_already_watched', 'update_user_already_watched');

function update_user_already_watched() {
    // Optional: verify nonce if used
    // check_ajax_referer('user_settings_nonce', 'nonce');

    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_send_json_error(['message' => 'Neautorizovan pristup.']);
    }

    $enabled = sanitize_text_field($_POST['display_already_watched'] ?? '0');

    update_user_meta($user_id, 'display_already_watched', $enabled);

    wp_send_json_success([
        'message' => 'Podešavanje "Već gledano" je ažurirano.',
        'display_already_watched' => $enabled
    ]);
}

add_action('wp_ajax_update_user_already_recommended', 'update_user_already_recommended');

function update_user_already_recommended() {
    // Optional: verify nonce if used
    // check_ajax_referer('user_settings_nonce', 'nonce');

    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_send_json_error(['message' => 'Neautorizovan pristup.']);
    }

    $enabled = sanitize_text_field($_POST['display_already_recommended'] ?? '0');

    update_user_meta($user_id, 'display_already_recommended', $enabled);

    wp_send_json_success([
        'message' => 'Podešavanje "Već preporučeno" je ažurirano.',
        'display_already_recommended' => $enabled
    ]);
}


add_action('wp_ajax_fetch_movie_suggestions', 'fetch_movie_suggestions');
add_action('wp_ajax_nopriv_fetch_movie_suggestions', 'fetch_movie_suggestions');

function fetch_movie_suggestions() {
    global $wpdb;

    $query = sanitize_text_field($_POST['movie_name'] ?? '');
    if (!$query) wp_send_json_success(['suggestions' => []]);

    // Custom WP_Query with post_title LIKE search
    $args = [
        'post_type'      => 'movie',
        'post_status'    => 'publish',
        'posts_per_page' => 5,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ];

    // Filter WHERE clause to search only in post_title
    add_filter('posts_where', function($where, $wp_query) use ($query) {
        global $wpdb;
        $where .= $wpdb->prepare(" AND $wpdb->posts.post_title LIKE %s", '%' . $wpdb->esc_like($query) . '%');
        return $where;
    }, 10, 2);

    $movies_query = new WP_Query($args);
    remove_filter('posts_where', '__return_empty_string'); // remove filter after query

    $movies = [];

    if ($movies_query->have_posts()) {
        while ($movies_query->have_posts()) {
            $movies_query->the_post();
            $movies[] = [
                'id'           => get_the_ID(),
                'title'        => get_the_title(),
                'release_year' => get_post_meta(get_the_ID(), 'release_date', true) 
                                    ? substr(get_post_meta(get_the_ID(), 'release_date', true), 0, 4) 
                                    : '',
                'poster'       => get_post_meta(get_the_ID(), 'poster_path', true) 
                                    ? esc_url(get_post_meta(get_the_ID(), 'poster_path', true)) 
                                    : '',
            ];
        }
        wp_reset_postdata();
    }

    wp_send_json_success(['suggestions' => $movies]);
}



add_action('wp_ajax_logout_user', 'logout_user_handler');
add_action('wp_ajax_nopriv_logout_user', 'logout_user_handler');

function logout_user_handler() {
    wp_logout();
    wp_send_json_success(['redirect_url' => home_url()]);
}

add_action('wp_ajax_delete_user_account', 'ajax_delete_user_account_handler');

function ajax_delete_user_account_handler() {
    if (wp_verify_nonce($_POST['nonce'], 'user_delete_action')) {
        wp_send_json_error(['message' => 'Neuspešna verifikacija.']);
    }


    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_send_json_error(['message' => 'Niste prijavljeni.']);
    }

    global $wpdb;
    $wpdb->delete($wpdb->usermeta, ['user_id' => $user_id]);

    require_once(ABSPATH . 'wp-admin/includes/user.php');
    $deleted = wp_delete_user($user_id);

    if ($deleted) {
        wp_send_json_success([
            'message' => 'Nalog je uspešno obrisan.',
            'redirect_url' => home_url('/') // This will send the site’s homepage URL
        ]);
    } else {
        wp_send_json_error(['message' => 'Došlo je do greške prilikom brisanja naloga.']);
    }

}


// Notifications: Mark as seen
// For logged-in users
add_action('wp_ajax_mark_notifications_seen', 'mark_notifications_seen');

function mark_notifications_seen() {
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'Korisnik nije ulogovan']);
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $table = $wpdb->prefix . 'user_notifications';

    $notification_id = isset($_POST['notification_id']) ? intval($_POST['notification_id']) : null;
    if (!$notification_id) {
        wp_send_json_error(['message' => 'ID notifikacije nije prosleđen']);
    }

    // Update the notification, allowing NULL user_id (broadcast)
    $wpdb->query(
        $wpdb->prepare(
            "UPDATE $table
             SET is_seen = 1
             WHERE id = %d
               AND (user_id = %d OR user_id IS NULL)",
            $notification_id,
            $user_id
        )
    );

    wp_send_json_success(['message' => 'Notifikacija obeležena kao pročitana']);
}




add_action('wp_ajax_load_favorites_tab', 'load_favorites_tab');
add_action('wp_ajax_nopriv_load_favorites_tab', 'load_favorites_tab');

function load_favorites_tab() {
    try {
        // Get favorites directly
        if (class_exists('\App\Controllers\RecentRecommendationsController')) {
            $favorites = \App\Controllers\RecentRecommendationsController::getMyFavoritesMovies(20);
        } else {
            $favorites = [];
        }

        if (empty($favorites)) {
            echo '<li class="no-results-found">Trenutno nema favorita.</li>';
        } else {
            foreach ($favorites as $index => $movie) {
                // Make variables available to the template
                $movie_index = $index + 1;
                $poster_path = $movie['poster_url'] ?? '';
                $movie_ID = $movie['ID'] ?? 0;
                $release_year = $movie['year'] ?? '';
                $vote_average = $movie['vote_average'] ?? '';
                $genres = $movie['genres'] ?? [];
                $our_recommendations = $movie['our_recommendations'] ?? false;

                $template_file = get_stylesheet_directory() . '/app/Template/single-card-template.php';

                if (file_exists($template_file)) {
                    include $template_file; // This will render one card
                } else {
                    echo '<li class="no-results-found">Template file missing.</li>';
                }

            }
        }

    } catch (Throwable $e) {
        error_log('load_favorites_tab error: ' . $e->getMessage());
        echo '<li class="no-results-found">Došlo je do greške prilikom učitavanja.</li>';
    }

    wp_die();
}


add_action('wp_ajax_load_recent_recommendations_tab', 'load_recent_recommendations_tab');
add_action('wp_ajax_nopriv_load_recent_recommendations_tab', 'load_recent_recommendations_tab');

function load_recent_recommendations_tab() {
    try {
        if (class_exists('\App\Controllers\RecentRecommendationsController')) {
            $movies = \App\Controllers\RecentRecommendationsController::getRecentRecommendations(20);
        } else {
            $movies = [];
        }

        if (empty($movies)) {
            echo '<li class="no-results-found">Trenutno nema preporuka.</li>';
        } else {
            foreach ($movies as $index => $movie) {
                $movie_index = $index + 1;
                $poster_path = $movie['poster_url'] ?? '';
                $movie_ID = $movie['ID'] ?? 0;
                $release_year = $movie['year'] ?? '';
                $vote_average = $movie['vote_average'] ?? '';
                $genres = $movie['genres'] ?? [];
                $our_recommendations = $movie['our_recommendations'] ?? false;

                $template_file = get_stylesheet_directory() . '/app/Template/single-card-template.php';
                if (file_exists($template_file)) {
                    include $template_file;
                } else {
                    echo '<li class="no-results-found">Template file missing.</li>';
                }
            }
        }

    } catch (Throwable $e) {
        error_log('load_recent_recommendations_tab error: ' . $e->getMessage());
        echo '<li class="no-results-found">Došlo je do greške prilikom učitavanja.</li>';
    }

    wp_die();
}


add_action('wp_ajax_load_already_watched_tab', 'load_already_watched_tab');
add_action('wp_ajax_nopriv_load_already_watched_tab', 'load_already_watched_tab');

function load_already_watched_tab() {
    try {
        if (class_exists('\App\Controllers\RecentRecommendationsController')) {
            $movies = \App\Controllers\RecentRecommendationsController::getAlreadyWatchedMovies(20);
        } else {
            $movies = [];
        }
        echo '<li class="no-results-found">Trenutno nema gledanih filmova.</li>';

        if (empty($movies)) {
            echo '<li class="no-results-found">Trenutno nema gledanih filmova.</li>';
        } else {
            foreach ($movies as $index => $movie) {
                $movie_index = $index + 1;
                $poster_path = $movie['poster_url'] ?? '';
                $movie_ID = $movie['ID'] ?? 0;
                $release_year = $movie['year'] ?? '';
                $vote_average = $movie['vote_average'] ?? '';
                $genres = $movie['genres'] ?? [];
                $our_recommendations = $movie['our_recommendations'] ?? false;

                $template_file = get_stylesheet_directory() . '/app/Template/single-card-template.php';
                if (file_exists($template_file)) {
                    include $template_file;
                } else {
                    echo '<li class="no-results-found">Template file missing.</li>';
                }
            }
        }

    } catch (Throwable $e) {
        error_log('load_already_watched_tab error: ' . $e->getMessage());
        echo '<li class="no-results-found">Došlo je do greške prilikom učitavanja.</li>';
    }

    wp_die();
}
