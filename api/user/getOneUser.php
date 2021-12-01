<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
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