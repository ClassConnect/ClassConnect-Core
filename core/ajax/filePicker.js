function selectMe(obj) {
$(".folderPicker").removeClass("folderActive");
obj.addClass("folderActive");
obj.find(".folderRad").attr('checked', true);

}


function swapDir(dirID) {
$("#selectBox").html('<br /><center><img src="/app/core/site_img/loading.gif" /></center><br />');
$.ajax({
   type: "GET",
   url: "/app/core/ajax/picker/file.cc?id=" + dirID + "&type=" + $("#contentAllow").html() + "&addType=" + $("#addAllow").html(),
   success: function(msg){
     $("#selectBox").html(msg);
   }
 });


}



$(document).ready(function() {
    swapDir(0);
});