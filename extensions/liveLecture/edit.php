<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

if ($class_level == 3) {


if (isset($_GET['lid']) && is_numeric($_GET['lid'])) {
	$lid = escape($_GET['lid']);
	// get the forum data
	$lecture = getLLC($lid);

	if ($lecture['classID'] != $class_id) {
		exit();
	}
	
} else {
	exit();
}


// if submitted
if (isset($_POST['saget'])) {
	$attempt = archiveLLC($lid);
	echo 1;
	exit();
}
echo '<div class="headTitle"><img src="' . $imgServer . 'main/time.png" style="margin-right:5px;margin-top:0px" /><div>End & Archive LiveLecture</div></div>
<div id="content" style="margin:5px; font-size:14px">

Are you sure you want to end & archive "' . $lecture['title'] . '"?


</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="updateClass();" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Confirm</button></div>

<script>

function updateClass() {
        var hitURL = postToAPI("POST", "edit.php?lid=' . $lid . '", currentApp, ' . $class_id . ', "saget=1");
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

?>