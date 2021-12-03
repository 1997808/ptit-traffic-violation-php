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
  
  session_start();
  // var_dump($_SESSION["admin"]);
  // var_dump($_SESSION["email"]);
  session_destroy();
?>