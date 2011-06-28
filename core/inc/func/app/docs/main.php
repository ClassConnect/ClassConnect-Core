<?php

// read a directory
function create_doc($title, $body, $parent_dir, $uid) {
	global $dbc;
	// create errors array	
	$errors = array();
	
	
	
	// check for first name
	if ($title != '') {
		$title = escape($title);
	} else {
		$errors[] = 'No document name was entered.';
	}
	
	// clean body
	$body = escape($body);
	
	// check for first name
	if ($parent_dir != '') {
		$parent_dir = escape($parent_dir);
	} else {
		$errors[] = 'No folder was selected.';
	}
	
	// if no errors
	if (empty($errors)) {
		$insertDoc = @mysqli_query($dbc, "INSERT INTO filebox_content (format, uid, fid, name, content, time_date) VALUES ('6', '$uid', '$parent_dir', '$title', '$body', NOW() )");
		
		$doc_id = $dbc->insert_id;
		return $doc_id;
	} else {
		return $errors; 
	}
	
}
// end read dir






?>