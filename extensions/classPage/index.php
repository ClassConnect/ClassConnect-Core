<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
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
	var hitURL = postToAPI("POST", "action.php?n=3", "1", <?php echo $class_id; ?>, 'start=' + commenterCount);
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
	var hitURL = postToAPI("POST", "action.php?n=2", "1", <?php echo $class_id; ?>, 'commentID=' + comment_id);
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
// include student header
if ($class_level == 1) {
	$comment_swap = 'a comment';

// include teacher header
} elseif ($class_level == 3) {
	echo '<div id="teach_menu"><span class="item"><a href="classInfo.php" target="dialog" width="240"><img src="' . $imgServer . 'gen/edit_s.png" style="margin-bottom:-2px" /> Edit Class Info</a></span><span class="item"><a href="classCode.php" target="dialog" width="300"><img src="' . $imgServer . 'gen/key_s.png" style="margin-bottom:-2px" /> Class Code</a></span><span class="item"><a href="manageStudents.php"><img src="' . $imgServer . 'gen/users.png" style="margin-bottom:-1px" /> Manage Students</a></span></div>';
	$comment_swap = 'an update';	
}


$update = getUpdate($class_id);

if ($update != false) {
	$latest = '<span class="status">' . $update['body'] . '</span><br />
<span class="posted_at">posted at ' . date('g:i A', strtotime($update['date_posted'])) . ' on ' . date('F j, Y', strtotime($update['date_posted'])) . '</span>';
} else {
	$latest = '<span class="status">No updates found for this class.</span>';
}

echo '
<div style="margin-left:10px">
<div id="latestBox">
' . $latest . '
</div>

<div id="updateBox">

<form method="POST" action="action.php?n=1" id="submit_wall">
<input type="text" class="inputBox" id="message_wall" name="message" value=" post ' . $comment_swap . '..." style="color:#999;font-style:italic" />
<input type="submit" name="submit" value="Submit" class="postButton" />
</form>

</div>
</div>






<div id="class_comments"><div id="loadMore"><center><img src="core/site_img/loading.gif" /></center></div>


';






?>