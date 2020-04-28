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

     static function table()
     {
            $model_path = self::getTblName();
            $model_path = explode("\\",$model_path);
            return strtolower($model_path[2]);
     }

     public static function getAll()
     {
        try{
            $table = self::table();
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
            
            $table = self::table();
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
            
            $table = self::table();
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
            $table = self::table();
            $sql = "INSERT INTO {$table} SET {$condition}";
            $result = self::$conn->query($sql) or die (self::$conn->error . __LINE__);
            if(self::$conn->affected_rows > 0){
                return $result;
            }else{
                return false;
            }
        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
      }

     public static function delete($condition)
     {
        try{
            
            $table = self::table();
            $sql = "DELETE FROM {$table} WHERE {$condition}";
            $result = self::$conn->query($sql) or die (self::$conn->error . __LINE__);
            if(self::$conn->affected_rows > 0){
                return $result;
            }else{
                return false;
            }


        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
     }

     public static function deleteById($id)
     {
        try{
            
            $table = self::table();
            $sql = "DELETE FROM {$table} WHERE id = {$id}";
            $result = self::$conn->query($sql) or die (self::$conn->error . __LINE__);
            if(self::$conn->affected_rows > 0){
                return $result;
            }else{
                return false;
            }


        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
     }


     public static function update($values,$condition)
     {
        try{
            
            $table = self::table();
            $sql = "UPDATE {$table} SET {$values} WHERE {$condition}";
            $result = self::$conn->query($sql) or die (self::$conn->error . __LINE__);
            if(self::$conn->affected_rows > 0){
                return $result;
            }else{
                return false;
            }


        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
     }

     public static function updateById($values,$id)
     {
        try{
            
            $table = self::table();
            $sql = "UPDATE {$table} SET {$values} WHERE id = {$id}";
            $result = self::$conn->query($sql) or die (self::$conn->error . __LINE__);
            if(self::$conn->affected_rows > 0){
                return $result;
            }else{
                return false;
            }


        }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
        }
     }

     public static function count($condition)
     {
         try{
            $table = self::table();
            $sql = "SELECT COUNT(id) FROM todo WHERE {$condition}";
            $result = self::$conn->query($sql) or die (self::$conn->error . __LINE__);
            if($result){
                $row =  $result->fetch_row();
                return $row[0];
            }else{
                return false;
            }
         }catch(Exception $e){
            return $e->getMessage() ." : ".$e->getCode();
         }
     }











    
    

}

new Database;