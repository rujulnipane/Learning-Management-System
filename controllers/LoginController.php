<?php


include "../models/userModel.php";
include "../models/DBclass.php";

class Login{
    private $username;
    private $password;

    public function __construct(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->username = $_POST["username"];
            $this->password = $_POST["password"];
            // echo $username . ' ' . $password . "<br>";
        }   
        else{
            echo "bd";
        }
    }

    public function validateUser(){
        
    }


}





