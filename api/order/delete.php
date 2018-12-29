<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Order.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog order object
  $order = new Order($db);

  // Get raw ordered data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $order->id = $data->id;

  // Delete order
  if($order->delete()) {
    // Instantiate blog order detail object to delete all order details associated with this order
    $order_detail = new Order_detail($db);
    //set Order ID In Order details equal to Current ID
    $order_detail->order_id=$data->id;
    //call to method readAllOrderDetails to get all order details for specific order and delete it
   $order_detailsToDelete= $order_detail->readAllOrderDetails();
   foreach ($order_detailsToDelete as $order_detailsItem) {
       $order_detailsItem->delete();
   }


    echo json_encode(
      array('message' => 'order Deleted Successfully & Order Details Also')
    );
  } else {
    echo json_encode(
      array('message' => 'order Not Deleted')
    );
  }

