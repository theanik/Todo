<?php
namespace App\Database;
use App\Config\Config;
use Exception;
use mysqli;

require_once realpath("vendor/autoload.php");

class Database{

    private $host;
    private $user;
    private $password;
    private $database;
    
    public $conn;

    static $dbtable;

    public function __construct()
    {
        $this->initConnectionCredntial();
        $this->connection();
        
    }

    private function initConnectionCredntial(){
        $this->host = Config::$host;
        $this->user = Config::$user;
        $this->password = Config::$password;
        $this->database = Config::$database;
    }

    private function connection()
    {
        try{
            $this->conn = new mysqli($this->host,$this->user,$this->password,$this->database);
            if($this->conn->connect_errno){
                return "Failed to connect to MySQL: " . $this->conn->connect_error;
            }
        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
        
    }


    
    

}

new Database;