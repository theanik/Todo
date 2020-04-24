<?php
namespace App\Model\Database;
use App\Config\Config;
use Exception;
use mysqli;

require_once realpath("vendor/autoload.php");

class Database{

    private $host;
    private $user;
    private $password;
    private $database;
    
    static $conn;

    static $dbtable;

    public function __construct()
    {
        $this->initConnectionCredntial();
        $this->connection();
        
    }

    static function setTblNameFromModel()
    {
        //static::getTblName();
    }

    static function getTblName()
    {
        return static::setTblNameFromModel();
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
            self::$conn = new mysqli($this->host,$this->user,$this->password,$this->database);
            if(self::$conn->connect_errno){
                die("Failed to connect to MySQL: " . $this->conn->connect_error);
            }
        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
        
    }


    /**
     * getAll()
     * return all from database
     */

     public static function getAll()
     {
        try{
            
            $table = strtolower(self::getTblName());
            $sql = "SELECT * FROM {$table}";
            $result = self::$conn->query($sql);
            // return $result;
            if($result->num_rows > 0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }


        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
     }

     /**
      * get(contidton)
      * select data by condition
      */


     public static function get($condition)
     {
        try{
            
            $table = strtolower(self::getTblName());
            $sql = "SELECT * FROM {$table} WHERE {$condition}";
            $result = self::$conn->query($sql);
            // return $result;
            if($result->num_rows > 0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }


        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
     }

     /**
      * getById(id)
      * select data by id
      */

     public static function getById($id)
     {
        try{
            
            $table = strtolower(self::getTblName());
            $sql = "SELECT * FROM {$table} WHERE id = {$id}";
            $result = self::$conn->query($sql);
            if($result->num_rows > 0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }


        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
     }

     /**
      * add($values)
      */

      public static function add($condition)
      {
        try{
            $table = strtolower(self::getTblName());
            $sql = "INSERT INTO {$table} SET {$condition}";
            $result = self::$conn->query($sql);
            if($result->affected_rows > 0){
                return $result;
            }
        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
      }

     public static function delete($condition)
     {
        try{
            
            $table = strtolower(self::getTblName());
            $sql = "DELETE FROM {$table} WHERE {$condition}";
            $result = self::$conn->query($sql);
            if($result->affected_rows > 0){
                return $result;
            }


        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
     }

     public static function deleteById($id)
     {
        try{
            
            $table = strtolower(self::getTblName());
            $sql = "DELETE FROM {$table} WHERE id = {$id}";
            $result = self::$conn->query($sql);
            if($result->affected_rows > 0){
                return $result;
            }


        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
     }


     public static function update($values,$condition)
     {
        try{
            
            $table = strtolower(self::getTblName());
            $sql = "UPDATE {$table} SET {$values} WHERE {$condition}";
            $result = self::$conn->query($sql);
            if($result->affected_rows > 0){
                return $result;
            }


        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
     }











    
    

}

new Database;