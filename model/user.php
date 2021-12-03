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
    // $stmt->execute([$this->id]);
    $stmt->execute();
    return $stmt;
  }

  public function login() {
    $query = "SELECT * FROM user WHERE email=? AND password=?";
    $stmt = $this->conn->prepare($query);
    // $stmt->bindParam(1, $this->id );
    $stmt->execute([$this->email, $this->password]);
    // $stmt->execute();
    return $stmt;
  }

  // public function logout() {
  //   $query = "SELECT * FROM user WHERE id=?";
  //   $stmt = $this->conn->prepare($query);
  //   $stmt->bindParam(1, $this->id );
  //   // $stmt->execute([$this->id]);
  //   $stmt->execute();
  //   return $stmt;
  // }

  //create data
  public function createUser() {
    $query = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$this->name, $this->email, $this->password]);
  }

  public function updateUser() {
    $query = "UPDATE user SET name=?, email=?, password=? WHERE id=?";
    $stmt = $this->conn->prepare($query);
    if($stmt->execute([$this->name, $this->email, $this->password, $this->id])) {
      return true;
    }
    printf("Error %s. \n", $stmt->error);
    return false;
  }

  public function deleteUser() {
    $query = "DELETE FROM user WHERE id=?";
    $stmt = $this->conn->prepare($query);
    if($stmt->execute([$this->id])) {
      return true;
    }
    printf("Error %s. \n", $stmt->error);
    return false;
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