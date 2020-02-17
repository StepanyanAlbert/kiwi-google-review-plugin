<?php

require_once 'curl.php';

class GooglePlaces extends Curl {

    /**
     * @param string $query
     * @return mixed
     */
    public function get_places($query) {
        $link ='https://maps.googleapis.com/maps/api/place/details/json';

        $info = json_decode(
            $this->fetch_get( $link, [
                'key' => get_option('kiwi_google_reviews_api_key'),
                'fields' => 'reviews',
                'place_id' => $query
            ] )
        );
        return $info;
    }

}
