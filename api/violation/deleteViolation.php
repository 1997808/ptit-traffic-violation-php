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

  $violation->id = isset($data['id']) ? $data['id'] : null;

  $read = $violation->deleteViolation();
  if ($read) {
    echo true;
  } else {
    echo false;
  }
?>