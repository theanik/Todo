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
        <form action="" method="POST">
          <input type="text" name="newInput" maxlength="32" placeholder="Add new task..." />
          <button class="enterBtn" id="enter">ADD</button>
        </form>
        
      </div>
      <ul id="list">
        <!-- <li>
        <span><i class="fas fa-trash"> </i></span> <input type="checkbox" name="todo_select"> Feed 1
        </li> -->
        
        
      </ul>
      <div class="container" id="footer">
        <div class="row d-flex justify-content-center">
              <span class=""> items Left</span>
              
        </div>
        <br>
        <div class="row d-flex justify-content-center">
            <button class="btn btn-info" >All</button>
              <button  class="btn btn-warning" >Active</button>
              <button class="btn btn-success" >Completed</button>
              <button class="btn btn-danger">Clear Completed</button>
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
    getData();

    //delete single todo
    $("#list").on("click","li button",function(){
      let id = $(this).data('id');
      deleteOne(id);
    });


  })


$("#list").on("click", "li", function(){
  $(this).addClass("complete");
  $(this).find("input").prop("checked",true)

  let id = $(this).data('id');
  // alert(id)

});


// all todo
function getData(){
  $.ajax({
    type : "GET",
    url : "../route.php?url=all_todo",
    success : function(res){

      let html = ''
      let data = JSON.parse(res);
      let ck = ''
      let complete = ''
      data.forEach(function(element){
        
        if(element.task_status == 2){
          ck = "checked"
          complete = "complete"
        }
        html += '<li data-id="'+element.id+'" class="'+complete+'">';
        html += '<input type="checkbox" '+ck+'><span id="txt">'+ element.task_name +'</span><button class="btn btn-sm" id="btn" data-id='+element.id+'><i class="fa fa-trash"></i></button>'
        // html += ''
        html += '</li>';
        ck = ''
        complete = ''
      });

      $('#list').html(html)
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
      getData()
    }
  })
}








// //Click on trashcan span to delete Todo 
// //Select parent(li)to remove the whole list; Noticed First(this) = span ; the second (this) = li
// //Use stopPropagation to avoid event bubbling 
// $("ul").on("click", "span", function(event){
// 	$(this).parent().fadeOut("400",function(){
// 		$(this).remove();
// 	});
// 	event.stopPropagation();
// });

// //Press enter key to add new list
// //which = the key code of keypress
// $("input[type='text']").keypress(function(event){
// 	if( event.which === 13 && $("input[type='text']").val().length>0){
// 		var todoText = $(this).val();
// 		$(this).val("");
// 		//creat a new li and add to ul; use method "append" to add html content
// 		$("ul").append("<li><span><i class='fas fa-trash'></i></span> " + todoText + "</li>");
// 	}
// });

// //Press enterBtn  to add new list
// $("button").click(function(){
// 	if($("input[type='text']").val().length>0){
// 		var todoText = $("input[type='text']").val();
// 		$("input[type='text']").val("");
// 		$("ul").append("<li><span><i class='fas fa-trash'></i></span> " + todoText + "</li>");		
// 	}
// })


// //toggle plus logo and textInput after click plus
// $("#toggleForm").click(function(){
// 	$(this).toggleClass("fa-plus-rotate");
// 	$("#enter").fadeToggle();
// 	$("input[type='text']").fadeToggle();
// });



</script>
</html>

