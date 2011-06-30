<?php
require_once('../core/inc/coreInc.php');
require_once('../extensions/liveLecture/core/main.php');


if (isset($_GET['llid']) && is_numeric($_GET['llid'])) {

	$lid = escape($_GET['llid']);
	// get the forum data
	$lecture = getLLC($lid);

	$classLevel = authClass($lecture['classID']);
	
	// set allow flag
	if ($classLevel == 3) {
		archiveLLC($lid);
		sendNodeification('kLLRTEStopHostingNotification', '5', 'livelecture/' . $lid, $lecture['classID']);
		header('location: /app/class.cc?id=' . $lecture['classID'] . '#5');
	}

	
} else {
	exit();
}

?>