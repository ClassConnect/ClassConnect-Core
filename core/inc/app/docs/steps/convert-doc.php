<?php
// create hashed folder name
$folderName = SHA1('classconnect4randomst1n8' . $conID);
$contentData = get_content($conID);
if (file_exists('convert/docs/' . $folderName . '/' . $conID . '.' . $contentData['ext'])) {
	$temp = shell_exec('unoconv -f html "convert/docs/' . $folderName . '/' . $conID . '.' . $contentData['ext'] . '"');
	echo '1';
}
?>