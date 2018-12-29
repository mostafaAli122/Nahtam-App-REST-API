<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: POST');
    header('Access-Control-Allow-Header: Access-Control-Allow-Header , Content-Type , Access-Control-Allow-Method');

    include_once '../../config/Database.php';
    include_once '../../models/category.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Blog Category object 
    $category = new Category($db);
    
    //Get row posted data
    $data = json_decode(file_get_contents("php://input"));

    $category->name = $data->name;

    //create Category
    if($category->create()){
        echo json_encode(array(
            'message' => 'Category Created Successfully'
        ));
    }else{
        echo json_encode(array(
            'message' => 'Category Not Created '
        ));
    }

