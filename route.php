<?php

// Controller Improt
use App\Controller\TodoController;
require_once realpath("vendor/autoload.php");





// instandied controller

$todoController = new TodoController;



$url = $_REQUEST['url'] ?? "";

// echo $url;
if($url !== ""){
    switch ($url) {
        
        case "all_todo":
            echo $todoController->allTodo();
            break;
        case "active_todo":
            echo $todoController->activeTodo();
            break;
        case "completed_todo":
           echo $todoController->completedTodo();
            break;
        case "add_todo":
            $todoController->addTodo($_POST);
            break;
        case "delete_todo":
            echo $todoController->deleteTodo($_GET['task_id']);
            break;
        case "complete_todo":
            echo $todoController->complete($_GET['task_id']);
            break;
        case "delete_completed": 
            echo $todoController->deletedCompleted();
            break;
        case "update_todo":
            print($todoController->updateTodo($_POST));
            break;
        case "count_todo": 
            echo $todoController->countActiceTodo();
            break;
        

    }
}



