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

  public function getSearchViolation() {
    $basequery = "SELECT * FROM violation";
    $where = " WHERE ";
    $name = "name LIKE :name";
    $and = " AND ";
    $vehicle = "vehicle LIKE :vehicle";
    if ($this->name || $this->vehicle) {
      $basequery = $basequery . $where;
      $count = 0;
      if ($this->name) {
        $basequery = $basequery . $name;
        $count++;
      } 
      if ($this->vehicle && $count != 0) {
        $basequery = $basequery . $and;
        $basequery = $basequery . $vehicle;
        $stmt = $this->conn->prepare($basequery);
        $stmt->bindValue(':name', '%' . $this->name . '%');
        $stmt->bindValue(':vehicle', '%' . $this->vehicle . '%');
      } else if ($this->vehicle && $count == 0) {
        $basequery = $basequery . $vehicle;
        $stmt = $this->conn->prepare($basequery);
        $stmt->bindValue(':vehicle', '%' . $this->vehicle . '%');
      } else if ($this->name && $count == 1) {
        $stmt = $this->conn->prepare($basequery);
        $stmt->bindValue(':name', '%' . $this->name . '%');
      }
    } else {
      $stmt = $this->conn->prepare($basequery);
    }
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

  //get by name vehicle
  public function checkExistViolation() {
    $query = "SELECT COUNT(id) FROM violation WHERE (name=? AND vehicle=?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->name);
    $stmt->bindParam(2, $this->vehicle);
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
    $stmt->execute([$this->name, $this->amount, $this->vehicle, $this->id]);
  }

  public function deleteViolation() {
    $query = "DELETE FROM violation WHERE id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$this->id]);
  }
}
?>