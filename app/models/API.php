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

    public function get_review($title) {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $_ENV['GEMINI'];

        echo $url;
        echo "<br>";

        $data = array(
            "contents" => array(
                array(
                    "role" => "user",
                    "parts" => array(
                        array(
                            "text" => "Write a review of the movie " . $title . "."
                        )
                    )
                )
            )
        );

        $json_data = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        $response = curl_exec($ch);
        curl_close($ch);

        if(curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
            return null;
        }

        
        $response = json_decode($response, true);
        return $response;
    }

}
?>
