<?php
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: true', 'Origin, X-Requested-With, Content-Type, Accept');
  header('Access-Control-Allow-Credentials: true');
  
  include_once('../../config/db.php');
  include_once('../../model/document.php');

  $db = new db();
  $connect = $db->connect();
  $document = new Document($connect);
  
  $document->id = isset($_GET['id']) ? $_GET['id'] : die();
  $read = $document->getOneDocument();
  $datetime = date('Y-m-d H:i:s');

  $result = $read->fetch(PDO::FETCH_ASSOC);
  if ($result) {
    echo json_encode($result);
  }
?>