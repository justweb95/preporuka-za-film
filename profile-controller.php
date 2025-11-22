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
