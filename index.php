<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
    
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>

    <link rel="stylesheet" href="../assets/css/todo.css">

    <title>Todo</title>
</head>
<body>

    <div id="container">
      <h1>
        To-Do List<span id="toggleForm"><i class="fas fa-plus"></i></span>
      </h1>
      <div class="inputBox">
        <form action="" method="POST" id="newTask">
          <div class="row mt-3">
            <div class="col-md-10">
                <input type="text" name="task_name" class="form-control" width="90%" placeholder="Add new task..." />
            </div>
            <div class="col-md-2">
                 <button class="btn btn-success form-control" >ADD</button>
            </div>
          </div>
          
        </form>
        
      </div>
      <ul id="list" class="mt-5">
        <!-- list will render here -->
        
        
      </ul>
      <div class="container" id="footer">
        <div class="row d-flex justify-content-center">
              <span class=""><span id="counter"></span> items Left</span>
              
        </div>
        <br>
        <div class="row d-flex justify-content-center">
            <button id="all" class="btn btn-info" >All</button>
              <button id="active"  class="btn btn-warning" >Active</button>
              <button id="completed" class="btn btn-success" >Completed</button>
              <button id="clearCompleted" class="btn btn-danger">Clear Completed</button>
          </div>
          <div class="row justify-content-center py-2">
            <span>Note : Double click on text for edit</span>
          </div>
      </div>
    </div>
    


</body>

<script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script>
<script src="assets/js/todo.js"></script>
</html>

