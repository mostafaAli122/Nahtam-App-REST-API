<?php
include_once('../config/Database.php');    
    class User{
         //DB params
         private $conn;
         private $table='users'; 
        //User Properties
        public $id;
        public $username;
        public $password;
        public $email;
        public $phone;
        public $message;
    


        //Constructor with DB
        public function __construct($db){
            $this->conn=$db;
        }

        //Create new User
        public function createNewUser(){
             
             //clean data
             $this->username=htmlspecialchars(strip_tags($this->username));
             $this->password=htmlspecialchars(strip_tags($this->password));
             $this->phone=htmlspecialchars(strip_tags($this->phone));
             $this->email=htmlspecialchars(strip_tags($this->emil));
             //check if username doesn't exit in the users table
             if (!$this->conn->query('SELECT username FROM users WHERE username=:username', array(':username'=>$this->username))) {
                if (strlen($this->username) >= 3 && strlen($this->username) <= 32) {
                        if (preg_match('/[a-zA-Z0-9_]+/', $this->username)) {
                            if (strlen($this->password) >= 6 && strlen($this->password) <= 60) {
                                if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                                    if (!$this->conn->query('SELECT phone FROM users WHERE phone=:phone', array(':phone'=>$this->phone))) {
                                            $this->conn->query('INSERT INTO users VALUES (\'\', :username, :password, :email, :phone)', array(':username'=>$this->username, ':password'=>password_hash($this->password, PASSWORD_BCRYPT), ':email'=>$this->email,':phone',$this->phone));
                                            $this->message = "Success!";
                                    } else {
                                        $this->message = 'Phone Number in use!';
                                    }
                                } else {
                                    $this->message = 'Invalid email!';
                                }
                            } else {
                                $this->message = 'Invalid password!';
                            }
                        } else {
                            $this->message = 'Invalid username';
                        }
                } else {
                    $this->message = 'Invalid username';
                }
            } else {
                $this->message = 'User already exists!';
            }
        }
    }