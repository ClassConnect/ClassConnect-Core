<?php

// function that authenticates an application
function authApp($appID, $secretKey, $type) {
	$app = good_query_assoc("SELECT * FROM applications WHERE id = '$appID' AND secretKey = '$secretKey' AND type = '$type' LIMIT 1");
		if ($app == false) {
			return false; //
		} else {
			return true;
		}
}

// function that authenticates external sessions
function authSession($userID, $sessionKey) {
	$session = good_query_assoc("SELECT * FROM users-keys WHERE id = '$sessionKey' AND uid = '$userID' LIMIT 1");
		if ($session == false) {
			return false; //
		} else {
			return true;
		}
}


///////////////// GET VARIABLES /////////////////////////

	// get appID
	if (isset($_GET['appid']) && is_numeric($_GET['appid'])) {
		$appID = $_GET['appid'];
	}
	// get secret key
	if (isset($_GET['appkey'])) {
		$secretKey = $_GET['appkey'];
	}
	
	if (authApp($appID, $secretKey, 3) == true) {
		$appVer = true;
	} else {
		$appVer = false;
	}

?>