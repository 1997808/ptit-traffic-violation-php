<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
  include_once('../../config/db.php');
  include_once('../../model/user.php');

  $db = new db();
  $connect = $db->connect();
  $user = new User($connect);
  $read = $user->getAllUser();

  $results = $read->fetchAll(PDO::FETCH_ASSOC);
  $user_array = [];
  $user_array['data'] = [];
  // echo $results;
  if ($results) {
    //show the user
    foreach ($results as $result) {
      array_push($user_array['data'], $result);
    }
    echo json_encode($user_array);
  }
?>