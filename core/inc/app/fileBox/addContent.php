<?php
$cType = escape($_GET['cType']);
$fid = escape($_GET['fid']);

// if were uploading files
if ($cType == 1) {
	require_once('core/inc/app/fileBox/content/files/add.php');

// if were adding a website
} elseif ($cType == 2) {
	require_once('core/inc/app/fileBox/content/websites/add.php');

// if were adding a youtube video
} elseif ($cType == 3) {
	require_once('core/inc/app/fileBox/content/youtube/add.php');

// if were adding a youtube video
} elseif ($cType == 4) {
	require_once('core/inc/app/fileBox/content/embed/add.php');


// if were adding a google doc
} elseif ($cType == 8) {
	require_once('core/inc/app/fileBox/content/gapp/add.php');
	
}



?>