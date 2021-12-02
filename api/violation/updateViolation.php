<?php
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: true', 'Origin, X-Requested-With, Content-Type, Accept');
  header('Access-Control-Allow-Credentials: true');
  
  include_once('../../config/db.php');
  include_once('../../model/violation.php');

  $db = new db();
  $connect = $db->connect();
  $violation = new Violation($connect);
  
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  $violation->id = isset($data['id']) ? $data['id'] : null;
  $violation->name = isset($data['name']) ? $data['name'] : null;
  $violation->amount = isset($data['amount']) ? $data['amount'] : null;
  $violation->vehicle = isset($data['vehicle']) ? $data['vehicle'] : null;

  $read = $violation->updateViolation();
  // $result = $read->fetch(PDO::FETCH_ASSOC);
  if ($read) {
    echo true;
  } else {
    echo false;
  }
?>