<?php

class Review {

    public function __construct() {

    }

    public function leave_review ($rating, $movieID) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO reviews (rating, movieID, username) VALUES (:rating, :movieID, :username)");
        $statement->bindValue(':rating', $rating);
        $statement->bindValue(':movieID', $movieID);
        $statement->bindValue(':username', $_SESSION['username']);
        $statement->execute();
    }

}
?>
