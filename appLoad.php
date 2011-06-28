<?php
// application loader
require_once('core/inc/coreInc.php');
// get appID
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
$classID = escape($_GET["cid"]);
$appID = escape($_GET["id"]);
$appType = escape($_GET["appType"]);
$appInfo = getApp($appID);
if ($appType == 1) {
    if ($appInfo['isClass'] == 1) {
        $canvasURL = $appInfo['classCanvas'];
        
        // kill if not allowed
        if (authClass($classID) == false) {
            exit();
        }
        
    } else {
        exit();
    }
    
} elseif ($appType == 3) {
    if ($appInfo['isSchool'] == 1) {
        $canvasURL = $appInfo['schoolCanvas'];
    } else {
        exit();
    }
    
}


// get page URL
if (isset($_GET["page"]) && ($_GET["page"] != 'undefined') && ($_GET["page"] != '')) {
	// if we have a page defined...
	$pageURL = $_GET["page"];
	$pageURL = str_replace('(*)', '=', $pageURL);
	$pageURL = str_replace('[*]', '&', $pageURL);
} else {
	// set index page as default
	$pageURL = 'index.php';
}

// if this application is CC internal...
if ($appInfo['internal'] == 2) {
	
	// format query string
	if (strpos($pageURL, '?') > 0) {
		$pageURL .= '&CC_CLASS_ID=' . $classID . '&CC_SESSION_ID=' . session_id();
	} else {
		$pageURL .= '?CC_CLASS_ID=' . $classID . '&CC_SESSION_ID=' . session_id();
	}
	
	
	// set the root of our extensions
	$extLocation = $extServer;
	// create full include URL
	$appURL = $extLocation . $canvasURL . $pageURL;

	// if the requested file exists, include it!
		echo file_get_contents($appURL);

} // appInfo internal if statement



// if the application ID is either not numeric or not present...
} else {
	echo "<cc:crumbs>Error</cc:crumbs>
	Unable to retrieve application ID.";
	
}


?>