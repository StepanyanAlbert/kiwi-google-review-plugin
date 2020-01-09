<?php

require_once 'curl.php';

class GoogleReviews extends Curl {

    /**
     * @param string $place_id
     * @return mixed
     */
    public function get_reviews( $place_id ) {
        $link = 'https://maps.googleapis.com/maps/api/place/details/json';

        return json_decode(
            $this->fetch_get( $link, [
                'key' => self::KEY,
                'place_id' => $place_id
            ] )
        );
    }

}