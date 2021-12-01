<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
  include_once('../../config/db.php');
  include_once('../../model/violation.php');

  $db = new db();
  $connect = $db->connect();
  $violation = new Violation($connect);
  
  $read = $violation->getAllViolation();
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