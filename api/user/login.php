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
  
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  $user->email = isset($data['email']) ? $data['email'] : null;
  $user->password = isset($data['password']) ? $data['password'] : null;

  $read = $user->login();
  if($read->rowCount() > 0) {
    if($row = $read->fetch()) {
      // var_dump($row);
      // Password is correct, so start a new session
      session_start();
      
      // Store data in session variables
      $_SESSION["admin"] = true;
      // $_SESSION["id"] = $id;
      $_SESSION["email"] = $user->email;
    }
    else {
      // Username doesn't exist, display a generic error message
      $login_err = "Invalid username or password.";
    }
  }
  // $result = $read->fetch(PDO::FETCH_ASSOC);
  if ($read->rowCount() > 0) {
    echo 1;
  } else {
    echo 0;
  }
?>