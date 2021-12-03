<?php
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE');

  include_once('../../config/db.php');
  include_once('../../model/violation.php');

  $db = new db();
  $connect = $db->connect();
  $violation = new Violation($connect);
  
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  session_start();
  if(isset($_SESSION["admin"])) {
    $violation->name = isset($data['name']) ? $data['name'] : null;
    $violation->amount = isset($data['amount']) ? $data['amount'] : null;
    $violation->vehicle = isset($data['vehicle']) ? $data['vehicle'] : null;
    
    $check = $violation->checkExistViolation();
    if($check->fetch(PDO::FETCH_COLUMN) == '0') {
      $read = $violation->createViolation();
      echo true;
    } else {
      echo false;
    }
  }
?>