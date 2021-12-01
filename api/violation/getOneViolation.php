<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
  include_once('../../config/db.php');
  include_once('../../model/violation.php');

  $db = new db();
  $connect = $db->connect();
  $violation = new Violation($connect);
  
  $violation->id = isset($_GET['id']) ? $_GET['id'] : die();
  $read = $violation->getOneViolation();

  $result = $read->fetch(PDO::FETCH_ASSOC);
  if ($result) {
    echo json_encode($result);
  }
?>