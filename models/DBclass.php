<?php

// require_once 'config.php';

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
        // $connConf = getConfigData();
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

    public static function get_records($table){
        $conn = DbConnection::getConnection();
        $sql = "select * from $table";
        $result = $conn->query($sql);
        if ($result === false) {
            echo "Error: " . $conn->error;
        } 
        else{
            return $result;
        }
        // break
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . ", Name: " . $row["name"] . "<br>";
        }
        
    }

    public static function get_record($table, $query){
        $conn = DbConnection::getConnection();
        $sql = "SELECT * FROM $table WHERE name = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {

                $stmt->bind_param('s', $query['name']);
                $stmt->execute();
            
                $result = $stmt->get_result();
            
                $stmt->close();
                
                return $result;
            } else {
                echo "Error: Empty query parameter.";
                return false;
            }
        
    }
    

    public static function insert_record($table, $array){
        $conn = DbConnection::getConnection();
        if($table === "USER"){
            $sql = "INSERT INTO USER (name, email_id, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sss", $array['name'], $array['email'], $array['password']);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    echo "Record inserted successfully.";
                } else {
                    echo "Error: Failed to insert record.";
                }
                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
    
}
