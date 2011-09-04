<?php
// get class ID
$class_id = escape($_GET['CC_CLASS_ID']);

// get user's session
$session_id = escape($_GET['CC_SESSION_ID']);


// auth session
$user = authSession($session_id);
$user_id = $user['uid'];

$class_level = authClassRelationship($user_id, $class_id);

if ($class_level == false) {
	exit();
}

?>
