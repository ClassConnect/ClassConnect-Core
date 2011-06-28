<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

// if this is a teacher of the class
if ($class_level == 3) {

if (isset($_GET['fid']) && is_numeric($_GET['fid']) && isset($_GET['rid']) && is_numeric($_GET['rid'])) {
	$forum_id = escape($_GET['fid']);
	$reply_id = escape($_GET['rid']);
} else {
	exit();
}

$forumData = getForum($forum_id, $class_id);

if ($forumData != false) {

if (isset($_POST['saget'])) {
	
	delReply($forum_id, $reply_id);
	echo '1';
	exit();
}

echo '<div class="headTitle"><img src="' . $imgServer . 'gen/delCircle.png" style="margin-right:5px;margin-top:3px" /><div>Delete Forum Reply</div></div>
<div id="content" style="margin:5px; font-size:14px">

Are you sure you want to delete this forum reply??


</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="updateClass();" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Confirm Delete</button></div>

<script>

function updateClass() {
        var hitURL = postToAPI("POST", "delReply.php?rid=' . $reply_id . '&fid=' . $forum_id . '", currentApp, ' . $class_id . ', "saget=1");
        $.ajax({
        type: "GET",
        url: hitURL,
        success: function(data) {
         	closeBox();
         	changePage(currentApp, \'forum.php?fid=' . $forum_id . '\');
         	 
       }

        });
}

</script>';


}
// false forum data

}
// teacher if

?>