<?php
require_once 'google-places-api.php';

wp_enqueue_script( 'places-script', plugins_url( '/views/js/query.js', __FILE__ ), ['jquery'], '', TRUE );
wp_enqueue_script( 'google-maps-places-script', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAN-TC-ZXQtGil7IhxCS4n84yqyIxRr614&sensor=false&libraries=places&callback=initialize', ['jquery'], '', TRUE );
wp_enqueue_style( 'review-style', plugins_url( '/views/css/style.css', __FILE__ ), [], '' );

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

<div class='kiwi-map-container'>
    <form autocomplete="off" action="<?php echo plugins_url( 'form-submit.php', __FILE__ ); ?>" method="POST">
        <input id="searchTextField" class="kiwi-map-search" type="text" name="query">
        <input id="kiwi-place-id" name="place_id" type="hidden">
        <div id="map"></div>

        <button id="submit-btn" class="kiwi-confirm-btn" disabled>Submit</button>
    </form>
</div>

<script>
    var map;
    var markers = [];

    function initialize() {

        var input = document.getElementById('searchTextField');
        autocomplete = new google.maps.places.Autocomplete(input);

        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -34.397,
                lng: 150.644
            },
            zoom: 8
        });


        var service = new google.maps.places.PlacesService(map);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {

            var request = {
                location: map.getCenter(),
                radius: '500',
                query: document.getElementById('searchTextField').value
            };
            service.textSearch(request, callback);
        });
    }

    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }


    function clearMarkers() {
        setMapOnAll(null);
    }

    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }

    function callback(results, status) {
        deleteMarkers();
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            var valid = true;
            var marker = new google.maps.Marker({
                map: map,
                place: {
                    placeId: results[0].place_id,
                    location: results[0].geometry.location
                }
            });
            markers.push(marker);
            map.setCenter(results[0].geometry.location);
            document.getElementById('kiwi-place-id').value = results[0].place_id;
        } else {
            var valid = false;
        }
        if (!valid) {
            document.getElementById('submit-btn').setAttribute("disabled", "true");
        } else {
            document.getElementById('submit-btn').removeAttribute("disabled");
            document.getElementById('submit-btn').focus();
        }
    }
</script>
<!--
<input id="query" type="text" onchange="queryPlaces(event)">
<div id="result"></div>
-->