<?php
class Document {
  private $conn;

  //document properties
  public $id;
  public $violationId;
  public $licensePlate;
  // public $name;
  // public $amount;
  // public $vehicle;
  public $status;
  public $createAt;
  public $updateAt;

  //connect db
  public function __construct($db) {
    $this->conn = $db;
  }

  //get all data
  public function getAllDocument() {
    $query = "SELECT document.*, violation.name, violation.amount, violation.vehicle FROM document INNER JOIN violation ON document.violationId = violation.id ORDER BY document.createAt DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  // public function getViolationStatistic() {
  //   $query = "SELECT document.*, violation.name, violation.amount, violation.vehicle FROM document INNER JOIN violation ON document.violationId = violation.id ORDER BY document.createAt DESC";
  //   $stmt = $this->conn->prepare($query);
  //   $stmt->execute();
  //   return $stmt;
  // }

  //get one data
  public function getOneDocument() {
    // $query = "SELECT * FROM document WHERE id=?";
    $query = "SELECT document.*, violation.name, violation.amount, violation.vehicle FROM document INNER JOIN violation ON document.violationId = violation.id HAVING id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    return $stmt;
  }

  //create data
  public function createDocument() {
    $query = "INSERT INTO document (violationId, licensePlate, status, createAt, updateAt) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$this->violationId, $this->licensePlate, $this->status, $this->createAt, $this->updateAt]);
  }

  public function updateDocument() {
    $query = "UPDATE document SET violationId=?, licensePlate=?, status=?, updateAt=? WHERE id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$this->violationId, $this->licensePlate, $this->status, $this->updateAt, $this->id]);
  }

  public function deleteDocument() {
    $query = "DELETE FROM document WHERE id=?";
    $stmt = $this->conn->prepare($query);
    if($stmt->execute([$this->id])) {
      return true;
    }
    printf("Error %s. \n", $stmt->error);
    return false;
  }
}
?>