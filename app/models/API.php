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

        $data = array(
            "contents" => array(
                array(
                    "role" => "user",
                    "parts" => array(
                        array(
                            "text" => "Write a review of the movie " . $title . " based on the aggregate reviews for this movie, written as an IMDB, Rotten Tomatoes, or other popular movie review sites, written. Keep it under 150 words. Please format the review without markdown or html in the response prompt. Include one or more positive points and one or more negative points. Don't include movie title at the beginning of the review."
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
        $response = $response['candidates'][0]['content']['parts'][0]['text'];
        return $response;
    }

}
?>
