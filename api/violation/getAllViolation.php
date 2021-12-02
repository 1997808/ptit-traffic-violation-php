<?php
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
  header('Access-Control-Allow-Credentials: true');

  include_once('../../config/db.php');
  include_once('../../model/violation.php');

  $db = new db();
  $connect = $db->connect();
  $violation = new Violation($connect);
  
  // $read = $violation->getAllViolation();
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  $violation->name = isset($data['name']) ? $data['name'] : null;
  // $violation->amount = isset($data['amount']) ? $data['amount'] : null;
  $violation->vehicle = isset($data['vehicle']) ? $data['vehicle'] : null;
  // $violation->name = isset($_GET['name']) ? $_GET['name'] : null;
  // $violation->vehicle = isset($_GET['vehicle']) ? $_GET['vehicle'] : null;
  $read = $violation->getSearchViolation();
  $results = $read->fetchAll(PDO::FETCH_ASSOC);
  $violation_array = [];
  $violation_array['data'] = [];
  // echo $results;
  if ($results) {
    //show the violation
    foreach ($results as $result) {
      array_push($violation_array['data'], $result);
    }
    echo json_encode($violation_array);
  }
?>