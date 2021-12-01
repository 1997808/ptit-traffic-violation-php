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

  //get all data
  public function getAllUser() {
    $query = "SELECT * FROM user";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //get one data
  public function getOneUser() {
    $query = "SELECT * FROM user WHERE id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id );
    $stmt->execute();
    return $stmt;
  }

  //create data
  public function createUser() {
    echo $this->name;
    $query = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$this->name, $this->email, $this->password]);
    return $stmt;
  }


  //get all data
  public function read() {
    $query = "SELECT * FROM user";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }
}
?>