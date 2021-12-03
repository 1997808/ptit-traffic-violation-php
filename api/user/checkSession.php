<?php
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
  header('Access-Control-Allow-Credentials: true');
  
  include_once('../../config/db.php');
  include_once('../../model/user.php');

  $db = new db();
  $connect = $db->connect();
  $user = new User($connect);
  
  session_start();
  if(!isset($_SESSION["admin"])) {
    echo 0;
  } else {
    echo 1;
  }
  // var_dump($_SESSION["admin"]);
  // var_dump($_SESSION["email"]);
?>