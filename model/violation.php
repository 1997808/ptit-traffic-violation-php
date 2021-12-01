<?php
class Violation {
  private $conn;

  //violation properties
  public $id;
  public $name;
  public $amount;
  public $vehicle;

  //connect db
  public function __construct($db) {
    $this->conn = $db;
  }

  //get all data
  public function getAllViolation() {
    $query = "SELECT * FROM violation";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //get one data
  public function getOneViolation() {
    $query = "SELECT * FROM violation WHERE id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    return $stmt;
  }

  //create data
  public function createViolation() {
    $query = "INSERT INTO violation (name, amount, vehicle) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$this->name, $this->amount, $this->vehicle]);
  }

  public function updateViolation() {
    $query = "UPDATE violation SET name=?, amount=?, vehicle=? WHERE id=?";
    $stmt = $this->conn->prepare($query);
    if($stmt->execute([$this->name, $this->amount, $this->vehicle, $this->id])) {
      return true;
    }
    printf("Error %s. \n", $stmt->error);
    return false;
  }

  public function deleteViolation() {
    $query = "DELETE FROM violation WHERE id=?";
    $stmt = $this->conn->prepare($query);
    if($stmt->execute([$this->id])) {
      return true;
    }
    printf("Error %s. \n", $stmt->error);
    return false;
  }
}
?>