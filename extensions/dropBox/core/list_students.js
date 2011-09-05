$(document).ready(function(){
  $(".student_selecter").each(function(){
    var _that = $(this);
    _that.bind('click', function(){
      getBoxView(_that.attr("id"), getLastClicked()); 
    });
  });
})

function getBoxView(student_id, assignment_id){
  var datastring = "a=" + assignment_id + "&s=" + student_id;
  var _url = postToAPI("GET", "dropbox.php", currentApp, class_id, datastring);
  $.get(_url, function(data){
    $("#class_main").html(data);
  });
}
