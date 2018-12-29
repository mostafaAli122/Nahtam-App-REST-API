<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Service.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog service object
  $service = new Service($db);

  // Get raw serviced data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $service->id = $data->id;

  // Delete service
  if($service->delete()) {
    echo json_encode(
      array('message' => 'service Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'service Not Deleted')
    );
  }

