var class_id;
var _student_list_div;
var _buttons;
var _last_clicked;


function refreshDropboxPage(){
  var _url = postToAPI("GET", "index.php", currentApp, class_id, "ref=1");
  $.get(_url, function(data){
   $("#class_main").html(data); 
  })
  if(_last_clicked){
    $("#" + _last_clicked).click();
  }
}

/*
* Inserts list of students into div#dropbox_students_list
*/
function fillStudentsList(assignment_id){
  var datastring = "aid=" + assignment_id;
  var _url = postToAPI("GET", "list_students.php", currentApp, class_id, datastring);
  $.get(_url, function(data){
    _student_list_div.html(data);
  });
}

function addAssignment(){
  var datastring = $("#add_assignment_form").serialize();
  var _url = postToAPI("POST", "add_assignment.php", currentApp, class_id, datastring);
  $.post(_url, function(data){
    if(data){
      $("#dialogBox").html(data);
    }
    else{
      refreshDropboxPage();
      closeBox();
    }
  });
}


function editAssignment(){
  
  var datastring = $("#edit_assignment_form").serialize();
  var _url = postToAPI("POST", "edit_assignment.php", currentApp, class_id, datastring);
  $.post(_url, function(data){
    if(data){
      $("#dialogBox").html(data);
    }
    else{
      refreshDropboxPage();
      closeBox();
    }
  });
}

function deleteAssignment(){

}

$(document).ready(function(){
  initialize_dropbox_page();
});

function initialize_dropbox_page(){
  $($("input[type=text]")[0]).focus();
  var $_lol = $("<span id='delete'>test</span>");
  class_id = parseInt($("#teacher_assignments_list").attr("class_id"));
  _student_list_div = $("#dropbox_students_list");

  $(".assignmentButton").each(function(){
    $(this).bind('click', function(){
      var button_id = parseInt($(this).attr("id"));
      fillStudentsList(button_id);
      _last_clicked = button_id;
      $(this).append(_buttons);
      _buttons.show();
    })
  });

  $("#add-new-assignment").bind('click', function(){
    var datastring = "aid=1";
    var _url = postToAPI("GET", "add_assignment.php", currentApp, class_id, datastring);
    openBox(_url, 350);
  });

  $("#assignment_date_due").datepicker({ dateFormat: 'yy-mm-dd' });

  $("#add_assignment_submit").bind('click', function(){
    addAssignment();
  });

  $("#edit_assignment_submit").bind('click', function(){
    editAssignment();
  });

  $("#delete_assignment").bind('click', function(e){
    var _aid = parseInt($(this).parents(".assignmentButton").attr("id"));
    var r = confirm("Are you sure you want to delete this assignment?");
    if(r){
      var datastring = "aid=" + _aid;
      var _url = postToAPI("POST", "remove_assignment.php", currentApp, class_id, datastring);
      $.post(_url, function(data){
        refreshDropboxPage();
      });

    }
    else{
    }
    e.preventDefault();
    e.stopImmediatePropagation();
    e.stopPropagation();
  });


  $("#edit_assignment").bind('click', function(e){
    var _aid = parseInt($(this).parents(".assignmentButton").attr("id"));
    var _div = $(this).parents("div.assignmentButton");
    _date = _div.attr("date");
    _name = $(_div.children("span")[0]).html();
    var datastring = "aid=" + _aid + "&date=" + _date + "&name=" + _name;
    var _url = postToAPI("GET", "edit_assignment.php", currentApp, class_id, datastring);
    openBox(_url, 350);
    e.stopPropagation();
  });
  
  _buttons = $("#dropbox_buttons");
  _buttons.hide();
}

function getLastClicked(){
  return _last_clicked;
}
