<?php

require_once 'config.php';

class DbConnection {
    private static $server = "localhost";
    private static $user = "root";
    private static $password = "root";
    private static $dbName = "myDB";

    private static $instance;
    private $dbConn;

    private function __construct() {
        echo "Instance created successfully";
    }

    private static function getInstance(){
        if (self::$instance == null){
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

    private static function initConnection(){
        $db = self::getInstance();
        $connConf = getConfigData();
        $db->dbConn = new mysqli(self::$server,self::$user,self::$password,self::$dbName);
        $db->dbConn->set_charset('utf8');
        return $db;
    }

    public static function getConnection() {
        try {
            $db = self::initConnection();
            return $db->dbConn;
        } catch (Exception $ex) {
            echo "I was unable to open a connection to the database. " . $ex->getMessage();
            return null;
        }
    }

}