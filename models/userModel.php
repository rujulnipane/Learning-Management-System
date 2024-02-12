<?php

include_once "./DBclass.php";

class User{

    public function __construct(){

    }

    public static function getUser($username){
        echo "in user class";
        $query = array(
            'name' => $username
        );
        return DbConnection::get_record("USER",$query);
    }

    public static function createUser($array){
        DbConnection::insert_record("USER",$array);
    }
}