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
<script>

$(document).ready(function(){
    allTodo();
    countLeftItem();

    //delete single todo
    $("#list").on("click","li #btn",function(){
      let id = $(this).data('id');
      deleteOne(id);
    });

    // select as complete
    $("#list").on("click", "li input[type='checkbox']", function(){
      let id = $(this).data('id');
      console.log(id);
      completeSelect(id)
    });

    // get all todo
    $("#all").on("click", function(e){
      allTodo();
    })

    // get actice todo
    $("#active").on("click", function(e){
      activeTodo();
    })

    //get completed todo

    $("#completed").on("click", function(){
      completedTodo();
    })


    // add new

    $("#newTask").on("submit", function(e){
      e.preventDefault()
      addTodo();

    })

    $("#clearCompleted").click(function(){
      clearCompleted();
    })

    $("#list").on("dblclick", "li span", function(){
     
      // $('#hide').attr("type",'text')
      $(this).find("#hide").attr("type","text")
      $(this).find("#hide").val($(this).text())
      $(this).find("span").text("")
    });

    
    $("#list").on("submit","#innerForm", function(e){
      e.preventDefault()
      $.ajax({
        type : "POST",
        url : "../route.php?url=update_todo",
        data : {
          task_name : $(this).find("#hide").val(),
          id : $(this).find("#hide").data('id')
        },
        success : function(res){
          // $('#newTask input[name="task_name"]').val('')
          console.log(res)
          allTodo()
        },
        error : function(e){
          console.log(e)
        }
      })
    })


  })


// html show

function htmlShowList(res){
      countLeftItem()
      let html = ''
      let data = JSON.parse(res);
      let ck = ''
      let complete = ''
      if(null === data){
          html += '<div class="alert alert-warning">No Item Found</div>'
      }else{
        data.forEach(function(element){
          // check is complete ?
          if(element.task_status == 2){
            ck = "checked"
            complete = "complete"
          }

          html += '<form id="innerForm" action="" method="POST"><li class="'+complete+'">';
          html += '<input type="checkbox" '+ck+' data-id="'+element.id+'"><span><span>'+ element.task_name +'</span><input id="hide" name="task_name" value="'+element.task_name+'" data-id="'+element.id+'" data-name="'+element.task_name+'" type="hidden" ></span><span class="btn btn-sm" id="btn" data-id='+element.id+'><i class="fa fa-trash"></i></span>'
          // html += ''
          html += '</li></form>';
          ck = ''
          complete = ''
        });
      }

      $('#list').html(html)
}


// all todo
function allTodo(){
  $.ajax({
    type : "GET",
    url : "../route.php?url=all_todo",
    success : function(res){
      htmlShowList(res)
    },

    error : function(e){
      console.log(e)
    }
  })
}


function deleteOne(id){
  $.ajax({
    type : "DELETE",
    url : "../route.php?url=delete_todo&task_id="+id,
    success : function(res){
      console.log(res);
      allTodo()
    }
  })
}


function completeSelect(id){
  $.ajax({
    type : "PUT",
    url : "../route.php?url=complete_todo&task_id="+id,
    success : function(res){
      console.log(res);
      allTodo()
    }
  })
}


function activeTodo(){
  $.ajax({
    type : "GET",
    url : "../route.php?url=active_todo",
    success : function(res){
      htmlShowList(res)
    }
  })
}


function completedTodo(){
  $.ajax({
    type : "GET",
    url : "../route.php?url=completed_todo",
    success : function(res){
      htmlShowList(res)
    }
  })
}


function addTodo(){
  $.ajax({
        type : "POST",
        url : "../route.php?url=add_todo",
        data : {
          task_name : $('#newTask input[name="task_name"]').val()
        },
        success : function(res){
          $('#newTask input[name="task_name"]').val('')
          console.log(res)
          allTodo()
        },
        error : function(e){
          console.log(e)
        }
      })
}


function clearCompleted(){
  $.ajax({
    type : "DELETE",
    url : "../route.php?url=delete_completed",
    success : function(res){
      console.log(res)
      allTodo();
    }
  })
}


function countLeftItem(){
  $.get("../route.php?url=count_todo", function(res){
    let count = JSON.parse(res)
    $("#counter").text(count);
  })
}





</script>
</html>

