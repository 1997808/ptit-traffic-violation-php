<?php
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Allow-Methods: DELETE');
  
  include_once('../../config/db.php');
  include_once('../../model/document.php');

  $db = new db();
  $connect = $db->connect();
  $document = new Document($connect);
  
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  session_start();
  if(isset($_SESSION["admin"])) {
    // $document->id = isset($data['id']) ? $data['id'] : null;
    $document->id = isset($_GET['id']) ? $_GET['id'] : null;
    $read = $document->deleteDocument();
    if ($read) {
      echo true;
    } else {
      echo false;
    }
  }
?>