<?php

require_once realpath("vendor/autoload.php");
use App\Model\Database\Database;


class Todo extends Database{
    static function setTblNameFromModel()
    {
        return __CLASS__;
    }
   
}

print_r(Todo::getById('14'));

