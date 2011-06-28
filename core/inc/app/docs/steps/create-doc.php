<?php
// create hashed folder name
$folderName = SHA1('classconnect4randomst1n8' . $conID);
$contentData = get_content($conID);
if (file_exists('convert/docs/' . $folderName . '/' . $conID . '.html')) {
    $fileName = 'convert/docs/' . $folderName . '/' . $conID . '.html';
    $theData = file_get_contents($fileName);
    $theData = str_replace('<IMG SRC="', '<IMG SRC="' . $appServer . 'convert/docs/' . $folderName . '/', $theData);
    $attempt = create_doc($contentData['name'], $theData, $contentData['fid'], $user_id);
    echo $attempt;
} 
?>
