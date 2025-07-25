<?php

class API {

    public function __construct() {

    }

    public function search_movie ($title) {
        $query_url = "http://www.omdbapi.com/?apikey=" . $_ENV['omdb_key'] . "&t=" . urlencode($title);
        $response = file_get_contents($query_url);
        $response = json_decode($response, true);
        $movie = (array) $response;
        return $movie;
    }

}
?>
