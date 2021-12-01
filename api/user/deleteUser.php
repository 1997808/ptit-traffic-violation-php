<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
  include_once('../../config/db.php');
  include_once('../../model/user.php');

  $db = new db();
  $connect = $db->connect();
  $user = new User($connect);
  
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  $user->id = isset($data['id']) ? $data['id'] : null;

  $read = $user->deleteUser();
  if ($read) {
    echo true;
  } else {
    echo false;
  }
?>