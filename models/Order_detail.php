<?php

    class Order_detail{
        //DB params
        private $DB;

        //Services Properties
        public $id;
        public $order_id;
        public $service_id;
        public $service_name;
        //Constructor with DB
        public function __construct($db){
            $this->DB=$db;
        }
        
        public function readAllOrderDetails(){
           //create query
           $query = 'SELECT O.id as order_ID ,O.status  ,O.order_date, S.name as service_name ,S.price as service_price
           FROM order_details OD 
           LEFT JOIN
                order O ON OD.order_id = O.id
            LEFT JOIN
                services S ON OD.service_id = S.id
            WHERE
                OD.id = :id';

              $statement= $this->DB->query($query,array(':id'=>$this->id));
              return $statement;

        }
        public function create(){
            //create query
            $query='INSERT INTO order_details SET order_id = :order_id ,service_id = :service_id';

            //clean data
            $this->order_id=htmlspecialchars(strip_tags($this->order_id));
            $this->service_id=htmlspecialchars(strip_tags($this->service_id));

            //Execute Query
            if($this->DB->query($query,array(':order_id'=>$this->order_id,':service_id'=>$this->service_id))){
                return true;
            }
            return false;

        }
        public function update() {
            // Create query
            $query = 'UPDATE order_details
                                  SET order_id = :order_id, service_id = :service_id
                                  WHERE id = :id';
  
            // Clean data
            $this->order_id=htmlspecialchars(strip_tags($this->order_id));
            $this->service_id=htmlspecialchars(strip_tags($this->service_id));
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            // Execute query
            if($this->DB->query($query,array(':order_id'=>$this->order_id,':service_id'=>$this->service_id,'id'=>$this->id))) {
              return true;
            }
            return false;
        }
        public function delete() {
            // Create query
            $query = 'DELETE FROM order_details WHERE id = :id';
            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
  
            // Execute query
            if($this->DB->query($query,array(':id'=>$this->id))) {
              return true;
            }
            return false;
      }
      public function GetLastOrderID(){
           // Create query
           $query = 'SELECT Max(id) from order';
           // Execute query
           $LastOrderID= $this->DB->query($query);
           return $LastOrderID;
      }
      public function GetServiceID(){
        // Create query
        $query = 'SELECT id from services where name = :name';
        // Execute query
        $ServiceID= $this->DB->query($query,arraY(':name'=>$this->name));
        return $ServiceID;
   }
  


    }