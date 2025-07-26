<?php


class Movies extends Controller {

    public function index() {		
      $this->view('movies/index');
    }

   public function search() {
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $title = $_POST['title'];
       
       $api = $this->model('API');
       $movie = $api->search_movie($title);
       $review = $api->get_review($title);
       
       $this->view('movies/movieinfo', ['movie' => $movie, 'review' => $review ]);

       
       echo '<pre>';
       print_r($review);
       echo '</pre>';
       die;
     }
   }

}