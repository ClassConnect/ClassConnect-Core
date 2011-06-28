<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/schoolMain.php');
// local extension file
require_once('core/main.php');

echo '<cc:crumbs>{className}</cc:crumbs>';
?>

<script type="text/javascript">
var commenterCount = 0;

function classActions() {

$("#message_wall").focus(function()
{
if ($(this).val() == " post a comment..." || $(this).val() == " post an update...") {
$(this).val("");
$(this).removeAttr("style");
}
});

}



function loadComments() {
	$("#loadMore").html('<center><img src=\"core/site_img/loading.gif\" /></center>');
	var hitURL = postToAPI("POST", "action.php?n=3", "1", <?php echo $school_id; ?>, 'start=' + commenterCount);
	$.ajax({
   	type: "GET",
   	url: hitURL,
   	success: function(data) {
   		$("#loadMore").remove();
   		$("#class_comments").html($("#class_comments").html()+data);
      }
										
   });
	commenterCount++;
}



function deleteComment(comment_id) {
	var hitURL = postToAPI("POST", "action.php?n=2", "1", <?php echo $school_id; ?>, 'commentID=' + comment_id);
	$.ajax({
   	type: "GET",
   	url: hitURL,
   	success: function(data) {
   		$("#comment" + comment_id).fadeOut(200);
   		$("#bottom" + comment_id).fadeOut(200);
      }
										
   });
   
}

$(document).ready(function(){  
 classActions();
 loadComments();
 })  

</script>


<?php


$update = getUpdate($school_id);

if ($update != false) {
	$latest = '<span class="status">' . $update['body'] . '</span><br />
<span class="posted_at">posted at ' . date('g:i A', strtotime($update['date_posted'])) . ' on ' . date('F j, Y', strtotime($update['date_posted'])) . '</span>';
} else {
	$latest = '<span class="status">No updates found for this school.</span>';
}

echo '
<div style="margin-left:10px">
<div id="latestBox">
' . $latest . '
</div>';

if (checkSchoolAdmin($school_id, $user_id)) {
echo '<div id="updateBox">

<form method="POST" action="action.php?n=1" id="submit_wall">
<input type="text" class="inputBox" id="message_wall" name="message" value=" post an update..." style="color:#999;font-style:italic" />
<input type="submit" name="submit" value="Submit" class="postButton" />
</form>

</div>';
}

echo '</div>






<div id="class_comments"><div id="loadMore"><center><img src="core/site_img/loading.gif" /></center></div>


';






?>