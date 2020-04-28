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
        url : "route.php?url=update_todo",
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
    url : "route.php?url=all_todo",
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
    url : "route.php?url=delete_todo&task_id="+id,
    success : function(res){
      console.log(res);
      allTodo()
    }
  })
}


function completeSelect(id){
  $.ajax({
    type : "PUT",
    url : "route.php?url=complete_todo&task_id="+id,
    success : function(res){
      console.log(res);
      allTodo()
    }
  })
}


function activeTodo(){
  $.ajax({
    type : "GET",
    url : "route.php?url=active_todo",
    success : function(res){
      htmlShowList(res)
    }
  })
}


function completedTodo(){
  $.ajax({
    type : "GET",
    url : "route.php?url=completed_todo",
    success : function(res){
      htmlShowList(res)
    }
  })
}


function addTodo(){
  $.ajax({
        type : "POST",
        url : "route.php?url=add_todo",
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
    url : "route.php?url=delete_completed",
    success : function(res){
      console.log(res)
      allTodo();
    }
  })
}


function countLeftItem(){
  $.get("route.php?url=count_todo", function(res){
    let count = 0;
    if(res){
        count = JSON.parse(res)
    }
    console.log(count)
    $("#counter").text(count);
  })
}


