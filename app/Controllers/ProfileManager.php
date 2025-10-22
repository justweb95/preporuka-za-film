<?php

namespace App\Controllers;

class ProfileManager {

    private $user_id;

    public function __construct($user_id) {
        $this->user_id = $user_id;
    }

    public function getProfile() {
        $user = get_userdata($this->user_id);
        if (!$user) return null;

        $meta = [
            'profile_image' => get_user_meta($this->user_id, 'profile_image', true) ?: get_theme_file_uri('resources/images/avatars/Profile1.svg'),
            'tier' => get_user_meta($this->user_id, 'tier', true) ?: 'bronze',
            'favorite_movies' => json_decode(get_user_meta($this->user_id, 'favorite_movies', true) ?: '[]'),
            'already_watched' => json_decode(get_user_meta($this->user_id, 'already_watched', true) ?: '[]'),
            'notifications_enabled' => get_user_meta($this->user_id, 'notifications_enabled', true) === '1',
            'notifications_list' => json_decode(get_user_meta($this->user_id, 'notifications_list', true) ?: '["Profile successfully verified"]'),
            'advanced_search_counter' => intval(get_user_meta($this->user_id, 'advanced_search_counter', true) ?: 0),
        ];

        return [
            'name' => $user->display_name ?: $user->user_login,
            'email' => $user->user_email,
            'role' => implode(', ', $user->roles),
            'meta' => $meta
        ];
    }

    public function updateProfile($data) {
        $fields = ['profile_image','tier','favorite_movies','already_watched','notifications_enabled','notifications_list','advanced_search_counter','name','email','password'];
        
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                switch ($field) {
                    case 'name':
                        wp_update_user(['ID'=>$this->user_id, 'display_name'=>$data[$field]]);
                        break;
                    case 'email':
                        wp_update_user(['ID'=>$this->user_id, 'user_email'=>$data[$field]]);
                        break;
                    case 'password':
                        wp_update_user(['ID'=>$this->user_id, 'user_pass'=>$data[$field]]);
                        break;
                    case 'notifications_enabled':
                        update_user_meta($this->user_id, $field, $data[$field] ? '1' : '0');
                        break;
                    case 'favorite_movies':
                    case 'already_watched':
                    case 'notifications_list':
                        update_user_meta($this->user_id, $field, json_encode($data[$field]));
                        break;
                    default:
                        update_user_meta($this->user_id, $field, sanitize_text_field($data[$field]));
                        break;
                }
            }
        }
    }
    

}
