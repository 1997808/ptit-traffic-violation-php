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

  $user->name = isset($data['name']) ? $data['name'] : null;
  $user->email = isset($data['email']) ? $data['email'] : null;
  $user->password = isset($data['password']) ? $data['password'] : null;

  $read = $user->createUser();
  // $result = $read->fetch(PDO::FETCH_ASSOC);
  if ($read) {
    echo true;
  } else {
    echo false;
  }
?>