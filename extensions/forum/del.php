<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

// if this is a teacher of the class
if ($class_level == 3) {

if (isset($_GET['fid']) && is_numeric($_GET['fid'])) {
	$forum_id = escape($_GET['fid']);
} else {
	exit();
}

$forumData = getForum($forum_id, $class_id);

if ($forumData != false) {

if (isset($_POST['saget'])) {
	
	delForum($forum_id, $class_id);
	echo '1';
	exit();
}

echo '<div class="headTitle"><img src="' . $imgServer . 'gen/delCircle.png" style="margin-right:5px;margin-top:3px" /><div>Delete Forum</div></div>
<div id="content" style="margin:5px; font-size:14px">

Are you sure you want to delete "' . $forumData['title'] . '"?


</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="updateClass();" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Confirm Delete</button></div>

<script>

function updateClass() {
        var hitURL = postToAPI("POST", "del.php?fid=' . $forum_id . '", currentApp, ' . $class_id . ', "saget=1");
        $.ajax({
        type: "GET",
        url: hitURL,
        success: function(data) {
         	closeBox();
         	changePage(currentApp, \'index.php\');
         	 
       }

        });
}

</script>';


}
// false forum data

}
// teacher if

?>