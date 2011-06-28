<?php
// FEED DOES NOT GO THROUGH THE API
// application loader
require_once('../../core/inc/coreInc.php');
// include locals
require_once('core/main.php');

// kill if not allowed
$class_id = $_GET['cid'];
if (authClass($class_id) == false) {
	exit();
}

$entries = getEntries($_GET['start'], $_GET['end'], $class_id);
$total = array();
foreach ($entries as $entry) {
	// detect all day
	if (substr($entry['start_date'], strlen($entry['start_date']) - 8, strlen($entry['start_date'])) == '00:00:00'  && substr($entry['end_date'], strlen($entry['end_date']) - 8, strlen($entry['end_date'])) == '00:00:00') {
		$allDay = true;
	} else {
		$allDay = false;
	}
	
	if ($entry['type'] == 1) {
		$class = 'asmtEvent';
	} elseif ($entry['type'] == 2) {
		$class = 'projEvent';
	} elseif ($entry['type'] == 3) {
		$class = 'testEvent';
	} elseif ($entry['type'] == 4) {
		$class = 'eventEvent';
	}
	
	$total[] = array(
			'id' => $entry['entry_id'],
			'title' => $entry['title'],
			'start' => $entry['start_date'],
			'end' => $entry['end_date'],
			'allDay' => $allDay,
			'className' => $class
		);
		
	
	
}



	echo json_encode($total);
?>
