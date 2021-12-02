<?php
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: true', 'Origin, X-Requested-With, Content-Type, Accept');
  header('Access-Control-Allow-Credentials: true');
  
  include_once('../../config/db.php');
  include_once('../../model/user.php');

  $db = new db();
  $connect = $db->connect();
  $user = new User($connect);

  $user->id = isset($_GET['id']) ? $_GET['id'] : die();
  $read = $user->getOneUser();

  $result = $read->fetch(PDO::FETCH_ASSOC);
  if ($result) {
    echo json_encode($result);
  }
?>