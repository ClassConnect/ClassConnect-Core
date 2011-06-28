<?php
// create forum
function createForum($class_id, $title, $body) {
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
		$errors[] = 'No forum title was entered.';
	}
	
	// get body
	if ($body != '') {
		$body = escape($body);
	} else {
		$errors[] = 'No forum description was entered.';
	}
	if (empty($errors)) {
		good_query("INSERT INTO forum_threads (class_id, title, body, created_at) VALUES ('$class_id', '$title', '$body', NOW() )");	
		return 1;
	} else {
		return $errors;
	}
	
	
}
// end




// update forum
function updateForum($forum_id, $class_id, $title, $body) {
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
		$errors[] = 'No forum title was entered.';
	}
	
	// get body
	if ($body != '') {
		$body = escape($body);
	} else {
		$errors[] = 'No forum description was entered.';
	}
	if (empty($errors)) {
		good_query("UPDATE forum_threads SET title = '$title', body = '$body' WHERE class_id = $class_id AND forum_id = $forum_id");
		return 1;
	} else {
		return $errors;
	}
	
	
}
// end




// create reply
function addReply($forum_id, $user_id, $body) {
	$errors = array();	
	
	// get class ID
	if (is_numeric($forum_id)) {
		$forum_id = escape($forum_id);
	} else {
		$errors[] = 'No forum ID was provided.';
	}

	
	// get body
	if ($body != '') {
		$body = escape($body);
	} else {
		$errors[] = 'No reply was entered.';
	}
	if (empty($errors)) {
		good_query("INSERT INTO forum_replies (uid, fid, body, posted_at) VALUES ('$user_id', '$forum_id', '$body', NOW() )");	
		return 1;
	} else {
		return 1;
	}
	
	
}
// end



// create reply
function addReplyTo($reply_id, $forum_id, $user_id, $body) {
	$errors = array();	
	
	// get class ID
	if (is_numeric($forum_id)) {
		$forum_id = escape($forum_id);
	} else {
		$errors[] = 'No forum ID was provided.';
	}
	
	// get class ID
	if (is_numeric($reply_id)) {
		$reply_id = escape($reply_id);
	} else {
		$errors[] = 'No reply ID was provided.';
	}

	
	// get body
	if ($body != '') {
		$body = escape($body);
	} else {
		$errors[] = 'No reply was entered.';
	}
	if (empty($errors)) {
		good_query("INSERT INTO forum_replies (uid, rid, fid, body, posted_at) VALUES ('$user_id', '$reply_id', '$forum_id', '$body', NOW() )");	
		return 1;
	} else {
		return 1;
	}
	
	
}
// end


// updateLock function
function updateLock($lock, $class_id, $forum_id) {
	good_query("UPDATE forum_threads SET locked = '$lock' WHERE class_id = $class_id AND forum_id = $forum_id");
	return 1;
}
// end updateLock



// get forums for a class
function listForums($class_id) {
	$forums = good_query_table("SELECT * FROM forum_threads WHERE class_id = '$class_id' ORDER BY `locked`, `created_at` DESC");
	return $forums;
}
// end listForums




// get a forum's information
function getForum($forum_id, $class_id) {
	$forum = good_query_assoc("SELECT * FROM forum_threads WHERE forum_id = '$forum_id' AND class_id = '$class_id' LIMIT 1");
	return $forum;
}
// end getForum



// delete a forum
function delForum($forum_id, $class_id) {
	good_query("DELETE FROM forum_threads WHERE forum_id = '$forum_id' AND class_id = '$class_id' LIMIT 1");
	good_query("DELETE FROM forum_replies WHERE fid = '$forum_id'");
}
// end delForum



// delete a forum reply
function delReply($forum_id, $reply_id) {
	good_query("DELETE FROM forum_replies WHERE fid = '$forum_id' AND (reply_id = '$reply_id' OR rid = '$reply_id')");
}
// end delForum



// get forum replies
function getReplies($forum_id) {
	$comments = good_query_table("SELECT * FROM forum_replies LEFT JOIN users ON users.id = forum_replies.uid  WHERE fid = '$forum_id' ORDER BY `posted_at` DESC");
	return $comments;
}
// end get forum replies


?>