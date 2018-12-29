<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
    
   //"X-Requested-With "   help with cross side scripting attacks

   include_once '../../config/Database.php';
   include_once '../../models/Order.php';

   //Instantiate DB & Connect
   $database = new Database();
   $db = $database->connect();
   
   $order = new Order($db);

  // Get raw posted data
   $data = json_decode(file_get_contents("php://input"));
   $order->order_address = $data->order_address;
   $order->phone = $data->phone;
   $order->area = $data->area;
   $order->order_date = $data->order_date;
   $order->order_time = $data->order_time;
   $order->service_rate = $data->service_rate;
   $order->user_id = $data->user_id;

   //Create order
   if($order->create()){
       echo json_encode(array(
           'message' => 'order Created Successfully'
        ));
   }else{
       echo json_encode(array(
           'message' => 'order Not Created'
       ));
   }

