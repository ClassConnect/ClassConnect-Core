<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

if ($class_level != 3) {
	exit();
}

// get & clean all shift data
$eid = escape($_POST['eid']);
$shiftDay = escape($_POST['shiftDay']);
$shiftMin = escape($_POST['shiftMin']);

// get event data
$eventData = getEvent($eid, $class_id);

// if this event doesn't exist for this class...
if ($eventData == false) {
	exit();
}


$endDate = $eventData['end_date'];


// calculate new start date
$endDate = strtotime($shiftDay . ' day' , strtotime($endDate));
$endDate = ($shiftMin * 60) + $endDate;
$endDate = date ('Y-m-j H:i', $endDate);


$test = updateEntry($eid, $eventData['title'], $eventData['body'], $eventData['client_type'], $eventData['type'], $eventData['start_date'], $endDate);

// if updated successfully
if ($test == 1) {
	echo 1;
} else {
	echo 2;
}


?>