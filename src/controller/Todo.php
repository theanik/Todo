<?php

use App\Database\Database;

class Todo extends Database{
    
    public function __construct()
    {
        $this->classNameForTableName();
    }

    private function classNameForTableName(){
        parent::$dbtable = strtolower(get_class($this));
    }
}