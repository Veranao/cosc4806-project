<?php

class Reminders extends Controller {

    public function index() {		
      $reminder = $this->model('Reminder');
      $reminders = $reminder->get_user_reminders();

      $this->view('reminders/index', ['reminders' => $reminders]);
      die;
    }

    public function delete() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $reminder_id = $_POST['reminder_id'];

          $reminder = $this->model('Reminder');
          $reminder->delete($reminder_id);

          $_SESSION['flash'] = "Reminder deleted successfully.";
        
          header("Location: /reminders");
          exit;
      }
    }

  public function mark_complete() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reminder_id = $_POST['reminder_id'];

        $reminder = $this->model('Reminder');
        $reminder->mark_complete($reminder_id);

        $_SESSION['flash'] = "Task completed.";

        header("Location: /reminders");
        exit;
    }
  }

  public function edit() {
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reminder_id = $_POST['reminder_id'];

        $reminderModel = $this->model('Reminder');
        $reminder = $reminderModel->get($reminder_id);
      
        $this->view('updatereminder/index', ['reminder' => $reminder ]);
        die;
    }
  }

}