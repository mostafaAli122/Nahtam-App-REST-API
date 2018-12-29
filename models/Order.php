<?php

    class Order{
        //DB params
        private $DB;

        //Order Properties
        public $id;
        public $order_address;
        public $phone;
        public $area;
        public $order_date;
        public $order_time;
        public $service_rate;

        //Constructor with DB
        public function __construct($db){
            $this->DB=$db;
        }
        public function create(){
            //create query
             $query='INSERT INTO order SET order_address = :order_address ,phone = :phone, area = :area,order_date = :order_date, order_time = :order_time, service_rate = :service_rate';

             //clean data
             $this->order_address=htmlspecialchars(strip_tags($this->order_address));
             $this->phone=htmlspecialchars(strip_tags($this->phone));
             $this->area=htmlspecialchars(strip_tags($this->area));
             $this->order_date=htmlspecialchars(strip_tags($this->order_date));
             $this->order_time=htmlspecialchars(strip_tags($this->order_time));
             $this->service_rate=htmlspecialchars(strip_tags($this->service_rate));
 
             //Execute Query
             if($this->DB->query($query,array(':order_address'=>$this->order_address,':phone'=>$this->phone,':area'=>$this->area,':order_date'=>$this->$order_date,':order_time'=>$this->$order_time,':service_rate'=>$this->$service_rate))){
                 return true;
             }
            return false;
        }
        public function update(){
            // Create query
            $query = 'UPDATE order
                                  SET order_address = :order_address, phone = :phone, area = :area , order_date = :order_date , order_time = :order_time , service_rate = :service_Rate
                                  WHERE id = :id';
  
            // Clean data
             $this->order_address=htmlspecialchars(strip_tags($this->order_address));
             $this->phone=htmlspecialchars(strip_tags($this->phone));
             $this->area=htmlspecialchars(strip_tags($this->area));
             $this->order_date=htmlspecialchars(strip_tags($this->order_date));
             $this->order_time=htmlspecialchars(strip_tags($this->order_time));
             $this->service_rate=htmlspecialchars(strip_tags($this->service_rate));
             $this->id=htmlspecialchars(strip_tags($this->id));
    
            // Execute query
            if($this->DB->query($query,array(':order_address'=>$this->order_address,':phone'=>$this->phone,':area'=>$this->area,':order_date'=>$this->order_date,':order_time'=>$this->order_time,':service_rate'=>$this->service_rate,'id'=>$this->id))) {
              return true;
            }
            return false;

        }
        public function delete() {
            // Create query
            $query = 'DELETE FROM order WHERE id = :id';
            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
  
            // Execute query
            if($this->DB->query($query,array(':id'=>$this->id))) {
              return true;
            }
            
            return false;
      }
  


    }