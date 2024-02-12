<?php


include "../models/userModel.php";
include "../models/DBclass.php";



if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    echo $username . ' ' . $password . "<br>";
}   
else{
    echo "bd";
}



// $user = User::getUser($username);

// if(!$user){
//     echo "User not found";
//     header('Location: '. "./views/Login.php");
// }
// else{
//     echo "Logged in";
//     header('Location: '. "./views/courses.php");
// }




DbConnection::get_records("USER");

