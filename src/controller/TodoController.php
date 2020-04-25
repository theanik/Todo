<?php

use App\Model\Todo;

require_once realpath("vendor/autoload.php");

class TodoController extends Todo{

    public function allTodo()
    {
        $todos = Todo::getAll();
        return json_encode($todos);
    }

    public function activeTodo()
    {
        $todos = Todo::get('task_status = 1');
        return json_encode($todos);
    }

    public function completedTodo()
    {
        $todos = Todo::get('task_status = 2');
        return json_encode($todos);
    }

    public function addTodo($data = '')
    {
        $todo = Todo::add("task_name = '{$data['task_name']}',task_status = 1");
        if($todo == true){
            return json_encode($todo);
        }       
    }

    public function complete($id)
    {
        $complete = Todo::updateById('task_status = 2',$id);
        if($complete){
            return json_encode($complete);
        }
    }

    public function deletedCompleted()
    {
        return $delete = Todo::delete('task_status = 2');
        if($delete == true){
            return json_encode($delete);
        }
        
    }





}

print_r((new TodoController)->addTodo());