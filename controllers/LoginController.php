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
        $namepattern = "/^[A-Za-z\s]+$/";
        if(!preg_match($namepattern,$this->username)){
            echo "name is not valid\n";
            return false;
        }
        return true;
    }

    public function loginUser(){
        $user = User::getUser($this->username);
        var_dump($user);
        if($user->num_rows == 0){
            echo "User not exist";
        }
        else{
            echo "else block";
            $row = $user->fetch_assoc();
            echo "fg";
            if($this->password === $row["password"]){
                echo("Logged in successfully");
                header('Location: '. "../views/Courses.php");
            }
            else{
                echo("Invalid password");
                header('Location: '. "../views/Login.php");
            }
            
        }
        
    }

}


$login = new Login();

if($login->validateUser()){
    $login->loginUser();
}
else{
    echo "Login failed";
    header('Location: '. "../views/Login.php");
}




