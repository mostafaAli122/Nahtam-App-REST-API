<?php 
    //headers
    header('Access-Control-Allow-Origin:*');//means this's a public API
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Order_detail.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate order_detail object
    $order_detail = new Order_detail($db);

    // order_detail query
    $result = $order_detail->readAllOrderDetails();

    //Get row count 
    $num = $result->rowCount();

    //check if there any order_detail To return it as json 
    if ($num > 0) {
        //order_detail Array
        $order_detailArr=array();
        
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $order_detail_item = array(
                'order_ID' => $order_ID,
                'status' => $status,
                'order_date' => $order_date,
                'service_name' => $service_name,
                'service_price' => $service_price
            );
            //push to data
            array_push($order_detailArr,$Service_item);
        }
        echo json_encode($Service_Arr);
    }else{
        //No Order Details 
        echo json_encode(
            array(
                'message' => 'No Order Details Found'
            )
        );
    }
    
