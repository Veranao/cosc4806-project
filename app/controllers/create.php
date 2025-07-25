<?php

class Create extends Controller {

    public function index() {
	    $this->view('signup/index');
    }

  public function submit() {
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              $username = $_POST['username'];
              $password = $_POST['password'];
              $confirm = $_POST['confirm_password'];

              $user = $this->model('User');

              if ($user->checkUserExists($username)) {
                  $this->view('signup/index', ['error' => 'Username already exists']);
                  return;
              }

              if ($password !== $confirm) {
                  $this->view('signup/index', ['error' => 'Passwords do not match. Please try again']);
                  return;
              }

              if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password)) {
                  $this->view('signup/index', ['error' => 'Password must be at least 8 characters and include an uppercase letter']);
                  return;
              }

              $user->createUser($username, $password);

              $_SESSION['flash'] = "Account successfully created. Please log in.";
              header("Location: /login");
              exit;
          }

          header("Location: /create");
          exit;
      }
  }
