<?php

if (!defined('ABSPATH')) {
    exit;
}

function pzfilm_create_game_scores_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'pzfilm_game_scores';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$table_name} (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        game_key varchar(100) NOT NULL,
        player_name varchar(64) NOT NULL,
        movie_title varchar(120) NOT NULL DEFAULT '',
        score int(11) NOT NULL,
        created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        KEY game_key_score_idx (game_key, score)
    ) {$charset_collate};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);

    update_option('pzfilm_game_scores_table_version', '1.1.0');
}

add_action('init', function () {
    $version = get_option('pzfilm_game_scores_table_version');

    if ($version !== '1.1.0') {
        pzfilm_create_game_scores_table();
    }
});

add_action('wp_ajax_pzfilm_get_game_leaderboard', 'pzfilm_get_game_leaderboard_handler');
add_action('wp_ajax_nopriv_pzfilm_get_game_leaderboard', 'pzfilm_get_game_leaderboard_handler');

function pzfilm_get_game_leaderboard_handler() {
    global $wpdb;

    check_ajax_referer('pzfilm_global_nonce', 'nonce');

    $game_key = isset($_POST['game_key']) ? sanitize_key(wp_unslash($_POST['game_key'])) : '';

    if (empty($game_key)) {
        wp_send_json_error(['message' => 'Nedostaje game key.'], 400);
    }

    $table_name = $wpdb->prefix . 'pzfilm_game_scores';

    $rows = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT player_name, movie_title, score FROM {$table_name}
             WHERE game_key = %s
             ORDER BY score DESC, created_at ASC, id ASC
             LIMIT 10",
            $game_key
        ),
        ARRAY_A
    );

    wp_send_json_success([
        'leaderboard' => array_map(
            static function ($row) {
                return [
                    'player_name' => (string) $row['player_name'],
                    'movie_title' => (string) ($row['movie_title'] ?? ''),
                    'score' => (int) $row['score'],
                ];
            },
            $rows ?: []
        ),
    ]);
}

add_action('wp_ajax_pzfilm_save_game_score', 'pzfilm_save_game_score_handler');
add_action('wp_ajax_nopriv_pzfilm_save_game_score', 'pzfilm_save_game_score_handler');

function pzfilm_save_game_score_handler() {
    global $wpdb;

    check_ajax_referer('pzfilm_global_nonce', 'nonce');

    $game_key = isset($_POST['game_key']) ? sanitize_key(wp_unslash($_POST['game_key'])) : '';
    $player_name = isset($_POST['player_name']) ? sanitize_text_field(wp_unslash($_POST['player_name'])) : '';
    $movie_title = isset($_POST['movie_title']) ? sanitize_text_field(wp_unslash($_POST['movie_title'])) : '';
    $score = isset($_POST['score']) ? (int) $_POST['score'] : 0;

    if (empty($game_key) || empty($player_name)) {
        wp_send_json_error(['message' => 'Nedostaju podaci.'], 400);
    }

    $player_name = mb_substr($player_name, 0, 24);
    $movie_title = mb_substr($movie_title, 0, 120);

    if ($score <= 0) {
        wp_send_json_error(['message' => 'Score mora biti veci od 0.'], 400);
    }

    $table_name = $wpdb->prefix . 'pzfilm_game_scores';

    $current_top = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT score FROM {$table_name}
             WHERE game_key = %s
             ORDER BY score DESC, created_at ASC, id ASC
             LIMIT 10",
            $game_key
        ),
        ARRAY_A
    );

    $qualifies = true;

    if (count($current_top) >= 10) {
        $lowest_top_score = (int) ($current_top[count($current_top) - 1]['score'] ?? 0);
        $qualifies = $score > $lowest_top_score;
    }

    if (!$qualifies) {
        wp_send_json_error(['message' => 'Rezultat nije dovoljno visok za top 10.'], 400);
    }

    $insert_result = $wpdb->insert(
        $table_name,
        [
            'game_key' => $game_key,
            'player_name' => $player_name,
            'movie_title' => $movie_title,
            'score' => $score,
            'created_at' => current_time('mysql'),
        ],
        ['%s', '%s', '%s', '%d', '%s']
    );

    if ($insert_result === false) {
        wp_send_json_error(['message' => 'Neuspesno cuvanje rezultata.'], 500);
    }

    $top_ids = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT id FROM {$table_name}
             WHERE game_key = %s
             ORDER BY score DESC, created_at ASC, id ASC
             LIMIT 10",
            $game_key
        )
    );

    if (!empty($top_ids)) {
        $in_sql = implode(',', array_map('intval', $top_ids));
        $wpdb->query(
            $wpdb->prepare(
                "DELETE FROM {$table_name}
                 WHERE game_key = %s
                 AND id NOT IN ({$in_sql})",
                $game_key
            )
        );
    }

    $leaderboard = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT player_name, movie_title, score FROM {$table_name}
             WHERE game_key = %s
             ORDER BY score DESC, created_at ASC, id ASC
             LIMIT 10",
            $game_key
        ),
        ARRAY_A
    );

    wp_send_json_success([
        'leaderboard' => array_map(
            static function ($row) {
                return [
                    'player_name' => (string) $row['player_name'],
                    'movie_title' => (string) ($row['movie_title'] ?? ''),
                    'score' => (int) $row['score'],
                ];
            },
            $leaderboard ?: []
        ),
    ]);
}
