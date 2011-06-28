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
	
	if ($forumData['locked'] == 1) {
		$lock = 2;
	} else {
		$lock = 1;
	}
	updateLock($lock, $class_id, $forum_id);
	echo '1';
	exit();
}

if ($forumData['locked'] == 1) {
	$head = 'Lock';
	$word = 'lock';
	$img = 'lock_m.png';
} else {
	$head = 'Unlock';
	$word = 'unlock';
	$img = 'unlock_m.png';
}

echo '<div class="headTitle"><img src="' . $imgServer . 'main/' . $img . '" style="margin-right:5px;margin-top:3px" /><div>' . $head . ' Forum Thread</div></div>
<div id="content" style="margin:5px; font-size:14px">

Are you sure you want to ' . $word . ' "' . $forumData['title'] . '"?


</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="updateClass();" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Confirm ' . $head . '</button></div>

<script>

function updateClass() {
        var hitURL = postToAPI("POST", "lockTog.php?fid=' . $forum_id . '", currentApp, ' . $class_id . ', "saget=1");
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