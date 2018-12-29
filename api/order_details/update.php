<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
    
   //"X-Requested-With "   help with cross side scripting attacks

   include_once '../../config/Database.php';
   include_once '../../models/Order_detail.php';

   //Instantiate DB & Connect
   $database = new Database();
   $db = $database->connect();
   
   $order_details = new Order_detail($db);

  // Get Array of json data for order_details 
   $data = json_decode(file_get_contents("php://input"));
   
   //Getting Last Order ID 
   $order_id = $order_details->GetLastOrderID();

   foreach ($data as $dataItem) {
         // Set ID to update
        $order_details->id = $data->id;
        $order_details->order_id = $order_id;
        $order_details->service_name = $data->service_name;
        //creating New row in order_Details 
        $order_details->update();
   }

   //return json message to notice the user
   echo json_encode(array(
    'message' => 'Order Details Updated Successfully'
 ));  
