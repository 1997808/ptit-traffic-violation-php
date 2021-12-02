<?php
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Allow-Methods: DELETE');
  
  include_once('../../config/db.php');
  include_once('../../model/violation.php');

  $db = new db();
  $connect = $db->connect();
  $violation = new Violation($connect);
  
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  // $violation->id = isset($data['id']) ? $data['id'] : null;
  $violation->id = isset($_GET['id']) ? $_GET['id'] : null;
  $read = $violation->deleteViolation();
  var_dump($read);
?>