<?php

require_once 'curl.php';

class GoogleReviews extends Curl {

    /**
     * @param string $place_id
     * @return mixed
     */
    public function get_reviews( $place_id ) {
        $link = 'https://maps.googleapis.com/maps/api/place/details/json';
        $info = json_decode(
            $this->fetch_get( $link, [
                'key' => get_option('kiwi_reviews_api_key'),
                'place_id' => $place_id
            ] )
        );
        return $info;
    }

}
