<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

// get EID
$eid = escape($_POST['eid']);
// get event data
$eventData = getEvent($eid, $class_id);

if ($eventData['type'] == 1) {
		$class = 'asmtEvent';
		$title = 'Assignment';
} elseif ($eventData['type'] == 2) {
		$class = 'projEvent';
		$title = 'Project';
} elseif ($eventData['type'] == 3) {
		$class = 'testEvent';
		$title = 'Test';
} elseif ($eventData['type'] == 4) {
		$class = 'eventEvent';
		$title = 'Event';
}
// begin output!
echo '<div class="headTitle"><img src="' . $imgServer . 'gen/calendar.png" style="margin-right:7px;margin-top:5px" /><div>' . $eventData['title'] . '</div></div>
<div id="content" style="font-size:14px">
<div class="' . $class . '" style="padding:1px; border-bottom: 1px solid #666;border-top: 1px solid #666; color: #fff; font-weight:bolder; text-align:center; font-size:9px">' . $title . '</div>
<div style="padding:4px; border-bottom: 1px solid #666; background: #ebebeb; font-weight:bolder">Date</div>
<div style="margin:5px">';
if (date('H:i', strtotime($eventData['start_date'])) == '00:00' && date('H:i', strtotime($eventData['end_date'])) == '00:00') {
	$startDate =  date('m/d/Y', strtotime($eventData['start_date']));
	$endDate = date('m/d/Y', strtotime($eventData['end_date']));
	if ($startDate == $endDate) {
		echo $startDate;
	} else {
		echo $startDate . ' - ' . $endDate;
	}
	 
	
} else {
	$startDate =  date('m/d/Y @ g:ia', strtotime($eventData['start_date']));
	$endDate = date('g:ia', strtotime($eventData['end_date']));
	echo $startDate . ' - ' . $endDate;
	
}

echo '</div>';

if ($eventData['body'] != '') {
echo '<div style="padding:4px; border-bottom: 1px solid #666; border-top: 1px solid #666; background: #ebebeb; font-weight:bolder">Description</div>
<div style="margin:5px">
' . $eventData['body'] . '
</div>';
}

echo '</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button>';

if ($class_level == 3) {
	echo '<button class="button" type="submit" onClick="editEvent();" style="float:right"><img src="' . $imgServer . 'gen/change.png" />Edit Entry</button><button class="button" type="submit" onClick="deleteEvent();" style="float:right"><img src="' . $imgServer . 'gen/delCircle.png" />Delete Entry</button></div>';
	echo '<script>
function editEvent() {
	var hitURL = postToAPI("POST", "editEvent.php", currentApp, ' . $class_id . ', "eid=' . $eid . '");
	openBox(hitURL, 350);
}
function deleteEvent() {
	var hitURL = postToAPI("POST", "delEvent.php", currentApp, ' . $class_id . ', "eid=' . $eid . '");
	openBox(hitURL, 350);
}
</script>';
} else {
	echo '</div>';
}




?>