<?php
class User {
  private $conn;

  //user properties
  public $id;
  public $name;
  public $email;
  public $password;

  //connect db
  public function __construct($db) {
    $this->conn = $db;
  }

  //read data
  public function read() {
    $query = "SELECT * FROM user";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }
}
?>