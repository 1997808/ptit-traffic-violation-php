<?php
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
  header('Access-Control-Allow-Credentials: true');
  
  include_once('../../config/db.php');
  include_once('../../model/document.php');

  $db = new db();
  $connect = $db->connect();
  $document = new Document($connect);

  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  $document->licensePlate = isset($data['licensePlate']) ? $data['licensePlate'] : null;
  $document->vehicle = isset($data['vehicle']) ? $data['vehicle'] : null;
  $read = $document->getSearchDocument();
  $results = $read->fetchAll(PDO::FETCH_ASSOC);
  $document_array = [];
  $document_array['data'] = [];
  // echo $results;
  if ($results) {
    //show the document
    foreach ($results as $result) {
      array_push($document_array['data'], $result);
    }
    echo json_encode($document_array);
  }
?>