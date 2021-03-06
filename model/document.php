<?php
class Document {
  private $conn;

  //document properties
  public $id;
  public $violationId;
  public $licensePlate;
  // public $name;
  // public $amount;
  public $vehicle;
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

  public function getSearchDocument() {
    $basequery = "SELECT document.*, violation.name, violation.amount, violation.vehicle FROM document INNER JOIN violation ON document.violationId = violation.id";
    $where = " WHERE ";
    $licensePlate = "licensePlate LIKE :licensePlate";
    $and = " AND ";
    $vehicle = "vehicle LIKE :vehicle";
    $orderby = " ORDER BY document.createAt DESC";
    if ($this->licensePlate || $this->vehicle) {
      $basequery = $basequery . $where;
      $count = 0;
      if ($this->licensePlate) {
        $basequery = $basequery . $licensePlate;
        $count++;
      } 
      if ($this->vehicle && $count != 0) {
        $basequery = $basequery . $and;
        $basequery = $basequery . $vehicle;
        $basequery = $basequery . $orderby;
        $stmt = $this->conn->prepare($basequery);
        $stmt->bindValue(':licensePlate', '%' . $this->licensePlate . '%');
        $stmt->bindValue(':vehicle', '%' . $this->vehicle . '%');
      } else if ($this->vehicle && $count == 0) {
        $basequery = $basequery . $vehicle;
        $basequery = $basequery . $orderby;
        $stmt = $this->conn->prepare($basequery);
        $stmt->bindValue(':vehicle', '%' . $this->vehicle . '%');
      } else if ($this->licensePlate && $count == 1) {
        $basequery = $basequery . $orderby;
        $stmt = $this->conn->prepare($basequery);
        $stmt->bindValue(':licensePlate', '%' . $this->licensePlate . '%');
      }
    } else {
      $basequery = $basequery . $orderby;
      $stmt = $this->conn->prepare($basequery);
    }
    $stmt->execute();
    return $stmt;
  }

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
    return $stmt;
  }

  public function payDocument() {
    $query = "UPDATE document SET status=?, updateAt=? WHERE id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$this->status, $this->updateAt, $this->id]);
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

  public function countDocumentByViolation() {
    $query = "SELECT violation.name, COUNT(vehicle) as quantity, COUNT(CASE WHEN vehicle = 'oto' THEN 1 END) as oto, COUNT(CASE WHEN vehicle = 'xemay' THEN 1 END) as xemay, COUNT(CASE WHEN vehicle = 'xedien' THEN 1 END) as xedien FROM document INNER JOIN violation ON document.violationId = violation.id GROUP BY violation.name ORDER BY 2 DESC LIMIT 5";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function countDocumentByVehicle() {
    $query = "SELECT COUNT(CASE WHEN vehicle = 'oto' THEN 1 END) as oto, COUNT(CASE WHEN vehicle = 'xemay' THEN 1 END) as xemay, COUNT(CASE WHEN vehicle = 'xedien' THEN 1 END) as xedien FROM document INNER JOIN violation ON document.violationId = violation.id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function countDocumentByStatus() {
    $query = "SELECT COUNT(*) as quantity, COUNT(CASE WHEN status = 'paid' THEN 1 END) as paid, COUNT(CASE WHEN status = 'unpaid' THEN 1 END) as unpaid FROM document INNER JOIN violation ON document.violationId = violation.id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }
}
?>