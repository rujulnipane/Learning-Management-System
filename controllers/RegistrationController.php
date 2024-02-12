<?php


include "../models/userModel.php";
include "../models/DBclass.php";

class Register{
    private $name;
    private $email;
    private $password;
    private $cpassword;
    private $phone;

    public function __construct(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->name = $_POST["name"];
            $this->email = $_POST["email"];
            $this->phone = $_POST["phone"];
            $this->password = $_POST["password"];
            $this->cpassword = $_POST["cpassword"];
            // echo $name . ' ' . $password . ' '. $email . ' '. $phone . "<br>";
        }   
        else{
            echo "bd";
        }
    } 

    public function validateUser(){
        $namepattern = "/^[A-Za-z\s]+$/";
        $emailpattern = '/^[\w\.]+@[a-zA-Z\d\.]+\.[a-zA-Z]{2,}$/';
        $phonepattern = "/^[0-9]{10}$/";

        if(!preg_match($namepattern,$this->name)){
            echo "name is not valid\n";
            return false;
        }
        
        if(!preg_match($emailpattern,$this->email)){
            echo "email is not valid\n";
            return false;
        }
        
        if(!preg_match($phonepattern,$this->phone)){
            echo "phone is not valid\n";
            return false;
            
        }
        return true;
    }

    public function registerUser(){
      
       
            $user = User::getUser($this->name);
    if($user->num_rows>0){
        echo "User already exist";
    }
    else{
        $array = array(
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        );
        User::createUser($array);
        echo("user created successfully");
        header('Location: '. "../views/Login.php");
    }
        }
}

$reg = new Register();

if($reg->validateUser()){
    $reg->registerUser();
}   
else{
    echo "Validation failed";
    // header('Location: '. "../views/Login.php");
}

