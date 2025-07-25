<?php

class CreateReminder extends Controller {

    public function index() {		
      $this->view('createreminder/index');
      die;
    }

    public function create() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $subject = $_POST['subject'];
          $reminder = $this->model('Reminder');
          $reminder->create($subject);

          $_SESSION['flash'] = "Reminder added successfully.";

          header("Location: /reminders");
          exit;
      }
    }

}