<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
  include_once('../../config/db.php');
  include_once('../../model/user.php');

  $db = new db();
  $connect = $db->connect();
  $user = new User($connect);
  $read = $user->read();

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
  // $num = $read->rowCount();
  // echo $num;
  // if ($num > 0) {
  //   $user_array = [];
  //   $user_array['data'] = [];

  //   while($row = $read->fetch(PDO::FETCH_ASSOC)) {
  //     extract($row);
  //     $user_item = array(
  //       'id' => $id,
  //       'name' => $name,
  //       'email' => $email,
  //       'password' => $password
  //     );
  //     array_push($user_array['data'], $user_item);
  //   }
  //   echo json_encode($user_array);
  // }
?>