<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Service.php';

    //instantiate DB &connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $service = new service($db);

    //Get ID
    $service->id=isset($_GET['id']) ? $_GET['id'] : die();

    //get service
    $service->read_single();

    //create array
    $service_arr=array(
        'id' => $service->id,
        'name' => $service->name,
        'price' => $service->price,
        'category_id' => $service->category_id,
        'category_name' => $service->category_name
    );

    //make Json 
    print_r(json_encode($service_arr));


