<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Order_detail.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog order detail object
  $order_detail = new Order_detail($db);

  // Get raw ordered details data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to delete
  $order_detail->id = $data->id;

  // Delete order detail
  if($order_detail->delete()) {
    echo json_encode(
      array('message' => 'Order Detail Deleted Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Order Not Deleted')
    );
  }

