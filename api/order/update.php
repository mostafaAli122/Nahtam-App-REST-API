<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Order.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Order object
  $order = new Order($db);

  // Get raw ordered data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $order->id = $data->id;
  $order->order_address = $data->order_address;
  $order->phone = $data->phone;
  $order->area = $data->area;
  $order->order_date = $data->order_date;
  $order->order_time = $data->order_time;
  $order->service_rate = $data->service_rate;

  // Update order
  if($order->update()) {
    echo json_encode(
      array('message' => 'order Updated Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'order Not Updated')
    );
  }

