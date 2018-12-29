<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
    
   //"X-Requested-With "   help with cross side scripting attacks

   include_once '../../config/Database.php';
   include_once '../../models/User.php';

   //Instantiate DB & Connect
   $database = new Database();
   $db = $database->connect();
   
   //Instantiate  blog Post Object
   $user = new User($db);

  // Get raw posted data
   $data = json_decode(file_get_contents("php://input"));
   $user->username = $data->username;
   $user->password = $data->password;
   $user->email = $data->email;
   $user->phone = $data->phone;

   //Create Post
 $newUser= $user->createNewUser();
  echo json_encode(array(
    'message' => $newUser->message
    ));
   