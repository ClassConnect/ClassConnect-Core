<?php
// create hashed folder name
$folderName = SHA1('classconnect4randomst1n8' . $conID);
if (file_exists('convert/docs/' . $folderName)) {
	echo '2';
} else {
	$contentData = get_content($conID);
	// create dir, download doc to it
	mkdir('convert/docs/' . $folderName, 0777, true);
	chmod('convert/docs/' . $folderName, 0777);
	// download and save doc
	$ch = curl_init('http://c0424828.cdn2.cloudfiles.rackspacecloud.com/' . $contentData['content']);
	$fp = fopen('convert/docs/' . $folderName . '/' . $conID . '.' . $contentData['ext'], 'wb');
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
	chmod('convert/docs/' . $folderName . '/' . $conID . '.' . $contentData['ext'], 0777);
	echo '1';
	
}
?>