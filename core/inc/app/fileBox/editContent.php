<?php
$content_id = escape($_GET['content_id']);

// if we have authorization
if (auth_content($content_id, $user_id) == true) {
	// get the content info
	$content = get_content($content_id);
} else {
	echo 'Cannot verify permissions. Please try again.';
	exit();
}


// if were uploading files
if ($content['format'] == 1) {
	require_once('core/inc/app/fileBox/content/files/edit.php');

// if were adding a website
} elseif ($content['format'] == 2) {
	require_once('core/inc/app/fileBox/content/websites/edit.php');

// if were adding a youtube video
} elseif ($content['format'] == 3) {
	require_once('core/inc/app/fileBox/content/youtube/edit.php');
	
// if were adding a youtube video
} elseif ($content['format'] == 4) {
	require_once('core/inc/app/fileBox/content/embed/edit.php');
	
// if were adding a scribd doc
} elseif ($content['format'] == 5) {
	require_once('core/inc/app/fileBox/content/scribd/edit.php');
	
} else {
    require_once('core/inc/app/fileBox/content/gen/edit.php');
}



?>