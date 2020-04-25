<?php

// Controller Improt
use App\Controller\TodoController;
require_once realpath("vendor/autoload.php");





// instandied controller

$todoController = new TodoController;



$url = $_REQUEST['url'] ?? "";

if($url !== ""){
    switch ($url) {
        case "all_todo":
            $todoController->allTodo();
            break;
        case "active_todo":
            $todoController->activeTodo();
            break;
        case "completed_todo":
            $todoController->completedTodo();
            break;
        case "add_todo":
            $todoController->addTodo($_POST);
            break;
        

    }
}