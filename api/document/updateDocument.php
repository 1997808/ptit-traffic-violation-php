<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
  include_once('../../config/db.php');
  include_once('../../model/document.php');

  $db = new db();
  $connect = $db->connect();
  $document = new Document($connect);
  
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);
  $datetime = date('Y-m-d H:i:s');

  $document->id = isset($data['id']) ? $data['id'] : null;
  $document->violationId = isset($data['violationId']) ? $data['violationId'] : null;
  $document->licensePlate = isset($data['licensePlate']) ? $data['licensePlate'] : null;
  $document->status = isset($data['status']) ? $data['status'] : null;
  $document->updateAt = $datetime;

  $read = $document->updateDocument();
  // $result = $read->fetch(PDO::FETCH_ASSOC);
  if ($read) {
    echo true;
  } else {
    echo false;
  }
?>