<?php

class User
{

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {}

    public function test()
    {
        $db = db_connect();
        $statement = $db->prepare("select * from users;");
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function authenticate($username, $password)
    {
        /*
         * if username and password good then
         * $this->auth = true;
         */
        $username = strtolower($username);
        $db = db_connect();
        $statement = $db->prepare("select * from users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
        //echo $username;

        if (password_verify($password, $rows['password'])) {
            $this->logLoginAttempt($username, "good");
            //echo $password;
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = ucwords($username);
            $_SESSION['user_id'] = $rows['id'];
            unset($_SESSION['failedAuth']);
            header('Location: /home');
            die;
        } else {
            $this->logLoginAttempt($username, "bad");

            if (isset($_SESSION['failedAuth'])) {
                $_SESSION['failedAuth']++; //increment
            } else {
                $_SESSION['failedAuth'] = 1;
            }
            header('Location: /login');
            die;
        }
    }

    public function createUser($username, $password)
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hashed);
        $statement->execute();
    }

    public function checkUserExists($username)
    {
        $user = $this->get_user($username);
        return $user != null;
    }

    public function get_user($username)
    {
        $dbh = db_connect();
        $statement = $dbh->prepare("select * from users where username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return reset($rows);
    }

    public function get_all_users()
    {
        $dbh = db_connect();
        $statement = $dbh->prepare("select users.id, users.username, sum(case when logs.attempt='good' then 1 else 0 end) as successful_logins, sum(case when logs.attempt='bad' then 1 else 0 end) as failed_logins, count(notes.id) as reminder_count from users left join logs on users.username = logs.username left join notes on notes.user_id = users.id group by users.id, users.username");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function logLoginAttempt($username, $attempt)
    {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO logs (username, attempt) VALUES (:username, :attempt)");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':attempt', $attempt);
        $statement->execute();
    }

    public function get_all_logins() {
        $db = db_connect();
        $statement = $db->prepare("select * from logs");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function isAdmin()
    {
        return $_SESSION['username'] == 'Admin';
    }
}
