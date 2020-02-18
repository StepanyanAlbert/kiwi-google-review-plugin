<?php
add_action('admin_menu', 'admin_menu_add', 20);
add_action('admin_post_submit-form', 'wp_google_reviews_generate_shortcode'); // If the user is logged in

function admin_menu_add()
{
  add_menu_page(
    'WP Google Reviews',
    'WP Google Reviews',
    'administrator',
    'google-reviews',
    'wp_google_places',
    'dashicons-format-quote'
  );
}

if (! is_admin()) {
  add_shortcode('wp-google-review', 'wp_google_reviews');
}

function wp_google_places()
{
  require_once 'parse-places.php';
}

function wp_google_reviews($atts, $content = null)
{
  extract(shortcode_atts(array( 'id' => '' ), $atts));
  global $place_id;
  if (! empty($atts['place-id'])) {
      $place_id = $atts['place-id'];
  } else {
      $place_id = '';
  }
  require 'parse-review.php';
}

function wp_google_reviews_generate_shortcode($id)
{
  add_shortcode('wp-google-review', 'wp_google_reviews', $id);
}
