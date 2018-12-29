<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
    
   //"X-Requested-With "   help with cross side scripting attacks

   include_once '../../config/Database.php';
   include_once '../../models/Service.php';

   //Instantiate DB & Connect
   $database = new Database();
   $db = $database->connect();
   
   $service = new Service($db);

  // Get raw posted data
   $data = json_decode(file_get_contents("php://input"));
   $service->name = $data->name;
   $service->price = $data->price;
   $service->category_id = $data->category_id;

   //Create Service
   if($service->create()){
       echo json_encode(array(
           'message' => 'service Created Successfully'
        ));
   }else{
       echo json_encode(array(
           'message' => 'service Not Created'
       ));
   }

