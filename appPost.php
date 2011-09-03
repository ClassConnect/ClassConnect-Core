<?php
// application loader
require_once('core/inc/coreInc.php');

$required = 'type,action,data,appID,classID,appType';
$req_array = explode(',', $required);
$data = array();
// loop through required inputs
foreach ($req_array as $param) {
	if (isset($_GET[$param]) && $_GET[$param] != '') {
		$data[$param] = $_GET[$param];
	} else {
		$error = 1;
	}
}


// if no errors are reported
if ($error != 1) {
// get this apps data from mysql
$appInfo = getApp($data['appID']);

$appType = $data['appType'];
if ($appType == 1) {
    if ($appInfo['isClass'] == 1) {
        $canvasURL = $appInfo['classCanvas'];

        // kill if not allowed
        if (authClass($data['classID']) == false) {
            exit();
        }

    } else {
        exit();
    }

} elseif ($appType == 3) {
     // kill if not allowed
        if (checkSchoolLink($data['classID'], $user_id) == false) {
            exit();
        }
    if ($appInfo['isSchool'] == 1) {
        $canvasURL = $appInfo['schoolCanvas'];
    } else {
        exit();
    }

}


// if this application is CC internal...
if ($appInfo['internal'] == 2) {
	
	// format query string
	if (strpos($data['action'], '?') > 0) {
		$data['action'] .= '&CC_CLASS_ID=' . $data['classID'] . '&CC_SESSION_ID=' . session_id();
	} else {
		$data['action'] .= '?CC_CLASS_ID=' . $data['classID'] . '&CC_SESSION_ID=' . session_id();
	}
	
	
	// set the root of our extensions
	$extLocation = $extServer;
	// reverse htmlentities
	$data['action'] = str_replace('(*)', '=', $data['action']);
	$data['action'] = str_replace('[*]', '&', $data['action']);
	
	// create full include URL
	$hitURL = $extLocation . $canvasURL . $data['action'];

} // appInfo internal if statement


$subData = str_replace('(*)', '=', $data['data']);
$subData = str_replace('[*]', '&', $subData);


// post request
if (strtolower($data['type']) == 'post') {


$ch = curl_init ($hitURL);
curl_setopt ($ch, CURLOPT_POST, true);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $subData);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec ($ch);
curl_close ($ch);

// get request
} else {
 $ch=curl_init();
 curl_setopt($ch,CURLOPT_URL,$hitURL . '&' . $subData);
 curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
 $page = curl_exec($ch);
 curl_close($ch);
	
}

echo $page;

// form field missing
} else {
	echo "<cc:inline></cc:inline>";
}
?>