<?php
add_action( 'admin_menu', 'admin_menu_add', 20 );

function admin_menu_add() {
    add_menu_page(
        'Kiwi Google Reviews',
        'Kiwi Google Reviews',
        'administrator',
        'google-reviews',
        'kiwi_google_places',
        'dashicons-format-quote'
    );
}

if ( ! is_admin()) {
    add_shortcode('kiwi-google-review',  'kiwi_google_reviews');
}

function kiwi_google_reviews_generate_shortcode($id){
    add_shortcode('kiwi-google-review',  'kiwi_google_reviews', $id);
}

function kiwi_google_places() {
    require_once 'parse-places.php';
}

function kiwi_google_reviews($atts, $content = null) {
    extract( shortcode_atts( array( 'id' => '' ), $atts ) );
    global $place_id;
    if ( ! empty( $atts['place-id'] ) ) {
        $place_id = $atts['place-id'];
    } else {
        $place_id = '';
    }
    require_once 'parse-review.php';
    return true;
}