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

  $document->id = isset($data['id']) ? $data['id'] : null;

  $read = $document->deleteDocument();
  if ($read) {
    echo true;
  } else {
    echo false;
  }
?>