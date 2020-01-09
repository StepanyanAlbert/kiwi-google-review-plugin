<?php
require_once 'google-places-api.php';

wp_enqueue_script( 'places-script', plugins_url( '/views/js/query.js', __FILE__ ), ['jquery'], '', TRUE );

if ( ! empty($_POST['query'] ) ) {
    $query = $_POST['query'];
} else {
    $query = '';
}

$google_places = new GooglePlaces();
$results = $google_places->get_places( $query )->results;

$parse_result = [];
foreach ( $results as $result ) {

    $parse_result[] = [
        'name' => $result->name,
        'rating' => $result->rating,
        'place_id' => $result->place_id
    ];
}
?>
<!--
<input id="query" type="text" onchange="queryPlaces(event)">
<div id="result"></div>
-->

