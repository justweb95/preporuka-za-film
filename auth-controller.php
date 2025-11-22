<?php
use App\Controllers\NotificationManager;


// auth-controller.php
if (!defined('ABSPATH')) exit;

/**
 * Add Manual Activation Checkbox in WP Admin User Profile
 */

add_action('show_user_profile', 'manual_activation_checkbox');
add_action('edit_user_profile', 'manual_activation_checkbox');

function manual_activation_checkbox($user) {
    // Only show for admins
    if (!current_user_can('manage_options')) return;

    $is_verified = get_user_meta($user->ID, 'is_verified', true);
    ?>
    <h3>Rucna Aktivacija</h3>
    <table class="form-table">
        <tr>
            <th><label for="is_verified">Aktiviran</label></th>
            <td>
                <input type="checkbox" name="is_verified" id="is_verified" value="1" <?php checked($is_verified, 1); ?> />
                <span class="description">Označite da ručno aktivirate nalog korisnika.</span>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Manual Activation Checkbox
 */
add_action('personal_options_update', 'save_manual_activation');
add_action('edit_user_profile_update', 'save_manual_activation');


function save_manual_activation($user_id) {
    if (!current_user_can('edit_user', $user_id)) return;

    // New value from admin form
    $is_verified = isset($_POST['is_verified']) ? 1 : 0;

    // Old value from database
    $old_verified = get_user_meta($user_id, 'is_verified', true);

    // Save new state
    update_user_meta($user_id, 'is_verified', $is_verified);

    // ✅ Send notification ONLY when changing from 0 → 1
    if ($old_verified != 1 && $is_verified == 1) {
        // Instantiate the controller
        $notificationManager = new NotificationManager($user_id);

        $notificationManager->addNotification(
            $user_id,
            'notification',
            'Dobrodošli!',
            'Vaš profil je uspešno aktiviran.',
            'bell',
            7
        );
    }
}

/**
 * Prevent Login for Unverified Users (except admins)
 */
add_filter('wp_authenticate_user', function($user, $password) {
    if (is_wp_error($user)) {
        return $user;
    }

    $is_verified = get_user_meta($user->ID, 'is_verified', true);

    // Allow admins to log in regardless of verification
    if ($is_verified != 1 && !current_user_can('manage_options')) {
        return new WP_Error('not_verified', 'Morate prvo aktivirati nalog putem mejla.');
    }

    return $user;
}, 10, 2);


/**
 * Handle user account activation via GET link
 */
add_action('init', function() {
    if (isset($_GET['verify'], $_GET['user'])) {
        $user_id    = intval($_GET['user']);
        $verify_key = sanitize_text_field($_GET['verify']);
        $saved_key  = get_user_meta($user_id, 'verify_key', true);

        if ($saved_key && $saved_key === $verify_key) {
            update_user_meta($user_id, 'is_verified', 1);
            delete_user_meta($user_id, 'verify_key');

            if (class_exists(NotificationManager::class)) {
                // Instantiate the controller with user_id
                $notificationManager = new NotificationManager($user_id);

                $notificationManager->addNotification(
                    $user_id,
                    'notification',
                    'Dobrodošli!',
                    'Vaš profil je uspešno aktiviran.',
                    'bell',
                    7
                );
            }

            // Optional: redirect to login with a message
            wp_redirect(add_query_arg('activated', '1', wp_login_url()));
            exit;
        } else {
            // Optional: show error message on login page
            add_filter('login_errors', function($errors) {
                return 'Nevažeći ili istekao aktivacioni link.';
            });
        }
    }
});


/**
 * Handle User Registration via AJAX
 */
add_action('wp_ajax_nopriv_custom_register_user', 'custom_register_user');
add_action('wp_ajax_custom_register_user', 'custom_register_user');

function custom_register_user() {
    $validation = [
        'username' => ['valid' => true, 'message' => '', 'class' => ''],
        'email'    => ['valid' => true, 'message' => '', 'class' => ''],
        'password' => ['valid' => true, 'message' => '', 'class' => ''],
        'password2'=> ['valid' => true, 'message' => '', 'class' => ''],
    ];

    $username  = sanitize_user($_POST['username'] ?? '');
    $email     = sanitize_email($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    // ✅ Username
    if (empty($username)) {
        $validation['username'] = ['valid'=>false, 'message'=>'Korisničko ime je obavezno.', 'class'=>'input-error'];
    } elseif (username_exists($username)) {
        $validation['username'] = ['valid'=>false, 'message'=>'Korisničko ime već postoji.', 'class'=>'input-error'];
    }

    // ✅ Email
    if (empty($email)) {
        $validation['email'] = ['valid'=>false, 'message'=>'Email je obavezan.', 'class'=>'input-error'];
    } elseif (!is_email($email)) {
        $validation['email'] = ['valid'=>false, 'message'=>'Email nije validan.', 'class'=>'input-error'];
    } elseif (email_exists($email)) {
        $validation['email'] = ['valid'=>false, 'message'=>'Email već postoji.', 'class'=>'input-error'];
    }

    // ✅ Password
    if (empty($password)) {
        $validation['password'] = ['valid'=>false, 'message'=>'Lozinka je obavezna.', 'class'=>'input-error'];
    }

    if ($password !== $password2) {
        $validation['password2'] = ['valid'=>false, 'message'=>'Lozinke se ne poklapaju.', 'class'=>'input-error'];
    }

    $has_errors = false;
    foreach ($validation as $field) {
        if ($field['valid'] === false) {
            $has_errors = true;
            break;
        }
    }

    if ($has_errors) {
        wp_send_json([
            'success' => false,
            'validation' => $validation
        ]);
    }

    // ✅ Create user
    $user_id = wp_create_user($username, $password, $email);
    if (is_wp_error($user_id)) {
        $validation['general'] = ['valid'=>false, 'message'=>$user_id->get_error_message(), 'class'=>'input-error'];
        wp_send_json(['success' => false, 'validation' => $validation]);
    }

    // ✅ Email verification
    $verify_key = wp_generate_password(32, false);
    update_user_meta($user_id, 'is_verified', 0);
    update_user_meta($user_id, 'verify_key', $verify_key);

    $activation_link = add_query_arg([
        'verify' => $verify_key,
        'user'   => $user_id,
    ], home_url('/moj-profil'));

    $subject = 'Aktivacija naloga';
    $body = "Zdravo $username,\n\nKliknite na link da aktivirate svoj nalog:\n$activation_link\n\nAko niste vi napravili nalog, ignorišite ovaj mejl.";
    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    wp_mail($email, $subject, $body, $headers);

    wp_send_json([
        'success' => true,
        'message' => 'Poslali smo aktivacioni mejl na vašu email adresu. Proverite inbox i spam folder.'
    ]);
}



/**
 * Handle User Password Reset via AJAX
 */
add_action('wp_ajax_nopriv_custom_lost_password', 'custom_lost_password');
add_action('wp_ajax_custom_lost_password', 'custom_lost_password'); 

function custom_lost_password() {
    $user_login = sanitize_text_field($_POST['user_login'] ?? '');
    $errors = [];

    if (empty($user_login)) {
        $errors[] = 'Unesite korisničko ime ili email.';
    } else {
        $user = get_user_by('login', $user_login) ?: get_user_by('email', $user_login);
        if (!$user) {
            $errors[] = 'Korisnik ne postoji.';
        } else {
            $result = retrieve_password($user_login);

            if (is_wp_error($result)) {
                $errors[] = 'Greška: ' . $result->get_error_message();
            } elseif (!$result) {
                $errors[] = 'Slanje emaila nije uspelo.';
            }
        }
    }

    if (!empty($errors)) {
        wp_send_json(['success' => false, 'errors' => $errors]);
    } else {
        wp_send_json(['success' => true, 'message' => 'Proverite svoj email za link za resetovanje lozinke.']);
    }
}


/**
 * Handle User New Password via AJAX
 */

add_action('wp_ajax_nopriv_custom_reset_password', 'custom_reset_password');
add_action('wp_ajax_custom_reset_password', 'custom_reset_password');

function custom_reset_password() {
    $login = sanitize_text_field($_POST['login'] ?? '');
    $key   = sanitize_text_field($_POST['key'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    $errors = [];

    if (empty($password) || empty($password2)) {
        $errors[] = 'Oba polja za lozinku su obavezna.';
    } elseif ($password !== $password2) {
        $errors[] = 'Lozinke se ne poklapaju.';
    }

    // Provera tokena i korisnika
    $user = check_password_reset_key($key, $login);
    if (is_wp_error($user)) {
        $errors[] = $user->get_error_message();
    }

    if (!empty($errors)) {
        wp_send_json(['success' => false, 'errors' => $errors]);
    }

    // Resetovanje lozinke
    reset_password($user, $password);

    wp_send_json(['success' => true, 'message' => 'Lozinka je uspešno promenjena.']);
}


add_action('wp_ajax_nopriv_custom_login', 'custom_login_handler');
add_action('wp_ajax_custom_login', 'custom_login_handler');

function custom_login_handler() {
    // Stop if missing required fields
    if (empty($_POST['log']) || empty($_POST['pwd'])) {
        wp_send_json_error(['message' => 'Nedostaju podaci za prijavu.']);
    }

    $creds = [
        'user_login'    => sanitize_text_field($_POST['log']),
        'user_password' => $_POST['pwd'],
        'remember'      => isset($_POST['rememberme']),
    ];

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        wp_send_json_error(['message' => 'Pogrešan e-mail ili lozinka.']);
    }

    // Redirect based on role
    $redirect_url = in_array('subscriber', (array)$user->roles)
        ? home_url('/moj-profil')
        : home_url('/');

    wp_send_json_success(['redirect' => $redirect_url]);
}


add_action('wp_ajax_nopriv_google_token_login', 'google_token_login');
add_action('wp_ajax_google_token_login', 'google_token_login');

function google_token_login() {
    $access_token = sanitize_text_field($_POST['access_token'] ?? '');
    $security     = sanitize_text_field($_POST['security'] ?? '');

    if (!$access_token) {
        wp_send_json_error(['message' => 'No access token provided']);
    }

    // 1️⃣ Get user info from Google
    $response = wp_remote_get("https://www.googleapis.com/oauth2/v3/userinfo", [
        'headers' => [
            'Authorization' => 'Bearer ' . $access_token
        ]
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error(['message' => 'Failed to fetch Google user info']);
    }

    $user_info = json_decode(wp_remote_retrieve_body($response), true);

    if (empty($user_info['email'])) {
        wp_send_json_error(['message' => 'Google user email not found']);
    }

    $email = sanitize_email($user_info['email']);
    $name  = sanitize_text_field($user_info['name'] ?? 'Google User');

    // 2️⃣ Check if user already exists
    $user = get_user_by('email', $email);

    if (!$user) {
        // 3️⃣ Create new WordPress user
        $password = wp_generate_password(12, true); // random secure password
        $user_id = wp_create_user($email, $password, $email);

        if (is_wp_error($user_id)) {
            wp_send_json_error(['message' => 'Failed to create WordPress user']);
        }

        // Optional: update display name
        wp_update_user([
            'ID' => $user_id,
            'display_name' => $name
        ]);

        $user = get_user_by('ID', $user_id);
    }

    // 4️⃣ Log the user in
    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID);

    // 5️⃣ Return success with redirect, WITHOUT exposing access token
    wp_send_json_success([
        'message'  => 'User logged in successfully',
    ]);
}
