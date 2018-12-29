<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & Connect
    $database =new Database();
    $db = $database->connect();

    //Instantiate category object 
    $category = new Category($db);

    //Category read query
    $result = $category->readAll();

    //get row count
    $num = $result->rowCount();

    //check if any Categories
    if($num > 0){
        //cat Array
        $cat_arr = array();
        $cat_arr['data']=array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $cat_item = array(
                'id' => $id,
                'name' => $name
            );
            //push to data
            array_push($cat_arr['data'],$cat_item);
        }
        //turn to json & output
        echo json_encode($cat_arr);
    }else{
        echo json_encode(array(
            'message' => 'No Categories Found'
        ));
    }
