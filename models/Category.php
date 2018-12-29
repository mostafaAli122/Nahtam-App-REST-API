<?php
    class Category{
        //DB params
        private $DB;
        private $table='categories';

        // properties
        public $id;
        public $name;

        //Constructor with DB
        public function __construct($db){
            $this->DB=$db;
        }

        //get All Categories
        public function readAll(){
            //create query
            $statement=$this->DB->query('SELECT id,name,created_at  FROM categories ORDER BY created_at DESC ');

            return $statement;
        }

        public function read_single(){
            //Create query
            $statement=$this->DB->query('SELECT id,name from categories WHERE id=:id LIMIT 0,1  ',array(':id',$this->id));

            $row=$statement->fetch(PDO::FETCH_ASSOC);

            //set properties
            $this->id=$row['id'];
            $this->name=$row['name'];
        }
        public function create(){
     
            //clean data
            $this->name = htmlspecialchars(strip_tags($this->name)); 
            //Execute Statement
            if($this->DB->query('INSERT INTO categories VALUES (\'\',:name)',array(':name'=>$this->name)))
                return true;
            return false;    
        }
        public function update(){            
             //clean data
             $this->id = htmlspecialchars(strip_tags($this->id));
             $this->name = htmlspecialchars(strip_tags($this->name));
             //Execute statement
             if($this->DB->query('UPDATE categories SET name = :name WHERE id= :id',array(':name'=>$this->name,'id'=>$this->id)))
                return true;
               
             return false;   

        }
        public function delete(){
            //create query
            $query='DELETE FROM '.$this->table.'WHERE id = :id ';

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            //Execute query
            if($this->DB->query('DELETE FROM categories WHERE id = :id ',array(':id'=>$this->id)))
                return true;
            return false;
        }

    }