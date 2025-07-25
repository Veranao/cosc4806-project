<?php

class Login extends Controller {

    public function index() {		
			$lockout = false;
			
			if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] >= 3 && isset($_SESSION['lastFailedTime'])) {
					$elapsed_time = time() - $_SESSION['lastFailedTime'];
					if ($elapsed_time < 60) {
							$lockout = true;
					}
			}

			$this->view('login/index', ['lockout' => $lockout]);
    }
	

    public function verify() {
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];

			if(isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] >= 3 && isset($_SESSION['lastFailedTime'])) {
				$elapsed_time = time() - $_SESSION['lastFailedTime'];
				if ($elapsed_time < 60) {
					$_SESSION['flash'] = "You have failed " . $_SESSION['failedAuth'] . " times. Please wait " . (60 - $elapsed_time) . " seconds before you can try logging in again.";
					header("Location: /login");
					die;
				} else {
					unset($_SESSION['failedAuth']);
					unset($_SESSION['lastFailedTime']);
				}
			}
				
			$user = $this->model('User');
			$authenticated = $user->authenticate($username, $password);

			if ($authenticated) {
				header('Location: /home');
			} else {
				if(isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] >= 3 && isset($_SESSION['lastFailedTime'])) {
					$elapsed_time = time() - $_SESSION['lastFailedTime'];
					if ($elapsed_time < 60) {
						$_SESSION['flash'] = "You have failed " . $_SESSION['failedAuth'] . " too many times. Please wait " . (60 - $elapsed_time) . " seconds before you can try logging in again.";
						header("Location: /login");
					} else {
						unset($_SESSION['failedAuth']);
						unset($_SESSION['lastFailedTime']);
					}
				} elseif(isset($_SESSION['failedAuth']) && ($_SESSION['failedAuth'] > 0)) {
					$_SESSION['flash'] = "Your login credentials are incorrect. Please try again. Attempt number: " . $_SESSION['failedAuth'];
				} else {
						unset($_SESSION['failedAuth']);
						unset($_SESSION['lastFailedTime']);
					}
				header('Location: /login');
			}
		}

}
