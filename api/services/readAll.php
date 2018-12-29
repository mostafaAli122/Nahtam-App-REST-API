<?php 
    //headers
    header('Access-Control-Allow-Origin:*');//means this's a public API
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Service.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Service object
    $Service = new Service($db);

    // Service query
    $result = $Service->readAllServices();

    //Get row count 
    $num = $result->rowCount();

    //check if there any Services To return it as json 
    if ($num > 0) {
        //Service Array
        $Service_Arr=array();
        
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $Service_item = array(
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'category_id' => $category_id,
                'category_name' => $category_name
            );
            //push to data
            array_push($Service_Arr,$Service_item);
        }
        echo json_encode($Service_Arr);
    }else{
        //No Services
        echo json_encode(
            array(
                'message' => 'No Services Found'
            )
        );
    }
    
