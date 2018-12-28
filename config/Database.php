<?php
    class Database{
        //DB params
        private $host = '127.0.0.1';
        private $db_name = 'nahtam_app_apis';
        private $username = 'root';
        private $password = '';
        private $conn;
        //DB Connect method
        public function connect(){
            $this->conn=null;

            //Error Handling when creating connectoin
            try{
                $this->conn=new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,
                                    $this->username,$this->password);
                               
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);                    
            }catch(PDOException $e){
                echo 'Connection Error' .$e->getMessage();
            }
            return $this->conn;
        }
    }