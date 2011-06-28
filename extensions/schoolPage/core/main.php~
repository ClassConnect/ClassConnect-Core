<?php

// add comment to class wall
function addComment($body, $userID, $level, $classID) {
	// clean stuff
	$body = escape($body);
	$userID = escape($userID);
	$level = escape($level);
	
	// insert if there is a body
	if ($body != '') {
		$test = good_query("INSERT INTO class_wall (body, userID, level, classID, date_posted) VALUES ('$body', '$userID', '$level', '$classID', NOW() )");	
	}
	
}
// end addComment



// get comments for a class
function getComments($classID, $start, $limit) {
	$classID = escape($classID);
	$start = escape($start);
	$limit = escape($limit);
	
	if (!isset($start)) {
		$start = 0;
	}
	if (!isset($limit)) {
		$limit = 20;
	}
	$comments = good_query_table("SELECT * FROM class_wall LEFT JOIN users ON users.id = class_wall.userID  WHERE classID = '$classID' ORDER BY `date_posted` DESC LIMIT $start, $limit");
	
	return $comments;
}



// get latest teacher update
function getUpdate($classID) {
	$update = good_query_assoc("SELECT * FROM class_wall WHERE classID = '$classID' AND level = '3' ORDER BY `date_posted` DESC LIMIT 1");
	return $update;
}


// remove comment function
function removeComment($comment_id, $class_id) {
	$comment_id = escape($comment_id);
	$class_id = escape($class_id);
	good_query("DELETE FROM class_wall WHERE comment_id = '$comment_id' AND classID = '$class_id' LIMIT 1");	
}

?>