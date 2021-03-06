<?php

// create calendar event
function createEntry($title, $body, $client_type, $type, $class_id, $start_date, $end_date) {
	global $dbc;
	$errors = array();	
	
	// get class ID
	if (is_numeric($class_id)) {
		$class_id = escape($class_id);
	} else {
		$errors[] = 'No class ID was provided.';
	}
	
	// get title
	if ($title != '') {
		$title = escape($title);
	} else {
		$errors[] = 'No entry title was entered.';
	}
	
	// get type
	if (is_numeric($type)) {
		$type = escape($type);
	} else {
		$errors[] = 'No entry type was entered.';
	}
	
	// get type
	if (is_numeric($client_type)) {
		$client_type = escape($client_type);
	} else {
		$errors[] = 'No client type was entered.';
	}
	
	$start = date('Y-m-d H:i', strtotime($start_date));
	$end = date('Y-m-d H:i', strtotime($end_date));
	
	if ($start > $end) {
		$errors[] = 'End date & time must be <strong>after</strong> start.';
	}
	
	// clean body
	$body = escape($body);
	
	
	if (empty($errors)) {
		$insertEvent = @mysqli_query($dbc, "INSERT INTO calendar_entries (title, body, client_type, type, class_id, start_date, end_date, created_on) VALUES ('$title', '$body', '$client_type', '$type', '$class_id', '$start', '$end', NOW() )");

			$sid = $dbc->insert_id;


		return $sid;
	} else {
		return $errors;
	}
	
}
// end



// retrieve entries for the feed
function getEntries($start, $end, $class_id) {
	$start = date("Y-m-d H:i", $start);
	$end = date("Y-m-d H:i", $end);
	
	$total = good_query_table("SELECT * FROM calendar_entries WHERE class_id = '$class_id' AND ((end_date <= '$end' AND end_date >= '$start') OR (start_date >= '$start' AND start_date <= '$end'))");
	
	return $total;
	
}
// end retrieval



// retrieve entries for the feed
function getAllEntries($class_id) {

	$total = good_query_table("SELECT * FROM calendar_entries WHERE class_id = '$class_id'");
	return $total;

}
// end retrieval



// update entry
function updateEntry($eventID, $title, $body, $client_type, $type, $start_date, $end_date) {
	
	$errors = array();	
	
	
	// get title
	if ($title != '') {
		$title = escape($title);
	} else {
		$errors[] = 'No entry title was entered.';
	}
	
	// get type
	if (is_numeric($type)) {
		$type = escape($type);
	} else {
		$errors[] = 'No entry type was entered.';
	}
	
	// get type
	if (is_numeric($client_type)) {
		$client_type = escape($client_type);
	} else {
		$errors[] = 'No client type was entered.';
	}
	
	$start = date('Y-m-d H:i', strtotime($start_date));
	$end = date('Y-m-d H:i', strtotime($end_date));
	
	if ($start > $end) {
		$errors[] = 'End date & time must be <strong>after</strong> start.';
	}
	
	// clean body
	$body = escape($body);
	
	
	if (empty($errors)) {
		good_query("UPDATE calendar_entries SET title = '$title', body = '$body', client_type = '$client_type', type = '$type', start_date = '$start', end_date = '$end' WHERE entry_id = $eventID");	
		return 1;
	} else {
		return $errors;
	}
	
}



// get event info
function getEvent($eid, $class_id) {
	$event = good_query_assoc("SELECT * FROM calendar_entries WHERE class_id = '$class_id' AND entry_id = '$eid'");
	return $event;
}
// end



// delete an event
function delEvent($eid) {
	good_query("DELETE FROM calendar_entries WHERE entry_id = '$eid' LIMIT 1");
}
?>