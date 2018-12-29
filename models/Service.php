<?php

    class Service{
        //DB params
        private $DB;

        //Services Properties
        public $id;
        public $category_id;
        public $category_name;
        public $name;
        public $price;
        public $created_at;

        //Constructor with DB
        public function __construct($db){
            $this->DB=$db;
        }
        //Get services
        public function readAllServices(){
            // Create query
            $query = 'SELECT c.name as category_name, S.id, S.category_id, S.name, S.price, p.created_at
                                        FROM services S
                                        LEFT JOIN
                                        categories c ON S.category_id = c.id
                                        ORDER BY
                                        S.created_at DESC';
            
            $statement = $this->DB->query($query);

            return $statement;
        }
        public function read_single(){
           //create query
                     $query = 'SELECT c.name as category_name,S.id, S.category_id, S.name, S.price , S.created_at
                                    FROM services S
                                    LEFT JOIN
                                      categories c ON S.category_id = c.id
                                    WHERE
                                      S.id = :id
                                    LIMIT 0,1';

            $statement= $this->DB->query($query,array(':id'=>$this->id));
                        
            $row=$statement->fetch(PDO::FETCH_ASSOC);
            $this->name=$row['name'];
            $this->price=$row['price'];
            $this->category_id=$row['category_id'];
            $this->category_name=$row['category_name'];
            $this->created_at=$row['created_at'];

        }
        public function create(){
            //create query
            $query='INSERT INTO services SET name = :name ,price = :price, category_id = :category_id';

            //clean data
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->price=htmlspecialchars(strip_tags($this->price));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));

            //Execute Query
            if($this->DB->query($query,array(':name'=>$this->name,':price'=>$this->price,':category_id'=>$this->category_id))){
                return true;
            }
            return false;

        }
        public function update() {
            // Create query
            $query = 'UPDATE services
                                  SET name = :name, price = :price, category_id = :category_id
                                  WHERE id = :id';
  
            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            // Execute query
            if($this->DB->query($query,array(':name'=>$this->name,':price'=>$this->price,':category_id'=>$this->category_id,'id'=>$this->id))) {
              return true;
            }
            return false;
        }
        public function delete() {
            // Create query
            $query = 'DELETE FROM services WHERE id = :id';
            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
  
            // Execute query
            if($this->DB->query($query,array(':id'=>$this->id))) {
              return true;
            }
            
            return false;
      }
  


    }