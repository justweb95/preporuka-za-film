<?php

namespace App\Controllers;
class NotificationManager {

  private $user_id;

  public function __construct($user_id) {
    $this->user_id = $user_id;
  }
  
  public function getNotifications($user_id = null) {
    global $wpdb;

    // Use current logged-in user if not passed
    $user_id = $user_id ?? get_current_user_id();

    if (!$user_id) {
        return json_encode(['error' => 'Korisnik nije ulogovan']);
    }

    $table = $wpdb->prefix . 'user_notifications';

    // Fetch all notifications for user + broadcast
    $query = $wpdb->prepare(
      "SELECT id, user_id, type, link, title, message, icon, is_seen, created_at, expires_at
      FROM $table
      WHERE (user_id = %d OR user_id IS NULL)
        AND (expires_at IS NULL OR expires_at >= %s)
      ORDER BY created_at DESC
      LIMIT 50",
      $user_id,
      current_time('mysql') // WP timezone aware
    );

    $results = $wpdb->get_results($query, ARRAY_A);

    if (!$results) {
        return json_encode(['message' => 'Nema dostupnih notifikacija']);
    }

    return json_encode($results);
  }

  public function getUnseenNotificationCount($user_id = null) {
    global $wpdb;

    // Use current logged-in user if not passed
    $user_id = $user_id ?? get_current_user_id();

    if (!$user_id) {
        return 0;
    }

    $table = $wpdb->prefix . 'user_notifications';

    $query = $wpdb->prepare(
        "SELECT COUNT(*) 
          FROM $table
          WHERE (user_id = %d OR user_id IS NULL)
            AND is_seen = 0
            AND (expires_at IS NULL OR expires_at >= %s)",
        $user_id,
        current_time('mysql')
    );

    $count = $wpdb->get_var($query);

    return (int) $count;
  }


  public function addNotification($user_id = null, $type, $title, $message, $icon = null, $expires_in_days = 7) {
    global $wpdb;

    $table = $wpdb->prefix . 'user_notifications';

    $expires_at = $expires_in_days ? date('Y-m-d H:i:s', strtotime("+$expires_in_days days")) : null;

    $user_id_format = is_null($user_id) ? null : '%d';

    $wpdb->insert(
      $table,
      [
        'user_id'   => $user_id,
        'type'      => $type,
        'title'     => $title,
        'message'   => $message,
        'icon'      => $icon,
        'is_seen'   => 0,
        'expires_at'=> $expires_at,
        'created_at'=> current_time('mysql'),
      ],
      [
        $user_id_format,
        '%s',
        '%s',
        '%s',
        '%s',
        '%d',
        '%s',
        '%s',
      ]
    );
  }
}
