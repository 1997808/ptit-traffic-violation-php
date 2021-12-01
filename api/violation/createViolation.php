<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
  include_once('../../config/db.php');
  include_once('../../model/violation.php');

  $db = new db();
  $connect = $db->connect();
  $violation = new Violation($connect);
  
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  $violation->name = isset($data['name']) ? $data['name'] : null;
  $violation->amount = isset($data['amount']) ? $data['amount'] : null;
  $violation->vehicle = isset($data['vehicle']) ? $data['vehicle'] : null;

  $read = $violation->createViolation();
  if ($read) {
    echo true;
  } else {
    echo false;
  }
?>