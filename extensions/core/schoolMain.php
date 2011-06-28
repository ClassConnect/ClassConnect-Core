<?php
// get class ID
$school_id = escape($_GET['CC_CLASS_ID']);

// get user's session
$session_id = escape($_GET['CC_SESSION_ID']);


// auth session
$user = authSession($session_id);
$user_id = $user['uid'];

$school_level = checkSchoolLink($school_id, $user_id);

if ($school_level == false) {
	exit();
}

?>