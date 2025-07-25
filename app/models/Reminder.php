<?php

class Reminder {

    public function __construct() {

    }

    public function get_all_reminders () {
      $db = db_connect();
      $statement = $db->prepare("select notes.*, users.username from notes LEFT JOIN users ON notes.user_id = users.id where deleted_at IS NULL ORDER BY notes.created_at DESC;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function get_user_reminders () {
      $db = db_connect();
      $statement = $db->prepare("select * from notes where user_id = :user_id AND deleted_at IS NULL;");
      $statement->bindValue(':user_id', $_SESSION['user_id']);
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function get ($id) {
      $db = db_connect();
      $statement = $db->prepare("select * from notes where id = :id;");
      $statement->bindValue(':id', $id);
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);

      return $rows;
    }

    public function update_reminder ($id, $subject) {
      $db = db_connect();
      $statement = $db->prepare("UPDATE notes SET subject = :subject, modified_at = NOW(3) WHERE id = :id");
      $statement->bindValue(':subject', $subject);
      $statement->bindValue(':id', $id);
      $statement->execute();
    }

    public function create($subject) {
      $db = db_connect();
      $statement = $db->prepare("INSERT INTO notes (user_id, subject) VALUES (:user_id, :subject)");
      $statement->bindValue(':user_id', $_SESSION['user_id']);
      $statement->bindValue(':subject', $subject);
      $statement->execute();
    }

    public function delete ($id) {
      $db = db_connect();
      $statement = $db->prepare("UPDATE notes SET deleted_at = NOW(3) WHERE id = :id");
      $statement->bindValue(':id', $id);
      $statement->execute();
      
    }

    public function mark_complete ($id) {
      $db = db_connect();
      $statement = $db->prepare("UPDATE notes SET completed_at = NOW(3) WHERE id = :id");
      $statement->bindValue(':id', $id);
      $statement->execute();
  
    }
}
?>
