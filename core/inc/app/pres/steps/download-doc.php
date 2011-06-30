<?php
$contentData = get_content($conID);
// make sure we give our server plenty of time.
set_time_limit(90);
ini_set('default_socket_timeout', 90); 
$theData = file_get_contents('http://50.57.86.38/index.php?type=2&hash=' . $contentData['content'] . '&ext=' . $contentData['ext']);



$attempt = create_pres($contentData['name'], $theData, $contentData['fid'], $user_id);
echo $attempt;
	
?>