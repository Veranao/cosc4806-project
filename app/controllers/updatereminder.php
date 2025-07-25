<?php

class UpdateReminder extends Controller {

    public function index() {		
      $this->view('updatereminder/index');
      die;
    }

    public function update() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $reminder_id = $_POST['reminder_id'];
          $subject = $_POST['subject'];
          $reminder = $this->model('Reminder');
          $reminder->update_reminder($reminder_id, $subject);

          $_SESSION['flash'] = "Reminder updated successfully.";

          header("Location: /reminders");
          exit;
      }
    }

}