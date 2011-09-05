$(document).ready(function(){
  $(".student_selecter").each(function(){
    var _that = $(this);
    _that.bind('click', function(){
      getBoxView(_that.attr("id"), getLastClicked()); 
    });
  });
})

function getBoxView(student_id, assignment_id){
  changePage(currentApp,'dropbox.php?a='+assignment_id+"&s="+student_id);
}
