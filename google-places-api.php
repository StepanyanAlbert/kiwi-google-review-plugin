<?php

require_once 'curl.php';

class GooglePlaces extends Curl {

    /**
     * @param string $query
     * @return mixed
     */
    public function get_places($query) {
        $link = 'https://maps.googleapis.com/maps/api/place/textsearch/json';

        return json_decode(
            $this->fetch_get( $link, [
                'key' => self::KEY,
                'query' => $query
            ] )
        );
    }

}