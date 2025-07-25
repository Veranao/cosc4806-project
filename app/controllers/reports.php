<?php

class Reports extends Controller {

    public function index() {		
      $reminder = $this->model('Reminder');
      $user = $this->model('User');

      $queries = array();
      parse_str($_SERVER['QUERY_STRING'], $queries);

      if (isset($queries['type'])) {
        $query = $queries['type'];
        if ($query == 'reminders') {     
          $reminders = $reminder->get_all_reminders();
          $this->view('reports/reminders', ['reminders' => $reminders]);
        } 
        elseif ($query == 'users') { 
          $users = $user->get_all_users();
          $logs = $user->get_all_logins();
          $this->view('reports/users', ['users' => $users, 'logs' => $logs]);
        }  
      }
      else {
        $reminders = $reminder->get_all_reminders();
        $users = $user->get_all_users();
        $this->view('reports/index', ['reminders' => $reminders, 'users' => $users]);
      }

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